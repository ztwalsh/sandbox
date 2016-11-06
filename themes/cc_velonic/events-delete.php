<?php
	require('lib/config.php');
	check_login();
	remove_event($_GET['delete_id']);
?>
