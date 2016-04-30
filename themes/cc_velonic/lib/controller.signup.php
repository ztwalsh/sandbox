<?php
	function user_information($next_page) {
		if ($_POST) {
			$required_fields = array('email', 'firstname', 'lastname', 'city', 'password');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
		    	if (validate_email($_POST['email'])) {
		    		if (check_existing_email($_POST['email'])) {
			    		$query = insert_user();
			    		$_SESSION['signup_member_id'] = $query;
			    		header('Location: '.$next_page);
			    	} else {
			    		return 'error_existing_email';
			    	}
		    	} else {
		    		return 'error_invalid_email';
		    	}
			} else {
				return 'error_missing_fields';
			}
		} else {
			return 'no_submit';
		}
	}

	function complete_registration($member_id, $member_token, $boat_id, $boat_pin) {
		global $root;

		if ($_POST) {
			$check_member = get_member_detail($member_id);
			$check_boat = display_boat_detail($boat_id);

			if($check_member['ActivationToken'] == $member_token) {
				if($check_boat['boat_pin'] == $boat_pin) {
					if ($boat_pin && $boat_pin) {
						$required_fields = array('firstname', 'lastname', 'password', 'weight');
						$errors = required_fields($required_fields, $_POST);
					    if(empty($errors)) {
				    		update_user_registration($member_id);
				    		update_member_status($member_id, $boat_id);
				    		$_SESSION['signup_member_id'] = $member_id;
				    		header('Location: crew-confirmation.php');
						} else {
							return 'error_missing_fields';
						}
					}
				} else {
					return 'error_no_match';
				}
			} else {
				return 'error_no_match';
			}
		} else {
			return 'no_submit';
		}
	}

	function boat_information() {
		if ($_POST) {
			$required_fields = array('boatname', 'boatmake', 'boatmodel', 'city',);
			$errors = required_fields($required_fields, $_POST);
			if(empty($errors)) {
				$query = insert_boat();
				$level_query = insert_user_level($_SESSION['signup_member_id'], $query);
				$_SESSION['signup_boat_id'] = $query;
				admin_new_boat_email($_POST['boatname']);
				header('Location: skipper-confirmation.php');
			} else {
				return 'error_missing_fields';
			}
		} else {
			return 'no_submit';
		}
	}

	function confirmation_email() {
		global $root;

		$token = find_token($_SESSION['signup_member_id']);

		$email 		= 	find_email_address($_SESSION['signup_member_id']);
		$subject 	= 	'Welcome to CrewConnect';
		$contents 	= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">Thank you for signing up</h1>';
		$contents 	.= 	'<p>Now it\'s time to log in and join your crew.</p>';
		$contents 	.= 	'<p><a href="'.$root.'login.php" style="background: #ce5637;border-bottom: 2px solid #822912;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;padding: 10px 20px 8px 20px;text-decoration: none;">Log in</a>';

		send_email($email, $subject, $contents);
	}

	function admin_new_member_email($type) {
		global $root;

		$member_email 	= 	find_email_address($_SESSION['signup_member_id']);
		$email 			= 	'ztwalsh@gmail.com';
		$email2			= 	'mmakris@gmail.com';

		if ($type == 'Crew') {
			$subject 		= 	'New CrewConnect Member';
			$contents 		= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">New Sign Up</h1>';
			$contents 		.= 	'<p>Account Type: '.$type.'<br />';
			$contents 		.= 	'Member Email: '.$member_email.'</p>';
		} elseif ($type == 'Skipper') {
			$boat 			= 	display_boat_detail($_SESSION['signup_boat_id']);

			$subject 		= 	'New CrewConnect Member';
			$contents 		= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">New Sign Up</h1>';
			$contents 		.= 	'<p>Account Type: '.$type.'<br />';
			$contents 		.= 	'Member Email: '.$member_email.'<br />';
			$contents 		.= 	'Boat Name: '.$boat['name'].'</p>';
		}

		send_email($email, $subject, $contents);
		send_email($email2, $subject, $contents);
	}

	function admin_new_boat_email($boat_name) {
		global $root;

		$email 			= 	'ztwalsh@gmail.com, mmakris@gmail.com';
		$subject 		= 	'New CrewConnect Boat';
		$contents 		= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">New Boat</h1>';
		$contents 		.= 	'<p>Boat: '.$boat_name.'</p>';

		send_email($email, $subject, $contents);
	}

	function admin_new_payment_email($boat_name) {
		global $root;

		$email 			= 	'ztwalsh@gmail.com';
		$email2			= 	'mmakris@gmail.com';

		$subject 		= 	'New CrewConnect Payment';
		$contents 		= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">New Paying Boat</h1>';
		$contents 		.= 	'<p>Boat: '.$boat_name.'</p>';

		send_email($email, $subject, $contents);
		send_email($email2, $subject, $contents);
	}

	function check_activation_token($token, $signup_member_id) {
		$activation_token_id = get_member_id_by_token($token);
		if ($activation_token_id == $signup_member_id) {
			$make_active = make_user_active($signup_member_id);
			if ($make_active) {
				return true;
			} else {
				return false;
			}
		}
	}
?>