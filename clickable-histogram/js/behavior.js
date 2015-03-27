$(document).ready(function() {
	$('tr.distro-bar').click(function() {
		if ($(this).hasClass('on')) {
			$('.filter').fadeOut(50);
			$('.off').removeClass('off');
			$('.on').removeClass('on');
			$('#reviews').children().show();
			$('.divider-count').text('Reviewed by 44 customers');
			$('html, body').animate({
		        scrollTop: $('#buckets').offset().top
		    }, 500);
			return false;
		} else {
			var column_clicked 	= $(this).attr('id');
			var breadcrumb_val	= $(this).children('.rating').text();
			var open			= '<div class="filter">';
			var headline		= '<h4>Showing reviews tagged as:<a href="#">Clear all filters</a></h4>';
			var breadcrumb 		= '<a href="#"><span><i class="fa fa-times"></i></span> ' + breadcrumb_val + '</a>';
			var close 			= '</div>';
			var show_reviews	= column_clicked + '-star';
			var review_count 	= $(this).children('.count').text();
			var filter_options	= open + headline + breadcrumb + close;

			$(this).parent().children().removeClass('off');
			$('td .bar').removeClass('on');
			$(this).parent().children().not(this).addClass('off');
			$('.on').removeClass('on');
			$(this).addClass('on');
			$('#filter-feedback').html($(filter_options).fadeIn(50));
			$('.divider-count').text('Showing ' + review_count + ' out of 44 reviews');


			$('html, body').animate({
		        scrollTop: $('#filter-feedback').offset().top
		    }, 500);

		    $('#reviews').children().hide();
		    $('.' + show_reviews).show();

			$('.filter > a, .filter h4 a').click(function() {
				$('.filter').fadeOut(50);
				$('.off').removeClass('off');
				$('.on').removeClass('on');
				$('#reviews').children().show();
				$('.divider-count').text('Reviewed by 44 customers');
				$('html, body').animate({
			        scrollTop: $('#buckets').offset().top
			    }, 500);
				return false;
			});
		}
	});

	$('.collapse h3').click(function() {
		var browser_window = $(window).width();
		if(browser_window < 600) {
			$(this).next('ul').slideToggle(200);
		} else {

		}

		if($(this).children('i').hasClass('selected')) {
			$(this).children('i').removeClass('selected');
		} else {
			$(this).children('i').addClass('selected');
		}
	});

	$(window).resize(function() {
		if(this.width() > 600) {
			$('.collapse ul').fadeIn(200);
		} else {
			
		}
	});
});