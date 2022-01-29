<?php
  
// ---------------i.e STUDENT MUST HAVE TO LOGIN TO VISIT THIS PAGE--------
require 'company_database.php';
// require 'student_acess.php';

// $_SESSION['exam_status']=1;
if ($_SESSION['exam_status']!=1) {
  header("Location:exam_rules.php");
}
  $_SESSION['exam_status']=2;

$start_exam_qry=@"SELECT * FROM taking_exam WHERE exam_status='1' AND is_exam_performed='0'";
$start_exam_res=mysqli_query($con_company,$start_exam_qry) or die(mysqli_error($con_company));
while($rows_qsn=mysqli_fetch_assoc($start_exam_res)) {
  $_SESSION['exam_set']=$rows_qsn['exam_set'];
  $exam_set=$_SESSION['exam_set'];

  $sel_qsn=@"SELECT * FROM question_collections WHERE sub_id='$exam_set' ";
  $sel_qsn_res=mysqli_query($con_company,$sel_qsn) or die(mysqli_error($con_company));
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>ONLINE ENTRANCE -EXAM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assests/css/myStyle.css">

<script type="text/javascript">
  function timeout()
  {
    var hours=Math.floor(timeLeft/3600);
    var minute=Math.floor((timeLeft-(hours*60*60)-30)/60);
    if (minute==-1) {
      var minute=0;
    }
    var second=timeLeft%60;
    var hrs=checktime(hours);
    var mint=checktime(minute);
    var sec=checktime(second);
    if(timeLeft<=0)
    {
      clearTimeout(tm);
      document.getElementById("form1").submit();
    }
    else
    {

      document.getElementById("time").innerHTML=hrs+":"+mint+":"+sec;
    }
    timeLeft--;
    var tm= setTimeout(function(){timeout()},1000);
  }
  function checktime(msg)
  {
    if(msg<10)
    {
      msg="0"+msg;
    }
    return msg;
  }
  </script>


</head>
<body onload="timeout()">

<div class="container-fluid">

<!-- ------------------------------------HEADER FOR COLLEGE OR SCHOOLS------------------------------- -->
<?php include 'company_header.php'; ?>


<!-- ----------------------------EXAM DETAILS---------------------- -->
<nav class="nav">
   <div class="row">
      <div class="col-lg-2"></div>
  
  <!-- ----------MAIN WORKING DIVISION FOR HEADER-------------- -->
        <div class="col-lg-8 nav-exam-content">
            <span class="nav-title"> ONLINE MODEL ENTRANCE TEST</span>
        </div>

        <div class="col-lg-2"></div>
    </div>
</nav>

<!-- --------------- EXAM DETAILS-------------------- -->
<nav class="nav">
   <div class="row">
      <div class="col-lg-2"></div>
  
  <!-- ----------MAIN WORKING DIVISION FOR HEADER-------------- -->
        <div class="col-lg-8 nav-exam-condition">
            <span class="pull-left"> <?php echo $stu_name; ?></span>
            <span class="pull-myCentre"> You have answered 5 out of 10</span>
            <span class="pull-right"> Time remaining: <span id="time">Remaining Time</span></span>
            <script type="text/javascript">
                var timeLeft=60*60*<?php echo $rows_qsn['exam_time']; ?>+(5); 
            </script>
            <!-- Replace 1 with exam_time using php -->
        </div>

        <div class="col-lg-2"></div>
    </div>
</nav>

<!-- -------------------------ENDING DIV OF MAIN HEADING------------------------ -->


<!-- -------------------------OBJECTIVE QUESTIONS FOR EXAMS------------------ -->

<!-- <nav class="nav"> -->
<div class="row">
      <div class="col-lg-2"></div>


      <!-- ----------MAIN WORKING DIVISION FOR HEADER-------------- -->
        <div class="col-lg-8 myObjQuestions">    
          <div class="">
             <form  method="post" id="form1" action="exam_submitted.php">

    <input type="hidden" name="field_id" value="<?php echo $field_id; ?>">
    <input type="hidden" name="set_id" value="<?php echo $set_id; ?>"><br>
      <?php $i=0; while($qsn_rows=mysqli_fetch_assoc($sel_qsn_res)) {?>
  <table class="">
      <thead>
          <tr class="question_header">
            <th><?php echo $qsn_rows['qsn_no'].". ". $qsn_rows['sub_qsn']; ?></th>
          </tr>
      </thead>
      <tbody>
        <?php if (isset($qsn_rows['optn_a'])) { ?>
        <tr class="question_option">
        <td>&nbsp;a.&emsp;<input type="radio" name="<?php echo $qsn_rows['qsn_no']; ?>" value="a">&nbsp;<?php echo $qsn_rows['optn_a']; ?></td>
        </tr>
        <?php } ?>
        <?php if (isset($qsn_rows['optn_a'])) { ?>
        <tr class="question_option">
        <td>&nbsp;b.&emsp;<input type="radio" name="<?php echo $qsn_rows['qsn_no']; ?>" value="b">&nbsp;<?php echo $qsn_rows['optn_b']; ?></td>
        </tr>
        <?php } ?>
        <?php if (isset($qsn_rows['optn_a'])) { ?>
        <tr class="question_option">
        <td>&nbsp;c.&emsp;<input type="radio" name="<?php echo $qsn_rows['qsn_no']; ?>" value="c">&nbsp;<?php echo $qsn_rows['optn_c']; ?></td>
        </tr>
        <?php } ?>
        <?php if (isset($qsn_rows['optn_a'])) { ?>
        <tr class="question_option">
        <td>&nbsp;d.&emsp;<input type="radio" name="<?php echo $qsn_rows['qsn_no']; ?>" value="d">&nbsp;<?php echo $qsn_rows['optn_d']; ?></td>
        </tr>
        <?php } ?>
        <?php if (isset($qsn_rows['optn_a'])) { ?>
        <tr class="question_option">
        <td><input type="radio" checked="checked" style="display: none;" name="<?php echo $qsn_rows['qsn_no']; ?>" value="no_attempt"></td>
        </tr><br>
        <?php } ?>
      </tbody>
    </table>
  <?php $i++; } ?>
  <input type="hidden" name="total_question" value="<?php echo $i; ?>"><br>
  <center><button type="submit" class="btn myLoginBtn" name="completed_submit">SUBMIT ANSWER</button></center>
  </form>
          </div>
        </div>
<!-- ------------------------ENDING OF WORKING DIV HEADER---------------- -->

        <div class="col-lg-2"></div>
    </div>
<!-- </nav> -->
<?php } ?>