<?php ob_start(); 
session_start();
include "header.php";
include "nav_before_login.php";?>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
		<script>
		var rootpath = '<?php echo HOSTNAME; ?>';
		</script>
        <script src="<?php echo HOSTNAME; ?>assets/js/jquery.timepicker.js" type="text/javascript"></script>
		 <script src="<?php echo HOSTNAME; ?>assets/js/location.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo HOSTNAME; ?>assets/css/jquery.timepicker.css" />

        <script>


            $(function() {
                $("#DOB").datepicker();
            });


        </script>
<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1><br class="hidden-xs">Sign up</h1>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-8">
                            <form method='post' action='registration.php' class="form-horizontal">
							<fieldset>
								<div class="form-group">
									<label for="login_email" class="control-label col-sm-6">User Name</label>
									<div class="col-sm-6 input"><input name='name'  type="text" placeholder="Please Enter User Name"  class="form-control" required=""></div>
								</div>
								
								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">User Email</label>
									<div class="col-sm-6 input"><input name='email'  placeholder="Please Enter Email"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">User Password</label>
									<div class="col-sm-6 input"><input type='password' name='pass'  placeholder="Please Enter password"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Address</label>
									<div class="col-sm-6 input"><input name='Address'  placeholder="Please Enter Address"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">DOB</label>
									<div class="col-sm-6 input"><input name='DOB' id='DOB' placeholder="Please Enter DOB"  class="form-control" required=""></div>
								</div>

<!--                                                            <div class="form-group">
                                                                <label for="login_password" class="control-label col-sm-6">Membership</label>
                                                                <div class="col-sm-6 input"> <select name="Membership" id="Membership"  class="form-control" >
                                                                        <option value="Free">Free</option>
                                                                        <option value="Diamond_membership">Diamond Membership</option>
                                                                    </select></div>
                                                            </div>-->
<!--								<div class="form-group"> 
								
								<label for="country" class="control-label col-sm-6">Country</label>
								<div class="col-sm-6"><select name="Country" class="form-control countries" id="countryId" required="required">
								<option value="">Select Country</option>
								</select>
								</div>
								</div>
								<div class="form-group"> 
								<label for="state" class="control-label col-sm-6">State</label>
								<div class="col-sm-6">
								<select name="State" class="form-control states" id="stateId" required="required">
								<option value="">Select State</option>
								</select>
								</div>
								</div>
								<div class="form-group"> 
								<label for="city" class="control-label col-sm-6">City</label>
								<div class="col-sm-6">
								<select name="city" class="form-control cities" id="cityId" required="required">
								<option value="">Select City</option>
								</select>
								</div>
								</div>-->
                                                                 <div class="form-group">
									<label for="Country" class="control-label col-sm-6">Country</label>
									<div class="col-sm-6 input"><input name='Country'  placeholder="Please Enter Country"  class="form-control" required=""></div>
								</div>
                                                                <div class="form-group">
									<label for="State" class="control-label col-sm-6">State</label>
									<div class="col-sm-6 input"><input name='State'  placeholder="Please Enter State"  class="form-control" required=""></div>
								</div>

                                                               <div class="form-group">
									<label for="city" class="control-label col-sm-6">City</label>
									<div class="col-sm-6 input"><input name='city'  placeholder="Please Enter city"  class="form-control" required=""></div>
								</div>
								<div class="form-group">
									<label for="pin" class="control-label col-sm-6">Pin</label>
									<div class="col-sm-6 input"><input name='Pincode'  placeholder="Please Enter Pin"  class="form-control" required=""></div>
								</div>
								
								
								
								
							</fieldset>
                         <div class="form-group">
								<label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
								<div class="col-sm-6 input text-center">
                                <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Sign Up">Sign Up <i class="glyphicon glyphicon-chevron-right"></i></button>
								</div>
							</div>
						 </form>
							
					</div>
					<div class="col-sm-12 text-center">
						<p><input type="checkbox" required name="terms"> I accept the Privacy <u>Terms and Conditions</u></p>
					</div>
				</div>

</div>



 <?php include "footer.php";?>
<?php
include "config.php";

if(isset($_POST['submit']))
				{
					 $user_name = $_POST['name'];
					 $user_email = $_POST['email'];
					 $user_pass = $_POST['pass'];
					 $Address = $_POST['Address'];
					 $DOB = $_POST['DOB'];
					 $State = $_POST['State'];
					 $Country = $_POST['Country'];
					 $Membership = "1";

				if($user_name=='') {
					echo "<script>alert('please enter your name')</script>";
					exit();
				}

				if($user_email=='') {
					echo "<script>alert('please enter your email')</script>";
					exit();
				}

				if($user_pass=='') {
					echo "<script>alert('please enter your password')</script>";
					exit();
				}
				if($Address=='') {
					echo "<script>alert('please enter your Address')</script>";
					exit();
				}
				if($DOB=='') {
					echo "<script>alert('please enter your DOB')</script>";
					exit();
				}
				if($State=='') {
					echo "<script>alert('please enter your State')</script>";
					exit();
				}
				if($Country=='') {
					echo "<script>alert('please enter your Country')</script>";
					exit();
				}




				$check_email="select * from users where user_email ='$user_email'";
				$run = mysql_query($check_email);
                                 //echo "1212 ".mysql_num_rows($run);
				if(mysql_num_rows($run)>1)
				{
					echo "<script>alert('Email $user_email is already exits')</script>";
				        exit();
				}

			//	$query = "INSERT into users (user_name,user_email,user_pass,Address,Membership,DOB,State,Country) VALUES('$user_name','$user_email','$user_pass','$Address',$Membership,'$DOB','$State','$Country')";
																																										

				 $query = "INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_pass`, `Address`, `DOB`, `State`, `Country`, `membership_id`, `createddate`) VALUES (NULL, '$user_name', '$user_email', '$user_pass', '$Address', '$DOB', '$State', '$Country', '$Membership', now())";
               
				if(mysql_query($query))
				{
					echo"<script>alert('Registration successfullly completed')</script>";
				}
		}
?>
