<?php ob_start();
session_start();
include "login-header.php";
include "nav.php";
include "config.php";
$teamid = $_GET['teamid'];



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
    ) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
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
            <h1><br class="hidden-xs">Edit Team - <?php echo $r[team_name]; ?></h1>
        </div>
    </div>
    <div class="col-sm-3">
               
                    <div id="clear"></div>
                     <div id="preview"><img id="previewimg" src="" height="80" width="80" /><img id="deleteimg" src="<?php echo $baseurl; ?>assets/images/delete.png" />
                     <span class="pre">IMAGE PREVIEW</span>
                     </div>
                        <form id="form" action="" method="post"enctype="multipart/form-data">
                            <div id="upload">
                                <input type="file" name="file" id="file"/>
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
                        <div class="col-sm-7 input"><input type = "text" name='Team_Name' value="<?php echo $r['team_name']; ?>" class="form-control" maxlength="10"></div>
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
                            <a href="teamlist.php" class="btn btn-lg btn-danger">Cancel<i class="glyphicon glyphicon-chevron-right"></i></a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
                  <div class="row">
                    <div class="col-sm-12 input text-center">
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

            if( $result[game_Mode] == $Game_Mode)
            {
                     echo "<script>alert('Game Mode $var1 in platform $var is already exists')</script>";
                     exit();
            }
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
