<?php

include "login-header.php";
?>

<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1><br class="hidden-xs">Add Team</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
                            <form method='post' action='AddTeam.php' class="form-horizontal">
							<fieldset>
							<!--	<div class="form-group">
									<label for="login_email" class="control-label col-sm-6">Email Address</label>
									<div class="col-sm-6 input"><input name='Email'  type="text" placeholder="Please Enter User Name"  class="form-control" required=""></div>
								</div>
							-->	
								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Team Name</label>
									<div class="col-sm-6 input"><input name='Team_Name'  placeholder="Please Enter Team Name"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Team Size</label>
									<div class="col-sm-6 input"><input name='Team_Size'  placeholder="Please Enter Team Size"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Platform</label>
									<div class="col-sm-6 input"> <select name="Platform" id="Platform">
															    <option value="Free">Free</option>
															    <option value="Madden">Madden</option>
															    <option value="Diamond_membership">Diamond_membership</option>
	 															 </select></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Team Caption</label>
									<div class="col-sm-6 input"><input name='Team_Caption'  placeholder="Please Enter Team Caption"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Description</label>
									<div class="col-sm-6 input"><textarea name='Description' style="width: 360px; height: 50px;" placeholder="Enter Description"></textarea></div>
								</div>

							</fieldset>

							<div class="form-group">
								<label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
								<div class="col-sm-6 input text-center">
                                <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Save">Save <i class="glyphicon glyphicon-chevron-right"></i></button>
                            </div>
							</div>
						 </form>
					</div>
					
				</div>

</div>


<?php
include "config.php";
if(isset($_POST['submit']))
				{

					$Team_Name = $_POST['Team_Name'];
				    $Team_Size = $_POST['Team_Size'];
					$Platform = $_POST['Platform'];
					$Team_Caption = $_POST['Team_Caption'];
					$Description = $_POST['Description'];
					 					 
				//if($Email=='') {
			//		echo "<script>alert('please enter your Email_address')</script>";
			//		exit();
			//	}
					 
				$query ="INSERT INTO `team` (`id`, `team_name`, `team_size`, `platform`, `team_caption`, `description`, `date_added`) VALUES (NULL, '$Team_Name', ' $Team_Size', '$Platform', '$Team_Caption', '$Description', CURRENT_TIMESTAMP)";				
				
			//	INSERT INTO `inetglobal`.`team` (`id`, `team_name`, `team_size`, `platform`, `team_caption`, `description`, `date_added`) VALUES (NULL, 'fimt', '89', 'ipu', 'iiiiiiii', 'iiiiiiiiii', CURRENT_TIMESTAMP);
				if(mysql_query($query))
				{
					echo"<script>alert('Registration successfullly completed')</script>";
				}
		}

?>


<?php
include "footer.php";
?>