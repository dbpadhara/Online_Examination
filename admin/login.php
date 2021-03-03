<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Online Examination || Login</title>

	<!-- Global stylesheets -->
	<link href="../assets/css/iconmoon/styles.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="../assets/js/app.js"></script>
	<script src="../assets/js/pg_js/login/login.js"></script>


	<!-- /theme JS files -->
</head>

<body>
		
	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form id="loginform" class="login-form" autocomplete="off">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h3>Employee Login</h3>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" name="username" class="form-control" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
								<span id="uname"></span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" name="password" class="form-control" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
								<span id="pass"></span>
							</div>

							<div class="form-group">
								<button type="button" onclick="return check()" id="save" class="btn btn-primary btn-block">Login <i class="icon-circle-right2 ml-2"></i></button>
							</div>
							<span id="status"></span>
							<div class="row">
								<div class="col-md-6">
									<a href="forget_pass.php">Forgot password?</a>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="action" value="checkLogin">
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

			</div>
		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>

</html>
