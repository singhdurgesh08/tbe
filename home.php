<?php 
 session_start();
 if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
 //echo "<pre>"; print_r($_SESSION);
include "login-header.php";?>
<?php include "nav.php";?>
<?php// echo 'Welcome to TBS'?>
	
	<div class="">
		<div class="container">
		<div class="col-sm-12"><img src="images/homepage.png" class="img-responsive" alt="" height="300" width="1200"></div>
			
		</div>
	</div>
    
    <?php include "membership.php";?>
    
    
   
	
<?php include "footer.php";?>