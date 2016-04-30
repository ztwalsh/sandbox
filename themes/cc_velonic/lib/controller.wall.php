<?php
	function display_wall_entries($boat_id) {
		global $member_images;
		global $root;

		$entries = get_wall_entries($boat_id);

		if (mysqli_num_rows($entries) == 0) {
			echo '<div class="content">';
				echo '<section><h2 class="heading-3">Newsfeed</h2></section>';
				echo '<section>';
					echo '<form action="'.$root.'dashboard/" class="cf" method="post">';
						display_error('message', 'Enter a message first');
						echo '<div class="wall-form-button">';
						primary_submit('Add');
						echo '</div>';
						echo '<div class="wall-form">';
						form_textarea('message', 'Be the first to add a message...', 'wall');
						echo '<p><input class="alert" id="alert" name="alert" type="checkbox" checked /> <label for="alert">Email to all crew</label></p>';
						echo '</div>';
					echo '</form>';
				echo '</section>';
				echo '<div class="empty">';
					echo '<span class="iconworks" data-icon="&#78;"></span><br />';
					echo '<h2 class="heading-3">No wall posts yet</h2><br />';
				echo '</div>';
			echo '</div>';
		} else {
			echo '<div class="content">';
			echo '<section><h2 class="heading-3">Newsfeed</h2></section>';
			echo '<section>';
				echo '<form action="'.$root.'dashboard/" class="cf" method="post">';
					display_error('message', 'Enter a message first');
					echo '<div class="wall-form-button">';
					primary_submit('Add');
					echo '</div>';
					echo '<div class="wall-form">';
					form_textarea('message', 'Add a message...', 'wall');
					echo '<p><input class="alert" id="alert" name="alert" type="checkbox" checked /> <label for="alert">Email to all crew</label></p>';
					echo '</div>';
				echo '</form>';
			echo '</section>';
			while($entry = $entries->fetch_assoc()) {
				$member = get_member_detail($entry['uid']);

				echo '<div class="wall-entry cf">';
					echo '<div class="wall-entry-user">';
						echo '<img class="profile-thumb" src="'.$member_images.$member['user_image'].'" /><br />';
					echo '</div>';
					echo '<div class="wall-entry-content">';
						echo '<h4 class="heading-5">'.$member['fname'].' <span class="time">'.date('M d, Y h:ia', $entry['post_time']).'</span></h4>';
						echo $entry['message'].'<br />';
					echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		}
	}
	

	function add_wall_post() {
		global $root;

		if ($_POST) {
			$required_fields = array('message');
			$errors = required_fields($required_fields, $_POST);

		    if(empty($errors)) {
				$new_message_id = insert_wall_post($boat_id);

				if (isset($_POST['alert'])) {
					$members = get_all_members($_SESSION['boat_id'], '');
					$boat = display_boat_detail($_SESSION['boat_id']);

					while($member = $members->fetch_assoc()) {
						$email 		= 	$member['email'];
						$subject 	= 	'New Wall Post on '.$boat['name'].'!';
						$contents 	= 	'<h1 style="color: #343e48;font-weight: normal;line-height: 110%;">'.$boat['name'].'</h1>';
						$contents 	.= 	'<p>'.trim($_POST['message']).'</p>';

						send_email($email, $subject, $contents);
					}
				}

				header('Location: '.$root.'dashboard/');
			} else {
				return 'error_missing_fields';
			}
		} else {
			return 'no_submit';
		}
	}
?>