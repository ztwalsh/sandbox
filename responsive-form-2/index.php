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
						<?php form_textarea('product_comments', 'How you use the product? What things are great about it? What things aren\'t so great about it?'); ?>
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
				<section class="cf">
					<div class="span2">
						<label class="main">Pros</label>
						<p>Select all that apply from this list<br />&nbsp;</p>
					</div>
					<div class="span4">
						<?php form_checkbox('pros[]', 'All the connections I could ever need', 'all_connections'); ?><?php form_checkbox('pros[]', 'Best looking TV out there', 'best_looking'); ?><?php form_checkbox('pros[]', 'Easy Set Up', 'easy'); ?><?php form_checkbox('pros[]', 'Energy Efficient', 'energy_efficient'); ?><?php form_checkbox('pros[]', 'Good Remote Control', 'good_remote'); ?><?php form_checkbox('pros[]', 'Great Picture Quality', 'great_picture_quality'); ?><?php form_checkbox('pros[]', 'Great Sound Quality', 'great_sound_quality'); ?><?php form_checkbox('pros[]', 'LED Backlit', 'led'); ?><?php form_checkbox('pros[]', 'Reduced Glare', 'reduced_glare'); ?>
						<p><a id="pros[]" class="secondary action add-check" href="#">Add your own <i class="fa fa-plus"></i></a></p>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Cons</label>
						<p>Select all that apply<br />&nbsp;</p>
					</div>
					<div class="span4">
						<?php form_checkbox('cons[]', 'Confusing / Bad remote control', 'bad_remote'); ?><?php form_checkbox('cons[]', 'Difficult to Set Up', 'difficult_setup'); ?><?php form_checkbox('cons[]', 'Glare', 'glare'); ?><?php form_checkbox('cons[]', 'Poor Connection Options', 'poor_connections'); ?><?php form_checkbox('cons[]', 'Poor Image Quality', 'poor_image_quality'); ?><?php form_checkbox('cons[]', 'Poor Reception / Weak Antenna', 'poor_reception'); ?><?php form_checkbox('cons[]', 'Poor Sound Quality', 'poor_sound'); ?>
						<p><a id="cons[]" class="secondary action add-check" href="#">Add your own <i class="fa fa-plus"></i></a></p>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Best Uses</label>
						<p>Select all that apply<br />&nbsp;</p>
					</div>
					<div class="span4">
						<?php form_checkbox('best[]', 'Attached to a Computer', 'computer'); ?><?php form_checkbox('best[]', 'Bedroom', 'bedroom'); ?><?php form_checkbox('best[]', 'Business', 'business'); ?><?php form_checkbox('best[]', 'Home', 'home'); ?><?php form_checkbox('best[]', 'Home Theater', 'home_theater'); ?><?php form_checkbox('best[]', 'Movies', 'movies'); ?><?php form_checkbox('best[]', 'Video Games', 'video_games'); ?><?php form_checkbox('best[]', 'Wall Mounting', 'wall'); ?>
						<p><a id="best[]" class="secondary action add-check" href="#">Add your own <i class="fa fa-plus"></i></a></p>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Was this a gift?</label>
					</div>
					<div class="span4 radioset_bin cf">
						<?php form_radio('gift', 'Yes', 'yes'); ?><?php form_radio('gift', 'No', 'no'); ?>
					</div>
				</section>
				<section class="cf">
					<label class="main drop-inputs" for="accessories"><input type="checkbox" class="small-check" id="accessories" /> Do you recommend any accessories?</label>
					<div class="input-group">
						<p>List the names of the accessories you recommend.</p>
						<input class="text" type="text" />
						<input class="text" type="text" />
						<input class="text" type="text" />
					</div>
				</section>
				<section class="cf">
					<label class="main drop-inputs" for="similar"><input type="checkbox" class="small-check" id="similar" /> Do you own any similar products?</label>
					<div class="input-group">
						<p>List the names of these products.</p>
						<input class="text" type="text" />
						<input class="text" type="text" />
						<input class="text" type="text" />
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">Describe Yourself</label>
					</div>
					<div class="span4 radioset_vert cf">
						<?php form_radio('describe', 'Casual User', 'casual'); ?><?php form_radio('describe', 'Enthusiast', 'enthusiast'); ?><?php form_radio('describe', 'Power User', 'power'); ?>
					</div>
				</section>
				<section class="cf">
					<div class="span2">
						<label class="main">
							Bottom Line
						</label>
					</div>
					<div class="span4 radioset_vert cf">
						<?php display_error('bottom_line'); ?><?php form_radio('bottom_line', 'Yes, you would recommend this to a friend', 'recommend'); ?><?php form_radio('bottom_line', 'No, you would not recommend this to a friend', 'not_recommend'); ?>
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
					<p><?php primary_submit('Submit Review'); ?></p>
					<p class="legal">By submitting, you agree to our <a href="javascript:showSmallPopup('http://www.powerreviews.com/legal/terms_of_use_en_US.html');">Terms</a>, and that you have read our <a href="javascript:showSmallPopup('http://www.powerreviews.com/legal/privacy_policy_en_US.html');">Privacy Policy</a>.</p>
				</section>
			</form>
		</div>
	</body>
</html>