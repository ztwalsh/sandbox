<?php
	function change_status_options($todo_id, $status) {
		if ($status == 0) {
			echo '<a class="unchecked" href="todo-change-status.php?todo_id='.$todo_id.'&status=1"><i class="fa fa-check"></i></a>';
		} elseif ($status == 1) {
			echo '<a class="checked" href="todo-change-status.php?todo_id='.$todo_id.'&status=0"><i class="fa fa-check"></i></a>';
		} else {
			echo '';
		}
	}

	function change_status($todo_id, $status) {
		global $root;

		if (empty($todo_id)) {
			header('Location: '.$root.'dashboard/todo-all.php');
		} else {
			change_status_todo($todo_id, $status);
			header('Location: '.$root.'dashboard/todo-all.php?change='.$todo_id);
		}
	}

	function display_assigned_crew_thumbs($todo_id, $boat_id) {
		global $mysqli;
		global $member_images;

		$assignments = get_todo_members($todo_id, $boat_id);

		$member_ids = array();
		while ($member_id = $assignments->fetch_assoc()) {
			$member_ids[] = $member_id['secondary_id'];
		}

		$members = get_member_group($member_ids);
		if(!$members) {
			echo 'Not assigned';
		} else {
			while($member = $members->fetch_assoc()) {
				echo '<div class="assignee-thumbs">';
				echo '<img class="profile-thumb" src="'.$member_images.$member['user_image'].'" /><br />';
				echo truncate($member['fname'], 1, '').truncate($member['lname'], 1, '');
				echo '</div>';
			}
		}
	}

	function display_todos($boat_id, $status) {
		$todos = get_all_todos($boat_id, $status);
		global $root;

		if (mysqli_num_rows($todos) == 0) {
			echo '<div class="empty">';
				echo '<img src="'.$root.'images/todo_335x332.jpg" height="auto" width="200" /><br />';
				echo '<h2 class="heading-3">There are no outstanding to dos</h2><br />';
			echo '</div>';
		} else {
			echo '<table class="info">';
				echo '<tbody>';
				while($todo = $todos->fetch_assoc()) {
					echo '<tr>';
						echo '<td class="checkbox">';
							change_status_options($todo['id'], $todo['status']);
						echo '</td>';
						echo '<td>';
							echo '<h2 class="heading-5"><a href="todo-detail.php?todo_id='.$todo['id'].'">'.$todo['name'].'</a></h2>';
							echo '<div class="meta-information"><span class="iconworks" data-icon="&#70;"></span>  '.date('M d, Y', $todo['due_date']).'</div>';
						echo '</td>';
						echo '<td class="assignees">';
							display_assigned_crew_thumbs($todo['id'], $boat_id);
						echo '</td>';
						if ($_SESSION['member_privilege'] > 1) {
							echo '<td class="action">';
									echo '<a class="secondary delete" href="todo-delete.php?delete_id='.$todo['id'].'"><i class="fa fa-minus-circle"></i></a>';
							echo '</td>';
						}
					echo '</tr>';
				}
				echo '</tbody>';
			echo '</table>';
		}
	}

	function display_todo_detail($todo_id) {
		global $root;

		if (empty($todo_id)) {
			header('Location: '.$root.'dashboard/todo-all.php');
		} else {
			$todo = get_single_todo($todo_id);
			$todo =  mysqli_fetch_assoc($todo);
			return $todo;
		}
	}

	function display_assigned_crew($todo_id, $boat_id) {
		global $mysqli;
		global $member_images;

		$assignments = get_todo_members($todo_id, $boat_id);

		$member_ids = array();
		while($assignment = $assignments->fetch_assoc()) {
			$member_ids[] = $assignment['secondary_id'];
		}

		$members = get_member_group($member_ids);

		if(!$members) {
			echo '<div class="empty">';
				echo '<span class="iconworks" data-icon="&#80;"></span><br />';
				echo '<h2 class="heading-3">No assignees</h2><br />';
				if ($_SESSION['member_privilege'] > 1) {
					echo '<a href="todo-edit.php?todo_id='.$todo_id.'#add-crew"><i class="fa fa-plus-circle"></i> Add crew members</a>';
				}
			echo '</div>';
		} else {
			while($member = $members->fetch_assoc()) {
				echo '<div class="todo-member">';
				echo '<img src="'.$member_images.$member['user_image'].'" /><br />';
				echo $member['fname'].' '.$member['lname'];
				echo '</div>';
			}
		}
	}

	function member_ids($todo_id, $boat_id) {
		global $root;

		if (empty($todo_id)) {
			header('Location: '.$root.'dashboard/todo-all.php');
		} else {
			$member_ids = get_todo_members($todo_id, $boat_id);

			$members = array();
			while ($member_id = $member_ids->fetch_assoc()) {
				$members[] = $member_id['secondary_id'];
			}

			return $members;
		}
	}

	function add_todo($boat_id) {
		if ($_POST) {
			$required_fields = array('name', 'due_date');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
				$new_todo_id = insert_todo($boat_id);

				if ($_POST['member_id']) {
					foreach($_POST['member_id'] as $member_id) {
						add_assignments($member_id, $boat_id, $new_todo_id);
					}
				}

				header('Location: todo-detail.php?todo_id='.$new_todo_id);
			} else {
				return 'error_missing_fields';
			}
		} else {
			return 'no_submit';
		}
	}

	function select_todo_member($boat_id, $member_id = NULL) {
		global $member_images;

		$members = get_all_active_members($boat_id);

		if (empty($members)) {
			echo 'No members to select';
		} else {
			echo '<ul class="cf">';
			while($member = $members->fetch_assoc()) {
				echo '<li>';
					echo '<input name="member_id[]" id="member_id_'.$member['id'].'" type="checkbox" value="'.$member['id'].'"';
					if($member_id && in_array($member['id'], $member_id)) {
						echo ' checked';
					} elseif (isset($_POST['member_id[]']) && $_POST['member_id'] == $member['id']) {
						echo ' checked';
					}
					echo ' />';
					echo '<label for="member_id_'.$member['id'].'">';
						echo '<img src="'.$member_images.$member['user_image'].'" /><br />';
						echo $member['fname'].' '.$member['lname'];
					echo '</label>';
				echo '</li>';
			}
			echo '</ul>';
		}
	}

	function edit_todo($todo_id) {
		if ($_POST) {
			$required_fields = array('name', 'due_date');
			$errors = required_fields($required_fields, $_POST);
		    if(empty($errors)) {
				update_todo($todo_id);

				if (isset($_POST['member_id'])) {
					$current_members = member_ids($_GET['todo_id'], $_SESSION['boat_id']);
					$new_members = $_POST['member_id'];

					$combined_ids = array_merge($current_members, $new_members);
					$combined_ids = array_unique($combined_ids);

					$delete_members = array_diff($current_members, $new_members);
					$add_members = array_diff($new_members, $current_members);

					if ($new_members) {
						foreach($combined_ids as $member_id) {
							if (in_array($member_id, $delete_members)) {
								delete_assignments($member_id, $_SESSION['boat_id'], $todo_id);
							} elseif (in_array($member_id, $add_members)) {
								add_assignments($member_id, $_SESSION['boat_id'], $todo_id);
							}
						}
					}
				}
			} else {
				return 'error_missing_fields';
			}
		} else {
			return false;
		}
	}

	function remove_todo($todo_id) {
		global $root;

		if (empty($todo_id)) {
			header('Location: '.$root.'dashboard/todo-all.php');
		} else {
			delete_todo($todo_id);
			header('Location: '.$root.'dashboard/todo-all.php?delete='.$todo_id);
		}
	}
?>