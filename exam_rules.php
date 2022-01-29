
<?php 
if(!isset($_SESSION)){
    session_start();
}

  date_default_timezone_set('Asia/Kathmandu');
  $created_at=date('y-m-d h:i:s');
  $errors=array();
  $sucess=array();

  if ($_SESSION['exam_status']!=0) {
    header("Location:student_login.php");
  }
    require 'company_database.php';
                $_SESSION['exam_status']=1;
// ---------------i.e STUDENT MUST HAVE TO LOGIN TO VISIT THIS PAGE--------
// require 'student_acess.php';

    $query_exam_details="SELECT * FROM exam_details";
    $result_exam_details=mysqli_query($con_company,$query_exam_details) or die(mysqli_error($con_company));

    $start_exam_qry=@"SELECT * FROM taking_exam WHERE is_exam_performed='0'";
    $start_exam_res=mysqli_query($con_company,$start_exam_qry) or die(mysqli_error($con_company));
    while($rows_qsn=mysqli_fetch_assoc($start_exam_res)) {



    // ------------------CHECKING IS EXAM STARTED OR NOT-----------------

      if (isset($_POST['start_exam'])) {
          
          if ($rows_qsn['exam_status']==1) {
            header("Location:exam_started.php");             
          }
          else{
           // windows
           echo '<script language="javascript">';
            echo 'alert("Exam has not started yet please be patience.")';
            echo '</script>';
            }
      }
    
 ?>


<!-- ------------HEADER---------------------- -->
<?php include 'company_header.php' ?>

<head>
 <title>welcome page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href=assests/css/myStyle.css>
</head>

<!-- --------------------------------WELCOME MESSAGE--------------------------- -->
  <div class="row">
    <div class="col-lg-2"></div>
    <!-- --------------WORKING DIV------------- -->
    <div class="col-lg-8 myRules">
    	<h4 class="examstyle">Please read the following contents below carefully before starting: </h4>
     		<ul type="square" style="padding-left: 50px;">
          <?php   while($rows_details=mysqli_fetch_assoc($result_exam_details)) { ?>
            <li><?php echo $rows_details['details']; ?></li>
          <?php } ?>
     			<li>Best of Luck!</li>
     		</ul>
    	<h4 class="examstyle2">You can now take examinations:</h4>
      <form action="" method="post">
          <center>
              <button type="submit" class="btn btn-primary btn-lg" name="start_exam"><img src="">Take Examination</button>
            </center>
      </form>
      <br>
    </div>
    <div class="col-lg-2"></div>
  </div>
  



  <!-- ------------------FOOTER------------------------ -->
<?php include 'footer.php' ?>
<?php } ?>