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

function adminProfile($name,$uname,$email,$password)
{
	$sql = " INSERT INTO profile(id,name,uname,email,password,updated) 
	VALUES(NULL,'$name','$uname','$email','$password',CURRENT_TIMESTAMP)";
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


?>