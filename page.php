<?php 
include "config.php";
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
 }

include "login-header.php";
include "nav.php";
?>


<html>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/style.css">
	<script src="<?php echo $baseurl; ?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $baseurl; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
       <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<head>
<style>
body{background:#F0F0F0;}
*{margin:0; padding:0;}
.container {width:100%; margin:0 auto;}
.head{text-align: center;}
.tbe {font-size: 30px; padding: 10px 90px 10px 0px; font-family:}
.profile{text-align: center; margin-top: 10px;}
.my{font-size: 30px; padding: 10px 0px}
.edit{background-color: #4CAF50; color: white; padding: 10px 10px; text-align: center; display: inline-block; font-size: 16px; margin: -6px 10px; float: right; border-radius: 12px;}
.left{width: 49%; height: 500px; float: left;}
.image{margin: 20px 0 0 40px; display: inline-block;}
.right{width: 49%; height: 500px; float: left;}
.button{float: right; display: inline-block; margin-top: 50px;}
.Gamertag{font-size: 20px; margin: 10px 0px 0px 228px}
.playstation{margin: 10px 0px 0px 167px; float: left}
.playstation_text{margin: 16px 0px 0px 20px; float: left}
.clr{clear: both;}
.Xbox{margin: 10px 0px 0px 167px; float: left}
.xbox_text{margin: 16px 0px 0px 20px; float: left}
.social_media{margin: 163px 0px 0px 150px;font-size: 20px}
.fb_logo{float: left; margin: 10px 0 0 40px;}
.facebook{margin: 15px 0 0 15px; font-size: 17px; float: left; text-decoration: none !important;}
.twitter_logo{float: left; margin: 10px 0 0 40px}
.twitter{margin: 15px 0 0 15px; font-size: 17px; float: left; text-decoration: none !important;}
.youtube_logo{float: left; margin: 10px 0 0 40px}
.youtube{margin: 15px 0 0 15px; font-size: 17px; float: left; text-decoration: none !important;}
.twitch_logo{float: left; margin: 10px 0 0 40px}
.twitch{margin: 15px 0 0 15px; font-size: 17px; float: left;}
.steam_logo{float: left; margin: 10px 0 0 40px}
.steam{margin: 15px 0 0 15px; font-size: 17px; float: left; text-decoration: none !important;}
.skype_logo{float: left; margin: 10px 0 0 40px}
.skype{margin: 15px 0 0 15px; font-size: 17px; float: left; text-decoration: none !important;}
</style>
</head>
<body>
  <div class= "profile">
    <div class= "container">
	  <span class= "my">
	    MY PROFILE
	  </span>
	 
	</div>
  </div>
  <div class= "left">
    <div class= "container">
			   	  <span class= "image">
				    <img src="assets/images/profile.jpg" alt="image">
				  </span>
	  <span class= "date">
	  	&nbsp;&nbsp;&nbsp;
	    				 <?php
                            $res = mysql_query("Select * from users where id= $userid");
                            $r = mysql_fetch_array($res);
                            echo "Created  ".$r[createddate];

                        ?> 

	  </span>
			  <div class= "Gamertag">
			    Gamertag
			  </div>
	  <div class= "playstation">
	    <img src="assets/images/playstation final.png" alt="image" style="width:30px;height:30px;">
	  </div>
	 
	  <div class= "playstation_text">
	    <input type="text" name="playstation_text" style=" width:120px;height:20px;">
	  </div>
	 
	  <div class= "clr">
	    
	  </div>

	  <div class= "Xbox">
	    <img src="assets/images/xb1_list.jpg" alt="image" style="width:30px;height:30px;">
	  </div>

	  <div class= "xbox_text">
	    <input type="text" name="xbox_text" style=" width:120px;height:20px;">
	  </div>
	</div>
  </div>
  <div class= "right">
    <div class= "container">
    	<div class="button">
    		<span><a href="<?php echo $baseurl; ?>editprofile.php" class="btn btn-info">Edit Profile</a></span>
    	</div>
	  <div class= "social_media">
	    SOCIAL MEDIA
	  </div>
	  
	  <div class= "fb_logo">
	    <img src="assets/images/facebook.png" alt="image" style="width:27px;height:27px;">
	  </div>
	  
	  <div class= "facebook">
	    <a href="#">Facebook</a>
	  </div>
	  
	  <div class= "clr">
	  </div>
	  <div class= "twitter_logo">
	    <img src="assets/images/twitter.png" alt="image" style="width:27px;height:27px;">
	  </div>
	  <div class= "twitter">
	    <a href="#">Twitter</a>
	  </div>
	  <div class= "clr">
	  </div>
	  <div class= "youtube_logo">
	    <img src="assets/images/youtube.png" alt="image" style="width:27px;height:27px;">
	  </div>
	  <div class= "youtube">
	    <a href="#">Youtube</a>
	  </div>
	  <div class= "clr">
	  </div>
	  <div class= "twitch_logo">
	    <img src="assets/images/twitch logo.png" alt="image" style="width:27px;height:27px;">
	  </div>
	  <div class= "twitch">
	    <a href="#">Twitch</a>
	  </div>
	  <div class= "clr">
	  </div>
	  <div class= "steam_logo">
	    <img src="assets/images/steam.png" alt="image" style="width:27px;height:27px;">
	  </div>
	  <div class= "steam">
	    <a href="#">Steam</a>
	  </div>
	  <div class= "clr">
	  </div>
	  <div class= "skype_logo">
	    <img src="assets/images/skype.png" alt="image" style="width:27px;height:27px;">
	  </div>
	  <div class= "skype">
	    <a href="#">Skype</a>
	  </div>
	</div>
  </div>
  </spam>	
</body>
</html>
hbcdb
dcjknc
cjndc

echo ('<img src="assets/images/ps4_list.jpg" width="10" class="img-responsive" alt="" style="display:inline; " />' );
								echo ('<a href=teamdetails.php?teamid=' . $r[id] . '>'. $r[team_name].'</a>');

<?php include "footer.php";?>