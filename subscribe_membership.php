<?php 
 session_start();
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>

 <?php include "membership.php";?>


<?php

if (isset($_POST['Team_details'])) 
	{
		 
	}
if (isset($_POST['Delete'])) 
	{
		//Delete also remains.		
	}
?>



<?php
include "footer.php";
?>