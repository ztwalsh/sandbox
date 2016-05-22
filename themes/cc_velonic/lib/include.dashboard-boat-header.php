<header>
	<div class="wrapper no-bottom-margin">
		<h1 class="heading-2"><?php echo $boat['name']; ?></h1>
		<div class="meta-information">
			<span class="iconworks" data-icon="&#70;"></span> Created on <?php echo date('M d, Y', $boat['created_date']); ?>
		</div>
		<nav class="content-nav">
			<?php
				$boat = display_boat_detail($_SESSION['boat_id']);
				if ($_SESSION['member_privilege'] > 1) {
			?>
				<a <?php display_current_page('detail', $page); ?> href="boat-detail.php">Boat detail</a>
				<a <?php display_current_page('edit', $page); ?> href="boat-edit.php">Edit boat</a>
				<?php
					if ($boat['billing_key']) {
				?>
					<a <?php display_current_page('billing', $page); ?> href="boat-billing.php">Update billing</a>
					<a <?php display_current_page('cancel', $page); ?> href="boat-cancel.php">Cancel billing</a>
				<?php
					}
				?>
			<?php
				}
			?>
		</nav>
	</div>
</header>