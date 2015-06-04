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
			$title = 'Review Your Purchases';
			include('lib/include.head.php');
		?>
	</head>
	<body>
		<div class="wrapper cf">
			<div class="header cf">
				<h1 class="headline1">Rate and review your purchases</h1>
			</div>
			<?php show_review_item('images/goggles.jpg', 'Oakley Canopy Goggles', '1', 'March 30, 2015'); ?>
			<?php show_review_item('images/hat.jpg', 'Spacecraft Snowcat Pom Beanie', '2', 'March 2, 2015'); ?>
			<?php show_review_item('images/gloves.jpg', 'Burton GORE-TEX Gloves', '3', 'January 1, 2015'); ?>
			<?php show_review_item('images/boot.jpg', 'Dolomite Rage Pro Ski Boot 2004', '4', 'December 18, 2014'); ?>
		</div>
	</body>
</html>