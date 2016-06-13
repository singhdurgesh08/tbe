<?php
   error_reporting(0);
	include "constant.php";
	$baseurl = HOSTNAME;
    $userid = $_SESSION['user_data']['id'];

	//$rows = mysql_fetch_row($run1);
	include "config.php"; 
	 $result = mysql_query("select sum(payment_gross) AS value_sum from payments where user_id ='$userid' and payment_type ='ADD' and payment_status ='1'"); 
	  $row = mysql_fetch_array($result);
      $sum = $row['value_sum'];
	  
	  $result2 = mysql_query("select sum(payment_gross) AS value_sum_withdraw from payments where user_id ='$userid' and payment_type ='Withdrawal' and payment_status ='1'"); 
	  $row2 = mysql_fetch_array($result2);
      $withdraw = $row2['value_sum_withdraw']; 
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    
	<meta charset="UTF-8">
	<title>TBF Sports gaming</title>
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/jquery.dataTables.min.css">
	<script src="<?php echo $baseurl; ?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $baseurl; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--        <script src="<?php //echo $baseurl; ?>assets/js/jquery-1.12.3.min.js" type="text/javascript"></script>-->
        <script src="<?php echo $baseurl; ?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
     
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
        
  
</head>
<body>
<header>
        <div class="container">
                <div class="col-sm-12 login_header">
                        <span><a href="#login.php" class="btn btn-info">Credit $ <?php echo  number_format($sum) - number_format($withdraw);?> </a></span>/<span><a href="<?php echo $baseurl; ?>logout.php" class="btn btn-info">Logout</a></span>
                </div>
                <div><center><a href="home.php"><img src="<?php echo $baseurl; ?>assets/images/logo.png" class="img-responsive" alt="" style="width: 385px;border:none;"></a></center></div>
                <div></div>
        </div>
</header>
