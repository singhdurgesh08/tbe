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
    
    
   
	<div class="home_tab_section">
		<div class="container">
			<div class="col-md-3 footer_top_head_tile">TBF Sports gaming</div>
			<div class="col-md-3 footer_top_box">
				<div class="footer_top_tile">Store</div>
				<div>Apparel membership</div>
			</div>
			<div class="col-md-3 footer_top_box">
				<div class="footer_top_tile">Support</div>
				<div>Dispute center F.A.Q Rules</div>
			</div>
			<div class="col-md-3 footer_top_box">
				<div class="footer_top_tile">About</div>
				<div>TBE What is TBE? the community</div>
			</div>
		</div>
	</div>
<?php include "footer.php";?>