<?php 

$dbServer = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "blogadmin";

$db =  mysqli_connect($dbServer,$dbUserName,$dbPassword,$dbName);

// if ($db->connect_errno) {
// 	echo "there is problem  in connecting to database, reasion:".$db->connect_errno;
// }else{
// 	echo "database is well connected. well done";
// }



?>