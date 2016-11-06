<?php
	function member_event_status($status) {
		switch($status) {
			case NULL:
				return '<div class="status"></div>';
				break;
			case 0:
				return '<div class="status negative"></div>';
				break;
			case 1:
				return '<div class="status"></div>';
				break;
			case 2:
				return '<div class="status"></div>';
				break;
			case 3:
				return '<div class="status positive"></div>';
				break;
			case 4:
				return '<div class="status caution"></div>';
				break;
			default:
				return '<div class="status"></div>';
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
			echo '<div class="table-responsive">';
				echo '<table id="datatable" class="table">';
	        echo '<thead>';
		        echo '<tr>';
			        echo '<th>Name</th>';
			        echo '<th>Start Date</th>';
							echo '<th>Start Time</th>';
			        echo '<th>End Date</th>';
			        echo '<th>Your Status</th>';
			        echo '<th>Attendees</th>';
		        echo '</tr>';
	        echo '</thead> ';
	        echo '<tbody>';
					while($event = $events->fetch_assoc()) {
						$event_status = event_status($member_id, $event['id'], $boat_id);
						echo '<tr';
						if ($event['edate_end'] && $event['edate_end'] < time()) {
							echo ' class="past"';
						} elseif ($event['edate'] < time()) {
							echo ' class="past"';
						}
						echo '>';
		          echo '<td class="name"><a href="events-detail.php?event_id='.$event['id'].'">'.$event['name'].'</a></td>';
		          echo '<td>'.date('M d, Y', $event['edate']).'</td>';
							echo '<td>'.date('h:ia', $event['edate']).'</td>';
							if ($event['edate_end']) {
								echo '<td>'.date('M d, Y', $event['edate_end']).'</td>';
							} else {
								echo '<td></td>';
							}
							echo '<td>'.member_event_status($event_status['status']).'</td>';
		          echo '<td>'.member_count($event['id'], $boat_id).'</td>';
		        echo '</tr>';
					}
					echo '</tbody>';
				echo '</table>';
			echo '</div>';
		}
	}

	function add_event($boat_id) {
		if ($_POST) {
			$required_fields = array('name', 'type', 'edate', 'location');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
				$new_event_id = insert_event($boat_id);
				//echo $new_event_id;
				header('Location: events-detail.php?event_id='.$new_event_id);
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
			header('Location: '.$root.'events-all.php');
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
					if ($_SESSION['member_privilege'] > 1) {
						echo '<a class="btn btn-primary" href="events-detail.php?event_id='.$event_id.'&action=addall"><i class="fa fa-plus-circle"></i> Invite all</a>';
					}
					echo '<div class="table-responsive">';
						echo '<table id="member-datatable" class="table">';
							echo '<thead>';
								echo '<tr>';
									echo '<th>Member</th>';
									echo '<th>Position</th>';
									echo '<th>Status</th>';
									echo '<th>Invite</th>';
								echo '</tr>';
							echo '</thead> ';
							echo '<tbody>';
								while($member = $members->fetch_assoc()) {
									$event_status = event_status($member['id'], $event_id, $boat_id);

									echo '<tr>';
									echo '<td class="name"><img class="profile-thumb" src="'.$member_images.$member['user_image'].'" /> '.$member['fname'].' '.$member['lname'].'<br />';
									echo '<td>'.member_position($member['id'], $_SESSION['boat_id']).'</td>';
									echo '<td class="invite-status">';
										if(in_array($member['id'], $invited)) {
											echo member_event_status($event_status['status']);
										}
									echo '</td>';
									if ($_SESSION['member_privilege'] > 1) {
										echo '<td>';
										if(in_array($member['id'], $invited)) {
											echo '<a class="btn btn-default btn-sm" href="events-detail.php?event_id='.$event_id.'&action=remove&member_id='.$member['id'].'"><i class="fa fa-check"></i> Invited</a>';
										} else {
											echo '<a class="btn btn-default btn-sm" href="events-detail.php?event_id='.$event_id.'&action=add&member_id='.$member['id'].'"><i class="fa fa-plus-circle"></i> Invite</a>';
										}
										echo '</td>';
									}
									echo '</tr>';
								}
							echo '</tbody>';
						echo '</table>';
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
						$contents 	.= 	'<p><a href="'.$root.'events-rsvp.php?event_id='.$event['id'].'&new_status=3" style="background: #8cc540;border-bottom: 2px solid #679825;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">Yes</a>';
						$contents 	.= 	'<a href="'.$root.'events-rsvp.php?event_id='.$event['id'].'&new_status=0" style="background: #ce5637;border-bottom: 2px solid #822912;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">No</a>';
						$contents 	.= 	'<a href="'.$root.'events-rsvp.php?event_id='.$event['id'].'&new_status=2" style="background: #aaaaaa;border-bottom: 2px solid #666666;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">Maybe</a></p>';

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
						$contents 	.= 	'<p><a href="'.$root.'events-rsvp.php?event_id='.$event['id'].'&new_status=3" style="background: #8cc540;border-bottom: 2px solid #679825;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">Yes</a>';
						$contents 	.= 	'<a href="'.$root.'events-rsvp.php?event_id='.$event['id'].'&new_status=0" style="background: #ce5637;border-bottom: 2px solid #822912;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">No</a>';
						$contents 	.= 	'<a href="'.$root.'events-rsvp.php?event_id='.$event['id'].'&new_status=2" style="background: #aaaaaa;border-bottom: 2px solid #666666;border-radius: 3px;color: #ffffff;display: inline-block;font-size: 16px;margin-right: 10px;padding: 10px 15px 8px 15px;text-decoration: none;">Maybe</a></p>';

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
											echo '<a class="secondary load invited" href="events-sails.php?event_id='.$event_id.'&action=remove&sail_id='.$sail['id'].'"><i class="fa fa-check"></i></a>';
										} else {
											echo '<a class="secondary load" href="events-sails.php?event_id='.$event_id.'&action=add&sail_id='.$sail['id'].'"><i class="fa fa-plus-circle"></i></a>';
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
			header('Location: '.$root.'events-all.php');
		} else {
			delete_event($event_id);
			header('Location: '.$root.'events-all.php?delete='.$event_id);
		}
	}
?>
