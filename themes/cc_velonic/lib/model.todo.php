<?php
	function get_all_todos($boat_id, $status = null) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_todo ";
		$query .= 	"WHERE bid = ".$boat_id." ";
		if($status) {
			$query .= 	"AND status = ".$status." ";
		}
		$query .= 	"AND trash = 0 ";
		$query .=	"ORDER BY priority DESC, due_date DESC";

		return $mysqli->query($query);
	}

	function get_all_todos_by_member($boat_id, $member_id, $status = null) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_todo ";
		$query .= 	"WHERE bid = ".$boat_id." ";
		if($status) {
			$query .= 	"AND status = ".$status." ";
		}
		$query .= 	"AND trash = 0 ";
		$query .= 	"AND uid = ".$member_id." ";
		$query .=	"ORDER BY priority DESC, due_date";

		return $mysqli->query($query);
	}

	function get_single_todo($todo_id) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_todo ";
		$query .= 	"WHERE id = ".$todo_id;

		return $mysqli->query($query);
	}

	function get_todo_members($todo_id, $boat_id) {
		global $mysqli;

		$query =	"SELECT * ";
		$query .=	"FROM cc_assignments ";
		$query .= 	"WHERE bid = '".$boat_id."' ";
		$query .= 	"AND target_id = '".$todo_id."'";

		return $mysqli->query($query);
	}

	function insert_todo() {
		global $mysqli;

		$todo_name					= trim($_POST['name']);
		$todo_created_date 			= strtotime(date('m/d/Y'));
		$todo_date 					= strtotime($_POST['due_date']);
		$todo_priority 				= trim($_POST['priority']);
		$todo_description			= trim($_POST['description']);
		$todo_user					= trim($_SESSION['member_id']);
		$todo_boat_id				= $_SESSION['boat_id'];
		$todo_created_by_uid		= $_SESSION['member_id'];

		$query = "INSERT INTO cc_todo (";
		$query .= "name, create_date, due_date, priority, description, bid, uid, created_by_uid";
		$query .= ") VALUES (";
		$query .= "'".$todo_name."', '".$todo_created_date."', '".$todo_date."', '".$todo_priority."', '".$todo_description."', '".$todo_boat_id."', '".$todo_user."', '".$todo_created_by_uid."'";
		$query .= ")";

		$mysqli->query($query);
		return $mysqli->insert_id;
	}

	function add_assignments($member_id, $boat_id, $todo_id) {
		global $mysqli;

		$query = "INSERT INTO cc_assignments (";
		$query .= "aid, bid, target_id, secondary_id";
		$query .= ") VALUES (";
		$query .= "'1', '".$boat_id."', '".$todo_id."', '".$member_id."'";
		$query .= ")";

		$mysqli->query($query);
	}

	function delete_assignments($member_id, $boat_id, $todo_id) {
		global $mysqli;

		$query = "DELETE FROM cc_assignments ";
		$query .= "WHERE secondary_id = ".$member_id." ";
		$query .= "AND bid = ".$boat_id." ";
		$query .= "AND target_id = ".$todo_id;

		$mysqli->query($query);
	}

	function update_todo($todo_id) {
		global $mysqli;

		$todo_name					= trim($_POST['name']);
		$todo_date 					= strtotime($_POST['due_date']);
		$todo_priority 				= trim($_POST['priority']);
		$todo_description			= trim($_POST['description']);

		$query = "UPDATE cc_todo SET ";
		$query .= "name = '".$todo_name."', ";
		$query .= "due_date = '".$todo_date."', ";
		$query .= "priority = '".$todo_priority."', ";
		$query .= "description = '".$todo_description."' ";
		$query .= "WHERE id = '".$todo_id."'";

		return $mysqli->query($query);
	}

	function delete_todo($todo_id) {
		global $mysqli;

		$query = "UPDATE cc_todo SET ";
		$query .= "trash = '1' ";
		$query .= "WHERE id = '".$todo_id."'";
		return $mysqli->query($query);
	}

	function change_status_todo($todo_id, $status) {
		global $mysqli;

		$query = "UPDATE cc_todo SET ";
		$query .= "status = '".$status."', ";
		$query .= "completed_date = '".time()."' ";
		$query .= "WHERE id = '".$todo_id."'";
		return $mysqli->query($query);
	}
?>