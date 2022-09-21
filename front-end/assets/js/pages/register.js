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
				_nextPage();
				$('html, body').animate({
					scrollTop: 0
				}, 500);
			}, 2000);

		}else{
			_nextPage();
		}

		function _nextPage() {
			$registerFrm.attr('data-step', type === 1 ? 2 : cStep + 1).removeClass('loading');
		}

		return false;
	});
});
