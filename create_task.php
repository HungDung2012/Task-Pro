<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "DB_connection.php";
	include "app/Model/User.php";

	$users = get_all_users($conn);

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Create Task</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<div class="create-tack-section">
				<div class="page-header">
					<h1 class="page-title">Thêm nhiệm vụ</h1>
				</div>

				<?php if (isset($success_message)): ?>
					<div class="alert alert-success">
						<i class="fa fa-check-circle"></i>
						<span><?php echo $success_message; ?></span>
					</div>
				<?php endif; ?>

				<div class="card-create-task">
					<form method="POST" action="app/add-task.php">
						<?php if (isset($_GET['error'])) { ?>
							<div class="danger" role="alert">
								<?php echo stripcslashes($_GET['error']); ?>
							</div>
						<?php } ?>

						<?php if (isset($_GET['success'])) { ?>
							<div class="success" role="alert">
								<?php echo stripcslashes($_GET['success']); ?>
							</div>
						<?php } ?>
						<div class="form-group">
							<label for="title" class="form-label">Tiêu đề</label>
							<input type="text" id="title" name="title" class="form-control" placeholder="Nhập tiêu đề nhiệm vụ" required>
						</div>

						<div class="form-group">
							<label for="description" class="form-label">Mô tả</label>
							<textarea id="description" name="description" class="form-control" placeholder="Nhập mô tả nhiệm vụ"></textarea>
						</div>

						<div class="form-row">
							<div class="form-col">
								<div class="form-group">
									<label for="due_date" class="form-label">Thời hạn</label>
									<div class="date-picker-wrapper">
										<input type="date" id="due_date" name="due_date" class="form-control" >
										<i class="far fa-calendar"></i>
									</div>
								</div>
							</div>
							<div class="form-col">
								<div class="form-group">
									<label for="assigned_to" class="form-label">Phân công</label>
									<select id="assigned_to" name="assigned_to" class="form-control form-select" required>
										<option value="" disabled selected>Chọn nhân viên</option>
										<?php
										// Placeholder for PHP code that would generate options
										foreach ($users as $users) {
											echo '<option value="' . $users['id'] . '">' . $users['full_name'] . '</option>';
										}
										?>

									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="form-label">Mức ưu tiên</label>
							<div class="priority-options">
								<div class="priority-option">
									<input type="radio" id="priority-low" name="priority" value="low">
									<label for="priority-low" class="priority-label priority-low">
										<i class="fa fa-arrow-down"></i>
										<span>Thấp</span>
									</label>
								</div>
								<div class="priority-option">
									<input type="radio" id="priority-medium" name="priority" value="medium" checked>
									<label for="priority-medium" class="priority-label priority-medium">
										<i class="fa fa-minus"></i>
										<span>Trung bình</span>
									</label>
								</div>
								<div class="priority-option">
									<input type="radio" id="priority-high" name="priority" value="high">
									<label for="priority-high" class="priority-label priority-high">
										<i class="fa fa-arrow-up"></i>
										<span>Cao</span>
									</label>
								</div>
							</div>
						</div>

						<div class="action-buttons">
							<button type="submit" class="create-tack-btn create-tack-btn-primary">
								<i class="fa fa-plus-circle"></i>
								Tạo mới
							</button>
							
						</div>
					</form>
				</div>
			</div>

		</div>

		<script type="text/javascript">
			var active = document.querySelector("#navList li:nth-child(3)");
			active.classList.add("active");


			// Set default date to tomorrow
			document.addEventListener('DOMContentLoaded', function() {
				const tomorrow = new Date();
				tomorrow.setDate(tomorrow.getDate() + 1);

				const year = tomorrow.getFullYear();
				const month = String(tomorrow.getMonth() + 1).padStart(2, '0');
				const day = String(tomorrow.getDate()).padStart(2, '0');

				document.getElementById('due_date').value = `${year}-${month}-${day}`;
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