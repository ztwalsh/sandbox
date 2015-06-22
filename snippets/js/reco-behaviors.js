$(document).ready(function() {
	function checkRange(x, n, m) {
	    if (x >= n && x <= m) { 
	    	return x;
	    } else { 
	    	return !x;
	    }
	}

	$('.count').each(function () {
	    $(this).prop('Counter',0).animate({
	        Counter: $(this).text()
	    }, {
	        duration: 1000,
	        easing: 'swing',
	        step: function (now) {
	            $(this).text(Math.ceil(now));
	        }
	    });
	});

	$('.v1-percentage, .v2-circle').delay(1000).queue(function(next){
		var percentage = $(this).children('.count').text();

		switch (percentage) {
			case checkRange(percentage, 0, 0):
				$(this).addClass('grey');
				break;
			case checkRange(percentage, 1, 30):
				$(this).addClass('dark-red');
				break;
			case checkRange(percentage, 31, 60):
				$(this).addClass('light-red');
				break;
			case checkRange(percentage, 61, 70):
				$(this).addClass('orange');
				break;
			case checkRange(percentage, 71, 85):
				$(this).addClass('yellow');
				break;
			case checkRange(percentage, 86, 94):
				$(this).addClass('light-green');
				break;
			case checkRange(percentage, 95, 100):
				$(this).addClass('dark-green');
				break;
		}
	});
});