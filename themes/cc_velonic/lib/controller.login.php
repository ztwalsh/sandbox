<?php
	function login($post) {
		global $root;

		if ($post) {
			$required_fields = array('email', 'password');
			$errors = required_fields($required_fields, $post);
		    if(empty($errors)) {
		    	$login_confirm = check_password($post['email'], $post['password']);

		    	if ($login_confirm) {
		    		$member = get_member_account($login_confirm);

		    		$_SESSION['login'] = true;
		    		$_SESSION['member_id'] = $member['id'];
		    		$_SESSION['firstname'] = $member['fname'];
		    		$_SESSION['lastname'] = $member['lname'];
		    		$_SESSION['email'] = $member['email'];
		    		$_SESSION['member_photo'] = $member['user_image'];
		    		$boat = get_boat($_SESSION['member_id']);
		    		$boat_count = mysqli_num_rows($boat);
		    		$_SESSION['boat_count'] = $boat_count;

		    		if ($member['admin'] == 1) {
		    			$_SESSION['admin'] = true;
		    			$_SESSION['member_privilege'] = 99;
		    			header('Location: '.$root.'select-boat.php');
		    		} else {
		    			$_SESSION['admin'] = false;

			    		if ($boat_count > 1) {
			    			header('Location: '.$root.'select-boat.php');
			    		} elseif ($boat_count == 0) {
			    			$_SESSION['member_privilege'] = member_set_privilege($_SESSION['member_id'], $boat_id['bid']);
		    				redirect_login($root);
			    		} else {
			    			while ($boat_id = mysqli_fetch_assoc($boat)) {
			    				$_SESSION['boat_id'] = $boat_id['bid'];
			    				$members = get_all_active_members($boat_id['bid']);
			    				$_SESSION['member_count'] = mysqli_num_rows($members);
			    				$_SESSION['member_privilege'] = member_set_privilege($_SESSION['member_id'], $boat_id['bid']);
			    				redirect_login($root);
			    			}
			    		}
		    		}
		    	} else {
		    		return 'error_incorrect_password';
		    	}
			} else {
				return 'error_missing_fields';
			}
		} elseif (isset($_SESSION['login'])) {
			if ($_SESSION['boat_count'] > 1) {
				header('Location: '.$root.'select-boat.php');
			} else {
				header('Location:'.$root);
			}
		}
	}

	function send_reset_password_email() {
		global $root;

		if ($_POST) {
			$required_fields = array('email');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
		    	if (validate_email($_POST['email'])) {
		    		if (!check_existing_email($_POST['email'])) {
		    			$member = get_single_member_by_email($_POST['email']);

		    			$email 		= 	$member['email'];
						$subject 	= 	'Recover your password';
						$contents 	= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">Reset your password</h1>';
						$contents 	.= 	'<p>Please click the link below to reset your password.</p>';
						$contents 	.= 	'<p><a href="'.$root.'reset-create-password.php?ut='.$member['ActivationToken'].'&uid='.$member['id'].'" style="background: #ce5637;border-bottom: 2px solid #822912;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;padding: 10px 20px 8px 20px;text-decoration: none;">Reset your password</a>';

						send_email($email, $subject, $contents);
			    	} else {
			    		return 'error_no_email';
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

	function reset_password() {
		global $root;

		if (isset($_GET['ut']) && isset($_GET['uid'])) {
			if ($_POST) {
				$required_fields = array('password');
				$errors = required_fields($required_fields, $_POST);
			    if(empty($errors)) {
			    	if ($_POST['ut'] == '' || $_POST['uid'] == '') {
			    		return 'error_reset_password_error';
			    	} else {
			    		$member = get_single_member($_POST['uid']);
			    		$member = $member->fetch_assoc();

				    	if ($member['ActivationToken'] == $_POST['ut']) {
							update_member_password($_POST['password'], $_POST['ut'], $_POST['uid']);
						} else {
							return 'error_reset_password_error';
						}
					}
				} else {
					return 'error_missing_fields';
				}
			}
		} else {
			return 'error_reset_password_error';
		}
	}

	function logout($post) {
		session_unset();
		session_unset($_SESSION['login']);
		session_unset($_SESSION['member_id']);
		session_unset($_SESSION['firstname']);
		session_unset($_SESSION['lastname']);
		session_unset($_SESSION['boat_id']);
		session_unset($_SESSION['member_photo']);
		session_unset($_SESSION['boat_count']);
		session_unset($_SESSION['block_popup']);
		session_destroy();
		header('Location: login.php');
	}
?>
