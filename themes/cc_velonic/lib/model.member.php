<?php
	function get_all_members($boat_id, $status) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_users ";
		$query .= 	"WHERE id IN ";
		$query .= 	"(SELECT DISTINCT(uid) FROM cc_boats_members WHERE bid = ".$boat_id." ";
		if ($status == 'suspended') {
			$query .=	"AND user_level = 0)";
		} elseif ($status == 'revoked') {
			$query .=	"AND user_level = -1)";
		} else {
			$query .= "AND user_level in (1,2,3,10,99)) ORDER BY lname ASC";
		}

		return $mysqli->query($query);
	}

	function get_all_active_members($boat_id) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_users ";
		$query .= 	"WHERE id IN ";
		$query .= 	"(SELECT DISTINCT(uid) FROM cc_boats_members WHERE bid = ".$boat_id." AND user_level != '-1' AND user_level != '0')";

		return $mysqli->query($query);
	}

	function get_single_member($member_id) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_users ";
		$query .= 	"WHERE id = ".$member_id;

		return $mysqli->query($query);
	}

	function get_member_group($group) {
		global $mysqli;

		$group = join(',', $group);

		$query =	"SELECT * ";
		$query .=	"FROM cc_users ";
		$query .= 	"WHERE id in (".$group.")";

		return $mysqli->query($query);
	}

	function get_single_member_by_email($member_email) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_users ";
		$query .= 	"WHERE email = '".$member_email."'";

		$result = $mysqli->query($query);

		return $result->fetch_assoc();
	}

	function get_boat($member_id) {
		global $mysqli;

		$query = "SELECT bid ";
		$query .= "FROM cc_boats_members ";
		$query .= "WHERE uid = ".$member_id;

		return $mysqli->query($query);
	}

	function get_active_members($boat_id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_users ";
		$query .= 	"WHERE bid = ".$boat_id." ";
		$query .= 	"AND status = 1";

		return $mysqli->query($query);
	}

	function get_selected_event_members($event_id) {
		global $mysqli;

		$query = 	"SELECT * "; 
		$query .=	"FROM cc_users ";
		$query .=	"WHERE cc_users.id IN ";
		$query .=	"(SELECT DISTINCT(uid) FROM cc_event_signup WHERE cc_event_signup.eid = ".$event_id." AND cc_event_signup.status IN (0,2,3,4))";

		return $mysqli->query($query);
	}

	function get_available_event_members($event_id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_users ";
		$query .= 	"WHERE cc_users.id IN ";
		$query .= 	"(SELECT DISTINCT(uid) FROM cc_boats_members WHERE cc_boats_members.bid = ".$_SESSION['boat_id']." AND user_level in (1,2,3,10,99)) ";
		//$query .= 	"GROUP BY cc_users.id ";
		$query .= 	"ORDER BY cc_users.lname ASC";

		return $mysqli->query($query);
	}

	function add_member($email, $firstname, $lastname) {
		global $mysqli;

		$firstname 					= trim($firstname);
		$lastname 					= trim($lastname);
		$email 						= trim($email);
		$activation_token			= generate_activation_token();
		$last_activation_request	= time();
		$signup_date				= time();

		$query = 	"INSERT INTO cc_users (";
		$query .= 	"fname, lname, email, Username, Username_Clean, ActivationToken, LastActivationRequest, SignUpDate";
		$query .= 	") VALUES (";
		$query .= 	"'".$firstname."', '".$lastname."', '".$email."', '".$email."', '".$email."', '".$activation_token."', '".$last_activation_request."', '".$signup_date."'";
		$query .= 	")";

		$mysqli->query($query);
		return $mysqli->insert_id;
	}

	function check_membership($member_id, $boat_id) {
		global $mysqli;

		$query = "SELECT id ";
		$query .= "FROM cc_boats_members ";
		$query .= "WHERE uid = ".$member_id." ";
		$query .= "AND bid = ".$boat_id;

		$result = $mysqli->query($query);

		return $result->fetch_assoc();
	}

	function add_member_to_event($member_id, $event_id) {
		global $mysqli;

		$check_query = 		"SELECT * ";
		$check_query .= 	"FROM cc_event_signup ";
		$check_query .=		"WHERE uid = ".$member_id." ";
		$check_query .=		"AND eid = ".$event_id." ";
		$check_query .=		"AND bid = ".$_SESSION['boat_id'];

		$check_query = $mysqli->query($check_query);

		$count = mysqli_num_rows($check_query);

		if ($count == 0) {
			$query = 	"INSERT INTO cc_event_signup (";
			$query .=	"uid, eid, pid, status, type, bid";
			$query .=	") VALUES (";
			$query .=	"'".$member_id."', '".$event_id."', '0', '4', '0', '".$_SESSION['boat_id']."'";
			$query .=	")";

			return $mysqli->query($query);
		} else {
			return false;
		}
	}

	function remove_member_from_event($member_id, $event_id) {
		global $mysqli;

		$query = 	"DELETE FROM cc_event_signup ";
		$query .=	"WHERE uid = ".$member_id." ";
		$query .=	"AND eid = ".$event_id;

		return $mysqli->query($query);
	}

	function get_member_privilege_status($member_id, $boat_id) {
		global $mysqli;

		$query = 	"SELECT user_level ";
		$query .= 	"FROM cc_boats_members ";
		$query .= 	"WHERE uid = '".$member_id."' ";
		$query .= 	"AND bid = '".$boat_id."'";

		$result = $mysqli->query($query);

		return $result->fetch_assoc();
	}

	function set_member_privilege($member_id, $boat_id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_boats_members ";
		$query .= 	"WHERE uid = '".$member_id."' ";
		$query .= 	"AND bid = '".$boat_id."'";
		
		return $mysqli->query($query);
	}

	function change_member_privilege($member_id, $boat_id, $new_status) {
		global $mysqli;

		$query = 	"UPDATE cc_boats_members SET ";
		$query .=	"user_level = '".$new_status."' ";
		$query .= 	"WHERE bid = '".$boat_id."' ";
		$query .= 	"AND uid = '".$member_id."'";

		return $mysqli->query($query);
	}

	function update_member_status($member_id, $boat_id) {
		global $mysqli;

		$query = 	"UPDATE cc_boats_members SET ";
		$query .=	"user_level = '1' ";
		$query .= 	"WHERE bid = '".$boat_id."' ";
		$query .= 	"AND uid = '".$member_id."'";

		return $mysqli->query($query);
	}

	function get_suspended_members() {
	}

	function get_revoked_members() {
	}

	function update_profile($member_id) {
		global $mysqli;

		$member_firstname			= trim(addslashes($_POST['firstname']));
		$member_lastname 			= trim(addslashes($_POST['lastname']));
		$member_city 				= trim(addslashes($_POST['city']));
		$member_email 				= trim(addslashes($_POST['email']));
		$member_weight 				= trim(addslashes($_POST['weight']));
		$member_weight_unit 		= $_POST['weight_unit'];

		$query = 	"UPDATE cc_users SET ";
		$query .= 	"fname = '".$member_firstname."', ";
		$query .= 	"lname = '".$member_lastname."', ";
		$query .= 	"city = '".$member_city."', ";
		$query .= 	"email = '".$member_email."', ";
		$query .= 	"weight = '".$member_weight."', ";
		$query .= 	"weight_unit = '".$member_weight_unit."' ";
		$query .= 	"WHERE id = '".$member_id."'";

		return $mysqli->query($query);
	}

	function update_profile_password($member_id) {
		global $mysqli;

		$member_new_password		= generate_hash(trim($_POST['new_password']));

		$query = 	"UPDATE cc_users SET ";
		$query .= 	"Password = '".$member_new_password."' ";
		$query .= 	"WHERE id = '".$member_id."'";

		return $mysqli->query($query);
	}

	function update_profile_photo($member_id, $file_name) {
		global $mysqli;

		$query = 	"UPDATE cc_users SET ";
		$query .= 	"user_image = '".$file_name."', ";
		$query .= 	"user_image_thumb = '".$file_name."' ";
		$query .= 	"WHERE id = '".$member_id."'";

		return $mysqli->query($query);
	}

	function update_member_password($password, $token, $member_id) {
		global $mysqli;

		$member_new_password		= generate_hash(trim($password));

		$query = 	"UPDATE cc_users SET ";
		$query .= 	"Password = '".$member_new_password."' ";
		$query .= 	"WHERE ActivationToken = '".$token."' ";
		$query .= 	"AND id = '".$member_id."'";

		return $mysqli->query($query);

	}
?>