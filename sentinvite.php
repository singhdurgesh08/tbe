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
           <button  class="btn btn-lg btn-block btn-success" type="button"  onclick="window.location.href='teaminvite.php'">Go Back!</button></span>
        </div>

        <div class="col-sm-10 text-center">
            <h1> Sent Invite's</h1>
        </div>
   </div>

    <div class="row">
       <div class="col-sm-12">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Team</th>
                        <th>Game Mode</th>
                        <th>Platform</th>
                       
                    </tr>
               </thead>

                <tbody>
                     <?php $i = 1;
                          $res=mysql_query("SELECT * FROM team_list LEFT JOIN team ON team_list.team_id = team.id LEFT JOIN users ON users.id = team_list.user_id 
                          WHERE team_list.created_by= $userid ;");
                                      while($r=mysql_fetch_assoc($res))
                                      { 
                                         ?>
                                            <tr>
                                            <td><?php echo $r['team_name']; ?> </td>
                                            <td><?php echo $r['game_Mode']; ?></td>
                                            <td><?php echo $r['platform']; ?></td>
                                                                                          
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