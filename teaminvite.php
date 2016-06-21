<?php 
session_start();  
include "login-header.php";
include "nav.php";
include "config.php"; 

$teamid = $_GET['teamid'];

//$userid = $_SESSION['user_data']['id'];

if ($_GET['action'] =='add') 
  {  
         $sql_query ="UPDATE team_list SET player_status = 1 WHERE team_id = 48 ";
         mysql_query($sql_query);
  }
    

?>
<style>
 thead th {
    background-color: #006DCC;
    color: white;
}

tbody td {
    background-color: #EEEEEE;
}

</style>
<div class="home_tab_section">
<div class="container">
    <div class="row">
        
        <!--/span-->
        <div class="col-md-9">
            <div class="jumbotron">
                <div class="col-sm-12 text-center">
                        <h2>  Team Invite's</h2>
                    </div>
               
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                   
         </div>
                <div class="row">
                    <div class="col-sm-12">
                       <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                          <thead class="thead-inverse">
                                <tr>
                                    <th>Id</th>
                                    <th>Email id</th>
                                    <th>User Name</th>
                                    <th>Team Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                      $res=mysql_query("SELECT * FROM team_list LEFT JOIN team ON team_list.team_id = team.id LEFT JOIN users ON users.id = team_list.user_id WHERE team_list.user_id= $userid and team_list.Player_status = 0;");
                                      while($r=mysql_fetch_assoc($res))
                                      { 
                        						     ?>
                                            <tr>
                                            <td><?php echo $r['team_id']; ?> </td>
                                            <td><?php echo $r['user_email']; ?></td>
                                            <td><?php echo $r['user_name']; ?></td>
                                            <td><?php echo $r['team_name']; ?></td>
                                            <td>
                                            	<a href="Teaminvite.php?action=add" class="r"> Accept </a>  
                                              
                                      <?php 
                                    	 }
                                   ?>
                                            </td>
                                      
                                         </tr>
                                         <?php    
                                        ?>

                                        <script>
											
											function acceptMatch(player_status){
											    $("#join_team").modal("show");
											    $("#claim_title").val(str);
											    $("#matchid").val(id);

											}
											</script>
                               </tbody>
                        </table>

                    </div>
   						 </div>
                
                
         </div>
    </div>


        
    
</div>
</div>
</div>
</div>


<?php
include "footer.php";
?>


<!--/.fluid-container-->