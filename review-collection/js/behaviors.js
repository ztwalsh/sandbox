$(document).ready(function() {
  var imagesPreview = function(input, location) {
    if (input.files) {
      var filesAmount = input.files.length;
      var count = 1;

      for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function(event) {
          //$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
          var html_image = '<div class="image cf"><div class="thumbnail"><img src="' + event.target.result + '" alt="" /><a class="remove" href="#"><i class="fa fa-times"></i></a></div><input class="text caption" name="caption" type="text" value="" placeholder="Add a Caption (Optional)" /></div>';
          $(html_image).appendTo(location);

          $('.remove').click(function() {
            $(this).parent().parent().fadeOut(200, function() {
              $(this).remove();
              if ($('.image').length){
              } else {
                $('#submit').remove();
                $('#step-info').html('<h1 class="heading-1">Share a Photo</h1><h3 class="heading-4 small">Photos help future shoppers make decisions on what they buy.</h3>');
                $('#images').html('<input type="file" class="file" multiple id="add-media"><label for="add-media" class="secondary action add-image"><p><img class="empty" src="images/image-placeholder.png" /></p><p><span class="btn-primary full">Find or Take a Photo</span></p></label>');
              }
            });
            return false;
          });
        }
        reader.readAsDataURL(input.files[i]);
        count++;
      }
    }
  }

  $('#add-media').on('change', function() {
      $('#step-info').html('<h1 class="heading-1">Add a Caption</h1><h3 class="heading-4 small">Point out what we should be looking at.</h3>');
      $('#images').html('');
      imagesPreview(this, '#images');
      $('<input type="submit" name="submit" id="submit" class="btn-primary full" />').appendTo('form');
  });

  // ORIGNAL IMAGE UPLOAD
  function readURL(input) {
  	if (input.files && input.files[0]) {
    	var reader = new FileReader();

    	reader.onload = function (e) {
      	var file = e.target.result;
      	var html_image = '<div class="uploaded_image cf"><img class="file_placeholder" src="' + file + '" alt="" /><input class="text caption" name="caption" type="text" value="" placeholder="write a caption" /><a class="trash" href="#"><i class="fa fa-trash-o"></i></a></div>';
      	$(html_image).insertBefore($('.file_original'));

      	$('a.trash').click(function() {
      		$(this).closest('.uploaded_image').remove();
      		return false;
      	});
    	}

    	reader.readAsDataURL(input.files[0]);
  	}
	}

	$("input.file_original").change(function(){
    readURL(this);
	});


  $('input[type=radio]').change(function() {
		var tmp=$(this).attr('name');
    	$('input[name="'+tmp+'"]').parent('label').removeClass('selected');
		$(this).closest('label').toggleClass('selected', this.selected);
	});

  $('.btn-primary').click(function() {
    $(this).val('<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>');
  });

  // Rating Text
	$('.rating input[type=radio]').click(function() {
		var selection = $('.rating input[type=radio]:checked').attr('id');

		if (selection == 'star_1') {
			var rating_text = 'Not good.';
		} else if (selection == 'star_2') {
			var rating_text = 'Nothing special.';
		} else if (selection == 'star_3') {
			var rating_text = 'Average, ordinary.';
		} else if (selection == 'star_4') {
			var rating_text = 'Good stuff.';
		} else if (selection == 'star_5') {
			var rating_text = 'Perfect! Doesn\'t get better.';
		}

		$('.rating-text').text(rating_text);
	});

  // Rating Text
	$('.star').hover(function() {
		var selection = $(this).children('input').attr('id');

		if (selection == 'star_1') {
			var rating_text = 'Not good.';
		} else if (selection == 'star_2') {
			var rating_text = 'Nothing special.';
		} else if (selection == 'star_3') {
			var rating_text = 'Average, ordinary.';
		} else if (selection == 'star_4') {
			var rating_text = 'Good stuff.';
		} else if (selection == 'star_5') {
			var rating_text = 'Perfect! Doesn\'t get better.';
		}

		$('.rating-text').text(rating_text);
	});
});
