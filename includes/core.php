<?php 

require_once("connection.php");


function clean($string)
{
	$string = trim($string);
	$string = strip_tags($string);
	$string = htmlspecialchars($string);
	global $db;
	$string = mysqli_escape_string($db,$string);
	return $string;

}

function adminProfile($name,$uname,$email,$password,$role)
{
	$sql = " INSERT INTO profile(id,name,uname,email,password,role,updated) 
	VALUES(NULL,'$name','$uname','$email','$password','$role', CURRENT_TIMESTAMP)";
	global $db;
	//$query->query($db);
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));
	return $query;
}

function get_all_admin()
{
	$sql  = "SELECT * FROM profile ORDER BY updated DESC";
	global $db;
	$query = mysqli_query($db, $sql) or die(mysqli_error($db));
	$array = array();
	while ($result = mysqli_fetch_assoc($query)) 
	{
	    $array[] = $result;
	}
	return $array;
}

function number_admin(){
	$sql = "SELECT id FROM profile ORDER BY id ";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));
	$row = mysqli_num_rows($query);
	return $row;

}

function add_about($title,$subtitle,$description,$link)
{
	$sql = " INSERT INTO about(id,title,subtitle,description,link,updated) VALUES(NULL,'$title','$subtitle','$description','$link',CURRENT_TIMESTAMP) ";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));
	return $query;
}
function get_about(){
	$sql = " SELECT * FROM about ";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));
	$array = array();
	while ($result = mysqli_fetch_assoc($query)) {
	    $array[] = $result;
	}
	return  $array;
}


function create_faculty($name,$designation,$description,$filename){
	$sql = " INSERT INTO faculty(id,name,designation,description,filename,create_date) VALUES(NULL,'$name','$designation','$description','$filename',CURRENT_TIMESTAMP) ";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));
	return $query;
}

function get_faculty()
{
	$sql =  "SELECT * FROM faculty ORDER BY id desc";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_errorr($db));
	$array = array();
	while ($result = mysqli_fetch_assoc($query)) {
	    $array [] = $result;
	}
	return  $array;
}





function edit_faculty()
{
	$sql = " SELECT * FROM faculty where id = '$id' ";
	global $db;
	$query = mysqli_query($db,$sql) or die(mysqli_error($db));
	return $query;
}


?> 