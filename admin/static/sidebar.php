<!-- page content -->
<div class="page-content">

		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
			<!-- Sidebar mobile toggler -->
				<div class="sidebar-mobile-toggler text-center">
					<a href="#" class="sidebar-mobile-main-toggle">
						<i class="icon-arrow-left8"></i>
					</a>
					Navigation
					<a href="#" class="sidebar-mobile-expand">
						<i class="icon-screen-full"></i>
						<i class="icon-screen-normal"></i>
					</a>
				</div>
				<!-- /sidebar mobile toggler -->
				<!-- Sidebar content -->
				<div class="sidebar-content">


					<!-- User menu -->
					<div class="sidebar-user">
						<div class="card-body">
							<div class="media">
								<div class="mr-3">
									
									<a href="#"><img src="../assets/uploads/employee/<?php echo $_SESSION['user_image'];?>" width="38" height="38" class="rounded-circle" alt=""></a>
								</div>

								<div class="media-body">
									<div class=" text-uppercase">
										<?php echo $_SESSION['emp_name']; ?>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="card card-sidebar-mobile">
						<ul class="nav nav-sidebar" data-nav-type="accordion">

							<!-- Main -->
							<?php
								if($_SESSION['role_id']==1)
								{
							?>
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link"><i class="fa fa-list"></i><span>Employee</span></a>

									<ul class="nav nav-group-sub" data-submenu-title="Layouts">
						                <li class="nav-item"><a class="nav-link" href="role.php">Role</a></li>
						                <li class="nav-item"><a class="nav-link" href="employee.php">Employee</a></li>
									</ul>
								</li>
							<?php
								}
							?>
							<li class="nav-item nav-item-submenu">
								<a href="#" class="nav-link"><i class="fa fa-list"></i> <span>Exam</span></a>

								<ul class="nav nav-group-sub" data-submenu-title="Layouts">
					                <li class="nav-item"><a class="nav-link" href="field.php">Field</a></li>
					                <li class="nav-item"><a class="nav-link" href="exam.php">Exam</a></li>
								</ul>
							</li>
							<li class="nav-item nav-item-submenu">
								<a href="#" class="nav-link"><i class="icon-copy"></i><span>User Registration</span></a>
								<ul class="nav nav-group-sub" data-submenu-title="Layouts">
									<li class="nav-item"><a class="nav-link" href="user_registration.php">User registration</a></li>
									<li class="nav-item"><a class="nav-link" href="user_exam_result.php">User Exam satus</a></li>
					               <!--  <li class="nav-item"><a class="nav-link" href="log.php">Log</a></li> -->
								 </ul>
							</li>

							
							
							<!-- /page kits -->

						</ul>
					</div>
					<!-- /main navigation -->
				</div>
				<!-- /sidebar content -->
			</div>
	<!-- Main content -->
			<div class="content-wrapper">
				<!-- content area -->
					<div class="content">
