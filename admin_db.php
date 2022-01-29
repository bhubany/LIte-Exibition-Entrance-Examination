<?php 
// session_start();
# initializing variables
$host='localhost';
$user='root';
$password="";
$db="admin_database";
# connecting to the database
$con_admin=@mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}
 ?>