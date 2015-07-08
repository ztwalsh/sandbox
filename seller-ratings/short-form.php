<?php
	include('lib/functions.php');
?>
<!doctype html>
<html>
	<head>
		<title>Thanks Page Seller Ratings Widget</title>
		<link href="css/global.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/styles.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/forms.css" media="screen" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/behaviors.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	</head>
	<body>
		<?php include('lib/include.header.php'); ?>
		<div class="mobile-cta">
			Give us your feedback!
		</div>
		<div class="widget-wrapper">
			<div class="widget-header">
				How was shopping with us? <i class="fa fa-angle-down"></i>
			</div>
			<div class="widget-body">
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
				<p>
					<label class="main" for="">Headline</label>
					<?php form_input('headline', '', 'headline', ''); ?>
				</p>
				<p>
					<label class="main" for="service_comments">Comments</label>
					<?php form_textarea('service_comments', ''); ?>
				</p>
				<section>
					<p><?php primary_submit('Submit Review'); ?></p>
				</section>
			</div>
		</div>
	</body>
</html>
