<?php
	function required_fields($fields, $post) {
		$missing = array();
		foreach ($fields as $field) {
	        if (empty($post[$field])) {
	            $missing[] = $field;
	        }
	    }
	    return $missing;
	}

	function validate_email($email) {
		$email_regex = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^";
		if (preg_match($email_regex, $email)) {
			return true;
		} else {
			return false;
		}
	}

	function check_existing_email($email) {
		global $mysqli;

		$email_check = $mysqli->query("SELECT * FROM cc_users WHERE email = '".$email."'");
		if ($email_check->num_rows == 0) {
			return true;
		} else {
			return false;
		}
	}

	function find_token($id) {
		global $mysqli;

		$token_select = $mysqli->query("SELECT ActivationToken FROM cc_users WHERE id = ".$id."");
		$token = mysqli_fetch_assoc($token_select);
		return $token['ActivationToken'];
	}

	function find_email_address($id) {
		global $mysqli;

		$email_select = $mysqli->query("SELECT email FROM cc_users WHERE id = ".$id."");
		$email = $email_select->fetch_assoc();
		return $email['email'];
	}

	function generate_hash($password, $salt = null) {
		if ($salt === null) {
			$salt = substr(md5(uniqid(rand(), true)), 0, 25);
		} else {
			$salt = substr($salt, 0, 25);
		}

		return $salt.sha1($salt.$password);
	}

	function generate_activation_token() {
		$token = md5(uniqid(mt_rand(), false));
		return $token;
	}

	function check_password($email, $password) {
		global $mysqli;

		$user_select = $mysqli->query("SELECT * FROM cc_users WHERE email = '".$email."'");
		$user = mysqli_fetch_assoc($user_select);

		$password = generate_hash(trim($password), $user['Password']);

		if ($password == $user['Password']) {
			return $user['id'];
		} else {
			return false;
		}
	}

	function display_activation_alert($status) {
		echo '<h2 class="heading-2">You\'re all set.</h2>';
		echo '<p>Your account is now active. Get started right away. Log in and start planning for your next race.</p>';
		echo '<p><a class="primary" href="../login.php">Log in</a></p>';
	}

	function get_member_account($id) {
		global $mysqli;

		$member_select = $mysqli->query("SELECT * FROM cc_users WHERE id = '".$id."'");
		$member = mysqli_fetch_assoc($member_select);
		if ($member) {
			return $member;
		} else {
			return false;
		}
	}

	function check_login() {
		global $root;

		if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
			return true;
		} else {
			echo $_SERVER['REQUEST_URI'];
			$_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
			header('Location: '.$root.'login.php');
		}
	}

	function redirect_login($alt_location) {
		if ($_SESSION['redirect']) {
			$redirect = $_SESSION['redirect'];
			unset($_SESSION['redirect']);
			header('Location: '.$redirect);
		} else {
			header('Location: '.$alt_location);
		}
	}

	function check_credit_card_status() {
		global $root;

		if (isset($_SESSION['credit_card_success'])) {
			unset($_SESSION['credit_card_success']);
		} else {
			header('Location: '.$root.'dashboard');
		}
	}

	function add_members_lightbox() {
		if (isset($_SESSION['member_count'])) {
			if($_SESSION['member_count'] == 1) {
				if(isset($_SESSION['block_popup'])) {

				} else {
					echo '<div class="warning-message" style="display: block;">';
					echo '<h4 class="heading-2">You need members</h4>';
					echo '<p>Get started by adding crew members to your boat.</p>';
					echo '<p><a class="primary" href="member-invite.php">Invite members</a> <a class="secondary close" href="#">I\'ll do this later</a></p>';
					echo '</div>';
					echo '<div class="cover" style="display: block;"></div>';
					$_SESSION['block_popup'] = true;
				}
			} else {
				return false;
			}
		}
	}

	function display_error_alert($submission, $success = '') {
		if (is_array($submission)) {
			echo '<div class="error-alert">';
			echo '<i class="fa fa-exclamation-triangle"></i> We have some errors<br />';
			echo '<ul>';
			foreach ($submission as $error) {
				echo '<li>'.$error.'</li>';
			}
			echo '</ul>';

			echo '</div>';
		} else {
			$error_state = substr($submission, 0, 5);
			$error_type = substr($submission, 6);
			if ($error_state == 'error') {
				switch ($error_type) {
					case 'missing_fields':
				        $message = 'You have some missing fields';
				        break;
				    case 'invalid_email':
				        $message = 'We need a valid email address';
				        break;
				    case 'existing_email':
				        $message = 'This email address is already in use';
				        break;
				    case 'no_email':
				        $message = 'Can\'t find this email address';
				        break;
				    case 'unmatched_passwords':
				        $message = 'Your passwords do not match';
				        break;
				    case 'error_cant_process':
				        $message = 'We can\'t process this photo, try again';
				        break;
				    case 'no_match':
				        $message = 'We can\'t process this at this time';
				        break;
				    case 'incorrect_password';
				    	$message = 'Incorrect email or password';
				    	break;
				    case 'account_not_activated':
				    	$message = 'Please activate this account by clicking the link in the email we sent';
				    	break;
				    case 'reset_password_error';
				    	$message = 'Unable to update password at this time';
				    	break;
				    case 'cancel_failed';
				    	$message = 'Cannot complete cancellation';
				    	break;
				    case 'not_cancelled';
				    	$message = 'You must type "cancel" to cancel subscription';
				    	break;
				    case 'customer_billing_update_failed';
				    	$message = 'Sorry, We experienced an issue updating your customer record. Please contact support@crewconnect.com';
				    	break;
				    case 'subscription_billing_update_failed';
				    	$message = 'Sorry, We experienced an issue updating your subscription record. Please contact support@crewconnect.com';
				    	break;
				    case 'invalid_code';
				    	$message = 'Sorry, that is not a valid yacht club/promo code.';
				    	break;
				}
				echo '<div class="error-alert"><i class="fa fa-exclamation-triangle"></i> '.$message.'</div>';
			} else {
				if ($_POST) {
					echo '<div class="success-alert"><i class="fa fa-check-circle"></i> '.$success.'</div>';
				} else {
					echo '';
				}
			}
		}
	}

	function display_current_page($section, $page) {
		if ($section == $page) {
			echo ' class="on"';
		} else {
			echo '';
		}
	}

	function truncate($string, $length, $append = "&hellip;") {
	    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($append)) . $append : $string;
	}

	function page_on($page, $key) {
		if ($page == $key) {
			echo 'class="on" ';
		} else {
			echo '';
		}
	}

	function base64_to_jpeg($base64_string, $output_file) {
	    $ifp = fopen($output_file, "wb");

	    $data = explode(',', $base64_string);

	    fwrite($ifp, base64_decode($data[1]));
	    fclose($ifp);

	    return $output_file;
	}

	function check_get($variable) {
		if(array_key_exists($variable, $_GET)) {
			return $_GET[$variable];
		} else {
			return false;
		}
	}
?>
