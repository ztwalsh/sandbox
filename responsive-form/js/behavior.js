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
		var field_add = '<div class="pop-background"></div><div class="pop-content"><h1 class="headline1">Still Working</h2><p>This feature is not complete for this prototype. But normally, this would allow you to add your own pros, cons, and best fors.</p><p><br /><a class="primary close" href="#">Got it! Move on.</a></p></div>';
		$(field_add).hide().appendTo('body').fadeIn(50);
		$('a.close').click(function() {
			$('.pop-background, .pop-content').fadeOut(50);
			return false;
		});
		return false;
	});

	// Add Image
	$('a.add-image').click(function() {
		var field_add = '<div class="pop-background"></div><div class="pop-content"><h1 class="headline1">Still Working</h2><p>This feature is not complete for this prototype. But normally, this would allow you to add images from your phone\'s photo library.</p><p><br /><a class="primary close" href="#">Got it! Move on.</a></p></div>';
		$(field_add).hide().appendTo('body').fadeIn(50);
		$('a.close').click(function() {
			$('.pop-background, .pop-content').fadeOut(50);
			return false;
		});
		return false;
	});

	// Privacy Policy
	$('a.privacy-policy').click(function() {
		var content = '<div class="pop-background"></div><div class="pop-content"><h1 class="headline1">Privacy Policy</h2><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p><p><br /><a class="primary close" href="#">I Agree</a></p></div>';
		$(content).hide().appendTo('body').fadeIn(50);
		$('a.close').click(function() {
			$('.pop-background, .pop-content').fadeOut(50);
			return false;
		});
		return false;
	});
});