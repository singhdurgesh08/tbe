<?php 
ob_start(); 
 session_start();
  if ($_SESSION['user_data']['user_name'] == '') {
    
     header("location: login");
    exit();
}
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php";

$ticketid = $_GET['ticketid'];
?>

<script>
$(document).ready(function() {
$('#example1').DataTable({
    "order": [ 0, 'desc' ]
});
$('#example2').DataTable({
    "order": [ 0, 'desc' ]
});
} );
</script>
<div class="home_tab_section">
    <div class="container">
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="jumbotron">
                    <div class="row">
                      <div class="col-sm-12 text-center">
                      <h2>Withdraw History</h2>
                 </div>
                <div class="col-sm-2 text-center" id ="abc">
                      
                </div>
<div class="col-sm-8 ">
   
<div class="row">
    <div class="col-sm-12">
        <h3><strong></strong></h3></div>
 </div>
    <div class="row">
    <div>
    </div>
</div> 
</div>
</div>
<div class="row">
</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="home_tab_section">
                            <div class="container">
                                <div class="row">
                                    <div class="tabset-cashier col-md-12 ng-isolate-scope">
                                        <ul class="nav nav-tabs">
                                            <li role="presentation" class="ng-isolate-scope active">
                                                <a href="#1" data-toggle="tab">New Request</a>
                                            </li>
                                            <li role="presentation" class="ng-isolate-scope">
                                                <a href="#2" data-toggle="tab">Paid</a>
                                            </li>

                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="1">
                                                <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <caption class="text-center"></caption>  
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>PayPal Email</th>
                                                            <th>Withdraw Date</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
                          $userid = $_SESSION['user_data']['id'];
                          $is_admin = $_SESSION['user_data']['is_admin'];
                         
                    if ($des == "") {
                        if($is_admin) {
                           $res = mysql_query("select * from payments left join users on users.id = payments.user_id WHERE payments.item_number ='Withdrawal Wallet' and payments.payment_status = '1' order by payment_date desc");  
                                           
                        }else {

                        $res = mysql_query("select * from payments left join users on users.id = payments.user_id WHERE payments.user_id = '$userid' and payments.item_number ='Withdrawal Wallet' and payments.payment_status = '1' order by payment_date desc");
                        }
                    } $i =1;
                    while ($r = mysql_fetch_array($res)) { 
                      //echo "<pre>"; print_r($r);
                        ?>
                        <tr> 
                             <td><?php echo $r['payment_id']; ?></td>
                             <td><?php echo $r['payment_email']?></td>
                             <td>
                                  <?php  echo date("Y-m-d",strtotime($r['payment_date'])) . " EST ".date("h:i A",strtotime($r['payment_date'])); ?>
                             </td>
                             <td><?php echo $r['payment_gross']; ?></td>
                             <td><?php echo "New";  ?>
                            <?php if($is_admin) { ?> 
                                  &nbsp;|&nbsp;
                            <a href="withdraw?paymentid=<?php echo $r['payment_id']; ?>&action=paid" onclick="return confirm('Are you sure you want to Pay?');"> Mark 's As Paid </a></td>
                            <?php } ?>
                        </tr>

<?php }
?>
                </tbody>
            </table>
   </div>
            <div class="tab-pane" id="2">
              <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <caption class="text-center"></caption>  
                  <thead>
                     
                <tr class="text-center">
                      <th>Id</th>
                      <th>PayPal Email</th>
                      <th>Withdraw Date</th>
                      <th>Amount</th>
                      <th>status</th>
                  </tr>
                       
                  </thead>
               <tbody>
<?php
                          $userid = $_SESSION['user_data']['id'];
                          $is_admin = $_SESSION['user_data']['is_admin'];
                         
                    if ($des == "") {
                        if($is_admin) {
                          $res = mysql_query("select * from payments left join users on users.id = payments.user_id WHERE payments.item_number ='Withdrawal Wallet' and payments.payment_status = '2' order by payment_date desc");  
                         
                        }else {
                        $res = mysql_query("select * from payments left join users on users.id = payments.user_id WHERE payments.user_id = '$userid' and payments.item_number ='Withdrawal Wallet' and payments.payment_status = '2'");
                        }
                    } $i =1;
                    while ($r = mysql_fetch_array($res)) { 
                      //echo "<pre>"; print_r($r);
                        ?>
                        <tr> 
                             <td><?php echo $r['payment_id']; ?></td>
                             <td><?php echo $r['payment_email']?></td>
                             <td>
                                  <?php  echo date("Y-m-d",strtotime($r['payment_date'])) . " EST ".date("h:i A",strtotime($r['payment_date'])); ?>
                             </td>
                             <td><?php echo $r['payment_gross']; ?></td>
                             <td><?php echo "PAID";  ?></td>
                        </tr>
<?php }
?>
                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>

                                    </div>
                                </div><!--row end-->
                            </div>

                        </div>
                        <div>
                           
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        
    </div>
    <!--/row-->


</div>
</div>
<?php
if (isset($_GET['paymentid']) && $_GET['action'] =="paid") {
    $ids = $_GET['paymentid'];
     $query = mysql_query("UPDATE payments SET payment_status='2' WHERE  payment_id = $ids");
    header("location: withdraw");
    exit;
}
?>
<?php
include "footer.php";
?>
<!--/.fluid-container-->
<script>
function paidmark(id){
    if (confirm("Are you sure you want to pay ?")) {
	window.location.href ='<?php echo HOSTNAME; ?>withdraw?paymentid='+id+'&action=paid'; 
    }
    
} 
</script>

<style>
    thead th {
        background-color: #006DCC;
        color: white;
    }
    tbody td {
        background-color: #EEEEEE;
    }
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
    .nav-tabs>li>a {
        margin-right: 2px;
        line-height: 1.428571429;
        border: 1px solid transparent;
        border-radius: 4px 4px 0 0;
    }
    .nav.nav-tabs li a {
        -webkit-border-top-left-radius: 4px;
        -webkit-border-top-right-radius: 4px;
        -moz-border-radius-top-left: 4px;
        -moz-border-radius-top-right: 4px;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        background:  #006DCC;
        border: 1px solid transparent;
        border-bottom: 0;
        color: white;
        cursor: pointer;
        font-weight: bold;
        margin-left: 10px;
        padding: 10px 25px;
        position: relative;
        text-align: center;
        top: -1px;
    }
    a:active, a:hover {
        outline: 10;
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
        border-top-left-radius: 8px;
        border-top-right-radius: 4px;
        background:  #006DCC;
        height: 5px;
        width: 100%;
    }
</style>