<?php
	function sail_rating($rating) {
		$range = range(5,1);

		echo '<span class="rating">';
		foreach($range as $count) {
	        echo '<span class="rating-star';
	        if ($count <= $rating) {
	        	echo ' on';
	        }
	        echo '"><i class="fa fa-star"></i></span>';
		}
		echo '</span>';
	}

	function display_sails($boat_id) {
		$sails = get_all_sails($boat_id);
		global $root;

		if (mysqli_num_rows($sails) == 0) {
			echo '<div class="content">';
				echo '<div class="empty">';
					echo '<img src="'.$root.'images/sails_335x332.jpg" height="auto" width="200" /><br />';
					echo '<h2 class="heading-3">No sails for this boat</h2><br />';
					if ($_SESSION['member_privilege'] > 1) {
						echo '<a href="sail-add.php"><i class="fa fa-plus-circle"></i> Add new sail</a>';
					}
				echo '</div>';
			echo '</div>';
		} else {
			while($sail = $sails->fetch_assoc()) {
				echo '<div class="card">';
					echo '<div class="card-top cf">';
						echo '<div class="card-status">';
						sail_rating($sail['condition_rating']);
						echo '</div>';
						echo '<div class="card-info">';
							echo '<h2 class="heading-4"><a href="sail-detail.php?sail_id='.$sail['id'].'">'.$sail['year'].' '.$sail['sailmaker'].' '.$sail['type'].' '.$sail['sub_type'].'</a></h2>';
							echo '<span class="iconworks" data-icon="&#245;"></span> '.$sail['type'];
						echo '</div>';
					echo '</div>';
					echo '<div class="card-menu">';
						echo '<a href="sail-detail.php?sail_id='.$sail['id'].'">View details <i class="fa fa-angle-right"></i></a>';
						echo '<a href="sail-detail.php?sail_id='.$sail['id'].'#log">View logs <i class="fa fa-angle-right"></i></a>';
						if ($_SESSION['member_privilege'] > 1) {
							echo '<a href="sail-edit.php?sail_id='.$sail['id'].'">Edit sail <i class="fa fa-angle-right"></i></a>';
							echo '<a class="delete" href="sail-delete.php?sail_id='.$sail['id'].'">Delete sail <i class="fa fa-angle-right"></i></a>';
						}
					echo '</div>';
					echo '<div class="card-bottom">';
						echo '<a href="#">Options <i class="fa fa-angle-down"></i></a>';
					echo '</div>';
				echo '</div>';
			}
		}
	}

	function display_sails_for_form($boat_id) {
		$sails = get_all_sails($boat_id);

		$count = mysqli_num_rows($sails);

		if ($count > 0) {
			while($sail = $sails->fetch_assoc()) {
				echo '<tr>';
				echo '<td class="profile-picture"><input id="sails-'.$sail['id'].'" name="sail" type="radio" value="'.$sail['id'].'"';
				if(isset($_POST['sail']) && $_POST['sail'] == $sail['id']) {
					echo ' checked ';
				} else {
					echo '';
				}
				echo '/></td>';
				echo '<td><label for="sails-'.$sail['id'].'">'.$sail['year'].' '.$sail['sailmaker'].'</label></td>';
				echo '</tr>';
			}
		} else {
			echo '<tr>';
			echo '<td>';
			echo 'No sails available';
			echo '</td>';
			echo '</tr>';
		}
	}

	function display_sail_detail($sail_id) {
		global $root;

		if (empty($sail_id)) {
			header('Location: '.$root.'dashboard/sail-all.php');
		} else {
			$sail = get_single_sail($sail_id);
			$sail =  $sail->fetch_assoc();
			return $sail;
		}
	}

	function add_sail($member_id, $boat_id) {
		if ($_POST) {
			$required_fields = array('type', 'year', 'sailmaker', 'condition_rating');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
				$new_sail_id = insert_sail($member_id, $boat_id);
				header('Location: sail-detail.php?sail_id='.$new_sail_id);
			} else {
				return 'error_missing_fields';
			}
		} else {
			return 'no_submit';
		}
	}

	function edit_sail($sail_id) {
		if ($_POST) {
			$required_fields = array('type', 'year', 'sailmaker', 'condition_rating');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
				update_sail($sail_id);
			} else {
				return 'error_missing_fields';
			}
		} else {
			return false;
		}
	}

	function remove_sail($sail_id) {
		global $root;

		if (empty($sail_id)) {
			header('Location: '.$root.'dashboard/sail-all.php');
		} else {
			delete_sail($sail_id);
			header('Location: '.$root.'dashboard/sail-all.php?delete='.$sail_id);
		}
	}

	function display_sail_entries($sail_id, $boat_id) {
		global $member_images;
		global $root;

		$entries = get_sail_entries($sail_id, $boat_id);

		if (mysqli_num_rows($entries) == 0) {
			echo '<div class="content">';
				echo '<section><h2 class="heading-3">Sail log</h2></section>';
				echo '<section>';
					echo '<form action="'.$root.'dashboard/sail-detail.php?sail_id='.$sail_id.'" class="cf" method="post">';
						display_error('log_entry', 'Enter a log entry first');
						echo '<div class="wall-form-button">';
						primary_submit('Add');
						echo '</div>';
						echo '<div class="wall-form">';
						form_textarea('log_entry', 'What is the current condition of the sail?', 'wall');
						echo '</div>';
					echo '</form>';
				echo '</section>';
				echo '<div class="empty">';
					echo '<span class="iconworks" data-icon="&#78;"></span><br />';
					echo '<h2 class="heading-3">No log entries yet</h2><br />';
				echo '</div>';
			echo '</div>';
		} else {
			echo '<div class="content">';
			echo '<section><h2 class="heading-3">Sail log</h2></section>';
			echo '<section>';
				echo '<form action="'.$root.'dashboard/sail-detail.php?sail_id='.$sail_id.'" class="cf" method="post">';
					display_error('log_entry', 'Enter a log entry first');
					echo '<div class="wall-form-button">';
					primary_submit('Add');
					echo '</div>';
					echo '<div class="wall-form">';
					form_textarea('log_entry', 'What is the current condition of the sail?', 'wall');
					echo '</div>';
				echo '</form>';
			echo '</section>';
			while($entry = $entries->fetch_assoc()) {
				$member = get_member_detail($entry['user_id']);

				echo '<div class="wall-entry cf">';
					echo '<div class="wall-entry-user">';
						echo '<img class="profile-thumb" src="'.$member_images.$member['user_image'].'" /><br />';
					echo '</div>';
					echo '<div class="wall-entry-content">';
						echo '<h4 class="heading-5">'.$member['fname'].' <span class="time">'.date('M d, Y h:ia', $entry['post_time']).'</span></h4>';
						echo $entry['log_entry'].'<br />';
					echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		}
	}

	function add_sail_log_post($sail_id) {
		global $root;

		if ($_POST) {
			$required_fields = array('log_entry');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
				$new_message_id = insert_sail_log_post($sail_id);
			} else {
				return 'error_missing_fields';
			}
		} else {
			return 'no_submit';
		}
	}
?>