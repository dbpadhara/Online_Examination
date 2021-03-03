<!DOCTYPE html>
<html>


<head>
	    <title>Online Examination</title>
	    <?php
	    	include_once './static/js_and_css.php';
	    ?>
</head>

<body>
	<?php
		include_once './static/header.php';
	?>
	<div class="container">
		<div class="card">
			<div class="card-body">
				<form autocomplete="off">
					<div class="col-md-4">
						<div class="form-group">
							<label>Select Exam</label>
							<select class="form-control" id="exam_id" name="exam"></select>	
						</div>
						<span id="check_status"></span>
					</div>		
					<div class="row">
						<button class="btn btn-primary ml-4" type="button" onclick="return go_to_exam()">Go to exam</button>
					</div>
					
				</form>
			</div>
		</div>		
	</div>
	<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
	<input type="hidden" name="field_id" value="<?php echo $_SESSION['field_id'] ?>">
</body>
<script type="text/javascript" src="./assets/js/pg_js/user/index.js"></script>
</html>
