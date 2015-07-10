$(document).ready(function() {
	// Highlighted Radio
	$('input[type=radio]').change(function() {
		var tmp = $(this).attr('name');
    	$('input[name="'+tmp+'"]').parent('label').removeClass('selected');
		$(this).closest('label').toggleClass('selected', this.selected);
	});

	$('label.star').click(function() {
		$('.hidden').slideDown(100);
	});

	$('.close').click(function() {
		$('.widget-wrapper').fadeOut(100);
	});

	// Submit a review
	$('button.primary').click(function (event) {
		event.preventDefault();

		if ($('#headline').val() == '') {

		}
		$('.widget-body').height($('.widget-body').height());
		$('.widget-body').html('<div class="success"><img src="images/checkmark.jpg" class="success-icon" /></div>');
		$('.success-icon').delay(200).queue(function(next){
			$(this).addClass('open');
			$(this).after($('<h3>Thank you for your feedback!</h3>').fadeIn(500));
			setTimeout(function () {
	        $('.widget-wrapper').fadeOut(100);
	    }, 3000);
		});
	});
});
