<nav class="side-bar">
	<div class="user-p">
		<img src="img/user.png">
		<h4>@<?= $_SESSION['username'] ?></h4>
	</div>

	<?php

	if ($_SESSION['role'] == "employee") {
	?>
		<!-- Employee Navigation Bar -->
		<ul id="navList">
			<li>
				<a href="index.php">
					<i class="fa fa-tachometer" aria-hidden="true"></i>
					<span>Tổng quan</span>
				</a>
			</li>
			<li>
				<a href="my_task.php">
					<i class="fa fa-tasks" aria-hidden="true"></i>
					<span>My Task</span>

				</a>
			</li>
			<li>
				<a href="profile.php">
					<i class="fa fa-user" aria-hidden="true"></i>
					<span>Profile</span>
				</a>
			</li>
			<li>
				<a href="notifications.php">
					<i class="fa fa-bell" aria-hidden="true"></i>
					<span>Notifications</span>
				</a>
			</li>
			<li>
				<a href="logout.php">
					<i class="fa fa-sign-out" aria-hidden="true"></i>
					<span>Logout</span>
				</a>
			</li>
		</ul>
	<?php } else { ?>
		<!-- Admin Navigation Bar -->
		<ul id="navList">
			<li>
				<a href="index.php">
					<i class="fa fa-tachometer" aria-hidden="true"></i>
					<span>Tổng quan</span>
				</a>
			</li>
			<li>
				<a href="user.php">
					<i class="fa fa-users" aria-hidden="true"></i>
					<span>Quản lý nhân viên</span>
				</a>
			</li>
			<li>
				<a href="create_task.php">
					<i class="fa fa-plus" aria-hidden="true"></i>
					<span>Giao Việc</span>
				</a>
			</li>
			<li>
				<a href="tasks.php">
					<i class="fa fa-tasks" aria-hidden="true"></i>
					<span>Xem tất cả</span>
				</a>
			</li>
			<li>
				<a href="logout.php">
					<i class="fa fa-sign-out" aria-hidden="true"></i>
					<span>Đăng xuất</span>
				</a>
			</li>
		</ul>
	<?php } ?>
</nav>