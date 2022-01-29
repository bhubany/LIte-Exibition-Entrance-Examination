<?php
date_default_timezone_set('Asia/Kathmandu');
  require 'company_acess.php';
  require 'company_database.php';
  // require 'admin_db.php';
  $created_at=date('y-m-d h:i:s');
  $errors=array();
  $Sucess="";


  $phy_qsn_col="";
  $eng_qsn_col="";
  $math_qsn_col="";
  $apt_qsn_col="";
  $chem_qsn_col="";


// if (isset($_POST['qsn_generator'])) {

//   $select_subject=@"SELECT id FROM subject_category";
//   $subject_res=mysqli_query($con_company,$select_subject) or die(mysqli_error($con_company));
//   while($rows=mysqli_fetch_assoc($select_subject_res)) {

//   }


//    $english1=$_POST['english1'];
//   $english2=$_POST['english2'];
//   $chem1=$_POST['chem1'];
//   $chem2=$_POST['chem2'];
//   $physics1=$_POST['physics1'];
//   $physics2=$_POST['physics2'];
//   $math1=$_POST['math1'];
//   $math2=$_POST['math2'];
//   $aptitude1=$_POST['aptitude1'];
//   $aptitude2=$_POST['aptitude2'];

//   $english_id=2;
//   $chem_id=3;
//   $phy_id=1;
//   $math_id=4;
//   $apt_id=5;

//   $select_phy=@"SELECT * FROM question_collections WHERE sub_id='1'";
//   $phy_res=mysqli_query($con_company,$select_phy) or die(mysqli_error($con_company));
//   $num_phy=mysqli_num_rows($phy_res);
//   // while($rows_phy=mysqli_fetch_assoc($select_subject_res)) {

//   // }
//   $j=1;

//   while ($j<=$num_phy) {

//     $phy_qsn=rand(1,$num_phy);
//     $phy_qsn_col=$phy_qsn_col.",".$phy_qsn_col;
//   }

// }




  // ------------------------------GENERATE QUESTION------------------------------

  if (isset($_POST['gnrt_qsn'])) {


  }


// -------------------------ADDING QUESTIONS TO DATABASE------------------------
  if (isset($_POST['submit_add_qsn'])) {
    $qsn_no=$_POST['qsn_no'];
    $sub_id=$_POST['sub_id'];
    $add_qsn=$_POST['add_qsn'];
    $optn_a=$_POST['optn_a'];
    $optn_b=$_POST['optn_b'];
    $optn_c=$_POST['optn_c'];
    $optn_d=$_POST['optn_d'];
    $correct_optn=$_POST['correct_optn'];
    $ans_details=$_POST['ans_details'];
    $cntng_marks=$_POST['cntng_marks'];

    if (empty($qsn_no)) {
      array_push($errors, "Question number field can't be empty");
    }
    if (empty($add_qsn)) {
      array_push($errors, "Question field can't be empty");
    }
    if (empty($optn_a)) {
      array_push($errors, "Enter option a");
    }
    if (empty($optn_b)) {
      array_push($errors, "Enter option b");
    }
    if (empty($optn_c)) {
      array_push($errors, "Enter option c");
    }
    if (empty($optn_d)) {
      array_push($errors, "Enter option d");
    }
    if (empty($correct_optn)) {
      array_push($errors, "Enter correct optn as eg: a");
    }
    if (empty($ans_details)) {
      array_push($errors, "Enter ans details if you know or write NA");
    }
    if (empty($cntng_marks)) {
      array_push($errors, "Please enter marks for this questions");
    }


    if (count($errors)==0) {
      $add_exam_qsn=@"INSERT INTO question_collections(sub_id,sub_qsn,optn_a,optn_b,optn_c,optn_d,correct_optn,answer_details,cntng_marks,trn_date)
                            VALUES('$sub_id','$add_qsn','$optn_a','$optn_b','$optn_c','$optn_d','$correct_optn','$ans_details','$cntng_marks','$created_at')";
      $add_exam_qsn_result=mysqli_query($con_company,$add_exam_qsn) or die($con_company);
      if ($add_exam_qsn_result==1) {
        // header("Refresh:3");
          $Sucess="Your Question details has been saved to database sucessfully.";
          
        }
      else{
        array_push($errors, "Error occurs while adding Questions");
      }
    }
  }


// -------------------------ADDING SUBJECTS TO DATABASE------------------------
  if (isset($_POST['add_sub_name'])) {
    $sub_name=$_POST['sub_name'];
    $sub_details=$_POST['sub_details'];

    if (empty($sub_name)) {
      array_push($errors, "Enter Subject name");
    }
    if (empty($sub_details)) {
      array_push($errors, "Please subject details or write NA");
    }

    if (count($errors)==0) {
      $add_sub_qry=@"INSERT INTO subject_category (sub_name,sub_details,trn_date)
                            VALUES('$sub_name','$sub_details','$created_at')";
      $add_sub_qry_result=mysqli_query($con_company,$add_sub_qry) or die($con_company);
      if ($add_sub_qry_result==1) {
        // header("Refresh:3");
          $Sucess="Your Subject with details has been saved to database sucessfully.";
          
        }
      else{
        array_push($errors, "Error occurs while adding Subjects");
      }
    }

  }


// ---------------------ADDING EXAM DETAILS--------------------------------
    if (isset($_POST['add_exam_details'])) {
    $exam_details=$_POST['exam_details'];

    if (empty($exam_details)) {
      array_push($errors, "Enter Exam details");
    }

    if (count($errors)==0) {
      $add_exam_details_qry=@"INSERT INTO exam_details (details,trn_date)
                            VALUES('$exam_details','$created_at')";
      $add_exam_details_qry_result=mysqli_query($con_company,$add_exam_details_qry) or die($con_company);
      if ($add_exam_details_qry_result==1) {
        // header("Refresh:3");
          $Sucess="Your exam details has been saved to database sucessfully.";
          
        }
      else{
        array_push($errors, "Error occurs while adding Exam details");
      }
    }

  }


// --------------------GETTING SUBJECT NAMES-----------------------
   $company_uname=$_SESSION['company_username'];
  
  $select_subject_qry=@"SELECT * FROM subject_category";
  $select_subject_res=mysqli_query($con_company,$select_subject_qry) or die(mysqli_error($con_company));

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


<!-- ---------------------Different div to add questions------------- -->
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8 myRowBorder"><br>
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
    				<center><button type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#addQuestionMenu">Add Questions</button></center>
			  </span>
        <span><br>
            <center><button type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#adddExamRules">Add Exam Rules</button></center>
        </span>
        <span><br>
            <center><button type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="" name="gnrt_qsn">Generate Random Questions</button></center>
        </span><br>
        <span>
            <center><button type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#addSubjectName">Add Subjects</button></center>
        </span><br>
        <!-- <span>
            <center><button type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#startexam">Start Exam</button></center>
        </span><br> -->
	
  		  <span>
			  	<center><button type="button" class="btn btn-primary btn-lg btn-block" onclick="myFunction()">View Questions</button></center><br>
      			<div id="myDIV" style="display: none;">
    	   			<form action="view_qsns.php" method="post">
		      			<select class="form-control" id="sel1" name="qsn_sub_id">
                  <?php while($rows_name=mysqli_fetch_assoc($select_subject_res)) { ?>
				  	    	<option value="<?php echo $rows_name['id']; ?>"><?php echo $rows_name['sub_name']; ?></option>
                <?php } ?>
					     	</select><br>
						    <center><button type="submit" class="btn myLoginBtn" name="view_sub_qsn">View</button></center>
					   </form>
				    </div>
			  </span>
      </div>
    	<div class="col-lg-8">
    			<div>
         <table class="table" border="1">
           <thead><tr><th>ID</th><th>Subject Name</th><th>Subject Details</th><th>Upload_Date</th></tr></thead>
           <tbody>
              <?php $select_subject_qry=@"SELECT * FROM subject_category";
                    $select_subject_res=mysqli_query($con_company,$select_subject_qry) or die(mysqli_error($con_company));
                    while($rows_name=mysqli_fetch_assoc($select_subject_res)) { ?>
             <tr>
               <td><?php echo $rows_name['id']; ?></td>
               <td><?php echo $rows_name['sub_name']; ?></td>
               <td><?php echo $rows_name['sub_details']; ?></td>
               <td><?php echo $rows_name['trn_date']; ?></td>
             </tr>
           <?php } ?>
           </tbody>
         </table>   
          </div>
    	</div>
  <div class="col-lg-2"></div>
</div>


<!-- ----------------THIS IS FOR SHOW AND HIDE SELECT MENU IN VIEW QUESTIONS---------------- -->
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
</div>



<!-- -----------FOR FOOTER------- -->
<?php include 'footer.php'; ?>
<!-- %%%%%%%******************ENDING OF MAIN WORKING************&&&&&&&&&&&& -->


<!-- Button trigger modal is above -->

<!-- Modal for add questions-->
<div class="modal fade" id="addQuestionMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Please Enter Details Below as asked:</h3>
        <h5 class="modal-title"><b>Note:</b> <span class="text-danger bg-warning">Enter details properly. Smaller change in details can make larger problems Specially while selecting subject and marks</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php   $select_subject_qry=@"SELECT * FROM subject_category";
  $select_subject_res=mysqli_query($con_company,$select_subject_qry) or die(mysqli_error($con_company)); ?>
       <form action="" method="post">
       		<select class="form-control" id="sel1" name="qsn_sub_id">
             <?php while($rows=mysqli_fetch_assoc($select_subject_res)) { ?>
             <option value="<?php echo $rows['id']; ?>"><?php echo $rows['sub_name']; ?></option>
             <?php } ?>
          </select><br>
      <div class="form-group">
              <label for="number">Question No:</label>
              <textarea type="number" class="form-control" id="qsn_no" placeholder="Enter Questions Numbers" name="qsn_no"></textarea>
            </div>
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
                    <button type="submit" class="btn btn-primary" name="submit_add_qsn">Save changes</button>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>




<!----------------- Modal to add subject name------------->
<div class="modal fade" id="addSubjectName" tabindex="-1" role="dialog" aria-labelledby="addSubjectName" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Add New subject</h3>
          <h5 class="modal-title" id="exampleModalLongTitle">Note: <span class="text-danger">Please check subject name if already entered before entering</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="" method="post">
         <div class="form-group">
              <label for="text">Subject Name:</label>
              <input type="text" class="form-control" id="sub_details" placeholder="Enter Subject Name" name="sub_name">
            </div>
            <div class="form-group">
              <label for="text">Subject Details:</label>
              <!-- <input type="text" class="form-control" id="ans_details" placeholder="Enter Correct answer details" name="ans_details"> -->
              <textarea type="text" class="form-control" id="sub_details" placeholder="Enter Correct answer details" name="sub_details"></textarea>
            </div>
                    <button type="submit" class="btn btn-primary" name="add_sub_name">Save changes</button>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<!-- ------------Modal For add exam rules------------------------->
<div class="modal fade" id="adddExamRules" tabindex="-1" role="dialog" aria-labelledby="adddExamRules" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add rules for students which are not allowed in examinations: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
              <label for="text">Exam Details:</label>
              <!-- <input type="text" class="form-control" id="ans_details" placeholder="Enter Correct answer details" name="ans_details"> -->
              <textarea type="text" class="form-control" id="sub_details" placeholder="Enter Exam details" name="exam_details"></textarea>
            </div>
                    <button type="submit" class="btn btn-primary" name="add_exam_details">Save changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


<!-- ---------------------------GENERATE RANDOM QUESTIONS------------------------ -->
<div class="modal fade" id="generateRndmQsn" tabindex="-1" role="dialog" aria-labelledby="generateRndmQsn" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Random question will be generated:</h3>
          <h5 class="modal-title" id="exampleModalLongTitle">Note: <span class="text-danger">Questions generated random will besaved on database along with student which are activ and not performed exams before.</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="" method="post">
        
            <h2>Enter the details for English</h2>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 1:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 1" name="english1">
            </div>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 2:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 2" name="english2">
            </div>

            <h2>Enter the details for Chemistry</h2>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 1:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 1" name="chem1">
            </div>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 2:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 2" name="chem2">
            </div>

            <h2>Enter the details for Physics</h2>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 1:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 1" name="physics1">
            </div>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 2:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 2" name="physics2">
            </div>

            <h2>Enter the details for Mathematics</h2>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 1:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 1" name="math1">
            </div>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 2:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 2" name="math2">
            </div>

            <h2>Enter the details for Engineering Aptitude Test</h2>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 1:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 1" name="aptitude1">
            </div>
            <div class="form-group">
              <label for="text">Enter Number Of Questions Containing Marks 2:</label>
              <input type="number" class="form-control" id="sub_details" placeholder="Enter Number Of Questions Containing Marks 2" name="aptitude2">
            </div>
                
              <button type="submit" class="btn btn-primary" name="qsn_generator">Save changes</button>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- -----------------------------FOR STARTING EXAM------------------------------ -->
<!-- 
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
       <form action="" method="post"> -->
        
            <!-- <h2>Enter Exam Details</h2> -->
      <!--       <div class="form-group">
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
</div> -->