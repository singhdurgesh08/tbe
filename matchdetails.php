<?php
ob_start();
session_start();
include "login-header.php";
include "nav.php";
include "config.php";
$matid = $_GET['Matchid'];
$matid = encryptor('decrypt',$matid);
?>
<style>
    thead th {
        background-color: #006DCC;
        color: white;
    }

    tbody td {
        background-color: #EEEEEE;
    }
    .tn {background-color: #006DCC;
         color: white;}
    .nav.nav-tabs li.active a {
        background: #006DCC;
        border-bottom: none !important;
        color: white;
    }
    .nav.nav-tabs li a {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px; 
    }
</style>
<?php
$res = mysql_query("Select * from ps4_match where id= $matid");
$r = mysql_fetch_array($res);
$platform = $r['platform'];
//echo "<pre>"; print_r($r);
$userid = $_SESSION['user_data']['id'];

include "common.php";
$getcanclematch = getcancleMatch($matid);
//echo "<pre>"; print_R($getcanclematch);
if ((isset($matid) && is_numeric($matid)) && $_GET['action'] == "cancle") {
    $ids = $matid;

    cancleAcceptedMatchRequest($ids, $userid);
}
if ((isset($matid) && is_numeric($matid)) && $_GET['action'] == "surecancle") {
    $ids = $matid;
    mysql_query("Update cancle_match set  status ='1'  where match_id = '$matid'");
    cancleAcceptedMatch($ids);
}

if ((isset($matid) && is_numeric($matid)) && $_GET['action'] == "surenotcancle") {
    $ids = $matid;
    mysql_query("delete from cancle_match where match_id = '$matid'");
    $matid = encryptor('encrypt',$matid);
    header("location:matchdetails?Matchid=$matid");
     exit();
    
}

$host = getHostId($matid);
$opponent = getOpponentId($matid);
//echo "<pre>"; print_r($opponent);
$hostId = $host['id'];
$opponentId = $opponent['id'];
//echo "<pre>"; print_R($host);
//echo "<pre>"; print_R($opponent);

$hostreporttime = $host['host_report_time'];
$opponentreporttime = $opponent['opponent_report_time'];
if ($hostreporttime) {
     $hostdate = date('Y-m-d h:i:s A', strtotime($hostreporttime . " +3 hours"));
     //$hostdate = date('Y-m-d h:i:s A', strtotime($hostreporttime . " +1 minute"));
}
if ($opponentreporttime) {
    $opponentdate = date('Y-m-d h:i:s A', strtotime($opponentreporttime . " +3 hours"));
}
$currentdate = date('Y-m-d h:i:s A');
$datetime = date("Y-m-d H:i:s");
// Update Match report in case of Host
if (($hostreporttime) && empty($opponentreporttime)) {
    if (strtotime($hostdate) < strtotime($currentdate)) {
        // Update Host As a Win
        // Opponent As Loss
        mysql_query("Update join_match set  Match_play_status ='1' , opponent_report_time = '$datetime' where id = '$hostId' ;");
        mysql_query("Update join_match set  Match_play_status ='2' , opponent_report_time = '$datetime' where id = '$opponentId' ;");
        // Trasfer Money To Team
        $resquery = mysql_query("Select join_match.Match_play_status ,join_match.match_id,join_match.created_by from join_match  left join users on join_match.created_by = users.id where match_id= '$matid' and Match_play_status = '1'");
        $win_result = mysql_fetch_array($resquery);
        if ($win_result['Match_play_status'] == '1') {
            transferMoney($win_result['created_by'], $matid);
        }
    }
}
// Update Match Report in case of opponent
if (($opponentreporttime) && empty($hostreporttime)) {
    if (strtotime($opponentdate) < strtotime($currentdate)) {
        // Update Host As a Win
        // Opponent As Loss
        mysql_query("Update join_match set  Match_play_status ='1' , host_report_time = '$datetime'  where id = '$opponentId' ;");
        mysql_query("Update join_match set  Match_play_status ='2' , host_report_time = '$datetime'  where id = '$hostId' ;");
        // Trasfer Money To Team
        $resquery = mysql_query("Select join_match.Match_play_status ,join_match.match_id,join_match.created_by from join_match  left join users on join_match.created_by = users.id where match_id= '$matid' and Match_play_status = '1'");
        $win_result = mysql_fetch_array($resquery);
        if ($win_result['Match_play_status'] == '1') {
            transferMoney($win_result['created_by'], $matid);
        }
    }
}


?>

<div class="home_tab_section">
    <div class="container">
        <div class="row">
            <!--/span-->
            <div class="col-md-9">
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <?php
                            $resquery = mysql_query("Select * from join_match  left join users on join_match.created_by = users.id where match_id= '$matid' and opponent_id = '0'");
                            $detail = mysql_fetch_array($resquery);
                            $teamid = $detail['team_id'];
                            ?>
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <?php
                                    $finalimage1 = getTeamImage($teamid);
                                    // echo "<pre>"; print_r($finalimage1);
                                    if ($finalimage1['team_image']) {
                                        ?>
                                        <img src="<?php echo HOSTNAME; ?>upload/<?php echo $finalimage1['team_image']; ?>" width="64" height="66" class="img-circle" alt="Cinque Terre" alt="" />
                                    <?php } else { ?>
                                        <img src="<?php echo HOSTNAME; ?>/assets/images/teamss.jpg" class="img-circle" alt="Cinque Terre" width="64" height="66"> 
                                    <?php } ?>
                                    <a href="teamdetails?teamid=<?php echo encryptor("encrypt",$finalimage1['id']) ; ?>">
                                        <?php echo "<h4> " . ucfirst($finalimage1['team_name']) . "</h4>"; ?>
                                    </a>
                                    <?php /* if ($platform == 'PS4') { ?>
                                        <a href="myprofile.php?usersid=<?php echo $detail['id']; ?>">
                                            <?php echo "<h4> " . ucfirst($detail['plastation']) . "</h4>"; ?>
                                        </a>
                                    <?php } if ($platform == 'XB1') { ?>
                                        <a href="myprofile.php?usersid=<?php echo $detail['id']; ?>">
                                            <?php echo "<h4> " . ucfirst($detail['xbox']) . "</h4>"; ?>
                                        </a>
                                    <?php
                                    }
                                    echo "<h4>  " . $detail['join_fee'] . " <i class='fa fa-usd' aria-hidden='true'></i></h4>"; */
                                    ?>

                                </div>  
                                <div class="col-sm-4 text-center">
                                    <?php
                                    echo "<br/>";
                                    echo "<br/>";
                                    echo "<h2>V/S</h2>";
                                    echo "<br/>";
                                    ?>  
                                </div>
                                <div class="col-sm-4 text-center">
                                    <?php
                                    $resquery1 = mysql_query("Select * from join_match  left join users on join_match.created_by = users.id where match_id= '$matid' and opponent_id = '1'");
                                    $detail1 = mysql_fetch_array($resquery1);
                                    $teamid1 = $detail1['team_id'];
                                    $finalimage2 = getTeamImage($teamid1);
                                    if ($finalimage2['team_image']) {
                                        ?>
                                        <img src="<?php echo HOSTNAME; ?>upload/<?php echo $finalimage2['team_image']; ?>" width="64" height="66" class="img-circle" alt="Cinque Terre" alt="" />
                                    <?php } else { ?>
                                        <img src="<?php echo HOSTNAME; ?>/assets/images/teamss.jpg" class="img-circle" alt="Cinque Terre" width="64" height="66"> 
                                        <?php } ?>
                                    <a href="teamdetails?teamid=<?php echo encryptor("encrypt",$finalimage2['id']) ; ?>">
                                    <?php echo "<h4> " . ucfirst($finalimage2['team_name']) . "</h4>"; ?>
                                    </a>
                                        <?php /* if ($platform == 'PS4') { ?>
                                        <a href="myprofile.php?usersid=<?php echo $detail1['id']; ?>">
                                        <?php echo "<h4> " . ucfirst($detail1['plastation']) . "</h4>"; ?>
                                        </a>
                                        <?php } if ($platform == 'XB1') { ?>
                                        <a href="myprofile.php?usersid=<?php echo $detail1['id']; ?>">
                                        <?php echo "<h4> " . ucfirst($detail1['xbox']) . "</h4>"; ?>
                                        </a>
                                    <?php
                                    }
                                    if($detail1['join_fee']) {
                                     echo "<h4>  " . $detail1['join_fee'] . " <i class='fa fa-usd' aria-hidden='true'></i></h4>";
                                    } */
                                    ?>

                                </div>
                                <div>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><b> ID  :- </b> 000000<?php echo $r[0]; ?><br> </b></td>
                                                <td><b> Platform :- </b><?php echo $r['platform']; ?><br></td> 
                                                <td><b> Game Mode  :- </b> <?php echo $r[2]; ?><br></td>
                                                <td><b> Start Date Time :- </b><br><?php echo date("Y-m-d",strtotime($r['open_date'])) . " EST ".date("h:i A",strtotime($r['open_date'])); ?><br></td>

                                            </tr>
                                            <tr>
                                                <td><b> Host :-   <a href="teamdetails?teamid=<?php echo encryptor("encrypt",$finalimage1['id']) ; ?>">
                                        <?php echo  ucfirst($finalimage1['team_name']) ; ?>
                                    </a></b></td>
                                                <td><b> Amount :- </b> <i class='fa fa-usd' aria-hidden='true'></i> <?php echo $r['amount']; ?><br></td>
                                                <td></td>
                                                <td></td>
                                            </tr>   
                                            <tr class="tn">
                                                <th class=" text-center">Team Name</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th class=" text-center">Result</th>
                                            </tr>
                                            <?php


                                               $resteam = mysql_query("SELECT * FROM join_match left join team on team.id = join_match.team_id where join_match.match_id = $matid");
                                               while ($rteam = mysql_fetch_assoc($resteam)) {   // print_r($r);
                                                ?> 
                                                <tr>
                                                    <td><b>
                                                            <a href="teamdetails?teamid=<?php echo encryptor("encrypt",$rteam['id']) ; ?>">
                                                                <?php echo $rteam['team_name']; ?>
                                                            </a>

                                                        </b></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td ><?php
                                                        if ($rteam[Match_play_status] == 0) {
                                                            echo "pending";
                                                        } else if ($rteam[Match_play_status] == 1) {
                                                            echo "Win";
                                                        } else if ($rteam[Match_play_status] == 2) {
                                                            echo "Loss";
                                                        } else {
                                                            echo "Disputed";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
<?php }
?>  
                                            </div>
                                        <table >  
                                        </table>
                                        <div>
                                            &nbsp;
                                        </div>
                                        <div>
                                            &nbsp;
                                        </div>
                                        <div class="container">
                                             <?php


                                               $resteam = mysql_query("SELECT * FROM join_match left join team on team.id = join_match.team_id where join_match.match_id = $matid");
                                               while ($rteam = mysql_fetch_assoc($resteam)) {   // print_r($r);
                                                ?> 
                                            <div class="row">
                                                <div class="tabset-cashier ng-isolate-scope">
                                                    <ul class="nav nav-tabs ">
                                                       <li role="presentation" class="ng-isolate-scope  active">
                                                            <a href="#1" data-toggle="tab"><b><?php echo $rteam['team_name']; ?></b></a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="1">
                                                            <table id="example2" class="table" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr >
                                                                        <th class=" text-center">User</th> 
                                                                        <th></th> 
                                                                        <th></th>
                                                                        <th class=" text-center">Gamertag</th>
                                                                    </tr>
                                                                </thead>
                                                                <?php
                                                               $teamId =  $rteam['team_id'];
                                                            //$resteamtag = mysql_query("SELECT users.id,users.gamertag,users.user_name,users.xbox,users.plastation FROM join_match left join users on users.id = join_match.created_by where join_match.match_id = $matid" );
                                                             $resteamtag = mysql_query("select users.id,users.user_name,users.plastation,users.xbox,team_list.created_by,team_list.user_id from users left join team_list on team_list.user_id  = users.id where team_id = '$teamId'");
                                                                while ($rteamtag = mysql_fetch_assoc($resteamtag)) { //  print_r($rteamtag);
                                                                    ?> 
                                                                    <tr>
                                                                        <td>
                                                                            <a href="myprofile?usersid=<?php $puserid = encryptor('encrypt',$rteamtag['id']); echo $puserid; ?>">
                                                                                <b>
                                                                                 <?php echo $rteamtag['user_name'];  
                                                                                    if ($rteamtag['created_by'] == $rteamtag['user_id']) {
                                                                                    echo "    (Captain)";
                                                                                    } else {
                                                                                    echo " ";
                                                                                    }
                                                                                 ?>
                                                                                </b>
                                                                            </a>
                                                                        </td>
                                                                        <th>&nbsp;</th>
                                                                        <th>&nbsp;</th>
                                                                        <td>
                                                                            <?php
                                                                            if ($r['platform'] == 'PS4') {
                                                                                echo ucfirst($rteamtag['plastation']);
                                                                            } else {
                                                                                echo ucfirst($rteamtag['xbox']);
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
<?php }                                                          ?>                         
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        <div class="row">
                                        <div class="col-sm-12">
                                        &nbsp;
                                        </div>
                                        </div>
                                         <?php } ?>
                                        </div>
                                </div><!--row end-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            &nbsp;
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        &nbsp;
                    </div>

                </div>

            </div>
          

            <div class="col-md-3">
                <div class="sidebar-nav-fixed pull-right">
                    <div class="well">
                        <ul class="nav ">
                            <li class="nav-header"></li>


                            <li>
<!--                                   <a  data-toggle="modal" data-target="#report_match" style="cursor: pointer;">Report Match</a>-->
                                <?php
                                if ($r['created_by'] == $userid) {
                                    if ($host['host_report_time']) {
                                        echo "Match Reported. "; 
                                    } else {
                                        ?>
                                        <a  data-toggle="modal" data-target="#report_match" style="cursor: pointer;">Report Match</a>
                                    <?php }
                                } ?>
                            <?php
                            if ($opponent['created_by'] == $userid) {
                                //$opponent
                                if ($opponent['opponent_report_time']) {
                                   echo "Match Reported.";
                                } else {
                                    ?>
                                <a  data-toggle="modal" data-target="#report_match" style="cursor: pointer;">Report Match</a>
                                <?php }
                            } ?>
                            </li>
                            <li><a href="createticket">Dispute</a></li>
                            <li>
                            <?php if (($getcanclematch['created_by'] == $userid) && $getcanclematch['status'] == '0') { ?>
                                    <b>Your cancel request has been sent. </b> 
                            <?php } else if (($getcanclematch['created_by'] != $userid) && $getcanclematch['status'] == '0') { ?>
                                    <b>You received cancel request from opponent, do you accept?" </b> <br/>
                                    <a href="matchdetails?action=surecancle&Matchid=<?php echo encryptor('encrypt',$matid); ?>" style="display:inline;padding:none;">Yes</a> 
                                    <br/>
                                    -----------------------------------
                                    <a href="matchdetails?action=surenotcancle&Matchid=<?php echo encryptor('encrypt',$matid); ?>" style="display:inline;padding:none;">No</a>
                            <?php } else { 
                              $winResult =  winResult($matid);
                             // echo "<pre>"; print_r($winResult);
                              if($winResult['Match_play_status'] !='1'){
                                ?>
                                    <a href="matchdetails?action=cancle&Matchid=<?php echo encryptor('encrypt',$matid); ?>">Cancel Match</a>
                              <?php }} ?>
                            </li>
                        <?php
                        $is_admin = $_SESSION['user_data']['is_admin'];
                        if ($is_admin == 1) {
                          $getChangeWinner =   getadminReportMatch($matid); //echo "<pre>"; print_r($getChangeWinner);
                          
                          if(!$getChangeWinner['match_id']) {
                          ?>
                            
                          <li><a  data-toggle="modal" data-target="#claim_money" style="cursor: pointer;">Change Winner</a></li>
                          <?php }else {  ?>
                          <li>Admin Reported Match.</li>
                          <?php }  ?>
                          <li><a href="matchdetails?action=surecancle&Matchid=<?php echo encryptor('encrypt',$matid); ?>">Delete Match</a></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <!--/.well -->
                </div>
                <!--/sidebar-nav-fixed -->
            </div>
            <!--/span-->

        </div>
    </div>
    <!--/row-->


</div>


<div id="report_match" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModal();">&times;</button>
                <h4 class="modal-title">Report Match</h4>
            </div>
            <div class="modal-body">
                <div id="match_report_div"> 
                    <form method='post'  id="match_report" name="match_report" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12 text-center" style="background-color: black;color: white;">
                                <b>  <?php echo ucfirst($finalimage1['team_name']) . "   VS   " . ucfirst($finalimage2['team_name']); ?> </b>
                            </div>
                        </div>
                        <!--                    <div class="row">
                                            <div class="col-sm-12 text-center" style="background-color: yellowgreen;color: white;">
                                                <b> Opponent Team Not replied yet. </b> 
                                            </div>
                                            </div>-->
                        <fieldset>

                            <legend>Game Information</legend>
                            <div class="form-group">
                                <label for="gamebest" class="control-label col-sm-6">Game (Best of ..)</label>
                                <div class="col-sm-4 input">1</div>
                            </div>
                           
                            <div class="form-group">
                                <?php  if ($r['created_by'] == $userid) { ?>
                                <label for="yoorteam" class="control-label col-sm-6"> <?php echo ucfirst($finalimage1['team_name']); ?> Game Won :</label>
                                <?php } else { ?>
                                 <label for="yoorteam" class="control-label col-sm-6"> <?php echo  ucfirst($finalimage2['team_name']); ?> Game Won :</label>
                                 <?php }  ?>
                                <div class="col-sm-4 input">
                                    <select name="yourteam" id="yoorteam" class="form-control" required="">   
                                        <option value="">Select Win / Loss</option>
                                        <option value="Win">Win</option>
                                        <option value="Loss">Loss</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php  if ($opponent['created_by'] == $userid) { ?>
                                <label for="opponentteam" class="control-label col-sm-6"><?php echo ucfirst($finalimage1['team_name']); ?> Game Won :</label>
                                <?php } else { ?>
                                 <label for="opponentteam" class="control-label col-sm-6"><?php echo  ucfirst($finalimage2['team_name']); ?> Game Won :</label>
                                 <?php }  ?>
                                <div class="col-sm-4 input">
                                    <select name="opponentteam" id="opponentteam" class="form-control" required="">   
                                        <option value="">Select Win / Loss</option>
                                        <option value="Win">Win</option>
                                        <option value="Loss">Loss</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Match Final Score</legend>
                            <div class="form-group">
                                <label for="yourteamscore" class="control-label col-sm-6">Your Team Score :</label>
                                <div class="col-sm-4 input">
                                    <input type="text" id="yourteamscore" name="yourteamscore"  class="form-control" minimum="1" maximum="3" maxlength="3"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="opponentteamscore" class="control-label col-sm-6">Opponent Team Score :</label>
                                <div class="col-sm-4 input">
                                    <input type="text" id="opponentteamscore" name="opponentteamscore"  class="form-control"   minimum="1" maximum="3" maxlength="3"/>
                                </div>
                            </div>
                            <input type="hidden" id="repot_match_id" name="repot_match_id" value="<?php echo $matid; ?>"/>
                        </fieldset>
                        <div class="form-group">
                            <label for="" class="control-label col-sm-8 back hidden-xs">&nbsp;</label>
                            <div class="col-sm-4 input">

                                <button class="btn btn-lg btn-block btn-success" type="submit" name="add_report" id="add_report" value="Save"  onclick="report_match();">Report Score</button>
                            </div>

                        </div>
                    </form>  
                </div>
                <div class="row" id="match_report_success" style="display:none;">
                    <div class="col-sm-12 text-center">
                        <b> Thank you for successfully reporting your match.</b> 
                    </div>
                    <div class="col-sm-12 text-center">
                        <b> 
                            Wait for your opponent to report before your team stats will be effected. 
                            If your opponent doesn't report within 3 hours they will forfeit automatically. 
                        </b> 
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>

<div id="claim_money" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModal2();">&times;</button>
                <h4 class="modal-title">Change Winner</h4>
            </div>
            <form  name="change_winner" id="change_winner" method='post'  class="form-horizontal">
                <div class="modal-body">

                    <div class="row" id="change_winner_wait"></div>
                    <div class="row" id="change_winner_success" style="display:none;">
                        <div class="col-sm-12 text-center">
                            <b  style="background-color:green;color:white;"> Thank you you have Successfully change winner.</b> 
                        </div>

                    </div>          
                    <div class="form-group">
                        <label for="gamebest" class="control-label col-sm-6">Game (Best of ..)</label>
                        <div class="col-sm-2 input">1</div>
                    </div>
                    <div class="form-group">
                        <label for="yoorteam" class="control-label col-sm-6"><?php echo ucfirst($finalimage1['team_name']); ?> Game Won :</label>
                        <div class="col-sm-3 input">
                            <select name="yourteam" id="yoorteam" class="form-control" required="">    
                                <option value="1">Win</option>
                                <option value="2">Loss</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="opponentteam" class="control-label col-sm-6"><?php echo ucfirst($finalimage2['team_name']); ?> Game Won :</label>
                        <div class="col-sm-3 input">
                            <select name="opponentteam" id="opponentteam" class="form-control" required="">    
                                <option value="1">Win</option>
                                <option value="2">Loss</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" id="repot_match_id" name="repot_match_id" value="<?php echo $matid; ?>"/>

                    <div class="form-group">
                        <label for="" class="control-label col-sm-8 back hidden-xs">&nbsp;</label>
                        <div class="col-sm-4 input">

                            <button class="btn btn-lg btn-block btn-success" type="submit" name="Save" value="Save" onclick="change_winner_team();">Save</button>
                        </div>

                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>
<script>
    function report_match() {
        $('#match_report').validate({
            submitHandler: function(form) {
                $.ajax({
                    url: "ajax_file.php?action=reportmatch&user_id=<?php echo $userid; ?>",
                    type: "post",
                    data: $("#match_report").serialize(),
                    beforeSend: function(d) {
                        $("#match_report_div").html("Please wait we are repoting .....");
                    },
                    success: function(d) {
                        if(d =='success'){
                         $("#match_report_div").hide();
                        $("#match_report_success").show();
                        }else  {
                           $("#match_report_div").html(d);
                        }
                    }
                });
            }
        });

    }
    function change_winner_team() {
        $('#change_winner').validate({
            submitHandler: function(form) {
                $.ajax({
                    url: "ajax_file.php?action=changewinner&user_id=<?php echo $userid; ?>",
                    type: "post",
                    data: $("#change_winner").serialize(),
                    beforeSend: function() {
                        $("#change_winner_success").hide();
                        $("#change_winner_wait").html("Please wait we are repoting .....");
                    },
                    success: function(d) {
                        if(d =='success'){
                        $("#change_winner_wait").html("");
                        $("#change_winner_success").show();
                       }else  {
                            $("#change_winner_wait").html(d);
                    }
                  }
                });
            }
        });
    }
    function closeModal() {
        $("#report_match").modal("hide");
        window.location.href = ' <?php echo HOSTNAME; ?>matchdetails?Matchid=<?php echo encryptor('encrypt',$matid); ?>';
    }
    function closeModal2() {
        $("#claim_money").modal("hide");
        window.location.href = ' <?php echo HOSTNAME; ?>matchdetails?Matchid=<?php echo encryptor('encrypt',$matid); ?>';
    }
</script>