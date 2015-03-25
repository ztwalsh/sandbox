$(document).ready(function () {
	// Highlighted Radio
	$('input[type=radio]').change(function() {
		var tmp=$(this).attr('name');
    	$('input[name="'+tmp+'"]').parent('label').removeClass('selected');
		$(this).closest('label').toggleClass('selected', this.selected);
	});

	// Highlighted Checkbox
	$('input[type=checkbox]').change(function() {
		$(this).closest('label').toggleClass('selected', this.checked);
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

	// Add a Checkbox
	$('a.add-check').click(function() {
		var field_add = '<input type="text" class="add-tag-input" /><a class="add-tag" href="#">Add</a>';
		var field_name = $(this).attr('id');
		var root_element = $(this).closest('p');

		$(field_add).insertBefore(root_element);
		$('.add-tag-input').focus();
		$(this).parent().hide();

		$('a.add-tag').click(function() {
			checkbox_value = $('.add-tag-input').val();
			checkbox = '<label class="tags selected" for="new-tag"><input type="checkbox" id="new-tag" name="' + field_name + '" value="' + checkbox_value + '" />' + checkbox_value + '</label>';
			
			$(this).remove();
			$('.add-tag-input').remove();
			$(checkbox).insertBefore(root_element);
			$(root_element).show();
			return false;
		});

		$(document).keypress(function(e) {
		    if(e.which == 13) {
		    	e.preventDefault();
		        checkbox_value = $('.add-tag-input').val();
				checkbox = '<label class="tags selected" for="new-tag"><input type="checkbox" id="new-tag" name="' + field_name + '" value="' + checkbox_value + '" />' + checkbox_value + '</label>';
				
				$('a.add-tag').remove();
				$('.add-tag-input').remove();
				$(checkbox).insertBefore(root_element);
				$(root_element).show();
				return false;
		    }
		});

		return false;
	});

	// Add Image
	$('a.add-image').click(function() {
		var link = '#add-image';

		$('<span> Sorry, you can\'t add images on this prototype</span>').insertAfter(link);

		return false;
	});

	// Character counter
	$('input#headline').keyup(function () {
		var max = 40;

		$(this).prop('maxlength', max);

    	var left = max - $(this).val().length;
    	if (left < 0) {
        	left = 0;
    	}
    	if (left < 20) {
    		$('#counter').text(left + ' character left');
    	}
	});

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

	// Accessories drop down
	$('.drop_inputs').click(function() {
		if ($(this).children().prop('checked') == true) {
			$(this).next('.input-group').show()
		} else {
			$(this).next('.input-group').hide()
		}
	});

	$('.small-check').click(function() {
		if ($(this).prop('checked') == true) {
			$(this).parent().next('.input-group').show()
		} else {
			$(this).parent().next('.input-group').hide()
		}
	});
});