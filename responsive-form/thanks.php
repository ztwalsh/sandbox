<?php
	include('lib/functions.php');
	session_start();
	unset($_SESSION['review']);
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
		<div class="wrapper">
			<h1 class="headline1">Thank you!</h1>
			<p>We'll process your review. Accepted reviews will be posted within 3&ndash;5 business days.</p>
		</div>
		<div class="wrapper">
			<section class="preview">
				<header>
					<h1 class="headline1">Post to Facebook</h1>
					Post excerpts of your review to your Wall and your friends' News Feeds.
				</header>
				<section class="content">
					<a class="facebook" href="#"><i class="fa fa-facebook-square"></i> Share on Facebook</a>
				</section>
			</section>
		</div>
		<div class="wrapper">
			<section class="preview">
				<header>
					<h1 class="headline1">Create Trust</h1>
					Enter your email address to verify your review.
				</header>
				<section class="content">
					<form action="" method="post">
						<p><label class="main">Enter email</label>
						<?php form_input('email', '', 'email', ''); ?>
						<?php form_checkbox('remember', 'Remember Me', 'remember'); ?></p>
						<?php primary_submit('Verify review <i class="fa fa-chevron-right"></i>'); ?>
					</form>
				</section>
			</section>
		</div>
	</body>
</html>