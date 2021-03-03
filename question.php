<!DOCTYPE html>
<html>
<head>
	<title>Exam Question</title>
	<?php

		include_once './admin/config/dbConnection.php';
		include_once './static/js_and_css.php'
	?>
</head>
<body>
	<?php
	include_once './static/header.php';	
?>
<?php
	
	if($_SESSION['exam_id']==null){
		header("location:index.php");
	}
	
	// echo $_SESSION['exam_id'];
	$num=1;//use in looping
	// $exam_id = $_SESSION['exam_id'];
	$qry="SELECT question_id,question,option1,option2,option3,option4 FROM question WHERE exam_id=$exam_id AND active_flag=0";
	$res=mysqli_query($con,$qry);
	?>

	<div class="container">
		<div class="card">
			<div class="card-header">
				<h3 class="text-center">Exam Title</h3>
			</div>
			<div class="card-body">
			<form id="question_form" autocomplete="off">
			<input type="hidden" name="exam_id" value="<?php echo $_SESSION["exam_id"] ?>">
			<input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
			<input type="hidden" name="action" value="saveQuestionAnswer">
			<!-- <div id="add_question"></div>	using ajax -->
				<?php
	// echo "number of rows".mysqli_num_rows($res);
	// echo "all records".mysqli_free_result($res);
				if(mysqli_num_rows($res)>0)
				{
					while($row=mysqli_fetch_array($res))//array output can be store in variable row
					{
						?>

						<div class="form-group" style="font-size: 20px">
							<input type="hidden" name="question<?php echo $num;?>" value="<?php echo $row['question_id'] ?>">
							<div>
									<!-- <label><?php echo $num;?>.</label>	 -->
									<p class="form-control-plain-text"><?php echo $num .' . '. $row['question']; ?></p>
							</div>
								
							<div class="form-check">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" id="answer<? each $num?>" name="answer<?php echo $num;?>" value="<?php echo $row['option1']?>" >
									<?php echo $row['option1'] ?>
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="answer<?php echo $num;?>" value="<?php echo $row['option2']?>">
									<?php echo $row['option2'] ?>
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="answer<?php echo $num;?>" value="<?php echo $row['option3']?>">
									<?php echo $row['option3'] ?>
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="answer<?php echo $num;?>" value="<?php echo $row['option4']?>">
									<?php echo $row['option4'] ?>
								</label>
							</div>

							<span id="question<?php echo $num ?>"></span>	
						</div>
						


						 <?php
						 $num++;
					}
				}
				?>
			<input type="hidden" id="tot_question" name="max" value=<?php echo $num-1; ?>>	
			</form>
			</div>
			<div class="card-footer">
				<button class="btn btn-danger mr-2" onclick="res()">
					Reset
				</button>
				<button class="btn btn-primary" id="submit" onclick="return save()">
					Submit
				</button>
			</div>
		</div>
	</div>
	<input type="hidden" name="exam_id" value="<?php echo $_SESSION['exam_id'] ?>">
	<script type="text/javascript" src="./assets/js/pg_js/user/question.js"></script>
	<script type="text/javascript" src="./assets/js/pg_js/user/index.js"></script>
</body>
</html>

