<?php 
  session_start(); 

  if (!isset($_SESSION['usn'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../../studentlogin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['usn']);
    header("location: studentlogin.php");
  }
  $usn=$_SESSION['usn'];
  $db = mysqli_connect('localhost', 'id13927816_prathmesh', 'lg4t9)Tjb*=ZFTWm', 'id13927816_acharya_notebook');
  $query="SELECT * FROM students where student_usn='$usn'";
  
  $res = mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($res);
  $name=$row['student_name'];
  $email=$row['student_email'];
  $sem=$row['student_sem'];
  $mpass=$row['masterpass'];
$errors=array();
$usn_err=array();
$sucess="";
if(isset($_POST['update'])){
    
	$sem=$_POST['sem'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	if(empty($_POST['name'])){
		array_push($errors,"Name is Required");
	}
	if(empty($_POST['sem'])){
		array_push($errors,"Semester is Required");
	}
	if(empty($_POST['email'])){
		array_push($errors,"Email is Required");
	}
	$em=$_POST['email'];
	if($email!=$em){
		$query="SELECT student_email FROM students where student_email='$em' LIMIT 1";
		$res = mysqli_query($db, $query);
  		$row = mysqli_fetch_assoc($res);
  		if($_POST['email']===$row['student_email']){
  			array_push($errors,"Email Already Exists");
  		}		
	}
	
	if (count($errors) == 0){
	
		if(empty($_POST['pass'])){    	
			
			$query = "UPDATE students SET student_name='$name',student_sem='$sem',student_email='$em' where student_usn='$usn'";
			
		}else{
		
			$pass=$_POST['pass'];
			$pass=md5($pass);
			$query = "UPDATE students SET student_name = '$name',student_sem='$sem',student_email='$em',password='$pass' where student_usn='$usn'";
		}
		$su=mysqli_query($db, $query);		
		if($su){  
		$sucess="Updated Successfully";
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
  <title>Acharya Notebook</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
  
  <script>
  	function show() {
  	//document.write("clicked");
  		var x = document.getElementById("show");
  		
  		if (x.style.visibility=="hidden") {
    			x.style.visibility="visible";
    			document.getElementById("hs").innerHTML="Hide Password";
    			
  		} else {
    			x.style.visibility="hidden";
    			document.getElementById("hs").innerHTML="Show Password";
    			
    		}
  	}

  </script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="../../index.php"><img src="../../images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../../index.php"><img src="../../images/logo-mini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-flex mr-4 ">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Settings</p>
              <a href="/pages/student/studentprofile.php" class="dropdown-item preview-item">               
                  <i class="icon-head"></i> Profile
              </a>
              <a class="dropdown-item preview-item" href="/../../index.php?logout='1'">
                  <i class="icon-inbox"></i> Logout
              </a>
            </div>
          </li>
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../index.php">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="submitassignment.php">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Submit Assignment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pendingassignments.php">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">Pending Assignment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="completedassignments.php">
              <i class="icon-check menu-icon"></i>
              <span class="menu-title">Completed <br>Assignments</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="allassignments.php">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">All Assignments</span>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
        <h5 align='center' style="background-color:MediumSeaGreen; color:white"><?php echo $sucess;?></h5>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              
                <div class="card-body">
                <h5 align='center' style="background-color:Tomato; color:white"><?php include('error.php')?></h5>
                  <h4 >Profile</h4>
                  <div class="justify-content-between d-flex ">
                    
                    <div class="col-10">
                      <h5>Your Master Password :</h5><h5 style="visibility:hidden;" id="show"> <?php 
                      echo $mpass;                                      
                      ?></h5>
                    </div>
                    <div class="col-2">       
                     <p class="mb" id="hs">Show Password</p>     
                      <label class="toggle-switch toggle-switch-danger">
                        <input type="checkbox" onclick="show()">
                        <span class="toggle-slider round"></span>
                      </label>                      
                    </div>
                  </div>
                  <form class="forms-sample" action="studentprofile.php" method="post">
                    <div class="form-group">
                      <h4>USN : <?php echo $usn;?></h4>
                      
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" value="<?php echo $name;?>" class="form-control" id="usn" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label for="sem">Semester</label>
                      <input type="number" name="sem" max=8 min =1 class="form-control" id="sem" value="<?php echo $sem;?>" placeholder="Semester">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" value="<?php echo $email;?>" class="form-control" id="email" placeholder="Email">
                    </div>  
                    <div class="form-group">
                      <label for="pass">Password</label>
                      <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
                    </div>                    
                    <input type="submit" name="update" value="Update" class="btn btn-primary mr-2">
                    <a href="/index.php" class="btn btn-light">Cancel</a>
                  </form>
                </div>
            </div>
          </div>
        </div>
            
            
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://www.acharya.ac.in/" target="_blank" class="text-muted">Acharya Institute Of Technology</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="icon-heart"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
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
  <!-- plugin js for this page -->
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
