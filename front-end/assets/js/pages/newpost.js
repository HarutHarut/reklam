$(function() {

	let selectedCategory = null;
	let requireSms = false;
	let paidCategory = false;
	const toPay = {
		paid: {
			name: 'Plačljiv oglas',
			cost: 0
		},
		boost: {
			name: 'Izpostavljen oglas<br>7 dni',
			cost: 0
		}
	};
	const guid = $('#create-post-frm > [name="post"]').val();

	var $frm = $('#create-post-frm')
	var $smsContainer = $frm.find('#phone-confirm');

	var $itemName = $('#post-boost-optional .preview-post .bio strong');
	var $itemPrice = $('#post-boost-optional .preview-post .price');

	function showStep(i) {
		$(window).scrollTop($('#new-post').offset().top - 40);
		$('.create-post-page.active').removeClass('active');
		$frm.find('#cp-page-' + i).addClass('active');
	}

	function step1() {
		$('#cp-page-1 #cp-add-guest h2').click(function() {
			showStep(2);
		});
	}

	function step2() {
		var $container = $frm.find('#category-selector-container');
		var $main = $container.find('#category-selector .main');
		var $sub = $container.find('#category-selector .sub');
		var $confirm = $container.find('.confirm');
		var $current = $confirm.find('.selected strong');

		var openCategories = [];

		//Main categories selector
		$main.find('> .cat').click(function() {
			var cat = window.postCategories[$(this).index()];
			if(cat && cat.categories) {
				$sub
					.removeClass(function(i, c) {
						return (c.match(/(^|\s)col-\S+/g) || []).join(' ');
					})
					.addClass('col-' + (cat.color || 'blue'));

				openCategories = [];
				openCategory($(this), cat);
			}
		});


		//Sub-category selector and back arrow
		$sub.on('click', '.cat, .head', function() {

			var $btn = $(this);
			var cat = $btn.data('category');
			var isHead = $btn.hasClass('head');
			var animate = false;

			if(isHead) {

				//Double up
				if(!openCategories[openCategories.length - 1].hc) {
					openCategories.pop();
				}

				openCategories.pop();
				cat = openCategories[openCategories.length - 1];

				animate = true;
				$sub.addClass('anim slide-right');

			}else{
				if(openCategories[openCategories.length - 1].parent === cat.parent) {
					openCategories.pop();
				}

				//Animate only if has children
				if(cat.hc) {
					animate = true;
					$sub.addClass('anim slide-left');
				}

				requireSms = cat.sms;
				paidCategory = cat.paid;
				toPay.paid.cost = paidCategory ? 4.95 : 0;
			}

			if(cat) {
				setTimeout(function() {
					openCategory(isHead ? null : $btn, cat, isHead);
				}, animate ? 230 : 1);
			}
		});


		function openCategory($btn, cat, fromHead) {

			if(cat && !fromHead) openCategories.push(cat);

			var $sh = $sub.find('.head');

			var hasChildren = !(!cat || !cat.categories || cat.categories.length === 0);
			$container.toggleClass('cat-has-children', hasChildren);
			$container.toggleClass('cat-paid', cat.paid === true);

			if(cat.depth > 1 || (cat.depth > 0 && hasChildren)) {
				$sh.show();
				if(hasChildren) {
					$sh.find('span').html(cat.name);
				}
			}else{
				$sh.hide();
			}


			//Mark as open
			if($btn) {
				$btn.parent().find('> .active').removeClass('active');
				$btn.addClass('active');
			}

			if(cat.paid) $frm.addClass('paid-category'); else $frm.removeClass('paid-category');
			if(cat.sms) $smsContainer.addClass('sms'); else $smsContainer.removeClass('sms');

			var $categories = $('<div class="categories"></div>');

			//Invalid children categories
			if(!(cat.sh !== false && (!cat || !hasChildren))) {
				if(cat.color) $categories.addClass('col-' + cat.color);

				for(var i = 0; i < cat.categories.length; i++) {
					var c = cat.categories[i];

					if(c && c.name) {

						var $c = $('<div class="cat"><i class="far fa-chevron-right"></i>' + c.name + '</div>');

						if(c.categories && c.categories.length > 0) {
							$c.addClass('has-children');
						}

						if(c.paid) {
							$c.addClass('paid');
							$c.append('<span class="paid"><span>Plačljiva kategorija</span>€</span>')
						}

						if(c.sms) {
							$c.addClass('sms');
						}

						$c.data('category', c);
						$categories.append($c);
					}
				}

				$sub.removeClass('empty');
				$sub.find('.list').html($categories);
			}


			var openCategoriesText = [];
			for(var j = 0; j < openCategories.length; j++) {
				openCategoriesText.push(openCategories[j].name);
			}
			$current.html(openCategoriesText.join('<i class="far fa-chevron-right"></i>'));

			$confirm.show();

			$sub.removeClass('slide-left slide-right anim');

			selectedCategory = cat;

			return true;
		}

		$confirm.find('.btn').click(function() {
			$('#post-breadcrumbs').html($current.html());
			showStep(paidCategory ? 3 : 4);
		});
	}

	function step3() {
		var $selector = $('#paid-post-select');
		$selector.find('.box:not(.disabled), .box.more .more-opt').click(function() {
			showStep(4);
		});
	}

	function step4() {

		$smsContainer.find('.btn').click(function() {
			if(requireSms) {
				var $input = $(this).closest('.sms').find('.input-type-phone input');
				var $prefix = $(this).closest('.sms').find('select');
				var input = $input[0];
				var v = $input.val().trim().replace(/\D/g, '');
				if($prefix.val().replace(/\D/g, '').length === 3 && v && v.length > 7 && v.length < 10) {
					input.setCustomValidity('');
					window.openModal('modal-confirm-sms');
				}else{
					$input.addClass('init');
					input.setCustomValidity('Vnesite veljavno telefonsko številko!');
				}
			}
		});

		var $quickRegisterContainer = $('#post-register');
		$quickRegisterContainer.find('[name="quick_reg"]').change(function() {
			var on = $(this)[0].checked;
			$quickRegisterContainer.find('#quick-register').toggle(on);
			if(on) {
				$quickRegisterContainer.find('input').attr('required', 'required').prop('required', true);
			}else{
				$quickRegisterContainer.find('input').removeAttr('required').prop('required', false);
			}
		});

		$('#post-images-panel')
			.imagePanel({
				addFilesBtn: '<a class="btn oval blue">Izberi fotografije</a>',
				apiPath: 'https://dev.oglasi.si/api/post/new/images',
				fileIdPrefix: guid,
				apiParams: {
					postGuid: guid
				}
			});

		$frm.find('[name="title"]').change(function() {
			$itemName.html($(this).val().trim());
		});

		$frm.find('[name="price"]').change(function() {
			$itemPrice.html(((Math.round($(this).val() * 100) / 100).toFixed(2) + '').replace('.', ',') + ' €');
		});

		$('#post-confirm .btn').click(function() {
			var $firstInvalid = null;
			$('#cp-page-4').find('input, textarea, select').each(function() {
				if(!$(this).addClass('init')[0].checkValidity() && $firstInvalid === null) {
					$firstInvalid = $(this);
				}
			});

			var smsValid = $smsContainer.hasClass('sms') ? $smsContainer.hasClass('confirmed') : true;
			$smsContainer.find('input[type="text"]')[0].setCustomValidity(smsValid ? '' : 'Potrdite telefonsko številko preko SMS-a');
			if($firstInvalid === null && !smsValid) {
				$firstInvalid = $smsContainer;
			}

			if($firstInvalid !== null) {
				$('html, body').animate({
					scrollTop: $firstInvalid.offset().top - 50
				}, 500);
			}else{

				renderCosts();
				showStep(5);
			}
		});
	}

	var $boostContainer = $('#post-boost');
	var $payBtn = $boostContainer.find('.sum .btn');

	function step5() {

		var $paymentMethod = $boostContainer.find('.sum td.sum-pm');
		$boostContainer.find('.payment-method .head').click(function() {
			var $pm = $(this).closest('.payment-method');
			$boostContainer.find('.payment-method.active').removeClass('active');
			$(this).find('input').attr('checked', 'checked').prop('checked', true);
			$pm.addClass('active');
			$paymentMethod.html($pm.find('strong').html());
		});


		$boostContainer.find('#post-boost-optional input').change(function() {
			toPay.boost.cost = $(this)[0].checked ? 3 : 0;
			renderCosts();
		});
	}

	function renderCosts() {
		$boostContainer.find('.entry.required').toggle(toPay.paid.cost > 0);
		$boostContainer.find('.selected').remove();
		var sum = 0;
		Object.keys(toPay).forEach(function(k) {
			var tp = toPay[k];
			if(tp.cost > 0) {
				$boostContainer.find('.selected-items').append('<div class="selected"><p>' + tp.name + '</p><span>' + ((Math.round(tp.cost * 100) / 100).toFixed(2) + '').replace('.', ',') + ' €</span></div>');
				sum += tp.cost;
			}
		});

		$boostContainer.find('.sum td.sum-amt').html(((Math.round(sum * 100) / 100).toFixed(2) + '').replace('.', ',') + ' €');
		$payBtn.toggleClass('disabled', sum <= 0);
	}

	step1();
	step2();
	step3();
	step4();
	step5();


	$('#categories-json').remove();

	function _pc(children, depth) {
		if(Array.isArray(children)) {
			for(var i = 0; i < children.length; i++) {
				children[i].depth = depth;
				children[i].hc = children[i].categories && children[i].categories.length > 0;
				_pc(children[i].hc ? children[i].categories : [], depth + 1);
			}
		}
	}

	_pc(window.postCategories, 0);
});
