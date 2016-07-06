<?php 
     date_default_timezone_set('US/Eastern');
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
	  
	  $result3 = mysql_query("select *  from payments where user_id ='$userid' and payment_type ='Subscribe' and payment_status ='1' order By payment_id desc limit 1"); 
	  $row3 = mysql_fetch_array($result3);
         // print_r($row3);
          if(strtotime($row3['end_date'])){
	  $enddate = strtotime($row3['end_date']); 
          }else { $enddate ="";}
	  $currentdate = strtotime(date("Y-m-d H:i:s"));
          
         $totalcredit  = number_format($sum) - number_format($withdraw);
         $_SESSION['totalcredit'] = $totalcredit;
	  
		  
	  
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    
	<meta charset="UTF-8">
	<title>TBESportsGaming</title>
        <link rel="shortcut icon" href="<?php echo $baseurl; ?>assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo $baseurl; ?>assets/images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/jquery.dataTables.min.css">
	<script src="<?php echo $baseurl; ?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $baseurl; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--        <script src="<?php //echo $baseurl; ?>assets/js/jquery-1.12.3.min.js" type="text/javascript"></script>-->
        <script src="<?php echo $baseurl; ?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
     
        <script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/jquery.validate.min.js"></script>
        
  
</head>
<body>
<header>
        <div class="container">
                <div class="col-sm-12 login_header">
                <?php if($currentdate <  $enddate  && $enddate !=''){  $_SESSION['dimond_user'] = "dimond"; ?>
                                <img src="<?php echo $baseurl; ?>assets/images/Diamond-icon.png" width="50" class="img-responsive" title="Dimond User" alt="Dimond User" style="display:inline;" /> <?php }  else {  $_SESSION['dimond_user'] = "normal"; }?></span> 
                <span><a href="#login.php" class="btn btn-info">Credit $ <?php echo  number_format($sum,2) - number_format($withdraw,2);?> </a></span>/<span><a href="<?php echo $baseurl; ?>logout.php" class="btn btn-info">Logout</a></span>
                </div>
                <div><center><a href="home.php"><img src="<?php echo $baseurl; ?>assets/images/logo.png" class="img-responsive" alt="" style="width: 385px;border:none;"></a></center></div>
                <div></div>
        </div>
</header>
<?php 
//$detail1['amount'] = 1;
// if($_SESSION['dimond_user'] == "dimond"){
//      echo  $amount = (float)$detail1['amount'] + (float)$detail1['amount'];
//    }else {
//         $winner = $detail1['amount'] * 80 / 100;
//         echo $amount = $detail1['amount'] + (float)$winner;
//    }
?>