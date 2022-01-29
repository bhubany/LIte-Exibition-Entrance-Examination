<?php
session_start();
date_default_timezone_set('Asia/Kathmandu');
	require 'admin_db.php';
	$created_at=date('y-m-d h:i:s');
	$errors=array();
	$sucess=array();


// ----------------CHECKING IF ALREADY LOGIN---------------
	if (isset($_SESSION['company_username'])) {
		header("Location:company_profile.php");
	}
	else{



// -----------------------LOGIN DETAILS------------------------

	$log_username="";
	$log_uname="";
	$log_pwd="";
	$log_eml="";
	$log_email="";
	$log_remember="";
	$log_robot="";
	if (isset($_POST['log_company']))
	{
		# removes backslashes
		$log_username=stripslashes($_REQUEST['login_email']);
		#escapes special characters in a string
		$log_username=mysqli_real_escape_string($con_admin,$log_username);
		$log_password=stripslashes($_REQUEST['login_pwd']);
		$log_password=mysqli_real_escape_string($con_admin,$log_password);
		// $log_remember=stripslashes($_REQUEST['remember']);
		// if (isset($_POST['robot'])) {
		// $log_robot=1;
		// }
		// else{
		// 	$log_robot=0;
		// }
		if (isset($_POST['remember'])) {
			$log_rem=1;
		}
		else{
			$log_rem=0;
		}
	if (empty($log_username)) 
		 {
    	array_push($errors, "Username is required");
  		 }
  	if (empty($log_password))
  		{
    	array_push($errors, "Password is required");
		}
	// if ($log_robot!=1)
 //  		{
 //    	array_push($errors, "Check I am not a Robot.");
	// 	}

		if (count($errors) == 0) {
		
		$login_password = md5($log_password);
			// $login_password=$log_password;
		$query="SELECT * FROM company_details WHERE (company_username='$log_username' or company_email='$log_username') and company_password='$login_password' ";
		$result=mysqli_query($con_admin,$query) or die(mysqli_error($con_admin));
		
	while($rows=mysqli_fetch_assoc($result)) {
			$log_uname=$rows['company_username'];
			$log_pwd=$rows['company_password'];
			$log_eml=$rows['company_email'];
			$log_id=$rows['id'];
			$active=$rows['is_active'];
			$company_dv=$rows['company_db'];
			$company_keyword=$rows['company_keywords'];
		}


		if ($log_uname===$log_username || $log_eml===$log_username) 
			{
				if ($login_password===$log_pwd)
					{
					
						$_SESSION['company_username']=$log_uname;
						$_SESSION['company_db']=$company_dv;
						$_SESSION['company_keyword']=$company_keyword;
						
	 					#redirect to index.php
						header("Location:company_profile.php");
						if ($log_rem===1) {
							setcookie('pwd',$log_password,time()+7*24*60*60);
							setcookie('uname',$log_username,time()+7*24*60*60);
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
	  		<span class="myFormTitle"><h2>Schools/College Login Form</h2></span>
	  		<form action="" method="post">
	  			<?php include 'errors.php'; ?>
	    		<div class="form-group">
	      			<label for="text">Email or Username:</label>
	      			<input type="text" class="form-control" id="email" placeholder="Enter username or email" name="login_email">
	    		</div>
	    		<div class="form-group">
	      			<label for="pwd">Password:</label>
	      			<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="login_pwd">
	    		</div>
	    		<div class="checkbox">
	      			<label><input type="checkbox" name="remember"> Remember me</label>
	    		</div>
	    		<button type="submit" class="btn btn-default myLoginBtn" name="log_company">Login</button>
	  		</form>
	  		</div>
  	</div>
  	<div class="col-lg-3"></div>
	</div>

	<div class="col-lg-2"></div>
</div>

<?php include 'footer.php'; ?>


<?php } ?>	<!-- -------------ENDING OF ELSE i.e ALREADY NOT LOGIN------------------- -->