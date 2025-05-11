<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "DB_connection.php";
	include "app/Model/User.php";

	$users = get_all_users($conn);

	// Search functionality
	$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
	$filteredUsers = [];

	if (!empty($searchQuery)) {
		foreach ($users as $user) {
			if (stripos($user['full_name'], $searchQuery) !== false || 
				stripos($user['username'], $searchQuery) !== false) {
				$filteredUsers[] = $user;
			}
		}
	} else {
		$filteredUsers = $users;
	}
?>



	<!DOCTYPE html>
	<html>

	<head>
		<title>Manage Users</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<main>
				<div class="card">
					<div class="card-header">
						<h2 class="card-title">Quản lý Nhân Viên</h2>
						<div class="card-actions">
							<form action="" method="GET" class="search-form">
								<div class="search-container">
									<i class="fa fa-search search-icon"></i>
									<input
										type="text"
										name="search"
										placeholder="Tìm kiếm..."
										class="search-input"
										value="<?php echo htmlspecialchars($searchQuery);?>"
										required>
								</div>
							</form>
							<button class="btn btn-primary" id="addUserBtn">
								<a href="add-user.php"><i class="fa fa-plus"></i>Thêm</a></h4>
								
							</button>
							
						</div>
					</div>
					<?php if (isset($_GET['success'])) { ?>
								<div class="success" role="alert">
									<?php echo stripcslashes($_GET['success']); ?>
								</div>
							<?php } ?>
					<div class="card-content">
						<?php if ($users != 0) { ?>
							<div class="table-container">
								<table class="data-table">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Full Name</th>
											<th>Username</th>
											<th>Role</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if (count($filteredUsers) > 0): ?>
										<?php $i = 0; foreach ($filteredUsers as $filteredUsers) { ?>
											<tr>
											<td><?=++$i?></td>
												<td><?=$filteredUsers['full_name']?></td>
												<td><?=$filteredUsers['username']?></td>
										
												<td>
													<span class="badge"><?=$filteredUsers['role']?></span>
												</td>
												<td class="text-right">
													<div class="action-buttons">
														<button class="btn btn-outline btn-sm edit-btn">
															<a href="edit-user.php?id=<?=$filteredUsers['id']?> ">Edit</a>
														</button>
														<button class="btn btn-outline btn-danger btn-sm delete-btn">
															<a href="delete-user.php?id=<?=$filteredUsers['id']?>">Delete</a>
														</button>
													</div>
												</td>
											</tr>
										<?php	} ?>
									<?php else: ?>
                                        <tr>
                                            <td colspan="5" class="empty-state">No users found.</td>
                                        </tr>
                                    <?php endif; ?>
									</tbody>
								</table>
							</div>
						<?php } else { ?>
							<h3>Empty</h3>
						<?php  } ?>
					</div>
				</div>
			</main>
		</div>

		<script type="text/javascript">
			var active = document.querySelector("#navList li:nth-child(2)");
			active.classList.add("active");
		</script>
	</body>

	</html>
<?php } else {
	$em = "First login";
	header("Location: login.php?error=$em");
	exit();
}
?>