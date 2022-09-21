$(function() {

	var type = 1;
	var $container = $('#reg-container');
	var $registerType = $container.find('#reg-type');
	var $registerFrm = $container.find('#reg-user form');

	var $registerTypeIndicator = $registerType.find('.indicator');
	$registerType.find('.type').click(function() {

		var $t = $(this);
		type = $t.index();

		$registerType.find('.type.active').removeClass('active');
		$registerFrm.find('[name="user_type"]').val(type);
		$t.addClass('active');

		$registerTypeIndicator.css({
			left: $t.position().left,
			width: $t.outerWidth()
		});

		$container.attr('data-type', type);
	});

	$registerType.find('.type').first().click();


	$registerFrm.find('.btn.next').click(function() {

		var $step = $(this).closest('.step');
		var cStep = $step.index();

		$step.find('input').addClass('init');

		if(!$step.checkValidity()) {
			return false;
		}

		//Confirm registration
		if($(this).hasClass('last') || type === 1) {

			$registerFrm.addClass('loading');

			//TODO: ajax
			setTimeout(function() {
				$container.addClass('done');
				//_nextPage();
                $.ajax({
                    url: 'register',
                    type: 'post',
                    dataType: 'json',
                    data: $registerFrm.serialize(),
                    error: function (response) {
                        $registerFrm.removeClass('loading');
                        // TODO: add validation for inputs
                        let errorJson = JSON.parse(response.responseText);
                        $.each(errorJson.errors, (index, value) => {
                            $('.error_' + index).text(value);
                        });
                        return false;
                    },
                    success: function (response) {
                        if (response) {
                            $registerFrm.removeClass('loading');
                            $('#message_text').addClass('success');
                            $('#message_text').empty().html(response.message);

                            setTimeout(function () {
                                window.history.back()
                                }, 5000);

                            $('html, body').animate({
                                scrollTop: 0
                            }, 500);
                        } else console.log(1111);
                    }
                });
			}, 2000);

		}else{
			_nextPage();
		}

		function _nextPage() {
            $registerFrm.attr('data-step', type === 1 ? 2 : cStep + 1).removeClass('loading');
		}

		return false;
	});

	$('.company_tax_number_change input').change(function () {
        let tax_number = $('.company_tax_number_change input').val();
        $.ajax({
            url: '/check-tax-number/' + tax_number,
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $.each(response, function (key, value) {
                    $('#company_inputs input[name=' + key + ']').val(value);
                })
                let regija_id = response.regija_id;
                $("#company_inputs select[name='region']").select2().attr('data-icon', "map-marker-alt").val(regija_id).trigger("change");
                $('.select_region .select2 .selection .select2-selection').append('<i class="fas fa-map-marker-alt"></i>');
                $('.select_region .select2-selection__rendered').css('padding-left', '45px');

            },
            error: function (response) {
                $('#message_text').addClass('success');
                $('#message_text').empty().html(response.responseJSON.message);
            },
        });
    });
});
