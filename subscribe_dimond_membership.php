<?php 
 session_start();
if($_SESSION['user_data']['user_name'] ==''){
header("location: login");
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
	$currentdate = date("Y-m-d H:i:s");
	$enddate = date('Y-m-d H:i:s', strtotime($currentdate . "+1 months") );

 $query = " INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
`user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
VALUES (null, 'diamond membership', '1', 'subscribe', '$userid', '$amount', 'USD', '0', now(), '$email',now(),'$enddate') ";
mysql_query($query); 

 $lastisertId =  mysql_insert_id();
	

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
                $lastisertId =  encryptor('encrypt',$lastisertId)
	?>
<div class="home_tab_section">
    <div class="container">
   <!-- <div class="row">
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
       
    </div>-->
   <div class="row">
   <div class="col-sm-12 text-center">
   
    <form action="<?php echo $paypal_url; ?>" method="post" id="subscribe_pay">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $row['item_number']; ?>">
        <input type="hidden" name="item_number" value="<?php echo $row['payment_id']; ?>">
        <input type="hidden" name="amount" value="<?php echo $row['payment_gross']; ?>">
        <input type="hidden" name="currency_code" value="USD">
         <INPUT TYPE="hidden" name="charset" value="utf-8">
        <!-- Specify URLs -->
          <input type='hidden' name='cancel_return' value='<?php echo HOSTNAME; ?>cancel?payid=<?php echo $lastisertId ;?>'>
    	 <input type='hidden' name='return' value='<?php echo HOSTNAME; ?>success?payid=<?php echo $lastisertId ;?>'>

<!--        <input type="image" name="submit" border="0"
        src="<?php echo HOSTNAME; ?>assets/images/paypal_paynow.png" alt="PayPal - The safer, easier way to pay online">-->
        <br/>
        <br/>
        <br/>
        <br/>
        <img alt="" border="0"  src="<?php echo HOSTNAME; ?>assets/images/ajax-loader2.gif" >  Please Wait we are are redirecting to Paypal.....
    
      </form>
	</div>
					
	</div>
        </div>
    </div>
    <?php // } 
		
	}
	else
	{
		header("location: wallet.php");
		exit();
	}
}
?>
<script>
$( "#subscribe_pay" ).submit();

</script>
<?php
include "footer.php";
?>
