<?php 
  session_start(); 

  if (!isset($_SESSION['usn'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../../studentlogin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['usn']);
    header("location: /studentlogin.php");
  }

$usn="";
$query="";
$usn_err=array();
$usn=$_SESSION['usn'];
$ques="";
$ass_name="";
$sub="";


$con = mysqli_connect('localhost', 'id13927816_prathmesh', 'lg4t9)Tjb*=ZFTWm', 'id13927816_acharya_notebook');

$query="SELECT * FROM assignment where sem=(select student_sem from students where student_usn='$usn') and department=(select student_department from students where student_usn='$usn') and assignment_id not in(select assignment_id from submitted where student_usn='$usn')";

$res =  mysqli_query($con, $query);
$dd="";

$options="";
$question="";
$id="";
while($row = mysqli_fetch_array($res)){
    $options = $options."<option>$row[0]:$row[1]:$row[2]</option>";    
}

  
$id="";
$aid="";
if(isset($_POST['sel_ass'])){
    $_SESSION['id']=$id;
    $aid=$_SESSION['id'];
    $sel_ass=$_POST['sel_ass'];
	$id=explode(":",$sel_ass);
	$id=$id[0];
	$_SESSION['id']=$id;
  
	$ass_name=explode(":",$sel_ass);
	$ass_name=$ass_name[1];
	$sub=explode(":",$sel_ass);
	$sub=$sub[2];			
	$query="SELECT * FROM assignment where assignment_id='$id'";  
	$res =  mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($res);
	$dd=$row['due_date'];
	$dd=date("M d, Y",strtotime($dd));
	$ques=$row['questions'];
	
}

$errors=array();
$ok=array();

if(isset($_POST['sub'])){
    $aid=$_SESSION['id'];
	if(empty($_POST['sol'])){
		array_push($errors,"Solution Is required");
	}
	$date=date("Y/m/d");
  	$sol=$_POST['sol'];
  if(count($errors)==0){
  	$query="INSERT INTO submitted(student_usn,assignment_id,submitted_on,answers) VALUES('$usn','$aid','$date','$sol')";
  	$isok=mysqli_query($con, $query);
  	if($isok){
  		array_push($ok,"Assignment Sucessfully Submitted");
  		header('location:submitassignment.php');
  		unset($_SESSION['id']);
  		
  		
  	}else{
  		array_push($errors,"Something Went Wrong...");
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
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
              <?php include('error.php')?>
             <?php include('ok.php')?>
                <div class="card-body">
                  <h4 class="font-weight-bold text-dark">Which assignment you want to submit?</h4>
                  <form method="post" >
                  <div class="justify-content-between d-flex grid-margin">
                    
                    <select class="form-control col-8" value="<?php echo $sel_ass; ?>" name="sel_ass" id="selass">
                      <option>Select The Assignment you Want To Submit</option>
                      <?php echo $options;?>
                    </select>
                    
                    <input type="submit" name="load_que" class="btn btn-success btn-md" value="Load ">
                  
                  </div>
                  </form>
                  

                  <br>
                  <div class="grid-margin stretch-card">
                    Assignment Name:<?php echo $ass_name;?>
                    <br>
                  Subject:
                    <?php echo $sub;?>
                    <br>
                   Due Date: <?php echo $dd;?>
                   <br>
                    Today: <?php echo date("M d, Y");?>
                    
                  </div>
                 
                     
                             
                  
                  
                  <br><h5>Questions:</h5>
                  <h4 class="card-title"><?php echo $ques;?></h4>
                  <form action="submitassignment.php" method="post">
                  <p><textarea name="sol" value="<?php echo $sol; ?>" class="col-12 grid-margin stretch-card form-control" rows="30" cols="150" placeholder="Write your Solution Here..."></textarea></p>
                  <button type="submit" name="sub" class="btn btn-primary btn-icon-text">
                          <i class="mdi mdi-file-check btn-icon-prepend"></i>
                          Submit
                  </button>
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












