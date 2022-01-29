<?php 
if(!isset($_SESSION)){
    session_start();
}
require 'company_database.php';
if (!isset($_SESSION['stu_username'])) {
	header("Location:student_login.php");
	exit();
}
 ?>
