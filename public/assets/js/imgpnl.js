var uploadedFiles = new Array();
var present = new Array();
var deleteItems = new Array();

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
	ip.name = args.name || 'imgs';
	ip.apiPath = args.apiPath || null;
	ip.apiParams = args.apiParams || {};
	ip.fileIdPrefix = args.fileIdPrefix || '';
	ip.processedFiles = 0;

	if(typeof args.addFilesBtn !== 'undefined') {
		$container.append($(args.addFilesBtn).addClass('btn-add'));
	}
    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            uploadedFiles.push(reader.result)
            resolve()
        }
        reader.onerror = error => reject(error);
    });

	const $input = $('<input type="file" accept="' + ip.types + '" name="' + ip.name + '" multiple/>');
	$input.change(function() {
	    const files = this
		for(let i = 0; i < this.files.length; i++) {
            toBase64(this.files[i])
			const imgId = (ip.fileIdPrefix ? (ip.fileIdPrefix + ':') : '') + ip.processedFiles;
			const $img = $('<div class="img-thmb"><img src="' + URL.createObjectURL(this.files[i]) + '"/><div class="rem-btn"><span></span><span></span></div></div>');
			$img.data('imgid', imgId);
			$container.find('> .gallery').append($img);
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
                        uploadedFiles.splice(parseInt(jQuery(this).parents('.img-thmb').attr('data-index')), 1)
					}, $img);
					return false;
				});

			// }

			ip.processedFiles++;
		}
        $container.find('> .gallery > .img-thmb').each(function(index) {
            $(this).attr('data-index', index)
        });
	});


    jQuery(document).delegate('.rem-btn', 'click', function() {
        // uploadedFiles.splice(parseInt(jQuery(this).parents('.img-thmb').attr('data-index')), 1)

        deleteItems.push(jQuery(this).parents('.img-thmb').attr('data-id'));
        jQuery(this).parents('.img-thmb').remove()
    })

    if ($('#existing-image').length){
        var existingImages = $('#existing-image').html();
        var html = '<div class="gallery">'+ existingImages +'</div>'
    } else{
        var html = '<div class="gallery"></div>'
    }
	$container.addClass('imgpnl-container').wrapInner('<label></label>').prepend(html);
	$container.find('> label').prepend($input);

	$container.find('.gallery').sortable({
		containment: 'parent',
		cursor: 'move',
		// handle: '.img-thmb',
		items: '.img-thmb',
		tolerance: 'pointer',
        attr: 'data-index',
		stop: function() {
			const orders = [];
			$container.find('> .gallery > .img-thmb').each(function(index) {
                var imgDiv = $(this);
                if ($(this).hasClass('editable')){
                    orders.push('edit-' + imgDiv.attr('data-id'));
                } else {
                    orders.push('sort-' + imgDiv.data('imgid'));
                }
			});
            present = orders;
            ip.callApi('sort', {
				orders: orders
			});
		},
        update: function(event, ui) {
            var productOrder = $(this).sortable('toArray').toString();
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
			// url: "nov-oglas/store",
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


