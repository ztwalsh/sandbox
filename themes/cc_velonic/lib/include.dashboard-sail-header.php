<header>
<div class="breadcrumb">
		<div class="wrapper">
			<a href="sail-all.php"><i class="fa fa-angle-left"></i> All sails</a>
		</div>
	</div>
	<div class="wrapper no-bottom-margin">
		<h1 class="heading-2"><?php echo $sail['year'].' '.$sail['sailmaker'].' '.$sail['type'].' '.$sail['sub_type']; ?></h1>
		<div class="meta-information">
		</div>
		<?php sail_rating($sail['condition_rating']); ?>
		<nav class="content-nav">
			<a <?php display_current_page('log', $page); ?> href="sail-detail.php?sail_id=<?php echo $sail['id']; ?>">View log</a>
			<?php
				if ($_SESSION['member_privilege'] > 1) {
					echo '<a';
					display_current_page('edit', $page);
					echo ' href="sail-edit.php?sail_id='.$sail['id'].'">Edit sail</a>';
				}
			?>
		</nav>
	</div>
</header>