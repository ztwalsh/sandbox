<?php
  require('../lib/config.php');
  $test_group = set_session_var('test_group', 'Review First');
  $submission = add_review();
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
          <h1 class="heading-1">Add a Review</h1>
          <h3 class="heading-4 small">Your photos help future shoppers make decisions on what they buy.</h3>
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
