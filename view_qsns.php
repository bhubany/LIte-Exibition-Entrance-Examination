<?php
date_default_timezone_set('Asia/Kathmandu');
  require 'company_acess.php';
  require 'company_database.php';
  // require 'admin_db.php';
  $created_at=date('y-m-d h:i:s');
  $errors=array();
  $Sucess="";
  if (isset($_POST['view_sub_qsn'])) {
  	$_SESSION['qsn_sub_id']=$_POST['qsn_sub_id'];
  }

  if (!isset($_SESSION['qsn_sub_id'])) {
  	header("Location:company_add.php");
  }

  $sub_id=$_SESSION['qsn_sub_id'];

  $sel_qsn_all=@"SELECT * FROM question_collections WHERE sub_id='$sub_id' ORDER BY id DESC";
  $sel_qsn_res=mysqli_query($con_company,$sel_qsn_all) or die(mysqli_error($con_company));

  ?>


  <head>
  <title>Online Entrance -Add Questions and other Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<?php include 'company_header.php'; ?>
<!-- ----------FOR HEADER---------- -->

<?php include 'company_navbar.php'; ?>
<!-- --------------FOR NAV-------------- -->

    <!-- ..............div for viewing questions....... -->
 <div class="rows">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 myRowBorder">
		<div class="Ttable-container">
			<h2 style="color:green">List of Questions </h2>
					  <hr>
					
			<p style="color:#004d66;font-weight: bold">Details of quuestions are:</p>            
		<table class="table table-bordered " style="background-color:#f0f0f5">
		    <thead>
		        <tr>
					<th>Q.NO:</th>
					<th>Q.ID</th>
					<th>Questions</th>
					<th>Answers-Description</th>
					<th>Actions</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $i=1; while($rows_qsn=mysqli_fetch_assoc($sel_qsn_res)) { ?>
			    <tr>
			       <td><?php echo $rows_qsn['qsn_no']; ?></td>
			       <td><?php echo $rows_qsn['id']; ?></td>
			       <td><?php echo $rows_qsn['sub_qsn']; ?></td>
			       <td><?php echo $rows_qsn['answer_details']; ?></td>
			       <td>
              <form method="_POST" action="view_qsn_details.php">
                  <input type="hidden" name="qsn_id">
				     	    <button type="submit" class="btn btn-primary" data-toggle="modal"  data-target="" name="edit_qsn">Edit</button>
              </form>
				        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forremoving">Remove</button>
					    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forviewing-fulldetails">View full details</button>
					</td>
				</tr>
			<?php $i=$i+1; } ?>
			</tbody>
		</table>
        </div>
    </div>

	<div class="col-lg-2"></div>
</div>

<?php include 'footer.php'; ?>





<div class="modal fade" id="forediting" tabindex="-1" role="dialog" aria-labelledby="forediting" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="foremail">Edit your questions and answers:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="myForm">
        <!-- <span class="myFormTitle"><h2>Schools/College Login Form</h2></span> -->
               <form>
       		<select class="form-control" id="sel1">
			    <option>subject Name</option>
			</select><br>
			<div class="form-group">
              <label for="text">Enter Question:</label>
              <textarea type="text" class="form-control" id="question" placeholder="Enter Question" name="add_qsn"></textarea>
          	</div>
          	<div class="form-group">
              <label for="text">Option a:</label>
              <textarea type="text" class="form-control" id="optn_a" placeholder="Enter Option a details" name="optn_a"></textarea>
          	</div>
          	<div class="form-group">
              <label for="text">Option b:</label>
              <textarea type="text" class="form-control" id="optn_b" placeholder="Enter Option b details" name="optn_b"></textarea>
          	</div>
          	<div class="form-group">
              <label for="text">Option c:</label>
              <textarea type="text" class="form-control" id="optn_c" placeholder="Enter Option c details" name="optn_c"></textarea>
          	</div>
          	<div class="form-group">
              <label for="text">Option d:</label>
              <textarea type="text" class="form-control" id="optn_d" placeholder="Enter Option d details" name="optn_d"></textarea>
          	</div>
          	<div class="form-group">
              <label for="text">Correct Option:</label>
              <input type="text" class="form-control" id="correct_optn" placeholder="Enter correct option eg: a" name="correct_optn">
          	</div>
          	<div class="form-group">
              <label for="text">Answer Details:</label>
              <!-- <input type="text" class="form-control" id="ans_details" placeholder="Enter Correct answer details" name="ans_details"> -->
              <textarea type="text" class="form-control" id="ans_details" placeholder="Enter Correct answer details" name="ans_details"></textarea>
          	</div>
          	<div class="form-group">
              <label for="number">Containing Marks:</label>
              <input type="number" class="form-control" id="cntng_marks" placeholder="Enter Marks of this questions" name="cntng_marks">
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
</div>



<!-- -----------------------FOR REMOVING QUESTIONS------------------------------- -->

<!-- Modal -->
<div class="modal fade" id="forremoving" tabindex="-1" role="dialog" aria-labelledby="forremoving" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to remove particular question</h5>
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
<!-- ..............complete........... -->

<!-- ................for viewing full details............ -->
<div class="modal fade" id="forviewing-fulldetails" tabindex="-1" role="dialog" aria-labelledby="forviewing-fulldetails" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Here is the full details of question and answer:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<table class="table table-borderless table-hover">
		<thead><tr><th>This is the Question</th></tr></thead>
		<tbody>
			<tr><td>This is option A</td></tr>
			<tr><td>This is option B</td></tr>
			<tr><td>This is option C</td></tr>
			<tr><td>This is option D</td></tr>
			<tr><td>This is COrrect option D</td></tr>
			<tr><td>This is FOR ANSWER DETAILS</td></tr>
			<tr><td>This question contains marks: 2</td></tr>
		</tbody>
		</table>





       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

