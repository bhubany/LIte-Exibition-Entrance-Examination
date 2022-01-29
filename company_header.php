<?php 
  require 'company_database.php';
    $query="SELECT * FROM others ";
    $result=mysqli_query($con_company,$query) or die(mysqli_error($con_company));
    while($rows=mysqli_fetch_assoc($result)) {
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Entrance -Company header</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" type="text/css" href="assests/css/myStyle.css">
</head>
<body>

<div class="container-fluid">

<header id="header">
    <div class="row">
      <div class="col-lg-2"></div>


      <!-- ----------MAIN WORKING DIVISION FOR HEADER-------------- -->
        <div class="col-lg-8 welcome-content"><br>
            <div class="logo">
               <div class="col-lg-2">
                    <a href="<?php echo($rows['company_website']); ?>" target="_blank" title="Visit <?php echo($rows['company_header']); ?>"><img src="assests/icons/<?php echo($rows['company_logo']); ?>" alt="Logo"  width="70" height="70"></a> 
                </div>

<!-- ---------------------------------TITLE--------------------------- -->
                <div class="col-lg-8 myTitle">
                  <span class="logo-title"><?php echo strtoupper($rows['company_header']); ?></span><br>
                  <span class="logo-subtitle"><?php echo $rows['company_address']; ?></span>
                </div>
<!-- ------------------------------TITLE ENDING-------------------------------- -->
            </div>
        
            <div class="col-lg-2">
                <img src="assests/icons/<?php echo($rows['company_logo']); ?>" title="<?php echo($rows['company_header']); ?>" alt="Logo of kec"  width="70" height="70">
            </div>
       <br> </div>
<!-- ------------------------ENDING OF WORKING DIV HEADER---------------- -->

        <div class="col-lg-2"></div>
    </div>
</header>
<?php } ?>