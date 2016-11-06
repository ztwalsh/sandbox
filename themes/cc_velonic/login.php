<?php
	require('lib/config.php');
	$submission = login($_POST);
?>
<!DOCTYPE html>
<html class="no-js">
	<?php
		$meta_title = 'Log in | CrewConnect';
		$meta_description = 'Log in to your CrewConnect account.';
		$meta_keywords = 'login, sign in, account login';
		require_once('lib/include.head.php');
	?>
	<body>
		<div class="login">
			<div class="panel">
				<p><img height="auto" src="images/login-flag_120x115.jpg" width="80" /></p>
				<h1>Join your Crew</h1>

				<?php display_error_alert($submission); ?>

				<form action="login.php" method="post">
					<p><?php display_error('email', 'Enter your email'); ?>
					<?php form_input('email', '', 'email', 'Email address', '', 'email'); ?></p>

					<p><?php display_error('password', 'Enter your password'); ?>
					<?php form_input('password', '', 'password', 'Password', '', 'password'); ?></p>

					<p><?php primary_submit('Log in <i class="fa fa-angle-right"></i>'); ?></p>
				</form>
			</div>
			<p>Forgot your password? <a href="<?php echo $root; ?>reset-password.php">Recover it here <i class="fa fa-angle-right"></i></a><br />
				Not a member yet? <a href="<?php echo $root; ?>signup">Sign up here <i class="fa fa-angle-right"></i></a></p>
		</div>
	</body>
</html>
