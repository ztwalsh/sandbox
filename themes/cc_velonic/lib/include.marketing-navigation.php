<nav class="marketing">
	<div class="wrapper cf">
		<div class="logo">
			<a href="<?php echo $root; ?>"><img height="" src="<?php echo $root; ?>images/crewconnect_logo.jpg" width="" /></a>
		</div>
		<div class="actions">
			<a class="login" href="<?php echo $root; ?>login.php">Log in</a>
			<a class="signup" href="<?php echo $root; ?>signup">Sign up</a>
		</div>
		<div class="menu">
			<a href="<?php echo $root; ?>how-it-works.php"<?php display_current_page('how-it-works', $page); ?>>How it works</a>
			<a href="<?php echo $root; ?>features.php"<?php display_current_page('features', $page); ?>>Features</a>
			<a href="<?php echo $root; ?>pricing.php"<?php display_current_page('pricing', $page); ?>>Pricing</a>
		</div>
	</div>
</nav>