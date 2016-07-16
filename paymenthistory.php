<?php
session_start();

if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}

include "login-header.php";
?>
<?php include "nav.php"; ?>
<?php include "config.php";

?>
<div class="home_tab_section">
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Payment History</h1>
        </div>
        <div class="col-sm-6 text-center">
            <h1></h1>
        </div>
   </div>

   <div class="row">
        <div class="col-sm-12">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item No.</th>
                      
                        <th>Payment Type</th>
                        <th>User Id</th>
                        <th>Payment Gross</th>
                        <th>Currency Code</th>
                        <th>Payment Status</th>
                        <th>Payment Date</th>
                        <th>payment email</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                </thead>

                             <tbody>
                                <?php  
                               // $sql = mysql_query("select * from payments where payment_id = $userid");
                                 $sql = mysql_query("select * from payments ");
                                while($result = mysql_fetch_array($sql))
                                    {
                               ?>
                                <tr>
                                    <td><?php echo $result['payment_id'] ?></td>
                                    <td><?php echo $result['item_number'] ?></td>
                                    <td><?php echo $result['payment_type'] ?></td>
                                    <td>
                                         <a href="myprofile.php?usersid=<?php echo $result['user_id']; ?>">
                                           <b><?php echo $result['user_id']; ?></b>
                                        </a>
                                      </td>
                                    <td><?php echo $result['payment_gross'] ?></td>
                                    <td><?php echo $result['currency_code'] ?></td>
                                    <td><?php  if($result['payment_status'] =='0'){ echo "Pending";} else { echo "Approved";}?></td>
                                    <td>
                                        <?php echo date("Y-m-d",strtotime($r['payment_date'])) . " EST ".date("h:i A",strtotime($r['payment_date'])); ?>
                                        
                                    </td>
                                    <td><?php echo $result['payment_email'] ?></td>
                                    <td>
                                        <?php echo date("Y-m-d",strtotime($r['start_date'])) . " EST ".date("h:i A",strtotime($r['start_date'])); ?>
                                      
                                    </td>
                                    <td>
                                         <?php echo date("Y-m-d",strtotime($r['end_date'])) . " EST ".date("h:i A",strtotime($r['end_date'])); ?>
                                        </td>
                                </tr>
                                <?php } ?>
                             </tbody>
                    </table>
                   </div>
                </div>
     </div>
</div>


<?php
include "footer.php";
?>
<script>
$(document).ready(function() {
$('#example').DataTable();
} );
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