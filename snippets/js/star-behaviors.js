$(document).ready(function() {
	$('.v1-wrapper').click(function() {
		$(this).children('.v1-histogram').fadeToggle(100);
		return false;
	});

	$('html').click(function() {
		$('.v1-histogram').fadeOut(200);
	});

	$('.v1-histogram').click(function(event){
		event.stopPropagation();
	});
});