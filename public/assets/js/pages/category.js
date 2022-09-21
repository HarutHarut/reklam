$(function () {

    $('.filter h3').click(function () {
        $(this).closest('.filter').toggleClass('open');
    });

    $('.filter input').change(function () {
        let color = $('#filter-controls button').attr('data-color');
        // $('#filter-controls button').removeClass('active');
        $('#filter-controls button').css({
            'background-color': color,
            'pointer-events': 'auto'
        });
    });

    let $filterRange = $('.filter-range');
    let $filterRangeSlider = '';
    let $filterRangeFrom = '';
    let $filterRangeTo = '';
    let filterRangeMin = '';
    let filterRangeMax = '';
    let filterRangeFrom = '';
    let filterRangeTo = '';

    for (let i = 0; i <= $filterRange.length - 1; i++) {

        $filterRangeSlider = $filterRange.eq(i).find('.rangeslider');
        $filterRangeSlider.change(function () {
            filterRangeMin = $(this).attr('data-min');
            filterRangeFrom = filterRangeMin;
            $filterRangeFrom = $(this).next('.range-input').find('.range-input-from');
            filterRangeMax = $(this).attr('data-max');
            filterRangeTo = filterRangeMax;
            $filterRangeTo = $(this).next('.range-input').find('.range-input-to');

        })

        $filterRangeSlider.ionRangeSlider({
            grid: false,
            drag_interval: true,
            force_edges: true,
            skin: "round",
            hide_min_max: true,
            hide_from_to: true,
            onChange: function (data) {
                $filterRangeFrom.val(data.from);
                $filterRangeTo.val(data.to);
            },
        });
    }

    $('.range-input .range-input-from').change(function () {
        let filterRangeTo1 = $(this).next().val();
        _updateRangeSlide(this.value.replace(/[^\d]+/, ''), filterRangeTo1, $(this));
    });


    $('.range-input .range-input-to').change(function () {
        let filterRangeFrom1 = $(this).prev().val();
        _updateRangeSlide(filterRangeFrom1, this.value.replace(/[^\d]+/, ''), $(this));
    });

    function _updateRangeSlide(from, to, el) {

        if ($.isNumeric(from) && $.isNumeric(to)) {
            let reverse = parseInt(from) > parseInt(to);
            let $filterRangeSlider1 = el.parents('.range-input').prev();
            let filterRangeFrom2 = reverse ? to : from;

            if (parseInt(filterRangeFrom2) < 0 || !filterRangeFrom2) filterRangeFrom2 = 0;
            let filterRangeTo2 = reverse ? from : to;
            let filterRangeMax2 = el.parents('.range-input').prev().attr('data-max');

            if (parseInt(filterRangeTo2) > parseInt(filterRangeMax2)) filterRangeTo2 = filterRangeMax2;

            $filterRangeSlider1.data('ionRangeSlider').update({
                from: filterRangeFrom2,
                to: filterRangeTo2
            });

            // el.val(filterRangeFrom2);
            // el.val(filterRangeTo2);
        }
    }

    self.queryParams = {
        page: 1,
        searchQuery: '',
        sortType: [],
        customer_id: [],
        regions: [],
        productType: [],
        priceRange: [],
        custom_filters: [],
        dontShowFilter: '',
    };

    function _getCustomFilters() {
        let val = [];
        let customFilters = {};
        let name = '';

        for (let i = 0; i <= $('.filter .custom-filter').length - 1; i++) {

            if($('.filter .custom-filter').eq(i).find('input').attr('type') !== 'hidden') {
                name = $('.filter .custom-filter').eq(i).find('input').attr('name');
                $('.filter .custom-filter').eq(i).find('input:checked').each(function () {
                    let value = $(this).val();

                    val.push(value);

                });
                customFilters[name] = val;
                val = []
            } else {
                name = $('.filter .custom-filter').eq(i).find('input[type="hidden"]').attr('name');
                let rangeVal = $('.filter .custom-filter').eq(i).find('.rangeslider').val();
                customFilters[name] = rangeVal;
                // console.log($('.filter .custom-filter').eq(i).find('input[type="hidden"]').attr('name'), 'rangeVal');
            }
        }

        return customFilters;
    }

    function _getRegionFilters() {
        let regions = [];
        $('.filter .regions-filter input:checked').each(function () {
            regions.push($(this).val());
        });
        return regions;
    }

    function _getProductTypeFilters() {
        let productType = [];
        $('.filter .productType-filter input:checked').each(function () {
            productType.push($(this).val());
        });
        return productType;
    }

    function _getPriceRangeFilters() {
        return $('input[name="price"]').val() ?? '';
    }

    function _getDontShowFilters() {
        return $('input[name="dontShowFilter"]').val() ?? '';
    }

    function _getSortTypeFilters() {
        return $('.sort-filter select').val();
    }

    function _getCategoryFilters() {
        return $('input[name="categoryPage"]').val() ?? false
    }

    function _getSearchFilters() {
        return $('#searchQuery').val() ?? false;
        // return $('.searchQuery input[name="searchQuery"]').val() ?? false
    }

    function _getCustomerFilters() {
        return $('.search input[name="customer_id"]').val() ?? [];
    }

    self.buildQueryString = function () {
        let queryString = '';
        let loopStart = true;
        $.each(self.queryParams, function (key, value) {

            if (!loopStart) {
                queryString += '&';
            }
            if (typeof value == "object") {
                value = JSON.stringify(value);
            }

            queryString += `${key}=${value}`;
            loopStart = false
        });

        return queryString;
    };

    function sendRequest() {

        if ($('.sort-filter input[name="customer_id"]').val() && $('.sort-filter input[name="customer_id"]').val() !== undefined) {
            self.queryParams.customer_id = $('.sort-filter input[name="customer_id"]').val();
        }
        let urlWithOutParameters = window.location.origin + window.location.pathname;
        $.ajax({
            url: "/search/products" + '?' + self.buildQueryString(),
            method: 'GET',
            datatype: 'html',
            success: function (response) {
                window.location.href = urlWithOutParameters + '?' + self.buildQueryString();
            }
        }).then(function () {
            $.ajax({
                url: "/search/categories" + '?' + self.buildQueryString(),
                method: 'GET',
                success: function (categoriesResponse) {
                    $('#searchResultCategories').empty().html(categoriesResponse);
                }
            })
        });
    }

    function getSearchResult() {
        self.queryParams.customer_id = $('.search input[name="customer_id"]').val();

        $.ajax({
            url: "/search/company-products" + '?' + self.buildQueryString(),
            method: 'GET',
            success: function (response) {
                $('#result').empty().html(response);
            }
        });
    }


    $('.sort-filter select').change(function () {
        $('#filter-controls button.update').trigger('click');
    })

    $('#searchQueryButton').click(function () {
        self.queryParams.searchQuery = $('#searchQueryButton').prev('input').val();
        getSearchResult();
    })

    $('#sortFilter').change(function () {
        self.queryParams.sortType = $('#sortFilter').val();

        getSearchResult();
    })

    $('#filter-controls button.update').click(function () {
        self.queryParams.regions = _getRegionFilters();
        self.queryParams.productType = _getProductTypeFilters();
        if (_getSearchFilters()) {
            self.queryParams.searchQuery = _getSearchFilters();
        }
        if (_getCustomerFilters()) {
            self.queryParams.customer_id = _getCustomerFilters();
        }
        if (_getDontShowFilters()) {
            self.queryParams.dontShowFilter = _getDontShowFilters();
        }
        if (_getCustomFilters()) {
            self.queryParams.custom_filters = _getCustomFilters();
        }
        self.queryParams.priceRange = _getPriceRangeFilters();
        self.queryParams.sortType = _getSortTypeFilters();
        if (_getCategoryFilters()) {
            self.queryParams.category = _getCategoryFilters();
        }
        console.log(self.queryParams)
        self.queryParams.page = 1;
        sendRequest();
    })

    $('.filter-checklist input').change(function () {
        let color = $(this).next('span').attr('data-color');
        if ($(this).attr('type') === 'radio') {
            $('.filter-checklist input[type="radio"] ~ span').css('background-color', '#fff');
            $(this).next('span').css('background-color', color)
        } else {
            if ($(this).is(':checked')) {
                $(this).next('span').css('background-color', color)
            } else {
                $(this).next('span').css('background-color', '#fff')
            }
        }
    })


    $('.filter-checklist input:checked').each(function () {
        let color = $(this).next('span').attr('data-color');
        if ($(this).attr('type') === 'radio') {
            $('.filter-checklist input[type="radio"] ~ span').css('background-color', '#fff');
            $(this).next('span').css('background-color', color)
        } else {
            if ($(this).is(':checked')) {
                $(this).next('span').css('background-color', color)
            } else {
                $(this).next('span').css('background-color', '#fff')
            }
        }
    })


    $(document).delegate('.pagination a', 'click', function (e) {
        e.preventDefault();

        let page = parseInt($(this).text());
        self.queryParams.page = 1;
        if ($(this).hasClass('text')) {
            // let activePage = parseInt($('.pagination a.active').text());
            page = parseInt($('.pagination a.active').text());

            let pagination = $(this).text().trim();

            if (pagination === 'Prejšnja stran') {
                if (page !== 1) {
                    page = page - 1
                }
            } else if (pagination === 'Naslednja stran') {
                page = parseInt($('.pagination a.active').text())

                if (page !== $('.pagination a').length - 3) {
                    page = page + 1;
                }
            }
        } else {
            self.queryParams.page = page;
        }

        if (_getCustomerFilters()) {
            self.queryParams.customer_id = _getCustomerFilters();
            self.queryParams.dontShowFilter = 1;
        }
        self.queryParams.regions = _getRegionFilters();
        self.queryParams.productType = _getProductTypeFilters();
        if (_getSearchFilters()) {
            self.queryParams.searchQuery = _getSearchFilters();
        }
        if (_getCustomFilters()) {
            self.queryParams.custom_filters = _getCustomFilters();
        }
        self.queryParams.priceRange = _getPriceRangeFilters();
        self.queryParams.sortType = _getSortTypeFilters();


        if (_getCategoryFilters()) {
            self.queryParams.category = _getCategoryFilters();
        }

        let urlWithOutParameters = window.location.origin + window.location.pathname;
        window.location.href = urlWithOutParameters + '?' + self.buildQueryString();
    })
});
