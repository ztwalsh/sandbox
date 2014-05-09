$(document).ready(function() {
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
			$('nav').fadeOut(100, function() {
				$('.subnavigation-layer').remove();
			});
		} else {
			$(this).html('<i class="fa fa-times"></i>');
			$(this).addClass('on');
			$('nav').fadeIn(100);
		}
		return false;
	});

	// Navigation click function
	/*$(document).on('click', 'nav a', function(event) {
		if ($(this).next().is('ul')) {
			event.preventDefault;
			$(this).closest('ul').fadeOut(100);

			// Create nav header
			var category_link = $(this).attr('href');
			var category_name = $(this).text();
			var sub_header = '<a class="back" href="#"><i class="fa fa-chevron-left"></i> Back</a> <a class="all" href="' + category_link + '">See All ' + category_name + ' <i class="fa fa-chevron-right"></i></a>';
			$('.menu-head').html(sub_header);

			// Show sub nav
			// take out the nav-container from the mark up. add it in on click height 100% position absolute. layerthem on. "back" closes each created layer
			//$('.nav-container').append(sub_list);
			var sub_list =  $(this).next('ul');
			var menu_list = '<div class="nav-container">' + sub_list + '</div>';
			$('nav').prepend(menu_list);
		} else {
			href = $(this).attr('href');
			window.location = href;
		}
		return false;
	});*/


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
			$('nav').append(menu_list).hide().fadeIn(50);
		} else {
			href = $(this).attr('href');
			window.location = href;
		}
		return false;
	});

	// Back button
	$(document).on('click', 'a.back', function() {
		$(this).closest('.subnavigation-layer').fadeOut(50, function() {
			$(this).remove();
		});
		return false;
	});
});