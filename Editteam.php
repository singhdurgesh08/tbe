<?php ob_start();
session_start();
include "login-header.php";
include "nav.php";
include "config.php";
include "common.php"; 
$teamid = $_GET['teamid'];
$teamid = encryptor('decrypt',$teamid);
$action=$_GET['action'];
$usersid = $_GET['usersid'];
$usersid = encryptor('decrypt',$usersid);

$is_admin = $_SESSION['user_data']['is_admin'];
$is_userid = $_SESSION['user_data']['id'];

if (isset($_POST['disband_yes'])) {
    $query = mysql_query("select Match_play_status from join_match where team_id = $teamid");
    $finalre = mysql_fetch_array($query);
    //print_r($finalre);die();
   // $usersid = $_GET['usersid'];
     $result = mysql_query("update team  set Status ='0' WHERE id = '$teamid'");
    // $result = mysql_query("DELETE FROM team_list WHERE team_id ='$teamid'");
    //$result = mysql_query("DELETE FROM team WHERE id ='$teamid'");
     $jointeamdetail = mysql_query("select * from join_match  where join_match.team_id ='$teamid' and Match_play_status = 0");
             while ($rows = mysql_fetch_array($jointeamdetail)) {  
                  
                   $matchid = $rows['match_id'];
                   $resmatch = mysql_query("select match_status from ps4_match where id = $matchid"); 
                    $resultmatch = mysql_fetch_array($resmatch) ;
                    $status = $resultmatch['match_status'];
                    if($status == 1) 
                    {  
                      cancleMatch($matchids);
                    }
                    //echo "UPDATE join_match SET Match_play_status = '1' WHERE match_id='$matchid' and Match_play_status = '0'"; die;
                    mysql_query("UPDATE join_match SET Match_play_status = '2' WHERE team_id='$teamid' and created_by = '$usersid' and Match_play_status = '0'");
                    mysql_query("UPDATE join_match SET Match_play_status = '1' WHERE match_id='$matchid' and Match_play_status = '0'");
                    $resquery = mysql_query("Select join_match.created_by,join_match.Match_play_status , join_match.match_id from join_match  left join users on join_match.created_by = users.id where match_id= '$matchid' and Match_play_status = '1'");
                    $win_result = mysql_fetch_array($resquery);
                    if($win_result['Match_play_status'] =='1'){
                    $userid = $win_result['created_by'];
                    transferMoney($userid,$matchid);
                    }
              }
     
   
    
    header("location:home");
    exit;
}
if (isset($_POST['disband_yes_sure'])) {
    $query = mysql_query("select Match_play_status from join_match where team_id = $teamid");
    $finalre = mysql_fetch_array($query);
    //$usersid = $_GET['usersid'];
   // $result = mysql_query("DELETE FROM team_list WHERE team_id ='$teamid'");
    //$result = mysql_query("DELETE FROM team WHERE id ='$teamid'");
    
     $result = mysql_query("update team  set Status ='0' WHERE id = '$teamid'");
    //mysql_query("UPDATE join_match SET Match_play_status = 2 WHERE team_id='$teamid' and created_by = '$usersid' and Match_play_status = 0");
   // mysql_query("UPDATE join_match SET Match_play_status = 1 WHERE team_id='$teamid' and created_by != '$usersid' and Match_play_status = 0");
     $jointeamdetail = mysql_query("select * from join_match  where join_match.team_id ='$teamid' and Match_play_status = 0");
          //$jointeam = mysql_fetch_array($jointeamdetail);  
            
        while ($rows = mysql_fetch_array($jointeamdetail)) {

        $matchid = $rows['match_id'];
           $resmatch = mysql_query("select match_status from ps4_match where id = $matchid"); 
             $resultmatch = mysql_fetch_array($resmatch) ;
             $status = $resultmatch['match_status'];
             if($status == 1) 
             {  
               cancleMatch($matchids);
             }
        //echo "UPDATE join_match SET Match_play_status = '1' WHERE match_id='$matchid' and Match_play_status = '0'"; die;
        mysql_query("UPDATE join_match SET Match_play_status = '2' WHERE team_id='$teamid' and created_by = '$usersid' and Match_play_status = '0'");
        mysql_query("UPDATE join_match SET Match_play_status = '1' WHERE match_id='$matchid' and Match_play_status = '0'");
        $resquery = mysql_query("Select join_match.created_by,join_match.Match_play_status , join_match.match_id from join_match  left join users on join_match.created_by = users.id where match_id= '$matchid' and Match_play_status = '1'");
        $win_result = mysql_fetch_array($resquery);
        if($win_result['Match_play_status'] =='1'){
        $userid = $win_result['created_by'];
        transferMoney($userid,$matchid);
        }
    }
    header("location:home");
    exit;
}

if ($usersid)
    {     
         if($action === "Leave")
            {
                $result = mysql_query("DELETE FROM team_list WHERE user_id = '$usersid' and team_id ='$teamid'");                                         
                $teamid = encryptor('encrypt',$teamid);
                header("location:Editteam.php?teamid=$teamid"); exit;
            }
        else
            {
               if($action === "Disband"){
                    $query = mysql_query("select * from join_match where team_id =$teamid order by id desc limit 1;");
                    $finalre = mysql_fetch_array($query);
                    if (($finalre['Match_play_status'] =="") || $finalre['Match_play_status'] =='1' ) {
                        echo '<script>
                            $(document).ready(function() {
                            $("#disband-team-sure").modal("show");
                            } );
                            </script>';
//                        $usersid = $_GET['usersid'];
//                        $result = mysql_query("DELETE FROM team_list WHERE team_id ='$teamid'");
//                        $result = mysql_query("DELETE FROM team WHERE id ='$teamid'");
//                        mysql_query("UPDATE join_match SET Match_play_status = 2 WHERE team_id='$teamid' and user_id = '$usersid' and Match_play_status = 0");
//                        mysql_query("UPDATE join_match SET Match_play_status = 1 WHERE team_id='$teamid' and user_id != '$usersid' and Match_play_status = 0");
//                        header("location:home");
//                    exit;
                    } else {
                             echo '<script>
                            $(document).ready(function() {
                            $("#disband-team").modal("show");
                            } );
                            </script>';
                    }
               }
     }
    }

$res = mysql_query("Select * from team where id= $teamid");
$r = mysql_fetch_array($res);
?>
<script src="<?php echo $baseurl; ?>assets/js/script.js"></script>
<?php 

if ($_POST['submit']=="Upload") {
$msg = "";
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);

if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
    ) && ($_FILES["file"]["size"] < MAXUPLOAD)//Approx. 100kb files can be uploaded.
    && in_array($file_extension, $validextensions)) {

if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
} else {
           $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $filename = time() . "." . $ext;


           
if (file_exists("upload/" . $filename)) {
         echo $filename . " <b>already exists.</b> ";
} else {
              move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $filename);
                $query = "UPDATE team set team_image = '$filename' WHERE id='" . $teamid . "'";
                $result = mysql_query($query);
                $teamid = encryptor('encrypt',$teamid);
                header("location:teamdetails?teamid=" . $teamid);
                exit();
            }
}
} else {
    $msg = "<div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong>  ***Invalid file Size or Type***
                </div>";
    }
}
?>
<div class="home_tab_section">
<div class="container">
        <?php
       if (isset($msg)) {
           echo $msg;
       }  
       ?>
        &nbsp; &nbsp;
    <div class="row">
         <a href="teamdetails?teamid=<?php echo encryptor('encrypt',$teamid); ?>" class="btn btn-success pull-right">Back</a>
        <div class="text-center">
           <h4 class="text-center"><strong>Team -</strong> <?php echo $r[team_name]; ?></h4> 
           &nbsp; &nbsp;
            
        </div>
    </div>
    <div class="col-sm-3">
               
                    <div id="clear"></div>
                     <div id="preview"><img id="previewimg" src="" height="80" width="80" /><img id="deleteimg" src="<?php echo $baseurl; ?>assets/images/delete.png" />
                     <span class="pre">IMAGE PREVIEW</span>
                     </div>
                        <form id="form" action="" method="post"enctype="multipart/form-data">
                            <div id="upload">
                                <input type="file" name="file" id="file" accept="<?php echo ACCEPTIMAGE;?>"/>
                            </div>
                        <br/>
                                <input type="submit" id="submit" name="submit" value="Upload" class="btn btn-primary" style="margin-left:58px;"/>
                    </form>
                     
                </div>
    <div class="row">
        <div class="col-sm-8">
             <form method='post' action='Editteam.php?teamid=<?php echo $teamid; ?>' class="form-horizontal">
                <fieldset>
                   <!-- <div class="form-group">
                        <label for="login_password" class="control-label col-sm-2 ">Team Name</label>
                        <div class="col-sm-7 input"><input type = "text" name='Team_Name' value="<?php echo $r['team_name']; ?>" class="form-control" maxlength="50"></div>
                    </div>-->

                            <div class="row">
                              <div class="col-sm-12">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                   <h4 class="text-center"><strong>Team Member's</strong></h4> 

                                   <thead class="thead-inverse">
                                       <tr>
                                           <th>Roster</th>
                                           <th>Role</th>
                                           <th>Date Joined</th>
                                           <th>Action</th>
                                       </tr>
                                   </thead>
                                         <tbody>
                             <?php
                                $i = 1;
                                $res = mysql_query("SELECT * FROM team_list LEFT JOIN team ON team_list.team_id = team.id LEFT JOIN users ON users.id = team_list.user_id WHERE team_list.player_status ='1' and team_list.team_id= $teamid");
                                while ($r = mysql_fetch_assoc($res)) {
                                    ?>
                                    <tr>
                                        <td><a href="myprofile.php?usersid=<?php echo encryptor('encrypt',$r['id']); ?>"><?php echo $r['user_name']; ?>
                                            </a></td>
                                        <td>
                                            <?php
                                            $var = $r['team_id'];
                                            if ($r['team_id'] == $var && $r['created_by'] == $r['user_id']) {
                                                echo "Captain";
                                            } else {
                                                echo "Player";
                                            }
                                            ?>
                                       </td>
                                        <td><?php echo date("d-M-Y", strtotime($r['join_date'])); ?></td>
                                        <td>
                                         <?php
                                            $var = $r['team_id'];
                                            if ($r['team_id'] == $teamid && $r['created_by'] == $r['user_id'])
                                            {
                                              ?> <a href="Editteam.php?action=Disband&usersid=<?php echo encryptor('encrypt',$r['user_id']);?>&teamid=<?php echo encryptor('encrypt',$r['team_id']);?>">Disband</a> 
                                            <?php
                                            } 
                                            else
                                            {
                                               if($r['created_by'] == $is_userid) {
                                                    ?><a href="teamdetails?action=Leave&usersid=<?php echo encryptor('encrypt',$r['user_id']);?>&teamid=<?php echo encryptor('encrypt',$r['team_id']);?>">Terminate</a>
                                                <?php } else { 
												   if($r['user_id'] == $is_userid) {
												   ?> 
                                                    <a href="teamdetails?action=Leave&usersid=<?php echo encryptor('encrypt',$r['user_id']);?>&teamid=<?php echo encryptor('encrypt',$r['team_id']);?>">Leave</a>
                                                     <?php
												   } } }  ?>
                                            
                                        </td>
                                    </tr>
                                    <?php }
                                    ?>
                                                </tbody>
                                               </table>
                                           </div>
                                       </div>





                    <div class="form-group">
                            <div class="col-sm-6 input"><input type="hidden" id="platform" name="platform" value='<?php echo $r[platform];  ?>' class="form-control"></div>
                     </div>
                     <!--<div class="form-group">
                        <label for="login_password" class="control-label col-sm-6">Game Mode</label>
                        <div class="col-sm-6 input"> <select name="Game_Mode" id="Membership"  class="form-control">
                                <option value="1v1 Mycourt">1v1 Mycourt</option>
                                <option value="2v2 Mycourt">2v2 Mycourt</option>
                                <option value="3v3 Mycourt">3v3 Mycourt</option>
                                <option value="Quick Match">Quick Match</option>
                                <option value="Myteam">Myteam</option>
                         </select></div>
                    </div>-->

                 
                    </fieldset>

               
            </form>
                    <div class="login_form_page">
                              <div class="row">
                                      <div class="col-sm-12 text-center">
                                          <h6 class="login_title"><br class="hidden-xs">Team Invite </h6>
                                      </div>
                              </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <form method='post' id="login" class="form-horizontal login_form">
                                       <fieldset>
                                               <div class="form-group">
                                                  <div class="col-sm-12 input"><input name='name'  type="text" placeholder="Please Enter user name"  class="form-control email" required=""></div>
                                                  </div>
                                                  <div class="form-group">
                                                    <div class="col-sm-12 input text-center">
                                                       <button class="btn btn-md btn-block btn-success" type="submit" name="submit" value="submit">Submit <i class="glyphicon glyphicon-chevron-right"></i></button>
                                                    </div>
                                                  </div>
                                       </fieldset> 
                                </form>
                                </div>
                             </div>
                          </div>
                    </div>
                 </div>
</div>
</div>
</div>
</div>
<?php
include "footer.php";
?>
<?php 
if (isset($_POST['update'])) 
{
    $Team_Name = $_POST['Team_Name'];
    $platform = $_POST['platform'];
    $Team_Caption = $_POST['Team_Caption'];
    $Game_Mode = $_POST['Game_Mode'];
    $Description = $_POST['Description'];

        $platquery = mysql_query("select platform, game_Mode from team where created_by = $userid");
        while($result = mysql_fetch_array($platquery))
        {
         $var = $result[platform];
         $var1 = $result[game_Mode];

         /* if( $result[game_Mode] == $Game_Mode)
            {
                     echo "<script>alert('Game Mode $var1 in platform $var is already exists')</script>";
                     exit();
            }*/
        }
            $sql_query = mysql_query("update team set team_name = '$Team_Name'  where id = $teamid");
            if ($sql_query)
            {
                 header("Location:teamdetails.php?teamid=" . $teamid);
                 echo"<script>alert('Team Updated Successfully')</script>";
            }
}


        $sql =mysql_query("Select * from team where id = $teamid");
        $result = mysql_fetch_array($sql);
         $var = trim($result['game_Mode']); 
        $a = "1v1 Mycourt"; $b = "2v2 Mycourt"; $c ="3v3 Mycourt"; $d ="Quick Match"; $e ="Myteam";
        $query = "SELECT count(*) AS total FROM team_list where team_id=$teamid and player_status = '1'"; 
        $result1 = mysql_query($query); 
        $values = mysql_fetch_assoc($result1); 
        $num_rows = $values['total']; 
      
             if (isset($_POST['submit'])) 
                { 
                   if($var ==$a and $num_rows == 1)
                    {
                        echo "<script>alert('your team is full in your game mode')</script>";
                        exit();
                    }
                    elseif ($var ==$b and $num_rows == 2)
                    {
                      echo "<script>alert('your team is full in your game mode')</script>";
                      exit();
                    }
                    elseif ($var ==$c and $num_rows == 3)
                    {
                      echo "<script>alert('your team is full in your game mode')</script>";
                      exit();
                    }
                     elseif ($var ==$d and $num_rows == 1)
                    {
                      echo "<script>alert('your team is full in your game mode')</script>";
                      exit();
                    }
                     elseif ($var == $e and $num_rows == 1)
                    {
                      echo "<script>alert('your team is full in your game mode')</script>";
                      exit();
                    }
                    else{
                           $name = $_POST['name'];
                           $res = mysql_query("Select id, user_name from users where user_name ='$name'");
                           $record = mysql_fetch_array($res);
                           $result = $record['id'];
                           $uname = $record['user_name'];

                           if($userid != $result){
                               
                                $res2 = mysql_query("Select count(id) AS totalinvite  from team_list where team_id= $teamid and user_id ='$result'");
                               
                                $values2 = mysql_fetch_assoc($res2); 
                                $num_rows2 = $values2['totalinvite']; 
                                
                                if($num_rows2 >= 1) {
                                    echo"<script>alert('$name has already been invited to your team .')</script>";
                                     exit();
                                }
                                 if ($result != '') 
                                    { 
                                       $query =mysql_query("INSERT INTO `team_list` (`id`,`user_id`, `team_id`, `join_date`, `created_by`,`player_status`) VALUES (NULL,'$result', '$teamid',now(),'$userid',0)");
                                       echo"<script>alert('Team Invited successfullly')</script>";
                                       exit();
                                    }
                                else
                                    {
                                       echo"<script>alert('Please Invite Valid user')</script>";
                                       exit();
                                    }
                           } else
                            {
                              echo"<script>alert('You are not able to invite your self')</script>";
                            }
                          
                      }
                            
               }

?>
<div id="disband-team-sure" class="modal fade">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Disband Match</h4>
            </div>
            <form method='post' id="disband_yes_sure" name="disband_yes_sure"  class="form-horizontal">
                <div class="modal-body">
                    <div id="div_wait"></div>
                    <div class="form-group">
                      <p class="text-center"> Are you sure you want to disband your team?
                      </p>  
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-8  back hidden-xs">&nbsp;</label>
                        <div class="col-sm-2 input text-center">
                            <button class="btn btn-primary" type="submit" name="disband_yes_sure" value="Join">Yes</button>
                        </div>
                        <div class="col-sm-1 input text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>

            </form>
                       
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
<div id="disband-team" class="modal fade">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Disband Match</h4>
            </div>
            <form method='post' id="accept_match" name="accept_match"  class="form-horizontal">
                <div class="modal-body">
                    <div id="div_wait"></div>
                    <div class="form-group">
                      <p class="text-center"> disbanding your team will result in a loss because some matches are not completed or disputed.
                      </p>  
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-8 back hidden-xs">&nbsp;</label>
                        <div class="col-sm-2 input text-center">
                            <button class="btn btn-primary" type="submit" name="disband_yes" value="Join" onclick="joinMatch();">Yes</button>
                        </div>
                        <div class="col-sm-1 input text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>

            </form>
                       
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>

<style>
    thead th {
        background-color: #006DCC;
        color: white;
    }
    tbody td {
        background-color: #EEEEEE;
    }
    .nav.nav-tabs li:first-child a {
        margin-left: 0;
    }
    .nav.nav-tabs li.active a {
        background: #fff;
        border-bottom: 0 !important;
        border-color: #d9d9d9;
        border-top: 0;
        color: #DF0A0A;
        position: relative;
        top: 1px;
        z-index: 1;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
        color: #555;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
        cursor: default;
    }
    .nav-tabs>li>a {
        margin-right: 2px;
        line-height: 1.428571429;
        border: 1px solid transparent;
        border-radius: 4px 4px 0 0;
    }
    .nav.nav-tabs li a {
        -webkit-border-top-left-radius: 4px;
        -webkit-border-top-right-radius: 4px;
        -moz-border-radius-top-left: 4px;
        -moz-border-radius-top-right: 4px;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        background:  #006DCC;
        border: 1px solid transparent;
        border-bottom: 0;
        color: white;
        cursor: pointer;
        font-weight: bold;
        margin-left: 10px;
        padding: 10px 25px;
        position: relative;
        text-align: center;
        top: -1px;
    }
    a:active, a:hover {
        outline: 10;
    }
    .tab-content>.tab-pane {
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        background: #fff;
        border: 1px solid #d9d9d9;
        border-top-left-radius: 0 !important;
        margin-bottom: 10px;
        padding: 10px;
        padding-bottom: 0;
    }
    .nav.nav-tabs li.active a::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        -webkit-border-top-left-radius: 4px;
        -webkit-border-top-right-radius: 4px;
        -moz-border-radius-top-left: 4px;
        -moz-border-radius-top-right: 4px;
        border-top-left-radius: 8px;
        border-top-right-radius: 4px;
        background:  #006DCC;
        height: 5px;
        width: 100%;
    }
</style>