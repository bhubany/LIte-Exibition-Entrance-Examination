<?php 
if(!isset($_SESSION)){
    session_start();
}
require 'admin_db.php';
if (!isset($_SESSION['company_username'])) {
	header("Location:index.php");
	exit();
}
 ?>
