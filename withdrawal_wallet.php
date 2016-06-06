<?php 
 session_start();
 //include "constant.php";
include "login-header.php";
 include "nav.php";
include "config.php"; 
?>

<?php
//Set useful variables for paypal form
$paypal_url = PAYURL; //Test PayPal API URL
$paypal_id = PAYEMAIL; //Business Email

if (isset($_POST['withdrawal']))
 {
	$email = $_POST['email'];
	$userid = $_SESSION['user_data']['id'];
	$amount = $_POST['add_amount'];
	$query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
`user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`) 
VALUES ('', 'Withdrawal Wallet', '1', 'Withdrawal', '$userid', '$amount', 'USD', '1', CURRENT_TIMESTAMP, '$email')";
mysql_query($query); 

 $lastisertId =  mysql_insert_id();;
	

	$payment ="select * from payments where payment_id ='$lastisertId'";
	$run = mysql_query($payment);
	if(mysql_num_rows($run)>0)
	{
		
		$row = mysql_fetch_assoc($run);
		
		
	?>
  <div class="row">
<div class="col-sm-12 text-center">
<h1>Your payment has been Withdrawal from Wallet .</h1>
    <!--<h1>Your Payment ID - <?php echo $txn_id; ?>.</h1>
	<h1>Your Payment Status - <?php echo $payment_status; ?>.</h1> -->
</div>
					
	</div>
    <?php // } 
		
	}
	else
	{
		echo "<script>alert('Enter valid Amount ')</script>";
		header("location: wallet.php");
		exit();
	}
}
?>

<?php
include "footer.php";
?>
