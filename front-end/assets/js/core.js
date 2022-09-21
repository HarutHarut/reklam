$(function() {

	var $headerCategoriesToggle = $('#header-sub .categories-toggle');
	var $headerCategories = $headerCategoriesToggle.find('.categories');
	var $headerCategoriesList = $('#header-categories-browse');
	var headerCategoriesListWidth = 995;
	var displayPositionConf = [3, 5];

	$headerCategories.find('> ul li').on('mouseenter', function() {

		var i = $(this).index();

		$headerCategories.find('> ul li.active').removeClass('active');
		$(this).addClass('active');
		$headerCategories.addClass('hovered');
		$headerCategoriesList.find('> .category.active').removeClass('active');

		var $cat = $headerCategoriesList.find('> .category').eq(i);
		$cat.addClass('active ' + $(this).attr('class'));

		$cat.css({
			position: 'absolute',
			width: headerCategoriesListWidth,
			left: $headerCategories.offset().left + $headerCategories.width()
		});

		if(i < displayPositionConf[0]) { //Display on top

			$cat.css({
				top: $(this).offset().top
			});

		}else if(i > displayPositionConf[1]) { //Display on bottom

			$cat.css({
				top: $(this).offset().top - $cat.outerHeight(true) + $(this).height()
			});

		}else{ //Display in the middle

			$cat.css({
				top: $(this).offset().top - ($cat.outerHeight(true) / 2) + ($(this).height() / 2)
			});

		}

		$('body').on('mouseover.catModalClose', function(e) {
			if($(e.target).hasClass('cat-modal-el') || $(e.target).closest('.cat-modal-el').length > 0) {
				return true;
			}
			$headerCategoriesList.find('> .category.active').removeClass('active');
			$headerCategories.removeClass('hovered').find('> ul li.active').removeClass('active');
			$('body').off('mouseover.catModalClose');
		})
	});

	$headerCategoriesToggle.find('.cat-toggle-btn').click(function() {
		if(!$headerCategoriesToggle.hasClass('force-open')) {
			$headerCategoriesToggle.toggleClass('open');
			if($headerCategoriesToggle.hasClass('open')) {

				$('body').on('mousemove.headerCatMove', function(e) {
					if($(e.target).closest('.categories, .cat-modal-el').length === 0) {
						$headerCategoriesToggle.removeClass('open').find('li.active').removeClass('active');
						$('body').off('mousemove.headerCatMove');
					}
				});
			}
		}
	});


	var $search = $('#header-main .search');
	var $region = $search.find('.region');
	var $regionText = $region.find('> label > span');
	var searchRegions = [];
	$region.find('> label').click(function() {
		$region.toggleClass('open');
		$search.on('mouseleave', function(e) {
			$search.off();
			$region.removeClass('open');
		});
	});

	var $regionChs = $region.find('.ch input[type="checkbox"]');
	$regionChs.change(function() {

		searchRegions = [];
		$regionChs.each(function() {
			if($(this)[0].checked) {
				searchRegions.push($(this).attr('value'));
			}
		});

		$regionText.html(searchRegions.length === 0 ? 'Celotna Slovenija' : searchRegions.join(', '));

	});


	$('[data-modal]').click(function() {
		window.openModal($(this).attr('data-modal'));
		return false;
	});

	window.openModal = function(key) {
		var $modal = $('.modal#' + key);
		if($modal.length > 0) {
			$modal.addClass('open');
			$modal.off('click.modalBgClose').on('click.modalBgClose', function(e) {
				if($(e.target).hasClass('modal')) {
					$modal.removeClass('open');
				}
			});
		}
		return false;
	};

	$('.modal-close').click(function() {
		$(this).closest('.modal').removeClass('open');
	});

	$('.input input, .ch input, .input textarea').on('change blur', function() {
		$(this).addClass('init');
	});

	$('.sb, .filter-scroll').each(function() {
		new SimpleBar($(this)[0], {
			autoHide: false
		});
	});

	$('.select').each(function() {
		$(this).select2({
			placeholder: ($(this).attr('data-placeholder') || '-'),
			minimumResultsForSearch: 8
		});

		$(this).data('select2').$container.find('.select2-selection__arrow').html('<i class="far fa-chevron-down"></i>');

		var ico = $(this).attr('data-icon');
		if(ico) {
			$(this).data('select2').$container.find('.select2-selection').addClass('has-ico').prepend('<i class="fas fa-' + ico + '"></i>');
		}
	});


	var $confirmNumModal = $('#modal-confirm-sms');
	var confirmNums = {};
	var confirmNumsSize = $confirmNumModal.find('.confirm-num input')
		.keydown(function(e) {
			var $t = $(this);
			var v = e.originalEvent.key;
			if($.isNumeric(v)) {
				$t.val(v);
				confirmNums[$t.index()] = v;
			}

			setTimeout(function() {
				$t.next().focus();
			}, 50);

			if(Object.keys(confirmNums).length >= confirmNumsSize) {
				$confirmNumModal.find('button').removeClass('disabled');
			}
		}).length;

	$confirmNumModal.find('button').click(function() {
		var $t = $(this);
		if($t.hasClass('loading disabled')) return false;
		$confirmNumModal.find('p.err').remove();
		$t.addClass('loading');
		//TODO: confirmNums.join('') = vnesena potrditvena koda
		setTimeout(function() {
			if(false) {
				$confirmNumModal.find('button').before('<p class="err">Vnesena potrditvena koda ni veljavna!</p>');
			}else{
				$('[data-sms="modal-confirm-sms"]').html('<i class="fas fa-check"></i> Validacija uspešna!').closest('#phone-confirm').addClass('confirmed');
				$confirmNumModal.removeClass('open');
			}
			$t.removeClass('loading');
		}, 1000);
	});


	$('.box.more:not(.open)').click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		e.stopImmediatePropagation();
		$(this).closest('.box').addClass('open').on('mouseleave', function() {
			$(this).removeClass('open').off('mouseleave');
		});

		return false;
	});
});


jQuery.fn.checkValidity = function() {
	var isValid = true;
	$(this).find('input, textarea').each(function() {
		if(!$(this)[0].checkValidity()) {
			isValid = false;
			return false;
		}
	});
	return isValid;
};

function captchaFormCb(r) {
	let $frm = $('form');
	$frm.find('[name="captcha"]').val(r);
	$frm.find('button.disabled').removeClass('disabled');
}
