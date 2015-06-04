$(document).ready(function () {
	// Highlighted Radio
	$('input[type=radio]').change(function() {
		var tmp = $(this).attr('name');
    	$('input[name="'+tmp+'"]').parent('label').removeClass('selected');
		$(this).closest('label').toggleClass('selected', this.selected);
		$(this).parent().parent().parent().parent().next().slideDown(100);
		$(this).parent().parent().parent().parent().next().children('.product-comments-wrapper').children().children('textarea').focus();
	});

	// Submit a review
	$('button.primary').click(function (event) {
		event.preventDefault();
		var windowWidth = $( window ).width();
		$(this).parent().parent().hide();
		$(this).parent().parent().prev().children('.product-title').html('<h3 class="headline1 success">Thank you for your review!</h3><p>It will be posted in 3&ndash;5 business days.</p>');
		if (windowWidth < 510) {
			$('html, body').animate({
	    		scrollTop: $(this).parent().parent().prev().parent().parent().offset().top
			}, 200);
		}
		$(this).parent().parent().prev().parent().parent().delay(2500).fadeOut(500);
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

	$('.legal_link').popupWindow({ 
		height:500, 
		width:800, 
		top:50, 
		left:50 
	});
});