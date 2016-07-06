<?php ob_start();
session_start();
include "login-header.php";
include "nav.php";
include "config.php";
$matid = $_GET['Matchid'];
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
//echo "<pre>"; print_r($r);
$userid = $_SESSION['user_data']['id'];


include "common.php"; 

if ((isset($_GET['Matchid']) && is_numeric($_GET['Matchid'])) && $_GET['action'] == "cancle") {
    $ids = $_GET['Matchid'];
    cancleAcceptedMatch($ids);
   
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
                           $detail  = mysql_fetch_array($resquery);
                            $teamid = $detail['team_id'];
                          
                        ?>
                        <div class="row">
                    <div class="col-sm-4 text-center">
                         <?php  
                          $finalimage1 =  getTeamImage($teamid);
                         // echo "<pre>"; print_r($finalimage1);
                          if($finalimage1['team_image']) {  ?>
                         <img src="<?php echo HOSTNAME; ?>upload/<?php echo $finalimage1['team_image'];?>" width="64" height="66" class="img-circle" alt="Cinque Terre" alt="" />
                        <?php } else { ?>
                         <img src="<?php echo HOSTNAME; ?>/assets/images/match_profile.png" class="img-circle" alt="Cinque Terre" width="64" height="66"> 
                          <?php }  ?>
                        <?php 
              
                        echo "<h2>  Team - ".ucfirst($finalimage1['team_name'])."</h2>";
                        echo $detail['user_name']."<br/>";
                        // echo $finalimage1['team_name'] . "<br/>";

              ?> </div>  
                    <div class="col-sm-4 text-center">
                       <?php 
                        echo "<br/>";
                        echo "<br/>";
                        echo "<h2>V/S.</h2>";
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
                                    <img src="<?php echo HOSTNAME; ?>/assets/images/match_profile.png" class="img-circle" alt="Cinque Terre" width="64" height="66"> 
                                <?php } ?>
                                <?php
                               echo "<h2>  Team - ".ucfirst($finalimage2['team_name'])."</h2>";
                                echo $detail1['user_name'] . "<br/>";
                                //echo $finalimage2['team_name'] . "<br/>";
                                echo "<br/>";
                                //print_r($detail);
                                ?>  
                            </div>
<div>
  <table class="table">
    <tbody>
      <tr>
        <td><b> ID  :- </b> 000000<?php echo $r[0]; ?><br> </b></td>
        <td><b> Platform :- </b><?php echo $r['platform'] ; ?><br></td> 
        <td> <b> Game Mode  :- </b> <?php echo $r[2]; ?><br></td>
        <td> <b> Start Date Time :- </b><br><?php echo date("d-M-Y h:i:s A", strtotime($r['open_date'])); ?><br></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td> </td>
      </tr>   
      <tr class="tn">
        <th class=" text-center">Team Name</th>
        <th>&nbsp;</th>
         <th>&nbsp;</th>
        <th >Result</th>
      </tr>
      <?php $resteam = mysql_query("SELECT * FROM join_match left join team on team.id = join_match.team_id where join_match.match_id = $matid");
      while ($rteam = mysql_fetch_assoc($resteam)) {   // print_r($r);
          ?> 
          <tr>
              <td><b><?php echo $rteam['team_name']; ?></b></td>
              <th></th>
              <th></th>
              <td ><?php
                      if ($rteam[Match_play_status] == 0) {
                          echo "pending";
                      } else if ($rteam[Match_play_status] == 1) {
                          echo "Win";
                      } else {
                          echo "Loss";
                      }
                      ?></td>
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
        <div class="row">
            <div class="tabset-cashier ng-isolate-scope">
                <ul class="nav nav-tabs ">
                    <li role="presentation" class="ng-isolate-scope  active">
                        <a href="#1" data-toggle="tab"><b>TBE</b></a>
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
                               $resteamtag = mysql_query("SELECT * FROM join_match left join users on users.id = join_match.created_by where join_match.match_id = $matid");
                               while ($rteamtag = mysql_fetch_assoc($resteamtag)) {   // print_r($r);
                                ?> 
                           <tr>
                            <td><b><?php echo $rteamtag['user_name']; ?></b></td>
                            <th>&nbsp;</th>
                           <th>&nbsp;</th>
                           <td><?php echo $rteamtag['gamertag']; ?></td>
                          </tr>
                      <?php }
      ?>                         
                           </tbody>
                         </table>
                     </div>
                  </div>
               </div>
            </div>
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
    <div class="row">
      <div class="col-sm-12">
         <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<!--                            <caption class="text-center"> <h3>Join Team</h3></caption>  -->
            <thead class="thead-inverse">
                                <tr>
                                   
<!--                                    <th>Team Name</th>-->
                                </tr>
                            </thead>

<!--                            <tbody>
                           <?php
                                
                                $i = 1;
                                while ($result = mysql_fetch_array($query)) { // echo "<pre>"; print_r($r);
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><a href="Teamdetails.php?teamid="<?php echo $result['id']; ?>><?php echo $result['team_name']; ?></a></td>
                                    </tr>

                                <?php } ?>
                            </tbody>-->
                        </table>
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
                        
                        <li><a  data-toggle="modal" data-target="#report_match" style="cursor: pointer;">Report Match</a></li>
                        <li><a href="createticket.php">Dispute</a></li>
                         <li><a href="matchdetails.php?action=cancle&Matchid=<?php echo $matid;?>">Cancel Match</a></li>
                         <?php $is_admin = $_SESSION['user_data']['is_admin']; 
                               if($is_admin ==1){ 
                          ?>
                        <li><a  data-toggle="modal" data-target="#claim_money" style="cursor: pointer;">Change Winner</a></li>
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
                        <b>  <?php echo  ucfirst($finalimage1['team_name'])."   VS   ". ucfirst($finalimage2['team_name']); ?> </b>
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
                            <label for="yoorteam" class="control-label col-sm-6">Your Team Game Won :</label>
                            <div class="col-sm-4 input">
                                <select name="yourteam" id="yoorteam" class="form-control" required="">   
                                    <option value="">Select Win / Loss</option>
                                    <option value="Win">Win</option>
                                    <option value="Loss">Loss</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="opponentteam" class="control-label col-sm-6">Opponent Team Game Won :</label>
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
                           <input type="text" id="yourteamscore" name="yourteamscore"  class="form-control" required="" minimum="1" maximum="3"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="opponentteamscore" class="control-label col-sm-6">Opponent Team Score :</label>
                        <div class="col-sm-4 input">
                           <input type="text" id="opponentteamscore" name="opponentteamscore"  class="form-control" required=""  minimum="1" maximum="3"/>
                        </div>
                    </div>
                     <input type="hidden" id="repot_match_id" name="repot_match_id" value="<?php echo $matid;?>"/>
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
                            <b> Thank you you have Successfully reported the Match.</b> 
                        </div>
                        <div class="col-sm-12 text-center">
                            <b> You will also wait until your opponent reports the Match before your team Stats are affected.
                                if your Opponent does not report within 3 hours ,the match will automatically be confirmed. </b> 
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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                            <label for="yoorteam" class="control-label col-sm-6">Host Game Won :</label>
                            <div class="col-sm-2 input">
                                <select name="yourteam" id="yoorteam" class="form-control" required="">    
                                    <option value="1">Win</option>
                                    <option value="2">Loss</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="opponentteam" class="control-label col-sm-6">Opponent Team Game Won :</label>
                            <div class="col-sm-2 input">
                                <select name="opponentteam" id="opponentteam" class="form-control" required="">    
                                    <option value="1">Win</option>
                                    <option value="2">Loss</option>
                                </select>
                            </div>
                        </div>
                    
                   <input type="hidden" id="repot_match_id" name="repot_match_id" value="<?php echo $matid;?>"/>
                                            
                    <div class="form-group">
                            <label for="" class="control-label col-sm-8 back hidden-xs">&nbsp;</label>
                            <div class="col-sm-4 input">

                            <button class="btn btn-lg btn-block btn-success" type="button" name="Save" value="Save" onclick="change_winner_team();">Save</button>
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
        function report_match(){
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
                      $("#match_report_div").hide();
                       $("#match_report_success").show();  
                    }
                });             
        }
        }); 

        } 
        function change_winner_team(){
         $('#change_winner').validate({
              submitHandler: function(form) {
                $.ajax({
                    url: "ajax_file.php?action=changewinner&user_id=<?php echo $userid; ?>",
                    type: "post",
                    data: $("#change_winner").serialize(),
                     beforeSend: function(d) {
                       $("#change_winner_success").hide();
                       $("#change_winner_wait").html("Please wait we are repoting .....");
                     },
                     success: function(d) {
                         $("#change_winner_wait").html("");
                         $("#change_winner_success").show();  
                    }
                });
                  }
            }); 
        } 
        function closeModal(){
          $("#report_match").modal("hide");
           window.location.href =' <?php echo HOSTNAME; ?>matchdetails.php?Matchid=<?php echo $matid; ?>';
        }
</script>