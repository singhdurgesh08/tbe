<?php
session_start();
 if($_SESSION['user_data']['user_name'] ==''){
header("location: login.php");
exit();
}
include "login-header.php";
include "nav.php";
include "config.php";

if($_POST['submit']=='Join'){
 $teamid =  $_POST['select_team'];
 $matchid =  $_POST['matchid'];
 $amount =  $_POST['claim_title'];
$query = "INSERT INTO `join_match` (`match_id`, `team_id`, `Match_play_status`, `status`, `created_by`, `created_date`, `join_fee`) VALUES ('$matchid', '$teamid', '1', '0', '1', now(), '1')";

if(mysql_query($query))
{
       header("Location: matchdetails.php?Matchid=".$matchid);exit;
}  
}


?>