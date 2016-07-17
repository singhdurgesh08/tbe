<?php 
function cancleMatch($ids){
       // $matchres = mysql_query("Select * from ps4_match where id ='$ids'");
        //$matchdetail = mysql_fetch_array($matchres);
        $matchres = mysql_query("Select * from join_match where match_id ='$ids'");
        
        $matchdetail = mysql_fetch_array($matchres);
       // echo "<pre>"; print_r($matchdetail);
        $teamId = $matchdetail['team_id'];
        $amount = $matchdetail['join_fee'];
        if ($matchdetail['team_id']) {
           depositMoneyToTeam($teamId,$amount);
            
//            $email = $_SESSION['user_data']['user_emil'];
//            $userid = $_SESSION['user_data']['id'];
//            $amount = $matchdetail['amount'];
//            $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
//                                                                `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
//                                                                VALUES ('', 'Revert Match fees', '1', 'ADD', '$userid', '$amount', 'USD', '1', now(), '$email',now(),now())";
//            mysql_query($query);
            $result = mysql_query("DELETE FROM ps4_match WHERE id = '$ids'");
            mysql_query("DELETE FROM join_match WHERE match_id = '$ids'");
        }
}
function cancleAcceptedMatchRequest($ids,$userId){ 
    
     $result = mysql_query("INSERT INTO `cancle_match` (`match_id`, `created_by`, `status`, `created_date`) VALUES ('$ids', '$userId', '0', now())");
     header("location:matchdetails.php?Matchid=" . $ids);
     exit();
}
function getcancleMatch($ids){
    $resteam1 = mysql_query("Select * from cancle_match where match_id = $ids");
    return $rteam1 = mysql_fetch_array($resteam1);
    //return $rteam1['team_image'];
}
//Accepted Match cancle
function cancleAcceptedMatch($ids){
        $matchres = mysql_query("Select * from ps4_match where id ='$ids'");
        $matchdetail = mysql_fetch_array($matchres);
        if ($matchdetail['id']) {
          $jointeamdetail = mysql_query("select users.id,users.user_email,users.paypal_email,join_match.join_fee,join_match.team_id from join_match inner join users on join_match.created_by = users.id where join_match.match_id ='$ids'");
          //$jointeam = mysql_fetch_array($jointeamdetail);  
            
              while ($rows = mysql_fetch_array($jointeamdetail)) { 
                 
                $teamId = $rows['team_id'];
                $amount = $rows['join_fee'];
                if ($rows['team_id']) {
                  depositMoneyToTeam($teamId,$amount);
                }
//                $email = $rows['user_email'];
//                $userid = $rows['id'];
//                $amount = $rows['join_fee'];
//                $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
//                      `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
//                     VALUES ('', 'Revert Match fees', '1', 'ADD', '$userid', '$amount', 'USD', '1', now(), '$email',now(),now())";
//                mysql_query($query);
              }
              // Delete Match
              mysql_query("DELETE FROM ps4_match WHERE id = '$ids'");
              mysql_query("DELETE FROM join_match WHERE match_id = '$ids'");
               echo"<script>alert('Match has been canceled');</script>";
               header("location:home.php"); 
                  exit();
             if($matchdetail['platform'] =='PS4'){
               header("location:Matchlist.php"); 
             }else{
               header("location:xb1matchlist.php");
            }
            exit();

        }
}

function getTeamImage($teamid){
    $resteam1 = mysql_query("Select * from team where id= $teamid");
    return $rteam1 = mysql_fetch_array($resteam1);
    //return $rteam1['team_image'];
}
// get Host id
function getHostId($matchId){
    $hostid = mysql_query("Select * from join_match where match_id= '$matchId' and opponent_id = '0'");
    return $hostrow = mysql_fetch_array($hostid);
   
}
// get Opponent  id
function getOpponentId($matchId){
     $opponentid = mysql_query("Select * from join_match where match_id= '$matchId' and opponent_id = '1'");
      return  $opponentrow = mysql_fetch_array($opponentid);
     
}

// Verify Dimond Users
function verifyDimondusers($userid){
    $result3 = mysql_query("select *  from payments where user_id ='$userid' and payment_type ='Subscribe' and payment_status ='1' order By payment_id desc limit 1"); 
    $row3 = mysql_fetch_array($result3);
    if (strtotime($row3['end_date'])) {
        $enddate = strtotime($row3['end_date']);
    } else {
        $enddate = "";
    }
    $currentdate = strtotime(date("Y-m-d H:i:s"));
    if ($currentdate < $enddate && $enddate != '') {
        $userType = "dimond";
    }else {
        $userType = "normal";
    }
    return $userType;
}
function transferMoney($userid,$matchId){ 
     $userType = verifyDimondusers($userid);
     $resquery = mysql_query("Select * from join_match  left join users on join_match.created_by = users.id where match_id= '$matchId' and Match_play_status = '1'");
     $detail1 = mysql_fetch_array($resquery);

//    $email = $detail1['user_email'];
//    $userid = $detail1['created_by'];
    $teamId = $detail1['team_id'];
    if($userType == "dimond"){
       $amount = (float)$detail1['amount'] + (float)$detail1['amount'];
    }else {
        $winner = $detail1['amount'] * 80 / 100;
        $amount = $detail1['amount'] + (float)$winner;
        
    }
    depositMoneyToTeam($teamId,$amount);
//    $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
//            `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
//            VALUES ('', 'Winner', '1', 'ADD', '$userid', '$amount', 'USD', '1', now(), '$email',now(),now())";
//     mysql_query($query);
}
// Validate Game Mode
function validateGameMode($mode,$teamId,$team_name,$amount){
      $gmamode = array("1v1 Mycourt"=>"1","2v2 Mycourt"=>"2","3v3 Mycourt"=>"3","Quick Match"=>"1","Myteam"=>"1");
       if($mode){
         $result = ($gmamode[$mode]) ? $gmamode[$mode] : null;
         $playercount = mysql_query("select count(id) as playercount from team_list where team_id ='$teamId' and player_status ='1'");
         $rowdetail = mysql_fetch_array($playercount);
         if($rowdetail['playercount'] != $result){
           echo "Sorry ! Please Add Member in selected Team ".$team_name;
           Exit;  
         }
         //echo "Sorry !".$result;
         // Validate Team credit
         if($result ==="2" || $result ==="3") {
            validateTeamCredit($teamId,$team_name,$amount);
         }
       }

}
// Validate Team Credit
function validateTeamCredit($teamId,$team_name,$amount){
      
         $teamuserid = mysql_query("select user_id from team_list where team_id ='$teamId' and player_status ='1'");
            while($row = mysql_fetch_array($teamuserid)) {
                $userid = $row['user_id'];
                $credit = getCredit($userid);
                if($credit < $amount){
                    $memberName = getUserName($userid);
                    echo "Sorry ! Your team Memeber <b> $memberName </b>Not have enough Credit . Please confirm from memebr or Add Zero $ Amount for Match with".$team_name;
                    Exit;  
                }
                    
            }   
  
}
// Get Team Credit
function getCredit($userid){
    $result = mysql_query("select sum(payment_gross) AS value_sum from payments where user_id ='$userid' and payment_type ='ADD' and payment_status ='1'");
    $row = mysql_fetch_array($result);
    $sum = $row['value_sum'];

    $result2 = mysql_query("select sum(payment_gross) AS value_sum_withdraw from payments where user_id ='$userid' and payment_type ='Withdrawal' and payment_status ='1'");
    $row2 = mysql_fetch_array($result2);
    $withdraw = $row2['value_sum_withdraw'];
    $totalcredit = number_format($sum, 2) - number_format($withdraw, 2);
   return  $totalcredit = ($totalcredit) ? $totalcredit : 0;
}
function getUserName($userid){
    $hostid = mysql_query("Select user_name from users where id = '$userid'");
    $hostrow = mysql_fetch_array($hostid);
    return $hostrow['user_name'];
   
}

// Validate Team Credit
function withdrawMoneyFromTeam($teamId,$amount){
      
         $teamuserid = mysql_query("select users.id,users.user_email,users.user_name from team_list inner join users on team_list.user_id = users.id
                                   where team_id ='$teamId' and player_status ='1'");
            while($row = mysql_fetch_array($teamuserid)) {
                $userid =  $row['id'];
                $email =  $row['user_email'];
                $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
                `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`) 
                VALUES ('', 'post Match', '1', 'Withdrawal', '$userid', '$amount', 'USD', '1', now(), '$email')";
                mysql_query($query);
}   
  
}
function depositMoneyToTeam($teamId,$amount){
      
         $teamuserid = mysql_query("select users.id,users.user_email,users.user_name from team_list inner join users on team_list.user_id = users.id
                                   where team_id ='$teamId' and player_status ='1'");
            while($row = mysql_fetch_array($teamuserid)) {
                $userid =  $row['id'];
                $email =  $row['user_email'];
                $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
                         `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
                          VALUES ('', 'Revert Match fees', '1', 'ADD', '$userid', '$amount', 'USD', '1', now(), '$email',now(),now())";
                mysql_query($query); 
               
          }   
  
}

function calWin($teamId){
    $hostid = mysql_query("Select count(id) as win from join_match where team_id= '$teamId' and Match_play_status = '1'");
    return $hostrow = mysql_fetch_array($hostid);
   
}
function calLoss($teamId){
    $hostid = mysql_query("Select count(id) as loss from join_match where team_id= '$teamId' and Match_play_status = '2'");
    return $hostrow = mysql_fetch_array($hostid);
   
}

function calUserWin($userId){
    $hostid = mysql_query("Select count(id) as win from join_match where created_by= '$userId' and Match_play_status = '1'");
    return $hostrow = mysql_fetch_array($hostid);
   
}
function calUserLoss($userId){
    $hostid = mysql_query("Select count(id) as loss from join_match where created_by= '$userId' and Match_play_status = '2'");
    return $hostrow = mysql_fetch_array($hostid);
   
}

function totalEarnPoint($userId){
    $hostid = mysql_query("Select sum(match_score) as earnpoint from join_match where created_by= '$userId' ");
    return $hostrow = mysql_fetch_array($hostid);
   
}

 // Check Team Player is Full or not 
    function  validatePendingMatch($userId){
           $teamuserid = mysql_query("Select match_winner,opponent_report_match_winner,match_id,created_by from join_match where created_by = '$userId' and Match_play_status ='0'");
                 $row = mysql_fetch_array($teamuserid);
                // echo "<pre>"; print_r($row); die;
                $match_winner = $row['match_winner'];
                $repot_match_id = $row['match_id'];
                $userId = $row['created_by'];
                $opponent_report_match_winner = $row['opponent_report_match_winner'];
               // echo "$match_winner";
                if($match_winner){
                    echo "Sorry ! Please complete your pending Match first.";
                    Exit;  
                }
                $repot_match_id = $_POST['repot_match_id'];
                $res = mysql_query("Select * from ps4_match where id= $repot_match_id");
                $r = mysql_fetch_array($res);
                 if ($r['created_by'] == $userId) {
                    if($match_winner =='0'){
                       echo "Sorry ! Please complete your pending Match first.";
                       Exit;  
                   }
                 }
                 if ($r['created_by'] != $userId) {
                    if($opponent_report_match_winner =='0'){
                       echo "Sorry ! Please complete your pending Match first.";
                       Exit;  
                   }
                 }
                    
             
      }
    function getUser($userid){
        $hostid = mysql_query("Select * from users where id = '$userid'");
        $hostrow = mysql_fetch_array($hostid);
        return $hostrow;

}

 function getTeamVs($matchId , $teamId){
        $hostid = mysql_query("SELECT team.id,team.team_name,team.platform FROM join_match left join team on team.id = join_match.team_id where match_id = $matchId and team_id !=$teamId");
        $hostrow = mysql_fetch_array($hostid);
        return $hostrow;

}

?>
