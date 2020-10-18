<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /teacherslogin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: /teacherslogin.php");
  }
  $db = mysqli_connect('localhost', 'id13927816_prathmesh', 'lg4t9)Tjb*=ZFTWm', 'id13927816_acharya_notebook');

$aname="";
$sub="";
$sem="";
$due_date="";
$ques="";

  $email=$_SESSION['email'];
  $query="SELECT teacher_id,teacher_department FROM teachers where teacher_email='$email'";
  $res =  mysqli_query($db, $query);
  $row = mysqli_fetch_array($res);
  $id=$row['teacher_id'];
  $dep=$row['teacher_department'];
   $options="";
  
  if(isset($_POST['loadass'])){
  	  $sem=$_POST['sem'];
  	  $_SESSION['sem']=$sem;
	  $query="SELECT * FROM assignment where teacher_id='$id' and department='$dep' and sem='$sem'" ;
	  $res =  mysqli_query($db, $query);
	  while($row = mysqli_fetch_array($res)){
	      $options = $options."<option>$row[0]:$row[1]:$row[2]</option>";
	  }
  }
  $td="";
  $tdu="";
  
  $td1u="";
  $td1s="";
 
  
  if(isset($_POST['load'])){
  	$sel_ass=$_POST['sel_ass'];
  	$sel=explode(":",$sel_ass);
  	$aid=$sel[0];
  	$aname=$sel[1];
  	$sub=$sel[2];
  	$sem=$_SESSION['sem'];
  	$query="SELECT * FROM assignment where assignment_id='$aid'";
  	$tr=array();
  	$result =  mysqli_query($db, $query);
  	$row = mysqli_fetch_array($result);
  	
  	$due_date=$row['due_date'];
  	$due_date=date("M d, Y",strtotime($due_date)) ;
  	$date_assigned=$row['date_assigned'];
  	$ques=$row['questions'];
  	
  	
  	
  	$query="SELECT student_usn,student_name FROM students where student_department='$dep' and student_sem='$sem'";
  	$tr=array();
  	$result1 =  mysqli_query($db, $query);
	while($row = mysqli_fetch_array($result1)){
		$td = $td."//$row[0]:$row[1]";
		$tdu=$tdu."//$row[0]";
	}
	$tr=explode("//",$td);
	$tru=explode("//",$tdu);
	
	$query="SELECT student_usn,submitted_on FROM submitted where assignment_id='$aid'";
  	$result2 =  mysqli_query($db, $query);
	while($row = mysqli_fetch_array($result2)){
		$td1u = $td1u."//$row[0]";
		$td1s=$td1s."//$row[1]";
	}
	$tr1u=explode("//",$td1u);
	$tr1s=explode("//",$td1s);
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
                  <h4 class="card-title">Assignments You Have Given to</h4>
                  <p class="card-description">
                    Semester 
                  </p>
                  <form action="assignments.php" method="POST">
                  <div class="justify-content-between d-flex grid-margin">
                    <select class="form-control col-2" name="sem" id="sem">
                    			<option>Semester</option>
                      			<option>1</option>
                      			<option>2</option>
                      			<option>3</option>
                      			<option>4</option>
                      			<option>5</option>
                      			<option>6</option>
                      			<option>7</option>
                      			<option>8</option>
                 
		    </select>
		    <input type="submit" name="loadass" class="btn btn-success btn-md" value="Load Assignments">
		    </div>
		    </form>
                    
                  
                  <div class="form-group row">
                    <div class="col">
                   	
                    <br>
                      <label>Select Assignment</label>
                      <div>
                      <form action="assignments.php" method="POST">
                      <div class="justify-content-between d-flex grid-margin">
                        <select class="form-control col-8" value="<?php echo $sel_ass; ?>" name="sel_ass" id="selass">
                        <?php 
                        	
                      			echo "<option>Select A Assignment</option>";
                      			echo $options; 
                      	?>
                    	</select>
                    	
                    	<input type="submit" name="load" class="btn btn-success btn-md" value="Load ">
                    	</div>
                    	
                    	</form>
                    	
                    	Assignment Name :<strong><?php echo $aname;?></strong><br>
                    	Subject :<strong><?php echo $sub; ?></strong><br>
                    	Semester :<strong><?php echo $sem; ?></strong><br>
                    	Due Date :<strong><?php  echo $due_date; ?></strong><br>
                    	Questions :<br><strong><?php  echo $ques; ?></strong>
                    	<?php
                    	if(isset($_POST['load'])){
                    	echo "<div class='table-responsive'>
                    	<table class='table table-striped'>
                        <thead>
                          <tr>
                            <th>
                              Student USN
                            </th>
                            <th>
                              Student Name
                            </th>
                             <th>
                              Submitted On
                            </th>
                            <th>
                              Status
                            </th>
                            <th>
                              View
                            </th>
                          </tr>
                        </thead>
                        <tbody>";
                    	
                    $rows = mysqli_num_rows($result1);
                     //$data = mysqli_fetch_array($result);
			
			
			$cols = 4; 
			$data=array();
			$cond=0;
			for($r=1;$r<=$rows;$r++){
				echo "<tr>";
					for($d=0;$d<=$cols;$d++){
						$data=explode(":",$tr[$r]);
						
						if($d==0||$d==1){
							echo "<td>".$data[$d]."</td>";				
						}else if($d==2){
							$i="";
							for($i=1;$i<count($tr1u);$i++){
								if($tru[$r]===$tr1u[$i]){
									$cond=1;
									break;
								}else{
									$cond=0;
								}
							}
							if($cond){
							
								echo "<td>".date("M d, Y",strtotime($tr1s[$i]))."</td>";
							}else{
								echo "<td> - </td>";
							}
						}else if($d==3){
							if($cond){
								echo "<td> Submitted </td>";
							}else{
								echo "<td> Not Submitted </td>";
							}
						}else{
							if($cond){
								echo "<td><a href='viewassignment.php?usn=$data[0]&aid=$aid'>View Assignment</a></td>";
							}else{
								echo "<td> - </td>";
							}
						
						}
					}
				echo "</tr>";
			}
			
			
    			
    			
    
                        echo "</tbody>";
                    	}
                        ?>
                       
                        </table>
                        </div>
                      </div>
                    </div>                    
                  </div>
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
