<?php 
require_once("core.php");

session_start();

if (isset($_POST['registerbtn'])) 
{
	
	$name = clean($_POST['name']);
	$uname = clean($_POST['uname']);
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
$cpassword = clean($_POST['cpassword']);

if ($password ===$cpassword) {

	$errorflag = true;
	if (!empty($name) && !empty($uname)&& !empty($email) && !empty($password) ) 
	{
		$errorflag = false;
		
	} else 
	{
		
		$_SESSION['note'] = "One or more input left blank.";
		header('location:../register.php');
	}
	

	if ($errorflag) {
		echo $_SESSION['note'];
		header('location:../register.php');
		
	} else {


		if (adminProfile($name,$uname,$email,$password)) {
				$_SESSION['success'] = "New admin successfully added";
			header('location:../index.php');
		} else {
			
			$_SESSION['note'] = "problem encounter,please try again";;
			header('location:../register.php');
		}

		
	}
	
} else {
		$note = "Your password does not match,try again";
		$_SESSION['note'] = $note;
		header('location:../register.php');
	}
	





}





?>