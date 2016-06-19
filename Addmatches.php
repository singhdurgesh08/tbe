<?php
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";
include "nav.php";
include "config.php";
?>


<!--        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>-->
        <script src="<?php echo HOSTNAME; ?>assets/js/jquery.timepicker.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo HOSTNAME; ?>assets/css/jquery.timepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo HOSTNAME; ?>assets/css/jquery.datetimepicker.css"/>
        <script src="<?php echo HOSTNAME; ?>assets/build/jquery.datetimepicker.full.js"></script>
        <script>

            $(function() {
               // $("#datepicker").datepicker();
             //   $("#datepicker1").datepicker();
                //$("#timepicker").timepicker();
                $('.some_class').datetimepicker();
            });
        </script>
    


<head>
  <script>

  $(document).ready(function(){
    $("#addmatches").validate();
  });
  </script>
</head>


<style>
.error {color:red;}
</style>

 <div class="home_tab_section">      
<div class="container">

        <div class="row">
            <div class="col-sm-12 text-center">
                <h1><br class="hidden-xs">Post a Match</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <form method='post' action="addmatches.php" id="addmatches" class="form-horizontal">
                    <fieldset>
                        &nbsp;&nbsp;

                         <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Date</label>
                            <div class="col-sm-6 input" >
                            <select name="month" id="month" required="">
                               <option value="">Month</option>
                               <option value="1">January</option>
                               <option value="2">February</option>
                               <option value="3">March</option>
                               <option value="4">April</option>
                               <option value="5">May</option>
                               <option value="6">June</option>
                               <option value="7">July</option>
                               <option value="8">August</option>
                               <option value="9">September</option>
                               <option value="10">October</option>
                               <option value="11">November</option>
                               <option value="12">December</option>

                             </select>
     
                                <select name="day" id="day" required="">
                                   <option value="">Date</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>

                                <select name="year" id="year" required="">
                                    <option value="">Year</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>

                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>


                                </select>
     
    
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Time</label>
                            <div class="col-sm-6 input" >
                            <select name="hours" id="hours" required="">
                               <option>Hr</option>
                                <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                         
                             </select>
     
                                <select name="Minute" id="Minute" required="">
                                   <option>Minutes</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>

                                   
                          
                                </select>

                                <select name="Session" id="Session" required="">
                                    
                                    <option value="2016">AM</option>
                                    <option value="2017">PM</option>
                                   

                                </select>
     
    
                            </div>
                        </div>
                    <!--
                         <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Match Time</label>
                            <div class="col-sm-6 input"><input type="text" id="timepicker" name="match_time"  class="form-control" required=""></div>
                        </div>
                  
                        <div class="form-group">
                            <label for="match_start_date" class="control-label col-sm-6">Start date & Time</label>
                            <div class="col-sm-6 input"><input type="text" id="timepicker" name="match_start_date"  class="form-control some_class" required=""></div>
                         </div>
                          <div class="form-group">
                            <label for="match_close_date" class="control-label col-sm-6">Close date & Time</label>
                            <div class="col-sm-6 input"><input type="text" id="timepicker" name="match_close_date"  class="form-control some_class" required=""></div>
                         </div>
                  -->
                          <div class="form-group">
                                <label for="platform" class="control-label col-sm-6">Platform</label>
                                <div class="col-sm-6 input"><select name="platform" id="platform" class="form-control" required="">    
                                        <option value="">Please select Platform</option>
                                        <option value="PS4">PS4</option>
                                        <option value="XB1">XB1</option>

                                    </select></div>
                            </div>

                            <div class="form-group">
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
                            </div>

                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Amount $</label>
                            <div class="col-sm-6 input"><input type="text" id="amount" name="Amount"  class="form-control" required="" placeholder="$1.00(min) - $100.00(max)per player" ></div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 input">&nbsp;</div>
                                <div class="col-sm-6 input">
                                    <div>
                                    <center><h3> Select Team</h3></center>
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $userid = $_SESSION['user_data']['id'];
                                            if ($des == "") {
                                            $res = mysql_query("Select * from team where created_by = '$userid'");
                                            } $i =1;
                                            while ($r = mysql_fetch_array($res)) { // echo "<pre>"; print_r($r);
                                            ?>
                                            <tr>
                                                <td><?php echo $r['team_name']; ?> </td>
                                                <td>
                                                    <input type="radio" name="addteam_id" id="addteam_id" value="<?php echo $r['id']; ?>" checked="checked" />
                                                </td>
                                            </tr>
                                <?php }
                                ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6 input">&nbsp;</div>
                                <div class="col-sm-6 input">
                                    <div>
                                    <center><input type= "checkbox" required name="terms" /><a href="javascript:void();" data-toggle="modal" data-target="#match-rule">&nbsp;I agree to the Match Rules</a></center>
                               <!--<center><input type="checkbox" required name="terms">&nbsp; I agree to the Match Rules</u></center>-->
                                
                                </div>
                                </div>
                                
                            </div>
                        </div>
                   </fieldset>
                   
            </div>
        </div>
              
           
            <div class="row">
                    
                             

                       
                        
                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group">
                            <label for="" class="control-label col-sm-4 back hidden-xs">&nbsp;</label>
                            <div class="col-sm-2 input text-center">

                            <button class="btn btn-lg btn-block btn-success" type="submit" name="Save" value="Save">Save<i class="glyphicon glyphicon-chevron-right"></i></button>
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
    if (isset($_POST['Save'])) { //echo "<pre>"; print_r($_POST); die;
       
        $Match_Name = $_POST['Match_Name'];
        //$Date = $_POST['Month'];
        $Game_Mode = $_POST['Game_Mode'];
        $Amount = $_POST['Amount'];
        //$match_time = $_POST['match_time'];
        //$rule = $_POST['rule'];
         $userid = $_SESSION['user_data']['id'];
         $match_start_date = $_POST['match_start_date'];
         $match_close_date = $_POST['match_close_date'];
         $match_start_date =  date("Y-m-d H:i:s", strtotime($match_start_date)); 
         $match_close_date =  date("Y-m-d H:i:s", strtotime($match_close_date));  
         $add_itemId = $_POST['addteam_id'];
         $platform = $_POST['platform'];
        
         $date1 = $_POST['year']."-". $_POST['day']."-".$_POST['month'];

        $mtime = $_POST['hours'].":". $_POST['Minute']." ".$_POST['Session'];
        $match_start_date =  date("Y-m-d", strtotime($date1)); 
         $realtime =  date("H:i:s", strtotime($mtime)); 
        $opendate = $match_start_date." ".$realtime;
        // $opendate; die;
        //$date = mysql_real_escape_string($date);
        //var_dump($date);die();
       // $query ="INSERT INTO `ps4_match` (`id`, `game_title`, `game_mode`, `amount`, `Date`, `match_time` ,`created_by`,`rule`) VALUES (NULL, '$Match_Name', '$Game_Mode', '$Amount', '$date' , '$match_time', '$userid', '$rule')";
        $query ="INSERT INTO `ps4_match` (`id`, `game_title`, `game_mode`, `amount`, `open_date`, `close_date`, `match_time`, `created_date`, `created_by`, `rule`, `platform`, `match_status`) VALUES (NULL, '$Match_Name', '$Game_Mode', '$Amount', '$opendate', '$match_close_date','$realtime', now(), $userid, '11', '$platform', '1')"; 
       
        if (mysql_query($query)) { 
            $lastisertId =  mysql_insert_id();
            $query1 = "INSERT INTO `join_match` (`match_id`, `team_id`, `Match_play_status`, `status`, `created_by`, `created_date`, `join_fee`,`opponent_id`) VALUES ('$lastisertId', '$add_itemId', '0', '1', '$userid', now(), '$Amount','0')";
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