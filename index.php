<?php 
  session_start(); 

  if (!isset($_SESSION['usn'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: studentlogin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['usn']);
    header("location: studentlogin.php");
  }
  $usn=$_SESSION['usn'];
  $db = mysqli_connect('localhost', 'id13927816_prathmesh', 'lg4t9)Tjb*=ZFTWm', 'id13927816_acharya_notebook');
  $qname="SELECT student_name,student_department FROM students where student_usn='$usn'";
  
  $resname = mysqli_query($db, $qname);
  $namerow = mysqli_fetch_assoc($resname);
  $name=$namerow['student_name'];
  $dep=$namerow['student_department'];

  $querypend="SELECT count(*) FROM assignment where assignment_id not in (select assignment_id from submitted where student_usn='$usn') and sem =(select student_sem from students where student_usn='$usn') and department='$dep'";

  $querycom="SELECT count(*) FROM assignment where assignment_id in (select assignment_id from submitted where student_usn='$usn') and sem=(select student_sem from students where student_usn='$usn') and department='$dep'";

  $queryall="SELECT count(*) FROM assignment where sem=(select student_sem from students where student_usn='$usn') and department='$dep'";

  $resall = mysqli_query($db, $queryall);
  $row2 = mysqli_fetch_assoc($resall);
  $all=$row2['count(*)'];


  $result = mysqli_query($db, $querypend);
  $row1 = mysqli_fetch_assoc($result);
  $pending=$row1['count(*)'];

  $rescom=mysqli_query($db, $querycom);
  $row = mysqli_fetch_assoc($rescom);
  $com=$row['count(*)'];

  


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags --> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Acharya Notebook</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css"/>
  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />






</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php"><img  src="images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logo-mini.png" alt="logo"/></a>
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
              <a href="/pages/student/studentprofile.php"class="dropdown-item preview-item">               
                  <i class="icon-head"></i> Profile
              </a>
              <a class="dropdown-item preview-item" href="index.php?logout='1'">
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
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="pages/student/submitassignment.php">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Submit Assignment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/student/pendingassignments.php">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">Pending Assignment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/student/completedassignments.php">
              <i class="icon-check menu-icon"></i>
              <span class="menu-title">Completed <br>Assignments</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/student/allassignments.php">
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
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">Hi,<?php echo $name; ?> welcome back!</h4>
              <p class="font-weight-normal mb-2 text-muted"><?php echo date("M d, Y")?></p>
            </div>
          </div>
          <div class="row mt-4">
            
            <div class="col-sm-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 <h4 class="card-title">Pending Assignments</h4>
                  <p><a href="/pages/student/pendingassignments.php">View Pending Assignments</a></p>
                  <h1 class="text-dark font-weight-bold mb-2"><center><?php echo $pending; ?> </center></h1>
                </div>
              </div>
            </div>
            <div class="col-sm-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Completed Assignments</h4>
                  <p><a href="/pages/student/completedassignments.php">View Completed Assignments</a></p>
                  <h1 class="text-dark font-weight-bold mb-2"><center><?php echo $com; ?></h1>
                </div>
              </div>
            </div>
            <div class="col-sm-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Assignments</h4>
                  <p><a href="/pages/student/allassignments.php">View All Assignments</a></p>
                  <h1 class="text-dark font-weight-bold mb-2"><center><?php echo $all; ?></h1>
                </div>
              </div>
            </div>
          </div>            
          </div>
        </div>
            
        </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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
  <script src="vendors/base/vendor.bundle.base.js"></script>
  
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

