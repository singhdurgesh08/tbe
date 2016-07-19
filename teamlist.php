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

 if (isset($_GET['teamid']) && is_numeric($_GET['teamid'])) {
    $ids = $_GET['teamid'];
    $result = mysql_query("DELETE FROM team WHERE id = '$ids'");
    header("location: teamlist.php");
    //EXIT;
}
?>
<div class="home_tab_section">
<div class="container">
    <div class="row">
        <div class="col-sm-4 text-center">
            <h1>Team </h1>
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
                        <th>Team Name</th>
                        <th>Platform</th>
                        <th>Game Mode</th>
                        <th>Added Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                                        
                    $userid = $_SESSION['user_data']['id'];
                    $is_admin = $_SESSION['user_data']['is_admin'];

                    if ($des == "") {
                        if($is_admin){ 
                           $res = mysql_query("Select * from team order by id desc"); 
                        }else {
                          $res = mysql_query("Select * from team where created_by = '$userid'");  
                        }
                        
                    } $i =1;
                    while ($r = mysql_fetch_array($res)) {  // echo "<pre>"; print_r($r);
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td> 
                                <?php
                                    if($r['platform']== PS4) 
                                    {
                                      echo '<img src="assets/images/playstation final.png" width="20" class="img-responsive" alt="" style="display:inline;" />  '.$r['team_name'];     
                                    }
                                    else
                                    {
                                       echo '<img src="assets/images/xb1_list.jpg" width="20" class="img-responsive" alt="" style="display:inline;"/>  '. $r['team_name'];      
                                    }
                                   ?>

                            </td>

                             <td><?php echo $r['platform']; ?></td>
                             <td><?php echo $r['game_Mode']; ?></td>
                               <td><?php echo date ("d-M-Y",strtotime($r['date_added'])); ?></td>
                            <td>
                                <a href="teamdetails?teamid=<?php echo encryptor('encrypt',$r[0]); ?>"> View Team </a>  
                                 <?php 
                                    if ($is_admin == "1" || $userid ==$r['created_by']) {
                                        echo ('| <a href=teamlist?teamid='. $r[id] . ' >Delete</a>');
                                        if (isset($_GET['teamid']) && is_numeric($_GET['teamid']))
                                            {
                                                  $ids = $_GET['teamid'];
                                                  $result = mysql_query("DELETE FROM team WHERE id = '$ids'");
                                                  header("location:teamlist.php");
                                                                                                     
                                            }

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

<?php if ($is_admin == "1") { ?>
<script>
$(document).ready(function() {
$('#example').DataTable();
} );
</script>
<?php }  ?>


<?php
include "footer.php";
?>