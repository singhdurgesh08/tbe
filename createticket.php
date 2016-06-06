<?php 
 session_start();
  if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>

<div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1><br class="hidden-xs">Create Team</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                            <form method='post' class="form-horizontal">
                            <fieldset>
                            <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Name</label>
                                    <div class="col-sm-6 input"><input name='name'  placeholder="Please Enter Team Name"  class="form-control" required=""></div>
                                </div>
               

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Description</label>
                                    <div class="col-sm-6 input"><textarea name='Description' style="width: 360px; height: 50px;" placeholder="Enter Description"></textarea></div>
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
							

</body>
</html>

<?php

if (isset($_POST['submit'])) {

    //echo "kkdjlaj";die();
    $name = $_POST['name'];
    $Description = $_POST['Description'];
    $userid = $_SESSION['user_data']['id'];
    //var_dump($userid);die();
   
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