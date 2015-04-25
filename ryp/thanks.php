<?php
	include('lib/functions.php');
	session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<?php
			$title = 'Thanks for your review';
			include('lib/include.head.php');
		?>
	</head>
	<body>
		<div class="abt-header"></div>
		<div class="wrapper">
			<h1 class="headline1">Thank you!</h1>
			<p>We'll process your review. Accepted reviews will be posted within 3&ndash;5 business days.</p>
		</div>
		<div class="wrapper">
			<section class="preview">
				<header>
					<div class="rating cf">
						<?php show_stars($_SESSION['review']['rating']); ?>
					</div>
					<h1 class="headline1"><?php echo stripslashes($_SESSION['review']['headline']); ?></h1>
					By <?php echo stripslashes($_SESSION['review']['firstname']); ?> from <?php echo stripslashes($_SESSION['review']['location']); ?> on <?php echo date('m/d/Y'); ?>
					<div class="tags cf">
						<div class="span3"><?php show_selections($_SESSION['review']['pros'], 'Pros'); ?></div>
						<div class="span3"><?php show_selections($_SESSION['review']['cons'], 'Cons'); ?></div>
						<div class="span3"><?php show_selections($_SESSION['review']['best'], 'Best for'); ?></div>
					</div>
				</header>
				<section>
					<?php
						echo stripslashes($_SESSION['review']['product_comments']);
					?>
				</section>
				<section class="content">
					<h3 class="headline3">Bottom Line</h3>
					<p class="small">
					<?php
						echo $_SESSION['review']['bottom_line'];
					?>
					</p>
				</section>
			</section>
		</div>
	</body>
	<?php
		unset($_SESSION['review']);
	?>
</html>