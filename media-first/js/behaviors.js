$(document).ready(function() {
  // Inputs for images
	function readURL(input) {
    if (input.files && input.files[0]) {
      	var reader = new FileReader();

      	reader.onload = function (e) {
        	var file = e.target.result;
        	var html_image = '<div class="uploaded_image cf"><img class="file_placeholder" src="' + file + '" alt="" /><input class="text caption" type="text" value="" placeholder="write a caption" /><a class="trash" href="#"><i class="fa fa-trash-o"></i></a></div>';
        	$(html_image).insertBefore($('.file'));

        	$('a.trash').click(function() {
        		$(this).closest('.uploaded_image').remove();
        		return false;
        	});
      	}

      	reader.readAsDataURL(input.files[0]);
    	}
  	}

  	$("input.file").change(function(){
      	readURL(this);
  	});
  });
