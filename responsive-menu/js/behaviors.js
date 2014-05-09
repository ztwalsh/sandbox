$(document).ready(function() {
	// Set fade speed
	var fade_speed = 150;

	// Add icons to any items with a sub menu
	$('a').each(function () {
		if ($(this).next().is('ul')) {
			var linkContent = $(this).text();
			$(this).html(linkContent + '<i class="fa fa-chevron-right"></i>');
		} else {

		}
	});

	// Mobile menu icon behavior
	$('.mobile-nav a').click(function() {
		if ($(this).hasClass('on')) {
			$(this).html('<i class="fa fa-bars"></i>');
			$(this).removeClass('on');
			$('nav').fadeOut(fade_speed, function() {
				$('.subnavigation-layer').remove();
			});
			$('header').css({position: 'static'});
		} else {
			$(this).html('<i class="fa fa-times"></i>');
			$(this).addClass('on');
			$('nav').fadeIn(fade_speed);
			$('header').css({position: 'fixed'});
		}
		return false;
	});

	// Navigation click tree
	$(document).on('click', 'nav a', function(event) {
		if ($(this).next().is('ul')) {
			event.preventDefault;

			// Create overlay layer with menu options
			var sub_list =  $(this).next('ul').html();
			var category_link = $(this).attr('href');
			var category_name = $(this).text();
			var sub_header = '<div class="menu-header cf"><a class="back" href="#"><i class="fa fa-chevron-left"></i> Back</a> <a class="all" href="' + category_link + '">See All ' + category_name + ' <i class="fa fa-chevron-right"></i></a></div>';
			var menu_list = '<div class="subnavigation-layer">' + sub_header + '<div class="scroll"><ul class="subnavigation">' + sub_list + '</ul></div></div>';
			//var menu_list = '<div class="subnavigation-layer"></div>';

			// Insert it in nav
			//$('nav').append(menu_list).hide().fadeIn(50);
			$(menu_list).hide().appendTo('nav').fadeIn(fade_speed);
		} else {
			href = $(this).attr('href');
			window.location = href;
		}
		return false;
	});

	// Back button
	$(document).on('click', 'a.back', function(event) {
		event.preventDefault;
		$(this).closest('.subnavigation-layer').fadeOut(fade_speed, function() {
			$(this).remove();
		});
		return false;
	});
});