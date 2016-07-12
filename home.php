<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/57838e621ca3e686763cca2e/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->



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