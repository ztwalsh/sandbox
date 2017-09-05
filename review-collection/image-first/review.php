<?php
  require('../lib/config.php');
  $test_group = set_session_var('test_group', 'Image First'.($sweepstakes ? ': Sweepstakes' : ''));
  $submission = add_review($_SESSION['image_id']);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add a Review</title>
    <?php
			$page_title = 'Image First: Step 2: Review';
			require('../lib/include.head.php');
		?>
	</head>

	<body>
		<?php require('../lib/include.product.php'); ?>
		<section class="review-form">
			<div class="wrapper">
				<header id="step-info">
					<h1 class="heading-1">Thank you! Great photo.</h1>
					<h3 class="heading-4 small">Now add a review to go with it.</h3>
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
