	<?php
	session_start();


	if ($_SESSION['user_name']==null) {
		header("Location:login.php");
	}
	?>
	
	<div class="navbar navbar-expand-lg navbar-dark w-100 " style="height: 45px;">
			<div class="col">
				<h3 class="mt-1">Online Exanination </h3>
			</div>
			<div>
				<a class="nav-link text-white" href="#" onclick="logout()">Logout</a>
			</div>
		</div>
	
	<div class="container-fluid card" style="">
		<div class="">
			<div class="row mt-1">

			  	<div class="col border-right">
			  		<div class="ml-4">
			    		<video id="video" width="260" height="199" autoplay></video>
			  		</div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="row">
			  			<div class="col">
			  				<div>
			  					<label>Name :</label><h3><?php echo $_SESSION['user_name'];//." ID :".$_SESSION['user_id'] ?></h3>	
			  				</div>
			  				<div>
			  					<label>User id :</label><h3><?php echo $_SESSION['user_id'];?></h3>	
			  				</div>
			  			</div>
			  			<div class="col">
			  				<div>
			  					<label>Field :</label><h3><?php echo $_SESSION['field_name']?></h3>	
			  				</div>
			  				<div>
			  					<label>Semester :</label><h3>2</h3>	
			  				</div>
			  			</div>
			  		</div>
			  			
			  	</div>
				<div class="col">
			  		<canvas id="canvas" style="border-radius: 10px" width="260" height="199"></canvas>
				</div>
			</div>
		</div>		
	</div>
	<input type="hidden" name="user_name" value="<?php echo $_SESSION['user_name']?>">
	<script type="text/javascript" src="./assets/js/pg_js/web_cam.js"></script>