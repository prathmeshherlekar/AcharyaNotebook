<?php 

$db = mysqli_connect('localhost', 'id13927816_prathmesh', 'lg4t9)Tjb*=ZFTWm', 'id13927816_acharya_notebook');

$usn_err = array();
$errors=array();
$usn_val="/1([A-Z]{2})([1-9]{2})([A-Z]{3})([0-9]{2})/";

if (isset($_POST['reg_user'])) {
	
	$name = $_POST["name"];
	$usn = $_POST["usn"];
	$sem = $_POST["sem"];
	$email = $_POST["email"];
	$dep = $_POST["dep"];
	$pass = $_POST["pass"];
    $pass1 = $_POST["pass1"];
   // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($usn)) { array_push($usn_err, "USN is required"); }
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($sem)) { array_push($errors, "Semester is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($dep)) { array_push($errors, "Department is required"); }
  if (empty($pass)) { array_push($errors, "Password is required"); }
  if (empty($pass1)) { array_push($errors, "Password is required"); }
  if ($pass!=$pass1){
    array_push($errors, "Passwords Not Matched");
  }
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email

  if(!preg_match($usn_val, $usn)){
    array_push($usn_err, "Invalid USN");    
  }

  $user_check_query = "SELECT * FROM students WHERE student_usn='$usn' OR student_email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['student_usn'] === $usn) {
      array_push($errors, "USN already exists");
    }

    if ($user['student_email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }
    
    $masterPass="";
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 20; $i++) {
        $n = rand(0, $alphaLength);
        $pass[$i] = $alphabet[$n];
    }
    return implode($pass); 
}
$masterpass=randomPassword();
$masterpass=md5($masterpass);





  // Finally, register user if there are no errors in the form
 	if (count($errors) == 0 && count($usn_err) == 0){
    		$password=md5($pass);
		$query = "INSERT INTO students (student_usn, student_name, student_sem,student_email,student_department,password,masterpass) VALUES('$usn', '$name','$sem','$email','$dep','$password','$masterpass')";
		$su=mysqli_query($db, $query);	
		if($su){	  
        		header('location: studentlogin.php');
        	}else{
        		array_push($errors,"Something Went wrong");
        	}
	}
}

// LOGIN USER

if (isset($_POST['login_user'])) {
  //$db = mysqli_connect('localhost', 'prathmesh', 'pass@prathmesh', 'acharya_notebook');
  $usn = $_POST['usn'];
  $pass =$_POST['pass'];

  if (empty($usn)) {
    array_push($errors, "USN is required");
  }
  if (empty($pass)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $pass = md5($pass);
    $query = "SELECT * FROM students WHERE student_usn='$usn' AND password='$pass'";
    $results = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($results);
    
    if (mysqli_num_rows($results) == 1) {
      session_start();
      $_SESSION['usn'] = $usn;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}











//Teachers Register

if (isset($_POST['reg_tec'])) {
  
  $name = $_POST["name"];
  $sub = $_POST["dep"];
  $con = $_POST["con"];
  $email = $_POST["email"];
  $pass = $_POST["pass"];
  $pass1 = $_POST["pass1"];
  $errors=array();
   // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($con)) { array_push($errors, "Contact is required"); }
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($sub)) { array_push($errors, "Department is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($pass)) { array_push($errors, "Password is required"); }
  if (empty($pass1)) { array_push($errors, "Please Confirm Your Password"); }
  if($pass!=$pass1){
      array_push($errors, "Passwords Not matched");
  }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email

  $user_check_query = "SELECT * FROM teachers WHERE teacher_email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['teacher_email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

$masterPass="";
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 20; $i++) {
        $n = rand(0, $alphaLength);
        $pass[$i] = $alphabet[$n];
    }
    return implode($pass); 
}
$masterpass=randomPassword();
$masterpass=md5($masterpass);


  // Finally, register user if there are no errors in the form
  if (count($errors) == 0){
    $password=md5($pass);
    $query = "INSERT INTO teachers (teacher_name, teacher_department, teacher_contact,teacher_email,password,masterpass) VALUES('$name', '$sub','$con','$email','$password','$masterpass')";
        mysqli_query($db, $query);      
        header('location: teacherslogin.php');
  }
}

//Teacher Login

if (isset($_POST['login_tec'])) {
  //$db = mysqli_connect('localhost', 'prathmesh', 'pass@prathmesh', 'acharya_notebook');
  $email = $_POST['email'];
  $pass =$_POST['pass'];

  if (empty($email)) {
    array_push($errors, "USN is required");
  }
  if (empty($pass)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $pass = md5($pass);
    $query = "SELECT * FROM teachers WHERE teacher_email='$email' AND password='$pass'";
    $results = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($results);
    
    if (mysqli_num_rows($results) == 1) {
      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['success'] = "You are now logged in";
      header('location: teacherindex.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}




















?>








