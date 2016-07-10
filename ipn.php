<?php

   // Send an empty HTTP 200 OK response to acknowledge receipt of the notification
   header('HTTP/1.1 200 OK');
// read the IPN notification from PayPal and add the 'cmd' parameter to the beginning of the acknowledgement you will send back
$req = 'cmd=_notify-validate';

// Loop through the notification name-value pairs
foreach ($_POST as $key => $value) {
	// Encode the values
    $value = urlencode(stripslashes($value));
    // Add the name-value pairs to the acknowledgement
    $req .= "&$key=$value";
}
// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";

// Set up other acknowledgement request headers
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

// If testing on Sandbox use:
$header .= "Host: www.sandbox.paypal.com:443\r\n";
// For live servers use $header .= "Host: www.paypal.com:443\r\n";

// Open a socket for the acknowledgement request
// If testing on Sandbox use:
$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
// For live servers use $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

// Send the HTTP POST request back to PayPal for validation
fputs($fp, $header . $req);
//Parse PayPal's response to your acknowledgement to determine whether the original not

while (!feof($fp)) {
		// While not EOF
		$res = fgets($fp, 1024);
		// Get the acknowledgement response
		if (strcmp ($res, "VERIFIED") == 0) {  
			// Response contains VERIFIED - process notification
			// Send an email announcing the IPN message is VERIFIED
			$mail_From    = "durgeshmca3@gmail.com";
			$mail_To      = "durgesh.singh@inetglobaltech.com";
			$mail_Subject = "VERIFIED IPN";
			$mail_Body    = $req;
			mail($mail_To, $mail_Subject, $mail_Body, $mail_From);
			// Authentication protocol is complete - OK to process notification contents
			// Possible processing steps for a payment include the following:
			// Check that the payment_status is Completed
			// Check that txn_id has not been previously processed
			// Check that receiver_email is your Primary PayPal email
			// Check that payment_amount/payment_currency are correct
			// Process payment
		} else if (strcmp ($res, "INVALID") == 0) { 
			//Response contains INVALID - reject notification
			// Authentication protocol is complete - begin error handling
			// Send an email announcing the IPN message is INVALID
			$mail_From    = "durgeshmca3@gmail.com";
			$mail_To      = "durgesh.singh@inetglobaltech.com";
			$mail_Subject = "INVALID IPN";
			$mail_Body    = $req;
			mail($mail_To, $mail_Subject, $mail_Body, $mail_From);
		}
fclose ($fp);
}
?>




                