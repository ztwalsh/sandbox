<?php
	function get_events($boat_id, $member_id = NULL, $view = NULL, $status = 1) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_events ";
		$query .=	"WHERE status = ".$status." ";
		$query .= 	"AND bid = ".$boat_id." ";
		if ($view == 'member') {
			if ($member_id) {
				$query .= 	"AND id IN ";
				$query .= 	"(SELECT DISTINCT(eid) FROM cc_event_signup WHERE cc_event_signup.bid = ".$boat_id." AND cc_event_signup.uid = ".$member_id.") ";
				$query .= 	"AND (edate > ".time()." ";
				$query .= 	"OR edate_end > ".time().") ";
				$query .=	"ORDER BY edate DESC";
			}
		} else {
			$query .=	"ORDER BY edate DESC";
		}

		$result = $mysqli->query($query);

		if ($result) {
			return $result;
		} else {
			return false;
		}

		//echo $query;
	}

	function get_single_event($id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_events ";
		$query .= 	"WHERE id = ".$id." ";
		$query .= 	"AND status = 1";

		return $mysqli->query($query);
	}

	function insert_event($boat_id) {
		global $mysqli;

		if ($_POST['hour']) {
			$hour = trim($_POST['hour']);
		} else {
			$hour = '8';
		}

		if ($_POST['minute']) {
			$minute = trim($_POST['minute']);
		} else {
			$minute = '00';
		}

		if ($_POST['am-pm']) {
			$ampm = trim($_POST['am-pm']);
		} else {
			$ampm = 'am';
		}

		$event_name						= trim($_POST['name']);
		$event_type 					= trim($_POST['type']);
		$event_date 					= strtotime($_POST['edate'] . " " . $hour.':'.$minute.''.$ampm);
		$event_location 			= trim($_POST['location']);
		$event_description		= trim($_POST['description']);
		$event_sails 					= trim($_POST['sails']);

		$query = 	"INSERT INTO ";
		$query .= 	"cc_events (";
		$query .= 	"name, type, edate, location, description, bid, status";
		if (!empty($_POST['edate_end'])) {
			$query .= ", edate_end";
		}
		$query .= 	") VALUES ('";
		$query .= 	$event_name."', '".$event_type."', '".$event_date."', '".$event_location."', '".$event_description."', '".$boat_id."', '1'";
		if (!empty($_POST['edate_end'])) {
			$query .= ", ".strtotime($_POST['edate_end']);
		}
		$query .= 	")";
		$mysqli->query($query);
		//return $query;
		return $mysqli->insert_id;
	}

	function add_creator_to_event($event_id, $member_id, $boat_id) {
		global $mysqli;

		$query = 	"INSERT INTO ";
		$query .= 	"cc_event_signup (";
		$query .= 	"eid, uid, bid, status";
		$query .= 	") VALUES ('";
		$query .= 	$event_id."', '".$member_id."', '".$boat_id."', '1'";
		$query .= 	")";

		$mysqli->query($query);
	}

	function update_event($event_id) {
		global $mysqli;

		$event_name					= trim(addslashes($_POST['name']));
		$event_type 				= trim($_POST['type']);
		$event_date 				= strtotime($_POST['edate'] . " " . $_POST['hour'].':'.$_POST['minute'].''.$_POST['am-pm']);
		$event_location 			= trim(addslashes($_POST['location']));
		$event_description			= trim(addslashes($_POST['description']));
		//$event_sails 				= trim($_POST['sails']);

		$query = 	"UPDATE cc_events SET ";
		$query .= 	"name = '".$event_name."', ";
		$query .= 	"type = '".$event_type."', ";
		$query .= 	"edate = '".$event_date."', ";
		if ($_POST['edate_end']) {
			$query .= 	"edate_end = '".strtotime($_POST['edate_end'])."', ";
		} else {
			$query .= 	"edate_end = NULL, ";
		}
		$query .= 	"location = '".$event_location."', ";
		$query .= 	"description = '".$event_description."' ";
		$query .= 	"WHERE id = '".$event_id."'";

		return $mysqli->query($query);
	}

	function event_status($member_id, $event_id, $boat_id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_event_signup ";
		$query .= 	"WHERE uid = ".$member_id." ";
		$query .= 	"AND eid = ".$event_id." ";
		$query .= 	"AND bid = ".$boat_id." ";
		$query .= 	"ORDER BY id ASC ";
		$query .= 	"LIMIT 1";

		$result = $mysqli->query($query);

		if ($result) {
			return $result->fetch_assoc();
		} else {
			return false;
		}
	}

	function change_rsvp_status($member_id, $event_id, $boat_id, $new_status) {
		global $mysqli;

		$query = 	"UPDATE cc_event_signup SET ";
		$query .=	"status = '".$new_status."' ";
		$query .= 	"WHERE eid = '".$event_id."' ";
		$query .= 	"AND bid = '".$boat_id."' ";
		$query .= 	"AND uid = '".$member_id."'";

		return $mysqli->query($query);
	}

	function delete_event($event_id) {
		global $mysqli;

		$query = "UPDATE cc_events SET ";
		$query .= "status = 0 ";
		$query .= "WHERE id = '".$event_id."'";
		return $mysqli->query($query);
	}

	function count_members($event_id, $boat_id) {
		global $mysqli;

		$query = 	"SELECT DISTINCT uid ";
		$query .= 	"FROM cc_event_signup ";
		$query .= 	"WHERE eid = '".$event_id."' ";
		$query .= 	"AND bid = '".$boat_id."' ";
		$query .= 	"AND status = 3";

		$result = $mysqli->query($query);

		$count = mysqli_num_rows($result);

		return $count;
	}
?>
