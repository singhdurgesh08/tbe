<style>
.dropdown-menu > li > a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: bold;
    line-height: 2.4;
    color: #333;
    white-space: nowrap;
}
.navbar-default .navbar-collapse, .navbar-default .navbar-form {
    border-color: #333;
/*    background-color: black;*/
    color: white;
    margin-left: 50px;
    margin-right: 0px;
    padding-bottom: 0;
}
.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
    color: #000;
    background-color: #f1f1f1;
    font-weight: bold;}

 .dropdown-menu {
    display: relative;
    color: black;
    position:  absolute;
    right: 0px;
    left: 0px;
    font-size: 15px;
    background-color: rgb(31, 215, 219);
    min-width: 160px;
    box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.2);
     width: 95%;
     float left:30px;
   
}

        #nav li:hover ul
        {
            display: block;
            
            font-weight: bold;


        }
@media only screen and ( max-width: 40em ) /* 640 */
{
   
   
        #navbar:target > ul
        {
            display: block;
        }
        #navbar > ul > li
        {
            width: 100%;
            float: right;
        }
 
    /* second level */
 
    #nav li ul
    {
        position: relative;

    }
}
</style>

<?php
  $file=$_SERVER["SCRIPT_NAME"];
   $userid = $_SESSION['user_data']['id'];
 $is_admin = $_SESSION['user_data']['is_admin'];
// echo "<pre>111111111111111111111==============="; print_r($withdraw);
?>
<section class="menu_section">

<div class="menu_section navbar-centred" id="nav">
    <nav id="Navbar" class="navbar navbar-default " role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container">
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
                <ul class="nav navbar-nav">
                <li class="dropdown">
                        <a href="teamlist" data-toggle="dropdown" class="dropdown-toggle">TEAM <b class="caret"></b></a>
                        <ul class="dropdown-menu"><li>
                             <?php
                         $join_team = mysql_query("Select team_id from team_list where user_id = '$userid' and player_status = '1'"); 
                         while($rteam = mysql_fetch_array($join_team))
                         { 
                             $teamId[] = $rteam['team_id'];
                         }
                          $joinTeamId = implode(",",$teamId);
                          if ($joinTeamId){
                            $res = mysql_query("Select * from team where created_by = '$userid' and Status ='1' UNION Select * from team where Status ='1' and id in ($joinTeamId) ");  
                          }else {
                               $res = mysql_query("Select * from team where created_by = '$userid' and Status ='1'"); 
                          }
                       
              while($r = mysql_fetch_array($res))
              {
                                  if ($r['platform'] == PS4) {
                                  $var = '<img src="assets/images/playstation final.png" width="25" class="img-responsive" alt="" style="display:inline; " />';
                                  echo ('<a href=teamdetails?teamid=' . encryptor("encrypt",$r[id]) . '>' . substr($r['team_name'], 0, 12) . '..&nbsp;' . $var . '</a>');
                                  // echo ('<a href=teamdetails.php?teamid=' . $r[id] . '>'. $r[team_name].'</a>');
                                  } else {
                                  //echo ('<img src="assets/images/xb1_list.jpg" width="10"  class="img-responsive" alt="" style="display:inline; " />' . '<a href=teamdetails.php?teamid=' . $r[id] . '>'. $r[team_name].'</a>');
                                  $var1 = '<img src="assets/images/xb1_list.jpg" width="25" class="img-responsive" alt="" style="display:inline; " />';
                                  echo ('<a href=teamdetails?teamid=' . encryptor("encrypt",$r[id]) . '>' . substr($r['team_name'], 0, 10) . '..&nbsp;' . $var1 . '</a>');
                                  }
        }

        ?>
            
                       </li> </ul>
                    </li>

                    <li class="<?php if(ereg("ps4",$file)>0) echo " active"; ?>"><a href="ps4">PS4</a></li>
                     <li class="<?php if(ereg("xb1",$file)>0) echo " active"; ?>"><a href="xb1">XB1</a></li>
                    <li class="<?php if(ereg("top50goals",$file)>0) echo " active"; ?>"><a href="http://www.tbesportsgaming.com/forum/index" target="_blank">Forum</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">SUPPORT <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="ticket">Ticket</a></li>
                            <li><a href="faq">F.A.Q</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropbtn" id="nav" href="#" data-toggle="dropdown" class="dropdown-toggle" style="color:red;background-color: yellow;"><strong><?php echo substr($_SESSION['user_data']['user_name'],0,20);?> &nbsp;</strong><b class="caret"></b></a>
                        <ul class="dropdown-menu">
<!--                            <li><a href="home">Home</a> </li>-->
                            <li><a href="myprofile?usersid=<?php echo encryptor('encrypt',$userid); ?>">My Profile</a></li>
                             <li> <a href="editprofile">Edit Profile</a></li>
                             <li><a href="wallet">Wallet</a></li>
                            <li> <a href="subscribe_membership">Membership</a></li>
                            <li> <a href="teamlist">Team List</a></li>
                            <li><a href="teaminvite">Team Invites</a>
                            <li><a href="withdraw">Withdraw History</a>
                            <?php 
                                $res = mysql_query("Select * from users where id = $userid");
                                $record = mysql_fetch_array($res);
                                 if($record[is_admin] ==1)
                                  {
                                    ?><a href="paymenthistory">Payment History</a><?php
                                  }
                                ?>
                                </li><li class="divider"></li>
                            <li> <a href="logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign-out</a></li>
                        </ul>
                    </li>
                </ul>
               
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</div>

 </section>