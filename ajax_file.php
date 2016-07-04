<?php

session_start();
error_reporting(0);
include "config.php";
if ($_GET['action'] == "reportmatch") {

    $userId = $_GET['user_id'];
    $yourteam = $_POST['yourteam'];
    $opponentteam = $_POST['opponentteam'];
    $yourteamscore = $_POST['yourteamscore'];
    $opponentteamscore = $_POST['opponentteamscore'];
    $repot_match_id = $_POST['repot_match_id'];
    $res = mysql_query("Select * from ps4_match where id= $repot_match_id");
    $r = mysql_fetch_array($res);
    // Self team 
    if ($r['created_by'] == $userId) {
        mysql_query("Update join_match set host_report_time= now() , match_winner ='$yourteam',match_score='$yourteamscore' where match_id= '$repot_match_id' and opponent_id = '0'");
        mysql_query("Update join_match set host_report_time= now() , match_winner ='$opponentteam',match_score='$opponentteamscore' where match_id= '$repot_match_id' and opponent_id = '1'");
    } else {

        mysql_query("Update join_match set opponent_report_time = now() , opponent_report_match_winner ='$yourteam',opponent_report_match_score='$yourteamscore' where match_id= '$repot_match_id' and opponent_id = '1'");

        mysql_query("Update join_match set set opponent_report_time = now() , opponent_report_match_winner ='$opponentteam',opponent_report_match_score='$opponentteamscore' where match_id= '$repot_match_id' and opponent_id = '0'");
    }

    echo "success";
    die;
}
if ($_GET['action'] == "changewinner") {
    $userId = $_GET['user_id'];
    $yourteam = $_POST['yourteam'];
    $opponentteam = $_POST['opponentteam'];
    $repot_match_id = $_POST['repot_match_id'];
    mysql_query("Update join_match set host_report_time= now() , Match_play_status ='$yourteam' , match_winner ='$yourteam' where match_id= '$repot_match_id' and opponent_id = '0'");
    mysql_query("Update join_match set host_report_time= now() , Match_play_status ='$opponentteam' ,opponent_report_match_winner ='$opponentteam' where match_id= '$repot_match_id' and opponent_id = '1'");
    $resquery1 = mysql_query("Select * from join_match  left join users on join_match.created_by = users.id where match_id= '$repot_match_id' and Match_play_status = '1'");
    $detail1 = mysql_fetch_array($resquery1);

    $email = $detail1['user_email'];
    $userid = $detail1['created_by'];
    if($_SESSION['dimond_user'] == "dimond"){
       //$amount = $detail1['amount'] * 2;
       $amount = (float)$detail1['amount'] + (float)$detail1['amount'];
    }else {
        $winner = $detail1['amount'] * 80 / 100;
        $amount = $detail1['amount'] + (float)$winner;
        //$amount = $detail1['amount'] * 2;
    }
    $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
            `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
            VALUES ('', 'Winner', '1', 'ADD', '$userid', '$amount', 'USD', '1', now(), '$email',now(),now())";
    mysql_query($query);
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
        $teamdetail = mysql_query("select game_Mode from team where id ='$add_itemId'");
        $rowdetail = mysql_fetch_array($teamdetail);
       // echo "222222222"; die;
        $Game_Mode = $rowdetail['game_Mode'];
        
        // Gamer Tag check Will Come Here 
        $userdetail = mysql_query("select gamertag from users where id ='$userid'");
        $user_detail = mysql_fetch_array($userdetail);
        if($platform =='PS4') {
             if(trim($user_detail['gamertag']) =='') {
                  echo "Sorry ! Please Update GamerTag from profile";die;
                   
             }
        }
        if($platform =='XB1') {
           if(trim($user_detail['gamertag']) =='') {
                  echo "Sorry ! Please Update GamerTag from profile";die;
                   
             }
        }
       


        $result = mysql_query("select sum(payment_gross) AS value_sum from payments where user_id ='$userid' and payment_type ='ADD' and payment_status ='1'");
        $row = mysql_fetch_array($result);
        $sum = $row['value_sum'];

        $result2 = mysql_query("select sum(payment_gross) AS value_sum_withdraw from payments where user_id ='$userid' and payment_type ='Withdrawal' and payment_status ='1'");
        $row2 = mysql_fetch_array($result2);
        $withdraw = $row2['value_sum_withdraw'];
        $totalcredit = number_format($sum) - number_format($withdraw);
        
        $totalcredit = ($totalcredit) ? $totalcredit : 0;
        //echo $totalcredit ."Total Credit"; 
     //  echo $Amount ."Amount"; die;
       
        
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
            
        $email = $_SESSION['user_data']['user_emil'];
        $userid = $_SESSION['user_data']['id'];
        $amount = $Amount;
        $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
        `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`) 
        VALUES ('', 'post Match', '1', 'Withdrawal', '$userid', '$amount', 'USD', '1', now(), '$email')";
        mysql_query($query); 
            
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
        $result = mysql_query("select sum(payment_gross) AS value_sum from payments where user_id ='$userid' and payment_type ='ADD' and payment_status ='1'");
        $row = mysql_fetch_array($result);
        $sum = $row['value_sum'];

        $result2 = mysql_query("select sum(payment_gross) AS value_sum_withdraw from payments where user_id ='$userid' and payment_type ='Withdrawal' and payment_status ='1'");
        $row2 = mysql_fetch_array($result2);
        $withdraw = $row2['value_sum_withdraw'];
        $totalcredit = number_format($sum) - number_format($withdraw);
        $totalcredit = ($totalcredit) ? $totalcredit : 0;
        if ($totalcredit < $Amount) {
            echo "error";
            die;
        }
         
        $teamid = $_POST['select_team'];
        $matchid = $_POST['matchid'];
        $amount = $_POST['claim_title'];
        $userid = $_SESSION['user_data']['id'];
        
         $teamdetail = mysql_query("select platform from team where id ='$teamid'");
         $rowdetail = mysql_fetch_array($teamdetail);
         $platform = $teamdetail['platform'];
         // Gamer Tag check Will Come Here 
        $userdetail = mysql_query("select gamertag from users where id ='$userid'");
        $user_detail = mysql_fetch_array($userdetail);
        if($platform =='PS4') {
             if(trim($user_detail['gamertag']) =='') {
                  echo "error1";die;
                   
             }
        }
        if($platform =='XB1') {
           if(trim($user_detail['gamertag']) =='') {
             echo "error1";die;
           }
        }
        $query = "INSERT INTO `join_match` (`match_id`, `team_id`, `Match_play_status`, `status`, `created_by`, `created_date`, `join_fee`,`opponent_id`,"
                . "`amount`,`match_score`,`match_winner`,`opponent_report_match_score`,`opponent_report_match_winner`,`host_report_time`,`opponent_report_time`) "
                . " VALUES ('$matchid', '$teamid', '0', '1', '$userid', now(), '$amount','1','$amount',0,0,NULL,NULL,NULL,NULL)";

        if (mysql_query($query)) {
            $email = $_SESSION['user_data']['user_emil'];
            $userid = $_SESSION['user_data']['id'];
            $amount = $Amount;
            $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
        `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`) 
        VALUES ('', 'Accept Match', '1', 'Withdrawal', '$userid', '$amount', 'USD', '1', now(), '$email')";
            mysql_query($query);
            mysql_query("update ps4_match set match_status='2' where id = '$matchid'");
            //header("Location: matchdetails.php?Matchid=" . $matchid);
            echo $matchid;  exit;
        }
   // }
    //echo "<pre>"; print_r($_POST); die;
    
}
?>
