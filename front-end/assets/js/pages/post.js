$(function() {


	var $shareContainer = $('.controls .overlay.share');
	$('#post-share-btn').click(function() {
		$shareContainer.show();
		$shareContainer.off().on('mouseleave', function() {
			$(this).hide();
		});
	});

	var $gallery = $('.gallery');
	var $galleryCurrentIndex = $gallery.find('.gallery-main-controls .count > span');
	$gallery.find('.gallery-thumbnail').click(function() {
		Gallery.setActive($(this).index());
	});

	$gallery.find('.gallery-main-controls .arr').click(function() {
		if($(this).hasClass('right')) Gallery.next(); else Gallery.back();
	});

	var Gallery = {
		images: 0,
		current: 0,
		next: function() {
			var next = Gallery.current + 1;
			if(next >= Gallery.images) next = 0;
			Gallery.setActive(next);
		},
		back: function() {
			var next = Gallery.current - 1;
			if(next < 0) next = Gallery.images - 1;
			Gallery.setActive(next);
		},
		setActive: function(i) {

			var $activeThumb = $gallery.find('.gallery-thumbnail').eq(i);

			$gallery.find('.gallery-thumbnail.active').removeClass('active');
			$gallery.find('.gallery-main img').attr('src', $activeThumb.find('img').attr('data-main'));
			$activeThumb.addClass('active');

			Gallery.current = i;
			$galleryCurrentIndex.html(i + 1);
		}
	};

	Gallery.images = $gallery.find('.gallery-thumbnail').length || 1;

	$gallery.find('.fullscreen, .gallery-main > img').click(function() {
		$('#lightgallery a:nth-child(' + (Gallery.current + 1) + ') img').trigger('click');
		return false;
	});

	lightGallery($('#lightgallery')[0], {
		speed: 500,
		plugins: [lgThumbnail, lgZoom],
		showZoomInOutIcons: true,
	});


});

var map = null;

function initModalMap() {
	var $map = $('#modal-map #map');
	map = new google.maps.Map($map, {
		center: {
			lat: parseFloat($map.attr('data-lat')),
			lng: parseFloat($map.attr('data-lng'))
		},
		zoom: 8,
	});
}
