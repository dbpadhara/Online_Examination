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
	<?php
		// if($_SESSION['exam_id']==null){
		// 	header("location:index.php");
		// }
	?>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Total Question</label>
						<input type="text" readonly="readonly" class="form-control" name="total_question">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Correct Answer</label>
						<input type="text" readonly="readonly" class="form-control" name="correct_answer">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Wrong Answer</label>
						<input type="text" readonly="readonly" class="form-control" name="wrong_answer">
					</div>
				</div>
			</div>
		
	
			<h1 class="text-center text-uppercase text-success">
				Exam can be completed
			</h1>
			<div class="text-center">
				<button class="btn btn-success pr-5 pl-5" type="button" onclick="logout()">
					Finish
				</button>
			</div>
		</div>
	</div>
	<input type="text" name="exam_id" value="1">
	<input type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
<script type="text/javascript" src="./assets/js/pg_js/user/user_result.js"></script>
</body>
</html>