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
                        <h1><br class="hidden-xs">Create Team</h1>
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
                                              <option>

                                                <?php 
                                                    $query =mysql_query("select id,game_title from ps4_match");
                                                    while($r = mysql_fetch_array($query))
                                                    {
                                                       // echo "<pre>"; print_r($r);
                                                        
                                                               // $c_id = $r[0];
                                                                echo '<option value="'.$r["id"].'">'.$r["game_title"].'( Match Id - '.$r["id"].')</option>';
                                                        //echo ($r[team_name]);
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
    $Description = $_POST['Description'];
    $userid = $_SESSION['user_data']['id'];
  
   
    $query= "INSERT INTO `ticket` (`id`, `name`, `description`, `created_by`, `created_date`) VALUES (NULL, '$name', '$Description', '$userid' , CURRENT_TIMESTAMP)";

    if (mysql_query($query)) 
    {
        echo"<script>alert('Created ticket successfullly')</script>";
    }
}
?>


<?php
include "footer.php";
?>