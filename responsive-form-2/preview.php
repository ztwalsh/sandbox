<?php
	include('lib/functions.php');
	session_start();
	if (isset($_POST['submit'])) {
		header('Location: thanks.php');
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<?php 
			$title = 'Preview your review';
			include('lib/include.head.php');
		?>
	</head>
	<body>
		<div class="wrapper cf">
			<div class="product-image">
				<img src="http://images.buzzillions.com/images_products/10/11/22730758_100.jpg" height="auto" width="100%" />
			</div>
			<div class="product-info">
				<h1 class="headline1">Preview</h1>
				<p>Samsung 43" Black Plasma 720P HDTV by Samsung</p>
				<p class="small">Click "Edit Review" to make any changes to your submission</p>
			</div>
		</div>
		<form action="preview.php" method="post">
			<fieldset>
				<section class="preview">
					<header>
						<div class="rating cf">
							<?php show_stars($_SESSION['review']['rating']); ?>
						</div>
						<h1 class="headline1"><?php echo stripslashes($_SESSION['review']['headline']); ?></h1>
						By <?php echo stripslashes($_SESSION['review']['firstname']); ?> from <?php echo stripslashes($_SESSION['review']['location']); ?> on <?php echo date('m/d/Y'); ?>
					</header>
					<section class="content">
						<?php 
							show_selections($_SESSION['review']['pros'], 'Pros');
							show_selections($_SESSION['review']['cons'], 'Cons');
							show_selections($_SESSION['review']['best'], 'Best for');
						?>
						<h3 class="headline3">Bottom Line</h3>
						<p class="small">
						<?php
							echo $_SESSION['review']['bottom_line'];
						?>
						</p>
					</section>
					<section class="content">
						<p>
						<?php
							echo stripslashes($_SESSION['review']['product_comments']);
						?>
						</p>
						<p>
						<?php
							echo stripslashes($_SESSION['review']['service_comments']);
						?>
						</p>
					</section>
					<section class="content">
						<a class="secondary" href="index.php"><i class="fa fa-pencil"></i> Edit review</a>
					</section>
				</section>

				<p><a class="privacy-policy" href="#">Privacy policy</a></p>

				<p><?php form_checkbox('privacy', 'I agree with the privacy policy', 'privacy_policy'); ?>
				<?php form_checkbox('age', 'I am age 13 or older', 'age'); ?></p>
				<p><?php primary_submit('Submit <i class="fa fa-chevron-right"></i>'); ?></p>
				<p class="legal">All submitted reviews become the licensed property of PowerReviews.com. We reserve the right to reject or modify any reviews without notice. We will not use or share your personal information for marketing purposes. If you have further questions, please read the complete Privacy Policy and Terms of Use.</p>
			</fieldset>
		</form>
	</body>
</html>