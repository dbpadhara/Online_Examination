<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<?php 
		include_once './static/js_and_css.php'
	?>
</head>
<body>
	<?php
		include_once './static/header.php';
	?>

	<?php
		include_once './static/sidebar.php';
	?>

	  <p>
            <button type="button" onclick="show()" class="btn btn-success btn-labeled btn-labeled-left btn-sm">
            	<b>
            		<i class="icon-plus2"></i>
            	</b>
            Add User
        	</button>
     </p>
     <div class="card">   
        <div class="card-header header-elements-inline">
        	<h5 class="card-title">User Details</h5>
        </div>
        <div class="card-body">
		       <div class="table-responsive">
		           <table class="table" id="sample">
		             <thead>
		               <tr>
		                 <th>No</th>
		                 <th>UserName</th>
		                 <th>Field name</th>
		                 <th>Semester</th>
		                 <th>Email</th>
		                 <th>Profile</th>
		                 <th>Status</th>
		                 <th class="action">Action</th>
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
	         <h5 class="modal-title" id="formModal">Field</h5>
	         <button class="close" onclick="res()" aria-label="Close">
	           <span aria-hidden="true">&times;</span>
	         </button>
	       </div>
	       <div class="modal-body">
	         <form id="user_registration" autocomplete="off">
	         	<input type="hidden" id="user_id" name="id" value=0>
	         	<input type="hidden" name="action" value="addUser">
	               <div class="form-group">
		               <label>user name</label>
		               <input type="text" class="form-control" name="username" id="field_name" placeholder="enter user name">
	               </div>
	               <div class="form-group">
		               <label>Field Name</label>
		               <select class="form-control" name="field" id="field_id">
                		</select>
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
		               <label>Email</label>
		               <input type="text" class="form-control" name="email" id="email" placeholder="enter email address">
	               </div>
	               <div class="form-group">
		               <label>Password</label>
		               <input type="text" class="form-control" name="password" id="password" placeholder="enter password">
	               </div>
	               <div class="form-group">
	                        <label >File*</label><a onclick="remo()"> remove File &times;</a>
	                        <input type="file" name="profile" id="profile_image" onchange="document.getElementById('view').src = window.URL.createObjectURL(this.files[0])">
		              		<img id="view" alt="your image" width="100" height="100" />
		              		<span id="uimage"></span>
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

<script type="text/javascript" src="../assets/js/pg_js/admin/user_registration.js"></script>
	<?php
		include_once './static/footer.php';
	?>

</body>
</html>