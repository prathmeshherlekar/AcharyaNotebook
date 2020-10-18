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
              <form method="post" action="studentregister.php">
                <h5 align='center' style="background-color:Tomato; color:white"><?php include('error.php');?></h5>
	              	<div class="form-group">
	                  <input type="text" class="form-control form-control-lg" name="usn"  placeholder="USN" required>
                  </div>
	                <div class="form-group">
	                  <input type="text" class="form-control form-control-lg" name="name"  placeholder="Name" required>
	                </div>
	                <div class="form-group">
	                  <input type="number" min=1 max=8 class="form-control form-control-lg" name="sem"  placeholder="Semester" required>
	                </div>
	                <div class="form-group">
	                  <input type="email" class="form-control form-control-lg" name="email"  placeholder="Email-ID" required>
	                </div>
	                <div class="form-group">
	                  <select class="form-control" name="dep">
	                  	<?php echo $options; ?>
	                  </select>
	                </div>
	                <div class="form-group">
	                  <input type="password" class="form-control form-control-lg" name="pass"  placeholder="Password" required>
	                </div>
	                <div class="form-group">
	                  <input type="password" class="form-control form-control-lg" name="pass1"  placeholder="Confirm Password" required>
	                </div>
	                  <div class="mt-3">
		                  <input type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" name="reg_user" >
		                </div>
				        <div class="text-center mt-4 font-weight-light">
				          Already have an account? <a href="studentlogin.php" class="text-primary" r>Login</a>
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
			
	








