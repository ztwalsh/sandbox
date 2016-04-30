<?php
	function member_event_status($status, $start_date, $end_date = null) {

		// if ($date < time()) {
		// 	$no_go 	= 'Didn\'t go';
		// 	$go 	= 'Went';
		// 	$rsvp 	= 'Invited';
		// 	$maybe 	= 'Maybe';
		// } else {
		// 	$no_go 	= 'Not going';
		// 	$go 	= 'Going';
		// 	$rsvp 	= 'Invited';
		// 	$maybe 	= 'Maybe';
		// }
		if ( (isset($end_date) && $end_date > time()) || (!isset($end_date) && $start_date > time()) ) {
			$no_go 	= 'Not going';
			$go 	= 'Going';
			$rsvp 	= 'Invited';
			$maybe 	= 'Maybe';
		} else {
			$no_go 	= 'Didn\'t go';
			$go 	= 'Went';
			$rsvp 	= 'Invited';
			$maybe 	= 'Maybe';
		}

		switch($status) {
			case NULL:
				echo '';
				break;
			case 0:
				echo '<div class="status negative">'.$no_go.'</div>';
				break;
			case 1:
				// echo '<div class="status positive">'.$go.'</div>';
				// save this for volunteering later
				echo '';
				break;
			case 2:
				echo '<div class="status neutral">'.$maybe.'</div>';
				break;
			case 3:
				echo '<div class="status positive">'.$go.'</div>';
				break;
			case 4:
				echo '<div class="status caution">'.$rsvp.'</div>';
				break;
			default:
				echo '';
				break;
		}
	}

	function member_count($event_id, $boat_id) {
		$count = count_members($event_id, $boat_id);
		return $count;
	}

	function member_event_rsvp_change_status($member_id, $event_id, $boat_id, $new_status) {
		if (!$_SESSION['redirect']) {
			change_rsvp_status($member_id, $event_id, $boat_id, $new_status);
			header('Location: event-detail.php?event_id='.$event_id);
		} else {

		}
	}

	function display_events($member_id, $boat_id, $view) {
		global $root;

		$events = get_events($boat_id, $member_id, $view);

		if (mysqli_num_rows($events) == 0) {
			echo 'Nothing...';
		} else {
			while($event = $events->fetch_assoc()) {
				$event_status = event_status($member_id, $event['id'], $boat_id);

				echo '<div class="card">';
					echo '<div class="card-top cf">';
						echo '<div class="card-status">';
						member_event_status($event_status['status'], $event['edate'], $event['edate_end']);
						echo '</div>';
						echo '<div class="card-info">';
							echo '<h2 class="heading-4"><a href="event-detail.php?event_id='.$event['id'].'">'.$event['name'].'</a></h2>';
							echo '<span class="iconworks" data-icon="&#70;"></span> ';
							echo date('M d, Y', $event['edate']);
							if ($event['edate_end']) {
								echo '&ndash;'.date('M d, Y', $event['edate_end']);
							}
							echo '<span class="iconworks" data-icon="&#105;"></span> '.date('h:ia', $event['edate']);
							echo '<span class="iconworks" data-icon="&#80;"></span> '.member_count($event['id'], $boat_id);
						echo '</div>';
					echo '</div>';
					if ($event_status['status'] && $event_status['status'] == 4 && $event['edate'] > time()) {
						echo '<div class="status-menu">';
							echo '<a href="event-rsvp.php?event_id='.$event['id'].'&new_status=3">Going</a>';
							echo '<a href="event-rsvp.php?event_id='.$event['id'].'&new_status=0">Not going</a>';
							echo '<a href="event-rsvp.php?event_id='.$event['id'].'&new_status=2">Maybe</a>';
						echo '</div>';
					} else {
						echo '<div class="card-menu">';
							echo '<a href="event-detail.php?event_id='.$event['id'].'">View crew <i class="fa fa-angle-right"></i></a>';
							echo '<a href="event-sails.php?event_id='.$event['id'].'">View sails <i class="fa fa-angle-right"></i></a>';
							if ($_SESSION['member_privilege'] > 1) {
								echo '<a href="event-edit.php?event_id='.$event['id'].'">Edit event <i class="fa fa-angle-right"></i></a>';
								echo '<a class="delete" href="event-delete.php?delete_id='.$event['id'].'">Delete event <i class="fa fa-angle-right"></i></a>';
							}

							if ($_SESSION['member_id'] == $member_id && ($event['edate'] > time() || $event['edate_end'] > time())) {
								if ($event_status['status'] != NULL) {
									echo '<div class="status-menu">';
										echo '<a ';
										if ($event_status['status'] == 3) {
											echo 'class="positive" ';
										}
										echo 'href="event-rsvp.php?event_id='.$event['id'].'&new_status=3">Going</a>';

										echo '<a ';
										if ($event_status['status'] == 0) {
											echo 'class="negative" ';
										}
										echo 'href="event-rsvp.php?event_id='.$event['id'].'&new_status=0">Not going</a>';

										echo '<a ';
										if ($event_status['status'] == 2) {
											echo 'class="neutral" ';
										}
										echo 'href="event-rsvp.php?event_id='.$event['id'].'&new_status=2">Maybe</a>';
									echo '</div>';
								}
							}
						echo '</div>';
						echo '<div class="card-bottom">';
							echo '<a href="#">Options <i class="fa fa-angle-down"></i></a>';
						echo '</div>';
					}
				echo '</div>';
			}
		}
	}

	function event_list_filter($variable) {
		if ($variable == 'past-all') {
			$label = 'All past events';
		} elseif ($variable == 'past-member') {
			$label = 'Your past events';
		} elseif ($variable == 'member') {
			$label = 'Your upcoming events';
		} else {
			$label = 'All upcoming events';
		}

		echo '<a class="action-button" href="#">'.$label.' <i class="fa fa-angle-down"></i></a>';
		echo '<div class="action-menu">';
		echo '<a href="event-all.php">All upcoming events</a>';
		echo '<a href="event-all.php?view=past-all">All past events</a>';
		echo '<a href="event-all.php?view=member">Your upcoming events</a>';
		echo '<a href="event-all.php?view=past-member">Your past events</a>';
		echo '</div>';
	}

	function add_event($boat_id) {
		if ($_POST) {
			$required_fields = array('name', 'type', 'edate', 'location');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
				$new_event_id = insert_event($boat_id);
				//echo $new_event_id;
				header('Location: event-detail.php?event_id='.$new_event_id);
			} else {
				return 'error_missing_fields';
			}
		} else {
			return 'no_submit';
		}
	}

	function display_event_detail($event_id) {
		global $root;

		if (empty($event_id)) {
			header('Location: '.$root.'dashboard/event-all.php');
		} else {
			$event = get_single_event($event_id);
			$event =  mysqli_fetch_assoc($event);
			return $event;
		}
	}

	function edit_event($event_id) {
		if ($_POST) {
			$required_fields = array('name', 'type', 'edate', 'hour', 'minute', 'am-pm', 'location');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
				update_event($event_id);
			} else {
				return 'error_missing_fields';
			}
		} else {
			return false;
		}
	}

	function display_available_event_members($event_id, $boat_id) {
		global $member_images;
		global $root;

		if (empty($event_id)) {
			return false;
		} else {
			$members = get_available_event_members($event_id);
			$event_invitees = get_selected_event_members($event_id);
			$event = display_event_detail($event_id);
			$invited = array();
			while($invitee = $event_invitees->fetch_assoc()) {
				$invited[] = $invitee['id'];
			}

			$count = mysqli_num_rows($members);

			if($count == 0) {
				echo '<div class="content">';
					echo '<section>';
						echo '<h2 class="heading-3">Crew members</h2>';
					echo '</section>';
					echo '<div class="empty">';
						echo '<img src="'.$root.'images/pricing_crew_335x332.jpg" height="auto" width="200" /><br />';
						echo '<h2 class="heading-3">No active crew members to invite</h2><br />';
						if ($_SESSION['member_privilege'] > 1) {
							echo '<a href="member-invite.php"><i class="fa fa-plus-circle"></i> Add boat members</a>';
						}
					echo '</div>';
				echo '</div>';
			} else {
				echo '<div class="content">';
					echo '<section>';
						echo '<h2 class="heading-3">Crew members</h2>';
						if ($_SESSION['member_privilege'] > 1) {
							echo '<a class="secondary right load" href="event-detail.php?event_id='.$event_id.'&action=addall"><i class="fa fa-plus-circle"></i> Invite all</a>';
						}
					echo '</section>';
					echo '<section>';
						echo '<table class="info">';
							echo '<tbody>';
								while($member = $members->fetch_assoc()) {
									$event_status = event_status($member['id'], $event_id, $boat_id);

									echo '<tr>';
									echo '<td class="crew-image"><img class="profile-thumb" src="'.$member_images.$member['user_image'].'" /></td>';
									echo '<td class="name">'.$member['fname'].' '.$member['lname'].'<br />';
									member_position($member['id'], $_SESSION['boat_id']);
									echo '</td>';
									echo '<td class="invite-status">';
										if(in_array($member['id'], $invited)) {
											member_event_status($event_status['status'], $event['edate'], $event['edate_end']);
										}
									echo '</td>';
									if ($_SESSION['member_privilege'] > 1) {
										echo '<td class="action add-remove-crew">';
										if(in_array($member['id'], $invited)) {
											echo '<a class="secondary load invited" href="event-detail.php?event_id='.$event_id.'&action=remove&member_id='.$member['id'].'"><i class="fa fa-check"></i></a>';
										} else {
											echo '<a class="secondary load" href="event-detail.php?event_id='.$event_id.'&action=add&member_id='.$member['id'].'"><i class="fa fa-plus-circle"></i></a>';
										}
										echo '</td>';
									}
									echo '</tr>';
								}
							echo '</tbody>';
						echo '</table>';
					echo '</section>';
				echo '</div>';

			}
		}
	}

	function add_remove_event_members() {
		global $root;

		if (isset($_GET['action']) && isset($_GET['event_id'])) {
			$boat = display_boat_detail($_SESSION['boat_id']);
			$event = display_event_detail($_GET['event_id']);

			switch ($_GET['action']) {
				case 'add':
					if (isset($_GET['member_id'])) {
						$member = display_member_detail($_GET['member_id']);
						add_member_to_event($member['id'], $event['id']);

						$email 		= 	$member['email'];
						$subject 	= 	'You\'ve been added to '.$event['name'].'!';
						$contents 	= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">'.$boat['name'].'</h1>';
						$contents 	.= 	'<p><span style="color: #343e48;font-size: 18px;">'.$event['name'].'</span><br />';
						$contents 	.= 	date('M d, Y', $event['edate']).' at '.date('h:ia', $event['edate']).'<br />';
						$contents 	.= 	'<p>Take a second and let the skipper know if you are going. Will you be going to the event?</p>';
						$contents 	.= 	'<p><a href="'.$root.'dashboard/event-rsvp.php?event_id='.$event['id'].'&new_status=3" style="background: #8cc540;border-bottom: 2px solid #679825;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">Yes</a>';
						$contents 	.= 	'<a href="'.$root.'dashboard/event-rsvp.php?event_id='.$event['id'].'&new_status=0" style="background: #ce5637;border-bottom: 2px solid #822912;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">No</a>';
						$contents 	.= 	'<a href="'.$root.'dashboard/event-rsvp.php?event_id='.$event['id'].'&new_status=2" style="background: #aaaaaa;border-bottom: 2px solid #666666;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">Maybe</a></p>';

						send_email($email, $subject, $contents);
					}
					break;
				case 'remove':
					if (isset($_GET['member_id'])) {
						$member = display_member_detail($_GET['member_id']);
						remove_member_from_event($member['id'], $event['id']);

						$email 		= 	$member['email'];
						$subject 	= 	'You\'ve been removed from '.$event['name'].'!';
						$contents 	= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">You\'ve been removed from '.$event['name'].'</h1>';
						$contents 	.= 	'<p>Looks like some changes have been made to the crew for '.$event['name'].'. You have been removed from the race. Reach out to your skipper for more info.</p>';

						send_email($email, $subject, $contents);
						break;
					}
				case 'addall':
					$reserve_members = get_available_event_members($_GET['event_id']);

					while($reserve_member = $reserve_members->fetch_assoc()) {
						add_member_to_event($reserve_member['id'], $_GET['event_id']);

						$email 		= 	$reserve_member['email'];
						$subject 	= 	'You\'ve been added to '.$event['name'].'!';
						$contents 	= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">'.$boat['name'].'</h1>';
						$contents 	.= 	'<p><span style="color: #343e48;font-size: 18px;">'.$event['name'].'</span><br />';
						$contents 	.= 	date('M d, Y', $event['edate']).' at '.date('h:ia', $event['edate']).'<br />';
						$contents 	.= 	'<p>Take a second and let the skipper know if you are going. Will you be going to the event?</p>';
						$contents 	.= 	'<p><a href="'.$root.'dashboard/event-rsvp.php?event_id='.$event['id'].'&new_status=3" style="background: #8cc540;border-bottom: 2px solid #679825;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">Yes</a>';
						$contents 	.= 	'<a href="'.$root.'dashboard/event-rsvp.php?event_id='.$event['id'].'&new_status=0" style="background: #ce5637;border-bottom: 2px solid #822912;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">No</a>';
						$contents 	.= 	'<a href="'.$root.'dashboard/event-rsvp.php?event_id='.$event['id'].'&new_status=2" style="background: #aaaaaa;border-bottom: 2px solid #666666;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">Maybe</a></p>';

						send_email($email, $subject, $contents);
					}
					break;
			}
		}
	}

	function display_available_event_sails($event_id) {
		global $root;

		if (empty($event_id)) {
			return false;
		} else {
			$sails = get_available_event_sails($event_id);
			$event_sails = get_selected_event_sails($event_id);
			$selected = array();

			while($selection = $event_sails->fetch_assoc()) {
				$selected[] = $selection['id'];
			}

			if(mysqli_num_rows($sails) == 0) {
				echo '<div class="content">';
					echo '<section>';
						echo '<h2 class="heading-3">Sail inventory</h2>';
					echo '</section>';
					echo '<div class="empty">';
						echo '<img src="'.$root.'images/sails_335x332.jpg" height="auto" width="200" /><br />';
						echo '<h2 class="heading-3">No sails available</h2><br />';
						if ($_SESSION['member_privilege'] > 1) {
							echo '<a href="sail-add.php"><i class="fa fa-plus-circle"></i> Add new sail</a>';
						}
					echo '</div>';
				echo '</div>';
			} else {
				echo '<div class="content">';
					echo '<section>';
						echo '<h2 class="heading-3">Sail inventory</h2>';
					echo '</section>';
					echo '<section>';
						echo '<table class="info">';
							echo '<tbody>';
							while($sail = $sails->fetch_assoc()) {
								echo '<tr>';
									echo '<td>'.$sail['year'].' '.$sail['sailmaker'].' '.$sail['type'].' '.$sail['sub_type'].'</td>';
									echo '<td class="sail-material">'.$sail['material'].'</td>';
									echo '<td>';
									echo sail_rating($sail['condition_rating']);
									echo '</td>';
									if ($_SESSION['member_privilege'] > 1) {
										echo '<td class="action add-remove-sails">';
										if(in_array($sail['id'], $selected)) {
											echo '<a class="secondary load invited" href="event-sails.php?event_id='.$event_id.'&action=remove&sail_id='.$sail['id'].'"><i class="fa fa-check"></i></a>';
										} else {
											echo '<a class="secondary load" href="event-sails.php?event_id='.$event_id.'&action=add&sail_id='.$sail['id'].'"><i class="fa fa-plus-circle"></i></a>';
										}
										echo '</td>';
									}
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</section>';
				echo '</div>';
			}
		}
	}

	function add_remove_event_sails() {
		if (isset($_GET['action']) && isset($_GET['sail_id']) &&  isset($_GET['event_id'])) {
			$sail = display_sail_detail($_GET['sail_id']);
			$event = display_event_detail($_GET['event_id']);

			switch ($_GET['action']) {
				case 'add':
					add_sail_to_event($sail['id'], $event['id']);
					break;
				case 'remove':
					remove_sail_from_event($sail['id'], $event['id']);
					break;
			}
		}
	}

	function remove_event($event_id) {
		global $root;

		if (empty($event_id)) {
			header('Location: '.$root.'dashboard/event-all.php');
		} else {
			delete_event($event_id);
			header('Location: '.$root.'dashboard/event-all.php?delete='.$event_id);
		}
	}
?>
