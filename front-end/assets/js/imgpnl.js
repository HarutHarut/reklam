(function($) {
	$.fn.imagePanel = function(args) {
		return $(this).each(function() {
			this.imagePanel = new ImagePanel($(this), args);
		});
	};
})(jQuery);


const ImagePanel = function($container, args) {

	const ip = this;
	ip.types = args.types || 'image/png, image/gif, image/jpeg';
	ip.name = args.name || 'imgs[]';
	ip.apiPath = args.apiPath || null;
	ip.apiParams = args.apiParams || {};
	ip.fileIdPrefix = args.fileIdPrefix || '';
	ip.processedFiles = 0;

	if(typeof args.addFilesBtn !== 'undefined') {
		$container.append($(args.addFilesBtn).addClass('btn-add'));
	}

	const $input = $('<input type="file" accept="' + ip.types + '" name="' + ip.name + '" multiple/>');
	$input.change(function() {
		for(let i = 0; i < this.files.length; i++) {

			const imgId = (ip.fileIdPrefix ? (ip.fileIdPrefix + ':') : '') + ip.processedFiles;
			const $img = $('<div class="img-thmb"><img src="' + URL.createObjectURL(this.files[i]) + '"/><div class="rem-btn"><span></span><span></span></div></div>');
			$img.data('imgid', imgId);
			$container.find('> .gallery').append($img);

			if(ip.apiPath) {
				ip.callApi('upload', {
					image: this.files[i],
					imageId: imgId,
					order: ip.processedFiles
				}, function() {
				}, $img);

				$img.find('.rem-btn').click(function(e) {
					e.preventDefault();
					ip.callApi('remove', {
						imageId: imgId
					}, function() {
						$img.remove();
					}, $img);
					return false;
				});

			}

			ip.processedFiles++;
		}
	});


	$container.addClass('imgpnl-container').wrapInner('<label></label>').prepend('<div class="gallery"></div>');
	$container.find('> label').prepend($input);

	$container.find('.gallery').sortable({
		containment: 'parent',
		cursor: 'move',
		//handle: '.img-thmb',
		items: '.img-thmb',
		tolerance: 'pointer',
		stop: function() {
			const orders = [];
			$container.find('> .gallery > .img-thmb').each(function() {
				orders.push($(this).data('imgid'));
			});
			ip.callApi('sort', {
				orders: orders
			});
		}
	});


	ip.callApi = function(action, data, onFinish, $markLoading) {

		if($markLoading) $markLoading.addClass('loading');

		data = $.extend(data || {}, ip.apiParams);
		const formData = new FormData();
		const dataKeys = Object.keys(data);
		for(let i = 0; i < dataKeys.length; i++) {
			formData.append(dataKeys[i], data[dataKeys[i]]);
		}
		formData.append('action', action);

		$.ajax({
			url: ip.apiPath,
			type: 'POST',
			data: formData,
			processData: false,
			contentType: 'multipart/form-data',
			cache: false,
			async: true,
			complete: function(r) {
				if($markLoading) $markLoading.removeClass('loading');
				if(typeof onFinish === 'function') onFinish.apply(ip, [r]);
			}
		});
	};

	return ip;
};
