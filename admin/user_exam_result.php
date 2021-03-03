<!DOCTYPE html>
<html>
<head>
	<title>Online Examination | Student result</title>
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
	<div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title">User Exam Answer</h5>
		</div>	
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="sample">
					<thead>
						<tr>
							<th>No</th>
							<th>User name</th>
							<th>Field</th>
							<th>semester</th>
							<th>Exam title</th>
							<th>Correct Answer</th>
							<th>Wrong Answer</th>
							<th>Total Question</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	

	<div class="modal fade" id="add_form" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
	   <div class="modal-dialog" role="document">
	     <div class="modal-content">
	       <div class="modal-header">
	         <h5 class="modal-title" id="formModal">User Answer</h5>
	         <button class="close" onclick="res()" aria-label="Close">
	           <span aria-hidden="true">&times;</span>
	         </button>
	       </div>
	       <div class="modal-body">
	         	<div class="table-responsive">
					<table class="table" id="sample1">
						<thead>
							<tr>
								<th>Question</th>
								<th>User Answer</th>
								<th>Correct Answer</th>
							</tr>
						</thead>
					</table>
				</div>
	       </div>
	     </div>
	   </div>
	 </div>

	<script type="text/javascript" src="../assets/js/pg_js/admin/user_exam_result.js"></script>
	<?php
		include_once './static/footer.php'
	?>
</body>
</html>