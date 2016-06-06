<?php
session_start();
include "login-header.php";
include "nav.php";
include "config.php";
$teamid = $_GET['teamid'];

if (isset($_POST['update'])) {

    $Team_Name = $_POST['Team_Name'];
    $Gamertag = $_POST['Gamertag'];
    $Team_Caption = $_POST['Team_Caption'];
    $Game_Mode = $_POST['Game_Mode'];
    $Description = $_POST['Description'];
    //$date_added = $_POST['date_added'];

    $sql_query = mysql_query("update team set team_name = '$Team_Name', platform ='$Gamertag', team_caption ='$Team_Caption', Game_Mode='$Game_Mode', description ='$Description'  where id = $teamid");
    if ($sql_query) {
        header("Location: Teamdetails.php?teamid=" . $teamid);
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1><br class="hidden-xs">Edit Team</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <form method='post' action='Editteam.php?teamid=<?php echo $teamid; ?>' class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Team Name</label>
                        <div class="col-sm-6 input"><input type = "text" name='Team_Name'  placeholder="Please Enter Team Name"  class="form-control"></div>
                    </div>

                    <div class="form-group">
                                    <label for="Platform" class="control-label col-sm-6">Gamertag</label>
                                    <div class="col-sm-6 input"> 
                                                            <select name="Gamertag" class="form-control">
                                                                <option value="XB1">XB1</option>
                                                                <option value="PS4">PS4</option>
                                                                 </select>
                                            </div>
                                     </div>

                    
                     <div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Team Captain</label>
                        <div class="col-sm-6 input"><input name='Team_Caption'  placeholder="Please Enter Team Name"  class="form-control"></div>
                    </div>


                   <div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Game Mode</label>
                        <div class="col-sm-6 input"> <select name="Game_Mode" id="Membership"  class="form-control">
                                <option value="Free">Free</option>
                                <option value="Diamond_membership">Diamond Membership</option>
                            </select></div>
                    </div>

                   <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Description</label>
                                    <div class="col-sm-6 input"><textarea name='Description' style="width: 360px; height: 50px;" placeholder="Enter Description"></textarea></div>
                                </div>
                    </fieldset>

                <div class="form-group">
                    
                 <label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
                        <div class="col-sm-2 input text-center">
                            <button class="btn btn-lg btn-block btn-success" type="submit" name="update" value="update">Update<i class="glyphicon glyphicon-chevron-right"></i></button>
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
?>


<?php
include "footer.php";
?>