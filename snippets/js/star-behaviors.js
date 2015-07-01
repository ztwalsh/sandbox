$(document).ready(function() {
	$('.v1-summary').click(function() {
		$(this).next().fadeToggle(100);
		return false;
	});

	$('html').click(function() {
		$('.v1-histogram').fadeOut(200);
	});

	$('.v1-histogram').click(function(event){
		event.stopPropagation();
	});
});