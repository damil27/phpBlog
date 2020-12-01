<?php 
require_once("core.php");
require "connection.php";

session_start();



if (isset($_POST['registerbtn'])) 
{
	
	$name = clean($_POST['name']);
	$uname = clean($_POST['uname']);
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	$role = clean($_POST['role']);


if ($password ===$cpassword) {

	$errorflag = true;
	if (!empty($name) && !empty($uname) && !empty($email) && !empty($password) && !empty($role) ) 
	{
		$errorflag = false;
		
	} else 
	{
		
		$_SESSION['note'] = "One or more input left blank.";
		header('location:../register.php');
	}
	

	if ($errorflag) {
		echo $_SESSION['note'];
		header('location: ../register.php');
		
	} else {


		if (adminProfile($name,$uname,$email,$password,$role)) {
				$_SESSION['success'] = "New admin successfully added";
			header('location:../register.php');
		} else {
			
			$_SESSION['note'] = "problem encounter,please try again";;
			header('location: ../register.php');
		}

		
	}
	
} else {
		$note = "Your password does not match,try again";
		$_SESSION['note'] = $note;
		header('location:../register.php');
	}
	



}

if (isset($_POST['update_btn'])) {
	$edit_name = clean($_POST['edit_name']);
	$edit_uname = clean($_POST['edit_uname']);
	$edit_email = clean($_POST['edit_email']);
	$edit_password = clean($_POST['edit_password']);
	$edit_role = clean($_POST['edit_role']);
	$id = $_POST['edit_id'];
	$sql = " UPDATE profile SET name ='$edit_name',uname ='$edit_uname', email = '$edit_email', password = '$edit_password', role ='$edit_role' WHERE id = '$id' ";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));

	$errorflag = true;
	if (!empty($edit_name) && !empty($edit_uname) && !empty($edit_email) && !empty($edit_password)) 
	{
		$errorflag = false;
	}else{
		$_SESSION['note'] = "one or more fill is/are empty";
		header('location: ../register.php');
	}

	if ($errorflag) {
		echo $_SESSION['note'];
		header('location:../register.php');
	}else{
		if ($query) 
		{
			$_SESSION['success'] = "you have successfully update admin";
			header('location: ../register.php');
		}else{
			$_SESSION['note'] = "Your data is not updated";
			header('location: ../register.php'); 
		}
	}
	


}


if (isset($_POST['delete_btn'])) {
	$id = $_POST['delete_id'];
	$sql = " DELETE FROM profile WHERE id = '$id' ";
	global $db;
	$query =mysqli_query($db,$sql) or die(mysqli_error($db));
	if ($query) {
		$_SESSION['success'] = "Your data was successfully delete from database";
		header('location:../register.php');
	
	}else{
		$_SESSION['note'] = "something went wrong, please try again";
		header('location: ../register.php');
	}
	
}


if (isset($_POST['login_btn'])) {
	$email = clean($_POST['email']);
	$password = clean($_POST['password']) ;


	$sql  = " SELECT * FROM profile where email ='$email'  AND password='$password' ";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));
	$userRole = mysqli_fetch_array($query);
	if ($userRole['role'] == 'Admin') {
		$_SESSION['username'] = $email;
		header('location:../index.php');
		
	}else if($userRole['role'] == 'User') {
		$_SESSION['username'] = $email;
		header('location:../../index.php');
	}
	else{
		$_SESSION['note'] = "invalid login details";
		header('location:../login.php');
	}

	
}

if (isset($_POST['logout_btn'])) {
	unset($_SESSION['username']);
	header('location:../login.php');
}





?>