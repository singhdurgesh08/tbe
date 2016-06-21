<?php 
include "config.php";
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
 }
include "login-header.php";?>
<?php include "nav.php";?>
 <?php
$userid = $_SESSION['user_data']['id'];
$res = mysql_query("Select * from users where id= $userid");
$r = mysql_fetch_array($res);
//  echo print_r($r);
?>

<script>
$(document).ready(function(){
  $("#editform").validate();
    });
</script>
<div class="home_tab_section">
<div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1><br class="hidden-xs">Personal Information</h1>
                    </div>
                </div>
                <div>
                    &nbsp;
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <form method='post' id="editform" class="form-horizontal">
                        <fieldset>
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">First Name</label>
                                    <div class="col-sm-6 input"><input name='First_Name' id="name" value="<?php echo $r['first_name']; ?>" placeholder="Please Enter First Name" class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Last Name</label>
                                    <div class="col-sm-6 input"><input name='Last_Name' id="lname" value="<?php echo $r['last_name']; ?>" placeholder="Please Enter Last Name"  class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Address</label>
                                    <div class="col-sm-6 input"><input name='Address' id="address" value="<?php echo $r['Address']; ?>" placeholder="Please Enter Street address"  class="form-control" required="" ></div>
                                </div>

                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Gamertag</label>
                                    <div class="col-sm-6 input"><input name='Gamertag' id="Gamertag" value="<?php echo $r['gamertag']; ?>" placeholder="Please Enter Street address"  class="form-control" required="" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">City</label>
                                    <div class="col-sm-6 input"><input name='City' id="city" value="<?php echo $r['city']; ?>"  placeholder="Please Enter City"  class="form-control" required="" ></div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">State</label>
                                    <div class="col-sm-6 input"><select name="State" id="state" class="form-control" required="">   
                                                   <option value=""> Please select State </option>
                                                                     <?php 
                                                    $query =mysql_query("select name from states");
                                                    while($result = mysql_fetch_array($query))
                                                    {
                                                       
                                                                //echo '<option value="'.$r["id"].'">'.$r["game_title"].'( Match Id - '.$r["id"].')</option>';
                                                                echo "<option value='" . $result['name'] ."'>" . $result['name'] ."</option>";
                                                        //echo ($r[team_name]);
                                                    } 
                                                ?>
                                                                
                                                                
                                                                  </select></div>
                                </div>
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Zip</label>
                                    <div class="col-sm-6 input"><input name='zip' value="<?php echo $r['zip']; ?>" id="zip"  placeholder="Please Enter City" class="form-control" required="" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Country</label>
                                    <div class="col-sm-6 input"><select name="Country" id="Country" class="form-control" required="">   
                                           <option value=""> Please select Country </option>
                                                                 
                                                                    <?php 
                                                    $query =mysql_query("select name from countries");
                                                    while($res = mysql_fetch_array($query))
                                                    {
                                                       
                                                                //echo '<option value="'.$r["id"].'">'.$r["game_title"].'( Match Id - '.$r["id"].')</option>';
                                                                echo "<option value='" . $res['name'] ."'>" . $res['name'] ."</option>";
                                                        //echo ($r[team_name]);
                                                    } 
                                                ?>
                                                                
                                                         </select></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Paypal Email</label>
                                    <div class="col-sm-6 input"><input name='paypal_email' value="<?php echo $r['paypal_email']; ?>" id="paypal"  placeholder="Please Enter City"  class="form-control email" required="" ></div>
                                </div> 

                                <div class="form-group">
                                    <label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
                                    <div class="col-sm-6 input text-center">
                                    <button class="btn btn-lg btn-block btn-success" type="submit" name="Update" id="Update" value="Update">Update <i class="glyphicon glyphicon-chevron-right"></i></button>
                               
                                </div>
                            </div>
                        </fieldset>
                </form>
                </div>
                </div>
</div></div>
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
                     
                    $userid = $_SESSION['user_data']['id'];

                    $sql="UPDATE users SET First_Name='$First_Name', Last_Name='$Last_Name', Address='$Address',Gamertag='$Gamertag',City='$City',State='$State',Country='$Country',zip='$zip', paypal_email = '$paypal_email' WHERE id='$userid'";   
                    mysql_query($sql);
                {
                    echo"<script>alert('Update profile successfully')</script>";
                }
        }
?>
<?php include "footer.php";?>


