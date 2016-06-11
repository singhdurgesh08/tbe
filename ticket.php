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
            <h1>My Ticket</h1>
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
                        <th>Description</th>
                    </tr>
                
                </thead>

                <tbody>
                         <?php
                    $userid = $_SESSION['user_data']['id'];
                    if ($des == "") {
                        $res = mysql_query("Select * from ticket where created_by = '$userid'");
                    } $i =1;
                    while ($r = mysql_fetch_array($res)) { // echo "<pre>"; print_r($r);
                        ?>
                        <tr>
                             <td><?php echo $r['id']; ?></td>
                             <td><?php echo $r['name']; ?></td>
                             <td><?php echo $r['description']; ?></td>
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