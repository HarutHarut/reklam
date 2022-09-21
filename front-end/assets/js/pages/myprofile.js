$(function() {

	$('.circle-progress > div').circleProgress({
		size: 86,
		lineCap: 'round',
		fill: '#EFA00B',
		startAngle: -1.55,
		emptyFill: 'rgba(0,0,0,0)'
	});

	$('body').on('change', '.select-all input[type="checkbox"]', function() {
		$('#' + $(this).attr('name')).find('input[type="checkbox"]').prop('checked', $(this)[0].checked);
	});
});
