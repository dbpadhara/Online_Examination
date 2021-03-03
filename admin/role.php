<!DOCTYPE html>
<html>
<head>
	<title>Online Examination | Role</title>
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
        <button id="add" data-toggle="modal" data-target="#add_form" type="button" class="btn btn-success btn-labeled btn-labeled-left btn-sm"><b><i class="icon-plus2"></i></b>Add Role</button>
    </p>
 	<div class="card">   
        <div class="card-header header-elements-inline">
        	<h5 class="card-title">Role</h5>
        </div>
        <div class="card-body">
		       <div class="table-responsive">
		           <table class="table" id="sample">
		             <thead>
		               <tr>
		                 <th>No</th>
		                 <th>Role name</th>
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
         <h5 class="modal-title" id="formModal">Role</h5>
         <button class="close" onclick="res()" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <form id="role_form" autocomplete="off">
         	<input type="hidden" name="action" value="addRole">
         	<input type="hidden" id="role_id" name="id" value=0>
               	<div class="form-group">
	               	<label>Role name</label>
	               	<input type="text" class="form-control" name="role_name" id="role_name" placeholder="enter role name">
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

 <script src="../assets/js/pg_js/admin/role.js"></script>
 
	<?php
		include_once './static/footer.php'
	?>
</body>
</html>