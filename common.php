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
?>
