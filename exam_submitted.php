<?php 
if(!isset($_SESSION)){
    session_start();
}

if ($_SESSION['exam_status']!=2) {
	header("Location:exam_started.php");
}
$_SESSION['exam_status']=3;

if (isset($_POST['return_to_home'])) {
	header("Location:student_login.php");
}

$user_res="";
$Sucess="";
	date_default_timezone_set('Asia/Kathmandu');
	require 'company_database.php';
	$created_at=date('y-m-d h:i:s');
	$errors=array();
	$sucess=array();

	$stu_uname=$_SESSION['stu_username'];
	$stu_id=$_SESSION['stu_id'];

if (isset($_POST['completed_submit'])) {
  	$_SESSION['exam_status']=2;
  	$_SESSION['save_res']=0;
  	$_SESSION['exam_status']=2;
}

$set_id=$_SESSION['exam_set'];

$marks=0;
$wright=0;
$wrong=0;
$no_attempt=0;
$total_marks=0;
$wright_per='';

$query=@"SELECT qsn_no,correct_optn,cntng_marks FROM question_collections WHERE sub_id='$set_id'";
$result=mysqli_query($con_company,$query) or die(mysqli_error($con_company));
while ($rows=mysqli_fetch_assoc($result)) {
	$total_marks=$total_marks+$rows['cntng_marks'];

	if ($rows['correct_optn']==$_POST[$rows['qsn_no']]) {
		$wright=$wright+1;
		$user_res=$user_res.$_POST[$rows['qsn_no']];
		$marks=$marks+(1*$rows['cntng_marks']);
		
	}
	else if ($_POST[$rows['qsn_no']]=="no_attempt") {
		$no_attempt=$no_attempt+1;
		$user_res=$user_res.'n';
	}
	else {
		$wrong=$wrong+1;
	}
}
$total_qsn=$wright+$wrong+$no_attempt;
if ($total_marks!=0) {
$wright_per=($marks*100)/($total_marks);
}

$attempt=$wright+$wrong;
if ($total_qsn!=0) {
$attempt_perc=($attempt*100)/$total_qsn;
}
if ($wright_per>=90) {
	$rem="OUTSTANDING";
}
elseif ($wright_per>=80 && $wright_per<90) {
	$rem="VERY GOOD";
}
elseif ($wright_per>=70 && $wright_per<80) {
	$rem="GOOD";
}
elseif ($wright_per>=60 && $wright_per<70) {
	$rem="FAIR";
}
elseif ($wright_per>=50 && $wright_per<60) {
	$rem="AVERAGE";
}
elseif ($wright_per>=40 && $wright_per<50) {
	$rem="BELOW AVERAGE";
}
else{
	$rem="FAIL";
}

	session_destroy();
?>




<?php include 'header.php' ?>
<!-- --------------HEADER---------------------- -->

<head>
  <title>Answer has been submitted</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assests/css/style.css">
</head>


<div class="row">
	<div class="col-lg-2"></div>

	<div class="col-lg-8 myContainer">
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
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<div class="myForm">
		  		<span class="myFormTitle"><h2>Your have sucessfully completed your exam</h2></span>
		  		<h3 class="myFormTitle">For result consult to your particular college or institute</h3>
		  		<h1 class="myFormTitle">Thank You!!!</h1>

	  		<div class="myReturnToHome">
	  			<form method="post">
	  				<button type="submit" class="btn btn-default myLoginBtn" name="return_to_home">Return To home</button>
	  			</form>
	  		</div>
	  		</div>
  	</div>
  	<div class="col-lg-3"></div>
	</div>

	<div class="col-lg-2"></div>
</div>


<!-- -------------FOOTER------------- -->
<?php include 'footer.php' ?>


<!-- -----------------SAVING RESULT TO DATABASE---------------------- -->

<?php
if ($_SESSION['save_res']==0) {
$insert_res=@"INSERT INTO exam_qsn_details(user_id,stu_username,question,submitted_answer,trn_date)
VALUES('$stu_id','$stu_uname','$set_id','$user_res','$created_at') LIMIT 1";
$result_insert_res=mysqli_query($con_company,$insert_res) or die (mysqli_error($con_company));
      if ($result_insert_res==1) {
        $success="Result has been saved to database";
        $_SESSION['save_res']=1;
      }
      else{
        array_push($errors,"error occur while submitting results");
      }

}?>