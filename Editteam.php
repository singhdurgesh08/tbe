<?php ob_start();
session_start();
include "login-header.php";
include "nav.php";
include "config.php";
$teamid = $_GET['teamid'];

 if (isset($_GET['usersid']) && is_numeric($_GET['usersid']))
    { $usersid = $_GET['usersid'];
        //  var_dump($teamid);
    
          $result = mysql_query("DELETE FROM team_list WHERE user_id = '$usersid' and team_id ='$teamid'");                                         
          header("location:Editteam.php?teamid=$teamid"); exit;
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
                header("location:teamdetails.php?teamid=" . $teamid);
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
    <div class="row">
        <div class="col-sm-12 text-center">
            <h4><br class="hidden-xs">Edit Team - <?php echo $r[team_name]; ?></h4>
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
                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-2 ">Team Name</label>
                        <div class="col-sm-7 input"><input type = "text" name='Team_Name' value="<?php echo $r['team_name']; ?>" class="form-control" maxlength="50"></div>
                    </div>

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
                                        <td><a href="myprofile.php?usersid=<?php echo $r['id']; ?>"><?php echo $r['user_name']; ?>
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
                                            if ($r['team_id'] == $var && $r['created_by'] != $r['user_id'])
                                            {
                                              ?> <a href="Editteam.php?usersid=<?php echo $r['user_id'];?>&teamid=<?php echo $r['team_id'];?>">Delete</a> <?php
                                         } 
                                            ?>
                                            
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

                <div class="form-group">
                    
                 <label for="" class="control-label col-sm-2 back hidden-xs">&nbsp;</label>
                        <div class="col-sm-2 input text-center">
                            <button class="btn btn-lg btn-block btn-success" type="submit" name="update" value="update">Update<i class="glyphicon glyphicon-chevron-right"></i></button>
                        </div>
                        <div class="col-sm-2 input text-center">
                            <a href="teamdetails.php?teamid=<?php echo $teamid; ?>" class="btn btn-lg btn-danger">Cancel<i class="glyphicon glyphicon-chevron-right"></i></a>
                        </div>
                    </div>
            </form>
                    <div class="login_form_page">
                              <div class="row">
                                      <div class="col-sm-12 text-center">
                                          <h6 class="login_title"><br class="hidden-xs">Team invite's </h6>
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
            $sql_query = mysql_query("update team set team_name = '$Team_Name', platform ='$platform', team_caption ='$Team_Caption', Game_Mode='$Game_Mode', description ='$Description'  where id = $teamid");
            if ($sql_query)
            {
                 header("Location:teamdetails.php?teamid=" . $teamid);
                 echo"<script>alert('Team Updated Successfully')</script>";
            }
}


 $sql =mysql_query("Select * from team where id= $teamid");
        $result = mysql_fetch_array($sql);
        $var = $result['game_Mode'];
        $a = "1v1 Mycourt";$b ="2v2 Mycourt";$c ="3v3 Mycourt";$d ="Quick Match";$e ="Myteam";

        $query = "SELECT count(*) AS total FROM team_list where team_id=$teamid"; 
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
                     elseif ($var ==$e and $num_rows == 2)
                    {
                      echo "<script>alert('your team is full in your game mode')</script>";
                      exit();
                    }
                    else{
                           $name = $_POST['name'];
                           $res = mysql_query("Select id from users where user_name ='$name'");
                           $record = mysql_fetch_array($res);
                           $result = $record['id'];
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
                      }
                            
               }

?>
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