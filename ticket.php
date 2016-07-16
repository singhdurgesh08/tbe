<?php
ob_start(); 
 session_start();
  if ($_SESSION['user_data']['user_name'] == '') {
    
     header("location: login.php");
    exit();
}
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php";

$ticketid = $_GET['ticketid'];
 ?>


<div class="home_tab_section">
<div class="container">
    <div class="row">
        <div class="col-sm-10 text-center">
            <h1>Ticket's</h1>
        </div>

        <div class="col-sm-2 text-center">

        </div>
        
        <div class="col-sm-2 text-center">
            <a href="createticket.php" class="btn btn-lg btn-block btn-success"> Create Ticket </a> 
        </div>
    </div>




    <div class="row">
       <div class="col-sm-12">


            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                          //var_dump($is_admin);die();
                    if ($des == "") {
                        if($is_admin) {
                           $res = mysql_query("Select ticket.id,ticket.ticket_status,ticket.name,ticket.ticket_type,ticket.description,ticket.created_date,ps4_match.game_title from ticket left join ps4_match on ps4_match.id = ticket.match_id order by ticket.created_date desc");  
                        }else {
                        $res = mysql_query("Select ticket.id,ticket.ticket_status,ticket.name,ticket.ticket_type,ticket.description,ticket.created_date,ps4_match.game_title from ticket left join ps4_match on ps4_match.id = ticket.match_id where ticket.created_by = '$userid' order by ticket.created_date desc");
                        }
                    } $i =1;
                    while ($r = mysql_fetch_array($res)) { 
                      //echo "<pre>"; print_r($r);
                        ?>
                        <tr> 
                             <td onclick="document.location='view_ticket.php?ticketid=<?php echo $r[id]; ?>';" style="cursor:pointer;"><?php echo $r['id']; ?></td>
                             <td onclick="document.location='view_ticket.php?ticketid=<?php echo $r[id]; ?>';" style="cursor:pointer;"> <?php if($r['ticket_type']==0){                                             echo "Ticket";
                                         }else{ echo "Match dispute";}?></td>

                             <td onclick="document.location='view_ticket.php?ticketid=<?php echo $r[id]; ?>';" style="cursor:pointer;"><?php echo $r['description']; ?></td>
                             <td onclick="document.location='view_ticket.php?ticketid=<?php echo $r[id]; ?>';" style="cursor:pointer;"><?php echo date("Y-m-d h:i A",strtotime($r['created_date'])); ?></td>

                             <td><!--<a href="view_ticket.php?ticketid=<?php echo $r[id]; ?>">View</a> &nbsp; |
                             &nbsp;-->
                             <?php
                                if ($r[ticket_status] == 0) {
                                  ?><a href="#">Close</a><?php
                                }
                                else
                                {
                                  ?><a href="#">New</a> <?php 
                                }
                             ?>
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
    </div>
</div>

</div>

<script>
$(document).ready(function() {
$('#example').DataTable();
} );
</script>


<?php 
    include "footer.php";
?>