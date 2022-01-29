<?php 
// $_SESSION['company_db']="";
	session_start();
	date_default_timezone_set('Asia/Kathmandu');
	require 'admin_db.php';
	// $_SESSION['company_db']="";
	$created_at=date('y-m-d h:i:s');
	$errors=array();
	$sucess=array();
	// print("Hello-1");

$_SESSION['company_db']="";


	$stu_login_name="";
	$stu_login_email="";
	$stu_login_contact="";
	$stu_login_address="";

		$log_uname="";
		$log_pwd="";
		$is_action_performed="";
		$log_id="";
		$active="";
	$stu_login_username="";
	// $log_remember="";
	// $log_robot="";
	
	if (isset($_POST['login_student'])) {
		// print("HELLO-2");
		$stu_login_username=stripslashes($_REQUEST['stu_login_username']);
		#escapes special characters in a string
		$stu_login_username=mysqli_real_escape_string($con_admin,$stu_login_username);
		$stu_uname=substr($stu_login_username,0,4);
		// echo $stu_uname;
		$query_check="SELECT * FROM company_details WHERE company_keywords='$stu_uname' ";
		// print($query_check);
		$result_check=mysqli_query($con_admin,$query_check) or die(mysqli_error($con_admin));
		while($rows=mysqli_fetch_assoc($result_check)) {
			$_SESSION['company_db']=$rows['company_db'];
			$_SESSION['check_status']=1;
			}
	require 'company_database.php';



// -----------------------LOGIN DETAILS------------------------

	// if (isset($_POST['login_student'])){
		# removes backslashes
		$stu_login_name=stripslashes($_REQUEST['stu_login_name']);
		#escapes special characters in a string
		$stu_login_name=mysqli_real_escape_string($con_company,$stu_login_name);

		$stu_login_email=stripslashes($_REQUEST['stu_login_email']);
		$stu_login_email=mysqli_real_escape_string($con_company,$stu_login_email);

		$stu_login_contact=stripslashes($_REQUEST['stu_login_contact']);
		#escapes special characters in a string
		$stu_login_contact=mysqli_real_escape_string($con_company,$stu_login_contact);

		$stu_login_address=stripslashes($_REQUEST['stu_login_address']);
		$stu_login_address=mysqli_real_escape_string($con_company,$stu_login_address);

		$stu_login_username=stripslashes($_REQUEST['stu_login_username']);
		#escapes special characters in a string
		$stu_login_username=mysqli_real_escape_string($con_company,$stu_login_username);

		$stu_login_pwd=stripslashes($_REQUEST['stu_login_pwd']);
		$stu_login_pwd=mysqli_real_escape_string($con_company,$stu_login_pwd);
		// $log_remember=stripslashes($_REQUEST['remember']);
		// if (isset($_POST['robot'])) {
		// $log_robot=1;
		// }
		// else{
		// 	$log_robot=0;
		// }
		// if (isset($_POST['remember'])) {
		// 	$log_rem=1;
		// }
		// else{
		// 	$log_rem=0;
		// }
	if (empty($stu_login_name)) 
		 {
    	array_push($errors, "Full name is required");
  		 }
  	if (empty($stu_login_email))
  		{
    	array_push($errors, "Email is required");
		}
	if (empty($stu_login_contact)) 
		 {
    	array_push($errors, "Contact no. is required");
  		 }
  	if (empty($stu_login_address))
  		{
    	array_push($errors, "Address is required");
		}
	if (empty($stu_login_username)) 
		 {
    	array_push($errors, "Username is required");
  		 }
  	if (empty($stu_login_pwd))
  		{
    	array_push($errors, "Password is required");
		}
	// if ($log_robot!=1)
 //  		{
 //    	array_push($errors, "Check I am not a Robot.");
	// 	}

		if (count($errors) == 0) {
		
		// $login_password = md5($log_password);
			$login_password=$stu_login_pwd;
		$query="SELECT * FROM student_details WHERE stu_username='$stu_login_username' AND stu_password='$login_password' ";
		$result=mysqli_query($con_company,$query) or die(mysqli_error($con_company));
		
	while($rows=mysqli_fetch_assoc($result)) {
			$log_uname=$rows['stu_username'];
			$log_pwd=$rows['stu_password'];
			$is_action_performed=$rows['is_action_performed'];
			$log_id=$rows['id'];
			$active=$rows['is_active'];
		}
		if ($log_uname===$stu_login_username and $login_password===$log_pwd) 
			{
				if ($active==1)
					{
						if ($is_action_performed==0) 
							{		
							// $_SESSION['active_status']=1;				
							$_SESSION['stu_username']=$log_uname;
							$_SESSION['stu_id']=$log_id;
							$_SESSION['stu_name']=$stu_login_name;
	 						#redirect to index.php
	 						$credintals_expire_qry=@"UPDATE student_details SET stu_name='$stu_login_name',stu_email='$stu_login_email
	 						',stu_telephone='$stu_login_contact',stu_address='$stu_login_address',is_active='0' WHERE id='$log_id' LIMIT 1";
	 						$credintals_expire_res=mysqli_query($con_company,$credintals_expire_qry) or die($con_company);
	 						if ($credintals_expire_res==1) {
									header("Location:exam_rules.php");
								}
							}
						else
							{
							// $_SESSION['active']=11;
							// $_SESSION['conf_email']=$log_eml;
							// header("Location:conform.php");
								array_push($errors, "Provided Credintals hasbeen expired. Pleace contact representitive institutions.");
							}
					}
				else
					{
					array_push($errors, "Wrong username/password combination");
					}
			}
		else
			{
			array_push($errors, "Wrong username/password combination");
			}
	}
}


 ?>





<?php include 'header.php' ; ?>
<?php include 'nav.html' ;?>

<head>
  <title>ONLINE ENTRANCE main page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assests/css/myStyle.css">
</head>

<div class="row">
	<div class="col-lg-2"></div>

	<div class="col-lg-8 myContainer">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<div class="myForm">
	  		<span class="myFormTitle"><h2>Students Login Forms</h2></span>
	  		<form action="" method="post">
	  			<?php include 'errors.php'; ?>
	  			<div class="form-group">
	      			<label for="full_name">Full Name:</label>
	      			<input type="text" class="form-control" id="full_name" placeholder="Enter your full name" name="stu_login_name" value="<?php echo($stu_login_name); ?>">
	    		</div>
	    		<div class="form-group">
	      			<label for="email">Email:</label>
	      			<input type="email" class="form-control" id="email" placeholder="eg:- someone@gmail.com" name="stu_login_email" value="<?php echo($stu_login_email); ?>">
	    		</div>
	    		<div class="form-group">
	      			<label for="tel">Contact No:</label>
	      			<input type="tel" class="form-control" id="tel" placeholder="98XXXXXXXX" name="stu_login_contact" value="<?php echo($stu_login_contact); ?>">
	    		</div>
	    		<div class="form-group">
	      			<label for="address">Address:</label>
	      			<input type="text" class="form-control" id="address" placeholder="Enter your Address" name="stu_login_address" value="<?php echo($stu_login_address); ?>">
	    		</div>
	    		<div class="form-group">
	      			<label for="username">Username:</label>
	      			<input type="text" class="form-control" id="username" placeholder="Enter username" name="stu_login_username">
	    		</div>
	    		<div class="form-group">
	      			<label for="pwd">Password:</label>
	      			<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="stu_login_pwd">
	    		</div>
	    		<button type="submit" class="btn btn-default myLoginBtn" name="login_student">Login</button>
	  		</form>
	  		</div>
  	</div>
  	<div class="col-lg-3"></div>
	</div>

	<div class="col-lg-2"></div>
</div>

<?php include 'footer.php'; ?>