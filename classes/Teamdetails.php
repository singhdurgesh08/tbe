<?php session_start();
     ob_start();
include "login-header.php";
include "nav.php";
include "config.php";

$teamid = $_GET['teamid'];

 if (isset($_GET['usersid']) && is_numeric($_GET['usersid']))
    { $usersid = $_GET['usersid'];
        //  var_dump($teamid);
    
          $result = mysql_query("DELETE FROM team_list WHERE user_id = '$usersid' and team_id ='$teamid'");                                         
          header("location:teamdetails.php?teamid=$teamid"); exit;
    }
//$userid = $_SESSION['user_data']['id'];
$is_admin = $_SESSION['user_data']['is_admin'];
$is_userid = $_SESSION['user_data']['id'];
include "common.php"; 
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
<div class="home_tab_section">
    <div class="container">
        <div class="row">
            <!--/span-->
            <div class="col-md-9">
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-sm-4">
                           <div class="row">
                        <div class="col-sm-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            &nbsp;
                        </div>
                    </div>
        <?php
        $res = mysql_query("Select * from team where id= $teamid");
        $r = mysql_fetch_array($res);
        $created_by = $r['created_by'];
        $finalimage = $r['team_image'];
        // echo "<pre>"; print_r($r);
        if ($finalimage) {
    ?>
           <img src="<?php echo HOSTNAME; ?>upload/<?php echo $finalimage; ?>" width="200" class="img-responsive" alt="" />
        <?php } else { ?>
           <img src="<?php echo HOSTNAME; ?>assets/images/teamss.jpg" width="200" class="img-responsive" alt="" >
        <?php } ?>
                    </div>
<div class="col-sm-8 ">
    <?php
    // $res=mysql_query("Select * from team where id= $teamid");
    // $r=mysql_fetch_array($res);
    // echo "<pre>"; print_r($r);
    ?>
<div class="row">
    <div class="col-sm-12">
        <h3><strong>Team Name: <?php echo $r['team_name']; ?></strong></h3></div>
 </div>
    <div class="row">
    <div class="col-sm-6">
        Team ID  :- 0000<?php echo $r['id']; ?>
    </div>
    <div class="col-sm-6">
      Platform :- <?php echo $r['platform']; ?>
    </div> 
</div>
<div class="row">
    <div class="col-sm-6">
        Game Mode :- <?php echo $r['game_Mode']; ?>
    </div>
    <div class="col-sm-6">
        Register Date :- <?php echo date("d-M-Y", strtotime($r['date_added'])); ?>
    </div> 
<div>
    <div class="row">
    <div class="col-sm-11 centered">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <h4 class="text-center"><strong>Team Record</strong></h4></caption>  
                <thead class="thead-inverse">
                    <tr>
                      <th class="text-center">Win</th>
                      <th class="text-center">Loss</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            <?php 
                            $win = calWin($teamid); 
                            echo $win['win'];
                            ?>
                        </td>
                        <td class="text-center">
                            <?php 
                            $loss = calLoss($teamid); 
                            echo $loss['loss'];
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
</div>
</div>
</div> 
</div>
</div>
<div class="row">
  <div class="col-sm-12">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
       <h4 class="text-center"><strong>Roster</strong></h4> 
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
                                              ?> <a href="teamdetails.php?usersid=<?php echo $r['user_id'];?>&teamid=<?php echo $r['team_id'];?>">Disband Team</a> <?php
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
<div class="row">
</div>
                <div class="row">
                    <div class="col-sm-12">

                        <div class="home_tab_section">
                            <div class="container">
                                <div class="row">
                                    <div class="tabset-cashier col-md-12 ng-isolate-scope">
                                        <ul class="nav nav-tabs">
                                            <li role="presentation" class="ng-isolate-scope active">
                                                <a href="#1" data-toggle="tab">Recent Matches</a>
                                            </li>
                                            <li role="presentation" class="ng-isolate-scope">
                                                <a href="#2" data-toggle="tab">All Matches</a>
                                            </li>

                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="1">
                                                <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <caption class="text-center"></caption>  
                                                    <thead>
                                                        <tr>
                                                            <th>Recent Match</th>
                                                            <th>Result</th>
                                                            <th>Date</th>
                                                            <th>Vs Team</th>
                                                            <th>Info</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
if ($is_admin) {

    $res = mysql_query("Select * from users  
                                                left join join_match on join_match.created_by = users.id 
                                                left join ps4_match on ps4_match.id = join_match.match_id 
                                                where  ps4_match.open_date >= NOW() and join_match.team_id ='$teamid'");
} else {
    $res = mysql_query("Select * from users  
                                                left join join_match on join_match.created_by = users.id 
                                                left join ps4_match on ps4_match.id = join_match.match_id 
                                                where join_match.created_by = '$userid' and  ps4_match.open_date >= NOW() and join_match.team_id ='$teamid'");
}

while ($r = mysql_fetch_assoc($res)) {
    ?>      
                                                            <tr>
                                                                <td><?php echo $r[platform] ?></td>
                                                                <td><?php
                                                            if ($r[Match_play_status] == 0) {
                                                                echo "pending";
                                                            } else if ($r[Match_play_status] == 1) {
                                                                echo "Win";
                                                            } else {
                                                                echo "Loss";
                                                            }
                                                            ?></td>
                                                                 <td><?php echo date("Y-M-d h:i A",strtotime($r['open_date'])); ?></td>
                                                                <td>
                                                                    <?php
                                                                    $sql2 = mysql_query("select team_name from team where id=$teamid");
                                                                    $result1 = mysql_fetch_array($sql2);
                                                                    if ($r['platform'] == PS4) {
                                                                        echo '<img src="assets/images/playstation final.png" width="20" class="img-responsive" alt="" style="display:inline;" /> &nbsp; ' . $result1[team_name];
                                                                    } else {
                                                                        echo '<img src="assets/images/xb1_list.jpg" width="20" class="img-responsive" alt="" style="display:inline;"/> &nbsp; ' . $result1[team_name];
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><a href="matchdetails.php?Matchid=<?php echo $r[match_id] ?>">Match Details</a></td>

                                                            </tr>
                                                                <?php }
                                                                ?>

                                                    </tbody>

                                                </table>
                                            </div>
                                            <div class="tab-pane" id="2">
                                                <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <caption class="text-center"></caption>  
                                                    <thead>
                                                        <tr>
                                                            <th>Recent Match</th>
                                                            <th>Result</th>
                                                            <th>Date</th>
                                                            <th>Vs Team</th>
                                                            <th>Info</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
<?php
if ($is_admin) {
    $res = mysql_query("Select * from users  
                                                left join join_match on join_match.created_by = users.id 
                                                left join ps4_match on ps4_match.id = join_match.match_id 
                                                where  join_match.team_id ='$teamid'");
} else {
    $res = mysql_query("Select * from users  
                                                left join join_match on join_match.created_by = users.id 
                                                left join ps4_match on ps4_match.id = join_match.match_id 
                                                where join_match.created_by = '$userid' and join_match.team_id ='$teamid'");
}
while ($r = mysql_fetch_assoc($res)) {
    ?>      
                                                            <tr>
                                                                <td><?php echo $r[platform] ?></td>
                                                                <td><?php
                                                            if ($r[Match_play_status] == 0) {
                                                                echo "pending";
                                                            } else if ($r[Match_play_status] == 1) {
                                                                echo "Win";
                                                            } else {
                                                                echo "Loss";
                                                            }
                                                            ?></td>
                                                                 <td><?php echo date("Y-M-d h:i A",strtotime($r['open_date'])); ?></td>
                                                                <td>
                                                                    <?php
                                                                    $sql1 = mysql_query("select team_name from team where id=$teamid");
                                                                    $result = mysql_fetch_array($sql1);

                                                                    if ($r['platform'] == PS4) {
                                                                        echo '<img src="assets/images/playstation final.png" width="20" class="img-responsive" alt="" style="display:inline;" />' . $result[team_name];
                                                                    } else {
                                                                        echo '<img src="assets/images/xb1_list.jpg" width="20" class="img-responsive" alt="" style="display:inline;"/>' . $result[team_name];
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><a href="matchdetails.php?Matchid=<?php echo $r[match_id] ?>">Match Details</a></td>

                                                            </tr>
                                                                <?php }
                                                                ?>

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>

                                    </div>
                                </div><!--row end-->
                            </div>

                        </div>
                        <div>
                            <div class="row">
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        &nbsp;
                    </div>

                </div>
            </div>
        </div>
        <!--/span-->
        <?php
      
        if($is_userid == $created_by) { ?>
        <div class="col-md-3">
            <div class="sidebar-nav-fixed pull-right">
                <div class="well">
                    <ul class="nav ">
                        <li class="nav-header"></li>
                        <li class="active"><a href="xb1matchlist.php">Match Finder</a></li>
                       <!-- <li><a href="Addplayer.php?teamid=<?php echo $teamid; ?>">Add Member</a></li>-->
                       <!-- <li><a href="Teamdetails.php?teamid=<?php //echo $teamid;  ?>&action=DisableHere">Disable Team</a><li>-->
                        <li><a href="Editteam.php?teamid=<?php echo $teamid; ?>">Edit Team</a></li>
                        <!--<li><a href="allmatch.php">All Matches</a></li>-->  

                    </ul>
                </div>
                <!--/.well -->
            </div>
            <!--/sidebar-nav-fixed -->
        </div>
        <?php } ?>
        <!--/span-->

    </div>
    <!--/row-->


</div>
</div>
<?php ?>
<script>
//$(document).ready(function() {
//$('#example').DataTable();
////$("#join_team").modal("show");
//} );
    function acceptMatch(str, id) {
        $("#join_team").modal("show");
        $("#claim_title").val(str);
        $("#matchid").val(id);
    }
</script>

<?php
$sql = mysql_query("Select * from team where id= $teamid");
$result = mysql_fetch_array($sql);
$var = $result['game_Mode'];
$a = "1v1 Mycourt";
$b = "2v2 Mycourt";
$c = "3v3 Mycourt";
$d = "Quick Match";
$e = "Myteam";

$query = "SELECT count(*) AS total FROM team_list where team_id=$teamid";
$result1 = mysql_query($query);
$values = mysql_fetch_assoc($result1);
$num_rows = $values['total'];

if (isset($_POST['submit'])) {
    if ($var == $a and $num_rows == 1) {
        echo "<script>alert('your team is full in your game mode')</script>";
        exit();
    } elseif ($var == $b and $num_rows == 2) {
        echo "<script>alert('your team is full in your game mode')</script>";
        exit();
    } elseif ($var == $c and $num_rows == 3) {
        echo "<script>alert('your team is full in your game mode')</script>";
        exit();
    } elseif ($var == $d and $num_rows == 1) {
        echo "<script>alert('your team is full in your game mode')</script>";
        exit();
    } elseif ($var == $e and $num_rows == 2) {
        echo "<script>alert('your team is full in your game mode')</script>";
        exit();
    } else {
        $name = $_POST['name'];
        $res = mysql_query("Select id from users where user_name ='$name'");
        $record = mysql_fetch_array($res);
        $result = $record['id'];
        if ($result != '') {
            $query = mysql_query("INSERT INTO `team_list` (`id`,`user_id`, `team_id`, `join_date`, `created_by`,`player_status`) VALUES (NULL,'$result', '$teamid',now(),'$userid',0)");
            echo"<script>alert('Team Invited successfullly')</script>";
            exit();
        } else {
            echo"<script>alert('Please Invite Valid user')</script>";
            exit();
        }
    }
}
?>

<?php
include "footer.php";
?>
<!--/.fluid-container-->