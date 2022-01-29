<?php 

	date_default_timezone_set('Asia/Kathmandu');
	require 'company_acess.php';
	require 'company_database.php';
	require 'admin_db.php';
	$created_at=date('y-m-d h:i:s');
	$errors=array();
	$Sucess="";

	$company_uname=$_SESSION['company_username'];



// ---------------------UPDATING CUSTOMER NAME-------------------------
	if (isset($_POST['submit_update_name'])) {
		$update_name=$_POST['update_name'];

		if (empty($update_name)) {
			array_push($errors, "Customer name can't  be empty");
		}

		if (count($errors)==0) {
		$update_name_qry=@"UPDATE company_details SET company_name='$update_name' WHERE company_username='$company_uname' LIMIT 1";
		$update_name_result=mysqli_query($con_admin,$update_name_qry) or die($con_admin);
		if ($update_name_result==1) {
			header("Refresh:3");
			$Sucess="Your company name has been updated sucessfully.";
		}
		else{
			array_push($errors, "Error Occurs while updating your details");
		}
		}
	}


// ----------UPDATING CUSTOMER EMAIL------------------------
		if (isset($_POST['submit_update_email'])) {
		$update_email=$_POST['update_email'];

		if (empty($update_email)) {
			array_push($errors, "Customer email can't  be empty");
		}

		if (count($errors)==0) {
		$update_email_qry=@"UPDATE company_details SET company_email='$update_email' WHERE company_username='$company_uname' LIMIT 1";
		$update_email_result=mysqli_query($con_admin,$update_email_qry) or die($con_admin);
		if ($update_email_result==1) {
			header("Refresh:3");
			$Sucess="Your company email has been updated sucessfully.";
		}
		else{
			array_push($errors, "Error Occurs while updating your details");
		}
		}
	}


// -------------------UPDATING PRIMARY TELEPHONE---------------------
	if (isset($_POST['submit_update_telephone1'])) {
		$update_telephone1=$_POST['update_telephone1'];

		if (empty($update_telephone1)) {
			array_push($errors, "Primary Telephone can't  be empty");
		}

		if (count($errors)==0) {
		$update_telephone1_qry=@"UPDATE company_details SET company_telephone1='$update_telephone1' WHERE company_username='$company_uname' LIMIT 1";
		$update_telephone1_result=mysqli_query($con_admin,$update_telephone1_qry) or die($con_admin);
			if ($update_telephone1_result==1) {
				header("Refresh:3");
				$Sucess="Your Primary telephone has been updated sucessfully.";
			}
			else{
				array_push($errors, "Error Occurs while updating your details");
			}
		}
	}



// *****************************COMPANY DATABASE****************************************

// -------------------------Updating company name present on header-----------------------
	if (isset($_POST['submit_update_scl_clg_name'])) {
		$update_scl_clg_name=$_POST['update_scl_clg_name'];

		if (empty($update_scl_clg_name)) {
			array_push($errors, "Schools/College Name can't  be empty");
		}

		if (count($errors)==0) {
		$update_scl_clg_name_qry=@"UPDATE others SET company_header='$update_scl_clg_name' LIMIT 1";
		$update_scl_clg_name_result=mysqli_query($con_company,$update_scl_clg_name_qry) or die($con_company);
			if ($update_scl_clg_name_result==1) {
				header("Refresh:3");
				$Sucess="Your Schools/College Name has been updated sucessfully.";
			}
			else{
				array_push($errors, "Error Occurs while updating your details");
			}
		}
	}


// -----------------Updating Schools/College address oresent on header------------------
	if (isset($_POST['submit_update_scl_clg_address'])) {
		$update_scl_clg_address=$_POST['update_scl_clg_address'];

		if (empty($update_scl_clg_address)) {
			array_push($errors, "Schools/College Address can't  be empty");
		}

		if (count($errors)==0) {
		$update_scl_clg_address_qry=@"UPDATE others SET company_address='$update_scl_clg_address' LIMIT 1";
		$update_scl_clg_address_result=mysqli_query($con_company,$update_scl_clg_address_qry) or die($con_company);
			if ($update_scl_clg_address_result==1) {
				header("Refresh:3");
				$Sucess="Your Schools/College Address has been updated sucessfully.";
			}
			else{
				array_push($errors, "Error Occurs while updating your details");
			}
		}
	}



// --------------------Updating official logo of college/schools------------------------

if (isset($_POST['submit_update_official_logo'])) {

	$extension = pathinfo($_FILES["update_logo"]["name"], PATHINFO_EXTENSION);
	$target="assests/icons/";

		if (empty($extension)) {
			array_push($errors, "Please select image for your official logo");
		}

		if (count($errors)==0) {
			$album_cvr_img=Date('Y_m_d_h_m_s_ms').$company_uname."Logo".$extension;
			move_uploaded_file($_FILES["update_logo"]["tmp_name"], $target.$album_cvr_img);

			$update_official_logo_qry=@"UPDATE others SET company_logo='$album_cvr_img' LIMIT 1";
			$update_official_logo_qry_result=mysqli_query($con_company,$update_official_logo_qry) or die($con_company);
			if ($update_official_logo_qry_result==1) {
				header("Refresh:3");
				$Sucess="Your Schools/College Logo has been updated sucessfully.";
			}
			else{
				array_push($errors, "Error Occurs while updating your details");
			}
		}
	}



//--------------------Updating website of Schools/College----------------------
	if (isset($_POST['submit_update_scl_clg_website'])) {
		$update_scl_clg_website=$_POST['update_scl_clg_website'];

		if (empty($update_scl_clg_website)) {
			array_push($errors, "Schools/College Website can't  be empty");
		}

		if (count($errors)==0) {
		$update_scl_clg_website_qry=@"UPDATE others SET company_website='$update_scl_clg_website' LIMIT 1";
		$update_scl_clg_website_result=mysqli_query($con_company,$update_scl_clg_website_qry) or die($con_company);
			if ($update_scl_clg_website_result==1) {
				header("Refresh:3");
				$Sucess="Your Schools/College Website has been updated sucessfully.";
			}
			else{
				array_push($errors, "Error Occurs while updating your details");
			}
		}
	}

// *****************************ENDING OF WORKING OF COMPANY DATABASE****************************************

// ---------------------UPDATING Login Password-------------------------
	if (isset($_POST['submit_update_login_new_pwd'])) {
		$update_login_old_pwd=$_POST['update_login_old_pwd'];
		$update_login_new_pwd=$_POST['update_login_new_pwd'];
		$update_login_conform_new_pwd=$_POST['update_login_conform_new_pwd'];

		if (empty($update_login_old_pwd)) {
			array_push($errors, "Old Password is required.");
		}
		if (empty($update_login_new_pwd)) {
			array_push($errors, "New Password is required.");
		}
		if (empty($update_login_conform_new_pwd)) {
			array_push($errors, "Conform your New password.");
		}

// -------------------MATCHING ENTERED PASSWORDS_----------
		if ($update_login_new_pwd===$update_login_conform_new_pwd) {
			$new_pwd=md5($update_login_conform_new_pwd);
		}
		else{
			array_push($errors, "Both password doesnot matched.");	
		}

// ----------------CHECKING OLD PASSWORD IS CORRECT OR NOT---------------

		$query="SELECT * FROM company_details WHERE company_username='$company_uname' and company_password='".md5($update_login_old_pwd)."' ";
		$result=mysqli_query($con_admin,$query) or die(mysqli_error($con_admin));
		if (mysqli_num_rows($result)==0) {
			array_push($errors, "!!! Incorrect old password !!!");
		}


		if (count($errors)==0) {
		$update_pwd_qry=@"UPDATE company_details SET company_password='$new_pwd' WHERE company_username='$company_uname' LIMIT 1";
		$update_pwd_result=mysqli_query($con_admin,$update_pwd_qry) or die($con_admin);
		if ($update_pwd_result==1) {
			header("Refresh:3");
			$Sucess="Your Login password has been updated sucessfully.";
		}
		else{
			array_push($errors, "Error Occurs while updating your details");
		}
		}
	}



// ----------------------------SECONDARY TELEPHINE-----------------------
	if (isset($_POST['submit_update_telephone2'])) {
		$update_telephone2=$_POST['update_telephone2'];

		if (empty($update_telephone2)) {
			array_push($errors, "Secondary Telephone can't  be empty");
		}

		if (count($errors)==0) {
		$update_telephone2_qry=@"UPDATE company_details SET company_telephone2='$update_telephone2' WHERE company_username='$company_uname' LIMIT 1";
		$update_telephone2_result=mysqli_query($con_admin,$update_telephone2_qry) or die($con_admin);
			if ($update_telephone2_result==1) {
				header("Refresh:3");
				$Sucess="Your Secondary telephone has been updated sucessfully.";
			}
			else{
				array_push($errors, "Error Occurs while updating your details");
			}
		}
	}


//--------------To perform actions on company details from admin Database----------

	$cmpny_admin_details_qry=@"SELECT * FROM company_details WHERE 	company_username='$company_uname'";
	$cmpny_admin_details_res=mysqli_query($con_admin,$cmpny_admin_details_qry) or die($con_admin);
	while ($cmpny_admin_details_rows=mysqli_fetch_assoc($cmpny_admin_details_res)) {


// --------TO perform action of company Details from Company Database-----------------
	$company_details_qry=@"SELECT * FROM others";
	$company_details_res=mysqli_query($con_company,$company_details_qry) or die($con_company);
	while ($company_details_rows=mysqli_fetch_assoc($company_details_res)) {


 ?>



<?php include 'company_header.php'; ?>
<?php include 'company_navbar.php'; ?> 


<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
 <link rel="stylesheet" type="text/css" href="assests/css/myStyle.css">
</head>

<!-- ---------------PROFILE DETAILS-------------------- -->  
  <div class="row">   <!-- ------------------!ST ROWS------------ -->
    <div class="col-lg-2"></div>
    <div class="col-lg-8 myRowBorder"> 
    	<div><br>
    		<div class="col-lg-1"></div>
    		<div class="col-lg-10 text-center">
    		<?php include 'errors.php'; ?>
    		<?php if ($Sucess!="") {?>
    		<span class="alert alert-success"><?php echo $Sucess; ?></span>
    		<?php } ?><br><br>
	    	</div>
	    	<div class="col-lg-1"></div>
    	</div>
    <div>
     	<div class="col-lg-6">
         <table border="1" class="table table-design">
           <thead>
             <tr><th>Profile Details: </th><th> Actions: </th></tr>
           </thead>
           <tbody>

            <tr><td><span>Customer Name: </span><span class="pull-right"><?php echo $cmpny_admin_details_rows['company_name']; ?></span></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forcustomernameupdate">Edit</button></td></tr>
             <tr><td><span class="pull-left">Email: </span><span class="pull-right"><?php echo $cmpny_admin_details_rows['company_email']; ?></span></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#foremail">Edit</button></td></tr>
             <tr><td><span>Cell Phone (primary): </span><span class="pull-right" style="padding-left: 150px;"><?php echo $cmpny_admin_details_rows['company_telephone1']; ?></span></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forcellphonenumber">Edit</button></td></tr>
           </tbody>
         </table>
     	</div>

<!-- -----------------SUB DIVISION OF 1st_row.DIV with column 8-------------------- -->

     	<div class="col-lg-6">
	     	<table border="1"class="table table-design">
	           <thead>
	             <tr><th>College Details: (<span class="text-danger"> It will be shown as header/address</span> )</th><th> Actions: </th></tr>
	           </thead>
<!-- -------------------------------------------THIS DETAILS WILL PERFORM ACTION TO COMPANY DATABASE------------------------------- -->
	           <tbody>
	            <tr><td><span> Schools/College Name: </span><span class="pull-right"><?php echo $company_details_rows['company_header']; ?></span></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forscl-clg-name">Edit</button></td></tr>
	             <tr><td><span class="pull-left">school/college Address: </span><span class="pull-right"><?php echo $company_details_rows['company_address']; ?></span></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#for-scl-clg-address">Edit</button></td></tr>
	             <tr><td><span>Schools/College Logo: </span><span class="pull-right" style="padding-left: 150px;"><?php echo $company_details_rows['company_logo']; ?></span></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#for-scl-clg-logo">Edit</button></td></tr>
	           </tbody>
	        </table>
     	</div>
     </div>


     <div>
     	<div class="col-lg-6"><br>
         <table border="1" class="table table-design">
           <thead>
             <tr><th>login Details: </th><th> Actions: </th></tr>
           </thead>

           <tbody>
            <tr><td><span class="pull-left">Username: </span><span class="pull-right" style="padding-left: 200px;"><?php echo $cmpny_admin_details_rows['company_username']; ?></span></td>
            	<td><?php if ($cmpny_admin_details_rows['is_active']==1) {?><span class="label label-success">active</span><?php }else{?><span class="label label-danger">Not-active</span><?php } ?></td></tr>
             <tr><td><span class="pull-left">Password: </span><span class="pull-right" style="padding-left: 200px;">********</span></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forpassword">Edit</button></td></tr>
           </tbody>
         </table>
       </div>
     </div>

     <div class="col-lg-6"><br>
         <table border="1" class="table table-design">
           <thead>
             <tr><th>Other Details: </th><th> Actions: </th></tr>
           </thead>
           <tbody>

            <tr><td><span> Address: </span><span class="pull-right"><a target="blank" href="<?php echo $company_details_rows['company_website']; ?>"><?php echo $company_details_rows['company_website']; ?></a></span></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forwebsiteaddress">Edit</button></td></tr>
             <tr><td><span class="pull-left">Cell Phone(secondary): </span><span class="pull-right"><?php echo $cmpny_admin_details_rows['company_telephone2']; ?></span></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cellphonesecondary">Edit</button></td></tr>
            
           </tbody>
         </table>
       </div>

    </div>
    <div class="col-lg-2"></div>
   </div><!-- -----------------------CLOSING OF DIV 1st ROWS i.e view portion------------------- -->




   <!-- ***************-------------++++++++++ TAKING INPUT TO UPDATE --------------------++++++++++++++************ -->

<!-- ..........for customer name............ -->

<div class="modal fade" id="forcustomernameupdate" tabindex="-1" role="dialog" aria-labelledby="forcustomernameupdate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forcustomernameupdate">Enter New Customer Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
            <form action="" method="post">
              <div class="form-group">
                  <label for="text">Customer Name:</label>
                  <input type="text" class="form-control" id="text" placeholder="Full Name" name="update_name">
              </div>
                      <button type="submit" class="btn btn-primary" name="submit_update_name">Save changes</button>
            </form>
            </div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- .............customername finished........... -->



<!-- FOR CUSTOMER Email -->

<div class="modal fade" id="foremail" tabindex="-1" role="dialog" aria-labelledby="foremail" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="foremail">Enter New Email</h3>
        <h5 class="modal-title" id="foremail">You must have to verify your email while changing it.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
        <form action="" method="post">
          <div class="form-group">
              <label for="text">Email:</label>
              <input type="text" class="form-control" id="email" placeholder="someone@gmail.com" name="update_email">
          </div>
                  <button type="submit" class="btn btn-primary" name="submit_update_email">Save changes</button>
        </form>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- <!........modal finished...... -->


	<!-- --------------for primary cellphonenumber---------------- -->

<div class="modal fade" id="forcellphonenumber" tabindex="-1" role="dialog" aria-labelledby="forcellphonenumber" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="foremail">Enter New Phone Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
        <form action="" method="post">
          <div class="form-group">
              <label for="Number">Phone Number (primary):</label>
              <input type="Number" class="form-control" id="email" placeholder="+977 XXXXXXX" name="update_telephone1">
          </div>
                  <button type="submit" class="btn btn-primary" name="submit_update_telephone1">Save changes</button>
        </form>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- <!........modal finished...... -->

<!-- -------------------FOR username----------------------- -->

<!-- <div class="modal fade" id="forusername" tabindex="-1" role="dialog" aria-labelledby="forusername" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="foremail">Username</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <span class="myFormTitle"><h2>Schools/College Login Form</h2></span>
        <form action="" method="post">
          <div class="form-group">
              <label for="text">username:</label>
              <input type="text" class="form-control" id="email" placeholder="someone" name="login_email">
          </div>
        </form>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
<!-- <!........modal finished...... -->


<!-- -----------------------LOGIN password------------------------- -->

<div class="modal fade" id="forpassword" tabindex="-1" role="dialog" aria-labelledby="forpassword" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="foremail">Update your Password </h5>
        <h5 class="modal-title" id="foremail">Note: <span class="text-danger">Please keep your password unique and do not share with others.</span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
        <form action="" method="post">
          <div class="form-group">
              <label for="password">Enter Old Password: </label>
              <input type="password" class="form-control" id="password" placeholder="Enter Old Password" name="update_login_old_pwd">
          </div>
          <div class="form-group">
              <label for="password">Enter New Password: </label>
              <input type="password" class="form-control" id="password" placeholder="Enter New Password" name="update_login_new_pwd">
          </div>
          <div class="form-group">
              <label for="password">Conform New Password: </label>
              <input type="password" class="form-control" id="password" placeholder="Conform New Password" name="update_login_conform_new_pwd">
          </div>
                  <button type="submit" class="btn btn-primary" name="submit_update_login_new_pwd">Save changes</button>
        </form>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- <!........modal finished...... -->

<!----------------------FOR COLLEGE WEBSITE address on logo of HEADER-------------------->
<div class="modal fade" id="forwebsiteaddress" tabindex="-1" role="dialog" aria-labelledby="forwebsiteaddress" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="foremail">Enter New Website:</h3>
        <h5 class="modal-title" id="foremail">Note: <span class="text-danger">Users Can visit your website from this url by clicking on your official logo.</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
        <form action="" method="post">
          <div class="form-group">
              <label for="text">Website Address:</label>
              <input type="text" class="form-control" id="text" placeholder="http://yourWebsite.com/" name="update_scl_clg_website">
          </div>
                  <button type="submit" class="btn btn-primary" name="submit_update_scl_clg_website">Save changes</button>
        </form>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- <!........modal finished...... -->


<!------------------------forcellphone(secondry)------------------->
<div class="modal fade" id="cellphonesecondary" tabindex="-1" role="dialog" aria-labelledby="cellphonesecondary" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="foremail">Update your secondary contact number:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
        <form action="" method="post">
          <div class="form-group">
              <label for="text">Cellphone(secondary)</label>
              <input type="Number" class="form-control" id="email" placeholder="98########" name="update_telephone2">
          </div>
                  <button type="submit" class="btn btn-primary" name="submit_update_telephone2">Save changes</button>
        </form>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- <!........modal finished...... -->

<!-----------------for school/College NAME------------------>
<div class="modal fade" id="forscl-clg-name" tabindex="-1" role="dialog" aria-labelledby="forscl-clg-name" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="foremail">Enter new name:</h3>
        <h5 class="modal-title" id="foremail">Note: <span class="text-danger">This name will be shown as header name on your profile.</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
        <form action="" method="post">
          <div class="form-group">
              <label for="text">schools/college Name</label>
              <input type="text" class="form-control" id="text" placeholder="Name of School/College" name="update_scl_clg_name">
          </div>
        <button type="submit" class="btn btn-primary" name="submit_update_scl_clg_name">Save changes</button>
        </form>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- <!........modal finished...... -->

<!------------------forscl-clg-address--------------------->
<div class="modal fade" id="for-scl-clg-address" tabindex="-1" role="dialog" aria-labelledby="for-scl-clg-address" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="foremail">Enter New address of your company: </h3>
        <h5 class="modal-title" id="fortext">Note: <span class="text-danger">This address will be shown in your profile header as address.</span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
        <form action="" method="post">
          <div class="form-group">
              <label for="text">school/college address:</label>
              <input type="text" class="form-control" id="email" placeholder="Enter New Address" name="update_scl_clg_address">
          </div>
                  <button type="submit" class="btn btn-primary" name="submit_update_scl_clg_address">Save changes</button>
        </form>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- <!........modal finished...... -->

<!------------------forscl-clg-Logo--------------------->

<div class="modal fade" id="for-scl-clg-logo" tabindex="-1" role="dialog" aria-labelledby="for-scl-clg-logo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="foremail">Upload your New logo</h3>
        <h5 class="modal-title" id="foremail">Note: <span class="text-danger">This logo will display on your header as official logo.</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
        <form action="" method="post">
          <div class="form-group">
              <!-- <label for="file">school/college logo:</label> -->
              <input type="file" name="update_logo">
          </div>
                  <button type="submit" class="btn btn-primary" name="submit_update_official_logo">Save changes</button>
        </form>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- <!........modal finished...... -->


<?php }} ?>












<?php include 'footer.php'; ?>