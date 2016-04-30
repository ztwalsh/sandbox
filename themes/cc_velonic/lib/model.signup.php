<?php
	function insert_user() {
		global $mysqli;

		$firstname 					= trim($_POST['firstname']);
		$lastname 					= trim($_POST['lastname']);
		$email 						= trim($_POST['email']);
		$city	 					= trim($_POST['city']);
		$password 					= generate_hash(trim($_POST['password']));
		$weight 					= trim($_POST['weight']);
		$weight_unit 				= $_POST['weight_unit'];
		$activation_token			= generate_activation_token();
		$last_activation_request	= time();
		$signup_date				= time();

		$query = 	"INSERT INTO cc_users (";
		$query .= 	"fname, lname, email, Password, weight, weight_unit, city, Username, Username_Clean, ActivationToken, LastActivationRequest, SignUpDate, Active";
		$query .= 	") VALUES (";
		$query .= 	"'".$firstname."', '".$lastname."', '".$email."', '".$password."', '".$weight."', '".$weight_unit."', '".$city."', '".$email."', '".$email."', '".$activation_token."', '".$last_activation_request."', '".$signup_date."', 1";
		$query .= 	")";

		$mysqli->query($query);
		return $mysqli->insert_id;
	}

	function update_user_registration($member_id) {
		global $mysqli;

		$firstname 					= trim($_POST['firstname']);
		$lastname 					= trim($_POST['lastname']);
		$password 					= generate_hash(trim($_POST['password']));
		$weight 					= trim($_POST['weight']);
		$weight_unit 				= $_POST['weight_unit'];

		$query = 	"UPDATE cc_users SET ";
		$query .= 	"fname = '".$firstname."', ";
		$query .= 	"lname = '".$lastname."', ";
		$query .= 	"Password = '".$password."', ";
		$query .= 	"weight = '".$weight."', ";
		$query .= 	"weight_unit = '".$weight_unit."', ";
		$query .= 	"Active = 1 ";
		$query .= 	"WHERE id = '".$member_id."'";
		
		$mysqli->query($query);
	}

	function insert_boat() {
		global $mysqli;

		$skipperid		= $_SESSION['signup_member_id'];
		$boatname		= trim($_POST['boatname']);
		$sailnumber		= trim($_POST['sailnumber']);
		$boatmake		= trim($_POST['boatmake']);
		$boatmodel		= trim($_POST['boatmodel']);
		$city			= trim($_POST['city']);
		$boatpin		= substr(md5(number_format(time() * mt_rand(),0,'','')),0,8);
		$createddate	= time();

		$query = "INSERT INTO cc_boats (";
		$query .= "skipper_uid, name, sail_number, type, boat_pin, created_date, city";
		$query .= ") VALUES ('";
		$query .= $skipperid."', '".$boatname."', '".$sailnumber."', '".$boatmake."', '".$boatpin."', ".$createddate.", '".$city."'";
		$query .= ")";
		$mysqli->query($query);
		return $mysqli->insert_id;
	}

	function insert_user_level($member_id, $boat_id, $member_level = '99') {
		global $mysqli;

		$query = 	"INSERT INTO cc_boats_members (";
		$query .=	"uid, bid, user_level";
		$query .=	") VALUES (";
		$query .=	"'".$member_id."','".$boat_id."','".$member_level."'";
		$query .=	")";

		$mysqli->query($query);
	}

	function get_member_id_by_token($token) {
		global $mysqli;

		$token = trim($token);

		$token_check = $mysqli->query("SELECT * FROM cc_users WHERE ActivationToken = '".$token."'");
		$token_id = mysqli_fetch_assoc($token_check);
		if ($token_check->num_rows == 1) {
			return $token_id['id'];
		} else {
			return false;
		}
	}

	function make_user_active($id) {
		global $mysqli;

		$update_user_active = $mysqli->query("UPDATE cc_users SET active = 1 WHERE id = ".$id."");
		if ($update_user_active) {
			return true;
		} else {
			return false;
		}
	}
?>