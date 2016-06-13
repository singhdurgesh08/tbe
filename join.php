<?php
session_start();
 if($_SESSION['user_data']['user_name'] ==''){
header("location: login.php");
exit();
}
include "config.php";

if($_POST['submit']=='Join'){
 $teamid =  $_POST['select_team'];
 $matchid =  $_POST['matchid'];
 $amount =  $_POST['claim_title'];
 $userid = $_SESSION['user_data']['id'];
 $query = "INSERT INTO `join_match` (`match_id`, `team_id`, `Match_play_status`, `status`, `created_by`, `created_date`, `join_fee`,`opponent_id`) VALUES ('$matchid', '$teamid', '0', '1', '$userid', now(), '1','1')";

if(mysql_query($query))
{
       mysql_query("update ps4_match set match_status='2' where id = '$matchid'"); 
       header("Location: matchdetails.php?Matchid=".$matchid);exit;
}  
}


?>