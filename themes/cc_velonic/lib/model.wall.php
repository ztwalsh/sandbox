<?php
	function get_wall_entries($boat_id) {
		global $mysqli;

		$query = 	"SELECT * ";
		$query .= 	"FROM cc_wall ";
		$query .= 	"WHERE bid = ".$boat_id." ";
		$query .= 	"ORDER BY post_time DESC";

		return $mysqli->query($query);
	}

	function insert_wall_post() {
		global $mysqli;

		$wall_message				= trim($_POST['message']);
		$wall_message_time 			= time();
		$wall_message_user			= $_SESSION['member_id'];
		$wall_message_boat			= $_SESSION['boat_id'];

		$query = 	"INSERT INTO ";
		$query .= 	"cc_wall (";
		$query .= 	"message, uid, bid, post_time";
		$query .= 	") VALUES ('";
		$query .= 	$wall_message."', '".$wall_message_user."', '".$wall_message_boat."', '".$wall_message_time."'";
		$query .= 	")";

		$mysqli->query($query);

		return $mysqli->insert_id;
	}
?>