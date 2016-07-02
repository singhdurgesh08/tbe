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
//$userid = $_SESSION['user_data']['id'];

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
                    <a href="sentinvite.php">Sent Invite's</a>   
                    </div>
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                    </div>
               <div class="row">
                    
                   <div class="col-sm-4">

                       <img src="<?php echo HOSTNAME; ?>assets/images/camera.jpg" class="img-responsive" alt="" >
                   </div>
                   <div class="col-sm-8 ">

                                   <?php
                                     $res=mysql_query("Select * from team where id= $teamid");
                                      $r=mysql_fetch_array($res);
                                     // echo "<pre>"; print_r($r);
                                  ?>
                                      <div class="row">
                                        
                                        <div class="col-sm-12">
                                                 <h3> <?php echo $r['team_name']; ?></h3>
                                                 Team ID  :- 0000<?php echo $r['id']; ?>
                                                 &nbsp;&nbsp;&nbsp; Platform :- <?php echo $r['platform']; ?>
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
                     <button class="btn btn-lg btn-block btn-success" type="button" name="submit" >Team Record    L - W</button>
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
                                    <th>Date Joined</th>
                                    </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                     $res=mysql_query("SELECT * FROM team_list LEFT JOIN team ON team_list.team_id = team.id LEFT JOIN users ON users.id = team_list.user_id WHERE team_list.player_status ='1' and team_list.team_id= $teamid");
                                      while($r=mysql_fetch_assoc($res))
                                  { 
                                    
                                ?>
                                           <tr>
                                                <td><a href="myprofile.php"><?php echo $r['user_name']; ?></a></td>
                                                <td>
                                                    <?php
                                                           $var =$r['team_id'];
                                                           if($r['team_id']== $var && $r['created_by']==$r['user_id'])
                                                            {
                                                                echo "Captain";
                                                            }
                                                            else
                                                            {
                                                              echo "Player";
                                                            }
                                                      ?>

                                                </td>
                                                <td><?php echo date ("d-M-Y",strtotime($r['join_date'])); ?></td>
                                               
                                           </tr>
                                         <?php    }
                                        ?>
                               </tbody>
                        </table>

                    </div>
    </div>
                
                <div class="row">
                                     
         </div>
                 <div class="row">
                    <div class="col-sm-12">
                     

                        <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <caption class="text-center"> <h3>Recent Matches</h3></caption>  
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
                                                where join_match.created_by = '$userid' and  ps4_match.open_date >= NOW();");
                              
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


                         <div class="login_form_page">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                <h6 class="login_title"><br class="hidden-xs">Team invite's </h6>
                              </div>
                            </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                                <form method='post' id="login" class="form-horizontal login_form">
                                  <fieldset>
                                    <div class="form-group">
                                      <div class="col-sm-12 input"><input name='name'  type="text" placeholder="Please Enter user name"  class="form-control email" required=""></div>
                                    </div>
            
                            <div class="form-group">
                              <div class="col-sm-12 input text-center">
                                 <button class="btn btn-md btn-block btn-success" type="submit" name="submit" value="submit">Submit <i class="glyphicon glyphicon-chevron-right"></i></button>
                              </div>
                            </div>
                         </form>
                      </fieldset>   
                  </div>
                          
                   
        </div>
            </div>
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
                       <!-- <li><a href="Teamdetails.php?teamid=<?php echo $teamid; ?>&action=DisableHere">Disable Team</a><li>-->
                        <li><a href="Editteam.php?teamid=<?php echo $teamid; ?>">Edit Team</a></li>
                        <li><a href="allmatch.php">All Matches</a></li>
                        
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