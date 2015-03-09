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
		var field_add = '<input type="text" class="add-tag-input" /><a class="add-tag" href="">Add</a>';
		var field_name = $(this).attr('id');
		var root_element = $(this);

		$(field_add).insertBefore(root_element);

		$('a.add-tag').click(function() {
			checkbox_value = $('.add-tag-input').val();
			checkbox = '<label class="tags selected" for="new-tag"><input type="checkbox" id="new-tag" name="' + field_name + '" value="' + checkbox_value + '" />' + checkbox_value + '</label>';
			$(this).remove();
			$('.add-tag-input').remove();
			$(checkbox).insertBefore(root_element);
			$(root_element).show();
			return false;
		});
		return false;
	});

	// Add Image
	$('a.add-image').click(function() {
		var link = '#add-image';

		$('<span> Sorry, you can\'t add images on this prototype</span>').insertAfter(link);

		return false;
	});
});