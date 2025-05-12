<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	$text = "All Task";
	if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Due Today") {
		$text = "Due Today";
		$tasks = get_all_tasks_due_today($conn);
		$num_task = count_tasks_due_today($conn);
	} else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Overdue") {
		$text = "Overdue";
		$tasks = get_all_tasks_overdue($conn);
		$num_task = count_tasks_overdue($conn);
	} else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "No Deadline") {
		$text = "No Deadline";
		$tasks = get_all_tasks_NoDeadline($conn);
		$num_task = count_tasks_NoDeadline($conn);
	} else {
		$tasks = get_all_tasks($conn);
		$num_task = count_tasks($conn);
	}
	$users = get_all_users($conn);


?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>All Tasks</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<div class="tasks-main-content">
				<div class="page-header">
					<h1 class="page-title">Danh Sách Nhiệm vụ</h1>
					<div class="header-actions">
						<div class="search-box">
							<i class="fa fa-search search-icon"></i>
							<input type="text" class="search-input" placeholder="Tìm kiếm...">
						</div>
						<a href="create_task.php" class="btn btn-primary">
							<i class="fa fa-plus"></i>
							Tạo mới
						</a>
					</div>
				</div>

				<div class="card">
					<div class="tabs">
						<a href="?filter=all" class="tab <?php echo $filter === 'all' ? 'active' : ''; ?>">
							Xem tất cả <span class="task-count"><?php echo count($tasks); ?></span>
						</a>
						<a href="tasks.php?due_date=Due Today" class="tab <?php echo isset($_GET['due_date']) && $_GET['due_date'] == 'Due Today' ? 'active' : ''; ?>">
							Hạn hôm nay <span class="task-count"><?php echo count_tasks_due_today($conn); ?></span>
						</a>
						<a href="tasks.php?due_date=Overdue" class="tab <?php echo isset($_GET['due_date']) && $_GET['due_date'] == 'Overdue' ? 'active' : ''; ?>">
							Quá hạn <span class="task-count"><?php echo count_tasks_overdue($conn); ?></span>
						</a>
						<a href="tasks.php?due_date=No Deadline" class="tab <?php echo isset($_GET['due_date']) && $_GET['due_date'] == 'No Deadline' ? 'active' : ''; ?>">
							Không có hạn <span class="task-count"><?php echo count_tasks_NoDeadline($conn); ?></span>
						</a>
					</div>

					<?php if (isset($_GET['success'])) { ?>
						<div class="success" role="alert">
							<?php echo stripcslashes($_GET['success']); ?>
						</div>
					<?php } ?>
					<?php if ($tasks == 0): ?>
						<div class="empty-state">
							<div class="empty-state-icon">
								<i class="fa fa-tasks"></i>
							</div>
							<h3 class="empty-state-title">Không tìm thấy nhiệm vụ</h3>
							<p class="empty-state-description">Không có nhiệm vụ nào phù hợp với bộ lọc hiện tại của bạn..</p>
							<a href="create_task.php" class="btn btn-primary">
								<i class="fa fa-plus"></i>
								Tạo nhiệm vụ mới
							</a>
						</div>
					<?php else: ?>

						<div class="table-responsive">
							<table>
								<thead>
									<tr>
										<th width="5%">#</th>
										<th width="25%">Tiêu đề</th>
										<th width="15%">Phân công</th>
										<th width="15%">Hạn chót</th>
										<th width="10%">Tình trạng</th>
										<th width="15%">Thao tác</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 0;
									foreach ($tasks as $task) { ?>
										<tr>
											<td><?= ++$i ?></td>
											<td>
												<div class="task-title"><?= $task['title'] ?></div>
												<div class="task-description"><?= $task['description'] ?></div>
											</td>
											<td>
												<div class="assignee">
													<span class="assignee-name"><?php foreach ($users as $user) {
																					if ($user['id'] == $task['assigned_to']) {
																						echo $user['full_name'];
																					}
																				} ?></span>
												</div>
											</td>
											<td>
												<div class="due-date">
													<i class="fa-solid fa-calendar-days"></i>
													<span><?php if ($task['due_date'] == "") echo "Không có hạn";
															else echo $task['due_date'];
															?>
													</span>
												</div>
											</td>
											<td>
												<span class="status-badge">
													<?php echo ucfirst($task['status']); ?>
												</span>
											</td>
											<td>
												<div class="table-actions">
													<a href="edit-task.php?id=<?=$task['id']?>" class="btn btn-primary btn-sm">
														<i class="fa fa-edit"></i> Sửa
													</a>
													<a href="delete-task.php?id=<?=$task['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa nhiệm vụ này?')">
														<i class="fa fa-trash"></i> Xóa
													</a>
												</div>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>

		<script type="text/javascript">
			var active = document.querySelector("#navList li:nth-child(4)");
			active.classList.add("active");


			// Simple search functionality
			document.addEventListener('DOMContentLoaded', function() {
				const searchInput = document.querySelector('.search-input');
				const tableRows = document.querySelectorAll('tbody tr');

				searchInput.addEventListener('input', function() {
					const searchTerm = this.value.toLowerCase();

					tableRows.forEach(row => {
						const title = row.querySelector('.task-title').textContent.toLowerCase();
						const description = row.querySelector('.task-description').textContent.toLowerCase();
						const assignee = row.querySelector('.assignee-name').textContent.toLowerCase();

						if (title.includes(searchTerm) || description.includes(searchTerm) || assignee.includes(searchTerm)) {
							row.style.display = '';
						} else {
							row.style.display = 'none';
						}
					});
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	$em = "Vui lòng đăng nhập!";
	header("Location: login.php?error=$em");
	exit();
}
?>