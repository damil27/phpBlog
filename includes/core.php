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



?>