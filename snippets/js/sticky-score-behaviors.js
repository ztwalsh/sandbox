$(document).ready(function() {
	function checkRange(x, n, m) {
	    if (x >= n && x <= m) {
	    	return x;
	    } else {
	    	return !x;
	    }
	}

	$('.v1-wrapper').delay(1000).queue(function(next){
		var percentage = $('.v1-inner-score').text();

		switch (percentage) {
			case checkRange(percentage, 0, 0):
				$(this).addClass('dead');
				break;
			case checkRange(percentage, 1, 2):
				$(this).addClass('danger');
				break;
			case checkRange(percentage, 3, 3):
				$(this).addClass('ok');
				break;
			case checkRange(percentage, 4, 5):
				$(this).addClass('good');
				break;
		}
	});
});
