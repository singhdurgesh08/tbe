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
if (isset($_GET['delete_id'])) {
    $sql_query = "DELETE FROM team WHERE id=" . $_GET['delete_id'];
    mysql_query($sql_query);
    header("Location:teamlist.php");
    exit;
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
        <div class="col-sm-2 text-center">
            <a href="AddTeam.php" class="btn btn-lg btn-block btn-success"> Add Team </a> 
        </div>
    </div>




    <div class="row">
        <div class="col-sm-12">


            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Team Name</th>
                        <th>Playstation</th>
                        <th>Game Mode</th>
                        <th>Added Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $userid = $_SESSION['user_data']['id'];
                    if ($des == "") {
                        $res = mysql_query("Select * from team where created_by = '$userid'");
                    } $i =1;
                    while ($r = mysql_fetch_array($res)) { // echo "<pre>"; print_r($r);
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td> 
                                <?php
                                    if($r['platform']== PS4) 
                                    {
                                      echo '<img src="assets/images/ps4_list.jpg" width="40" class="img-responsive" alt="" style="display:inline;" />  '.$r['team_name'];     
                                    //    echo $r['team_name']; 
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
                            <td> <a href="Teamdetails.php?teamid=<?php echo $r[0]; ?>"> View Team </a>   | 
                                <a href="javascript:delete_id(<?php echo $r[0]; ?>)">Delete</a>

                                <script type="text/javascript">
                                    function delete_id(id)
                                    {
                                        if (confirm('Sure To Remove This Record ?'))
                                        {
                                            window.location.href = 'teamlist.php?delete_id=' + id;
                                        }
                                    }
                                </script>

                               
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