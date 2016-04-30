<?php
	function display_possible_boats($member_id) {

		if($_SESSION['admin']) {
			$boats = get_all_boats();
			echo '<p><input type="text" id="boat-filter" placeholder="Type the boat name" /></p>';
		} else {
			$boats = get_possible_boats($member_id);
		}

		echo '<div class="boats">';
		while ($boat = $boats->fetch_assoc()) {
		    echo '<a class="select-boat" href="select-boat.php?boat_id='.$boat['id'].'">'.$boat['name'].' Dashboard</a>';
		}
		echo '</div>';
	}

	function select_boat() {
		global $root;

		if (isset($_SESSION['invite_boat_id']) && isset($_SESSION['invite_boat_pin']) && isset($_SESSION['member_id'])) {
			$boat = get_single_boat_with_pin($_SESSION['invite_boat_id'], $_SESSION['invite_boat_pin']);
			$count = mysqli_num_rows($boat);

			if($count == 1) {
				$_SESSION['boat_id'] = $_SESSION['invite_boat_id'];
				insert_user_level($_SESSION['member_id'], $_SESSION['boat_id'], 1);
				unset($_SESSION['invite_boat_id']);
				unset($_SESSION['invite_boat_pin']);
				redirect_login($root.'dashboard');
			} else {
				redirect_login($root.'dashboard');
			}
		} elseif (isset($_GET['boat_id'])) {
			$_SESSION['boat_id'] = $_GET['boat_id'];
			$members = get_all_active_members($boat_id['bid']);
		    $_SESSION['member_count'] = mysqli_num_rows($members);

		    if($_SESSION['admin']) {
				$_SESSION['member_privilege'] = 99;
			} else {
				$_SESSION['member_privilege'] = member_set_privilege($_SESSION['member_id'], $_GET['boat_id']);
			}

			redirect_login($root.'dashboard');
		} else {
			return false;
		}
	}

	function display_boat_detail($boat_id) {
		global $root;

		if (empty($boat_id)) {
			//Need to show what happens when there is no boat 
		} else {
			$boat = get_single_boat($boat_id);
			$boat =  mysqli_fetch_assoc($boat);
			return $boat;
		}
	}

	function show_boat_name($boat_id) {
		$boat = display_boat_detail($boat_id);
		echo truncate($boat['name'], 20);
	}

	function add_boat() {
		global $root;

		if ($_POST) {
			$required_fields = array('boatname', 'boatmake', 'boatmodel', 'city',);
			$errors = required_fields($required_fields, $_POST);
			if(empty($errors)) {
				$query = insert_boat();
				$level_query = insert_user_level($_SESSION['member_id'], $query);
				$_SESSION['boat_id'] = $query;
				$_SESSION['boat_count'] = $_SESSION['boat_count'] + 1;
				$_SESSION['member_privilege'] = member_set_privilege($_SESSION['member_id'], $query);
				admin_new_boat_email($_POST['boatname']);
				header('Location: '.$root.'dashboard');
			} else {
				return 'error_missing_fields';
			}
		} else {
			return 'no_submit';
		}
	}

	function edit_boat($boat_id) {
		if ($_POST) {
			$required_fields = array('name', 'type', 'city');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
				update_boat($boat_id);
			} else {
				return 'error_missing_fields';
			}
		} else {
			return false;
		}
	}

	function check_item_for_boat($item_id, $boat_id) {
		if ($item_id != $boat_id) {
			header('Location: denied.php');
		}
	}

	function check_member_for_boat($member_id, $boat_id) {
		$check_membership = check_membership($member_id, $boat_id);

		if (!$check_membership) {
			header('Location: denied.php');
		}
	}
?>