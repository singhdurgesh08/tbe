<?php 
 session_start();
  if ($_SESSION['user_data']['user_name'] == '') {
    
     header("location: login.php");
    exit();
}
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>


<div class="home_tab_section">
<div class="container">
    <div class="row">
        <div class="col-sm-10 text-center">
            <h1>Ticket</h1>
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Ticket type</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Match Name</th>
                    </tr>
                
                </thead>

                <tbody>
                         <?php
                          $userid = $_SESSION['user_data']['id'];
                          $is_admin = $_SESSION['user_data']['is_admin'];
                    if ($des == "") {
                        if($is_admin) {
                           $res = mysql_query("Select ticket.id,ticket.name,ticket.ticket_type,ticket.description,ticket.created_date,ps4_match.game_title from ticket left join ps4_match on ps4_match.id = ticket.match_id ");  
                        }else {
                        $res = mysql_query("Select ticket.id,ticket.name,ticket.ticket_type,ticket.description,ticket.created_date,ps4_match.game_title from ticket left join ps4_match on ps4_match.id = ticket.match_id where ticket.created_by = '$userid'");
                        }
                    } $i =1;
                    while ($r = mysql_fetch_array($res)) { // echo "<pre>"; print_r($r);
                        ?>
                        <tr>
                             <td><?php echo $r['id']; ?></td>
                             <td><?php echo $r['name']; ?></td>
                             <td><?php echo $r['ticket_type']; ?></td>
                             <td><?php echo $r['description']; ?></td>
                             <td><?php echo $r['created_date']; ?></td>
                            <td><?php echo $r['game_title']; ?></td>                             
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