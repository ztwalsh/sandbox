<header class="cf">
	<div class="breadcrumb">
		<div class="wrapper">
			<a href="todo-all.php"><i class="fa fa-angle-left"></i> All to do</a>
		</div>
	</div>
	<div class="wrapper no-bottom-margin">
		<h1 class="heading-2"><?php echo $todo['name']; ?></h1>
		<div class="meta-information">
			<span class="iconworks" data-icon="&#70;"></span> <?php echo date('M d, Y', $todo['due_date']); ?>
		</div>
		<nav class="content-nav">
			<a <?php display_current_page('detail', $page); ?> href="todo-detail.php?todo_id=<?php echo $todo['id']; ?>">View Details</a>
			<?php
				if ($_SESSION['member_privilege'] > 1) {
					echo '<a ';
					display_current_page('edit', $page);
					echo ' href="todo-edit.php?todo_id='.$todo['id'].'">Edit To Do</a>';
				}
			?>
		</nav>
	</div>
</header>