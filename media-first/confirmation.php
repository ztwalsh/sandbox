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

				<section id="images">
					<input type="file" class="file" multiple id="add-media">
					<label for="add-media" class="secondary action add-image">
						<p><img class="empty" src="images/image-placeholder.png" /></p>
						<p><span class="btn-primary full">Find Photos or Videos</span></p>
					</label>
				</section>
			</div>
		</section>
	</body>
</html>
