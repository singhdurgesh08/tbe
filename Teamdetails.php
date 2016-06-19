<?php session_start();  
include "login-header.php";
include "nav.php";
include "config.php"; 
$teamid = $_GET['teamid'];

if ($_GET['action'] =='DisableHere') 
  {  
         $sql_query ="UPDATE team SET status = 0 WHERE id = $teamid";
         mysql_query($sql_query);
         header("Location: Teamdetails.php?teamid=".$teamid);
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
Ha
</style>
<div class="home_tab_section">
<div class="container">
    <div class="row">
        
        <!--/span-->
        <div class="col-md-9">
            <div class="jumbotron">
                <div class="col-sm-12 text-center">
                        <h2>  Team Detail</h2>
                    </div>
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                    </div>
               <div class="row">
                   <div class="col-sm-4">
                       <img src="<?php echo HOSTNAME; ?>assets/images/team.jpg" class="img-responsive" alt="" >
                   </div>
                   <div class="col-sm-8 ">

                                   <?php
                                     $res=mysql_query("Select * from team where id= $teamid");
                                      $r=mysql_fetch_array($res);
                                     // echo "<pre>"; print_r($r);
                                  ?>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            Team ID  :- 0000<?php echo $r['id']; ?>
                                        </div> 
                                          <div class="col-sm-6">
                                           Team Name:- <?php echo $r['team_name']; ?>
                                        </div> 
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-6">
                                          Platform :- <?php echo $r['platform']; ?>
                                        </div> 
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-6">
                                          Game Mode :- <?php echo $r['game_Mode']; ?>
                                        </div> 
                                        <div class="col-sm-6">
                                         Register Date :- <?php echo date ("d-M-Y",strtotime($r['date_added'])); ?>
                                        </div> 
                                      </div> 
                                       
  
                                      

                   </div>
         </div>
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                   
         </div>
                <div class="row">
                   <div class="col-sm-6">
                     <button class="btn btn-lg btn-block btn-success" type="button" name="submit" onclick="window.location='myprofile.php';">Team Record</button>
                   </div>
                   
         </div>
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                   
         </div>
                <div class="row">
                    <div class="col-sm-12">


                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <caption class="text-center"> <h3>Roster</h3></caption>  
                            <thead class="thead-inverse">
                                <tr>
                                    
                                    <th>Roster</th>
                                    <th>Role</th>
                                    <th>Eligibilty</th>
                                    <th>Date Joined</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                     $res=mysql_query("SELECT * FROM team_list LEFT JOIN team ON team_list.team_id = team.id LEFT JOIN users ON users.id = team_list.user_id WHERE team_list.team_id= $teamid");
                                      while($r=mysql_fetch_assoc($res))
                                  { 
                         //echo "<pre>"; print_r($r);
                           ?>
                                           <tr>
                                            <td>
                                                <?php 
                                                    
                                                    echo $r['user_name']; 
                                                ?>

                                            </td>


                                            <td>Player</td>
                                            <td> Yes</td>
                                            <td><?php echo date ("d-M-Y",strtotime($r['join_date'])); ?></td>
                                         </tr>
                                         <?php    }
                                        ?>
                               </tbody>
                        </table>

                    </div>
    </div>
                
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                   
         </div>
                 <div class="row">
                    <div class="col-sm-12">


                        <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <caption class="text-center"> <h3>Recent Matches</h3></caption>  
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Recent Match</th>
                                    <th>Result</th>
                                    <th>Date</th>
                                    <th>Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                  
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                          <?php echo '<a href="#">Match Details</a> ' ?>
                                        </td>
                                        
                                    </tr>
                               </tbody>
                        </table>

                    </div>
    </div>
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                   
         </div>
            </div>
           
        </div>
        <!--/span-->
        <div class="col-md-3">
            <div class="sidebar-nav-fixed pull-right">
                <div class="well">
                    <ul class="nav ">
                        <li class="nav-header"></li>
                        <li class="active"><a href="xb1matchlist.php">Match Finder</a></li>
                        <li><a href="Addplayer.php?teamid=<?php echo $teamid;?>">Add Member</a></li>



                        <li><a href="Teamdetails.php?teamid=<?php echo $teamid; ?>&action=DisableHere">Disable Team</a><li>
                        <li><a href="Editteam.php?teamid=<?php echo $teamid; ?>">Edit Team</a></li>
<!--                        <li><a href="EditRoster.php?teamid=<?php echo $teamid; ?>">Edit Roster</a></li>-->
                        
                    </ul>
                </div>
                <!--/.well -->
            </div>
            <!--/sidebar-nav-fixed -->
        </div>
        <!--/span-->
        
    </div>
    <!--/row-->

    
</div>
</div>
<?php

if (isset($_POST['Team_details'])) 
  {
     
  }
if (isset($_POST['Delete'])) 
  {
    //Delete also remains.    
  }
?>



<?php
include "footer.php";
?>


<!--/.fluid-container-->