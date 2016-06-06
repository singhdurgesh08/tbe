
<?php
session_start();
include "login-header.php";
include "nav.php";
include "config.php";
$teamid = $_GET['teamid'];


		if(isset($_POST['Update']))
		 {
		 	
		 			 $Email = $_POST['Email_Address'];
		 			 $First_Name = $_POST['First_Name'];
					 $Last_Name = $_POST['Last_Name'];
					 $Street_Address = $_POST['Street_Address'];
					 $City = $_POST['City'];
					 $Country = $_POST['Country'];
					 $State = $_POST['State'];
					 $Postal_Code = $_POST['Postal_Code'];
					 $Gender = $_POST['Gender'];
					 $Time_zone = $_POST['Time_zone'];
					 $Date_of_Birth = $_POST['Date_of_Birth'];
	

					 
					 $sql_query =mysql_query("update user_profile set Email_address = '$Email', First_Name ='$First_Name', Last_Name ='$Last_Name', Street_Address='$Street_Address', City='$City', Country='$Country', State='$State', Postal_Code='$Postal_Code', Time_zone='$Time_zone', Gender='$Gender', Date_of_Birth='$Date_of_Birth' where id = 20 ");

					 if($sql_query)
					 {
        		        header("Location: Teamdetails.php?teamid=".$teamid);
					 }
	 
				 if(isset($_POST['Cancel']))
					 {
					 		 header("Location: Teamdetails.php?teamid=".$teamid);
					 }
			}
?>

<html>
<head>
	<h1>Pending work</h1>
</head>
</html>
<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1><br class="hidden-xs">Edit Roster </h1>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-8">
                            <form method='post' action='EditRoster.php' class="form-horizontal">
							<fieldset>
								
								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Email Address</label>
									<div class="col-sm-6 input"><input name='Email_Address'  placeholder="Please Enter First Name"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">First Name</label>
									<div class="col-sm-6 input"><input name='First_Name'  placeholder="Please Enter First Name"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Last Name</label>
									<div class="col-sm-6 input"><input name='Last_Name'  placeholder="Please Enter Last Name"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Street Address</label>
									<div class="col-sm-6 input"><input name='Street_Address'  placeholder="Please Enter Street address"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">City</label>
									<div class="col-sm-6 input"><input name='City'  placeholder="Please Enter City"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">State</label>
									<div class="col-sm-6 input"><select name="State" id="State" class="form-control">
															    <option value="Free">Delhi</option>
															    <option value="Madden">Banglore</option>
															    <option value="Diamond_membership">Chennai</option>
	 															 </select></div>
								</div>
								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Postal Code</label>
									<div class="col-sm-6 input"><input name='Postal_Code'  placeholder="Please Enter Postal code"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Time Zone</label>
									<div class="col-sm-6 input"><select name="Time_Zone" id="State" class="form-control">
															    <option value="Free">Delhi</option>
															    <option value="Madden">Banglore</option>
															    <option value="Diamond_membership">Chennai</option>
	 															 </select></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Gender</label>
									<div class="col-sm-6 input"><select name="Gender" id="Gender" class="form-control">
															    <option value="Free">Male</option>
															    <option value="Madden">Female</option>
															   </select></div>
								</div>
								
								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Date of Birth</label>
									<div class="col-sm-6 input"><input name='Date_of_Birth'  placeholder="DD/MM/YYYY"  class="form-control" required=""></div>
								</div>

							</fieldset>

							<div class="form-group">
								<label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
								<div class="col-sm-6 input text-center">
                                <button class="btn btn-lg btn-block btn-success" type="submit" name="Update" value="Update">Update <i class="glyphicon glyphicon-chevron-right"></i></button>
                                <!--<button class="btn btn-lg btn-block btn-success" type="submit" name="Update" value="Update">Update <i class="glyphicon glyphicon-chevron-right"></i></button>-->
								</div>
							</div>
						 </form>
					</div>
					
				</div>

</div>

<?php

?>


<?php
include "footer.php";
?>