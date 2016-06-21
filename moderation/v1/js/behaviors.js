$(document).ready(function () {
  $('.escalate-btn').click(function() {
    var escalate_options = '<div class="escalate" style="display: none;"><div class="wrapper"><a href="#" class="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div></div>';
    $('.wrapper').prepend(escalate_options);
    $('.escalate').fadeIn();
    $('.close').click(function(){
      $('.escalate').fadeOut();
      return false;
    });
    return false;
  });


  $('.next-btn').click(function() {
    $('.primary-card').animate({right: '-100%'}, 20);
    var count = parseInt($('.count-number').text());
    var new_count = count + 1;
    $('.count-number').text(new_count);
    return false;
  });


  $('.product-more').click(function() {
    $('.product-content').slideToggle(250);
    if ($(this).hasClass('expanded')) {
      $(this).html('<i class="fa fa-plus-square-o" aria-hidden="true"></i> Less Info');
      $(this).removeClass('expanded');
    } else {
      $(this).html('<i class="fa fa-minus-square-o" aria-hidden="true"></i> Less Info');
      $(this).addClass('expanded');
    }
    return false;
  });

  $('a.option').click(function() {
    $(this).toggleClass('on');
    return false;
  });
});
