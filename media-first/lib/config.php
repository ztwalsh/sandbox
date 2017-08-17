<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost:8000') {
    //if (!ini_get('display_errors')) { ini_set('display_errors', '1'); }
    //if (!ini_get('display_startup_errors')) { ini_set('display_startup_errors', '1'); }
    $root 			= 'http://localhost:8000/sandbox.ztwalsh.com/media-first/';
    $host 			= 'localhost';
    $username 		= 'root';
    $password 		= 'root';
    $database 		= 'review_collection';
  }

  $review_images 	= $root.'images/reviews/';
  $mysqli         = new mysqli($host, $username, $password, $database);

  session_start();
  require('lib/functions.php');
?>
