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
		<div class="abt-header"></div>
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
						<?php form_input('headline', '', 'headline', ''); ?>
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
						<?php form_textarea('product_comments', 'Talk about the product'); ?>
						<p><a class="secondary action add-image" href="#" id="add-image"><i class="fa fa-plus"></i> Add an image</a></p>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Nickname<span class="required">*</span></label>
					</div>
					<div class="span4">
						<?php display_error('firstname'); ?>
						<?php form_input('firstname', '', 'firstname', ''); ?>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Your Location<span class="required">*</span></label>
					</div>
					<div class="span4">
						<?php display_error('location'); ?>
						<?php form_input('location', '', 'location', 'i.e. Chicago, IL'); ?>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Pros</label>
					</div>
					<div class="span4">
						<?php form_checkbox('pros[]', 'All the connections I could ever need', 'all_connections'); ?><?php form_checkbox('pros[]', 'Best looking TV out there', 'best_looking'); ?><?php form_checkbox('pros[]', 'Easy Set Up', 'easy'); ?><?php form_checkbox('pros[]', 'Energy Efficient', 'energy_efficient'); ?><?php form_checkbox('pros[]', 'Good Remote Control', 'good_remote'); ?><?php form_checkbox('pros[]', 'Great Picture Quality', 'great_picture_quality'); ?><?php form_checkbox('pros[]', 'Great Sound Quality', 'great_sound_quality'); ?><?php form_checkbox('pros[]', 'LED Backlit', 'led'); ?><?php form_checkbox('pros[]', 'Reduced Glare', 'reduced_glare'); ?>
						<a id="pros[]" class="secondary action add-check" href="#"><i class="fa fa-plus"></i> Add your own</a>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Cons</label>
					</div>
					<div class="span4">
						<?php form_checkbox('cons[]', 'Confusing / Bad remote control', 'bad_remote'); ?><?php form_checkbox('cons[]', 'Difficult to Set Up', 'difficult_setup'); ?><?php form_checkbox('cons[]', 'Glare', 'glare'); ?><?php form_checkbox('cons[]', 'Poor Connection Options', 'poor_connections'); ?><?php form_checkbox('cons[]', 'Poor Image Quality', 'poor_image_quality'); ?><?php form_checkbox('cons[]', 'Poor Reception / Weak Antenna', 'poor_reception'); ?><?php form_checkbox('cons[]', 'Poor Sound Quality', 'poor_sound'); ?>
						<a id="cons[]" class="secondary action add-check" href="#"><i class="fa fa-plus"></i> Add your own</a>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Best Uses</label>
					</div>
					<div class="span4">
						<?php form_checkbox('best[]', 'Attached to a Computer', 'computer'); ?><?php form_checkbox('best[]', 'Bedroom', 'bedroom'); ?><?php form_checkbox('best[]', 'Business', 'business'); ?><?php form_checkbox('best[]', 'Home', 'home'); ?><?php form_checkbox('best[]', 'Home Theater', 'home_theater'); ?><?php form_checkbox('best[]', 'Movies', 'movies'); ?><?php form_checkbox('best[]', 'Video Games', 'video_games'); ?><?php form_checkbox('best[]', 'Wall Mounting', 'wall'); ?>
						<a id="best[]" class="secondary action add-check" href="#"><i class="fa fa-plus"></i> Add your own</a>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Was this a gift?</label>
					</div>
					<div class="span4 radioset cf">
						<?php form_radio('gift', 'Yes', 'yes'); ?><?php form_radio('gift', 'No', 'no'); ?>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Describe Yourself</label>
					</div>
					<div class="span4 radioset cf">
						<?php form_radio('describe', 'Casual User', 'casual'); ?><?php form_radio('describe', 'Enthusiast', 'enthusiast'); ?><?php form_radio('describe', 'Power User', 'power'); ?>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">
							Bottom Line<br />
							<span>Would you recommend this to a friend?</span>
						</label>
					</div>
					<div class="span4 radioset cf">
						<?php display_error('bottom_line'); ?><?php form_radio('bottom_line', 'I would recommend', 'recommend'); ?><?php form_radio('bottom_line', 'I would NOT recommend', 'not_recommend'); ?>
					</div>
				</section>
				<section>
					<p><?php primary_submit('Submit Review'); ?></p>
					<p class="legal">Your review may end up on the Ace Hardware Website as well as Buzillions.com, a network site that informs the shopping community. Read our privacy policy and terms of use for more details.</p>
				</section>
			</form>
		</div>
	</body>
</html>