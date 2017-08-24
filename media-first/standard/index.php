<?php
	include('lib/functions.php');
	if (isset($_POST['submit'])) {
		$result = single_processor();
		if(is_array($result)) {
			header('Location: thanks.php');
		} else {
			$error = $result;
		}
	}
	session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<?php
			$title = 'Write a review';
			include('lib/include.head.php');
		?>
	</head>
	<body>
		<div class="wrapper cf">
			<div class="header cf">
				<div class="product-image">
					<img src="http://images.buzzillions.com/images_products/10/11/22730758_100.jpg" height="auto" width="100%" />
				</div>
				<div class="product-info">
					<h1 class="headline1">Write a review</h1>
					<p>Samsung 43" Black Plasma 720P HDTV by Samsung</p>
				</div>
			</div>
			<form action="index.php" id="form" method="post">
				<?php
					if(isset($error)) {
						echo $error;
					}
				?>
				<section class="cf">
					<div class="span2">
						<label class="main" for="headline">Review headline<span class="required">*</span></label>
					</div>
					<div class="span4">
						<?php display_error('headline'); ?>
						<?php form_input('headline', '', 'headline', 'ex. I would buy this product again and again'); ?>
						<span id="counter"></span>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main" for="rating">Overall rating<span class="required">*</span> <span class="rating-text"></span></label>
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
						<label class="main">Describe your experience with the product<span class="required">*</span></label>
					</div>
					<div class="span4">
						<?php display_error('product_comments'); ?>
						<?php form_textarea('product_comments', 'How do you use the product? What things are great about it? What things aren\'t so great about it?'); ?>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Nickname<span class="required">*</span></label>
					</div>
					<div class="span4">
						<?php display_error('firstname'); ?>
						<?php form_input('firstname', '', 'firstname', 'ex. DavidS, Jim the Runner'); ?>
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
					<p>
						<input class="file" type="file" id="file_upload">
						<label for="file_upload" class="secondary action add-image">
							Add an Image <i class="fa fa-plus"></i>
						</label>
					</p>
				</section>
				<section>
					<p class="legal">By submitting, you agree to our <a class="legal_link" href="http://www.powerreviews.com/legal/terms_of_use_en_US.html">Terms of Use</a> and that you have read our <a class="legal_link" href="http://www.powerreviews.com/legal/privacy_policy_en_US.html">Privacy Policy</a>.</p>
					<p><?php primary_submit('Submit Review'); ?></p>
				</section>
			</form>
		</div>
	</body>
</html>
