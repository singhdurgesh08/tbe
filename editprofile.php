<?php ob_start();
include "config.php";
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
 }
 $userid = $_SESSION['user_data']['id'];
include "login-header.php";?>
        <?php include "nav.php";?>
         <?php
        $userid = $_SESSION['user_data']['id'];
        $res = mysql_query("Select * from users where id= $userid");
        $r = mysql_fetch_array($res);
        //echo print_r($r);
        ?>
<script>
$(document).ready(function(){
  $("#editform").validate();
    });
</script>
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
    $query = "UPDATE users set user_image = '$filename' WHERE id='" . $userid . "'";
    $result = mysql_query($query);
    header("location:myprofile.php?usersid=".$userid);
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

<script src="<?php echo $baseurl; ?>assets/js/script.js"></script>
<div class="home_tab_section">
<div class="container">
    <?php
    if (isset($msg)) {
        echo $msg;
    }  ?>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1><br class="hidden-xs">Edit Profile</h1>
                    </div>
                </div>
                <div>
                    &nbsp;
                </div>

                <div class="col-sm-3">
               
                    <div id="clear"></div>
                     <div id="preview"><img id="previewimg" src="" height="80" width="80" /><img id="deleteimg" src="<?php echo $baseurl; ?>assets/images/delete.png" />
                     <span class="pre">IMAGE PREVIEW</span>
                     </div>
                  <form id="form" action="" method="post"enctype="multipart/form-data">

                        <div id="upload">
                            <input type="file" name="file" id="file" accept="<?php echo ACCEPTIMAGE;?>" />
                        </div>
                        <br/>
                        <input type="submit" id="submit" name="submit" value="Upload" class="btn btn-primary" style="margin-left:58px;"/>
                    </form>
                     
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <form method='post' id="editform" class="form-horizontal">
                        <fieldset>
<!--                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-2">First Name</label>
                                    <div class="col-sm-4 input"><input name='First_Name' id="name" value="<?php echo $r['first_name']; ?>" placeholder="Please Enter First Name" class="form-control" required=""></div>

                                    <label for="login_password" class="control-label col-sm-2">Last Name</label>
                                    <div class="col-sm-4 input"><input name='Last_Name' id="lname" value="<?php echo $r['last_name']; ?>" placeholder="Please Enter Last Name"  class="form-control"></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-2">Address</label>
                                    <div class="col-sm-4 input"><input name='Address' id="address" value="<?php echo $r['Address']; ?>" placeholder="Please Enter Street address"  class="form-control" required="" ></div>
                             
                                    <label for="login_password" class="control-label col-sm-2">Gamertag</label>
                                    <div class="col-sm-4 input"><input name='Gamertag' id="Gamertag" value="<?php echo $r['gamertag']; ?>" placeholder="Please Enter Gamertag"  class="form-control" required="" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-2">City</label>
                                    <div class="col-sm-4 input"><input name='City' id="city" value="<?php echo $r['city']; ?>"  placeholder="Please Enter City"  class="form-control" required="" ></div>

                                
                                
                                  <label for="login_password" class="control-label col-sm-2">State</label>
                                    <div class="col-sm-4 input"><select name="State" id="state" class="form-control">   
                                                   <option value=""> Please select State </option>
                                                                     <?php 
                                                    $query =mysql_query("select name from states where country_id=231");
                                                    while($result = mysql_fetch_array($query))
                                                    {
                                                        echo "<option value='" . $result['name'] ."'>" . $result['name'] ."</option>";
                                                 } 
                                                ?>
                                        </select></div>
                                </div>
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-2">Zip</label>
                                    <div class="col-sm-4 input"><input name='zip' value="<?php echo $r['zip']; ?>" id="zip"  placeholder="Please Enter City" class="form-control" ></div>

                                

                                
                                    <label for="login_password" class="control-label col-sm-2">Country</label>
                                    <div class="col-sm-4 input"><select name="Country"  id="Country" class="form-control" >   
                                           <option value=""> Please select Country </option>
                                                 <?php 
                                                    $query =mysql_query("select name from countries where id=231");
                                                    while($res = mysql_fetch_array($query))
                                                    {
                                                       
                                                                //echo '<option value="'.$r["id"].'">'.$r["game_title"].'( Match Id - '.$r["id"].')</option>';
                                                                echo "<option value='" . $res['name'] ."'>" . $res['name'] ."</option>";
                                                        //echo ($r[team_name]);
                                                    } 
                                                ?>
                                                                
                                                         </select></div>
                                </div>-->
                          
                               <div class="form-group">
                                    <label for="paypal_email" class="control-label col-sm-2">Paypal Email</label>
                                    <div class="col-sm-4 input"><input name='paypal_email' value="<?php echo $r['paypal_email']; ?>" id="paypal"  placeholder="Please Enter Paypal Email"  class="form-control email" required="" ></div>
                                    <label for="Gamertag" class="control-label col-sm-2">Gamertag</label>
                                    <div class="col-sm-4 input"><input name='Gamertag' id="Gamertag" value="<?php echo $r['gamertag']; ?>" placeholder="Please Enter Gamertag"  class="form-control" required="" ></div>
                                
                                </div> 

        <div class="row">
             <div class="col-sm-12 text-center"><h3> <br class="hidden-xs">Social Media</h3></div>
                    <div class="col-sm-12 text-center">
                        
                    </div>
                </div>
                 <div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
            
                <fieldset>
                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-4">
                            <img src="<?php echo HOSTNAME; ?>assets/images/XboxLogo.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label>
                            <div class="col-sm-6 input">
                                <input name='xbox' id="xbox" value="<?php echo $r['xbox'];?>" placeholder="xbox" class="form-control" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-4">
                                <img src="<?php echo HOSTNAME; ?>assets/images/playstation final.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                            <div class="col-sm-6 input"><input name='plastation' id="plastation" value="<?php echo $r['plastation'];?>" placeholder="playstation"  class="form-control" required=""></div>
                        </div>
                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-4">
                                <img src="<?php echo HOSTNAME; ?>assets/images/facebook.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                            <div class="col-sm-6 input"><input name='facebook' id="facebook" value="<?php echo $r['facebook']; ?>" placeholder="facebook"  class="form-control" ></div>
                        </div>
                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-4">
                              <img src="<?php echo HOSTNAME; ?>assets/images/Twitter.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                        <div class="col-sm-6 input"><input name='twitter' id="twitter" value="<?php echo $r['twitter']; ?>" placeholder="twitter"  class="form-control" ></div>
                    </div>
                </fieldset>
            
        </div>
    <div class="col-sm-6">
       
            <fieldset>
                <div class="form-group">
                    <label for="login_password" class="control-label col-sm-4">
                        <img src="<?php echo HOSTNAME; ?>assets/images/twitch logo.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                     <div class="col-sm-6 input"><input name='twitch' id="twitch" value="<?php echo $r['twitch']; ?>" placeholder="twitch"  class="form-control"></div>
                </div>
                <div class="form-group">
                    <label for="login_password" class="control-label col-sm-4">
                        <img src="<?php echo HOSTNAME; ?>assets/images/steam.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                    <div class="col-sm-6 input"><input name='steam' id="steam" value="<?php echo $r['steam']; ?>" placeholder="steam"  class="form-control"></div>
                </div>
                <div class="form-group">
                    <label for="login_password" class="control-label col-sm-4">
                        <img src="<?php echo HOSTNAME; ?>assets/images/skype.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                    <div class="col-sm-6 input"><input name='skype' id="skype" value="<?php echo $r['skype']; ?>" placeholder="skype"  class="form-control"></div>
                </div>
                <div class="form-group">
                    <label for="login_password" class="control-label col-sm-4">
                        <img src="<?php echo HOSTNAME; ?>assets/images/youtube.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                    <div class="col-sm-6 input"><input name='youtube' id="youtube" value="<?php echo $r['youtube']; ?>" placeholder="youtube"  class="form-control"></div>
                </div>
                
                
            </fieldset>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                    <label for="" class="control-label col-sm-4 back hidden-xs">&nbsp;</label>
                    <div class="col-sm-6 input text-center">
                        <button class="btn btn-success" type="submit" name="Update" id="Update" value="Update">Update <i class="glyphicon glyphicon-chevron-right"></i></button>

                    </div>
                </div>
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
include "config.php";
if(isset($_POST['Update']))
                {
                     $First_Name = $_POST['First_Name'];
                     $Last_Name = $_POST['Last_Name'];
                     $Address = $_POST['Address'];
                     $Gamertag = $_POST['Gamertag'];
                     $City = $_POST['City'];
                     $State = $_POST['State'];
                     $zip = $_POST['zip'];
                     $Country = $_POST['Country'];
                     $paypal_email = $_POST['paypal_email'];

                      $xbox = $_POST['xbox'];
                      $plastation = $_POST['plastation'];
                      $facebook = $_POST['facebook'];
                      $Twitter = $_POST['twitter'];
                      $twitch = $_POST['twitch'];
                      $steam = $_POST['steam'];
                      $skype = $_POST['skype'];
                      $youtube = $_POST['youtube'];
                     
                    $userid = $_SESSION['user_data']['id'];

                    $sql="UPDATE users SET First_Name='$First_Name', Last_Name='$Last_Name', Address='$Address',Gamertag='$Gamertag',City='$City',State='$State',Country='$Country',zip='$zip', paypal_email = '$paypal_email', xbox = '$xbox',plastation = '$plastation',facebook = '$facebook',Twitter = '$Twitter',twitch = '$twitch',steam = '$steam',skype = '$skype',youtube = '$youtube' WHERE id='$userid'";   
                    $result = mysql_query($sql);
                    if($result)
                    {
                    header("location: myprofile.php?usersid=$userid");
                    //$action='myprofile.php?usersid=<?php echo $userid; 
                    }
        }
?>
<?php include "footer.php";?>


