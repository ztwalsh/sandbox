$(document).ready(function() {
  var imagesPreview = function(input, location) {
      if (input.files) {
        var filesAmount = input.files.length;
        var count = 1;

        for (i = 0; i < filesAmount; i++) {
          var reader = new FileReader();

          reader.onload = function(event) {
            //$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
            var html_image = '<div class="image cf"><div class="thumbnail"><img src="' + event.target.result + '" alt="" /></div><input class="text caption" type="text" value="" placeholder="Add a Caption (Optional)" /><a class="remove" href="#"><i class="fa fa-times"></i></a></div>';
            html_image += '<input name="image-' + count + '" type="hidden" value="' + event.target.result + '" />';
            $(html_image).appendTo(location);

            $('.remove').click(function() {
              $(this).parent().fadeOut(200, function() {
                $(this).remove();
                if ($('.image').length){
                  alert('no');
                } else {
                  $('#submit').remove();
                  $('#step-info').html('<h1 class="heading-1">Add a Photo</h1><h3 class="heading-4 small">Your photos help future shoppers make decisions on what they buy.</h3>');
                  $('#images').html('<input type="file" class="file" multiple id="add-media"><label for="add-media" class="secondary action add-image"><p><img class="empty" src="images/image-placeholder.png" /></p><p><span class="btn-primary full">Find Photos or Videos</span></p></label>');
                }
              });
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
        $('<a id="submit" class="btn-primary full" href="confirmation.php">Submit Photos or Videos</a>').insertAfter('#images');
    });
});
