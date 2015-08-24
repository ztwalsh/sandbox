<?php
	include('lib/functions.php');
?>
<!doctype html>
<html>
	<head>
		<title>Thanks Page Seller Ratings Widget</title>
		<link href="css/confirmation.css" media="all" rel="stylesheet" />
		<link href="css/global.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/styles-chat.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/forms.css" media="screen" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/behaviors-chat.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	</head>
	<body>
		<div class="mobile-cta">
			Rate this experience! <i class="fa fa-angle-up"></i>
		</div>
		<div class="widget-wrapper">
			<div class="widget-header">
				How was shopping with us? <i class="fa fa-angle-down"></i>
			</div>
			<div class="widget-body">
				<section class="cf">
					<div class="span2">
						<label class="main" for="rating">Overall rating</label>
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
				<p>
					<label class="main" for="">Headline</label>
					<?php form_input('headline', '', 'headline', ''); ?>
				</p>
				<p>
					<label class="main" for="service_comments">Comments</label>
					<?php form_textarea('service_comments', ''); ?>
				</p>
				<?php if (isset($_GET['long'])) { ?>
				<p>
					<label class="main" for="">Nickname</label>
					<?php form_input('nickname', '', 'nickname', ''); ?>
				</p>
				<p>
					<label class="main" for="">Location</label>
					<?php form_input('location', '', 'location', ''); ?>
				</p>
				<p>
					<label class="main" for="">Email</label>
					<?php form_input('email', '', 'email', ''); ?>
				</p>
				<?php
					}
				?>
				<section>
					<p><?php primary_submit('Submit Review'); ?></p>
				</section>
			</div>
		</div>
		<?php include('lib/include.content.php'); ?>
	</body>
</html>
