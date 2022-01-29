<?php
if (isset($_POST['print_details'])) {
	$username=$_POST['stu_uname'];
	$password=$_POST['stu_pwd'];
}
include 'company_header.php';
echo "<div style='text-align:center'>USERNAME: ".$username."<br>"."PASSWORD: ".$password."</div>";
?>
<center><button onclick="window.print();" class="btn btn-primary">PRINT</button></center>