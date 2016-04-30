<?php
	function get_all_sails($boat_id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_sail_inventory ";
		$query .= 	"WHERE bid = ".$boat_id." ";
		$query .= 	"AND status = 1";

		return $mysqli->query($query);
	}

	function get_single_sail($id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_sail_inventory ";
		$query .= 	"WHERE id = ".$id." ";
		$query .= 	"AND status = 1";

		return $mysqli->query($query);
	}

	function insert_sail($member_id, $boat_id) {
		global $mysqli;

		$sail_uid					= $member_id;
		$sail_bid					= $boat_id;
		$sail_type					= trim($_POST['type']);
		$sail_year					= trim($_POST['year']);
		$sail_sub_type				= trim($_POST['sub_type']);
		$sail_sailmaker				= trim($_POST['sailmaker']);
		$sail_material				= trim($_POST['material']);
		$sail_condition_rating		= trim($_POST['condition_rating']);
		$sail_condition_desc		= trim($_POST['condition_desc']);

		$query = 	"INSERT INTO ";
		$query .= 	"cc_sail_inventory (";
		$query .= 	"uid, bid, type, year, sub_type, sailmaker, material, condition_rating, condition_desc";
		$query .= 	") VALUES (";
		$query .= 	"'".$sail_uid."','".$sail_bid."','".$sail_type."', '".$sail_year."', '".$sail_sub_type."', '".$sail_sailmaker."', '".$sail_material."', '".$sail_condition_rating."', '".$sail_condition_desc."'";
		$query .= 	")";

		$mysqli->query($query);

		return $mysqli->insert_id;
	}

	function update_sail($sail_id) {
		global $mysqli;

		$sail_type					= trim($_POST['type']);
		$sail_year					= trim($_POST['year']);
		$sail_sub_type				= trim($_POST['sub_type']);
		$sail_sailmaker				= trim($_POST['sailmaker']);
		$sail_material				= trim($_POST['material']);
		$sail_condition_rating		= trim($_POST['condition_rating']);
		$sail_condition_desc		= trim($_POST['condition_desc']);

		$query = 	"UPDATE cc_sail_inventory SET ";
		$query .= 	"type = '".$sail_type."', ";
		$query .= 	"year = '".$sail_year."', ";
		$query .= 	"sub_type = '".$sail_sub_type."', ";
		$query .= 	"sailmaker = '".$sail_sailmaker."', ";
		$query .= 	"material = '".$sail_material."', ";
		$query .= 	"condition_rating = '".$sail_condition_rating."', ";
		$query .= 	"condition_desc = '".$sail_condition_desc."' ";
		$query .= 	"WHERE id = '".$sail_id."'";

		return $mysqli->query($query);
	}

	function get_selected_event_sails($event_id) {
		global $mysqli;

		$query = 	"SELECT * "; 
		$query .=	"FROM cc_sail_inventory ";
		$query .=	"WHERE cc_sail_inventory.id IN ";
		$query .=	"(SELECT DISTINCT(secondary_id) FROM cc_assignments WHERE cc_assignments.aid = '4' AND cc_assignments.target_id = '".$event_id."')";

		$query = $mysqli->query($query);

		return $query;
	}

	function get_available_event_sails($event_id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_sail_inventory ";
		$query .= 	"WHERE cc_sail_inventory.bid = '".$_SESSION['boat_id']."' ";
		$query .= 	"AND cc_sail_inventory.status = 1 ";

		$query = $mysqli->query($query);

		return $query;
	}

	function add_sail_to_event($sail_id, $event_id) {
		global $mysqli;

		$check_query = 		"SELECT * ";
		$check_query .= 	"FROM cc_assignments ";
		$check_query .= 	"WHERE aid = 4 ";
		$check_query .= 	"AND bid = '".$_SESSION['boat_id']."', ";
		$check_query .= 	"AND target_id = '".$event_id."', ";
		$check_query .= 	"AND secondary_id = '".$sail_id."'";

		$check_query = $mysqli->query($check_query);

		//$count = mysqli_num_rows($check_query);

		if (!$check_query) {
			$query = 	"INSERT INTO cc_assignments (";
			$query .=	"aid, bid, target_id, secondary_id";
			$query .=	") VALUES (";
			$query .=	"'4', '".$_SESSION['boat_id']."', '".$event_id."', '".$sail_id."'";
			$query .=	")";

			$query = $mysqli->query($query);

			return $query;
		} else {
			return false;
		}
	}

	function remove_sail_from_event($sail_id, $event_id) {
		global $mysqli;

		$query = 	"DELETE FROM cc_assignments ";
		$query .= 	"WHERE aid = 4 ";
		$query .= 	"AND bid = '".$_SESSION['boat_id']."' ";
		$query .= 	"AND target_id = '".$event_id."' ";
		$query .= 	"AND secondary_id = '".$sail_id."'";

		$query = $mysqli->query($query);

		return $query;
	}

	function delete_sail($sail_id) {
		global $mysqli;

		$query = "UPDATE cc_sail_inventory SET ";
		$query .= "status = '0' ";
		$query .= "WHERE id = '".$sail_id."'";
		
		return $mysqli->query($query);
	}

	function get_sail_entries($sail_id, $boat_id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_sail_logs ";
		$query .= 	"WHERE sail_id = ".$sail_id." ";
		$query .= 	"AND boat_id = ".$boat_id." ";
		$query .= 	"ORDER BY post_time DESC";

		return $mysqli->query($query);
	}

	function insert_sail_log_post($sail_id) {
		global $mysqli;

		$sail_message				= trim($_POST['log_entry']);
		$sail_message_time 			= time();
		$sail_message_sail			= $sail_id;
		$sail_message_user			= $_SESSION['member_id'];
		$sail_message_boat			= $_SESSION['boat_id'];

		$query = 	"INSERT INTO ";
		$query .= 	"cc_sail_logs (";
		$query .= 	"log_entry, sail_id, user_id, boat_id, post_time";
		$query .= 	") VALUES ('";
		$query .= 	$sail_message."', '".$sail_message_sail."', '".$sail_message_user."', '".$sail_message_boat."', '".$sail_message_time."'";
		$query .= 	")";

		$mysqli->query($query);

		return $mysqli->insert_id;
	}
?>