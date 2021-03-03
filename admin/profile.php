<!DOCTYPE html>
<html>
<head>
	<title>Online Examination | profile</title>
	<?php

		include_once './static/js_and_css.php'
	?>
</head>
<body>
	<?php
		include_once './static/header.php'
	?>
	<?php
		include_once './static/sidebar.php'
	?>
	<?php
		include_once './config/dbConnection.php'
	?>
	<input type="hidden" name="emp_id" value="<?php echo $_SESSION['employee_id']?>">
	
	<div class="card">
		<div class="card-header">
			<h1 class="text-center text-uppercase">Profile</h2>
		</div>

		<div class="card-body">
			<div class="text-center">	
				<div class="card-img-actions d-inline-block mb-3">
					<img class="img-fluid rounded-circle" id="user_image" width="170" height="170" alt="Your profile">
				</div>
			</div>
    		<div class="row">
    			<div class="col">
    				<div class="form-group">
    					<label>Email</label>
    				<input type="text" readonly="readonly" class="form-control" name="email">
    				</div>		
    			</div>
    			<div class="col">
    				<div class="form-group">
    					<label>Mobile Number</label>
    				<input type="text" readonly="readonly" class="form-control" name="mobile_number">
    				</div>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col">
    				<div class="form-group">
    					<label>User Name</label>
    				<input type="text" readonly="readonly" class="form-control" name="user_name">
    				</div>		
    			</div>
    			<div class="col">
    				<div class="form-group">
    					<label>Name</label>
    				<input type="text" readonly="readonly" class="form-control" name="employee_name">
    				</div>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col">
    				<div class="form-group">
    					<label>Role</label>
    				<input type="text" readonly="readonly" class="form-control" name="role">
    				</div>
    			</div>
    			<div class="col">
    				<div class="form-group">
    					<label>Password</label>
    				<input type="text" readonly="readonly" class="form-control" name="password">
    				</div>
    			</div>
    		</div>
		</div>
	</div>

	<script type="text/javascript" src="../assets/js/pg_js/admin/profile.js"></script>
	<?php	
		include_once './static/footer.php'
	?>
</body>
</html>