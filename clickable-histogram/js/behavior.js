$(document).ready(function() {
	$('div.column').click(function() {
		var column_clicked 	= $(this).attr('id');
		var breadcrumb 		= '<h5><a href="#">Showing ' + column_clicked + '-Star Reviews <i class="fa fa-times-circle"></i></a></h5>';
		var show_reviews	=  column_clicked + '-star';

		$(this).parent().children().removeClass('off');
		$(this).parent().children().not(this).addClass('off');
		$('#filter-feedback').html(breadcrumb);

		$('html, body').animate({
	        scrollTop: $('#filter-feedback').offset().top
	    }, 500);

		$('#reviews').children().hide();
	    $('.' + show_reviews).show();

		$('#filter-feedback h5 a').click(function() {
			$(this).parent().remove();
			$('.off').removeClass('off');
			$('#reviews').children().show();
			return false;
		});
	});
	$('tr.distro-bar').click(function() {
		var column_clicked 	= $(this).attr('id');
		var breadcrumb 		= '<h5><a href="#">Showing ' + column_clicked + '-Star Reviews <i class="fa fa-times-circle"></i></a></h5>';
		var show_reviews	=  column_clicked + '-star';

		$(this).parent().children().removeClass('off');
		$('td.bar').removeClass('on');
		$(this).parent().children().not(this).addClass('off');
		$(this).children('td.bar').addClass('on');
		$('#filter-feedback').html(breadcrumb);

		$('html, body').animate({
	        scrollTop: $('#filter-feedback').offset().top
	    }, 500);

	    $('#reviews').children().hide();
	    $('.' + show_reviews).show();

		$('#filter-feedback h5 a').click(function() {
			$(this).parent().remove();
			$('.off').removeClass('off');
			$('.on').removeClass('on');
			$('#reviews').children().show();
			return false;
		});
	});

	$('.collapse h3').click(function() {
		var browser_window = $(window).width();
		if(browser_window < 600) {
			$(this).next('ul').slideToggle(200);
		} else {

		}
	});

	$(window).resize(function() {
		if(this.width() > 600) {
			$('.collapse ul').fadeIn(200);
		} else {
			
		}
	});
});