<?php
include "config.php"; 
$post_data_string = serialize($_POST);
$headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From:support@tbesportsgaming.com' . "\r\n";
mail('durgeshmca3@gmail.com', 'PayPal IPN Response', $post_data_string,$headers,'-f durgeshmca3@gmail.com');
$payid = $_POST['item_number'];
$txn_id = $_POST['item_number'];

if($payid){
      mysql_query("UPDATE `payments` SET `txn_id`='$txn_id', `payment_status`='1' WHERE `payment_id`='$payid'");
}

?>