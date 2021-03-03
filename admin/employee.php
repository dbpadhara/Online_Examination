<!DOCTYPE html>
<html>
<head>
	<title>Online examination | Employee</title>
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
        <button id="add" data-toggle="modal" data-target="#add_form" type="button" class="btn btn-success btn-labeled btn-labeled-left btn-sm"><b><i class="icon-plus2"></i></b>Add Employee</button>
    </p>	
	        <div class="card">
	            <div class="card-header">
	            	<h4>Employee</h4>
	           	</div>

               	<div class="card-body">
                  <div class="table-responsive">
                     <table class="table" id="sample" >
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>EmpName</th>
                              <th>Role</th>
                              <th>UserName</th>
                              <th>Password</th>
                              <th>Email</th>
                              <th>MobileNumber</th>
                              <th>UserImage</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
<!--Insert form-->
<div class="modal fade bd-example-modal-lg"  id="add_form" tabindex="-1" role="dialog" aria-labelledby="formModal"
   aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Employee</h5>
            <button type="button" class="close" onclick="res()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="employee_form" autocomplete="off">
            	<input type="hidden" id="employee_id" name="id" value=0>
            	<input type="hidden" name="action" value="addEmployee">
               	<div class="row">	
	              	<div class="form-group col-md-6">
	                    <label>Username</label>
	                    <input type="text" class="form-control" id="username" name="username" placeholder="enter username">
	              	</div>
	              	<div class="form-group col-md-6 float-left">
	                    <label >Password</label>
	                    <input type="text" class="form-control" name="password" id="password" placeholder="enter password">
	              	</div>
	            </div>
	            <div class="row">  	
	              	<div class="form-group col-md-6">
	                    <label>Employee Name</label>
	                    <input type="text" name="empname" id="employee_name" class="form-control" placeholder="enter Employee name">
	      		  	</div>
	            	<div class="form-group col-md-6 float-left">
	                    <label>Email</label>
	                    <input type="email" name="email" class="form-control" id="emp_email" placeholder="enter email">
	          		</div>
          		</div>
          		<div class="row">
	                <div class="form-group col-md-6">
	                    <label >Mobile No</label>
	                    <input type="number" name="mobile_number" class="form-control" placeholder="enter mobile number">
	                </div>
	            	<div class="form-group col-md-6 float-left">
                        <label >Select Role </label> 
                        <select name="role" id="role_id" class="form-control role"></select>
	                </div>
	            </div>
                <div class="form-group">
                    <label>profile Image*</label><a onclick="remo()"> remove File &times;</a>
                    <input type="file" name="profile" id="profile_image" onchange="document.getElementById('view').src = window.URL.createObjectURL(this.files[0])">
              		<img id="view" alt="your image" width="100" height="100" />
              		<span id="uimage"></span>
                </div>
                  	
                  <div class="">
                  		<button type="button" onclick="res()" class="btn btn-danger">close</button>
            			<button type="button" onclick="return save()" id="submit" class="btn btn-success float-right">submit</button>
                  </div>
            </form>
            
          </div>
      </div>
   </div>
</div>

<script src="../assets/js/pg_js/admin/employee.js"></script>

	<?php
		include_once './static/footer.php'
	?>

</body>
</html>