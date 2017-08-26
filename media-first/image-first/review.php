<?php
  require('../lib/config.php');
  $test_group = set_session_var('test_group', 'Image First');
  $submission = add_review($_SESSION['image_id']);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add a Review</title>
		<?php require('../lib/include.head.php'); ?>
	</head>

	<body>
		<?php require('../lib/include.product.php'); ?>
		<section class="review-form">
			<div class="wrapper">
				<header id="step-info">
					<h1 class="heading-1">Got it, Thanks!</h1>
					<h3 class="heading-4 small">Nice photo! Shoppers will love this.</h3>
				</header>

				<section id="image-display" class="cf">
					<?php image_display($_SESSION['image_id']); ?>
				</section>

        <section id="war">
          <?php
  					display_error_alert($submission);
            require('../lib/include.war.php');
  				?>
        </section>
			</div>
		</section>
	</body>
</html>
