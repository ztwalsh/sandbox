$(document).ready(function () {
	// Highlighted Radio
	$('input[type=radio]').change(function() {
		var tmp=$(this).attr('name');
    	$('input[name="'+tmp+'"]').parent('label').removeClass('selected');
		$(this).closest('label').toggleClass('selected', this.selected);
		$(this).parent().parent().next().slideDown(100);
		$(this).parent().parent().next().children('textarea').focus();
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

		$(this).parent().closest('.rating-text').text(rating_text);

		$(this).closest('.product-form-expand').slideToggle();
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

		$(this).parent().closest('.rating-text').text(rating_text);
	});

	// Submit a review
	$('button.primary').click(function (event) {
		event.preventDefault();
		$(this).parent().parent().parent().html('<h3 class="headline1 success"><i class="fa fa-check-circle-o"></i> Thank you for your review!</h3><p>Your review will be posted in 3&ndash;5 business days.</p>');

	})

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

	$('.legal_link').popupWindow({ 
		height:500, 
		width:800, 
		top:50, 
		left:50 
	});
});