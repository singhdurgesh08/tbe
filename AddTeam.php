<?php 
    ob_start(); 
 session_start();
  if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login");
    exit();
}
$userid = $_SESSION['user_data']['id'];
//var_dump($userid);die();
$plat = $_GET['platform'];

include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>

  <script>

  $(document).ready(function(){
    $("#addteam").validate();
  });
  </script>

<style>
.error {color:red;}
</style>
<div class="home_tab_section">
<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1><br class="hidden-xs">Add Team - <?php echo $plat;?> </h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
                            <form method='post' id="addteam" action='AddTeam.php?platform=<?php echo $plat;?>'  class="form-horizontal">
							<fieldset>
							<div class="form-group">
									<label for="login_password" class="control-label col-sm-6">Team Name</label>
                                                                        <div class="col-sm-6 input"><input name='Team_Name'  placeholder="Please Enter Team Name"  class="form-control" maxlength="10" required=""></div>
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
                                                                                                                    
                                                               <div class="form-group">
                                                                    <div class="col-sm-6 input"><input type="hidden" id="plat" name="plat" value='<?php echo $plat;?>' class="form-control"></div>
                                                              </div>

                                                             <div class="form-group">
                                                                    <div class="col-sm-6 input"><input type="hidden" id="userid" name="userid" value='<?php echo $userid; ?>' class="form-control"></div>
                                                              </div>
							

							</fieldset>

					<div class="form-group">
                        <label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
                        <div class="col-sm-4 input text-center">
                            <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="Save">Create Team<i class="glyphicon glyphicon-chevron-right"></i></button>
                        </div>
                        
                        <div class="col-sm-2 input text-center">
                            <a href="teamlist" class="btn btn-lg btn-danger">Cancel<i class="glyphicon glyphicon-chevron-right"></i></a>
                            
                        </div>
                    </div>
			 </form>
			</div>
		</div>
</div>
</div>

<?php
//var_dump($plat);die();
if (isset($_POST['submit'])) 
{

    $Team_Name = $_POST['Team_Name'];
    $Team_Size = $_POST['Team_Size'];
    $platform = $_POST['plat'];
    $userid = $_POST['userid'];
    
    $Team_Caption = $_POST['Team_Caption'];
    $Game_Mode = $_POST['Game_Mode'];
    $Description = $_POST['Description'];
    $userid = $_SESSION['user_data']['id'];

   $sql = mysql_query("select game_Mode, platform from team where created_by = $userid and Status ='1'");
    
    while($result = mysql_fetch_array($sql))
    {
        $new  = $result[platform];
        $game = $result[game_Mode];

        if($game == $Game_Mode AND $new == $platform)
         {
            echo "<script>alert('Game Mode $game in platform $new already exists')</script>";
            exit();
         }
    }
        
         $query = "INSERT INTO `team` (`id`, `team_name`, `team_size`, `platform`, `team_caption`, `game_Mode`, `description`, `date_added`,`created_by`) VALUES (NULL, '$Team_Name', ' $Team_Size', '$platform', '$Team_Caption', '$Game_Mode', '$Description', now(),'$userid')";
            if (mysql_query($query)) { 
                 $teamid = mysql_insert_id();
                 $sql_query ="INSERT INTO `team_list` (`user_id`, `team_id`, `join_date`, `created_by`,`player_status`) "
                             . " VALUES ('$userid', '$teamid',now(),'$userid',1)";
                   mysql_query($sql_query);

               ob_start();
               header("location:teamlist");
               exit();
            }
  }
?>


<?php
include "footer.php";
?>