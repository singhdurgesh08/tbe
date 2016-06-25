<?php 
 session_start();
  if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}

include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>

<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <script>

  $(document).ready(function(){
    $("#addteam").validate();
  });
  </script>
</head>


<style>
.error {color:red;}
</style>

<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1><br class="hidden-xs">Add Team</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
                            <form method='post' id="addteam" action='AddTeam.php' class="form-horizontal">
							<fieldset>
							<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Team Name</label>
									<div class="col-sm-6 input"><input name='Team_Name'  placeholder="Please Enter Team Name"  class="form-control" required=""></div>
								</div>

								<div class="form-group">
									<label for="Platform" class="control-label col-sm-6">Platform</label>
									<div class="col-sm-6 input"> 
									                        <select name="Platform" id="Platform" class="form-control" required="">
															   	<option>Please Select Plaltform</option>
															    <option value="XB1">XB1</option>
															    <option value="PS4">PS4</option>
	 															 </select>
											</div>
								</div>

				
								

                                                            <div class="form-group">
                                                                <label for="login_password" class="control-label col-sm-6">Game Mode</label>
                                                                <div class="col-sm-6 input">
                                                                    <select name="Game_Mode" id="Game_mode" class="form-control" required="">
                                                                        <option value=""> select game mode</option>
                                                                        <option value="1v1 Mycourt">1v1 Mycourt</option>
                                                                        <option value="2v2 Mycourt">2v2 Mycourt</option>
                                                                        <option value="3v3 Mycourt">3v3 Mycourt</option>
                                                                        <option value="Quick Match">Quick Match</option>
                                                                        <option value="Myteam">Myteam</option>
                                                                    </select>
                                                                </div>
                                                            </div>
							

							</fieldset>

					<div class="form-group">
                        <label for="" class="control-label col-sm-7 back hidden-xs">&nbsp;</label>
                        <div class="col-sm-2 input text-center">
                            <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Save">Save<i class="glyphicon glyphicon-chevron-right"></i></button>
                        </div>
                        
                        <div class="col-sm-2 input text-center">
                            <a href="teamlist.php" class="btn btn-lg btn-danger">Cancel<i class="glyphicon glyphicon-chevron-right"></i></a>
                            
                        </div>
                    </div>
			 </form>
			</div>
		</div>
</div>


<?php

if (isset($_POST['submit'])) 
{

    $Team_Name = $_POST['Team_Name'];
    $Team_Size = $_POST['Team_Size'];
    $Platform = $_POST['Platform'];
    $Team_Caption = $_POST['Team_Caption'];
    $Game_Mode = $_POST['Game_Mode'];
    $Description = $_POST['Description'];
    $userid = $_SESSION['user_data']['id'];

    $query = "INSERT INTO `team` (`id`, `team_name`, `team_size`, `platform`, `team_caption`, `game_Mode`, `description`, `date_added`,`created_by`) VALUES (NULL, '$Team_Name', ' $Team_Size', '$Platform', '$Team_Caption', '$Game_Mode', '$Description', now(),'$userid')";
    if (mysql_query($query)) {
        echo"<script>alert('Team Added successfullly')</script>";
    }
}
?>


<?php
include "footer.php";
?>