<?php
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";
include "nav.php";
include "config.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1><br class="hidden-xs">POST PS4 Match</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <form method='post' action='add_ps4.php' class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label for="login_email" class="control-label col-sm-6">Match Name</label>
                        <div class="col-sm-6 input"><input name='Match_Name'  type="text" placeholder="Please Enter Match Name"  class="form-control" ></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Match Date</label>
                        <div class="col-sm-6 input"><input name='Match_Date'  placeholder="Please Match Date"  class="form-control" ></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Match Time</label>
                        <div class="col-sm-6 input"><input name='Match_Time'  placeholder="Please Enter Match Time"  class="form-control"></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Match Place</label>
                        <div class="col-sm-6 input"><input name='Match_Place'  placeholder="Please Enter Place"  class="form-control" ></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Team VS Team</label>
                        <div class="col-sm-6 input"><input name='team_vs_team'  placeholder="Please Enter Team vs Team"  class="form-control" ></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Game Mode</label>
                        <div class="col-sm-6 input"><select name="Game_Mode" class="form-control" >
                                <option value="1v1 Mycour">1v1 Mycour</option>
                                <option value="2v2 Mycour">2v2 Mycour</option>
                                <option value="3v3 Mycour">3v3 Mycour</option>
                                <option value="Quick Match">Quick Match</option>
                                <option value="Myteam">Myteam</option>
                            </select></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Game Type</label>
                        <div class="col-sm-6 input"> <select name="Game_Type" class="form-control" >
                                <option value="PS4">PS4</option>
                            </select></div>
                    </div>


                </fieldset>

                <div class="form-group">
                    <label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
                    <div class="col-sm-6 input text-center">
                        <button class="btn btn-lg btn-block btn-success" type="submit" name="Save" value="Save">Save<i class="glyphicon glyphicon-chevron-right"></i></button>
                        <button class="btn btn-lg btn-block btn-success" type="submit" name="Cancel" value="Cancel">Cancel<i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>



</div>


<?php
if (isset($_POST['Save'])) {

    $Match_Name = $_POST['Match_Name'];
    $Match_Date = $_POST['Match_Date'];
    $Match_Time = $_POST['Match_Time'];
    $Match_Place = $_POST['Match_Place'];
    $team_vs_team = $_POST['team_vs_team'];
    $Game_Mode = $_POST['Game_Mode'];
    $Game_Type = $_POST['Game_Type'];

    $userid = $_SESSION['user_data']['id'];

    $query = "INSERT INTO `ps4_match` (`id`, `match_name`, `Date`, `time`, `place`, `team_vs_team`, `game_mode`, `game_type`, `status`, `created_date`, `user_id`) VALUES (NULL, '$Match_Name', '$Match_Date', '$Match_Time', '$Match_Place', '$team_vs_team', '$Game_Mode', 'Game_Type', '1', CURRENT_TIMESTAMP, '$userid')";

    if (mysql_query($query)) {
         echo"<script>alert('Match Added successfullly')</script>";  
    }
}

if (isset($_POST['Cancel'])) {
    echo "hello";
    die();
    ;
}
?>





<?php
include "footer.php";
?>