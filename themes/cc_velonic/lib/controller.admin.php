<?php
	function admin_sticky () {
		global $root;

		if ($_SESSION['admin']) {
			echo '<div class="admin-sticky">';
			echo '<h1 class="heading-2">Admin</h1>';
			echo '<a href="'.$root.'admin">Admin home</a>';
			echo '<a class="hide" href="#">Hide</a>';
			echo '</div>';
		}
	}
?>