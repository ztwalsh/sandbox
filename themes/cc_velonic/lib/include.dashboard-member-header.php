<header>
	<div class="breadcrumb">
		<div class="wrapper">
			<a href="member-all.php"><i class="fa fa-angle-left"></i> All members</a>
		</div>
	</div>
	<div class="wrapper no-bottom-margin">
		<h1 class="heading-2 profile">
			<span><img src="<?php echo $member_images.$member['user_image']; ?>" /></span>
			<span><?php echo $member['fname'].' '.$member['lname']; ?></span>
		</h1>
	</div>
</header>