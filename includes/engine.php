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

//  about page engine here
if (isset($_POST['about_btn'])) {

	$title = clean($_POST['title']);
	$subtitle = clean($_POST['subtitle']);
	$description = clean($_POST['description']);
	$link = clean($_POST['link']);



	if (!empty($title) && !empty($subtitle) && !empty($description) && !empty($link) ) {

		if (add_about($title,$subtitle,$description,$link)) {
			$_SESSION['success'] = "Your About content is added successfully";
			header('location:../about.php');
		}
		
	}
	else{
		$_SESSION['note'] ="one or more field left empty";
		header('location: ../about.php');
	}
}





if (isset($_POST['update_aboutbtn'])) {
	$editTitle = clean($_POST['editTitle']);
	$editSubtitle =clean($_POST['editSubtitle']);
	$editDescription =clean($_POST['editDescription']);
	$editLink = $_POST['editLink'];
	$id = $_POST['edit_id'];
	$sql = " UPDATE ABOUT set title = '$editTitle', subtitle = '$editSubtitle', description = '$editDescription', link = '$editLink' where id ='$id'  ";
	global $db;
	$query = mysqli_query($db,$sql)or die(mysqli_error($db)) ;
	if ($query) {
		$_SESSION['success'] = "Your data was successfully updated";
		header('location:../about.php');
	}else{
		$_SESSION['note'] = "Your Data is not yet updated";
		header('location:../about.php');
	}
}




if (isset($_POST['uploadbtn'])) 
{
	$name = clean($_POST['name']);
	$designation = clean($_POST['designation']);
	$description = clean($_POST['description']);
	$allowed = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
	$ext =exif_imagetype($_FILES['filename'] ['tmp_name']);
	if (!empty($name) && !empty($designation) && !empty($description)) 
	 {
	 	$filename = $_FILES['filename']['name'];
	 	$filepath = '../img/faculty/'.$filename ;
	 	$tmp = $_FILES['filename']['tmp_name'];
	 	move_uploaded_file($tmp, $filepath);
	 	if (in_array($ext, $allowed)) 
	 	{
	 		if (create_faculty($name,$designation,$description,$filename)) 
	 		{
	 			$_SESSION['success'] = "Faculty data successfully added";
	 			header('location:../faculty.php');
	 		}
	 		else
	 		{
	 			$_SESSION['note'] = "something went wrong, please try again";
	 			header('location:../faculty.php');
	 		}
	 	}
	 	else
	 	{
	 		$_SESSION['note'] = "invallid file type, only image is allowed";
	 		header('location:../faculty.php');
	 	}

	 } 
	 else
	 {
	 	$_SESSION['note'] = "one or more field is/are empty";
	 	header('location:../faculty.php');
	 }
}


if (isset($_POST['update_facultybtn'])) {
	$name = clean($_POST['edit_name']);
	$designation = clean($_POST['edit_designation']);
	$description = clean($_POST['edit_description']);
	
	$id = $_POST['edit_id'];
	
	$sql = " UPDATE faculty SET name = '$name', designation ='$designation', description = '$description' where id='$id' ";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));
	if ($query) {
		$_SESSION['success'] = "Data successfully updated";
		header('location:../faculty.php');

	}
	else{
		$_SESSION['note'] = " something went wrong, please try again ";
		header('location:../faculty.php');
	}
}



if (isset($_POST['faculty_delete'])) {
	
	$id = $_POST['fa_del_id'];
	$sql = " DELETE  FROM faculty where id='$id' ";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));
	if ($query) {
		$_SESSION['success'] = "data successully deleted from database";
		header('location:../faculty.php');
	}
	else{
		$_SESSION['note'] = "something went wrong ,please try again";
		header('location:../faculty.php');
	}
}


?>