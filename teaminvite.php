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
            <div class="col-sm-12 text-left"><span class="pull-right">
                <button  class="btn btn-lg btn-block btn-success" type="button"  onclick="window.location.href='sentinvite.php'">Sent Invite's</button></span>
            </div>

        <div class="col-sm-10 text-center">
            <h1> Team Invite's</h1>
        </div>
   </div>
    <div class="row">
       <div class="col-sm-12">


            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email id</th>
                        <th>User Name</th>
                        <th>Team Name</th>
                        <th>Action</th>
                    </tr>
                 </thead>
               <tbody>
                     <?php $i = 1;
                                      $res=mysql_query("SELECT * FROM team_list LEFT JOIN team ON team_list.team_id = team.id LEFT JOIN users ON users.id = team_list.user_id WHERE team_list.user_id= $userid and team_list.Player_status = 0 ;");
                                      while($r=mysql_fetch_assoc($res)) 
                                      { 
                                         ?>
                                            <tr>
                                            <td><?php echo $r['team_id']; ?> </td>
                                            <td><?php echo $r['user_email']; ?></td>
                                            <td><?php echo $r['user_name']; ?></td>
                                            <td><?php echo $r['team_name']; ?></td>
                                            <td>
                                            <a href="Teaminvite.php?teamids=<?php echo $r[team_id]; ?>&action=accept"> Accept </a>&nbsp;|&nbsp;</a>
                                            <?php
                                                  if ($_GET['action'] =='accept')
                                                    {
                                                      $ids = $_GET['teamids'];
                                                      $query =mysql_query("UPDATE team_list SET player_status='1' WHERE team_id = $ids");
                                                    }
                                            ?>
                                            <a href="Teaminvite.php?teamid=<?php echo $r[team_id]; ?>"> Decline </a>
                                            <?php
                                               if (isset($_GET['teamid']) && is_numeric($_GET['teamid']))
                                                  {
                                                        $ids = $_GET['teamid'];
                                                        $result = mysql_query("DELETE FROM team_list WHERE team_id = '$ids'");
                                                        header("location: Teaminvite.php");
                                                  }  
                                            ?>
                                            
                                      <?php 
                                       }
                                   ?>
                                            </td>
                                      
                                         </tr>
                                         <?php    
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