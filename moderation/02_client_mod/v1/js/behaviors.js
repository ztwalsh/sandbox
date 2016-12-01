$(document).ready(function () {
  // Reveal Button behaviors
  $('.btn-reveal').click(function() {
    if ($(this).hasClass('open')) {
      $(this).removeClass('open');
    } else {
      $(this).addClass('open');
    }
    return false;
  });

  // Expand Filter Panel
  $('.add-filters').click(function() {
    $('.panel').slideToggle(150);
    return false;
  });

  // Expand Product Info
  $('.product-more').click(function() {
    $('.product-bottom').slideToggle(150);
    return false;
  });

  // Expand Meta Info
  $('.ugc-more').click(function() {
    $(this).next('.content-meta').slideToggle(150);
    return false;
  });

  $('.card select, .card textarea').click(function() {
    alert($(this).closest('.card').childern('.save').addClass('on'));
  });

  $('#list .save').click(function() {
    $(this).parent().parent().prepend('<div class="msg-success"><i class="fa fa-check" aria-hidden="true"></i> This review has been updated</div>');
    return false;
  });

  $('#single .save').click(function() {
    alert('Fuck it all!!!');
  });


  $('select').on('change', function() {
    var btn = $(this).attr('data');
    $('#' + btn).html('Save');
  });

  $('select').on('change', function() {
    var btn = $(this).attr('state');
    $('#' + btn).removeClass('disabled');
  });
});
