$(document).ready(function () {
  $('.primary-card:first-child').addClass('show');

  $('.next-btn').click(function() {
    $('.show').fadeOut(100, function() {
      $(this).delay(500).next().addClass('show');
    });
    $(this).text('No Comment, Next');
    var count = parseInt($('.today').text());
    var new_count = count + 1;
    $('.today').text(new_count);
    return false;
  });

  $('.escalate-btn').click(function() {
    $('.escalate').fadeIn(100);
    $('.close').click(function(){
      $('.escalate').fadeOut(100);
      return false;
    });
    return false;
  });

  $('.product-more').click(function() {
    $('.product-content').slideToggle(250);
    if ($(this).hasClass('expanded')) {
      $(this).html('<i class="fa fa-plus-square-o" aria-hidden="true"></i> More Info');
      $(this).removeClass('expanded');
    } else {
      $(this).html('<i class="fa fa-minus-square-o" aria-hidden="true"></i> Less Info');
      $(this).addClass('expanded');
    }
    return false;
  });

  $('a.option').click(function() {
    $(this).toggleClass('on');
    $(this).parent().siblings('.next-btn').text('I\'m Done, Next');
    return false;
  });

  var s = $('.stick');
  var pos = s.position();
  $(window).scroll(function() {
      var windowpos = $(window).scrollTop();
      if (windowpos >= pos.top + 128) {
          s.addClass('stick-on');
      } else {
          s.removeClass('stick-on');
      }
  });
});
