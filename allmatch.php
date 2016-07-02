<?php session_start();  
include "login-header.php";
include "nav.php";
include "config.php"; 

$teamid = $_GET['teamid'];
/*
if ($_GET['action'] =='DisableHere') 
  {  
         $sql_query ="UPDATE team SET status = 0 WHERE id = $teamid";
         mysql_query($sql_query);
         header("Location: Teamdetails.php?teamid=".$teamid);
  }
//$userid = $_SESSION['user_data']['id'];
*/
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
                </div>
                
                <div class="row">
                   <div class="col-sm-12">
                    </div>
                    </div>
                <div class="row">
                   <div class="col-sm-12">
                   
                   </div>
                   
         </div>
                <div class="row">
                   <div class="col-sm-6">
                   
                   </div>
                  
         </div>
                <div class="row">
                                     
         </div>
                <div class="row">
                    <div class="col-sm-12">


                    </div>
    </div>
                
                <div class="row">
                                     
         </div>
                 <div class="row">
                    <div class="col-sm-12">
                      <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <caption class="text-center"> <h3>All Matches</h3></caption>  
                            <thead>
                                <tr>
                                    <th>Recent Match</th>
                                    <th>Result</th>
                                    <th>Date</th>
                                    <th>Info</th>
                               </tr>
                            </thead>

                            <tbody>
                             <?php 
                                 $res=mysql_query("Select * from users  
                                                left join join_match on join_match.created_by = users.id 
                                                left join ps4_match on ps4_match.id = join_match.match_id 
                                                where join_match.created_by = '$userid'");
                              
                                   while($r=mysql_fetch_assoc($res))
                                  {    //print_r($r);
                              ?>      
                                           <tr>
                                                <td><?php echo $r[platform] ?></td>
                                                <td><?php if( $r[Match_play_status] == 0 )
                                                            {
                                                              echo "pending";
                                                            }else if( $r[Match_play_status] == 1){
                                                              echo "Win";
                                                            }
                                                            else
                                                            {
                                                              echo "Loss";
                                                            }
                                                 ?></td>
                                                <td><?php echo $r[open_date] ?></td>
                                                <td><a href="matchdetails.php?Matchid=<?php echo $r[match_id] ?>">Match Details</a></td>
                                                 
                                           </tr>
                                         <?php    }
                                ?>
                                        
                            </tbody>

                        </table>

                         <div>
                            <div class="row">
                          <div class="col-sm-12">
                                               
                            
                  </div>
                          
                   
        </div>
            </div>
                    </div>
    </div>
                <div class="row">
                   
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
                        <li><a href="Editteam.php?teamid=<?php echo $teamid; ?>">Edit Team</a></li>
                        <li><a href="EditRoster.php?teamid=<?php echo $teamid; ?>">All Matches</a></li>
                        
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



?>
<script>
//$(document).ready(function() {
//$('#example').DataTable();
////$("#join_team").modal("show");
//} );
function acceptMatch(str,id){
    $("#join_team").modal("show");
    $("#claim_title").val(str);
    $("#matchid").val(id);

}
</script>

<?php 
if (isset($_POST['submit'])) 
  {
       $name = $_POST['name'];
       $res = mysql_query("Select id from users where user_name ='$name'");
       $r = mysql_fetch_array($res);
         $result = $r['id'];
          if ($result != '') 
            { 
               $query ="INSERT INTO `team_list` (`user_id`, `team_id`, `join_date`, `created_by`,`player_status`) VALUES ('$r[id]', '$teamid',now(),'$userid',0)";
                echo"<script>alert('Team Invited successfullly')</script>";
             }
             else
             {
                   echo"<script>alert('Please Invite Valid user')</script>";
             }
                
  }

?>

<?php
include "footer.php";
?>


<!--/.fluid-container-->