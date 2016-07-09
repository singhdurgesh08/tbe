<?php  error_reporting(0);
 session_start();
 if ($_SESSION['user_data']['user_name'] != '') {
    header("location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
	include "constant.php";
	$baseurl = HOSTNAME; ?>
	<meta charset="UTF-8">
	<title>TBESportsGaming</title>
        <link rel="shortcut icon" href="<?php echo $baseurl; ?>assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo $baseurl; ?>assets/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/style.css">
	<script src="<?php echo $baseurl; ?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $baseurl; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo $baseurl; ?>assets/js/jquery-latest.js"></script>
       <script type="text/javascript" src="<?php echo $baseurl; ?>assets/js/jquery.validate.min.js"></script>
</head>
<body>
	<header>
		<div class="container">
			<div class="col-sm-12 login_header">
				<span><a href="<?php echo $baseurl; ?>login.php" class="btn btn-info"><span class="glyphicon glyphicon-log-in"></span>Login</a></span>/<span><a href="<?php echo $baseurl; ?>registration.php" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> Signup</a></span>
			</div>
			<div><a href="index.php"><center><img src="<?php echo $baseurl; ?>assets/images/logo.png" class="img-responsive" alt="" style="width: 385px;border:none;"></a></center></div>
		</div>
	</header>
	