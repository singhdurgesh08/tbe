<?php ob_start(); 
session_start();
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
            },
             pass: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
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
if (isset($_POST['Login']))
 {
	
	$email = $_POST['email'];
	$password = $_POST['pass'];

	$check_user ="select * from users where user_email ='$email' AND user_pass = '$password' and status = '1'";
	$run = mysql_query($check_user);
	if(mysql_num_rows($run)>0)
	{
		$_SESSION['email']=$email;
		$_SESSION['id']=$id;
		
		$user_check=$_SESSION['email'];
		$ses_sql=mysql_query("select * from users where user_email='$user_check'");
		$row = mysql_fetch_assoc($ses_sql);
		$login_session =$row['user_email'];

		$userid =$row['id'];
	
		if(isset($login_session))
		{
			$_SESSION['user_data'] =  $row; // Initializing Session
			header("location: home");
		} 
	}
	else
	{
            $msg = "<div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong>  please enter Valid Email and password . 
                </div>";
		
	}
}
?>

<div class="container">
      <?php
    if (isset($msg)) {
        echo $msg;
    }  ?>
            <div class="login_form_page">
				<div class="row">
					<div class="col-sm-12">
						<h1 class="login_title text-center"><i class="fa fa-user" aria-hidden="true"></i> Log In</h1>
					</div>
				</div>
				<div class="row">
				    
					<div class="col-sm-12">
                           
                               <form method='post' action='login.php' id="login" class="form-horizontal login_form">
							<fieldset>
								<div class="form-group">
<!--									<label for="login_email" class="control-label col-sm-6">Email address</label>-->
									<div class="col-sm-12 input"><input name='email'  type="text" placeholder="Please Enter Email"  class="form-control email" required=""></div>
								</div>
								
								<div class="form-group">
<!--									<label for="login_password" class="control-label col-sm-6">Password</label>-->
									<div class="col-sm-12 input"><input type='password' name='pass'  placeholder="Please Enter password"  class="form-control" required=""></div>
								</div>
							</fieldset>
							<div class="form-group">
								<div class="col-sm-12 input text-center">
                                <button class="btn btn-md btn-block btn-success" type="submit" name="Login" value="Login">Log in <i class="glyphicon glyphicon-chevron-right"></i></button>
								</div>
							</div>
						 </form>
						   
					</div>
					<div class="col-sm-12 text-center">
						<a href="forgot">Forgot your password?</a> | Not Registered yet?<a href='registration'>Sign Up</a>
					</div>
                   
				</div>
            </div>
</div>
 
 <?php include "footer.php";?>


