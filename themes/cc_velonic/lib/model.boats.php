<?php
	function get_all_boats() {
		global $mysqli;

		$query = "SELECT * ";
		$query .= "FROM cc_boats ";
		$query .= "ORDER BY name ASC";

		return $mysqli->query($query);
	}

	function get_possible_boats($member_id) {
		global $mysqli;

		$query = "SELECT * ";
		$query .= "FROM cc_boats ";
		$query .= "WHERE id IN ";
		$query .= "(SELECT bid FROM cc_boats_members WHERE uid = ".$member_id.")";

		return $mysqli->query($query);
	}

	function get_single_boat($boat_id) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_boats ";
		$query .= 	"WHERE id = ".$boat_id;

		return $mysqli->query($query);
	}

	function get_single_boat_with_pin($boat_id, $boat_pin) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_boats ";
		$query .= 	"WHERE id = '".$boat_id."' ";
		$query .= 	"AND boat_pin = '".$boat_pin."'";

		return $mysqli->query($query);
	}

	function update_boat($boat_id) {
		global $mysqli;

		$boat_name				= trim($_POST['name']);
		$boat_type 				= trim($_POST['type']);
		$boat_city 				= trim($_POST['city']);
		$boat_harbor			= trim($_POST['harbor']);
		$boat_dock_num 			= trim($_POST['dock_num']);
		$boat_slip_num 			= trim($_POST['slip_num']);

		$query = "UPDATE cc_boats SET ";
		$query .= "name = '".$boat_name."', ";
		$query .= "type = '".$boat_type."', ";
		$query .= "city = '".$boat_city."', ";
		$query .= "harbor = '".$boat_harbor."', ";
		$query .= "dock_num = '".$boat_dock_num."', ";
		$query .= "slip_num = '".$boat_slip_num."' ";
		$query .= "WHERE id = '".$boat_id."'";

		return $mysqli->query($query);
	}

	function update_billing($customer_id, $subscription_id, $boat_id) {
		global $mysqli;

		$query = "UPDATE cc_boats SET ";
		$query .= "customer_id = '".$customer_id."', ";
		$query .= "billing_key = '".$subscription_id."' ";
		$query .= "WHERE id = '".$boat_id."'";

		return $mysqli->query($query);
	}

	function cancel_boat($boat_id) {
		global $mysqli;

		$query = "UPDATE cc_boats SET ";
		$query .= "customer_id = NULL, ";
		$query .= "billing_key = NULL ";
		$query .= "WHERE id = '".$boat_id."'";

		return $mysqli->query($query);
	}
?>