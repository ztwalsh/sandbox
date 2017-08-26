<?php
  $url_params = '?product_name=Ray-Ban%20New%20Wayfarer%20Classic%20Tortoise&product_image_url=https://assets.ray-ban.com//is/image/RayBan/8053672069303_shad_fr?$zoom$&merchant_group_id=444444&page_id=555555';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Review Collection</title>
		<?php require('lib/include.head.php'); ?>
	</head>

	<body>
		<section class="review-form">
			<div class="wrapper">
        <p>&nbsp;</p>
        <h1 class="heading-1">Review Collection Versions</h1>
        <p class="heading-3"><a href="standard/review.php<?php echo $url_params; ?>">Standard Collection</a></p>
        <p class="heading-3"><a href="image-first/image.php<?php echo $url_params; ?>">Image First Collection</a></p>
        <p class="heading-3"><a href="review-first/review.php<?php echo $url_params; ?>">Review First Collection</a></p>
			</div>
		</section>
	</body>
</html>
