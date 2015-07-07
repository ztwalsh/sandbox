$(document).ready(function() {
	$('.widget-body').delay(800).slideToggle(150);

	$('.widget-header').click(function() {
		$(this).next().slideToggle(150);
		$(this).toggleClass('on');
	});
});