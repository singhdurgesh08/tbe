<?php 
function cancleMatch($ids){
        $matchres = mysql_query("Select * from ps4_match where id ='$ids'");
        $matchdetail = mysql_fetch_array($matchres);
        if ($matchdetail['id']) {
            $result = mysql_query("DELETE FROM ps4_match WHERE id = '$ids'");
            $email = $_SESSION['user_data']['user_emil'];
            $userid = $_SESSION['user_data']['id'];
            $amount = $matchdetail['amount'];
            $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
                                                                `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
                                                                VALUES ('', 'Revert Match fees', '1', 'ADD', '$userid', '$amount', 'USD', '1', now(), '$email',now(),now())";
            mysql_query($query);
        }
}
//Accepted Match cancle
function cancleAcceptedMatch($ids){
        $matchres = mysql_query("Select * from ps4_match where id ='$ids'");
        $matchdetail = mysql_fetch_array($matchres);
        if ($matchdetail['id']) {
          $jointeamdetail = mysql_query("select users.id,users.user_email,users.paypal_email,join_match.join_fee from join_match inner join users on join_match.created_by = users.id where join_match.match_id ='$ids'");
          //$jointeam = mysql_fetch_array($jointeamdetail);  
            
              while ($rows = mysql_fetch_array($jointeamdetail)) { 
                 
                $email = $rows['user_email'];
                $userid = $rows['id'];
                $amount = $rows['join_fee'];
                $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
                      `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
                     VALUES ('', 'Revert Match fees', '1', 'ADD', '$userid', '$amount', 'USD', '1', now(), '$email',now(),now())";
                mysql_query($query);
              }
              // Delete Match
              mysql_query("DELETE FROM ps4_match WHERE id = '$ids'");
              mysql_query("DELETE FROM join_match WHERE match_id = '$ids'");
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

    $email = $detail1['user_email'];
    $userid = $detail1['created_by'];
    if($userType == "dimond"){
       $amount = (float)$detail1['amount'] + (float)$detail1['amount'];
    }else {
        $winner = $detail1['amount'] * 80 / 100;
        $amount = $detail1['amount'] + (float)$winner;
        
    }
    $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
            `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
            VALUES ('', 'Winner', '1', 'ADD', '$userid', '$amount', 'USD', '1', now(), '$email',now(),now())";
     mysql_query($query);
}
?>
