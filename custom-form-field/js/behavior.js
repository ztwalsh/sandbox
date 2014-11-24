$(document).ready(function() {
	var select 			= $('select option:first-child').text();
	var select_button 	= '<div class="select-button">' + select + ' <i class="fa fa-chevron-down"></i></div>';
	var select_options 	= '';

	$('select option').each(function( index ) {
		select_options	+= '<span id="' + index + '">' + $(this).text() + '</span>';
	});

	select_options = '<div class="select-list">' + select_options + '</div>';

	$('select').after(select_button + select_options);

	$('.select-button').click(function() {
		$(this).next().fadeToggle(25);
	});
});