<?php 
if(!isset($_SESSION)){
    session_start();
}
# initializing variables
$host='localhost';
$user='root';
$password="";
$db=$_SESSION['company_db'];
// echo $_SESSION['company_db'];
# connecting to the database
$con_company=@mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}
 ?>