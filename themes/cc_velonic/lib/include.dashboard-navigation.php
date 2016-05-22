<?php
	billing_status();
?>
<nav class="main-nav cf">
	<div class="logo">
		<a href="<?php echo $root; ?>dashboard"><img height="" src="<?php echo $root; ?>images/crewconnect_logo_white.png" width="" /></a>
	</div>
	<div class="mobile-menu">
		<a href="#">Menu <i class="fa fa-angle-down"></i></a>
	</div>
	<div class="navigation">
		<div class="menu">
			<?php if ($_SESSION['boat_count'] > 0) { ?>
			<ul>
				<li>
					<a class="drop-down-button" href="#">
						<?php show_boat_name($_SESSION['boat_id']); ?> <i class="fa fa-angle-down"></i>
					</a>
					<div class="drop-down-menu">
						<a href="boat-detail.php"><?php show_boat_name($_SESSION['boat_id']); ?> details</a>
						<?php
							if ($_SESSION['member_privilege'] > 1) {
								$boat = display_boat_detail($_SESSION['boat_id']);

								echo '<a href="boat-edit.php">Edit ';
								echo show_boat_name($_SESSION['boat_id']);
								echo '</a>';

								if ($boat['billing_key'] && $boat['billing_key'] != 1) {
									echo '<a href="boat-billing.php">Update billing</a>';
								}
							}
						?>
						<?php
							if ($_SESSION['boat_count'] > 1) {
								echo '<a href="select-boat.php">Switch boats</a>';
							}
						?>
						<a href="boat-add.php">Create a new boat</a>
					</div>
				</li>
				<li><a <?php page_on($page, 'event'); ?>href="event-all.php" class="dashboard-nav-header">Events</a></li>
				<li><a <?php page_on($page, 'member'); ?>href="member-all.php" class="dashboard-nav-header">Crew members</a></li>
				<li><a <?php page_on($page, 'todo'); ?>href="todo-all.php" class="dashboard-nav-header">To Do</a></li>
				<li><a <?php page_on($page, 'sail'); ?>href="sail-all.php" class="dashboard-nav-header">Sails</a></li>
				<?php } else { ?>
					<ul>
						<li><a href="boat-add.php">Create a new boat</a></li>
					</ul>
				<?php } ?>
			</ul>
		</div>
		<div class="account">
			<a class="drop-down-button" href="#">
				<img height="" src="<?php echo $member_images.$_SESSION['member_photo']; ?>" width="" />
				<span><?php echo $_SESSION['firstname']; ?> <i class="fa fa-angle-down"></i></span>
			</a>
			<div class="drop-down-menu right">
				<a href="profile-edit.php">Settings</a>
				<a href="../logout.php">Log out</a>

			</div>
		</div>
	</div>
</nav>
