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
	
	$email = $_POST['email'];
	$query="select * from users where user_email='$email'";
	$run = mysql_query($query);
	$count=mysql_num_rows($run);
	//print_r($count);die();

	
	if ($count==1)
	 {
					ini_set("SMTP", "smtp.server.com");
						$rows=mysql_fetch_array($run);
						$pass  =  $rows['user_pass'];//FETCHING PASS
					    $to = $rows['user_email'];
				        $from =  "From: Admin\r\n";
				        $subject = " Password recovered";
					    $content = "Your Password is : = " . $pass;
					    $headers1 = "From: $from\n";
					    $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
					    $headers1 .= "X-Priority: 1\r\n";
					    $headers1 .= "X-MSMail-Priority: High\r\n";
					    $headers1 .= "X-Mailer: Just My Server\r\n";
					    $sentmail = mail ( $to, $subject, $content, $headers1 );

					    if ($sentmail==1) {
					    	
					    	echo"<script>alert('Your password sent to your emailid')</script>";
					    }
					    else
					    {
					    	echo"<script >alert('Problem to send your password')</script>";
					    }


	}
	else {
				
				echo"<script>alert('Entered email id not valid ')</script>";
		}

}
	
?>	   

 <?php include "footer.php";?>