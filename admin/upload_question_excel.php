<!DOCTYPE html>
<html>
<head>
	<title>Upload Question</title>
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
		<div class="row">
	   		<div class="col">
	   			<label><?php echo $_SESSION["examid"]; ?></label>
	   		</div>
	   	</div>  

    	<div class="card-body">
    		<div class="row">
    			<div class="col">
    				<div class="form-group">
    					<label>Exam title</label>
    					<input type="text" readonly="readonly" class="form-control" name="exam_title">
    				</div>
    			</div>
    			<div class="col">
    				<div class="form-group">
    					<label>Total Question</label>
    					<input type="text" readonly="readonly" class="form-control" name="total_question">
    				</div>
    			</div>
    			<div class="col">
    				<div class="form-group">
    					<label>Remaining Question</label>
    					<input type="text" readonly="readonly" class="form-control" name="remaining">
    				</div>
    			</div>
    		</div>

			<form id="excel_form" autocomplete="off">
			 	<input type="hidden" id="examid" name="examid" value=<?php echo $_SESSION['examid'];?> >
			 	<input type="hidden" name="action" value="addExcel">
				<div class="row">    
				    <div class="col">
			           	<label>select the File</label><a onclick="remo()"> remove File &times;</a>
			           	<input type="file" class="form-control" name="question_file" id="question_file">
				    </div>
				    <div class="col mt-4">
				       	<button class="btn btn-success"  type="button" onclick="return saveExcel()">submit</button>
				       	<button class="btn btn-warning" type="button" onclick="remo()">reset</button>
				    </div>
				    <div class="col">
<!-- 				    	<label>uploaded file path</label>
				    	<input type="text" value="../assets/uploads/exam_file/php.xlsx" class="form-control" readonly="readonly" name="filepath"> -->
				    </div>
		     	</div>
		   	</form>
		   		<!-- path set of file -->
		   	<input type="hidden" name="path" value="">
			<div class="row">
				<div class="form-group mt-3 col-md-2">
					<button class="btn btn-primary" disabled="disabled" onclick="read_excel()" id="read_file_btn" type="button">Read File</button>	
				</div>
				<div class="col-md-2 mt-3">
					<button id="submit_question" disabled="disabled" class="btn btn-primary" type="button" onclick="save()">Add Question</button>
	       		</div>
			</div>
			<form id="question_form">
				<input type="hidden" id="question_id" name="id" value=0>
	         	<input type="hidden" name="exam_id" value=<?php echo $_SESSION['examid'];?>>
	         	<input type="hidden" name="action" value="addQuestion">	
		       	<div class="table-responsive">
		           	<table class="table" id="sample">
		             	<thead>
			                <tr>
		                    	<th>No.</th>	
		                        <th>Question</th>
		                        <th>Option1</th>
		                        <th>Option2</th>
		                        <th>Option3</th>
		                        <th>Option4</th>
		                        <th>Answer</th>
		                        <th>Action</th>
		                    </tr>
		             	</thead>
		             	
		             		
				            <tbody id="add_row">
					                 
						  	</tbody>
				  	 	
				  	 	
		           	</table>
		           	</form>
		        </div>
	  	</div>
	</div>

	

	<script type="text/javascript" src="../assets/js/pg_js/admin/upload_question_excel.js"></script>           
	<?php
		include_once './static/footer.php'
	?>
</body>
</html>