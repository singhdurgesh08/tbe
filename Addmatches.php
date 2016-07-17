<?php
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";
include "nav.php";
include "config.php";
$userid = $_SESSION['user_data']['id'];
$matchtype = $_GET['matchtype'];
?>


       
    
<script>

  $(document).ready(function(){
   
    $('#addmatches').validate({
        rules: {
        Amount: {
        required: true,
        range: [0, 100]
        }
        },
        messages: {
        Amount: {
        required: "Amount is required",
        range: "Please Enter Amount Between 0 - 100"
        }
        },
  
      submitHandler: function(form) {
          clickAndDisable(form);
               $.ajax({
                    url: "ajax_file.php?action=postmatch&user_id=<?php echo $userid; ?>",
                    type: "post",
                    data: $("#addmatches").serialize(),
                     beforeSend: function(d) {
                      $("#div_wait").html("Please wait we posting match .....");
                     },
                     success: function(d) {
                         if(d ==='PS4'){
                              window.location.href = 'Matchlist.php';
                         }else if(d ==='XB1'){
                              window.location.href = 'xb1matchlist.php';
                        }else{
                             $("#div_wait").html('<b  style="background-color:red;color:white;"> '+d+'</b> ');
                        }
//                      if(d ==='success'){
//                         $("#div_wait").html('<b  style="background-color:green;color:white;"> Thank you ! Your Match has been Posted Successfully.</b> ');
//                     }else  if(d ==='error'){
//                         $("#div_wait").html('<b  style="background-color:red;color:white;"> Sorry ! You have No credit Please add credit from Wallet .</b> ');
//                     }else {   $("#div_wait").html('<b  style="background-color:red;color:white;"> Error in post match.</b> ');}
                    }
                });              
        }
    });
  });
  function clickAndDisable(obj) { 
    obj.onclick = function(event) {
      event.preventDefault();
    };
  }
  function showhide(id){
   $("#player_list_"+id).toggle();
  }
  </script>
 <style>
    #accordion-1{font-size: 14px;}
    fieldset { border: 1px solid #ddd; margin: 0; padding: 10px;}
    legend{width: auto; border: none; margin: 0;}
  </style>
  <link rel="stylesheet" href="<?php echo HOSTNAME; ?>assets/css/jquery-ui.css">
  <script src="<?php echo HOSTNAME; ?>assets/js/jquery-ui.js"></script>
  <script>
     $(function() {
        //$( "#accordion-1" ).accordion();
         $( "#accordion-1" ).accordion({
           active: -1,  
           heightStyle: "content",
           collapsible: true
           
        });
     });
  </script>
 <div class="home_tab_section">      
<div class="container">
       <div class="row">
            <div class="col-sm-12 text-center">
                <div id="div_wait"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1><br class="hidden-xs">Post a Match - <?php echo $matchtype;?></h1>
            </div>
        </div>
 <form method='post' action="addmatches.php" id="addmatches" name="addmatches" class="form-horizontal">
        <div class="row">
            <div class="col-sm-8">
                
                   
                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Date</label>
                            <div class="col-sm-2 input">
                                <select name="month" id="month" class="form-control" required="">   
                                        <option value="">Month </option>
                                        <?php
                                         
                                        $month = array('01'=>"january",'02'=>"february",'03'=>"march", '04'=>"April", '05'=>"May", '06'=>"June", '07'=>"July", '08'=>"August", '09'=>"September", '10'=>"October", '11'=>"November", '12'=>"December");
                                        foreach ($month as $key => $value)
                                        { 
                                           if($key == date("m")) { $selected = 'selected = "selected"'; }
                                          echo '<option  value="'.$key.'"  '. $selected.'>'.$value.'</option>';
                                         $selected = "";
                                        }
                                        ?>

                                </select>
                            </div>
                            <div class="col-sm-2 input"><select name="day" id="day" class="form-control" required="">
                                    <option value="">Date</option>
                                    <?php
                                           $month = array('01'=>"01",'02'=>"02",'03'=>"03", '04'=>"04", '05'=>"05", '06'=>"06", '07'=>"07", '08'=>"08", '09'=>"09", '10'=>"10", '11'=>"11", '12'=>"12",'13'=>"13",'14'=>"14", '15'=>"15", '16'=>"16", '17'=>"17", '18'=>"18", '19'=>"19", '20'=>"20", '21'=>"21", '22'=>"22", '23'=>"23",'24'=>"24", '25'=>"25", '26'=>"26",'27'=>"27", '28'=>"28", '29'=>"29", '30'=>"30", '31'=>"31");
                                           foreach ($month as $key => $value)
                                           {  if($key == date("d")) { $selected = 'selected = "selected"'; }
                                             echo '<option value="'.$key.'" '. $selected.'>'.$value.'</option>';
                                              $selected = "";
                                           }
                                    ?>
                                </select>  
                            </div>
                            <div class="col-sm-2 input"><select name="year" id="year" class="form-control" required="">
                                    <option value="">Year</option>
                                    <?php
                                       $month = array('01'=>"2016",'02'=>"2017",'03'=>"2018", '04'=>"2019", '05'=>"2020", '06'=>"2021", '07'=>"2022", '08'=>"2023", '09'=>"2024", '10'=>"2025", '11'=>"2026", '12'=>"2027");
                                       foreach ($month as $key => $value)
                                       { if($value == date("Y")) { $selected = 'selected = "selected"'; }
                                         echo '<option value="'.$value.'" '. $selected.'>'.$value.'</option>';
                                          $selected = "";
                                       }
                                    ?>
                               </select>

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Time</label>
                            <div class="col-sm-2 input">
                                <select name="hours" id="hours" class="form-control" required="">   

                                    <option value="">Hour</option>
                                   <?php
                                           $month = array('01'=>"01",'02'=>"02",'03'=>"03", '04'=>"04", '05'=>"05", '06'=>"06", '07'=>"07", '08'=>"08", '09'=>"09", '10'=>"10", '11'=>"11", '12'=>"12");
                                           foreach ($month as $key => $value)
                                           {
                                           // if($value == date("h")) { $selected = 'selected = "selected"'; }
                                             echo '<option value="'.$key.'" '. $selected.'>'.$value.'</option>';
                                             // $selected = "";
                                           }
                                    ?>

                                </select>
                            </div>
                            <div class="col-sm-2 input">
                              <select name="Minute" id="Minute" class="form-control" required="">
                                    <option value="">Minutes</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                             </select>
                            </div>  

                             <div class="col-sm-2 input">
                                   <select name="Session" id="session" class="form-control" required="">
                                   <option value="AM">AM</option>
                                    <option value="PM">PM</option>

                                </select>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6"> Time Zone</label>
                            <div class="col-sm-6 input" >
                            <select name="EST" id="EST" class="form-control" required="">
                            <option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                            </select>
    
                            </div>
                        </div>
                        <input type="hidden" name="platform" id="platform" value="<?php echo $matchtype;?>" />
<!--                          <div class="form-group">
                                <label for="platform" class="control-label col-sm-6">Platform</label>
                                
                                <div class="col-sm-6 input">
                                    <select name="platform" id="platform" class="form-control" required="">    
                                        <option value="">Please select Platform</option>
                                         <?php
//                                           $plat = array('PS4'=>"PS4",'XB1'=>"XB1");
//                                           
//                                           foreach ($plat as $key => $value)
//                                           {
//                                             if($value == $matchtype) { $selected = 'selected = "selected"'; }
//                                             echo '<option value="'.$key.'" '. $selected.'>'.$value.'</option>';
//                                             $selected = "";
//                                           }
                                    ?>
                                        
                                    </select>
                                </div>
                            </div>-->

<!--                            <div class="form-group">
                                <label for="login_password" class="control-label col-sm-6">Game Mode</label>
                                <div class="col-sm-6 input">
                                    <select name="Game_Mode" id="Game_mode" class="form-control" required="">
                                        <option value=""> Please select game mode</option>
                                        <option value="1v1 Mycourt">1v1 Mycourt</option>
                                        <option value="2v2 Mycourt">2v2 Mycourt</option>
                                        <option value="3v3 Mycourt">3v3 Mycourt</option>
                                        <option value="Quick Match">Quick Match</option>
                                        <option value="Myteam">Myteam</option>
                                    </select>
                                   
                                </div>
                            </div>-->

                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Amount $</label>
                            <div class="col-sm-6 input"><input type="text" id="amount" name="Amount"  class="form-control" required="" placeholder="$0(min) - $100.00(max)per player" ></div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 input">&nbsp;</div>
                                <div class="col-sm-6 input">
                                    <div>
                                    <center><h3> Select <?php echo $matchtype; ?> Team</h3></center>
                                </div>
                                </div>
                                
                            </div>
           
                            <div class="row">
                                <div class="col-sm-6 input">&nbsp;</div>
                                <div class="col-sm-6 input">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                               
                                                <th>Team Name</th>
                                                <th>Platform</th>
                                                <th>Game Mode </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $userid = $_SESSION['user_data']['id'];
                                            if ($des == "") {
                                            $res = mysql_query("Select * from team where created_by = '$userid' and platform ='$matchtype'");
                                            } $i =1;
                                            $count = mysql_num_rows($res);
                                            if($count > 0 ){
                                            while ($r = mysql_fetch_array($res)) { // echo "<pre>"; print_r($r);
                                            ?>
                                            <tr>
                                                <td>
                                                <a href="teamdetails.php?teamid=<?php echo $r['id']; ?>">
                                                <?php echo $r['team_name']; ?>
                                               </a>    
                                                </td>
                                                <td><?php echo $r['platform']; ?></td>
                                                <td><?php echo $r['game_Mode']; ?></td>
                                                <td>
                                                    <input type="radio" name="addteam_id" id="addteam_id" value="<?php echo $r['id']; ?>" checked="checked" />
                                                    
                                                    &nbsp; 
                                                    <a href="javascript:void();" onclick="showhide('<?php echo $r['id']; ?>');"> Member's</a>
                                                </td>
                                            </tr>
                                     <tr id="player_list_<?php echo $r['id']; ?>" style="display:none;">
                                         <TD colspan="4">
                                      <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                   <h4 class="text-center"><strong>Team Member's</strong></h4> 

                                   <thead class="thead-inverse">
                                       <tr>
                                           <th>Roster</th>
                                           <th>Role</th>
                                           <th>Date Joined</th>
                                           
                                       </tr>
                                   </thead>
                                         <tbody>
                             <?php
                                $i = 1;
                                $teamid = $r['id'];
                                $res1 = mysql_query("SELECT * FROM team_list LEFT JOIN team ON team_list.team_id = team.id LEFT JOIN users ON users.id = team_list.user_id WHERE team_list.player_status ='1' and team_list.team_id= $teamid");
                                while ($teamplayer = mysql_fetch_assoc($res1)) {
                                    ?>
                                    <tr>
                                        <td><a href="myprofile.php?usersid=<?php echo $teamplayer['id']; ?>"><?php echo $teamplayer['user_name']; ?>
                                            </a></td>
                                        <td>
                                            <?php
                                            
                                            if ($teamplayer['team_id'] == $teamid && $teamplayer['created_by'] == $teamplayer['user_id']) {
                                                echo "Captain";
                                            } else {
                                                echo "Player";
                                            }
                                            ?>
                                       </td>
                                        <td><?php echo date("d-M-Y", strtotime($teamplayer['join_date'])); ?></td>
                                        
                                    </tr>
                                    <?php }
                                    ?>
                                                </tbody>
                                               </table>
                                        </TD>
                                     </tr>
                                           
                                            <?php }}else {  ?>
                                            <tr>
                                                <td colspan="3">No team found Please <a href="AddTeam.php?platform=<?php echo $matchtype;?>">Add Team </a> </td>
                                                
                                                <td>
                                                    <input type="text" name="addteam_id" id="addteam_id" required=""  readonly="readonly"/>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                                
                            
                        </div>
                  
                   
            </div>
        </div>

<div class="row">
  <fieldset>
    <legend> Match Rules</legend>
    <h5> <b>*</b> You must read and accept the match rules before posting a match on the match finder.</h5>
    <div class="col-sm-12 input " style="height:250px;overflow: auto;">
      <div id="accordion-1">
        <h3>General Rules</h3>
        <div>
          <p>
            1. The default settings specified in these rules can be changed, but only if an option is available in the challenge. These rules will be followed unless specified otherwise in the match details. No other agreements are allowed (I.e. verbal, message, email).
            <br>
            2.If any of the below settings are incorrect, the hosting team will forfeit that game. The team hosting is responsible for choosing the right settings previous of the game starting. If the host starts the game with the wrong settings, the game needs to be ended & restarted with proper settings. If the host does not end the game, your team should leave the game and acquire proof of everything. The non-hosting team is responsible for obtaining valid proof to show that the hosting team did not have the settings correct. Valid proof must be submitted immediately after the match has been completed. If you do not leave the game before half way, you are agreeing to play with those incorrect settings, and the map scores will be considered final.
            <br>
            Game Mode:  VS Quick Match, My Court 1v1, My Court 2v2, My Court 3v3, MyTeam
            <br>
            · Difficulty: Superstar
            <br>
            · Game Style: Default
            <br>
            · Quarter Length: 5 Minutes
          </p>
        </div>
    <h3>Disconnection rules</h3>
        <div>
          <p>
            ·If a member of either team disconnects before the first point is scored, the match will be restarted.
             <br> 
             · If a member disconnects a my court match make sure you have proof, join back within 10 minutes and whoever had ball before the disconnection goes on team 1
              make sure you finish your score its first to 21 points
             <br>
             for example, your score is 11-0, you disconnect from the game from server issues. You would need proof, restart the match and score the remaining 10 points and get proof of that as well.
             <br> 
             ·If a member disconnects, in a quick match or my team game and its past the first 10 points that team automatically forfeits the match
              <br>
              ·If a team's pause timer runs out, that team will forfeit the game.
            </p>
          </div>
      <h3>Hosting</h3>
          <div>
            <p>
              ·         If you posted a match in the match finder and someone accepted it, you will host the match and invite the opponent.
             <br>
              ·         If a team has any player(s) that has their place of residency in Puerto Rico, then they are allowed to play in any North American ladder, but they are not allowed to host any map in that series. 
              <br>
              ·         If a team has any player(s) that has their place of residency in Australia, then they are allowed to play in any European ladder, but they are not allowed to host any map in that series.
              <br>
              .       Rules are subject to change at any time. It is the responsibility of all the users participating on this ladder to know and understand the rules before scheduling any matches.

            </p>
          </div>
      <h3>TBESportsGaming General Rules</h3>
          <div>
            <p>
              1.       Rules are subject to change at any time. It is the responsibility of all the users to know and understand the rules before scheduling any matches.
               <br>
              2.       All TBE accounts, teams and roster spots are property of TBESportsGaming. Any advertising of, or attempts to buy, sell, trade, or exchange any aforementioned item is strictly prohibited. Violators will be removed from all TBESportsGaming online properties and all accounts terminated. Furthermore, TBESportsGaming reserves the right to deactivate, reset or temporarily suspend any account or team, without notice, that violates our Terms of Use.
               <br>
               3.       Users must create their own username when competing on TBESportsGaming. This username must have been registered on TBESportsGaming personally by the owner of the account. The registered username must contain the correct and complete personal information of the user. If a false Name, Address, or Email was entered, the user voids the privilege to participate in any matches and receive prizes. 
               <br>
               4.       Users are prohibited from sharing TBESportsGaming account information. This includes, but is not limited to, the following: usernames, passwords, gamertags, email accounts, etc. If another person accesses your account, you may be disqualified from your team that you are participating in as well as be removed from TBESportsGaming. As such, you are personally responsible for accepting an invitation to a team. Someone else cannot accept a team invitation for you. If you do not personally accept a team invitation, you may be disqualified from competing. You will also forfeit the ability to receive prizes.
                <br>
              5.       If a user is found to be evading an active penalty, the original account that was banned will be disabled, regardless of the original offense. In addition, users found to be participating on a team with a user that is evading a ban will be subject to penalties including removal from the site. We advise you to report the evading user immediately by utilizing our Ticket system.
               <br>
              6.       TBESportsGaming prohibits users from creating or managing more than one team on a ladder from the same household as well as competing against each other. Multiple people from the same household may compete on TBESportsGaming; however, only one username can be in a management position on a team. All other usernames from the same household cannot be anything higher than member on any team on the same ladder.
               <br>
              7.       The Leader of a team can change the team name. The images/information submitted must be appropriate. Attempting to bypass the automatic censor by misspelling, inserting spaces or symbols, transposing letters, using look-alike symbols, or any other method is not allowed. Teams that attempt to bypass the censor will be subject to penalties.
               <br>
              8.       Teams must contain the minimum number of eligible players to remain active. Teams without the minimum number of eligible players - especially teams that are "abandoned" - are subject to removal at the Staff's discretion.
               <br>
              9.       As to ensure fair competition, TBESportsGaming reserves the right to amend all match-related rules listed herein on a case by case basis. Teams who manipulate these rules maliciously and/or at the expense of other members will be penalized for Unsportsmanlike Conduct.
           </p>
          </div>
     <h3>Rosters</h3>
        <div>
          <p>
            1.       It is the responsibility of both teams to verify the eligibility of all players playing in the match prior to starting or continuing any match play. A team playing with an ineligible player will forfeit the match.
              <br>
            2.       All gamertags on a team’s roster must be valid. The gamertag must be legitimately owned by the user on the roster.
              <br>
            3.       Users are permitted to be listed on only one team on each ladder at any given time. Users are only permitted one gamertag per ladder.
              <br>
            4.       Roster spots must be of only one valid gamertag per user on team. Spelling and spaces must be exact, but does not need to be case sensitive.
              <br>
            5.       Gamertags may not contain foul language, disparaging remarks, hateful or racist names.
              <br>
            6.If the opponent team has an ineligible player present, ask the team to replace that player. You must have given the team the required 15 minutes from match start time to substitute their ineligible players. If the ineligible player shows up between games, you must give the team the required 5 minutes to replace their ineligible player. If the team does not substitute their ineligible player and allows that player to compete in the match, follow these steps:
              <br>
            7.       Immediately submit a ticket stating an ineligible player was present. This ticket must be submitted before starting or continuing to play the match.
              <br>
            8.   Provide proof of the ineligible player actively playing in the match. Then, upload the proof to our website. 
              <br>
            9.   When the match is completed, you must go back to your ticket and submit the URL link containing valid proof showing the ineligible player playing in the match. Without valid proof, no win can be awarded.
          </p>
        </div>
    <h3>No Show</h3>
      <div>
        <p>
          1. A team has 15 minutes to show for the match with the correct number of eligible players in the match, Failure to do so will result in a forfeit of the match.
          <br>
          2.Contact us via twitter @TBESportsGaming for more information regarding problems on the website. Please be patient for our response and submit a ticket for no show providing proof of what happened. 
        </p>
      </div>
    <h3>Reporting Matches</h3>
    <div>
      <p>
        1.       Teams must report the match within 3 hours of completion if not the match will be canceled. If a team reports within 3 hours and the other doesn't the outcome will be determined by the reporting team.
        <br>
        2.       If a dispute occurs teams must submit a ticket with valid proof of their claims. For proof to be considered valid it must be clear, show the other teams gamertags along with the scoreboard, and must have proof of the accusation. (Cheating/Glitching, etc…)
        <br>
        3.       Teams with 3 or more disputes will be locked until they have the disputes resolved to where they have 2 or less disputes.
      </p>
    </div>
    <h3>Tickets </h3>
    <div>
      <p>
          1.       When submitting a ticket, fill out the whole ticket with the correct information.
       <br>2.       All TBESportsGaming staff member’s decisions are final. If a decision is made from a ticket, additional tickets are allowed if they have new information that would potentially change the outcome of a specific match.
       <br>3.      We should not be contacted regarding any tickets. We handle them in order that they are received. 

      </p>
    </div>
    <h3>Cheating/Scamming</h3>
    <div>
      <p>1.       The use of any communications other than what is provided within the game is strictly prohibited. There are exceptions to this rule in which outside communication can be utilized. These exceptions include:
        <br>Games that give you no advantage by using outside communication.
        <br>Games that do not have an in-game voice option.
        <br>2.Any User uses who uses our services in an un-ethical manner to scam another individual will have his account terminated.  
        <br>3.       TBESportsGaming has a zero tolerance policy for cheating. Teams caught cheating, “glitching”, or abusing in-game mechanics in any way will be terminated indefinitely.
      </p>
    </div>
  <h3>Proof</h3>
  <div>
    <p>1.       When submitting proof, you must post the url in the ticket, Youtube videos cannot be set too private as we cannot view private videos.
      <br>
      2.       For proof to be considered valid it must have the full scoreboard with gamertags. It must be large enough for staff to read it.
      <br>
      3.       Submitting fake proof or old proof may result in a removal from TBESportsGaming.
      <br>
      4.       Any conversation is not considered valid proof. For example: Twitter, PMs, AIMs, and Skype chats are NOT valid.
    </p>
  </div>
  <h3>Cash Matches</h3>
    <div>
      <p>1. Players from Arizona, Connecticut, Maryland, Quebec are not eligible to receive any Prizes from TBESportsGaming.
      </p>
    </div>

  </div>
</div>
</fieldset>
</div>

<div class="row">
         <div class="col-sm-6 input">&nbsp;</div>
         <div class="col-sm-6 input">
             <div>
                 <center><input type= "checkbox" required name="terms" /><a href="javascript:void();">&nbsp;* I agree to the above rules as posted</a></center>
            <!--<center><input type="checkbox" required name="terms">&nbsp; I agree to the Match Rules</u></center>-->

             </div>
         </div>

     </div>
         <div class="row">
                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group">
                            <label for="" class="control-label col-sm-4 back hidden-xs">&nbsp;</label>
                            <div class="col-sm-4 input text-center">

                            <button class="btn btn-lg btn-block btn-success" type="submit" name="Save" value="Save">Post match on Match Finder<i class="glyphicon glyphicon-chevron-right"></i></button>
                            </div>
                            <div class="col-sm-2 input text-center">
                            <a href="ps4.php" class="btn btn-lg btn-danger">Cancel<i class="glyphicon glyphicon-chevron-right"></i></a>
                                            
                        </div>
                    </div>
            </div>
        </form>
        </div>
</div>
     
<div id="match-rule" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Rules</h4>
            </div>
             <div class="modal-body">
                <h6>General Rules<br>
1.       The default settings specified in these rules can be changed, but only if an option is available in the challenge. These rules will be followed unless specified otherwise in the match details. No other agreements are allowed (I.e. verbal, message, email).<br>

2.       If any of the below settings are incorrect, the hosting team will forfeit that game. The team hosting is responsible for choosing the right settings previous of the game starting. If the host starts the game with the wrong settings, the game needs to be ended & restarted with proper settings. If the host does not end the game, your team should leave the game and acquire proof of everything. The non-hosting team is responsible for obtaining valid proof to show that the hosting team did not have the settings correct. Valid proof must be submitted immediately after the match has been completed. If you do not leave the game before half way, you are agreeing to play with those incorrect settings, and the map scores will be considered final.<br>

<br> Game Mode:  VS Quick Match, My Court 1v1, My Court 2v2, My Court 3v3, MyTeam

•         Difficulty: Superstar<br>

•         Game Style: Default <br>

•         Quarter Length: 5 Minutes<br>

•         If a member of either team disconnects before the first point is scored, the match will be restarted.<br>

•          If a member disconnects at any point during first quarter, and that team is winning, the match will be restarted.<br>

•         If a member disconnects, and it is past the first quarter, that team automatically loses.<br>

•         If a team's pause timer runs out, that team will forfeit the game.<br>








Hosting<br>
•         The higher ranked team at the time of the match will create the match and invite the opponent.<br>

•         The higher-ranked team at match time chooses Home or Away and hosts the match. If both teams are unranked, the team ID number will be used with the lower numbered team ID being considered higher ranked.<br>

•         If a team has any player(s) that has their place of residency in Puerto Rico, then they are allowed to play in any North American ladder, but they are not allowed to host any map in that series. <br>

•         If a team has any player(s) that has their place of residency in Australia, then they are allowed to play in any European ladder, but they are not allowed to host any map in that series.<br>

.       Rules are subject to change at any time. It is the responsibility of all the users participating on this ladder to know and understand the rules before scheduling any matches.<br>

TBESportsGaming General Rules<br>
1.       Rules are subject to change at any time. It is the responsibility of all the users to know and understand the rules before scheduling any matches.<br>
2.       All TBE accounts, teams and roster spots are property of TBESportsGaming. Any advertising of, or attempts to buy, sell, trade, or exchange any aforementioned item is strictly prohibited. Violators will be removed from all TBESportsGaming online properties and all accounts terminated. Furthermore, TBESportsGamingreserves the right to deactivate, reset or temporarily suspend any account or team, without notice, that violates our Terms of Use.<br>
3.       Users must create their own username when competing on TBESportsGaming. This username must have been registered on TBESportsGaming personally by the owner of the account. The registered username must contain the correct and complete personal information of the user. If a false Name, Address, or Email was entered, the user voids the privilege to participate in any matches and receive prizes. <br>
4.       Users are prohibited from sharing TBESportsGaming account information. This includes, but is not limited to, the following: usernames, passwords, gamertags, email accounts, etc. If another person accesses your account, you may be disqualified from your team that you are participating in as well as be removed from TBESportsGaming. As such, you are personally responsible for accepting an invitation to a team. Someone else cannot accept a team invitation for you. If you do not personally accept a team invitation, you may be disqualified from competing. You will also forfeit the ability to receive prizes.<br>

5.       If a user is found to be evading an active penalty, the original account that was banned will be disabled, regardless of the original offense. In addition, users found to be participating on a team with a user that is evading a ban will be subject to penalties including removal from the site. We advise you to report the evading user immediately by utilizing our Ticket system.<br>

6.       TBESportsGaming prohibits users from creating or managing more than one team on a ladder from the same household as well as competing against each other. Multiple people from the same household may compete on TBESportsGaming; however, only one username can be in a management position on a team. All other usernames from the same household cannot be anything higher than member on any team on the same ladder.<br>

7.       The Leader of a team can change the team name. The images/information submitted must be appropriate. Attempting to bypass the automatic censor by misspelling, inserting spaces or symbols, transposing letters, using look-alike symbols, or any other method is not allowed. Teams that attempt to bypass the censor will be subject to penalties.<br>

8.       Teams must contain the minimum number of eligible players to remain active. Teams without the minimum number of eligible players - especially teams that are "abandoned" - are subject to removal at the Staff's discretion.<br>

9.       As to ensure fair competition, TBESportsGaming reserves the right to amend all match-related rules listed herein on a case by case basis. Teams who manipulate these rules maliciously and/or at the expense of other members will be penalized for Unsportsmanlike Conduct.<br>










Rosters<br>
1.       It is the responsibility of both teams to verify the eligibility of all players playing in the match prior to starting or continuing any match play. A team playing with an ineligible player will forfeit the match.<br>

2.       All gamertags on a team’s roster must be valid. The gamertag must be legitimately owned by the user on the roster.<br>

3.       Users are permitted to be listed on only one team on each ladder at any given time. Users are only permitted one gamertag per ladder.<br>

4.       Roster spots must be of only one valid gamertag per user on team. Spelling and spaces must be exact, but does not need to be case sensitive.<br>

5.       Gamertags may not contain foul language, disparaging remarks, hateful or racist names.<br>

6.       If the opponent team has an ineligible player present, ask the team to replace that player. You must have given the team the required 15 minutes from match start time to substitute their ineligible players. If the ineligible player shows up between games, you must give the team the required 5 minutes to replace their ineligible player. If the team does not substitute their ineligible player and allows that player to compete in the match, follow these steps:<br>
7.       Immediately submit a ticket stating an ineligible player was present. This ticket must be submitted before starting or continuing to play the match.<br>
8.   Provide proof of the ineligible player actively playing in the match. Then, upload the proof to our website. 
9.   When the match is completed, you must go back to your ticket and submit the URL link containing valid proof showing the ineligible player playing in the match. Without valid proof, no win can be awarded.<br>

No Show<br>
1.       A team has 15 minutes to show for the match with the correct amount of eligible players in the match, Failure to do so will result in a forfeit of the match.<br>
2.       Contact us via twitter @TBESportsGamingfor more information regarding problems on the website. Please be patient for our response and submit a ticket for no show providing proof of what happened. <br>
Reporting Matches
1.       Teams must report the match within 3 hours of completion if not the match will be canceled. If a team reports within 3 hours and the other doesn't the outcome will be determined by the reporting team.<br>

2.       If a dispute occurs teams must submit a ticket with valid proof of their claims. For proof to be considered valid it must be clear, show the other teamsgamertags along with the scoreboard, and must have proof of the accusation. (Cheating/Glitching, etc…)<br>

3.       Teams with 3 or more disputes will be locked until they have the disputes resolved to where they have 2 or less disputes.<br>

Tickets <br>
1.       When submitting a ticket, fill out the whole ticket with the correct information.<br>
2.       All TBESportsGaming staff membersdecisions are final. If a decision is made from a ticket, additional tickets are allowed if they have new information that would potentially change the outcome of a specific match.<br>
3.      We should not be contacted regarding any tickets. We handle them in order that they are received.<br>

Cheating/Scamming<br>
1.       The use of any communications other than what is provided within the game is strictly prohibited. There are exceptions to this rule in which outside communication can be utilized. These exceptions include:
Games that give you no advantage by using outside communication.<br>
Games that do not have an in-game voice option.<br>
Games in which the rules specifically state that outside communication is allowed.<br>
2.        Any User uses who uses our services in an un-ethical manner to scam another individual will have his account terminated.  <br>
3.       TBESportsGaming has a zero tolerance policy for cheating. Teams caught cheating, “glitching”, or abusing in-game mechanics in any way will be terminated indefinitely.<br>




Proof<br>
1.       When submitting proof you must post the url in the ticket, Youtube videos cannot be set to private as we cannot view private videos.<br>

2.       For proof to be considered valid it must have the full scoreboard with gamertags. It must be large enough for staff to read it.<br>

3.       Submitting fake proof or old proof may result in a removal from TBESportsGaming.<br>

4.       Any conversation is not considered valid proof. For example: Twitter, PMs, AIMs, and Skype chats are NOT valid.<br>

Cash Matches<br>
1. Players from Arizona, Connecticut, Maryland, Quebec are not eligible to receive any Prizes from TBESportsGaming.<br>

</h6>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
    <?php
    if (isset($_POST['Save'])) { 
       
        $Match_Name = $_POST['Match_Name'];
        
        $Game_Mode = $_POST['Game_Mode'];
        $Amount = $_POST['Amount'];
        
        $userid = $_SESSION['user_data']['id'];
        $match_start_date = $_POST['match_start_date'];
        $match_close_date = $_POST['match_close_date'];
        $match_start_date =  date("Y-m-d H:i:s", strtotime($match_start_date)); 
        $match_close_date =  date("Y-m-d H:i:s", strtotime($match_close_date));  
        $add_itemId = $_POST['addteam_id'];

         $EST = $_POST['EST'];
         $platform = $_POST['platform'];
        
        $date1 = $_POST['year']."-". $_POST['month']."-".$_POST['day'];
        $mtime = $_POST['hours'].":". $_POST['Minute']." ".$_POST['Session'];
        $match_start_date =  date("Y-m-d", strtotime($date1));  
        $realtime =  date("H:i:s", strtotime($mtime));  
        $opendate = $match_start_date." ".$realtime;
       
        $query ="INSERT INTO `ps4_match` (`id`, `game_title`, `game_mode`, `amount`, `open_date`, `close_date`, `match_time`, `created_date`, `created_by`, `rule`, `platform`, `est_time`, `match_status`) VALUES (NULL, '$Match_Name', '$Game_Mode', '$Amount', '$opendate', '$match_close_date','$realtime', now(), $userid, '11', '$platform', '$EST' ,'1')"; 
       
        if (mysql_query($query)) { 
            $lastisertId =  mysql_insert_id();
            $query1 = "INSERT INTO `join_match` (`match_id`, `team_id`, `Match_play_status`, `status`, `created_by`, `created_date`, `join_fee`,`opponent_id`,`time`,) VALUES ('$lastisertId', '$add_itemId', '0', '1', '$userid', now(), '$Amount','0')";
            mysql_query($query1);
            echo"<script>alert('Match Added successfullly')</script>";
        }
    }
   ?>


    <script>
        function goback(){
            window.location.href = 'ps4.php'
        }
    </script>
  &nbsp;&nbsp;&nbsp;

    <?php
    include "footer.php";
    ?>