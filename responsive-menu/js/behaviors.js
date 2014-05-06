$(document).ready(function() {
	$('a').each(function () {
		if ($(this).next().is('ul')) {
			var linkContent = $(this).text();
			$(this).html(linkContent + '<i class="fa fa-chevron-right"></i>');
		} else {

		}
	});
	// Mobile menu icon
	$('.mobile-nav a').click(function() {
		if ($(this).hasClass('on')) {
			$(this).html('<i class="fa fa-bars"></i>');
			$(this).removeClass('on');
			$('ul.child').fadeOut(100);
			$('nav').fadeOut(100);
		} else {
			$(this).html('<i class="fa fa-times"></i>');
			$(this).addClass('on');
			$('nav').fadeIn(100);
		}
		return false;
	});

	// Navigation
	$('nav a').click(function(event) {
		// If the link has beed clicked, check to see if there is a <ul> next
		if ($(this).next().is('ul')) {
			// If there is a <ul>, stop the link and show the <ul>
			event.preventDefault;
			$(this).next('ul').fadeIn(100);
		} else {
			// Allow the link to go to the href
			href = $(this).attr('href');
			window.location = href;
		}

		// If the link has already been clicked and there is a list nav
		if ($(this).next('ul').children().hasClass('list-head')) {
			// Do nothing
		} else {
			// Create a list nav at the top to navigate back or close the menu
			category = $(this).text();
			link = $(this).attr('href');
			$(this).next('ul').prepend('<li class="list-head cf"><a class="back" href="#"><i class="fa fa-chevron-left"></i> Back</a> <a class="see-all" href="' + link + '">See all ' + category + '</a></li>');
			$('.list-head').next('li').addClass('second');
		}

		// Close the parent menu when clicking back
		$('a.back').click(function() {
			$(this).parent().parent('ul').fadeOut(100);
			return false;
		});

		// Close all menus when clicking close
		$('a.close').click(function() {
			$('ul.child').fadeOut(100);
			$('nav').fadeOut(100);
			return false;
		});
		
		return false;
	});
});