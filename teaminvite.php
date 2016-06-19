<?php
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";
include "nav.php";
include "config.php";
?>

<div class="container">
            <div class="login_form_page">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h6 class="login_title"><br class="hidden-xs">Team invite's </h6>
					</div>
				</div>
				
				<div class="row">
				    	<div class="col-sm-12">
                            <form method='post' id="login" class="form-horizontal login_form">
							<fieldset>
								<div class="form-group">
									<div class="col-sm-12 input"><input name='email'  type="text" placeholder="Please Enter Email"  class="form-control email" required=""></div>
								</div>
						
							<div class="form-group">
								<div class="col-sm-12 input text-center">
                                <button class="btn btn-md btn-block btn-success" type="submit" name="submit" value="submit">Submit <i class="glyphicon glyphicon-chevron-right"></i></button>
								</div>
							</div>
				
						 </form>
					
						</fieldset>   
					</div>
					
                   
				</div>
            </div>
</div>
 


<?php
session_start();
include "config.php";
if (isset($_POST['submit']))
 {
	//echo "hello";die();
	$email = $_POST['email'];
	
	$query="select * from users where user_email='$email'";
	$run = mysql_query($query);
	$count=mysql_num_rows($run);
	
	if ($count==1)
	 {
		$rows=mysql_fetch_array($run);
		$pass  =  $rows['user_pass'];//FETCHING PASS
	    $to = $rows['user_email'];
        $from = "Coding Cyber";
        $url = "http://www.codingcyber.com/";
	    $body  =  "Coding Cyber password recovery Script
	      Url : $url;
	      email Details is : $to;
	      Here is your password  : $pass;
	      Sincerely,
	      Coding Cyber";
	    $from = "Your-email-address@domaindotcom";

	        $subject = "CodingCyber Password recovered";
	        $headers1 = "From: $from\n";
	        $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
	    	$headers1 .= "X-Priority: 1\r\n";
	        $headers1 .= "X-MSMail-Priority: High\r\n";
	        $headers1 .= "X-Mailer: Just My Server\r\n";
	        $sentmail = mail ( $to, $subject, $body, $headers1 );

	}
	else {

	    if ($_POST ['email'] != "") {

	    	   echo "<span style='color: #ff0000;'>Email no found in your Database</span>";
	        } }

	  if($sentmail==1)

	    {
	        echo "<span style='color: #ff0000;'> Invitation Has Been Sent To Your Email Address.</span>";
	    }
	    else

	        {

	        if($_POST['email']!="")

	        echo "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
	    }
}
?>
 <?php include "footer.php";?>