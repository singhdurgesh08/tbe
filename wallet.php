<?php 
 session_start();
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>
<style>

.nav.nav-tabs li:first-child a {
    margin-left: 0;
}
.nav.nav-tabs li.active a {
    background: #fff;
    border-bottom: 0 !important;
    border-color: #d9d9d9;
    border-top: 0;
    color: #DF0A0A;
    position: relative;
    top: 1px;
    z-index: 1;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    color: #555;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
    cursor: default;
}
.nav.nav-tabs li a {
    -webkit-border-top-left-radius: 4px;
    -webkit-border-top-right-radius: 4px;
    -moz-border-radius-top-left: 4px;
    -moz-border-radius-top-right: 4px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background: #f0f0f0;
    border: 1px solid transparent;
    border-bottom: 0;
    color: inherit;
    cursor: pointer;
    font-weight: bold;
    margin-left: 10px;
    padding: 10px 25px;
    position: relative;
    text-align: center;
    top: -1px;
}
.nav>li>a:hover, .nav>li>a:focus {
    text-decoration: none;
    background-color: #eee;
}
.nav-tabs>li>a {
    margin-right: 2px;
    line-height: 1.428571429;
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
}

a:active, a:hover {
    outline: 0;
}
.tab-content>.tab-pane {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #fff;
    border: 1px solid #d9d9d9;
    border-top-left-radius: 0 !important;
    margin-bottom: 10px;
    padding: 10px;
    padding-bottom: 0;
}
.nav.nav-tabs li.active a::after {
    content: '';
    position: absolute;
    right: 0;
    top: 0;
    -webkit-border-top-left-radius: 4px;
    -webkit-border-top-right-radius: 4px;
    -moz-border-radius-top-left: 4px;
    -moz-border-radius-top-right: 4px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background: #5bc0de;
    height: 5px;
    width: 100%;
}

</style>
<?php 
include "config.php";
include "common.php";
if ($_POST['transfer_btn']=="Transfer") {
    $msg = "";
    $user_name = trim($_POST['username']);
    $transfer_amount = trim($_POST['transfer_amount']);
    
    $Membership = "1";

    if ($user_name == $_SESSION['user_data']['user_name']) {
       $msg = "<div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong>  You can not transfer your self
                </div>";
    }
    $totalcredit = getCredit($_SESSION['user_data']['id']);
    if($totalcredit > $transfer_amount )
    {
        $msg = "<div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong>  you have no more Credit for transfer
                </div>";
    }
    if($msg ==""){
        $check_name = "select * from users where user_name ='$user_name'";
        $result = mysql_query($check_name);
        if (mysql_num_rows($result) >= 1) { 
          $row = mysql_fetch_array($result); 
               $userid =  $row['id'];
                $email =  $row['user_email'];
                 $query = "INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_type`, 
                         `user_id`, `payment_gross`, `currency_code`, `payment_status`, `payment_date`, `payment_email`, `start_date`, `end_date`) 
                          VALUES ('', 'Transfer Money to friend', '1', 'ADD', '$userid', '$transfer_amount', 'USD', '1', now(), '$email',now(),now())";
                mysql_query($query); 
                 $msg = "
            <div class='alert alert-success'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>Success!</strong>  Trnasfer $transfer_amount $ TO $user_name. 
            </div>
            ";
       
        }else {
            $msg = "<div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong> User  $user_name is not exits
                </div>";
        }
        
    }
    
}
?>
<div class="home_tab_section">
    <div class="container">
         <?php if(isset($msg)) echo $msg;  ?>
        <div class="row">
            <div class="tabset-cashier col-md-12 ng-isolate-scope">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="ng-isolate-scope active">
                        <a href="#1" data-toggle="tab">Deposit</a>
                    </li>
                    <li role="presentation" class="ng-isolate-scope">
                        <a href="#2" data-toggle="tab">Withdrawal your credits</a>
                    </li>
                    <li role="presentation" class="ng-isolate-scope">
                        <a href="#3" data-toggle="tab">Transfer</a>
                    </li>
                  
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="1">
              
                        <form id="add_wallet" name="add_wallet" action="add_wallet.php" method="post"  class="form-horizontal">

                            <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="add_amount" name="add_amount" class="form-control" placeholder="Enter Amount ($5 minimum)" required=""/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input name="agree" type="checkbox" required="" class="required">
                                   I accept the <a href="term-service.php" target="_blank">terms of condition</a>&nbsp;&&nbsp;<a href="privacy.php" target="_blank">privacy policy</a>

                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-2 text-center">
                                    <button type="submit" name="add" value="Add" class="btn btn-info"><span class="ng-scope">Pay With PayPal</span></button>
                                </div>

                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="2">
                        <form id="withdrawal" name="withdrawal" action="withdrawal_wallet.php" method="post"  class="form-horizontal">

                            <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="email" name="email" class="form-control email" placeholder="Enter your paypal email" required=""/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="add_amount" name="add_amount"   class="form-control" placeholder="Enter Amount ($5 minimum)" required="" />
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input name="agree" type="checkbox" required="" class="required">
                                     I accept the <a href="term-service.php" target="_blank">terms of condition</a>&nbsp;&&nbsp;<a href="privacy.php" target="_blank">privacy policy</a>

                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-2 text-center">
                                    <button type="submit" name="withdrawal" value="withdrawal" class="btn btn-info"><span class="ng-scope">Pay With PayPal</span></button>
                                </div>

                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="tab-pane" id="3">
                        <form id="transfer" name="transfer" action="wallet.php" method="post"  class="form-horizontal">

                            <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter Friend Username" required=""/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="transfer_amount" name="transfer_amount"   class="form-control" placeholder="Enter Amount ($5 minimum)" required=""/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input name="agree" type="checkbox" required="" class="required">
                                   I accept the <a href="term-service.php" target="_blank">terms of condition</a>&nbsp;&&nbsp;<a href="privacy.php" target="_blank">privacy policy</a>

                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-2 text-center">
                                    <button   type="submit" name="transfer_btn" value="Transfer" class="btn btn-info"><span class="ng-scope">Transfer</span></button>
                                </div>

                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                        </form>
                         
                    </div>
                </div>
                
            </div>
        </div><!--row end-->
    </div>
    <script>
        $(document).ready(function(){
            
       $('#transfer').validate({
        rules: {
        transfer_amount: {
        required: true,
        range: [5, 100]
        }
        },
        messages: {
        transfer_amount: {
        required: "Amount is required.",
        range: "Please Enter Amount Between 5 to 100 dollar."
        }
        },
  
      submitHandler: function(form) {
                 form.submit(); 
        }
    });
         $('#add_wallet').validate({
        rules: {
        add_amount: {
        required: true,
        range: [5, 100]
        }
        },
        messages: {
        add_amount: {
        required: "Amount is required.",
        range: "Please Enter Amount Between 5 to 100 dollar."
        }
        },
  
      submitHandler: function(form) {
                 form.submit(); 
        }
    });
     $('#withdrawal').validate({
        rules: {
        add_amount: {
        required: true,
        range: [5, 100]
        }
        },
        messages: {
        add_amount: {
        required: "Amount is required.",
        range: "Please Enter Amount Between 5 to 100 dollar."
        }
        },
  
      submitHandler: function(form) {
                 form.submit(); 
        }
    });
  });
    </script>

 </div>
<?php
include "footer.php";
?>



