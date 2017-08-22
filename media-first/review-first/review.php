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
