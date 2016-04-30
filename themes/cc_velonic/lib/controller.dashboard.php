<?php
	function dashboard_events($boat_id, $member_id) {
		$events = get_events($boat_id);

		if (mysqli_num_rows($events) == 0) {
			echo '<div class="empty">';
				echo 'You have upcoming events right now.';
			echo '</div>';
		} else {
			$count = 0;

			while($event = $events->fetch_assoc()) {
				if ($count < 3) {
					$event_status = event_status($member_id, $event['id'], $boat_id);
					$remaining = $event['edate'] - time();
					$days_remaining = floor($remaining / 86400);

					if ($days_remaining == 1) {
						$days = 'day';
					} else {
						$days = 'days';
					}

					echo '<div class="dashboard-item">';
					echo '<h2 class="heading-5"><a href="event-detail.php?event_id='.$event['id'].'">'.truncate($event['name'], 25).'</a>';
					member_event_status($event_status['status'], $event['edate']);
					echo '</h2>';
					echo '<div class="meta-information">';
					echo '<span class="iconworks" data-icon="&#70;"></span> Starts in '.$days_remaining.' '.$days;
					echo '<span class="iconworks" data-icon="&#80;"></span> '.member_count($event['id'], $boat_id);
					echo '</div>';
					echo '</div>';

					$count++;
				}
			}
		}
	}

	function dashboard_todos($boat_id, $member_id, $status) {
		$todos = get_all_todos($boat_id, $status);

		if (mysqli_num_rows($todos) == 0) {
			echo '<div class="empty">';
				echo 'You have no to dos right now.';
			echo '</div>';
		} else {
			$count = 0;
			
			while($todo = $todos->fetch_assoc()) {
				if ($count < 3) {
					$remaining = $todo['due_date'] - time();
					$days_remaining = floor($remaining / 86400);

					if ($days_remaining == 0) {
						$due = 'Due today';
					} elseif ($days_remaining == -1) {
						$due = 'Due 1 day ado';
					} elseif ($days_remaining < -1) {
						$days_remaining = $days_remaining * -1;
						$due = 'Due '.$days_remaining.' days ago';
					} elseif ($days_remaining == 1) {
						$due = 'Due in one day';
					} else {
						$due = 'Due in '.$days_remaining.' days';
					}

					echo '<div class="dashboard-item">';
					echo '<h2 class="heading-5"><a href="todo-detail.php?todo_id='.$todo['id'].'">'.truncate($todo['name'], 25).'</a></h2>';
					echo '<div class="meta-information"><span class="iconworks" data-icon="&#70;"></span> '.$due.'</div>';
					echo '</div>';

					$count++;
				}
			}
		}
	}

	function dashboard_alerts($boat_id, $member_id) {
		$alerts = 0;

		if ($alerts == 0) {
			echo '<div class="empty">';
				echo 'You have no alerts right now.';
			echo '</div>';
		} else {
			
		}
	}
?>