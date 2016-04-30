<?php
	// Site constants
	if ($_SERVER['HTTP_HOST'] == 'localhost:8000') {
		if (!ini_get('display_errors')) { ini_set('display_errors', '1'); }
		if (!ini_get('display_startup_errors')) { ini_set('display_startup_errors', '1'); }
		$root 			= 'http://localhost:8000/crewconnect.com/';
		$host 			= 'localhost';
		$username 		= 'root';
		$password 		= 'root';
		$database 		= 'crewconnect';
	} elseif ($_SERVER['HTTP_HOST'] == 'staging.crewconnectonline.com') {
		if (!ini_get('display_errors')) { ini_set('display_errors', '1'); }
		if (!ini_get('display_startup_errors')) { ini_set('display_startup_errors', '1'); }
		$root 		= 'http://staging.crewconnectonline.com/';
		$host 		= 'internal-db.s196304.gridserver.com';
		$username 	= 'db196304';
		$password 	= 'crewconnect!Db1#';
		$database 	= 'db196304_crewconnect_replica';
	} elseif ($_SERVER['HTTP_HOST'] == 'www.crewconnectonline.com') {
		$root 		= 'https://www.crewconnectonline.com/';
		$host 		= 'internal-db.s196304.gridserver.com';
		$username 	= 'db196304';
		$password 	= 'crewconnect!Db1#';
		$database 	= 'db196304_crewconnect';
	}

	$member_images 	= $root.'images/users/';
	$mysqli 		= new mysqli($host, $username, $password, $database);


	// Include classes
	require('functions.core.php');
	require('functions.form-fields.php');
	require('model.boats.php');
	require('model.events.php');
	require('model.member.php');
	require('model.sails.php');
	require('model.signup.php');
	require('model.todo.php');
	require('model.wall.php');
	require('controller.boats.php');
	require('controller.dashboard.php');
	require('controller.email.php');
	require('controller.login.php');
	require('controller.events.php');
	require('controller.member.php');
	require('controller.sails.php');
	require('controller.signup.php');
	require('controller.todo.php');
	require('controller.wall.php');
	require('controller.billing.php');
	require('controller.admin.php');


	session_start();
	ob_start();
?>
