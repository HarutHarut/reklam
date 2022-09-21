$(function () {

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
        $('#cp-page-1 #cp-add-guest h2').click(function () {
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
        $main.find('> .cat').click(function () {
            var cat = window.postCategories[$(this).index()];

            if (cat && cat.children) {

                $sub
                    .removeClass(function (i, c) {
                        return (c.match(/(^|\s)col-\S+/g) || []).join(' ');
                    })
                    // .addClass('col-' + (cat.color || 'blue'));
                    .css('color', cat.color_filters);

                openCategories = [];
                openCategory($(this), cat);
            }
        });


        //Sub-category selector and back arrow
        $sub.on('click', '.cat, .head', function () {

            var $btn = $(this);
            var cat = $btn.data('category');
            var isHead = $btn.hasClass('head');
            var animate = false;

            if (isHead) {

                //Double up
                if (!openCategories[openCategories.length - 1].hc) {
                    openCategories.pop();
                }

                openCategories.pop();
                cat = openCategories[openCategories.length - 1];

                animate = true;
                $sub.addClass('anim slide-right');

            } else {
                if (openCategories[openCategories.length - 1].parent === cat.parent) {
                    openCategories.pop();
                }

                //Animate only if has children
                if (cat.hc) {
                    animate = true;
                    $sub.addClass('anim slide-left');
                }

                requireSms = cat.sms;
                paidCategory = cat.paid;
                toPay.paid.cost = paidCategory ? 4.95 : 0;
            }

            if (cat) {
                setTimeout(function () {
                    openCategory(isHead ? null : $btn, cat, isHead);
                }, animate ? 230 : 1);
            }
        });


        function openCategory($btn, cat, fromHead) {
            if (cat && !fromHead) openCategories.push(cat);

            var $sh = $sub.find('.head');
            var hasChildren = !(!cat || !cat.children || cat.children.length === 0);
            $container.toggleClass('cat-has-children', hasChildren);
            $container.toggleClass('cat-paid', cat.paid === true);

            if (cat.depth > 1 || (cat.depth > 0 && hasChildren)) {
                $sh.show();
                if (hasChildren) {
                    $sh.find('span').html(cat.tip);
                }
            } else {
                $sh.hide();
            }

            //Mark as open
            if ($btn) {
                $btn.parent().find('> .active').removeClass('active');
                $btn.addClass('active');
            }

            if (cat.paid) $frm.addClass('paid-category'); else $frm.removeClass('paid-category');
            if (cat.sms) $smsContainer.addClass('sms'); else $smsContainer.removeClass('sms');

            var $categories = $('<div class="categories"></div>');

            //Invalid children categories
            if (!(cat.sh !== false && (!cat || !hasChildren))) {
                // if(cat.color) $categories.addClass('col-' + cat.color);
                if (cat.color) $categories.css('color', cat.color_filters);

                for (var i = 0; i < cat.children.length; i++) {
                    var c = cat.children[i];

                    if (c && c.tip) {
                        var $c = $('<div class="cat" data-subCat="'+ c.id +'"><i class="far fa-chevron-right"></i>' + c.tip + '</div>');

                        if (c.children && c.children.length > 0) {
                            $c.addClass('has-children');
                        }

                        if (c.paid) {
                            $c.addClass('paid');
                            $c.append('<span class="paid"><span>Plačljiva kategorija</span>€</span>')
                        }

                        if (c.sms) {
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
            for (var j = 0; j < openCategories.length; j++) {
                openCategoriesText.push(openCategories[j].tip);
            }

            $current.html(openCategoriesText.join('<i class="far fa-chevron-right"></i>'));

            $confirm.show();
            $sub.removeClass('slide-left slide-right anim');

            selectedCategory = cat;

            return true;
        }

        $confirm.find('.btn').click(function () {
            $('#post-breadcrumbs').html($current.html());
            // showStep(paidCategory ? 3 : 4);
        });
    }

    function step3() {
        var $selector = $('#paid-post-select');
        $selector.find('.box:not(.disabled), .box.more .more-opt').click(function () {
            showStep(4);
        });
    }

    function step4() {

        $smsContainer.find('.btn').click(function () {
            if (requireSms) {
                var $input = $(this).closest('.sms').find('.input-type-phone input');
                var $prefix = $(this).closest('.sms').find('select');
                var input = $input[0];
                var v = $input.val().trim().replace(/\D/g, '');
                if ($prefix.val().replace(/\D/g, '').length === 3 && v && v.length > 7 && v.length < 10) {
                    input.setCustomValidity('');
                    window.openModal('modal-confirm-sms');
                } else {
                    $input.addClass('init');
                    input.setCustomValidity('Vnesite veljavno telefonsko številko!');
                }
            }
        });

        var $quickRegisterContainer = $('#post-register');
        $quickRegisterContainer.find('[name="quick_reg"]').change(function () {
            var on = $(this)[0].checked;
            $quickRegisterContainer.find('#quick-register').toggle(on);
            if (on) {
                $quickRegisterContainer.find('input').attr('required', 'required').prop('required', true);
            } else {
                $quickRegisterContainer.find('input').removeAttr('required').prop('required', false);
            }
        });

        $('#post-images-panel')
            .imagePanel({
                addFilesBtn: '<a class="btn oval blue">Izberi fotografije</a>',
                // apiPath: 'https://dev.oglasi.si/api/post/new/images',
                fileIdPrefix: guid,
                apiParams: {
                    postGuid: guid
                }
            });

        // $('#post-images-panel input').change(function () {
        //     if($(this).get(0).files.length > 10){
        //         console.log(3243242)
        //     }
        //
        // })


        $frm.find('[name="title"]').change(function () {
            $itemName.html($(this).val().trim());
        });

        $frm.find('[name="price"]').change(function () {
            $itemPrice.html(((Math.round($(this).val() * 100) / 100).toFixed(2) + '').replace('.', ',') + ' €');
        });


        $('#post-confirm .btn').click(function () {
            var $firstInvalid = null;
            $('#cp-page-4').find('input, textarea, select').each(function () {
                if (!$(this).addClass('init')[0].checkValidity() && $firstInvalid === null) {
                    $firstInvalid = $(this);
                }
            });

            var smsValid = $smsContainer.hasClass('sms') ? $smsContainer.hasClass('confirmed') : true;

            $smsContainer.find('input[type="phone"]')[0].setCustomValidity(smsValid ? '' : 'Potrdite telefonsko številko preko SMS-a');
            if ($firstInvalid === null && !smsValid) {
                $firstInvalid = $smsContainer;
            }

            if ($firstInvalid !== null) {
                $('html, body').animate({
                    scrollTop: $firstInvalid.offset().top - 50
                }, 500);
            } else {

                // renderCosts();
                // showStep(5);
            }
        });
    }

    var $boostContainer = $('#post-boost');
    var $payBtn = $boostContainer.find('.sum .btn');

    function step5() {

        var $paymentMethod = $boostContainer.find('.sum td.sum-pm');
        $boostContainer.find('.payment-method .head').click(function () {
            var $pm = $(this).closest('.payment-method');
            $boostContainer.find('.payment-method.active').removeClass('active');
            $(this).find('input').attr('checked', 'checked').prop('checked', true);
            $pm.addClass('active');
            $paymentMethod.html($pm.find('strong').html());
        });


        $boostContainer.find('#post-boost-optional input').change(function () {
            toPay.boost.cost = $(this)[0].checked ? 3 : 0;
            renderCosts();
        });
    }

    function renderCosts() {
        $boostContainer.find('.entry.required').toggle(toPay.paid.cost > 0);
        $boostContainer.find('.selected').remove();
        var sum = 0;
        Object.keys(toPay).forEach(function (k) {
            var tp = toPay[k];
            if (tp.cost > 0) {
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
        if (Array.isArray(children)) {
            for (var i = 0; i < children.length; i++) {
                children[i].depth = depth;
                children[i].hc = children[i].categories && children[i].categories.length > 0;
                _pc(children[i].hc ? children[i].categories : [], depth + 1);
            }
        }
    }

    _pc(window.postCategories, 0);

    $('.select').each(function () {
        $(this).select2({
            placeholder: ($(this).attr('data-placeholder') || '-'),
            minimumResultsForSearch: 8
        });

        $(this).data('select2').$container.find('.select2-selection__arrow').html('<i class="far fa-chevron-down"></i>');

        var ico = $(this).attr('data-icon');
        if (ico) {
            $(this).data('select2').$container.find('.select2-selection').addClass('has-ico').prepend('<i class="fas fa-' + ico + '"></i>');
        }
    });

    $('.checkOrCreate').click(function () {
        let values = {};
        let step = parseInt($('.create-post-page.step.active').attr('data-step')) - 1;
        let categoryId = $('.list .categories .cat.active').attr('data-subcat');

        values['step'] = step;
        values['categoryId'] = categoryId;
        $.ajax({
            url: "/nov-oglas/check-category",
            method: 'POST',
            data: values,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#categoryId').val(response.categoryId);
                $('#parentCategoryId').val(response.parentCategoryId);
                $('.post-type-1.cat-' + response.productTypes).show();
                let custFilter = response.customFilters;
                if (custFilter.length) {
                    $('#post-additional #customFilter').empty();
                    let html = '';
                    for (let i = 0; i < custFilter.length; i++) {
                        // let filterOptions = custFilter[i].filters_options;
                        html += `<div class="dd">
                            <p>${custFilter[i].naziv}</p>
                            `;

                        for (let j = 0; j < custFilter[i].filters_options.length; j++) {

                            if (custFilter[i].tip !== 'range') {
                                if (custFilter[i].tip == 'radio') {
                                    html += `
                                        <div class="post-type-1 custom-filter" style="padding-top: 10px;">
                                            <label class="ch radio">
                                                    <input type="${custFilter[i].tip}" name="custom-${custFilter[i].id}" value="${custFilter[i].filters_options[j].id}" ${custFilter[i].is_mandatory}>
                                               <span class="box"><i class="fas fa-circle"></i>
                                                            </span>
                                                <span class="text">${custFilter[i].filters_options[j].option}</span>
                                            </label>
                                        </div>`;
                                } else if (custFilter[i].tip == 'checkbox') {
                                    html += `
                                        <div class="post-type-1 custom-filter" style="padding-top: 10px;">
                                            <label class="ch">
                                                    <input type="${custFilter[i].tip}" name="custom-${custFilter[i].id}" value="${custFilter[i].filters_options[j].id}" ${custFilter[i].is_mandatory}>
                                               <span class="box">
                                                   <i class="far fa-check"></i>
                                               </span>
                                               <span class="text">${custFilter[i].filters_options[j].option}</span>
                                            </label>
                                        </div>`;
                                }
                            } else {
                                html += `
<!--                                <div class="post-type-1 custom-filter" style="padding-top: 10px;">-->
                                    <div class="input input-type-text fw custom-filter" style="padding-top: 10px;">
                                        <div class="input-inner">
                                            <input type="text" name="custom-${custFilter[i].id}" ${custFilter[i].is_mandatory}>
                                            <div class="input-decor">
                                                <i class="decor fas fa-pencil"></i>
                                                <i class="error-ico fas fa-exclamation-circle"></i>
                                            </div>
                                        </div>
                                    </div>`;
                            }

                        }
                        html += `
                           <p style="padding-top: 15px; display: none" class="error-msg error_custom-${custFilter[i].id}">Vnesite veljavno</p>
                        </div>
`
                    }
                    $('#post-additional').show();
                    $('#post-additional #customFilter').append(
                        html
                    );
                }
                if(response.showOrRedirect === 1){
                    showStep(paidCategory ? 3 : 4);
                }else if(response.showOrRedirect === 0){
                    window.location.href = window.location.origin + '/profile/packages';
                }else if(response.showOrRedirect === 2){
                    $('#status').val(0);
                    // $('a[data-modal="modal-login"]').trigger('click');
                    showStep(paidCategory ? 3 : 4);
                }

            }
        });
    })

    $('.check-region').change(function () {
        let values = {};
        values['region_id'] = $(this).val();


        $.ajax({
            url: "/nov-oglas/check-region",
            method: 'POST',
            data: values,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('.child-region').empty();
                for (let i = 0; i <= response.length; i++) {
                    $('.child-region').append("<option value='" + response[i].id + "'> " + response[i].regija + " </option>");
                }
            }
        });
    })

    $('input[name=contact_email]').change(function () {
        $('input[name=email]').val($(this).val());
    })

    $('.next').click(function (e) {
        e.preventDefault();
        let formData = new FormData();
        let form = $('#create-post-frm input, #create-post-frm textarea');
        let formSelect = $('#create-post-frm select');
        let checkedArr = [];

        for(let i = 0; i < form.length - 1; i++){
            let name =form.eq(i).attr('name');
            if (form.eq(i).attr('type') == 'checkbox'){
                    $('#create-post-frm input[name="'+ name +'"]:checked').each(function () {
                        checkedArr.push($(this).val());
                    })
                formData.append(form.eq(i).attr('name'),  checkedArr.length ? JSON.stringify(checkedArr) : '');
                checkedArr = [];
            }
            else if(form.eq(i).attr('type') == 'radio'){
                formData.append(form.eq(i).attr('name'), $('#create-post-frm input[name='+ name +']:checked').val() ? $('#create-post-frm input[name='+ name +']:checked').val() : '');
            }
            else if(form.eq(i).attr('name') === 'imgs'){
                for(let j = 0; j < uploadedFiles.length; j++) {
                    formData.append("imgs[" + j + "]", form.eq(i)[0].files[j])
                }
            }
            else{
                formData.append(form.eq(i).attr('name'), form.eq(i).val());
            }
        }
        for(let i = 0; i < formSelect.length; i++){
            formData.append(formSelect.eq(i).attr('name'), formSelect.eq(i).val());
        }
        formData.append('present', JSON.stringify(present));

        $.ajax({
            url: "/nov-oglas/store",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                let data = response.listing;
                renderCosts();
                showStep(5);

                let html = `
                    <div class="img">
                        <img
                            src="${data.image}"/>
                    </div>
                    <div class="bio">
                        <strong>${data.naslov}</strong>
                        <ul>
                            <li><i class="fas fa-info-circle"></i> ${data.parent_region}</li>
                            <li>
                                <i class="fas fa-map-marker-alt"></i> ${data.region}
                            </li>
                        </ul>
                    </div>
                    <div class="price">${data.cena} €</div>
                    <i class="far fa-bookmark"></i>
                `
                $('#card').empty().html(html);

            },
            error: (data) => {
                if(data.responseJSON.err_message){
                    $('#message_text').addClass('danger');
                    $('#message_text').append(`<p>${data.responseJSON.err_message}</p>`)
                }
                // message_text
                $('.error-msg').css({display: 'none'});
                $.each(data.responseJSON.errors, (index, value) => {
                    $('.error_' + index).css({color: 'red', display: 'block'});
                    $('.below_' + index).css({display: 'none'});
                });
            },
        });
    })

    var listFile = null

    $(document).on('click', '.rem-btn', function () {
        if (listFile == null) {
            listFile = Array.from(jQuery('input[type="file"]')[0].files);
        }
        listFile.splice(parseInt(jQuery(this).parents('.img-thmb').attr('data-index')), 1);
    })

});


