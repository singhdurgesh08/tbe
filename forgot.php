<?php 
 include "header.php";
include "nav_before_login.php";?>
<head>
<script>
$(document).ready(function(){
  $("#login").validate({
    
        rules: {
           email: {
                required: true,
                email: true
            },
            pass: {
                required: true,
                minlength: 5
            }
        },
        
        // Specify the validation error messages
        messages: {
            email: {
                required: "Please provide a email ",
                minlength: "Please enter a valid email address"
            }
             
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
 
</head>

<div class="container">
            <div class="login_form_page">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h6 class="login_title"><br class="hidden-xs">Please Enter your email </h6>
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
					<div class="col-sm-12 text-center">
					 <a href='registration.php'>Not Registered yet</a>
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

	   
	  if($sentmail==1)

	    {
	        echo "<span style='color: #ff0000;'> Invitation Has Been Sent To Your Email Address.</span>";
	    }
	   
?>
 <?php include "footer.php";?>