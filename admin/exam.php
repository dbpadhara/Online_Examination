<!DOCTYPE html>
<html>
<head>
	<title>Exam</title>
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
	<p>
		<button class="btn btn-success btn-labeled btn-labeled-left btn-sm" onclick="show()">
			<b>
				<i class="icon-plus2"></i>
			</b>
			Add Exam
		</button>
	</p>
	<div class="card">   
        <div class="card-header header-elements-inline">
        	<h5 class="card-title">Exam</h5>
        </div>
        <div class="card-body">
		       <div class="table-responsive">
		           <table class="table" id="sample">
		             <thead>
		               <tr>
		                 <th>No</th>
		                 <th>Exam title</th>
		                 <th>Semester</th>
		                 <th>Field</th>
		                 <th>Total Question</th>
		                 <th>add Question</th>
		                 <th>Exam date</th>
		                 <th>Exam status</th>
		                 <th>Action</th>
		               </tr>
		             </thead>
		             <tbody>
			                 
				  	 </tbody>
		           </table>
		        </div>
		  </div>
	</div>

	 <div class="modal fade" id="add_form" tabindex="-1" role="dialog" aria-labelledby="formModal"
	   aria-hidden="true">
	   <div class="modal-dialog" role="document">
	     <div class="modal-content">
	       <div class="modal-header">
	         <h5 class="modal-title" id="formModal">Exam</h5>
	         <button class="close" onclick="res()" aria-label="Close">
	           <span aria-hidden="true">&times;</span>
	         </button>
	       </div>
	       <div class="modal-body">
	         <form id="exam_form" autocomplete="off">
	         	<input type="hidden" id="exam_id" name="id" value=0>
	         	<input type="hidden" name="action" value="addExam">
	               <div class="form-group">
		               <label>Exam Title</label>
		               <input type="text" class="form-control" name="exam_title" id="exam_title" placeholder="enter user name">
	               </div>
	               <div class="form-group">
		           		<label>Semester</label>
		           		<select class="form-control" name="semester" id="semester">
				          <option value="">------ select semester ------</option>
		                  <option value="1">semester-1</option>
		                  <option value="2">semester-2</option>
		                  <option value="3">semester-3</option>
		                  <option value="4">semester-4</option>
		                  <option value="5">semester-5</option>
		                  <option value="6">semester-6</option>
		                  <option value="7">semester-7</option>
		                  <option value="8">semester-8</option>
                		</select>
	               </div>
	               <div class="form-group">
		           		<label>Field Name</label>
		               	<select class="form-control" name="field" id="field_id">
                		</select>
	               </div>
	               
	               <div class="form-group">
		               <label>Total Question</label>
		               <input type="text" class="form-control" name="total_question" id="tot_question" placeholder="enter Number of Question">
	               </div>

	               <div class="form-group">
		               <label>Exam date</label>
		               <input type="date" class="form-control" name="exam_date" id="exam_date">
	               </div>

	              <div class="">
	               <button class="btn btn-success float-right" type="button" onclick="return save()" id="add" >Add</button>
	               <button class="btn btn-danger" type="button" onclick="res()">Cancel</button>
	             </div>
	             
	           </form>
	       </div>
	     </div>
	   </div>
	 </div>

	 

	<div class="modal fade" id="add_question" tabindex="-1" role="dialog" aria-labelledby="formModal"
	   aria-hidden="true">
	   <div class="modal-dialog modal-full" role="document">
	     <div class="modal-content">
	       <div class="modal-header">
	         <h5 class="modal-title" id="formModal">Question</h5>
	         <button class="close" onclick="res1()" aria-label="Close">
	           <span aria-hidden="true">&times;</span>
	         </button>
	       </div>
	       <div class="modal-body">
	         <form id="question_form" autocomplete="off">
	         	<input type="hidden" id="question_id" name="id" value=0>
	         	<input type="hidden" name="tot_question">
	         	<input type="hidden" name="exam_id">
	         	<input type="hidden" name="action" value="addQuestion">
	            <div class="row">
		            <div class="col">   
		               <div class="form-group">
			               <label>Total Question</label>
			               <input type="text" readonly="readonly" class="form-control" id="read_total_question">
		               </div>
		            </div>
		            <div class="col">
		            	<div class="form-group">
		            		<label>Exam title</label>
		            		<input type="text" readonly="readonly" class="form-control" name="read_title">
		            	</div>
		            </div>
		            <div class="col">
		            	<div class="form-group">
		            		<label>Enter Remaining question</label>
		            		<input type="text" readonly="readonly" class="form-control" name="remaining_question">
		            	</div>
		            </div>
	            </div>
	            <div class="row">
	            		<div class="col">
			            	<div class="form-group mt-4 ml-4">
				            	<button class="btn btn-primary" type="button" id="add_row_button" onclick="addRow()">
				            		Add ROW
				            	</button>
			            	</div>
			            	<span id="ad_row_btn"></span>
			            </div>
		            </div>
				<div class="row">
                    <table class="table">
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
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" onclick="return save1()" id="save_question" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btm-danger" onclick="res1()">Cancel</button>
        		</div>
                	             

		           <div class="row">
		           		<div class="table-responsive">
			           		<table class="table" id="sample1">
			           			<thead>
			           				<tr>
		                            	<th>No.</th>	
		                                <th>Question</th>
		                                <th>Option1</th>
		                                <th>Option2</th>
		                                <th>Option3</th>
		                                <th>Option4</th>
		                                <th>Answer</th>
		                                <th>Exam_id</th>
		                                <th>Action</th>
		                            </tr>
			           			</thead>
			           			<tbody>
			           				
			           			</tbody>	
			           		</table>
			           	</div>
		           </div>
	       </div>
	     </div>
	   </div>
	</div>


	<div class="modal fade" id="update_question" tabindex="-1" role="dialog" aria-labelledby="formModal"
	   aria-hidden="true">
	   <div class="modal-dialog" role="document">
	     <div class="modal-content">
	       <div class="modal-header">
	         <h5 class="modal-title" id="formModal">Update question</h5>
	         <button class="close" onclick="res()" aria-label="Close">
	           <span aria-hidden="true">&times;</span>
	         </button>
	       </div>
	       <div class="modal-body">
	         <form id="update_question_form" autocomplete="off">
	         	<input type="hidden" id="update_exam_id" name="update_exam_id" value=0>
	         	<input type="hidden" name="update_question_id" id="update_question_id">
	         	<input type="hidden" name="action" value="updateQuestion">
	               <div class="form-group">
		               <label>Question</label>
		               <input type="text" class="form-control" name="question" id="question" placeholder="enter Question_name">
	               </div>
	               <div class="form-group">
		           		<label>Option1</label>
		               <input type="text" class="form-control" name="option1" id="update_option1" placeholder="enter option1">
	               </div>
	               <div class="form-group">
		           		<label>Option2</label>
		               	<input class="form-control" name="option2" id="update_option2" placeholder="enter option2">
	               </div>
	               
	               <div class="form-group">
		               <label>Option3</label>
		               <input type="text" class="form-control" name="option3" id="update_update_option3" placeholder="enter option3">
	               </div>

	               <div class="form-group">
		               <label>Option4</label>
		               <input type="text" class="form-control" name="option4" id="update_option4" placeholder="enter option4">
	               </div>

	               <div class="form-group">
		               <label>Answer</label>
		               <input type="text" class="form-control" name="answer" id="answer" placeholder="enter answer">
	               </div>

	              <div class="">
	               <button class="btn btn-success float-right" type="button" onclick="return save2()" id="add2" >Add</button>
	               <button class="btn btn-danger" type="button" onclick="res2()">Cancel</button>
	             </div>
	             
	           </form>
	       </div>
	     </div>
	   </div>
	</div>
	 <script src="../assets/js/pg_js/admin/exam.js"></script>
	<?php
		include_once './static/footer.php'
	?>
</body>
</html>