<?php
	// session_start();
  date_default_timezone_set('Asia/Kathmandu');
  require 'company_acess.php';
  require 'company_database.php';
  require 'admin_db.php';
  $company_uname=$_SESSION['company_username'];
  $credintals_text=$_SESSION['company_keyword'];
  $created_at=date('y-m-d h:i:s');
  $errors=array();
  $Sucess="";

  $i=1;
  // ----------------FOR PAGINATION---------------------
  if (isset($_GET['pageno'])) {
     $pageno = $_GET['pageno'];
   } 
  else {
      $pageno = 1;
    }
  $no_of_records_per_page = 10;
  $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM student_details";
        $result = mysqli_query($con_company,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


// ----------------SELECTING DATA FROM STUDENT Details----------------

  // $select_stu_dtls_pg=@"SELECT * FROM student_details LIMIT $offset, $no_of_records_per_page";
  // $res_stu_detls_pe=mysqli_query($con_company,$select_stu_dtls_pg) or die(mysqli_error($con_company));
  // $total_rows=mysqli_num_rows($res_stu_details_page);

  // if (isset($_GET["page"])) {  
  //     $pn = $_GET["page"];  
  //   }  
  // else {  
  //     $pn=1;  
  //   } 
  
  //   $start_from = ($pn-1) * $limit;   
  
    //$sql = "SELECT * FROM student_details LIMIT $offset, $no_of_records_per_page";   
    // $rs_result = mysql_query ($sql); 
  $select_stu_dtls=@"SELECT * FROM student_details ORDER BY id DESC  LIMIT $offset, $no_of_records_per_page";
  $res_stu_dtls=mysqli_query($con_company,$select_stu_dtls) or die(mysqli_error($con_company));
  ?>


<head>
  <title>Online Entrance-Student Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<?php include 'company_header.php'; ?>

<?php include 'company_navbar.php'; ?>

<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8 myRowBorder"><br></br>
    <div>
        <div class="col-lg-1"></div>
        <div class="col-lg-10 text-center">
        <?php include 'errors.php'; ?>
        <?php if ($Sucess!="") {?>
        <span class="alert alert-success"><?php echo $Sucess; ?></span>
        <?php } ?>
        </div>
        <div class="col-lg-1"></div>
      </div>
	   	<div class="col-lg-4 mySection">
   			<span><br>
    			<center><a href="student_details.php"><button type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#generateQuestions">View Students</button></a></center>
			  </span><br>
	
  		  <span>
		  	<center><button type="button" class="btn btn-primary btn-lg btn-block" onclick="myFunction()">Generate Credintals</button></center><br>
      		<div id="myDIV" style="display: none;">
    			<form method="post">
    				<!-- <div class="form-group">
		              <label for="text">Enter maximum 5 characters(shows on credintals eg: abc5gs53) :</label>
		              <input type="text" class="form-control" id="credintals_text" placeholder="Enter max 4 characters key" name="credintals_text"></input>
		          	</div> -->
		      		<div class="form-group">
		              <label for="number">Enter total number of credintals required:</label>
		              <input type="number" class="form-control" id="credintals_num" placeholder="Enter number of credintals required" name="credintals_num"></input>
		          	</div>
				    <center><button type="submit" class="btn myLoginBtn" name="submit_credintals_num">Create</button></center>
			   </form>
		    </div>
		 </span>
        </div>
    	
      <div class="col-lg-8">
    			<div>
            <table class="table table-bordered">
              <thead>
                <tr><th>ID</th><th>USERNAME</th><th>PASSWORD</th><th>is_active</th><th>Created_at</th><!-- <th>is_printed</th> --><th>Action</th></tr>
              </thead>
              <tbody>
               <?php while($stu_rows=mysqli_fetch_assoc($res_stu_dtls)) { ?>
                <tr>
                  <td><?php echo $stu_rows['id']; ?></td>
                  <td><?php echo $stu_rows['stu_username']; ?></td>
                  <td><?php echo $stu_rows['stu_password']; ?></td>
                  <td><?php 
                  if ($stu_rows['is_active']==1) { ?>
                    <span class="label label-success">active</span>

            <?php }else{?><span class="label label-danger">Not-active</span>

              <?php } ?>
                  </td>
                  <td><?php echo $stu_rows['trn_date']; ?></td>
               <!--    <td><?php //echo $stu_rows['is_printed']; ?></td> -->
                  <td>
                    <form  action="print.php" method="post">
                      <input type="hidden" name="stu_uname">
                      <input type="hidden" name="stu_pwd">
                        <button class="btn btn-primary" name="print_details">Make Printable</button>
                    </form>
                      
                    </td>
                </tr>
                <?php $i=$i+1;} ?>
              </tbody>
            </table>
             <ul class="pagination text-center">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
</div>

    	</div>
    </div>
    <div class="col-lg-2"></div>
</div>


<?php 
// -------------------------GENERATING RANDOM CREDINTALS---------------------------

if (isset($_POST['submit_credintals_num'])) {
	$credintals_num=$_POST['credintals_num'];
  if (empty($credintals_num)) {
    array_push($errors, "please enter number of credintals required");
    }
	$i=1;
  if (count($errors)==0) {
	while ($i<=$credintals_num) {
	$rand_num_uname=rand(10,getrandmax());
	$rand_num_pwd=rand(10,getrandmax());

	// ************************HASING OBTAINED RANDOM NUMBERS************************
		$hash_rand_uname=md5($rand_num_uname);
		$hash_rand_pwd=md5($rand_num_pwd);
	
	// ***************************TAKING REQUIRED NUMBER OF characters only**********************

	$cut_num_uname = substr($rand_num_uname,0,10);
	$cut_num_pwd = substr($rand_num_pwd,0,10);

	// ****************************************FINAL OBTAINED CREDINTALS WITH ATTACHED KEYWORDS****************************
		$final_uname=$credintals_text.$cut_num_uname;
		$final_pwd=$cut_num_pwd;

		// ********************PRINTING FINAL PASSWORDS******************************
   
  $add_random_credintals=@"INSERT INTO student_details(stu_name,stu_email,stu_telephone,stu_address,stu_username,stu_password,is_active,is_action_performed,trn_date)
                            VALUES('NA','NA','NA','NA','$final_uname','$final_pwd','1','0','$created_at')";
      $add_random_credintals_result=mysqli_query($con_company,$add_random_credintals) or die($con_company);
      if ($add_random_credintals_result==1) {
        // header("Refresh:3");
          $Sucess="Your Credintals has been saved to database sucessfully.";
          
        }
      else{
        array_push($errors, "Error occurs during adding credintals");
      }
		

     $i=$i+1;
	}
    }

}



 ?>

<!-- Button trigger modal is up-->

<?php include 'footer.php'; ?>



<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>


<!-- ------------DATA TRIGGER MODEL FOR RANDOM CREDINTALS GEERATOR---------------- -->
<!-- Modal -->
<!-- <div class="modal fade" id="generateQuestions" tabindex="-1" role="dialog" aria-labelledby="generateQuestions" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Random Credintals Generator has generated following details check it</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table>
          <thead>
            <tr><th>S.N.</th><th>Username</th><th>Password</th></tr>
          </thead>
          <tbody></tbody>
        </table>
      	<form>
      		<div class="form-group">
              <label for="text">Enter total number of credintals required:</label>
              <input type="text" class="form-control" id="optn_a" placeholder="Enter Option a details" name="optn_a"></input>
          	</div>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->