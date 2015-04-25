<?php
	include('lib/functions.php');
	if (isset($_POST['submit'])) {
		$result = single_processor();
		if(is_array($result)) {
			header('Location: thanks.php');
		} else {
			$error = $result;
		}
	}
	session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<?php
			$title = 'Review Your Purchases';
			include('lib/include.head.php');
		?>
	</head>
	<body>
		<div class="wrapper cf">
			<div class="header cf">
				<h1 class="headline1">Review your purchases</h1>
			</div>
			<?php show_review_item('http://i5.walmartimages.com/dfw/dce07b8c-32fa/k2-_839c9cc7-6226-41b6-82a6-45fd79fa1197.v1.jpg', 'Zan Headgear Full Mask Neoprene, Black', '1', 'March 30, 2015'); ?>
			<?php show_review_item('http://www.acehardware.com/product/http%3A//ACE.imageg.net/graphics/product_images/pACE3-19736706enh-z6.jpg', 'GB Green Cable Ties Assorted Sizes 200/Tube', '2', 'March 2, 2015'); ?>
			<?php show_review_item('http://www.acehardware.com/product/http%3A//ACE.imageg.net/graphics/product_images/pACE-976352dt.jpg', 'Collins Gooseneck Wrecking Bar', '3', 'January 1, 2015'); ?>
			<?php show_review_item('http://i5.walmartimages.com/dfw/dce07b8c-4c63/k2-_2f662434-2adb-4d44-8a8c-434f23b5cbaf.v2.jpg', 'Nestle Waters Bottled Spring Water, 0.5 Liter, 24 Count', '4', 'November 22, 2014'); ?>
		</div>
	</body>
</html>