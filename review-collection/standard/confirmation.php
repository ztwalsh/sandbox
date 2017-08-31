<?php
  require('../lib/config.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Thank You</title>
    <?php
			$page_title = 'Control: Step 2: Confirmation';
			require('../lib/include.head.php');
		?>
	</head>

	<body>
    <div class="product-information-original cf">
			<div class="product-image">
				<img src="<?php echo $product_image_url; ?>" height="auto" width="100%" />
			</div>
			<div class="product-info">
				<h1 class="heading-3">Write a review</h1>
				<p><?php echo $product_name; ?></p>
			</div>
		</div>
    <section class="review-form">
			<div class="wrapper">
				<header id="step-info">
					<h1 class="heading-1">Thanks for your review!</h1>
					<h3 class="heading-4 small">This will really help shoppers.</h3>
				</header>
			</div>
		</section>
	</body>
</html>
