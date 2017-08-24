<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost:8000') {
    if (!ini_get('display_errors')) { ini_set('display_errors', '1'); }
    if (!ini_get('display_startup_errors')) { ini_set('display_startup_errors', '1'); }
    $root 			= 'http://localhost:8000/sandbox.ztwalsh.com/media-first/image-first';
    $host 			= 'localhost';
    $username 		= 'root';
    $password 		= 'root';
    $database 		= 'review_collection';
  } elseif ($_SERVER['HTTP_HOST'] == 'x.ztwalsh.com') {
    $root 			= 'http://x.ztwalsh.com/media-first/image-first';
    $host 			= 'localhost';
    $username 		= 'ztwalshdb';
    $password 		= 'Z#twrz843';
    $database 		= 'review_collection';
  }

  require 'cloudinary/Cloudinary.php';
  require 'cloudinary/Uploader.php';
  require 'cloudinary/Api.php';

  $review_images 	= $root.'images/reviews/';
  $mysqli         = new mysqli($host, $username, $password, $database);

  \Cloudinary::config(array(
    "cloud_name" => "deycjf1yb",
    "api_key" => "573789383394411",
    "api_secret" => "J2jA0gYUbAL6oKeaMIxzD2pmAaQ"
  ));

  session_start();
  require('lib/functions.php');
?>
