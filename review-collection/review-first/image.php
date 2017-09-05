<?php
	require('../lib/config.php');
	$test_group = set_session_var('test_group', 'Review First'.($sweepstakes ? ': Sweepstakes' : ''));
	add_photo($_SESSION['review_id']);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add a Photo</title>
		<?php
			$page_title = 'Review First: Step 2: Image';
			require('../lib/include.head.php');
		?>
	</head>

	<body>
		<?php require('../lib/include.product.php'); ?>
		<section class="review-form">
			<div class="wrapper">
				<form action="image.php" enctype="multipart/form-data" method="post">
					<?php
						form_hidden('merchant_group_id', $merchant_group_id);
						form_hidden('page_id', $page_id);
						form_hidden('test_group', $test_group);
						form_hidden('ip', $ip);
					?>
					<header id="step-info">
						<h1 class="heading-1">We got your review!</h1>
						<h3 class="heading-4 small">Now, add a photo to help illustrate your review.</h3>
					</header>

					<input type="file" class="file" name="review_image" id="add-media">
					<section id="images">
						<label for="add-media" class="secondary action add-image">
							<p><img class="empty" src="../images/image-placeholder.png" /></p>
							<p><span class="btn-primary full">Find or Take a Photo</span></p>
							<p><a href="confirmation.php">No Thanks</a></p>
						</label>
					</section>
				</form>
			</div>
		</section>
	</body>
</html>
