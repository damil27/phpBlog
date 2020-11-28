<?php 

include "connection.php";


if (isset($_POST['registerbtn'])) 
{

	$name = $_POST['name'];
	$uname  = $_POST['uname'];
	$email  = $_POST['email'];
	$password  = $_POST['password'];
	$cpassword  = $_POST['cpassword'];
	
	$query = "INSERT INTO profile(name,uname,email,password,updated)VALUES('$name','$uname','$password',CURRENT_TIMESTAMP)";
	$query_run = mysqli_query($connection,$query);

	if ($password === $cpassword) {
		if ($query_run) {
			$_SESSION['success'] = "admin profile is added";
			header('location:register.php');
		}else{
			$_SESSION['status'] = "Admin profile is NOT added";
			header('location:register.php');
		}
	}else{
		$_SESSION['status'] = "password did NOT match, please try again";
		header('location:register.php');
	}
}




?>