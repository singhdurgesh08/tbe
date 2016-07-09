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
 
<?php

include "config.php";
if (isset($_POST['submit']))
 {
	
	$email = trim($_POST['email']);
	$query="select * from users where user_email='$email'";
	$run = mysql_query($query);
	$count=mysql_num_rows($run);
	 if ($count==1)
	 {
           
                    $rows = mysql_fetch_array($run);
                $pass = $rows['user_pass']; //FETCHING PASS
                $to = $rows['user_email'];
                $from = "From: Admin\r\n";
                $subject = " Forgot Password";
                //  $content = "Your Password is : = " . $pass;
                $message = "
                        Hello , $email
                        <br /><br />
                         We got requested to reset for  password,
                        <br /><br />
                        <br /><br />
                        Your login Credential.
                        <br />Email    : $to 
                        <br />Password : $pass

                        <br />
                        if you have any query to Please contact me support@tbesportsgaming.com.
                        <br /><br />

                        <br /><br />
                        thank you :)<br />Support
                        ";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // More headers
                $headers .= 'From: support@tbesportsgaming.com' . "\r\n";
                $sentmail = mail($to, $subject, $message, $headers);

                if ($sentmail == 1) {

                $msg = "<div class='alert alert-success'>
                <button class='close' data-dismiss='alert'>&times;</button>
                We've sent an email to $to.
                         There you can see your detail. 
                </div>";
            } else {
                $msg = "<div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong>  this email not found. 
                </div>";
            }
}
	else {
				
				$msg = "<div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong>  this email not found. 
                </div>";
		}

}
	
?>	

<div class="container">
      <?php
    if (isset($msg)) {
        echo $msg;
    } else {
        ?>
        <div class='alert alert-info'>
            Please enter your Registered email address. You will receive Your TBE credential  via email.!
        </div>  
    <?php
}
?>
            <div class="login_form_page">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h6 class="login_title"><br class="hidden-xs"> <i class="fa fa-user" aria-hidden="true"></i> Forgot Password </h6>
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
 



   

 <?php include "footer.php";?>