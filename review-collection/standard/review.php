<?php
	require('../lib/config.php');
	$test_group = set_session_var('test_group', 'Control'.($sweepstakes ? ': Sweepstakes' : ''));
	$submission = add_review(NULL, 'Control');
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Write a Review</title>
		<?php
			$page_title = 'Control: Step 1: Review & Image';
			require('../lib/include.head.php');
		?>
	</head>
	<body>
		<div class="product-information-original cf">
			<div class="product-image">
				<img src="<?php echo $product_image_url; ?>" height="auto" width="100%" />
			</div>
			<div class="product-info">
				<h1 class="heading-3">Write a review</h1>
				<p><?php echo $product_name; ?></p>
			</div>
		</div>
		<section class="review-form">
			<div class="wrapper">
        <section id="war">
          <?php
  					display_error_alert($submission);
  				?>
					<form action="review.php" id="form" enctype="multipart/form-data" method="post">
						<?php
							form_hidden('merchant_group_id', $merchant_group_id);
							form_hidden('page_id', $page_id);
							form_hidden('test_group', $test_group);
							form_hidden('ip', $_SERVER['REMOTE_ADDR']);
						?>
						<section class="cf">
							<div class="span2">
								<label class="main" for="rating">Give a rating<span class="required">*</span> <span class="rating-text"></span></label>
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
								<?php form_input('headline', '', 'headline', 'ex. I would buy this product again and again'); ?>
								<span id="counter"></span>
							</div>
						</section>
						<section class="cf">
							<div class="span2">
								<label class="main">Add your comments<span class="required">*</span></label>
							</div>
							<div class="span4">
								<?php display_error('comments'); ?>
								<?php form_textarea('comments', 'How do you use the product? What things are great about it? What things aren\'t so great about it?'); ?>
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
							<input class="file_original" type="file" name="review_image" id="file_upload">
							<label for="file_upload" class="btn-secondary action add-image">
								Add an Image <i class="fa fa-plus"></i>
							</label>
						</section>
						<section>
							<p class="small">
								By submitting, you agree to our <a class="legal_link" href="http://www.powerreviews.com/legal/terms_of_use_en_US.html" target="_blank">Terms of Use</a> and that you have read our <a class="legal_link" href="http://www.powerreviews.com/legal/privacy_policy_en_US.html" target="_blank">Privacy Policy</a>.
								<?php show_sweepstakes($sweepstakes); ?>
							</p>
							<p><?php primary_submit('Submit Review'); ?></p>
						</section>
					</form>

        </section>
			</div>
		</section>



	</body>
</html>
