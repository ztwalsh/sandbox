<?php
	function member_status($member_id, $boat_id) {
		$member = get_member_privilege_status($member_id, $boat_id);

		switch($member['user_level']) {
			case -1:
				echo '<div class="status negative">Revoked</div>';
				break;
			case 0:
				echo '<div class="status caution">Suspended</div>';
				break;
			case 10:
				echo '<div class="status neutral">Not confirmed</div>';
				break;
			case 1 || 2 || 3 || 99:
				echo '<div class="status positive">Active</div>';
				break;
			default:
				echo '';
				break;
		}
	}

	function member_change_status($member_id, $boat_id) {
		$member = get_member_privilege_status($member_id, $boat_id);

		switch($member['user_level']) {
			case -1:
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=1">Activate</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=0">Suspend</a>';
				echo '<a class="negative" href="member-privilege.php?member_id='.$member_id.'&status=-1">Revoked</a>';
				break;
			case 0:
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=1">Activate</a>';
				echo '<a class="caution" href="member-privilege.php?member_id='.$member_id.'&status=0">Suspended</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=-1">Revoke</a>';
				break;
			case 1 || 2 || 3 || 10 || 99:
				echo '<a class="positive" href="member-privilege.php?member_id='.$member_id.'&status=1">Active</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=0">Suspend</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=-1">Revoke</a>';
				break;
			default:
				echo '';
				break;
		}
	}

	function member_position($member_id, $boat_id) {
		$member = get_member_privilege_status($member_id, $boat_id);

		switch($member['user_level']) {
			case -1:
				return 'Revoked';
				break;
			case 0:
				return 'Suspended';
				break;
			case 1:
				return 'Crew';
				break;
			case 2:
				return 'Secretary';
				break;
			case 3:
				return 'Manager';
				break;
			case 99:
				return 'Skipper';
				break;
			default:
				return '';
				break;
		}
	}

	function member_change_position($member_id, $boat_id) {
		$member = get_member_privilege_status($member_id, $boat_id);

		switch($member['user_level']) {
			case 1:
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=2">Make secretary</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=3">Make manager</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=99">Make skipper</a>';
				break;
			case 2:
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=1">Make crew</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=3">Make manager</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=99">Make skipper</a>';
				break;
			case 3:
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=1">Make crew</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=2">Make secretary</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=99">Make skipper</a>';
				break;
			case 99:
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=1">Make crew</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=2">Make secretary</a>';
				echo '<a href="member-privilege.php?member_id='.$member_id.'&status=3">Make manager</a>';
				break;
			default:
				echo '';
				break;
		}
	}

	function display_members($boat_id, $status) {
		global $member_images;
		global $root;

		$members = get_all_members($boat_id, $status);

		if (mysqli_num_rows($members) == 0) {
			echo '<div class="content">';
				echo '<div class="empty">';
					echo '<img src="'.$root.'images/pricing_crew_335x332.jpg" height="auto" width="200" /><br />';
					echo '<h2 class="heading-3">Sorry, no members</h2><br />';
				echo '</div>';
			echo '</div>';
		} else {
			while($member = $members->fetch_assoc()) {
				echo '<div class="card">';
					echo '<div class="card-top cf">';
						echo '<div class="card-status">';
						member_status($member['id'], $boat_id);
						echo '</div>';
						echo '<div class="card-info">';
							echo '<div class="image">';
								echo '<a href="member-detail.php?member_id='.$member['id'].'"><img src="'.$member_images.$member['user_image'].'" /></a>';
							echo '</div>';
							echo '<div class="info">';
								if ($member['fname']) {
									echo '<h2 class="heading-4"><a href="member-detail.php?member_id='.$member['id'].'">'.$member['fname'].' '.$member['lname'].'</a></h2>';
								} else {
									echo '<h2 class="heading-4"><a href="member-detail.php?member_id='.$member['id'].'">'.$member['email'].'</a></h2>';
								}
								echo '<div class="meta-information">';
								if(member_position($member['id'], $boat_id)) {
									echo member_position($member['id'], $boat_id);
									echo ' | ';
								} else {

								}
								if($member['phone'] && $member['phone'] != '(xxx) xxx-xxxx') {
									echo $member['phone'];
									echo ' | ';
								} else {

								}
								echo $member['email'];
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div class="card-menu">';
						echo '<a href="member-detail.php?member_id='.$member['id'].'">View details</a>';
						if ($member['id'] == $_SESSION['member_id']) {

						} else {
							if ($_SESSION['member_privilege'] > 1) {
								member_change_position($member['id'], $boat_id);
								echo '<div class="status-menu">';
									member_change_status($member['id'], $boat_id);
								echo '</div>';
							}
						}
					echo '</div>';
					echo '<div class="card-bottom">';
						echo '<a href="#">Options <i class="fa fa-angle-down"></i></a>';
					echo '</div>';
				echo '</div>';
			}
		}
	}

	function member_list_filter($variable) {
		if ($variable == 'suspended') {
			$label = 'Suspended crew';
		} elseif ($variable == 'revoked') {
			$label = 'Revoked crew';
		} else {
			$label = 'Active crew';
		}

		echo '<a class="action-button" href="#">'.$label.' <i class="fa fa-angle-down"></i></a>';
		echo '<div class="action-menu">';
		echo '<a href="member-all.php">Active crew</a>';
		echo '<a href="member-all.php?status=suspended">Suspended crew</a>';
		echo '<a href="member-all.php?status=revoked">Revoked crew</a>';
		echo '</div>';
	}

	function get_member_detail($member_id) {
		global $root;

		$member = get_single_member($member_id);

		if($member) {
			$member = $member->fetch_assoc();

			return $member;
		} else {
			return false;
		}
	}

	function display_member_detail($member_id) {
		global $root;

		if (empty($member_id)) {
			header('Location: '.$root.'dashboard/member-all.php');
		} else {
			$member = get_single_member($member_id);
			$member =  $member->fetch_assoc();
			return $member;
		}
	}

	function invite_member($boat_id) {
		global $root;

		if ($_POST) {
			$required_fields = array('firstname', 'lastname', 'email');
			$errors = required_fields($required_fields, $_POST);

		    if(empty($errors)) {
		    	$firstname 	= trim($_POST['firstname']);
				$lastname 	= trim($_POST['lastname']);
				$email 		= trim($_POST['email']);
		    	$boat = display_boat_detail($boat_id);

		    	if (validate_email($email)) {
		    		if (check_existing_email($email)) {
			    		// This is a non-existing email, they will be kicked to the sign up form
		    			$new_member = add_member($email, $firstname, $lastname);
		    			insert_user_level($new_member, $_SESSION['boat_id'], 10);
		    			$member = get_member_detail($new_member);

		    			$email 		= 	$email;
						$subject 	= 	'You\'re Invited to '.$boat['name'].'!';
						$contents 	= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">You are invited to join '.$boat['name'].'</h1>';
						$contents 	.= 	'<p>Click below to compelete your CrewConnect account.</p>';
						$contents 	.= 	'<p><a href="'.$root.'signup/complete-registration.php?mid='.$member['id'].'&mtk='.$member['ActivationToken'].'&bid='.$boat['id'].'&bpn='.$boat['boat_pin'].'" style="background: #ce5637;border-bottom: 2px solid #822912;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;padding: 10px 20px 8px 20px;text-decoration: none;">Confirm your account</a>';

						send_email($email, $subject, $contents);
					} else {
						// This is an existing email, they will be kicked to the login page
						$member = get_single_member_by_email($email);
						$check_membership = check_membership($member['id'], $_SESSION['boat_id']);

						if(!$check_membership) {
							insert_user_level($member['id'], $_SESSION['boat_id'], 1);
						}

						$email 		= 	$email;
						$subject 	= 	'You\'re Invited to '.$boat['name'].'!';
						$contents 	= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">You are now a member of '.$boat['name'].'</h1>';
						$contents 	.= 	'<p>Log in and select this boat to keep up with activity.</p>';
						$contents 	.= 	'<p><a href="'.$root.'login.php" style="background: #ce5637;border-bottom: 2px solid #822912;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;padding: 10px 20px 8px 20px;text-decoration: none;">Join the boat</a>';

						send_email($email, $subject, $contents);
					}
					return true;
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

	function edit_profile($member_id) {
		if ($_POST) {
			$required_fields = array('firstname', 'lastname', 'city', 'email', 'weight', 'weight_unit');
			$errors = required_fields($required_fields, $_POST);
		    if (empty($errors)) {
		    	if ($_SESSION['email'] != $_POST['email']) {
			    	if (validate_email($_POST['email'])) {
			    		if (check_existing_email($_POST['email'])) {
				    		update_profile($member_id);

							$member = get_single_member($_SESSION['member_id']);
							$member =  $member->fetch_assoc();

							$_SESSION['member_id'] 	= $member['id'];
					    	$_SESSION['firstname'] 	= $member['fname'];
					    	$_SESSION['lastname'] 	= $member['lname'];
				    	} else {
				    		return 'error_existing_email';
				    	}
			    	} else {
			    		return 'error_invalid_email';
			    	}
			    } else {
			    	update_profile($member_id);

					$member = get_single_member($_SESSION['member_id']);
					$member =  $member->fetch_assoc();

					$_SESSION['member_id'] 	= $member['id'];
			    	$_SESSION['firstname'] 	= $member['fname'];
			    	$_SESSION['lastname'] 	= $member['lname'];
			    }
			} else {
				return 'error_missing_fields';
			}
		} else {
			return false;
		}
	}

	function edit_password($member_id, $member_email) {
		if ($_POST) {
			$required_fields = array('old_password', 'new_password');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
		    	$login_confirm = check_password($member_email, $_POST['old_password']);

		    	if ($login_confirm) {
					update_profile_password($member_id);
				} else {
					return 'error_incorrect_password';
				}
			} else {
				return 'error_missing_fields';
			}
		} else {
			return false;
		}
	}

	function route_new_boat_invite() {
		global $root;

		if(isset($_GET['boat_id']) && isset($_GET['boat_pin']) && isset($_GET['member'])) {
			$_SESSION['invite_boat_id'] = $_GET['boat_id'];
			$_SESSION['invite_boat_pin'] = $_GET['boat_pin'];
			if ($_GET['member'] == 'true') {
				header('Location: '.$root.'dashboard/select_boat.php');
			} elseif ($_GET['member'] == 'false') {
				header('Location: '.$root.'signup/crew-information.php');
			} else {
			}
		} else {
			header('Location: '.$root.'');
		}
	}

	function change_photo($member_id) {
		global $root;

		if($_POST) {
			$required_fields = array('thumb_values');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
			    $data = $_POST['thumb_values'];

				list($type, $data) = explode(';', $data);
				list(, $data)      = explode(',', $data);
				$data = base64_decode($data);

				$new_file_name = date('mdYgisu').'_'.rand().'.jpg';

				if(file_put_contents('../images/users/'.$new_file_name, $data)) {
					update_profile_photo($member_id, $new_file_name);

					$member = get_single_member($_SESSION['member_id']);
					$member =  $member->fetch_assoc();

					$_SESSION['member_photo'] = $member['user_image'];
				} else {
					return 'error_cant_process';
				}
			} else {
				return 'error_missing_fields';
			}
		} else {
			return false;
		}
	}

	function member_set_privilege($member_id, $boat_id) {
		$member_privilege = set_member_privilege($member_id, $boat_id);

		$member_privilege = $member_privilege->fetch_assoc();
		return $member_privilege['user_level'];
	}

	function member_change_privilege($member_id, $boat_id, $new_status) {
		change_member_privilege($member_id, $boat_id, $new_status);
		header('Location: member-all.php');
	}
?>
