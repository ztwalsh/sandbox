<header>
	<div class="breadcrumb">
		<div class="wrapper">
			<a href="event-all.php"><i class="fa fa-angle-left"></i> All events</a>
		</div>
	</div>
	<div class="wrapper no-bottom-margin">
		<h1 class="heading-2"><?php echo $event['name']; ?></h1>
		<div class="meta-information">
			<span class="iconworks" data-icon="&#70;"></span> 
				<?php 
					echo date('M d, Y', $event['edate']);
					if (isset($event['edate_end'])) {
						echo '&ndash;'.date('M d, Y', $event['edate_end']);
					}
				?>
			<span class="iconworks" data-icon="&#105;"></span> <?php echo date('h:ia', $event["edate"]); ?>
			<span class="iconworks" data-icon="&#36;"></span> <?php echo $event['location']; ?>
		</div>
		<nav class="content-nav">
			<a <?php display_current_page('crew', $page); ?> href="event-detail.php?event_id=<?php echo $event['id']; ?>">View crew (<?php echo member_count($event['id'], $_SESSION['boat_id']); ?>)</a>
			<a <?php display_current_page('sails', $page); ?> href="event-sails.php?event_id=<?php echo $event['id']; ?>">View sails</a>
			<?php
				if ($_SESSION['member_privilege'] > 1) {
					echo '<a';
					display_current_page('edit', $page);
					echo ' href="event-edit.php?event_id='.$event['id'].'">Edit event</a>';
				}
			?>
		</nav>
	</div>
</header>