<header>
	<div class="wrapper no-bottom-margin">
		<h1 class="heading-2 profile">
			<span><img height="" src="<?php echo $member_images.$_SESSION['member_photo']; ?>" /></span>
			<span><?php echo $member['fname'].' '.$member['lname']; ?></span>
		</h1>
		<nav class="content-nav">
			<a <?php display_current_page('edit', $page); ?> href="profile-edit.php">Edit Profile</a>
			<a <?php display_current_page('photo', $page); ?> href="profile-change-photo.php">Change Photo</a>
			<a <?php display_current_page('password', $page); ?> href="profile-change-password.php">Change Password</a>
		</nav>
	</div>
</header>