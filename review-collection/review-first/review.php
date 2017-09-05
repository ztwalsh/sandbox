<?php
  require('../lib/config.php');
  $test_group = set_session_var('test_group', 'Review First'.($sweepstakes ? ': Sweepstakes' : ''));
  $submission = add_review();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add a Review</title>
    <?php
			$page_title = 'Review First: Step 1: Review';
			require('../lib/include.head.php');
		?>
	</head>

	<body>
		<?php require('../lib/include.product.php'); ?>
		<section class="review-form">
			<div class="wrapper">
        <header id="step-info">
          <h1 class="heading-1">Write a Review</h1>
          <h3 class="heading-4 small">Reviews help future shoppers make decisions on what they buy.</h3>
        </header>
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
