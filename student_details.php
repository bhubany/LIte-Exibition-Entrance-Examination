<?php 
  date_default_timezone_set('Asia/Kathmandu');
  require 'company_acess.php';
  require 'company_database.php';
  // require 'admin_db.php';
  $company_uname=$_SESSION['company_username'];
  $credintals_text=$_SESSION['company_keyword'];
  $created_at=date('y-m-d h:i:s');
  $errors=array();
  $Sucess="";

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

  // $select_stu_details_page=@"SELECT * FROM student_details ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
  // $res_stu_details_page=mysqli_query($con_company,$select_stu_details_page) or die(mysqli_error($con_company));
  // $total_rows=mysqli_num_rows($res_stu_details_page);  
  
    //$sql = "SELECT * FROM student_details LIMIT $start_from, $limit";   
    // $rs_result = mysql_query ($sql); 
  $select_stu_details=@"SELECT * FROM student_details ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
  $res_stu_details=mysqli_query($con_company,$select_stu_details) or die(mysqli_error($con_company));

 ?>




<head>
  <title>Online Entrance -Student Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>



<!-- ----------FOR HEADER---------- -->
<?php include 'company_header.php'; ?>

<!-- --------------FOR NAV-------------- -->
<?php include 'company_navbar.php'; ?>


    <!-- ...........for student-details.......... -->
<div class="rows">
  <div class="col-lg-2"></div>
  <div class="col-lg-8 myRowBorder">
  	<div>
    <h3 style="color:green">Details of students:</h3><hr>
    <p style="color:#004d66;font-weight: bold">Full details of students and result:</p> 
     <table class="table table-bordered " style="background-color:#f0f0f5">
              <thead>
                <tr>
                  <th>S.N</th>
                  <th>ID</th>
                  <th>Student Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <!-- <th>Password</th> -->
                  <th>Address</th>
                  <th>Contact Number</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php $i=1;  while($stu_rows=mysqli_fetch_assoc($res_stu_details)) { ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $stu_rows['id']; ?></td>
                  <td><?php echo $stu_rows['stu_name']; ?></td>
                  <td><?php echo $stu_rows['stu_username']; ?></td>
                  <td><?php echo $stu_rows['stu_email']; ?></td>
                  <td><?php echo $stu_rows['stu_address']; ?></td>
                  <td><?php echo $stu_rows['stu_telephone']; ?></td>
                  <td>
                  	<!-- <form method="post"> -->
                  	<!-- <input type="hidden" name="stu_id" value="<?php //echo $stu_rows['id']; ?>"> -->
                  	<a href="view_stu_full_details.php?id=<?php echo $stu_rows['id']; ?>"><button type="submit" class="btn btn-primary" name="submit_stu_id">VIEW FULL</button></a>
                  </td>
                  <td><button class="btn btn-primary">Remove</button></td>
                </tr>
            <?php $i=$i+1;} ?>
              </tbody>
     </table>    
<!-- ----------------------PAGINATION-------------------------- -->
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
    <!-- ------------------------CLOSING OF PAGINATION----------------------------     -->

  <div class="col-lg-2"></div>
 </div>
<!-- ****************************CLOSING OF MAIN WORKING DIRECTORY************************************** -->


  <!-- ..............for view student details........... -->

  <div class="modal fade" id="for-viewing-details" tabindex="-1" role="dialog" aria-labelledby="fo-rviewing-details" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Reasult of student:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless table-hover">
    <thead><tr><th>Name of student:</th></tr></thead>
    <tbody>
      <tr><td>Total number of questions</td><td>##</td></tr>
      <tr><td>Total marks</td><td>##</td></tr>
      <tr><td>Obtained marks</td><td>##</td></tr>
      <tr><td>Mark in physics</td><td>##</td></tr>
      <tr><td>Mark in mathematics</td><td>##</td></tr>
      <tr><td>Mark in chemistry</td><td>##</td></tr>
      <tr><td>Right Answers</td><td>##</td></tr>
      <tr><td>Wrong Answers</td><td>##</td></tr>
      <tr><td>Percentage</td><td>##</td></tr>
      <tr><td>Remarks</td><td>##</td></tr>
      <tr><td><?php if (isset($_GET["page"])) {  
      $pn = $_GET["page"];  
    }  
  else {  
      $pn=1;  
    } ?></td></tr>
      <th><?php  ?>ALL the best for your upcomming future</th>
    </tbody>
    </table> 
      </div>
      <div class="modal-footer">
        <form>
        <button type="submit" class="btn btn-success">Print result</button>
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </form>

      </div>
    </div>
  </div>
</div>
<!-- .............complete............ -->

<!-- .........removing............. -->
<div class="modal fade" id="for-removing" tabindex="-1" role="dialog" aria-labelledby="for-removing" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to remove particular student from your list ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
           <button type="submit" class="btn btn-success">yes</button>
           <button type="submit" class="btn btn-danger">No</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- .............complete........... -->