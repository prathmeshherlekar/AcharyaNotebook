<?php include('server.php')?>
<?php

$db = mysqli_connect('localhost', 'id13927816_prathmesh', 'lg4t9)Tjb*=ZFTWm', 'id13927816_acharya_notebook');
$query="SELECT department_name FROM department";
$res = mysqli_query($db, $query);
$options="";
while($row = mysqli_fetch_array($res)){

	$options=$options."<option>$row[0]</option>";
}



?>

<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Acharya Notebook Teacher Registration</title>
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
              <div class="brand-logo">
                <img src="../../images/logo-dark.png" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" action="teachersregister.php" method="post">
              	<?php include('error.php')?>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" name="name"  placeholder="Name">
                </div>
                <div class="form-group">
	                  <select class="form-control" name="dep">
	                  	<?php echo $options; ?>
	                  </select>
	                </div>
                <div class="form-group">
                  <input type="text" name="con"  class="form-control form-control-lg" id="con" placeholder="Contact">
                </div>
                <div class="form-group">
                  <input type="email" name="email"  class="form-control form-control-lg" id="email" placeholder="Email ID">
                </div>
                 <div class="form-group">
                  <input type="password" name="pass"  class="form-control form-control-lg" id="pass" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" name="pass1"  class="form-control form-control-lg" id="pass1" placeholder="Confirm Password">
                </div>
                <div class="mt-3">
                  <input type="submit" name="reg_tec" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" >
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="teacherslogin.php" class="text-primary">Login</a>
                </div>
              </form>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</body>
</html>
			
	








