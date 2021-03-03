<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registration</title>

  <!-- Global stylesheets -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="./assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
  <link href="./assets/css/iconmoon/styles.css" rel="stylesheet" type="text/css">

  <link href="./assets/css/layout.min.css" rel="stylesheet" type="text/css">

  <link href="./assets/css/colors.min.css" rel="stylesheet" type="text/css">
  <!-- /global stylesheets -->

  <!-- Core JS files -->
  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/bootstrap.bundle.min.js"></script>
  <!-- /core JS files -->

  <!-- Theme JS files -->
  <script src="./assets/js/app.js"></script>

  <script src="assets/js/izitoast/js/iziToast.min.js"></script>
  <link href="assets/js/izitoast/css/iziToast.min.css" rel="stylesheet" type="text/css">
  
  



  <!-- /theme JS files -->
</head>

<body>

    

  <!-- Page content -->
  <div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

      <!-- Content area -->
      <div class="content d-flex justify-content-center align-items-center">

        <!-- Login form -->
        <form id="registration_form" class="login-form" autocomplete="off">

          <input type="hidden" name="action" value="user_registration">
          <input type="hidden" name="id" value="0">
          <div class="card mb-0">
            <div class="card-body">
              <div class="text-center mb-3">
                <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                <h3>User Registration</h3>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" name="username" class="form-control" value="dhruvin" placeholder="enter name">
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
                <span id="uname"></span>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <select class="form-control" id="field_id" name="field">
                </select>
                <div class="form-control-feedback">
                  <i class="icon-book text-muted"></i>
                </div>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <select class="form-control" name="semester">
                  <option value="">------ select semester ------</option>
                  <option value="1" selected="selected">semester-1</option>
                  <option value="2">semester-2</option>
                  <option value="3">semester-3</option>
                  <option value="4">semester-4</option>
                  <option value="5">semester-5</option>
                  <option value="6">semester-6</option>
                  <option value="7">semester-7</option>
                  <option value="8">semester-8</option>
                </select>
                <div class="form-control-feedback">
                  <i class="icon-book text-muted"></i>
                </div>
                <span id="semesters"></span>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" name="email" class="form-control" onblur="check_email()" value="db@11.com" placeholder="enter Email">
                <div class="form-control-feedback">
                  <i class="icon-mail5 text-muted"></i>
                </div>
                <span id="email"></span>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" name="password" class="form-control" value="dhruvin1012" placeholder="enter password">
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
                <span id="password1"></span>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" name="conf_password" class="form-control" value="dhruvin1012" placeholder="enter confirm password">
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
                <span id="confirm"></span>
              </div>
              <label>select profile image</label>
              <div class="form-group form-group-feedback form-group-feedback-left">

                <input type="file" id="profile_image" name="profile" class="form-control" placeholder="Password">
                <div class="form-control-feedback">
                  <i class="icon-image2 text-muted"></i>
                </div>
                <span id="profile"></span>
              </div>


              <div class="form-group">
                <button type="button" onclick="return save()" id="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
              </div>

            </div>
          </div>
        </form>
        <!-- /login form -->

      </div>
      <!-- /content area -->


      <!-- Footer -->
      <div class="navbar navbar-expand-lg navbar-light">
        <div class="text-center d-lg-none w-100">
          <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
          </button>
        </div>

      </div>
    </div>
    <!-- /main content -->

  </div>
  <!-- /page content -->
<script src="assets/js/pg_js/user/user_registration.js"></script>
<script src="assets/js/pg_js/index.js"></script>
</body>

</html>
