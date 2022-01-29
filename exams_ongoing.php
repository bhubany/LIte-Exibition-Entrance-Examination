<?php
date_default_timezone_set('Asia/Kathmandu');
  require 'company_acess.php';
  require 'company_database.php';
  // require 'admin_db.php';
  $created_at=date('y-m-d h:i:s');
  $errors=array();
  $Sucess="";



  if (isset($_POST['deactivate_exam_ongoing'])) {
  	$deactivate_id=$_POST['deactivate_id'];
  	$deactivate_exam_qry=@"UPDATE taking_exam SET exam_status=0 WHERE id='$deactivate_id' LIMIT 1";
	$deactivate_exam_result=mysqli_query($con_company,$deactivate_exam_qry) or die($con_company);
		
		if ($deactivate_exam_result==1) {
			// header("Refresh:3");
			$Sucess="Your exam status has been deactivate sucessfully.";
		}
		else{
			array_push($errors, "Error Occurs while updating your details");
		}
  }


// ---------------------EXAM START------------------------

  if (isset($_POST['exam_start'])) {
    $exam_details=$_POST['exam_details'];
    $exam_time=$_POST['exam_time'];
    $exam_set=$_POST['exam_set'];
    
     if (empty($exam_details)) {
      array_push($errors, "exam details field can't be empty");
    }
    if (empty($exam_time)) {
      array_push($errors, "Exam time can't be empty");
    }
    if (empty($exam_set)) {
      array_push($errors, "Enter set id");
    }
    if (count($errors)==0) {
      $start_exam_qsn=@"INSERT INTO taking_exam(exam_details,exam_time,exam_set,exam_status,is_exam_performed,trn_date)
        VALUES('$exam_details','$exam_time','$exam_set','1','0','$created_at')";
      $start_exam_qsn_result=mysqli_query($con_company,$add_exam_qsn) or die($con_company);
      if ($start_exam_qsn_result==1) {
        // header("Refresh:3");
          $Sucess="Your details has been saved to database sucessfully.";
          
        }
      else{
        array_push($errors, "Error occurs while adding details");
      }
    }
  }


  if (isset($_POST['activate_exam_ongoing'])) {
  	$activate_id=$_POST['activate_id'];
  	$activate_exam_qry=@"UPDATE taking_exam SET exam_status=1 WHERE id='$activate_id' LIMIT 1";
	$activate_exam_result=mysqli_query($con_company,$activate_exam_qry) or die($con_company);
		
		if ($activate_exam_result==1) {
			// header("Refresh:3");
			$Sucess="Your exam status has been activate sucessfully.";
		}
		else{
			array_push($errors, "Error Occurs while updating your details");
		}
  }


  $select_exam_ongoing=@"SELECT * FROM taking_exam";
  $res_exam_ongoing=mysqli_query($con_company,$select_exam_ongoing) or die($con_company);

  $select_sub_cat=@"SELECT * FROM subject_category";
  $res_sub_cat=mysqli_query($con_company,$select_sub_cat) or die($con_company);
  ?>



<?php include 'company_header.php' ?>
<?php include 'company_navbar.php' ?>

<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8 myRowBorder">
  	<div>
  		<center><h2>All the sets availables for exam</h2></center>
  		<table class="table" border="1">
  			<thead>
  				<tr><th>ID</th><th>SET_NAME</th><th>SUB_DETAILS</th><th>CREATED AT</th></tr>
  			</thead>
  			<tbody>
  				<?php while ($sub_rows=mysqli_fetch_assoc($res_sub_cat)) { ?>
  				<tr>
  					<td><?php echo $sub_rows['id']; ?></td>
  					<td><?php echo $sub_rows['sub_name']; ?></td>
  					<td><?php echo $sub_rows['sub_details']; ?></td>
  					<td><?php echo $sub_rows['trn_date']; ?></td>
  				</tr>
  			<?php } ?>
  			</tbody>
  		</table>
  	</div>
  	<div>
  		<span>
            <center><button type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#startexam">Start Exam</button></center>
        </span><br>
  	</div>
  <div>
  	<table class="table" border="1">
  		<thead>
  			<tr><th>ID</th><th>Exam_details</th><th>Exam_time</th><th>exam_set</th><th>Created_at</th><th>exam_status</th><th>ACTION</th></tr>
  		</thead>
  		<tbody>
  			<?php while ($exam_ongoing_rows=mysqli_fetch_assoc($res_exam_ongoing)) { ?>
  			<tr>
  				<td><?php echo $exam_ongoing_rows['id']; ?></td>
  				<td><?php echo $exam_ongoing_rows['exam_details']; ?></td>
  				<td><?php echo $exam_ongoing_rows['exam_time']; ?></td>
  				<td><?php echo $exam_ongoing_rows['exam_set']; ?></td>
  				<td><?php echo $exam_ongoing_rows['trn_date']; ?></td>
  				<td>
  					<?php if($exam_ongoing_rows['exam_status']==1) {?>
  						<span class="label label-success">active</span>

  					<?php }else{?><span class="label label-danger">Not-active</span>

  						<?php } ?>
  				 </td>
  				<td>
  					<?php if($exam_ongoing_rows['exam_status']==1) {?>
  						<form action="" method="post">
  							<input type="hidden" name="deactivate_id" value="<?php echo($exam_ongoing_rows['id']); ?>">
  							<button type="submit" class="btn btn-primary label-danger" name="deactivate_exam_ongoing">Deactivate</button>
  						</form>
  					<?php }else{?>
  						<form action="" method="post">
  							<input type="hidden" name="activate_id" value="<?php echo($exam_ongoing_rows['id']); ?>">
  							<button type="submit" class="btn btn-primary label-sucess" name="activate_exam_ongoing">Activate</button>
  						</form>
  					<?php } ?>
  				</td>
  				
  			</tr>
  		<?php } ?>
  		</tbody>
  	</table>
  </div>
  </div>
  	<div class="col-lg-2"></div>
 </div>











<?php include 'footer.php' ?>



<!-- -----------------------------FOR STARTING EXAM------------------------------ -->

<div class="modal fade" id="startexam" tabindex="-1" role="dialog" aria-labelledby="startexam" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Exam will start from here: </h3>
          <h5 class="modal-title" id="exampleModalLongTitle">Note: <span class="text-danger">Please enter details as asked belo</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="" method="post">
        
            <!-- <h2>Enter Exam Details</h2> -->
            <div class="form-group">
              <label for="text">Enter exam details: </label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter short details of exam" name="exam_details">
            </div>
            <div class="form-group">
              <label for="text">Enter Exam time: </label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter exam time" name="exam_time">
            </div>

            <div class="form-group">
              <label for="text">Enter exam set id:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter exam set" name="exam_set">
            </div>

              <button type="submit" class="btn btn-primary" name="exam_start">Save changes</button>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>