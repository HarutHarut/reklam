$(function () {


    var $shareContainer = $('.controls .overlay.share');
    $('#post-share-btn').click(function () {
        $shareContainer.show();
        $shareContainer.off().on('mouseleave', function () {
            $(this).hide();
        });
    });

    var $gallery = $('.gallery');
    var $galleryCurrentIndex = $gallery.find('.gallery-main-controls .count > span');
    $gallery.find('.gallery-thumbnail').click(function () {
        Gallery.setActive($(this).index());
    });

    $gallery.find('.gallery-main-controls .arr').click(function () {
        if ($(this).hasClass('right')) Gallery.next(); else Gallery.back();
    });

    $(document).delegate($gallery, 'click', function(){
        setTimeout(function() {
            console.log($gallery.attr('data-blur'))
            if($gallery.attr('data-blur') == 'blur') {
                $('.lg-outer img').addClass('blur')
            }
        }, 100)
    })

    var Gallery = {
        images: 0,
        current: 0,
        next: function () {
            var next = Gallery.current + 1;
            if (next >= Gallery.images) next = 0;
            Gallery.setActive(next);
        },
        back: function () {
            var next = Gallery.current - 1;
            if (next < 0) next = Gallery.images - 1;
            Gallery.setActive(next);
        },
        setActive: function (i) {

            var $activeThumb = $gallery.find('.gallery-thumbnail').eq(i);

            $gallery.find('.gallery-thumbnail.active').removeClass('active');
            $gallery.find('.gallery-main img')
                .attr('src', $activeThumb.find('img').attr('data-main'))
                .attr('title', $activeThumb.find('img').attr('data-title'))
                .attr('alt', $activeThumb.find('img').attr('data-alt'));
            $activeThumb.addClass('active');

            Gallery.current = i;
            $galleryCurrentIndex.html(i + 1);
        }
    };

    Gallery.images = $gallery.find('.gallery-thumbnail').length || 1;

    $gallery.find('.fullscreen, .gallery-main > img').click(function () {
        $('#lightgallery a:nth-child(' + (Gallery.current + 1) + ') img').trigger('click');
        return false;
    });

    lightGallery($('#lightgallery')[0], {
        speed: 500,
        plugins: [lgThumbnail, lgZoom],
        showZoomInOutIcons: true,
    });


    $('#message_form').click(function () {
        let form = {};
        $('#modal-message form .contact-message').each(function () {
            let key = $(this).attr('name');
            let value = $(this).val();
            form[key] = value;
        });

        $.ajax({
            url: "/send-message",
            type: "POST",

            data: form,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#modal-message .message-content h2').before('<p class="successMessage">Yor message has been sent!</p>');
                setTimeout(function () {
                    $('#modal-message').removeClass('open');
                    $('#modal-message .successMessage').remove();
                }, 3000);
            },

            error: (data) => {
                $('.contact-message').next('.input-decor').find('p').empty();
                $.each(data.responseJSON.errors, (index, value) => {
                    $('.error-' + index).text(value).css({ color: 'red', display : 'block' });
                });
            },
        });
    })

    $('#report_form').click(function () {
        let form = {};
        $('#modal-report form .report-message').each(function () {
            let key = $(this).attr('name');
            let value = $(this).val();
            form[key] = value;
        });

        $.ajax({
            url: "/send-report",
            type: "POST",

            data: form,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#modal-report .message-content h2').before('<p class="successMessage">Yor report has been sent!</p>');
                setTimeout(function () {
                    $('#modal-report').removeClass('open');
                    $('#modal-report .successMessage').remove();
                    $('.contact-message').next('.input-decor').find('p').empty();
                    $('textarea[name="msg"]').val('');
                }, 3000);
            },

            error: (data) => {
                $('.contact-message').next('.input-decor').find('p').empty();
                $.each(data.responseJSON.errors, (index, value) => {
                    $('.error_' + index).text(value).css({ color: 'red', display : 'block' });
                });
            },
        });
    })


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
