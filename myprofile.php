<?php 
include "config.php";
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
 }
 

include "login-header.php";?>
<?php include "nav.php";?>
<div class="home_tab_section">
<div class="container">
     <div class="col-sm-12 text-center"><h3 class="index_memberTitle">Personal Information</h3></div>	
	<div class="row">
		
                <div class="col-sm-3">
                <img src="<?php echo HOSTNAME; ?>assets/images/profile.jpg" width="150" class="img-responsive" alt="" />
                <form action="myprofile.php"
                                enctype="multipart/form-data" method="post">
                                <p> <br> <input type="file" name="file" size="40"> </p>
                                <div>
                                <input type="submit" name="btn-upload" value="Upload" class="btn btn-primary"/>
                                </div>
                        </form>
                
                </div>
                    <div class="col-sm-8">
                         <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Win</th>
                                    <th>Loss</th>
                                    <th>Life Time</th>
                                    <th>Earn Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                 <td>1</td>
                                 <td>1</td>
                                 <td>Yes</td>
                                 <td>123</td>
                             </tr>
                                        
                                         
                             </tbody>
                        </table>

                    </div>
                    <div class="col-sm-8">
                    <table class="table">
    
     <tbody>
        <tr class="bg-primary">
        <th></th>
        <th>General Information</th>
         <th>&nbsp;&nbsp;</th>
         <th>&nbsp;&nbsp;</th>
         <th>&nbsp;&nbsp;</th>
         <th>&nbsp;&nbsp;</th>
         <th>&nbsp;&nbsp;</th>
        <th class="right">Social Media</th>
      </tr>

       </tbody>
</table>
           
</div>

</div>
     <div class="col-sm-8">
            <form method='post' action='myprofile.php' class="form-horizontal">

                <fieldset>
                    <div>
                        <?php
                        
                        if($_GET['profileid'] !=''){
                            $userid = $_GET['profileid'];
                        }else {
                            $userid = $_SESSION['user_data']['id'];
                        }
                        
                        $res = mysql_query("Select * from users where id= $userid");
                        $r = mysql_fetch_array($res);
                        //  echo print_r($r);
                        ?></div>
                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7"></label>
                        <div class="col-md-4 col-md-push-1"></div>
                    </div> 
                        
                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">First Name :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $r['first_name']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">Last Name :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $r['last_name']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">Address :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $r['Address']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">City :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $r['city']; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">State :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $r['State']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">Zip :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $r['zip']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">Country :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $r['Country']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">Paypal Email :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $r['paypal_email']; ?></div>
                    </div>

                </fieldset>
            </form>
        </div>

                    <div class="row">
                    <div class="col-sm-3"><span class="right">

                        <form method='post' id="editform" class="form-horizontal">
                        <fieldset>
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">
                                        <img src="<?php echo HOSTNAME; ?>assets/images/XboxLogo.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label>
                                    <div class="col-sm-6 input"><input name='Gamertag' id="name" value="<?php echo $r['Gamertag'];?>" placeholder="Gamertag" class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">
                                        <img src="<?php echo HOSTNAME; ?>assets/images/playstation final.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                                    <div class="col-sm-6 input"><input name='Last_Name' id="lname" value=""<?php echo $r['playstation'];?>" placeholder="playstation"  class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">
                                        <img src="<?php echo HOSTNAME; ?>assets/images/facebook.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                                    <div class="col-sm-6 input"><input name='Last_Name' id="lname" value="<?php echo $r['facebook']; ?>" placeholder="facebook`"  class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">
                                        <img src="<?php echo HOSTNAME; ?>assets/images/Twitter.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                                    <div class="col-sm-6 input"><input name='Last_Name' id="lname" value="<?php echo $r['Twitter']; ?>" placeholder="twitter".`"  class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">
                                        <img src="<?php echo HOSTNAME; ?>assets/images/twitch logo.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                                    <div class="col-sm-6 input"><input name='Last_Name' id="lname" value="<?php echo $r['twitch']; ?>" placeholder="twitch`.`"  class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">
                                        <img src="<?php echo HOSTNAME; ?>assets/images/steam.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                                    <div class="col-sm-6 input"><input name='Last_Name' id="lname" value="<?php echo $r['steam']; ?>" placeholder="steam`.`"  class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">
                                        <img src="<?php echo HOSTNAME; ?>assets/images/skype.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                                    <div class="col-sm-6 input"><input name='Last_Name' id="lname" value="<?php echo $r['skype']; ?>" placeholder="skype"  class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">
                                        <img src="<?php echo HOSTNAME; ?>assets/images/youtube.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                                    <div class="col-sm-6 input"><input name='Last_Name' id="lname" value="<?php echo $r['youtube']; ?>" placeholder="youtube"  class="form-control" required=""></div>
                                </div>

                               </div>
                            </div>
                        </fieldset>
                </form>

                </div>
            </span>
    </div>





   


    

<?php

include "config.php";
if(isset($_POST['submit']))
				{

                // echo "<pre>"; print_r($_POST); die;
				//	 $Email = $_POST['Email'];
					 $First_Name = $_POST['First_Name'];
					 $Last_Name = $_POST['Last_Name'];
					 $Street_Address = $_POST['Street_Address'];
					 $City = $_POST['City'];
					 $Country = $_POST['Country'];
					 $State = $_POST['State'];
					 $Postal_Code = $_POST['Postal_Code'];
					 $Gender = $_POST['Gender'];
					 $Time_zone = $_POST['Time_zone'];
					 $Date_of_Birth = $_POST['Date_of_Birth'];
					 
				if($Email=='') {
					echo "<script>alert('please enter your Email_address')</script>";
					exit();
				}
					 
							
				$query = "INSERT INTO `user_profile` (`id`, `Email_address`, `First_Name`, `Last_Name`, `Street_Address`, `City`, `Country`, `State`, `Postal_Code`, `Time_Zone`, `Gender`, `Date_of_Birth`, `user_id`, `playstation_id`) VALUES (NULL, '$Email', '$First_Name', '$Last_Name', '$Street_Address', '$City', '$Country', '$State', '$Postal_Code', '$Time_zone', '$Gender', '$Date_of_Birth','1','1')";
				if(mysql_query($query))
				{
					echo"<script>alert('Registration successfullly completed')</script>";
				}
		}

if(isset($_POST['Update']))
		{
			 //$Email = $_POST['Email'];
			 $First_Name = $_POST['First_Name'];
			 $Last_Name = $_POST['Last_Name'];
			 $Street_Address = $_POST['Street_Address'];
			 $City = $_POST['City'];
		     $Country = $_POST['Country'];
			 $State = $_POST['State'];
			 $Postal_Code = $_POST['Postal_Code'];
			 $Gender = $_POST['Gender'];
			 $Time_zone = $_POST['Time_zone'];
			 $Date_of_Birth = $_POST['Date_of_Birth'];
			









			 $sql="UPDATE user_profile SET First_Name='$First_Name', Last_Name='$Last_Name', Street_Address='$Street_Address',City='$City',Country='$Country',State='$State',Postal_Code='$Postal_Code',Gender='$Gender',Time_zone='$Time_zone',Date_of_Birth='$Date_of_Birth' WHERE Email_address='$user'";

			 $result =mysql_query($sql);
			 if($result)
			 {
			 			echo"<script>alert('successfullly Updated your profile')</script>";
			 }
			 else
			 {
			 			echo"<script>alert('your data is not updated successfullly')</script>";
			 }
   		}	
                
                if (isset($_POST['btn-upload'])) {
    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "uploads/";

    $new_size = $file_size / 1024;
    $new_file_name = strtolower($file);
    $final_file = str_replace(' ', '-', $new_file_name);

    if (move_uploaded_file($file_loc, $folder . $final_file)) {
        // $sql="INSERT INTO profile_image(file,type,size) VALUES('$final_file','$file_type','$new_size')";
        // mysql_query($sql);
        ?>
                      <script>
                      alert('successfully uploaded');
                            window.location.href='myprofile.php?success';
                            </script>
        <?php
    }
}
?>
<div>&nbsp;</div>
<?php include "footer.php";?>
