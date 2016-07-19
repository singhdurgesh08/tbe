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
$('#example1').DataTable();
$('#example2').DataTable();
} );
</script>
<div class="home_tab_section">
    <div class="container">
        <div class="row">
            <!--/span-->
            <div class="col-md-12">
                <div class="jumbotron">
                    <div class="row">
                      <div class="col-sm-10 text-center">
                      <h2>Ticket's</h2>
                 </div>
                 <div class="col-sm-2 text-center">
                     <a href="createticket" class="btn btn-lg btn-block btn-success"> Create Ticket </a> 
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
                                                <a href="#1" data-toggle="tab">New Ticket's</a>
                                            </li>
                                            <li role="presentation" class="ng-isolate-scope">
                                                <a href="#2" data-toggle="tab">Closed Ticket's</a>
                                            </li>

                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="1">
                                                <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <caption class="text-center"></caption>  
                                                    <thead>
                                                        <tr>
                                                            <th>Ticket Id</th>
                                                            <th>Ticket type</th>
                                                            <th>Description</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
                          $userid = $_SESSION['user_data']['id'];
                          $is_admin = $_SESSION['user_data']['is_admin'];
                         // var_dump($is_admin);
                          //var_dump($is_admin);die();
                    if ($des == "") {
                        if($is_admin) {
                           $res = mysql_query("Select ticket.id,ticket.ticket_status,ticket.name,ticket.ticket_type,ticket.description,ticket.created_date,ps4_match.game_title from ticket left join ps4_match on ps4_match.id = ticket.match_id   where ticket_status=1 order by ticket.created_date desc ");  
                        }else {
                        $res = mysql_query("Select ticket.id,ticket.ticket_status,ticket.name,ticket.ticket_type,ticket.description,ticket.created_date,ps4_match.game_title from ticket left join ps4_match on ps4_match.id = ticket.match_id where ticket.created_by = '$userid' and  ticket_status=1 order by ticket.created_date desc");
                        }
                    } $i =1;
                    while ($r = mysql_fetch_array($res)) { 
                      //echo "<pre>"; print_r($r);
                        ?>
                        <tr> 
                             <td onclick="document.location='view_ticket?ticketid=<?php echo $r[id]; ?>';" style="cursor:pointer;"><?php echo $r['id']; ?></td>
                             <td onclick="document.location='view_ticket?ticketid=<?php echo $r[id]; ?>';" style="cursor:pointer;"> <?php if($r['ticket_type']==0){ echo "Ticket";
                                         }else{ echo "Match dispute";}?></td>

                             <td onclick="document.location='view_ticket?ticketid=<?php echo $r[id]; ?>';" style="cursor:pointer;"><?php echo $r['description']; ?></td>
                             <td onclick="document.location='view_ticket?ticketid=<?php echo $r[id]; ?>';" style="cursor:pointer;"><?php echo date("Y-m-d",strtotime($r['created_date'])) . " EST ".date("h:i A",strtotime($r['created_date'])); ?></td>

                             <td><!--<a href="view_ticket.php?ticketid=<?php echo $r[id]; ?>">View</a> &nbsp; |
                             &nbsp;-->
                             <?php
                                if ($r[ticket_status] == 0) {
                                  ?><a href="#">Close</a><?php
                                }
                                else
                                {
                                  echo "New"; 
                                }
                             ?>
                             <?php
                             if ($is_admin ==1 and $r[ticket_status] == 1) {
                                ?>&nbsp; | &nbsp;&nbsp;
                                 <a href="ticket?ticketid=<?php echo $r[id]?>&action=Closeticket">Close Ticket</a> 
                               <?php
                                    ob_start();
                                    if ($_GET['action'] =='Closeticket') 
                                      {
                                        echo"<script>alert('Sure you want to Close ticket')</script>";
                                        $query =mysql_query("UPDATE ticket SET ticket_status='0' WHERE id = $ticketid ");
                                          ob_start();
                                           header("location:ticket?ticketid=$ticketid");
                                           
                                      }
                              }

                              if ($is_admin ==1 and $r[ticket_status] == 0) {

                              ?>&nbsp; | &nbsp;&nbsp;<b><?php echo "Admin Close"; ?></b>
                              <!--  <a href="ticket.php?ticketid=<?php echo $r[id]?>&action=Activeticket">Active Ticket</a> -->
                               <?php
                                    //if ($_GET['action'] =='Activeticket') 
                                      //{
                                     //   echo"<script>alert('Sure you want to Active Ticket')</script>";
                                     //   $query =mysql_query("UPDATE ticket SET ticket_status='1' WHERE id = $ticketid ");
                                    //  }
                                    
                              }

                                                              
                             ?>
                             </td>
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
                      <tr>
                          <th>Ticket Id</th>
                          <th>Ticket type</th>
                          <th>Description</th>
                          <th>Date</th>
                          <th>Action</th>
                       </tr>
                  </thead>
               <tbody>
<?php
                          $userid = $_SESSION['user_data']['id'];
                          $is_admin = $_SESSION['user_data']['is_admin'];
                         // var_dump($is_admin);
                          //var_dump($is_admin);die();
                    if ($des == "") {
                        if($is_admin) {
                           $res = mysql_query("Select ticket.id,ticket.ticket_status,ticket.name,ticket.ticket_type,ticket.description,ticket.created_date,ps4_match.game_title from ticket left join ps4_match on ps4_match.id = ticket.match_id  where ticket_status=0");  
                        }else {
                        $res = mysql_query("Select ticket.id,ticket.ticket_status,ticket.name,ticket.ticket_type,ticket.description,ticket.created_date,ps4_match.game_title from ticket left join ps4_match on ps4_match.id = ticket.match_id where ticket.created_by = '$userid' and  whre ticket_status=0");
                        }
                    } $i =1;
                    while ($r = mysql_fetch_array($res)) { 
                      //echo "<pre>"; print_r($r);
                        ?>
                        <tr> 
                             <td><?php echo $r['id']; ?></td>
                             <td> <?php if($r['ticket_type']==0){ echo "Ticket";
                                         }else{ echo "Match dispute";}?></td>

                             <td><?php echo $r['description']; ?></td>
                             <td><?php echo date("Y-m-d",strtotime($r['created_date'])) . " EST ".date("h:i A",strtotime($r['created_date'])); ?></td>

                             <td><!--<a href="view_ticket.php?ticketid=<?php echo $r[id]; ?>">View</a> &nbsp; |
                             &nbsp;-->
                            <!-- <?php
                                if ($r[ticket_status] == 0) {
                                  ?><a href="#">Close</a><?php
                                }
                                else
                                {
                                  echo "New"; 
                                }
                             ?>-->
                             <?php
                             if ($is_admin ==1 and $r[ticket_status] == 1) {
                                ?>&nbsp; | &nbsp;&nbsp;
                                 <a href="ticket.php?ticketid=<?php echo $r[id]?>&action=Closeticket">Close Ticket</a> 
                               <?php
                                    ob_start();
                                    if ($_GET['action'] =='Closeticket') 
                                      {
                                        echo"<script>alert('Sure you want to Close ticket')</script>";
                                        $query =mysql_query("UPDATE ticket SET ticket_status='0' WHERE id = $ticketid ");
                                          ob_start();
                                           header("location:ticket.php?ticketid=$ticketid");
                                           
                                      }
                              }

                              if ($is_admin ==1 and $r[ticket_status] == 0) {

                              ?><b><?php echo "Admin Closed"; ?></b>
                              <!--  <a href="ticket.php?ticketid=<?php echo $r[id]?>&action=Activeticket">Active Ticket</a> -->
                               <?php
                                    //if ($_GET['action'] =='Activeticket') 
                                      //{
                                     //   echo"<script>alert('Sure you want to Active Ticket')</script>";
                                     //   $query =mysql_query("UPDATE ticket SET ticket_status='1' WHERE id = $ticketid ");
                                    //  }
                                    
                              }

                                                              
                             ?>
                             </td>
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
include "footer.php";
?>
<!--/.fluid-container-->


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