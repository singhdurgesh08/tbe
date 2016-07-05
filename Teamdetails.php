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

.nav.nav-tabs li:first-child a {
    margin-left: 0;
}
.nav.nav-tabs li.active a {
    background: #fff;
    border-bottom: 0 !important;
    border-color: #d9d9d9;
    border-top: 0;
    color: #DF0A0A;
    position: relative;
    top: 1px;
    z-index: 1;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    color: #555;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
    cursor: default;
}


.nav-tabs>li>a {
    margin-right: 2px;
    line-height: 1.428571429;
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
}
.nav.nav-tabs li a {
    -webkit-border-top-left-radius: 4px;
    -webkit-border-top-right-radius: 4px;
    -moz-border-radius-top-left: 4px;
    -moz-border-radius-top-right: 4px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background:  #006DCC;
    border: 1px solid transparent;
    border-bottom: 0;
    color: white;
    cursor: pointer;
    font-weight: bold;
    margin-left: 10px;
    padding: 10px 25px;
    position: relative;
    text-align: center;
    top: -1px;
}
a:active, a:hover {
    outline: 10;
}
.tab-content>.tab-pane {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #fff;
    border: 1px solid #d9d9d9;
    border-top-left-radius: 0 !important;
    margin-bottom: 10px;
    padding: 10px;
    padding-bottom: 0;
}
.nav.nav-tabs li.active a::after {
    content: '';
    position: absolute;
    right: 0;
    top: 0;
    -webkit-border-top-left-radius: 4px;
    -webkit-border-top-right-radius: 4px;
    -moz-border-radius-top-left: 4px;
    -moz-border-radius-top-right: 4px;
    border-top-left-radius: 8px;
    border-top-right-radius: 4px;
    background:  #006DCC;
    height: 5px;
    width: 100%;
}

</style>
<div class="home_tab_section">
<div class="container">
    <div class="row">
        
        <!--/span-->
        <div class="col-md-9">
            <div class="jumbotron">
                
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                    </div>
               <div class="row">
                    
                   <div class="col-sm-4">
                       <?php
                            $res = mysql_query("Select * from team where id= $teamid");
                            $r = mysql_fetch_array($res);
                            $finalimage = $r['team_image'];
                            // echo "<pre>"; print_r($r);
                            if($finalimage) {  
                        ?>
                              <img src="<?php echo HOSTNAME; ?>upload/<?php echo $finalimage;?>" width="150" class="img-responsive" alt="" />
                      <?php } else { ?>
                       <img src="<?php echo HOSTNAME; ?>assets/images/camera.jpg" class="img-responsive" alt="" >
                       <?php }  ?>
                   </div>
                   <div class="col-sm-8 ">

                                   <?php
                                    // $res=mysql_query("Select * from team where id= $teamid");
                                     // $r=mysql_fetch_array($res);
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
                     <button class="btn btn-lg btn-block btn-success" type="button" name="submit" >Team Record   W - L</button>
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
                                                <td><a href="myprofile.php?usersid=<?php echo $r['id']; ?>"><?php echo $r['user_name']; ?>
                                                </a></td>
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
                                             
  <div class="home_tab_section">
    <div class="container">
        <div class="row">
            <div class="tabset-cashier col-md-12 ng-isolate-scope">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="ng-isolate-scope active">
                        <a href="#1" data-toggle="tab">Recent Matches</a>
                    </li>
                    <li role="presentation" class="ng-isolate-scope">
                        <a href="#2" data-toggle="tab">All Matches</a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="1">
                        <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <caption class="text-center"></caption>  
                            <thead>
                                <tr>
                                    <th>Recent Match</th>
                                    <th>Result</th>
                                    <th>Date</th>
                                    <th>Vs Team</th>
                                    <th>Info</th>
                               </tr>
                            </thead>
                            <tbody>
                             <?php 
                                $res=mysql_query("Select * from users  
                                                left join join_match on join_match.created_by = users.id 
                                                left join ps4_match on ps4_match.id = join_match.match_id 
                                                where join_match.created_by = '$userid' and join_match.team_id ='$teamid'");
                              
                                   while($r=mysql_fetch_assoc($res))
                                  {    
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
                                                </td>
                                                <td><a href="matchdetails.php?Matchid=<?php echo $r[match_id] ?>">Match Details</a></td>
                                                 
                                           </tr>
                                         <?php    }
                                ?>
                                        
                            </tbody>

                        </table>
                    </div>
                    <div class="tab-pane" id="2">
                        <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <caption class="text-center"></caption>  
                            <thead>
                                <tr>
                                    <th>Recent Match</th>
                                    <th>Result</th>
                                    <th>Date</th>
                                     <th>Vs Team</th>
                                    <th>Info</th>
                               </tr>
                            </thead>

                            <tbody>
                             <?php 
                             $res=mysql_query("Select * from users  
                                                left join join_match on join_match.created_by = users.id 
                                                left join ps4_match on ps4_match.id = join_match.match_id 
                                                where join_match.created_by = '$userid' and  ps4_match.open_date >= NOW() and join_match.team_id ='$teamid'");
                               while($r=mysql_fetch_assoc($res))
                                  {    
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
                                                <td>
                                                 <?php
                                                    if($r['platform']== PS4) 
                                                    {
                                                      echo '<img src="assets/images/playstation final.png" width="20" class="img-responsive" alt="" style="display:inline;" />';
                                                    }
                                                    else
                                                    {
                                                       echo '<img src="assets/images/xb1_list.jpg" width="20" class="img-responsive" alt="" style="display:inline;"/>';      
                                                    }
                                                  ?>
                                                </td>
                                                <td><a href="matchdetails.php?Matchid=<?php echo $r[match_id] ?>">Match Details</a></td>
                                                 
                                           </tr>
                                         <?php    }
                                ?>
                                        
                            </tbody>
                        </table>

                    </div>
                   
                </div>
                
            </div>
        </div><!--row end-->
    </div>
                <?php          
                   $invite = mysql_query("Select * from team where created_by = $userid ");
                   $result = mysql_fetch_array($invite);

                   if($result[created_by] == $userid)
                   {
                ?>
                 <div class="row">
                    <div class="col-sm-12">
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
          <?php } ?>

                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
        </div>
            </div>
                        <div>
                               <div class="row">
                                  <div>
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
                       <!-- <li><a href="Teamdetails.php?teamid=<?php  //echo $teamid; ?>&action=DisableHere">Disable Team</a><li>-->
                        <li><a href="Editteam.php?teamid=<?php echo $teamid; ?>">Edit Team</a></li>
                        <!--<li><a href="allmatch.php">All Matches</a></li>-->  
                        
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