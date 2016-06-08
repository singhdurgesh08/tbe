<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
	include "constant.php";
	$baseurl = HOSTNAME; ?>
	<meta charset="UTF-8">
	<title>TBF Sports gaming</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/style.css">
	<script src="<?php echo $baseurl; ?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $baseurl; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
	<header>
		<div class="container">
			<div class="col-sm-12 login_header">
				<span><a href="<?php echo $baseurl; ?>login.php">login</a></span>/<span><a href="<?php echo $baseurl; ?>registration.php">Signup</a></span>
			</div>
			<div><a href="index.php"><center><img src="<?php echo $baseurl; ?>assets/images/logo.png" class="img-responsive" alt="" style="width: 385px;border:none;"></a></center></div>
		</div>
	</header>
	