<?php 
 session_start();
if($_SESSION['user_data']['user_name'] ==''){
header("location: login.php");
exit();
}
 //include "constant.php";
include "login-header.php";
 include "nav.php";
include "config.php"; 

?>

<?php
//Set useful variables for paypal form
$paypal_url = PAYURL; //Test PayPal API URL
$paypal_id = PAYEMAIL; //Business Email

if (isset($_POST['add']))
 {
	$email = $_SESSION['user_data']['user_email'];
	$userid = $_SESSION['user_data']['id'];
	$amount = $_POST['add_amount'];
	$query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
`user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`) 
VALUES ('', 'ADD Wallet', '1', 'ADD', '$userid', '$amount', 'USD', '0', CURRENT_TIMESTAMP, '$email')";
mysql_query($query); 

 $lastisertId =  mysql_insert_id();;
	

	$payment ="select * from payments where payment_id ='$lastisertId'";
	$run = mysql_query($payment);
	if(mysql_num_rows($run)>0)
	{
		
		$row = mysql_fetch_assoc($run);
		
		//fetch products from the database
		//$results = $db->query("SELECT * FROM products");
		//while($row = mysql_fetch_assoc($run))
		//{
			//echo "<pre>"; print_r($row);
	?>
    <div class="row">
       <div class="col-sm-12 text-center">
               <h2>Deposit Funds in TBE Player Account</h2>
       </div>
       
    </div>
        <div class="row">
        <div class="col-sm-4 text-center">
          <h1></h1>
        </div>
        <div class="col-sm-4 text-center">
        <b>Price: <?php echo $row['payment_gross']; ?></b>
        </div>
        <div class="col-sm-4 text-center">
        <h1></h1>
        </div>
        </div>
       <div class="row">
        <div class="col-sm-4 text-center">
        <h1></h1>
        </div>
        <div class="col-sm-4 text-center">
         <b>Name: <?php echo $row['item_number']; ?></b>
        </div>
        <div class="col-sm-4 text-center">
         <h1></h1>
        </div>
        </div>
      <div class="row">
        <div class="col-sm-4 text-center">
        <h1></h1>
        </div>
        <div class="col-sm-4 text-center">
         <h1>Pay by Paypal</h1> 
        </div>
        <div class="col-sm-4 text-center">
         <h1></h1>
        </div>
        </div>
<div class="row">
       <div class="col-sm-12 text-center">
               <h2>Amount to Send : (Fee of 3 % + $0.30 USD Applies )</h2>
       </div>
       
    </div>
   <div class="row">
   <div class="col-sm-12 text-center">
   
    <form action="<?php echo $paypal_url; ?>" method="post">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $row['item_number']; ?>">
        <input type="hidden" name="item_number" value="<?php echo $row['payment_id']; ?>">
        <input type="hidden" name="amount" value="<?php echo $row['payment_gross']; ?>">
        <input type="hidden" name="currency_code" value="USD">
        
        <!-- Specify URLs -->
          <input type='hidden' name='cancel_return' value='<?php echo HOSTNAME; ?>cancel.php?payid=<?php echo $lastisertId ;?>'>
		<input type='hidden' name='return' value='<?php echo HOSTNAME; ?>success.php?payid=<?php echo $lastisertId ;?>'>

        
        <!-- Display the payment button. -->
        <input type="image" name="submit" border="0"
        src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
        <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
    
    </form>
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
