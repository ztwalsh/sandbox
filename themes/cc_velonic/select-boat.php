<?php
	require('lib/config.php');
	check_login();
	select_boat();
?>
<!DOCTYPE html>
<html class="no-js">
	<?php
		$meta_title = 'Select your boat | CrewConnect';
		$meta_description = '';
		$meta_keywords = '';
		require('lib/include.head.php');
	?>
	<body>
		<div class="login">
			<div class="panel">
				<p><img height="auto" src="<?php echo $root; ?>images/login-flag_120x115.jpg" width="80" /></p>
				<h1>Select your boat</h1>
				<?php display_possible_boats($_SESSION['member_id']); ?>
			</div>
		</div>
	</body>
</html>
