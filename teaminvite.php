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
//echo $userid;
?>


<div class="home_tab_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-left"><span class="pull-right">
               <!-- <button  class="btn btn-lg btn-block btn-success" type="button"  onclick="window.location.href='sentinvite.php'">Sent Invite's</button></span>-->
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
                        <th>User Name</th>
                        <th>Team Name</th>
                        <th>Game Mode</th>
                        <th>Platform</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                 </thead>
               <tbody>
                     <?php $i = 1;

                   //  echo "SELECT * FROM team_list LEFT JOIN team ON team_list.team_id = team.id LEFT JOIN users ON users.id = team_list.user_id WHERE team_list.user_id= $userid and team_list.Player_status = 0;";
                           $res=mysql_query("SELECT * FROM team_list LEFT JOIN team ON team_list.team_id = team.id LEFT JOIN users ON users.id = team_list.created_by WHERE team_list.user_id= $userid and team_list.Player_status = 0;");
                           while($r=mysql_fetch_assoc($res))
                                      {    //print_r($r);
                                         ?>
                                            <tr>
                                            <td><?php echo $r['team_id'];?> </td>
                                            <td>
                                               <a href="myprofile.php?usersid=<?php echo $r['id']; ?>"><?php echo $r['user_name'];?></a>
                                            </td>
                                            <td>
                                              <?php
                                                if($r['platform']== PS4) 
                                                    {
                                                      echo '<img src="assets/images/playstation final.png" width="20" class="img-responsive" alt="" style="display:inline;" /> &nbsp; '.$r['team_name'];     
                                                    }
                                                else
                                                    {
                                                       echo '<img src="assets/images/xb1_list.jpg" width="20" class="img-responsive" alt="" style="display:inline;"/> &nbsp; ' . $r['team_name'];      
                                                    }
                                              ?>
                                              <td><?php echo $r['game_Mode']; ?> </td>
                                               <td><?php echo  $r['platform']; ?></td>
                                              <!-- <th><?php echo $r['join_date']; ?></th>  -->
                                                <td><?php echo date("Y-M-d h:i A",strtotime($r['join_date'])); ?></td>                                              
                                            </td>
                                            <td>
                                            <a href="teaminvite?teamids=<?php echo $r['team_id']; ?>&action=accept"> Accept </a>&nbsp;|&nbsp;</a>
                                            
                                            <a href="teaminvite?teamid=<?php echo $r['team_id']; ?>"> Decline </a>
                                     
                                            </td>
                                      
                                         </tr>
                                        <?php 
                                       }
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
if ($_GET['action'] == 'accept') {
    $teamid = $_GET['teamids'];
    $sql =mysql_query("Select * from team where id= $teamid");
        $result = mysql_fetch_array($sql);
        $var = trim($result['game_Mode']);
        $a = "1v1 Mycourt";$b ="2v2 Mycourt";$c ="3v3 Mycourt";$d ="Quick Match";$e ="Myteam";
        $query = "SELECT count(*) AS total FROM team_list where team_id=$teamid and player_status = '1'"; 
        $result1 = mysql_query($query); 
        $values = mysql_fetch_assoc($result1); 
        $num_rows = $values['total']; 
        if($var == $a and $num_rows == 1) {
        echo "<script>alert('Sorry ! Team has been full.')</script>";
        exit();
    } elseif ($var == $b and $num_rows == 2) {
        echo "<script>alert('Sorry ! Team has been full.')</script>";
        exit();
    } elseif ($var == $c and $num_rows == 3) {
        echo "<script>alert('Sorry ! Team has been full.')</script>";
        exit();
    } elseif ($var == $d and $num_rows == 1) {
        echo "<script>alert('Sorry ! Team has been full.')</script>";
        exit();
    } elseif ($var == $e and $num_rows == 1) {
        echo "<script>alert('Sorry ! Team has been full.')</script>";
        exit();
    } else {

        $query = mysql_query("UPDATE team_list SET player_status='1' WHERE team_id = $teamid and user_id = $userid");
        header("location: teaminvite");
        exit;
    }
}
?>

<?php
if (isset($_GET['teamid']) && is_numeric($_GET['teamid'])) {
    $ids = $_GET['teamid'];
    $result = mysql_query("DELETE FROM team_list WHERE team_id = $ids and user_id = $userid and player_status='0'");
    header("location: teaminvite");
    exit;
}
?>
<?php 
    include "footer.php";
?>