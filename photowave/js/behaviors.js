$(document).ready(function() {
	var scroll_pos = 0;
  $(document).scroll(function() { 
      scroll_pos = $(this).scrollTop();
      if(scroll_pos > 200) {
          $('nav').addClass('light');
					$('nav.override').addClass('swap');
					$('nav.override').removeClass('override');
      } else {
          $('nav').removeClass('light');
					$('nav.swap').addClass('override');
					$('nav.swap').removeClass('swap');
      }
  });
});