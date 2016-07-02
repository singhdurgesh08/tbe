<?php 
 session_start();
  if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>
<script>

  $(document).ready(function(){
    $("#createticket").validate();
  });
</script>


<div class="home_tab_section">
<div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1><br class="hidden-xs">Create Ticket</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                            <form method='post' id="createticket" class="form-horizontal">
                            <fieldset>
                            
                            <div class="form-group">
                                    <label for="Platform" class="control-label col-sm-6">Category</label>
                                    <div class="col-sm-6 input"> 
                                             <select name="category" id="category" class="form-control" required="">
                                             <option value="">Please select category</option>
                                              <option value="Match dispute">Match dispute</option>
                                              <option value="Ticket">Ticket</option>
                                           </select>
                                            </div>
                                </div>

                                  <div class="form-group">
                                    <label for="Platform" class="control-label col-sm-6">Team </label>
                                    <div class="col-sm-6 input"> 
                                             <select name="team" id="team" class="form-control" required="">
                                             <option  value=""> select Team</option>
                                             <?php 
                                                    $query=mysql_query("select team_name from team where created_by = $userid");
                                                    while($r=mysql_fetch_assoc($query))
                                                    {
                                                      $tname=$r["team_name"];
                                                      echo "<option>$tname</option>";
                                                    }
                                             
                                             ?> 
                                     
                                           </select>
                                            </div>
                                </div>
                                 <div class="form-group">
                                    <label for="Platform" class="control-label col-sm-6">Match Id</label>
                                    <div class="col-sm-6 input"> 
                                            <select name="mid" id="mid" class="form-control" required="">
                                             <option  value=""> select Team</option>
                                             <?php 
                                                    $query=mysql_query("select id from ps4_match where created_by = $userid");
                                                    while($r=mysql_fetch_assoc($query))
                                                    {
                                                      $mid=$r["id"];
                                                      echo "<option>$mid</option>";
                                                    }
                                             
                                             ?> 
                                     
                                           </select>
                                            </div>
                                </div>

                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL1</label>
                                    <div class="col-sm-6 input"><input name='URL1'  placeholder="Please Enter URL1"  class="form-control" required=""></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL2</label>
                                    <div class="col-sm-6 input"><input name='URL2'  placeholder="Please Enter URL2"  class="form-control"></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL3</label>
                                    <div class="col-sm-6 input"><input name='URL3'  placeholder="Please Enter URL3"  class="form-control"></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL4</label>
                                    <div class="col-sm-6 input"><input name='URL4'  placeholder="Please Enter URL4"  class="form-control"></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL5</label>
                                    <div class="col-sm-6 input"><input name='URL5'  placeholder="Please Enter URL5"  class="form-control"></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL6</label>
                                    <div class="col-sm-6 input"><input name='URL6'  placeholder="Please Enter URL6"  class="form-control"></div>
                                </div>
               
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Description</label>
                                    <div class="col-sm-6 input"><textarea name='Description' style="width: 360px; height: 50px;" placeholder="Enter Description" required=""></textarea></div>
                                </div>

                            </fieldset>

                    <div class="form-group">
                        <label for="" class="control-label col-sm-7 back hidden-xs">&nbsp;</label>
                        
                           <div class="col-sm-2 input text-center">
                                 <button   class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="submit">Save<i class="glyphicon glyphicon-chevron-right"></i></button>
                            </div>
                       
                            <div class="col-sm-2 input text-center">
                                <a href="teamlist.php" class="btn btn-lg btn-danger">Cancel<i class="glyphicon glyphicon-chevron-right"></i></a>
                            </div>
                    
                    </div>
             </form>
            </div>
        </div>
</div>
</div>							


<?php

if (isset($_POST['submit'])) {

    $category = $_POST['category'];
    $team = $_POST['team'];
    $Description = $_POST['Description'];
    $mid = $_POST['mid'];
    $userid = $_SESSION['user_data']['id'];

    $URL1 = $_POST['URL1'];
    $URL2 = $_POST['URL2'];
    $URL3 = $_POST['URL3'];
    $URL4 = $_POST['URL4'];
    $URL5 = $_POST['URL5'];
    $URL6 = $_POST['URL6'];


$query ="INSERT INTO `ticket` (`id`, `name`, `ticket_type`, `description`, `created_by`, `ticket_status`, `created_date`, `match_id`, `url1`, `url2`, `url3`, `url4`, `url5`, `url6`) 
VALUES ('NULL', '$team', '$category', '$Description', '$userid', '1', CURRENT_TIMESTAMP, '$mid', '$URL1', '$URL2', '$URL3', '$URL4', '$URL5', '$URL6')";
//mysql_query($query);
   if (mysql_query($query)) 
    {
        //  $yourURL="http://localhost/tbe/ticket.php";
         //$var = "http://$_SERVER[HTTP_HOST]/tbe/"."ticket.php";
         //  echo ("<script>location.href='$var'</script>");
         header("location: ticket.php");
         exit();
    }
}
?>


<?php
include "footer.php";
?>