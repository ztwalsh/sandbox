$(document).ready(function () {
  $(window).scroll(function() {
    $('.mfb-body').delay(2000).queue(function(next){
      $(this).addClass('enabled');
    });
  });
  $('.mfb-answer > a').click(function() {
    $('.mfb-body').height($('.mfb-body').height());
		$('.mfb-body').html('<div class="success"><img src="images/checkmark.jpg" class="success-icon" width="auto" height="auto" /></div>');
    $('.success-icon').delay(200).queue(function(next){
			$(this).addClass('open');
			$(this).after($('<h3>Thanks for your feedback!</h3>').fadeIn(500));
			setTimeout(function () {
	        $('.mfb-body').fadeOut(100);
	    }, 3000);
		});

    return false;
  });
});
