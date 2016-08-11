<?php session_start();
error_reporting(0);
date_default_timezone_set('US/Eastern');
include "constant.php";
include "config.php";
include "common.php";

if ($_GET['action'] == "reportmatch") {

    $userId = $_GET['user_id'];
    $yourteam = $_POST['yourteam'];
    $opponentteam = $_POST['opponentteam'];
    $yourteamscore = $_POST['yourteamscore'];
    $opponentteamscore = $_POST['opponentteamscore'];
    $repot_match_id = $_POST['repot_match_id'];
    $res = mysql_query("Select * from ps4_match where id= $repot_match_id");
    $r = mysql_fetch_array($res);
    // Host reporting Match
    // if opponent_id equal 0 means Host and if 1 Means Opponent
     
    // Get Host id 
      $host = getHostId($repot_match_id);
      $opponent = getOpponentId($repot_match_id);
      $hostId  = $host['id'];
      $opponentId  = $opponent['id'];
    if($yourteam == $opponentteam){
       echo "<b style='background-color:red'>Sorry ! you can not report same win win OR Loss Loss</b>";Exit;
    }
    $currentdate = date("Y-m-d H:i:s");
    if ($r['created_by'] == $userId) {
        mysql_query("Update join_match set host_report_time= '$currentdate' , match_winner ='$yourteam',match_score='$yourteamscore' where id = '$hostId' ;");
        mysql_query("Update join_match set host_report_time='$currentdate' , match_winner ='$opponentteam',match_score='$opponentteamscore' where id = '$opponentId' ;");
    } else {
        // Opponent reporting Match
        mysql_query("Update join_match set opponent_report_time = '$currentdate' , opponent_report_match_winner ='$yourteam',opponent_report_match_score='$yourteamscore'  where id = '$opponentId';");
        mysql_query("Update join_match set opponent_report_time = '$currentdate' , opponent_report_match_winner ='$opponentteam',opponent_report_match_score='$opponentteamscore' where id = '$hostId' ;");
    }
    // Host Status Update
    /*if(($host['match_winner'] == $host['opponent_report_match_winner']) && $host['match_winner'] =="Win"){
         mysql_query("Update join_match set  Match_play_status ='1'  where id = '$hostId' ;");
    }elseif(($host['match_winner'] == $host['opponent_report_match_winner']) && $host['match_winner'] =="Loss"){
         mysql_query("Update join_match set  Match_play_status ='2'  where id = '$hostId' ;");
    }else {
         // Nothing Update
    }*/
  // Opponent Status Update
   /* if(($opponent['match_winner'] == $opponent['opponent_report_match_winner']) && $opponent['match_winner'] =="Win"){
        mysql_query("Update join_match set  Match_play_status ='1'  where id = '$opponentId' ;");
    }else if(($opponent['match_winner'] == $opponent['opponent_report_match_winner']) && $opponent['match_winner'] =="Loss"){
      mysql_query("Update join_match set  Match_play_status ='2'  where id = '$opponentId' ;");
    }else {
        // Nothing Update
    }*/
    $host = getHostId($repot_match_id);
    $opponent = getOpponentId($repot_match_id);
   // echo "<pre>Host"; print_r($host);
   // echo "<pre>opponent"; print_r($opponent);
    if(($host['match_winner'] == $host['opponent_report_match_winner']) && $host['match_winner'] =="Win"){ //echo "111111111";
        mysql_query("Update join_match set  Match_play_status ='1'  where id = '$hostId' ;");
        mysql_query("Update join_match set  Match_play_status ='2'  where id = '$opponentId' ;");
    }elseif(($host['match_winner'] == $host['opponent_report_match_winner']) && $host['match_winner'] =="Loss"){// echo "222222";
         mysql_query("Update join_match set  Match_play_status ='2'  where id = '$hostId' ;");
         mysql_query("Update join_match set  Match_play_status ='1'  where id = '$opponentId' ;");
    } else if (($host['match_winner'] != $host['opponent_report_match_winner']) && (trim($host['match_winner']) == "Win") && (trim($host['opponent_report_match_winner']) == "Loss")) {
       //  echo "333333";
         mysql_query("Update join_match set  Match_play_status ='3'  where id = '$hostId' ;"); 
         mysql_query("Update join_match set  Match_play_status ='3'  where id = '$opponentId' ;");
    } else if (($opponent['match_winner'] != $opponent['opponent_report_match_winner']) && (trim($opponent['match_winner']) == "Loss") && (trim($opponent['opponent_report_match_winner']) == "Win")) {
       //   echo "4444444";
         mysql_query("Update join_match set  Match_play_status ='3'  where id = '$hostId' ;");
         mysql_query("Update join_match set  Match_play_status ='3'  where id = '$opponentId' ;");
   }else {
       // echo "5555555";
         // Nothing Update
    }
    //die;
    
//    if ((($host['match_winner'] == $host['opponent_report_match_winner'])) && ($opponent['match_winner'] == $opponent['opponent_report_match_winner'])) {
//        mysql_query("Update join_match set  Match_play_status ='3'  where id = '$hostId' ;");
//        mysql_query("Update join_match set  Match_play_status ='3'  where id = '$opponentId' ;");
//    } else if (($host['match_winner'] != $opponent['match_winner']) && ($host['match_winner'] == "Win") && ($opponent['match_winner'] == "Loss")) {
//        mysql_query("Update join_match set  Match_play_status ='1'  where id = '$hostId' ;");
//        mysql_query("Update join_match set  Match_play_status ='2'  where id = '$opponentId' ;");
//    } else if (($host['match_winner'] != $opponent['match_winner']) && ($host['match_winner'] == "Loss") && ($opponent['match_winner'] == "Win")) {
//        mysql_query("Update join_match set  Match_play_status ='2'  where id = '$hostId' ;");
//        mysql_query("Update join_match set  Match_play_status ='1'  where id = '$opponentId' ;");
//    } else {
//        
//    }

//    }else if(($host['match_winner'] == $opponent['match_winner']) && ($host['match_winner'] =="Win" ||  $host['match_winner'] =="Loss")){
//        mysql_query("Update join_match set  Match_play_status ='3'  where id = '$hostId' ;");
//        mysql_query("Update join_match set  Match_play_status ='3'  where id = '$opponentId' ;");
   
    // Trasfer Money To Team
     $resquery = mysql_query("Select join_match.created_by,join_match.Match_play_status , join_match.match_id from join_match  left join users on join_match.created_by = users.id where match_id= '$repot_match_id' and Match_play_status = '1'");
     $win_result = mysql_fetch_array($resquery);
     if($win_result['Match_play_status'] =='1'){ 
        $userid = $win_result['created_by'];
       transferMoney($userid,$repot_match_id);
     }
    
    echo "success";
    die;
}
if ($_GET['action'] == "changewinner") {
   // $userId = $_GET['user_id'];
    $yourteam = $_POST['yourteam'];
    $opponentteam = $_POST['opponentteam'];
    if($yourteam == $opponentteam){
       echo "<b style='background-color:red'>Sorry ! you can not report same win win OR Loss Loss</b>";Exit;
    }
    $repot_match_id = $_POST['repot_match_id'];
    mysql_query("Update join_match set host_report_time= now() , Match_play_status ='$yourteam' , match_winner ='11' where match_id= '$repot_match_id' and opponent_id = '0'");
    mysql_query("Update join_match set host_report_time= now() , Match_play_status ='$opponentteam' ,opponent_report_match_winner ='$opponentteam' where match_id= '$repot_match_id' and opponent_id = '1'");
    $resquery1 = mysql_query("Select * from join_match  left join users on join_match.created_by = users.id where match_id= '$repot_match_id' and Match_play_status = '1'");
    $win_result = mysql_fetch_array($resquery1);
    $email = $win_result['user_email'];
    $userid = $win_result['created_by'];
   /* if($_SESSION['dimond_user'] == "dimond"){
       
       $amount = (float)$detail1['amount'] + (float)$detail1['amount'];
    }else {
        $winner = $detail1['amount'] * 80 / 100;
        $amount = $detail1['amount'] + (float)$winner;
       
    }*/
    //echo "<pre>"; print_r("Select * from join_match  left join users on join_match.created_by = users.id where match_id= '$repot_match_id' and Match_play_status = '1'"); die;
     if($win_result['Match_play_status'] =='1'){
        // echo "sss"; die;
       transferMoney($userid,$repot_match_id);
       adminReportMatch($repot_match_id,$userid);
     }
    /*$query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
            `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
            VALUES ('', 'Winner', '1', 'ADD', '$userid', '$amount', 'USD', '1', now(), '$email',now(),now())";
    mysql_query($query);*/
    echo "success";
    die;
}


if ($_GET['action'] == "postmatch") {

    //echo "<pre>"; print_r($_POST);
    if (isset($_POST['Save'])) {


        $Match_Name = $_POST['Match_Name'];

       // $Game_Mode = $_POST['Game_Mode'];
        $Amount = $_POST['Amount'];
        $userid = $_GET['user_id'];

        $match_start_date = $_POST['match_start_date'];
        $match_close_date = $_POST['match_close_date'];
        $match_start_date = date("Y-m-d H:i:s", strtotime($match_start_date));
        $match_close_date = date("Y-m-d H:i:s", strtotime($match_close_date));
        $add_itemId = $_POST['addteam_id'];

        $EST = $_POST['EST'];
        $platform = $_POST['platform'];

         $date1 = $_POST['year']."-". $_POST['month']."-".$_POST['day']; 
        $mtime = $_POST['hours'].":". $_POST['Minute']." ".$_POST['Session'];
        $match_start_date =  date("Y-m-d", strtotime($date1)); 
        $realtime =  date("H:i:s", strtotime($mtime)); 
        $opendate = $match_start_date." ".$realtime;
        
        $matchdate = strtotime($opendate);
        $currentdate =  strtotime(date("Y-m-d H:i:s")); 
        if($currentdate > $matchdate ) { echo "Sorry ! Please post match for future date time";Exit;} 
        // Game Mode find Here
      //  echo "select game_Mode from team where id ='$add_itemId'"; die;
        $teamdetail = mysql_query("select game_Mode,team_name from team where id ='$add_itemId'");
        $rowdetail = mysql_fetch_array($teamdetail);
       // echo "222222222"; die;
        $Game_Mode = $rowdetail['game_Mode'];
        $team_name = $rowdetail['team_name'];
        
        // Check Pending Match
         //validatePendingMatch($userid);
        
        // Check Team Player is Full or not 
         validateGameMode($Game_Mode,$add_itemId,$team_name,$Amount);

         
        // Gamer Tag check Will Come Here 
        $userdetail = mysql_query("select plastation,xbox from users where id ='$userid'");
        $user_detail = mysql_fetch_array($userdetail);
        if($platform =='PS4') {
             if(trim($user_detail['plastation']) =='') {
                  echo "Sorry ! Please Update ps4 gamertage  from profile";die;
                   
             }
        }
        if($platform =='XB1') {
           if(trim($user_detail['xbox']) =='') {
                  echo "Sorry ! Please Update xbox gamertage from profile";die;
                   
             }
        }
       
        $result = mysql_query("select sum(payment_gross) AS value_sum from payments where user_id ='$userid' and payment_type ='ADD' and payment_status ='1'");
        $row = mysql_fetch_array($result);
        $sum = $row['value_sum'];

        $result2 = mysql_query("select sum(payment_gross) AS value_sum_withdraw from payments where user_id ='$userid' and payment_type ='Withdrawal' and (payment_status ='1' or payment_status ='2')");
        $row2 = mysql_fetch_array($result2);
        $withdraw = $row2['value_sum_withdraw'];
        $totalcredit = number_format($sum, 2) - number_format($withdraw, 2);
        
        $totalcredit = ($totalcredit) ? $totalcredit : 0;
        
        if ($totalcredit < $Amount) {
            echo "Sorry ! You have No credit Please add credit from Wallet";
            die;
        }
        $query = "INSERT INTO `ps4_match` (`id`, `game_title`, `game_mode`, `amount`, `open_date`, `close_date`, `match_time`, `created_date`, `created_by`, "
                . "`rule`, `platform`, `est_time`, `match_status`) VALUES (NULL, '$Match_Name', '$Game_Mode', '$Amount', '$opendate', "
                . "'$match_close_date','$realtime', now(), $userid, '11', '$platform', '$EST' ,'1')";

        if (mysql_query($query)) {
            $lastisertId = mysql_insert_id();
            $query1 = "INSERT INTO `join_match` (`match_id`, `team_id`, `Match_play_status`, `status`, `created_by`, `created_date`, `join_fee`,"
                    . "`opponent_id`,`amount`,`match_score`,`match_winner`,`opponent_report_match_score`,`opponent_report_match_winner`,`host_report_time`,`opponent_report_time`)"
                    . " VALUES ('$lastisertId', '$add_itemId', '0', '1', '$userid', now(), '$Amount','0','$Amount',0,0,NULL,NULL,NULL,NULL)";
            mysql_query($query1);
            
            // Withdrawal Payment From Member Team
            $amount = $Amount;
            withdrawMoneyFromTeam($add_itemId,$amount);
            
            echo $platform;
            die;
           
        }
    } else {
        echo "";
        die;
    }
}
if ($_GET['action'] == "accept_match") {  
   // echo "<pre>"; print_r($_POST); die;
    //if ($_POST['submit'] == 'Join') {
        
        $userid = $_GET['user_id'];
        $teamid = $_POST['select_team'];
        $matchid = $_POST['matchid'];
        
        $userid = $_SESSION['user_data']['id'];

        $matchres = mysql_query("Select * from ps4_match where id ='$matchid' and match_status ='1'");
        $matchdetail = mysql_fetch_array($matchres);
        if($matchdetail['id'] ==""){
            echo "Sorry ! Match Already Accepted ."; die;
        }
       if($matchdetail['created_by'] ==$userid){
             echo "Sorry ! You can not Accept your Match ."; die;
        }
        
        $amount = $matchdetail['amount'];
        $teamdetail = mysql_query("select game_Mode,team_name from team where id ='$teamid'");
        $rowdetail = mysql_fetch_array($teamdetail);
       // echo "222222222"; die;
        $Game_Mode = $rowdetail['game_Mode'];
        $team_name = $rowdetail['team_name'];
        
        // Check Pending Match
       //  validatePendingMatch($userid);
        // Check Team Player is Full or not 
        validateGameMode($Game_Mode,$teamid,$team_name,$amount);
        $result = mysql_query("select sum(payment_gross) AS value_sum from payments where user_id ='$userid' and payment_type ='ADD' and payment_status ='1'");
        $row = mysql_fetch_array($result);
        $sum = $row['value_sum'];

        $result2 = mysql_query("select sum(payment_gross) AS value_sum_withdraw from payments where user_id ='$userid' and payment_type ='Withdrawal' and ( payment_status ='1' or payment_status ='2')");
        $row2 = mysql_fetch_array($result2);
        $withdraw = $row2['value_sum_withdraw'];
        $totalcredit = number_format($sum) - number_format($withdraw);
        $totalcredit = ($totalcredit) ? $totalcredit : 0;
        if ($totalcredit < $amount) {
            echo "Sorry ! You have No credit Please add credit from Wallet .";
            die;
        }
         
         $teamdetail = mysql_query("select platform from team where id ='$teamid'");
         $rowdetail = mysql_fetch_array($teamdetail);
         $platform = $rowdetail['platform'];
         // Gamer Tag check Will Come Here 
        $userdetail = mysql_query("select plastation,xbox from users where id ='$userid'");
        $user_detail = mysql_fetch_array($userdetail);
        if($platform =='PS4') {
             if(trim($user_detail['plastation']) =='') {
                  echo "Sorry ! Please Update ps4 gamertage  from Edit profile ";die;
                   
             }
        }
        if($platform =='XB1') {
           if(trim($user_detail['xbox']) =='') {
             echo "Sorry ! Please Update xbox gamertage  from Edit profile ";die;
           }
        }
        $query = "INSERT INTO `join_match` (`match_id`, `team_id`, `Match_play_status`, `status`, `created_by`, `created_date`, `join_fee`,`opponent_id`,"
                . "`amount`,`match_score`,`match_winner`,`opponent_report_match_score`,`opponent_report_match_winner`,`host_report_time`,`opponent_report_time`) "
                . " VALUES ('$matchid', '$teamid', '0', '1', '$userid', now(), '$amount','1','$amount',0,0,NULL,NULL,NULL,NULL)";

        if (mysql_query($query)) {
            $email = $_SESSION['user_data']['user_emil'];
            $userid = $_SESSION['user_data']['id'];
            $amount = $amount;
            // Withdraw Money 
             withdrawMoneyFromTeam($teamid,$amount);
             mysql_query("update ps4_match set match_status='2' where id = '$matchid'");
             $matchid = encryptor('encrypt',$matchid);            
             echo "success:".$matchid;exit;
        }
   // }
    //echo "<pre>"; print_r($_POST); die;
    
}
if ($_GET['action'] == "updateTeam") {   
     $userid = $_GET['user_id'];
     $gamemode = $_GET['gamemode'];
     $platform = $_GET['platform'];
     
     $query = "select id,team_name FROM team where created_by ='$userid' and game_Mode ='$gamemode' and platform ='$platform' and Status ='1'";
     $result = mysql_query($query);
    $resultArray = array();
    while ($row = mysql_fetch_assoc($result)) {
       $resultArray[] = $row;
    }

    echo json_encode($resultArray); die;
}
?>
