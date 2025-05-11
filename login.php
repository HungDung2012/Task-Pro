<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Task Management System</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="login-body">


	<form method="POST" action="app/login.php" class="shadow p-4">

		<?php if (isset($_GET['error'])) { ?>
			<div class="alert alert-danger" role="alert">
				<?php echo stripcslashes($_GET['error']); ?>
			</div>
		<?php } ?>

		<?php if (isset($_GET['success'])) { ?>
			<div class="alert alert-success" role="alert">
				<?php echo stripcslashes($_GET['success']); ?>
			</div>
		<?php } ?>


		<div class="form-content login">
			<h3 class="form-title">Đăng nhập tài khoản</h3>
			<p class="form-description">
				Phần mềm quản lý nhân sự hàng đầu Việt Nam
			</p>
			<form action="" class="login-form">
				<div class="form-group">
					<label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
					<input name="user_name" type="text" placeholder="Nhập số điện thoại"
						class="form-control">
					<span class="form-message phonelog"></span>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
					<input id="exampleInputPassword1" name="password" type="password" placeholder="Nhập mật khẩu"
						class="form-control">
					<span class="form-message-check-login form-message"></span>
				</div>
				<button type="submit" class="form-submit">Đăng nhập</button>
			</form>

		</div>

	</form>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>