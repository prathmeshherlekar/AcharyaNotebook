<?php 


$db = mysqli_connect('localhost', 'id13927816_prathmesh', 'lg4t9)Tjb*=ZFTWm', 'id13927816_acharya_notebook');



$errors=array();
$ok=array();
$usn_err=array();
if(isset($_POST['sub'])){
$email=$_POST['email'];
$masterpass=$_POST['mpass'];

$pass=$_POST['pass'];
$pass1=$_POST['pass1'];
if($pass!=$pass1){
	array_push($errors,"Passwords Not Matched");
}

$pass=md5($pass);
$user_check_query = "SELECT * FROM teachers WHERE teacher_email='$email' AND masterpass='$masterpass'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if (!$user) {
    array_push($errors, "Worng Email - MasterPassword Combination");
  }else{
  	if(count($errors)==0){
  	$que="UPDATE `teachers` SET `password`='$pass' WHERE teacher_email='$email'";
  	$result = mysqli_query($db, $que);
  	if($result){
  		array_push($ok,"Password Sucessfully Updated");
  	}else{
  		array_push($ok,"Something Went Wrong");
  	}
  	}
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Acharya Notebook Teachers Login</title>
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
              	<center>For Teachers</center>
              </div>
              <br>
              <h4>Forget Password?</h4>
              <h6 class="font-weight-light">Varify Your Identity</h6>
              <?php include('ok.php')?>
              <form class="pt-3" method="post" action="forgetPasswordteacher.php" >
              
                <?php include('error.php');
                	
                ?>
                <div class="form-group">
                <label>Email</label>
                  <input type="text" name="email" class="form-control form-control-lg" id="email" name="email"  placeholder="Email">
                </div>
                <div class="form-group">
                <label>Master Password</label>
                  <input type="password"  class="form-control form-control-lg" id="mpass" name="mpass"  placeholder="Master Password">
                </div>
                <div class="form-group">
                <label>New Password</label>
                  <input type="password"  class="form-control form-control-lg" id="pass" name="pass"  placeholder="Master Password">
                </div>
                <div class="form-group">
                <label>Confirm Password</label>
                  <input type="password"  class="form-control form-control-lg" id="pass" name="pass1"  placeholder="Confirm Password">
                </div>
                <div class="mt-3">
                
                  <input type="submit" name="sub" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" >
                </div>
                
                
                
                
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="teachersregister.php" class="text-primary">Create</a><br>
                  
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
