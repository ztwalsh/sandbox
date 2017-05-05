$(document).ready(function () {
  $(window).scroll(function() {
    $('.mfb-body').delay(2000).queue(function(next){
      $(this).addClass('enabled');
      $('.mfb-answer > a').click(function() {
        $('.mfb-body').height($('.mfb-body').height());
    		$('.mfb-body').html('<div class="success"><img src="images/checkmark.png" class="success-icon" width="auto" height="auto" /></div>');
        $('.success-icon').delay(200).queue(function(next){
    			$(this).addClass('open');
    			$(this).after($('<span class="mfb-head-03">Thank you!</span><br /><span class="mfb-head-01">Enjoy your shopping</span>').fadeIn(500));
    			setTimeout(function () {
    	        $('.enabled').removeClass('enabled');
    	    }, 3000);
    		});

        return false;
      });
    });
  });
});
