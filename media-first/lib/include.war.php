<form action="confirmation.php" id="form" method="post">
	<?php
		form_hidden('merchant_group_id', '11');
		form_hidden('page_id', '22');
		form_hidden('test_group', 'A');
		form_hidden('ip', $_SERVER['REMOTE_ADDR']);
	?>
	<section class="cf">
		<div class="span2">
			<p><label class="heading-2" for="rating">How's your experience been with this product?<span class="required">*</span> <span class="rating-text"></span></label></p>
		</div>
		<div class="span4">
			<span class="rating cf">
				<?php form_stars('rating', '5', 'star_5'); ?>
				<?php form_stars('rating', '4', 'star_4'); ?>
				<?php form_stars('rating', '3', 'star_3'); ?>
				<?php form_stars('rating', '2', 'star_2'); ?>
				<?php form_stars('rating', '1', 'star_1'); ?>
			</span>
		</div>
	</section>
	<section class="cf">
		<div class="span2">
			<label class="main" for="headline">Summarize with a headline<span class="required">*</span></label>
		</div>
		<div class="span4">
			<?php display_error('headline'); ?>
			<?php form_input('headline', '', 'headline', ''); ?>
			<span id="counter"></span>
		</div>
	</section>
	<section class="cf">
		<div class="span2">
			<label class="main">Add some comments<span class="required">*</span></label>
		</div>
		<div class="span4">
			<?php display_error('comments'); ?>
			<?php form_textarea('comments', ''); ?>
		</div>
	</section>
	<section class="cf">
		<div class="span2">
			<label class="main">Nickname<span class="required">*</span></label>
		</div>
		<div class="span4">
			<?php display_error('nickname'); ?>
			<?php form_input('nickname', '', 'nickname', 'ex. DavidS, Jim the Runner'); ?>
		</div>
	</section>
	<section class="cf">
		<div class="span2">
			<label class="main">Your Location<span class="required">*</span></label>
		</div>
		<div class="span4">
			<?php display_error('location'); ?>
			<?php form_input('location', '', 'location', 'ex. San Jose, CA'); ?>
		</div>
	</section>
	<section>
		<p class="small">By submitting, you agree to our <a class="legal_link" href="http://www.powerreviews.com/legal/terms_of_use_en_US.html">Terms of Use</a> and that you have read our <a class="legal_link" href="http://www.powerreviews.com/legal/privacy_policy_en_US.html">Privacy Policy</a>.</p>
		<p><?php primary_submit('Submit Review'); ?></p>
	</section>
</form>
