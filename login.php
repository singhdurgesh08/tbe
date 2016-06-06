<?php ob_start(); 
session_start();
 include "header.php";
include "nav_before_login.php";?>

<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1><br class="hidden-xs">Log In</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
                            <form method='post' action='login.php' class="form-horizontal">
							<fieldset>
								<div class="form-group">
									<label for="login_email" class="control-label col-sm-6">Email address</label>
									<div class="col-sm-6 input"><input name='email'  type="text" placeholder="Please Enter Email"  class="form-control" required=""></div>
								</div>
								
								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Password</label>
									<div class="col-sm-6 input"><input type='password' name='pass'  placeholder="Please Enter password"  class="form-control" required=""></div>
								</div>
							</fieldset>
							<div class="form-group">
								<label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
								<div class="col-sm-6 input text-center">
                                <button class="btn btn-lg btn-block btn-success" type="submit" name="Login" value="Login">Log in <i class="glyphicon glyphicon-chevron-right"></i></button>
								</div>
							</div>
						 </form>
						
					</div>
					<div class="col-sm-12 text-center">
						<a href="#">Forgot your password?</a> | Not Registered yet??<a href='registration.php'>Sign Up</a>
					</div>
				</div>
			</div>
 
 <?php include "footer.php";?>

<?php

include "config.php";
if (isset($_POST['Login']))
 {
	
	$email = $_POST['email'];
	$password = $_POST['pass'];

	$check_user ="select * from users where user_email ='$email' AND user_pass = '$password'";
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
			header("location: home.php");
		} 
	}
	else
	{
		echo "<script>alert('please enter Valid id and password ')</script>";
		exit();
	}
}
?>
