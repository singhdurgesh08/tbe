
<style>
.dropbtn {
    background-color: #f9f9f9;
    color: red;
    padding: 16px;
    font-size: 16px;
    cursor: pointer;
}
.dropdown {
    position: absolute;
    display: inline-block;

}

.dropdown-content {
    display: none;
    color: black;
    border-bottom: 5px solid #2ba0db;
    position:  absolute;
    right: 0;
    left: none;
    background-color: rgb(31, 215, 219);
    min-width: 160px;
    box-shadow: 0px 8px 8px 0px rgba(0,0,0,0.2);
 
}
.dropdown-content a {
    color: black;
    padding: 15px 16px;
    text-decoration:inherit; ;
    font-weight: bold ;
    display: block;
}
.dropdown-content a:hover {background-color: #f1f1f1;
color:black;
text-decoration: solid;
  border-left: 3px solid red;
}
.dropdown:hover .dropdown-content {
    display: block;
}
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
.navbar-default .navbar-collapse, .navbar-default .navbar-form {
    border-color: #333;
/*    background-color: black;*/
    color: white;
    margin-left: 50px;
    margin-right: 0px;
}
.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
    color: #000;
    background-color: #f1f1f1;
    font-weight: bold;

}
.nav>li>a { margin: 0; }

.toggle + a,
 .menu { display: none; }

.toggle {
  display: block;
  background-color: #254441;
  padding: 0 20px;
  color: #FFF;
  font-size: 20px;
  line-height: 60px;
  text-decoration: none;
  border: none;
}

.toggle:hover { background-color: #000000; }

[id^=drop]:checked + ul { display: block; }
}
.home_tab_section {
    padding-top: 80px;
    padding-bottom: 80px;
    background: #f5f4f4;
}
.nav ul {
  font-size: 0;
  margin: 0;
  padding: 0;
}

</style>
<?php
  $file=$_SERVER["SCRIPT_NAME"];
   $userid = $_SESSION['user_data']['id'];
 $is_admin = $_SESSION['user_data']['is_admin'];
// echo "<pre>111111111111111111111==============="; print_r($withdraw);
?>
<section class="menu_section">
<div class="container">
    <nav class="navbar navbar-default" role="navigation">
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
	  </div>

	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav top_menu">
		  <li class=" dropdown <?php if(ereg("leadership.php",$file)>0 || ereg("staff.php",$file)>0  || ereg("faq.php",$file)>0) echo " active"; ?>"><a class="active"  href="teamlist.php">Team</a>
		  <div class="dropdown-content" style="z-index:999;">
          
            	<?php
                       $join_team = mysql_query("Select team_id from team_list where user_id = '$userid'"); 
                       while($rteam = mysql_fetch_array($join_team))
                       { 
                           $teamId[] = $rteam['team_id'];
                       }
                        $joinTeamId = implode(",",$teamId);
                        if ($joinTeamId){
                          $res = mysql_query("Select * from team where created_by = '$userid' UNION Select * from team where id in ($joinTeamId)");  
                        }else {
                             $res = mysql_query("Select * from team where created_by = '$userid'"); 
                        }
            	   	 
			while($r = mysql_fetch_array($res))
			{
                                if ($r['platform'] == PS4) {
                                $var = '<img src="assets/images/playstation final.png" width="25" class="img-responsive" alt="" style="display:inline; " />';
                                echo ('<a href=teamdetails.php?teamid=' . $r[id] . '>' . substr($r['team_name'], 0, 12) . '..&nbsp;' . $var . '</a>');
                                // echo ('<a href=teamdetails.php?teamid=' . $r[id] . '>'. $r[team_name].'</a>');
                                } else {
                                //echo ('<img src="assets/images/xb1_list.jpg" width="10"  class="img-responsive" alt="" style="display:inline; " />' . '<a href=teamdetails.php?teamid=' . $r[id] . '>'. $r[team_name].'</a>');
                                $var1 = '<img src="assets/images/xb1_list.jpg" width="25" class="img-responsive" alt="" style="display:inline; " />';
                                echo ('<a href=teamdetails.php?teamid=' . $r[id] . '>' . substr($r['team_name'], 0, 10) . '..&nbsp;' . $var1 . '</a>');
                                }

                   
			} 
					
	   			 
	   			 ?>
          
		</div>
		  </li>

		  
		  <li class="<?php if(ereg("ps4.php",$file)>0) echo " active"; ?>"><a href="ps4.php">PS4</a></li>
		  <li class="<?php if(ereg("xb1.php",$file)>0) echo " active"; ?>"><a href="xb1.php">XB1</a></li>
		  <li class="<?php if(ereg("top50goals.php",$file)>0) echo " active"; ?>"><a href="http://tbesportsgaming.com/forum/" target="_balnk">Forum</a></li>
		  <li class=" dropdown <?php if(ereg("leadership.php",$file)>0 || ereg("staff.php",$file)>0  || ereg("faq.php",$file)>0) echo " active"; ?>"><a class="active">Support</a>
		  <div class="dropdown-content" style="z-index:999;">
                        <a href="ticket.php">Ticket</a>
						<a href="faq.php">Faq</a>
		</div>
		  </li>
		  <li class="dropdown selected">
			<a class="dropbtn" style="color:red;background-color: yellow;" > <b><?php echo substr($_SESSION['user_data']['user_name'],0,20);?> &nbsp;</b></a>  
      <div class="dropdown-content" style="z-index:999;">
			<a href="home.php">Home</a> 
      <a href="myprofile.php?usersid=<?php echo $userid ?>">My Profile</a>
      <a href="editprofile.php">Edit Profile</a>
        <a href="subscribe_membership.php">Membership</a>
			<a href="wallet.php">Wallet</a>    
		 	<a href="teaminvite.php">Team Invites</a>    
      <?php 
        $res = mysql_query("Select * from users where id = $userid");
        $record = mysql_fetch_array($res);
         if($record[is_admin] ==1)
          {
            ?><a href="paymenthistory.php">Payment History</a><?php
          }
        
      ?>
      <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign-out</a>
		</div>
		  </li>
		</ul>
	  </div><!-- /.navbar-collapse -->
	</nav>
 </div>
 </section>