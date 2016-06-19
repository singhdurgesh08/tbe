<?php 
include "config.php";
session_start();
$user = $_SESSION['email'];

include "login-header.php";?>
<?php include "nav.php";?>

<div class="home_tab_section">
<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1><br class="hidden-xs">Add Gamertag here!</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
                            <form method='post' action='Addplaystation.php' class="form-horizontal">
							<fieldset>
								<div class="form-group">
									<label for="login_email" class="control-label col-sm-6">Gamertag</label>
									<div class="col-sm-6 input"><input name='Playstation'  type="text" placeholder="Please Enter Playstation"  class="form-control"></div>
								</div>
								
								
								
							</fieldset>
							<div class="form-group">
								<label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
								<div class="col-sm-2 input text-center">
                                                                <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Save">Save <i class="glyphicon glyphicon-chevron-right"></i></button>
								</div>
                                                                <div class="col-sm-2 input text-center">
                                                                  <a href="home.php" class="btn btn-lg btn-danger">Cancel<i class="glyphicon glyphicon-chevron-right"></i></a>
                                                                
								</div>
							</div>
						 </form>
						
					</div>
					
				</div>
			</div>
</div>


<?php
	include "config.php";	
	if(isset($_POST['submit']))
	{

            $userid = $_SESSION['user_data']['id'];
            $Playstation = $_POST['Playstation'];
            $Description = $_POST['Description'];
            $user_id = $_POST['user_id'];

       
            $query = "INSERT INTO `playstation` (`id`, `playstation_name`, `plastation_detail`, `user_id`) VALUES (NULL, '$Playstation', '$Description', '$userid')";
            if (mysql_query($query)) {
                echo"<script>alert('Playstation Added successfullly')</script>";
                exit();
            } 
}

		if(isset($_POST['cancel']))
		{
			header("Location: myprofile.php");
			exit();
		}

?>
<?php	include "footer.php";?>