<?php
  require('lib/config.php');
  $submission = review_submission();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add a Photo</title>
		<?php require('lib/include.head.php'); ?>
	</head>

	<body>
		<?php require('lib/include.product.php'); ?>
		<section class="review-form">
			<div class="wrapper">
				<header id="step-info">
					<h1 class="heading-1">Got it, Thanks!</h1>
					<h3 class="heading-4 small">These are some good ones! Nice work.</h3>
				</header>

				<section id="image-display" class="cf">
					<?php image_display($_SESSION['image_id']); ?>
				</section>

        <section id="war">
          <?php
  					display_error_alert($submission);
            require('lib/include.war.php');
  				?>
        </section>
			</div>
		</section>
	</body>
</html>
