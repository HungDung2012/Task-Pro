<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	if ($_SESSION['role'] == "admin") {
		$todaydue_task = count_tasks_due_today($conn);
		$overdue_task = count_tasks_overdue($conn);
		$nodeadline_task = count_tasks_NoDeadline($conn);
		$num_task = count_tasks($conn);
		$num_users = count_users($conn);
		$pending = count_pending_tasks($conn);
		$in_progress = count_in_progress_tasks($conn);
		$completed = count_completed_tasks($conn);
	} 
?>



	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="section-1">
				<?php if ($_SESSION['role'] == "admin") { ?>
					<div class="dashboard">
						<div class="dashboard-title">
							<h2>Tổng quan nhiệm vụ</h2>
							<p>Xem trạng thái các nhiệm vụ của bạn</p>
						</div>

						<!-- Stats Cards Row 1 -->
						<div class="stats-row">
							<div class="stat-card blue">
								<div class="stat-content">
									<div class="stat-label">Nhân viên</div>
									<div class="stat-value"><?=$num_users?></div>
								</div>
								<div class="stat-icon">
								<i class="fa fa-users"></i>
								</div>
							</div>

							<div class="stat-card blue">
								<div class="stat-content">
									<div class="stat-label">Tất cả nhiệm vụ</div>
									<div class="stat-value"><?=$num_task?></div>
								</div>
								<div class="stat-icon">
									<i class="fa fa-tasks"></i>
								</div>
							</div>

							<div class="stat-card red">
								<div class="stat-content">
									<div class="stat-label">Quá hạn</div>
									<div class="stat-value"><?=$overdue_task?></div>
								</div>
								<div class="stat-icon">
									<i class="fa fa-window-close-o"></i>
								</div>
							</div>
						</div>

						<!-- Stats Cards Row 2 -->
						<div class="stats-row">
							<div class="stat-card gray">
								<div class="stat-content">
									<div class="stat-label">Không có deadline</div>
									<div class="stat-value"><?=$nodeadline_task?></div>
								</div>
								<div class="stat-icon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>

							<div class="stat-card orange">
								<div class="stat-content">
									<div class="stat-label">Đến hạn hôm nay</div>
									<div class="stat-value"><?=$todaydue_task?></div>
								</div>
								<div class="stat-icon">
									<i class="fa fa-exclamation-triangle"></i>
								</div>
							</div>

							<div class="stat-card purple">
								<div class="stat-content">
									<div class="stat-label">Thông báo</div>
									<div class="stat-value"><?=$overdue_task?></div>
								</div>
								<div class="stat-icon">
									<i class="fa fa-bell"></i>
								</div>
							</div>
						</div>

						<!-- Stats Cards Row 3 -->
						<div class="stats-row">
							<div class="stat-card green">
								<div class="stat-content">
									<div class="stat-label">Đang chờ xử lý</div>
									<div class="stat-value"><?=$pending?> </div>
								</div>
								<div class="stat-icon">
									<i class="fa fa-check-square-o"></i>
								</div>
							</div>

							<div class="stat-card teal">
								<div class="stat-content">
									<div class="stat-label">Đang thực hiện</div>
									<div class="stat-value"><?=$in_progress?></div>
								</div>
								<div class="stat-icon">
									<i class="fa fa-spinner"></i>
								</div>
							</div>

							<div class="stat-card lime">
								<div class="stat-content">
									<div class="stat-label">Hoàn thành</div>
									<div class="stat-value"><?=$completed?></div>
								</div>
								<div class="stat-icon">
								</div>
							</div>
						</div>

					</div>
				<?php } else { ?>
					<div class="dashboard">
						<div class="dashboard-item">
							<i class="fa fa-tasks"></i>
							<span><?= $num_my_task ?> My Tasks</span>
						</div>
						<div class="dashboard-item">
							<i class="fa fa-window-close-o"></i>
							<span><?= $overdue_task ?> Overdue</span>
						</div>
						<div class="dashboard-item">
							<i class="fa fa-clock-o"></i>
							<span><?= $nodeadline_task ?> No Deadline</span>
						</div>
						<div class="dashboard-item">
							<i class="fa fa-square-o"></i>
							<span><?= $pending ?> Pending</span>
						</div>
						<div class="dashboard-item">
							<i class="fa fa-spinner"></i>
							<span><?= $in_progress ?> In progress</span>
						</div>
						<div class="dashboard-item">
							<i class="fa fa-check-square-o"></i>
							<span><?= $completed ?> Completed</span>
						</div>
					</div>
				<?php } ?>
			</section>
		</div>

		<script type="text/javascript">
			var active = document.querySelector("#navList li:nth-child(1)");
			active.classList.add("active");
		</script>
	</body>

	</html>
<?php }
