<?php

$host 			= 'localhost';
$username 		= 'root';
$password 		= 'root';

$database 		= 'stage_store_contacts';

$mysqli         = new mysqli($host, $username, $password, $database);

$update_query = "UPDATE contacts_unique SET product_name = (SELECT name FROM products_unique WHERE products_unique.page_id = contacts_unique.page_id)";
$mysqli->query($update_query);

// $contact_query = 	"SELECT * FROM contacts_unique WHERE group_id = 1";
// $contacts = $mysqli->query($contact_query);

//while ($contact = $contacts->fetch_assoc()) {
  // echo '<p>'.$count.': '.$contact['first_name'].' - '.$contact['email'].' - '.$contact['page_id'].'<br />';
  // $product_query = 'SELECT * FROM products WHERE page_id = '.$contact['page_id'].' GROUP BY page_id';
  // $products = $mysqli->query($product_query);
  // while ($product = $products->fetch_assoc()) {
  //   $add_to_contacts = "UPDATE contacts_unique SET product_name = '".$product['name']."', product_image_url = '".$product['product_image_url']."' WHERE email='".$contact['email']."'";
  //   echo $add_to_contacts.'</p>';
  // }
  // $count++;
  //$update_query = "UPDATE contacts_unique SET product_name = (SELECT name FROM products_unique WHERE products_unique.page_id = contacts_unique.page_id)";
  //echo '<p>'.$contact['id'].': '.$update_query.'</p>';
  //$mysqli->query($update_query);
//}

?>
