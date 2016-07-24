<?php 
 session_start();
 //include "constant.php";
include "login-header.php";
 include "nav.php";
include "config.php"; 
//Store transaction information from PayPal
//echo "<pre>"; print_r($_GET);
$item_number = $_GET['item_number']; 
$txn_id = $_GET['tx'];
$payment_gross = $_GET['amt'];
$currency_code = $_GET['cc'];
$payment_status = $_GET['st'];
$payid = $_GET['payid'];
$payid = encryptor('decrypt',$payid);
if($payid){
      mysql_query("UPDATE `payments` SET `txn_id`='$txn_id', `payment_status`='1' WHERE `payment_id`='$payid'");
}
?>
<div class="home_tab_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
               <h4>Your Payment was successful.</h4>
                <!--<h1>Your Payment ID - <?php echo $txn_id; ?>.</h1>
	<h1>Your Payment Status - <?php echo $payment_status; ?>.</h1> -->
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <p>  Thank you for your payment. Your transaction has been completed .</p>
            </div>

        </div>
        
       
    </div>
    <div class="row">
        <div class="col-sm-8"> &nbsp;  </div>
    </div>
      <div class="row">
        <div class="col-sm-8"> &nbsp;  </div>
    </div>
      <div class="row">
        <div class="col-sm-8"> &nbsp;  </div>
    </div>
      <div class="row">
        <div class="col-sm-8"> &nbsp;  </div>
    </div>
      <div class="row">
        <div class="col-sm-8"> &nbsp;  </div>
    </div>
      <div class="row">
        <div class="col-sm-8"> &nbsp;  </div>
    </div>
      <div class="row">
        <div class="col-sm-8"> &nbsp;  </div>
    </div>
     
</div>
 
	
<?php
include "footer.php";
?>


