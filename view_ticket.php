<?php 
include "config.php";
ob_start();
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
 }
include "login-header.php";?>
        <?php include "nav.php";
        $ticketid = $_GET['ticketid'];
        ?>
<div>&nbsp;</div>
<div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1><br class="hidden-xs">View Ticket</h1>
                    </div>
                    
                        <div class="col-sm-12 text-left"><span class="pull-right">
                            <button  class="btn btn-lg btn-block btn-success" type="button"  onclick="window.location.href='ticket.php'">Go Back!</button></span>
                         </div>
                    
                </div>
                <div>
                    &nbsp;
                </div>
                 <?php
                    $res=mysql_query("Select * from ticket where id= $ticketid");
                    $r=mysql_fetch_array($res);
                  
                ?>
                <div class="row">
                    <div class="col-sm-9">
                        <form method='post' id="viewticket"  action='view_ticket.php?ticketid=<?php echo $r[id] ?>' class="form-horizontal">
                        <fieldset>
                                <div class="form-group">
                                    <label for="login_password" class="col-sm-6 text-right">Ticket ID:</label>
                                    <div class="col-sm-6 input"><?php echo $r[id];  ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="col-sm-6 text-right">Categery: </label>
                                    <div class="col-sm-6 input">
                                    <?php 
                                        if($r['ticket_type']==0){ echo "Ticket";
                                         }else{ echo "Match dispute";} ?>
                                </div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="col-sm-6 text-right">Date Submitted: </label>
                                    <div class="col-sm-6 input"><?php 
                                     echo date("Y-m-d",strtotime($r['created_date'])) . " EST ".date("h:i A",strtotime($r['created_date']));?>
                                   </div>
                                </div>
                                <?php

                                ?>
                                 <div class="form-group">
                                    <label for="login_password" class="col-sm-6 text-right">Match id:</label>
                                    <div class="col-sm-6 input"><a href="matchdetails.php?Matchid=<?php echo $r[match_id];?>"><?php echo $r[match_id];?></a></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="col-sm-6 text-right">Team:</label>
                                    <div class="col-sm-6 input"> <?php echo $r[name];  ?></div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="login_password" class="col-sm-6 text-right">Description:</label>
                                    <div class="col-sm-6 input"><?php echo $r[description];  ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="col-sm-6 text-right">Responses:</label>
                                </div>
                                 
                                  <div class="form-group"> 
                                    <label for="login_password" class="col-sm-6 text-right"></label>
                                     <div class="col-sm-6 input">
                                            <?php 
                                                 $res=mysql_query("Select ticket_response.id,ticket_response.ticket_id,ticket_response.user_id,
                                                                    ticket_response.response,ticket_response.created_by,ticket_response.created_date,
                                                                    users.id,users.user_image,users.user_name 
                                                                    from ticket_response 
                                                                    left join users on 
                                                                    users.id = ticket_response.user_id
                                                                    where ticket_response.ticket_id  = $ticketid;");
                                                 while ($r=mysql_fetch_array($res))
                                                 {
                                                    ?> 
                                                     <div class="col-sm-3">
                                                       <?php        
                                                            $finalimage =  $r['user_image'];
                                                              if($finalimage) {  ?>
                                                                    <img src="<?php echo HOSTNAME; ?>upload/<?php echo $finalimage;?>" class="img-circle" width="70" heigh="60" class="img-responsive" alt="" />
                                                              <?php } else { ?>
                                                               <img src="assets\images\profile-1.png" class="img-responsive"  class="img-circle" width="70" heigh="60" alt="" >
                                                               <?php }  ?>
                                                        </div>
                                                              <a href="myprofile.php?usersid=<?php echo $r[id];?>"><b><u><?php echo $r[user_name]; ?></u></b></a><BR/>
                                                              <?php
                                                                echo $r[response];?><br/><?php
                                                                echo date("Y-m-d",strtotime($r['created_date'])) . " EST ".date("h:i A",strtotime($r['created_date']));?><br/><br/><hr> <?php
                                                              } ?>
                                                </div>
                                </div>
                           <!-- <?php 
                                    $res=mysql_query("Select response from ticket_response where ticket_id = $ticketid");
                                    $count =0;
                                    while ($r=mysql_fetch_array($res)) {
                                        $var = $r[response] ;
                                ?>
                                 <div class="form-group">
                                    <label for="login_password" class="col-sm-6 text-right">Response<?php echo ++$count; ?>:</label>
                                    <div class="col-sm-6 input"><?php echo $var ?></div>
                                </div>
                             <?php   } ?>
                            -->

                                <div class="form-group">
                                    <label for="comment" class="col-sm-6 text-right">Reply:</label>
                                    <div class="col-sm-6 input"><textarea for="reply" name='postreply' value="<?php echo $r['postreply']; ?>" id="postreply"  placeholder="Reply to Ticket"  class="form-control email" required="" ></textarea></div>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
                                    <div class="col-sm-6 input text-center">
                                    <button class="btn btn-lg btn-block btn-success" type="submit" name="Update" id="submit">Post Reply<i class="glyphicon glyphicon-chevron-right"></i></button>
                               
                                </div>
                            </div>
                        </fieldset>
                </form>
                </div>
                </div>
</div>
<?php include "footer.php";?>
<?php
include "config.php";

if(isset($_POST['Update']))
                {
                                     
                     $response = $_POST['postreply'];
                     $query ="INSERT INTO `ticket_response` (`id`, `ticket_id`, `user_id`, `response`, `created_by`,`created_date`) VALUES (NULL, '$ticketid', '$userid', '$response', '$userid',now())"; 
                      if(mysql_query($query))
                      {
                             ob_start();
                             header("location:view_ticket.php?ticketid=$ticketid");
                             exit();
                      }
        }
?>



