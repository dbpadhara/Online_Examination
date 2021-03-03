<div class="navbar navbar-expand-md navbar-dark" onpageshow="if (event.persisted) noBack();">
			<div class="navbar-brand">
			</div>

			<div class="d-md-none">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
					<i class="icon-tree5"></i>
				</button>
				<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
					<i class="icon-paragraph-justify3"></i>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="navbar-mobile">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
							<i class="icon-paragraph-justify3"></i>
						</a>
					</li>
				</ul>
				<span class="ml-md-3 mr-md-auto"></span>
				<ul class="navbar-nav">
					<?php
						session_start();

						if($_SESSION['emp_name']==null){
							header("location:login.php");
						}
					?>					

					 <li class="nav-item dropdown dropdown-user">
						<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
							 <img src="../assets/uploads/employee/<?php echo $_SESSION['user_image'];?>" class="rounded-circle mr-2" width="34" height="34" alt="image"> 
							<span class="text-uppercase"><?php echo $_SESSION['emp_name']; ?></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a href="profile.php" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
							<a onclick="logout();" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
						</div>
					</li> 
				</ul>
			</div>
		</div>