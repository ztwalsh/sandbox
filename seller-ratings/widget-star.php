<?php
	include('lib/functions.php');
?>
<!doctype html>
<html>
	<head>
		<title>Thanks Page Seller Ratings Widget</title>
		<link href="//cdn.shopify.com/app/services/5565437/assets/9170767/checkout_stylesheet/v2-c1f57026ad560753f1f35ee0342ce857-15668890328285695284" media="all" rel="stylesheet" />
		<link href="css/global.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/styles-star.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/forms.css" media="screen" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/behaviors-star.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	</head>
	<body>
		<div class="widget-wrapper">
			<div class="close"><i class="fa fa-times"></i></div>
			<div class="widget-body">
				<h1 class="headline1">Rate your shopping experience</h1>
				<span class="rating cf">
					<?php form_stars('rating', '5', 'star_5'); ?>
					<?php form_stars('rating', '4', 'star_4'); ?>
					<?php form_stars('rating', '3', 'star_3'); ?>
					<?php form_stars('rating', '2', 'star_2'); ?>
					<?php form_stars('rating', '1', 'star_1'); ?>
				</span>
				<section class="widget-hidden">
					<p>
						<?php form_textarea('service_comments', 'Add some comments'); ?>
					</p>
					<section>
						<p><?php primary_submit('Submit this rating'); ?></p>
					</section>
				</section>
			</div>
		</div>
		<?php include('lib/include.content.php'); ?>
	</body>
</html>
