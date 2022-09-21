$(function() {

	$('.filter h3').click(function() {
		$(this).closest('.filter').toggleClass('open');
	});

	var $filterRange = $('.filter-range');
	var $filterRangeSlider = $filterRange.find('.rangeslider');

	var filterRangeMin = $filterRangeSlider.attr('data-min');
	var filterRangeFrom = filterRangeMin;
	var $filterRangeFrom = $filterRange.find('.range-input-from');

	var filterRangeMax = $filterRangeSlider.attr('data-max');
	var filterRangeTo = filterRangeMax;
	var $filterRangeTo = $filterRange.find('.range-input-to');

	$filterRangeSlider.ionRangeSlider({
		grid: false,
		drag_interval: true,
		force_edges: true,
		skin: "round",
		hide_min_max: true,
		hide_from_to: true,
		onChange: function(data) {
			$filterRangeFrom.val(data.from);
			$filterRangeTo.val(data.to);
		},
	});

	$filterRangeFrom.keyup(function() {
		_updateRangeSlide(this.value.replace(/[^\d]+/, ''), filterRangeTo);
	});


	$filterRangeTo.keyup(function() {
		_updateRangeSlide(filterRangeFrom, this.value.replace(/[^\d]+/, ''));
	});

	function _updateRangeSlide(from, to) {

		if($.isNumeric(from) && $.isNumeric(to)) {

			var reverse = from > to;

			filterRangeFrom = reverse ? to : from;
			if(filterRangeFrom < 0 || !filterRangeFrom) filterRangeFrom = 0;

			filterRangeTo = reverse ? from : to;
			console.log(filterRangeTo);
			console.log(filterRangeMax);
			if(filterRangeTo > filterRangeMax) filterRangeTo = filterRangeMax;

			$filterRangeSlider.data('ionRangeSlider').update({
				from: filterRangeFrom,
				to: filterRangeTo
			});

			$filterRangeFrom.val(filterRangeFrom);
			$filterRangeTo.val(filterRangeTo);
		}
	}

});
