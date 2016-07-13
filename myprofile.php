<?php
include "config.php";
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
 }
$usersid = $_GET['usersid'];
include "common.php"; 
//$userid = $_GET['userid'];
 include "login-header.php";?>
<?php include "nav.php";?>
<div class="home_tab_section">
<div class="container">
     <div class="col-sm-12 text-center"><h3 class="index_memberTitle"><?PHP
     $query = mysql_query("Select * from users where id= $usersid ");
     $result = mysql_fetch_array($query);
      echo $result ['user_name'];?> Profile</h3></div>	
	<div class="row">
                <div class="col-sm-3">
               <?php        
                    $finalimage =  $result ['user_image'];
                    if($finalimage) {  ?>
                            <img src="<?php echo HOSTNAME; ?>upload/<?php echo $finalimage;?>" width="150" class="img-responsive" alt="" />
                      <?php } else { ?>
                       <img src="<?php echo HOSTNAME; ?>assets/images/match_profile.png" class="img-responsive" alt="" >
                       <?php }  ?>
                
                </div>
                    <div class="col-sm-8" >
                         <table id="example" class="table table-striped table-bordered " cellspacing="0" width="100%">
                            <thead class="thead-inverse">
                                <tr >
                                    <th>Win</th>
                                    <th>Loss</th>
                                    <th>Total Point Won</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <?php 
                                    $win = calUserWin($usersid); 
                                    echo $win['win'];
                                    ?>
                                    </td>
                                    <td>
                                    <?php 
                                    $loss = calUserLoss($usersid); 
                                    echo $loss['loss'];
                                    ?>
                                    </td>
                                    <td>
                                        <?php 
                                       $point = totalEarnPoint($usersid); 
                                        echo $point['earnpoint'];
                                        ?>
                                    </td>
                             </tr>                                         
                             </tbody>
                        </table>
                        <table class="table">
                          <tbody>
        <tr class="bg-primary">
          <th class="text-center">Social Media</th>
      </tr>
    </tbody>
</table>
<div class="col-sm-8">
            <form method='post' action='myprofile.php' class="form-horizontal">
             <!--   <fieldset>
                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7"></label>
                        <div class="col-md-4 col-md-push-1"></div>
                    </div> 
                        
                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">First Name :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $result['first_name']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">Last Name :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $result['last_name']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">Address :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $result['Address']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">City :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $result['city']; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">State :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $result['State']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">Zip :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $result['zip']; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="login_password" class="control-label col-sm-7">Country :</label>
                        <div class="col-md-4 col-md-push-1"><?php echo $result['Country']; ?></div>
                    </div>
                  </fieldset>-->
            </form>
        </div>
<div class="col-sm-12  ">
    <div class="row">
        <div class="col-sm-6 ">
            <form method='post' id="editform" class="form-horizontal ">

                <fieldset>
                   
              
                    <div class="form-group ">
                        <label for="login_password" class="control col-sm-3">
                            <img src="<?php echo HOSTNAME; ?>assets/images/XboxLogo.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label>
                             <label class="control col-sm-4"><?php echo $result['xbox']; ?></label>

                        </div>
                        <div class="form-group">
                    <label for="login_password" class="control col-sm-3">
                        <img src="<?php echo HOSTNAME; ?>assets/images/snapchat.jpg" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                     <label class="control col-sm-4"><?php echo $result['steam']; ?></label>
                </div>
                        <div class="form-group">
                            <label for="login_password" class="control col-sm-3">
                                <img src="<?php echo HOSTNAME; ?>assets/images/facebook.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                             <label class="control col-sm-4"><a href="http://Facebook.com/" target="_blank"><?php  echo $result['facebook']; ?> </a></label>
                        </div>
                        <div class="form-group">
                            <label for="login_password" class="control col-sm-3">
                              <img src="<?php echo HOSTNAME; ?>assets/images/Twitter.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                        <label class="control col-sm-4 "><a href="http://Twitter.com/" target="_blank"><?php echo  $result['twitter']; ?> </a></label>
                    </div>
                </fieldset>
            </form>
        </div>
    <div class="col-sm-6">
        <form method='post' id="editform" class="form-horizontal from-inline">
            <fieldset>
              <div class="form-group">
                            <label for="login_password" class="control col-sm-3">
                                <img src="<?php echo HOSTNAME; ?>assets/images/playstation final.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                             <label class="control col-sm-4" ><a href="#"><?php echo  $result['plastation']; ?></a></label>
                        </div>
                <div class="form-group">
                    <label for="login_password" class="control  col-sm-3">
                        <img src="<?php echo HOSTNAME; ?>assets/images/instagram.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                      <label class="control col-sm-4"><a href="http://Instagram.com/" target="_blank"><?php echo  $result['skype']; ?></a></label>
                </div>

                <div class="form-group">
                    <label for="login_password" class="control col-sm-3">
                        <img src="<?php echo HOSTNAME; ?>assets/images/twitch logo.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                      <label class="control col-sm-4 "><a href="http://Twitch.tv/" target="_blank"><?php echo  $result['twitch']; ?></a></label>
                </div>
                
                <div class="form-group">
                    <label for="login_password" class="control col-sm-3">
                        <img src="<?php echo HOSTNAME; ?>assets/images/youtube.png" class="img-circle" alt="Cinque Terre" width="30" height="30"></label></label>
                    <label class="control col-sm-4"><a href="http://Youtube.com/" target="_blank"><?php echo  $result['youtube']; ?></a></label>
                </div>
            </fieldset>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
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
                
    
 if(isset($_POST['btn-upload']))
 {          

       $image =addslashes(file_get_contents($_FILES['image']['tmp_name']));
       $image_name = addslashes($_FILES['image']['name']);
       $image_size = getimagesize($_FILES['image']['tmp_name']);
       if ($image_size==FALSE) {
           echo "That's not an image";
       }
       else
       {
           if(!$query =mysql_query("INSERT INTO `user_profile_image` VALUES ('','$userid',' $image','$image_name')"))
           {
                echo "problem to upload your profile image"; 
           } 
           else
           {
                echo "Your image successfullly uploaded";
           }
            
        }             
}
?>

<iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/89972779/favorites&amp;auto_play=true&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>

<div id="disqus_thread"></div>
<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
     */
    /*
     var disqus_config = function () {
     this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
     this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
     };
     */
    (function() {  // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');

        s.src = '//tbesportsgaming.disqus.com/embed.js';

        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
<div>&nbsp;</div>
<?php include "footer.php";?>

