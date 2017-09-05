<?php
	require('../lib/config.php');
	$test_group = set_session_var('test_group', 'Image First'.($sweepstakes ? ': Sweepstakes' : ''));
	add_photo();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Share a Photo</title>
		<?php
			$page_title = 'Image First: Step 1: Image';
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
						<h1 class="heading-1">Share a Photo</h1>
						<h3 class="heading-4 small">Photos help future shoppers make decisions on what they buy.</h3>
					</header>
					<input type="file" class="file" name="review_image" id="add-media">
					<section id="images">
						<label for="add-media" class="secondary action add-image">
							<p><img class="empty" src="../images/image-placeholder.png" /></p>
							<p><span class="btn-primary full">Find or Take a Photo</span></p>
						</label>
					</section>
				</form>
			</div>
		</section>
	</body>
</html>
