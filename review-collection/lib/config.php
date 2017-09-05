<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost:8000') {
    //if (!ini_get('display_errors')) { ini_set('display_errors', '1'); }
    //if (!ini_get('display_startup_errors')) { ini_set('display_startup_errors', '1'); }
    $root 			= 'http://localhost:8000/sandbox.ztwalsh.com/review-collection/';
    $host 			= 'localhost';
    $username 		= 'root';
    $password 		= 'root';
    $tracking     = false;
  } elseif ($_SERVER['HTTP_HOST'] == 'x.ztwalsh.com') {
    $root 			= 'http://x.ztwalsh.com/review-collection/';
    $host 			= 'localhost';
    $username 		= 'ztwalshdb';
    $password 		= 'Z#twrz843';
    $tracking     = true;
  }

  $database 		= 'review_collection';

  require 'cloudinary/Cloudinary.php';
  require 'cloudinary/Uploader.php';
  require 'cloudinary/Api.php';

  $mysqli         = new mysqli($host, $username, $password, $database);

  \Cloudinary::config(array(
    "cloud_name" => "deycjf1yb",
    "api_key" => "573789383394411",
    "api_secret" => "J2jA0gYUbAL6oKeaMIxzD2pmAaQ"
  ));

  session_start();
  require('functions.php');

  $merchant_group_id = set_session_var('merchant_group_id');
  $page_id = set_session_var('page_id');
  $ip = $_SERVER['REMOTE_ADDR'];
  $product_name = set_session_var('product_name', 'Ray-Ban New Wayfarer Classic Tortoise');
  $product_image_url = set_session_var('product_image_url', $root.'images/rayban.jpeg');
  $page_title = 'No Data';
  $sweepstakes = set_session_var('sweepstakes', false);
?>
