<?php
session_start();
include "login-header.php";
include "nav.php";
include "config.php";
$matid = $_GET['Matchid'];
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
<?php
$res = mysql_query("Select * from ps4_match where id= $matid");
$r = mysql_fetch_array($res);
//echo "<pre>"; print_r($r);
?>
<div class="home_tab_section">
<div class="container">
    <div class="row">

        <!--/span-->
        <div class="col-md-9">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2>  Match Detail</h2>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <?php if ($r['platform'] == 'XB1') { ?>
                            <img src="<?php echo HOSTNAME; ?>assets/images/xbox one 2k.jpg" class="img-responsive" alt="" >
                        <?php } else { ?>
                            <img src="<?php echo HOSTNAME; ?>assets/images/PS4.jpg" class="img-responsive" alt="" />
                        <?php } ?>
                    </div>
                    <div class="col-sm-7">
                        <br/> <br/> <br/> <br/> 
                        <div class="row">
                            <div class="col-sm-6">
                                <b> ID  :- </b> 000000<?php echo $r[0]; ?><br>
                            </div> 
                            <div class="col-sm-6">
                                <b> Game Title:- </b> <?php echo $r[1]; ?><br>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <b> Game Mode  :- </b> <?php echo $r[2]; ?><br>
                            </div> 
                            <div class="col-sm-6">
                                <b> Start Date Time :- </b><?php echo date("d-M-Y h:i:s A", strtotime($r['open_date'])); ?><br>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <b> Close Date Time:- </b> <?php echo date("d-M-Y h:i:s A", strtotime($r['close_date'])) ?><br>
                            </div> 
                            <div class="col-sm-6">
                                <b> Platform :- </b><?php echo $r['platform'] ; ?><br>
                            </div> 
                        </div>
                             



                    </div>


                </div>
                 <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2>  &nbsp;</h2>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2>  Team</h2>
                      
                        
                
                    </div>

                </div>
                
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <?php 
                $resquery = mysql_query("Select * from join_match  left join users on join_match.created_by = users.id where match_id= '$matid' and opponent_id = '0'");
                $detail  = mysql_fetch_array($resquery);
                echo "<pre>"; 
                echo "<h2>  Team A</h2>";
                echo $detail['user_name']."<br/>";
                echo $detail['user_email']."<br/>";
                //print_r($detail);
              ?>  
                        
                    </div>
                    
                    <div class="col-sm-4 text-center">
                       <?php 
               
                        echo "<pre>"; 
                        echo "<br/>";
                        echo "<br/>";
                        echo "<h2>V/S</h2>";
                        echo "<br/>";
               
                      ?>  
                    </div>
                    <div class="col-sm-4 text-center">
                        <?php 
                $resquery1 = mysql_query("Select * from join_match  left join users on join_match.created_by = users.id where match_id= '$matid' and opponent_id = '1'");
                $detail1  = mysql_fetch_array($resquery1);
                echo "<pre>"; 
                echo "<h2>  Team B</h2>";
                echo $detail1['user_name']."<br/>";
                echo $detail1['user_email']."<br/>";
                 echo "<br/>";
                //print_r($detail);
              ?>  
                    </div>

                </div>
             <?php 
//             $query = mysql_query("select team.id,team.team_name,team.platform,game_mode from join_match left join team on team.id = join_match.team_id where join_match.match_id = $matid");
//             $result = mysql_fetch_array($query);
//             echo "<pre>"; print_r($result);
             ?>
                <div class="row">
                    <div class="col-sm-12">

                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<!--                            <caption class="text-center"> <h3>Join Team</h3></caption>  -->
                            <thead class="thead-inverse">
                                <tr>
                                   
<!--                                    <th>Team Name</th>-->
                                </tr>
                            </thead>

<!--                            <tbody>
                           <?php
                                
                                $i = 1;
                                while ($result = mysql_fetch_array($query)) { // echo "<pre>"; print_r($r);
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><a href="Teamdetails.php?teamid="<?php echo $result['id']; ?>><?php echo $result['team_name']; ?></a></td>
                                    </tr>

                                <?php } ?>
                            </tbody>-->
                        </table>


                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    &nbsp;
                </div>

            </div>

        </div>
        <!--/span-->
        <div class="col-md-3">
            <div class="sidebar-nav-fixed pull-right">
                <div class="well">
                    <ul class="nav ">
                        <li class="nav-header"></li>
                        
                        <li><a href="javascript:void();" data-toggle="modal" data-target="#report_match">Report Match</a></li>
                        <li><a href="Ticket.php">Dispute</a></li>
                        <li><a href="javascript:void();" data-toggle="modal" data-target="#claim_money">Claim Money</a></li>
                    </ul>
                </div>
                <!--/.well -->
            </div>
            <!--/sidebar-nav-fixed -->
        </div>
        <!--/span-->

    </div>
</div>
<!--/row-->


</div>


<div id="report_match" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Report Match</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <b> Match ID  : </b> 000000<?php echo $r[0]; ?><br>
                    </div> 
                    <div class="col-sm-6">
                        <b> Match Title: </b> <?php echo $r[1]; ?><br>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <b> Winner  : Not Decide<br>
                    </div> 
                    <div class="col-sm-6">
                        <b>Prize: </b> <?php echo $r[8]; ?><br>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <b> Match Detail  : Not Decide<br>
                    </div> 
                  </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div id="match_status" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Match Status</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                    <div class="col-sm-12">
                        <b> Status   : </b> Not Started<br>
                       
                    </div> 
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="dispute" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Dispute</h4>
            </div>
            <div class="modal-body">
                <table id="disputelist" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <caption class="text-center"> <h3>Dispute List</h3></caption>  
                    <thead class="thead-inverse">
                        <tr>
                            <th>Id</th>
                            <th>Match</th>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                    </thead>

                    <tbody>
                           <tr>
                            <td colspan='4'>No Dispute found</td>
                           
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div id="claim_money" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Claim Money</h4>
            </div>
            <form method='post' action='claim.php' class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="claim_title" class="control-label col-sm-6">Title</label>
                        <div class="col-sm-6 input"> 
                            <input type='text' class="form-control" required="" name='claim_title' id='claim_title'/>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="claim_amount" class="control-label col-sm-6">Amount</label>
                        <div class="col-sm-6 input"> 
                            <input type='text' class="form-control" required="" name='claim_amount' id='claim_amount'/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select_team" class="control-label col-sm-6">Description</label>
                        <div class="col-sm-6 input"> 
                            <textarea class="form-control" required="" name='claim_des' id='claim_des'> </textarea>
                        </div>
                    </div>
                    <input type="hidden" name='matchid' id='matchid' value='<?php echo $matid; ?>'/>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
                        <div class="col-sm-2 input text-center">
                            <button class="btn btn-primary" type="submit" name="submit" value="Add Claim">Add Claim</button>
                        </div>
                        <div class="col-sm-2 input text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    
                    <table id="disputelist" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <caption class="text-center"> <h3>Claim List</h3></caption>  
                    <thead class="thead-inverse">
                        <tr>
                            <th>Id</th>
                            <th>Amount</th>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                    </thead>

                    <tbody>
                           <tr>
                            <td colspan='4'>No Claim found</td>
                           
                        </tr>
                    </tbody>
                </table>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<?php
include "footer.php";
?>


<!--/.fluid-container-->