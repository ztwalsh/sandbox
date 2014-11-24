<?php
	include('lib/functions.php');
	if (isset($_POST['submit'])) {
		$result = single_processor();
		if(is_array($result)) {
			header('Location: preview.php');
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
		<?php
			if(isset($error)) {
				echo $error;	
			}
		?>
		<div class="wrapper cf">
			<div class="product-image">
				<img src="http://images.buzzillions.com/images_products/10/11/22730758_100.jpg" height="auto" width="100%" />
			</div>
			<div class="product-info">
				<h1 class="headline1">Write a review</h1>
				<p>Samsung 43" Black Plasma 720P HDTV by Samsung</p>
				<p class="small"><span class="required">*</span>Required fields</p>
			</div>
		</div>
		<form action="index.php" method="post">
			<fieldset>
				<section class="cf">
					<div class="span2">
						<label class="main" for="rating"><span class="required">*</span>Your rating <span class="rating-text"></span></label>
					</div>
					<div class="span4">
						<span class="rating cf">
							<?php form_stars('rating', '<i class="fa fa-star"></i>', '5', 'star_5'); ?>
							<?php form_stars('rating', '<i class="fa fa-star"></i>', '4', 'star_4'); ?>
							<?php form_stars('rating', '<i class="fa fa-star"></i>', '3', 'star_3'); ?>
							<?php form_stars('rating', '<i class="fa fa-star"></i>', '2', 'star_2'); ?>
							<?php form_stars('rating', '<i class="fa fa-star"></i>', '1', 'star_1'); ?>
						</span>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main" for="headline"><span class="required">*</span>Your headline</label>
					</div>
					<div class="span4">
						<?php display_error('headline'); ?>
						<?php form_input('headline', '', 'headline', ''); ?>
					</div>
				</section>
			</fieldset>
			<fieldset>
				<section class="cf">
					<div class="span2">
						<label class="main">Pros</label>
					</div>
					<div class="span4">
						<?php form_checkbox('pros[]', 'Attractive Design', 'attractive'); ?>
						<?php form_checkbox('pros[]', 'Energy Efficient', 'efficient'); ?>
						<?php form_checkbox('pros[]', 'Easy Set Up', 'easy'); ?>
						<?php form_checkbox('pros[]', 'Great Picture', 'great_picture'); ?>
						<a class="secondary action add-check" href="#"><i class="fa fa-plus"></i> Add your own</a>
					</div>
				</section>
				
				<section class="cf">
					<div class="span2">
						<label class="main">Cons</label>
					</div>
					<div class="span4">
						<?php form_checkbox('cons[]', 'Bad Interface', 'interface'); ?>
						<?php form_checkbox('cons[]', 'Confusing Remote Control', 'confusing'); ?>
						<?php form_checkbox('cons[]', 'Glare', 'glare'); ?>
						<?php form_checkbox('cons[]', 'Poor Picture', 'poor_picture'); ?>
						<a class="secondary action add-check" href="#"><i class="fa fa-plus"></i> Add your own</a>
					</div>
				</section>

				<section class="cf">
					<div class="span2">
						<label class="main">Best uses</label>
					</div>
					<div class="span4">
						<?php form_checkbox('best[]', 'Home', 'home'); ?>
						<?php form_checkbox('best[]', 'Living Room', 'living_room'); ?>
						<?php form_checkbox('best[]', 'Movies', 'movies'); ?>
						<?php form_checkbox('best[]', 'Wall Mounting', 'wall_mounting'); ?>
						<a class="secondary action add-check" href="#"><i class="fa fa-plus"></i> Add your own</a>
					</div>
				</section>
			</fieldset>
			<fieldset>
				<section class="cf">
					<div class="span2">
						<label class="main"><span class="required">*</span>Comments</label>
					</div>
					<div class="span4">
						<?php display_error('product_comments'); ?>
						<?php form_textarea('product_comments', 'Talk about the product'); ?>
						<?php form_textarea('service_comments', 'Talk about the service (optional)'); ?>
						<p><a class="secondary action add-image" href="#" id=""><i class="fa fa-paperclip"></i> Add image</a></p>
						<?php form_checkbox('similar_products', 'I own similar products', 'similar_products'); ?>
					</div>
				</section>
			</fieldset>
			<fieldset>
				<section class="cf">
					<div class="span2">
						<label class="main"><span class="required">*</span>First name or nickname</label>
					</div>
					<div class="span4">
						<?php display_error('firstname'); ?>
						<?php form_input('firstname', '', 'firstname', ''); ?>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main"><span class="required">*</span>Location</label>
					</div>
					<div class="span4">
						<?php display_error('location'); ?>
						<?php form_input('location', '', 'location', 'i.e. Chicago, IL'); ?>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Which best describes you?</label>
					</div>
					<div class="span4">
						<?php form_radio('describe', 'Casual User', 'casual'); ?>
						<?php form_radio('describe', 'Enthusiast', 'enthusiast'); ?>
						<?php form_radio('describe', 'Power User', 'power'); ?>
					</div>
				</section>
			</fieldset>
			<fieldset>
				<section class="cf">
					<div class="span2">
						<label class="main"><span class="required">*</span>Bottom line</label>
					</div>
					<div class="span4">
						<?php display_error('bottom_line'); ?>
						<?php form_radio('bottom_line', 'I would recommend', 'recommend'); ?>
						<?php form_radio('bottom_line', 'I would NOT recommend', 'not_recommend'); ?>
					</div>
				</section>
			</fieldset>
			<fieldset>
				<section>
					<p><?php primary_submit('Preview <i class="fa fa-chevron-right"></i>'); ?></p>
					<p class="legal">Your review may end up on the Ace Hardware Website as well as Buzillions.com, a network site that informs the shopping community. Read our privacy policy and terms of use for more details.</p>
				</section>
			</fieldset>
		</form>
	</body>
</html>