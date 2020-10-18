<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../../teacherslogin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: /teacherslogin.php");
  }
  $db = mysqli_connect('localhost', 'id13927816_prathmesh', 'lg4t9)Tjb*=ZFTWm', 'id13927816_acharya_notebook');
  $email=$_SESSION['email'];
  $aid=$_GET['aid'];
  $usn=$_GET['usn'];
 $query="SELECT * from assignment where assignment_id='$aid'";
 $res =  mysqli_query($db, $query);
 $row = mysqli_fetch_array($res);
 $aname = $row['assignment_name'];
 $due_date = $row['due_date'];
 $due_date=date("M d, Y",strtotime($due_date));
 $sub=$row['assignment_subject'];
 $ques=$row['questions'];
 $query="SELECT student_name from students where student_usn='$usn'";
 $res =  mysqli_query($db, $query);
 $row = mysqli_fetch_array($res);
 $sname=$row['student_name'];
 $query="SELECT * from submitted where student_usn='$usn' and assignment_id='$aid'";
 $res =  mysqli_query($db, $query);
 $row = mysqli_fetch_array($res);
 $answer=$row['answers'];
 $date_sub=$row['submitted_on'];
 $date_sub=date("M d, Y",strtotime($date_sub));
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
        <a class="navbar-brand brand-logo" href="../../teacherindex.php"><img src="../../images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../../teacherindex.php"><img src="../../images/logo-mini.png" alt="logo"/></a>
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
              <a href="/pages/teacher/teacherprofile.php" class="dropdown-item preview-item">               
                  <i class="icon-head"></i> Profile
              </a>
              <a class="dropdown-item preview-item" href="/../../teacherindex.php?logout='1'">
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
            <a class="nav-link" href="../../teacherindex.php">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="newassignment.php">
              <i class="icon-square-plus menu-icon"></i>
              <span class="menu-title">New Assignment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/teacher/assignments.php">
              <i class="icon-clipboard menu-icon"></i>
              <span class="menu-title">Assignments</span>
            </a>
          </li>
         
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
        <h5 align='center' style="background-color:MediumSeaGreen; color:white"></h5>
          <div class="row">
            	<div class="col-md-12 grid-margin-lg-0 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Assignment Submitted By <?php echo $sname;?></h4>
                  <p class="card-description">
                   
                    Assignment Name : <?php echo $aname?><br>
                    Subject : <?php echo $sub; ?><br>
                    Today : <?php echo date("M d,Y"); ?><br>
                    Due Date : <?php echo $due_date; ?><br>
                    Date Submitted : <?php echo $date_sub; ?><br>                    
                    Questions : <?php echo $ques; ?>
                  </p>   
                  Submitted Answers:<br><br>
                  <strong>
                  <?php 
                  	echo $answer;
                  ?>
                  </strong>
                </div>
              </div>
            </div>
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
