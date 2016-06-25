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
                                    <label for="Platform" class="control-label col-sm-6">Match</label>
                                    <div class="col-sm-6 input"> 
                                             <select name="Platform" id="Platform" class="form-control" required="">
                                             <option>Please select Match</option>
                                              <option>
                                                        <?php 
                                                            $query =mysql_query("select id,game_title from ps4_match");
                                                            while($r = mysql_fetch_array($query))
                                                            {
                                                               echo '<option value="'.$r["id"].'">'.$r["game_title"].'( Match Id - '.$r["id"].')</option>';
                                                            } 
                                                        ?>
                                              </option>
                                           </select>
                                            </div>
                                </div>

                            <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Name</label>
                                    <div class="col-sm-6 input"><input name='name'  placeholder="Please Enter Team Name"  class="form-control" required=""></div>
                                </div>


                                 <div class="form-group">
                                    <label for="Platform" class="control-label col-sm-6">Ticket Type</label>
                                    <div class="col-sm-6 input"> 
                                             <select name="type" id="type" class="form-control" required="">
                                             <option>Please select Ticket Type</option>
                                              <option>Match Dispute </option>
                                               <option>Ticket Dispute</option>
                                           </select>
                                            </div>
                                </div>

                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL1</label>
                                    <div class="col-sm-6 input"><input name='URL1'  placeholder="Please Enter URL1"  class="form-control" required=""></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL2</label>
                                    <div class="col-sm-6 input"><input name='URL2'  placeholder="Please Enter URL2"  class="form-control" required=""></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL3</label>
                                    <div class="col-sm-6 input"><input name='URL3'  placeholder="Please Enter URL3"  class="form-control" required=""></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL4</label>
                                    <div class="col-sm-6 input"><input name='URL4'  placeholder="Please Enter URL4"  class="form-control" required=""></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL5</label>
                                    <div class="col-sm-6 input"><input name='URL5'  placeholder="Please Enter URL5"  class="form-control" required=""></div>
                                </div>
                                 <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">URL6</label>
                                    <div class="col-sm-6 input"><input name='URL6'  placeholder="Please Enter URL6"  class="form-control" required=""></div>
                                </div>
               
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Description</label>
                                    <div class="col-sm-6 input"><textarea name='Description' style="width: 360px; height: 50px;" placeholder="Enter Description" required=""></textarea></div>
                                </div>

                            </fieldset>

                    <div class="form-group">
                        <label for="" class="control-label col-sm-7 back hidden-xs">&nbsp;</label>
                        

                            <div class="col-sm-2 input text-center">

                                <button class="btn btn-lg btn-block btn-success" type="submit" name="submit" value="submit">Save<i class="glyphicon glyphicon-chevron-right"></i></button>
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

    $name = $_POST['name'];
    $type = $_POST['type'];
    $Description = $_POST['Description'];
    $Platform = $_POST['Platform'];
    $userid = $_SESSION['user_data']['id'];

    $URL1 = $_POST['URL1'];
    $URL2 = $_POST['URL2'];
    $URL3 = $_POST['URL3'];
    $URL4 = $_POST['URL4'];
    $URL5 = $_POST['URL5'];
    $URL6 = $_POST['URL6'];
   
  
   
   // $query= "INSERT INTO `ticket` (`id`, `name`, `description`, `created_by`, `ticket_status`,`created_date`,`match_id` ) VALUES (NULL, '$name', '$Description', '$userid' ,'1', CURRENT_TIMESTAMP,'$Platform')";

     $query= "INSERT INTO `ticket` (`id`, `name`, `ticket_type`, `description`, `created_by`, `ticket_status`, `created_date`, `match_id`, `url1`, `url2`, `url3`, `url4`, `url5`, `url6`) VALUES (NULL, '$name', '$type' ,'$Description', '$userid', '1', CURRENT_TIMESTAMP, '3', '$URL1', '$URL2', '$URL4', '$URL4', '$URL5', '$URL6')";

    if (mysql_query($query)) 
    {
        echo"<script>alert('Created ticket successfullly')</script>";
    }
}
?>


<?php
include "footer.php";
?>