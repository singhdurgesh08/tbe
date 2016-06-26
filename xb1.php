<?php
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";
include "nav.php";
include "config.php";
?>
<div class="home_tab_section">
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1><br class="hidden-xs">XB1 Match</h1>
        </div>
    </div>
    
    
               <div class="row">
                   <div class="col-sm-4">
                       <img src="<?php echo HOSTNAME; ?>assets/images/xbox one 2k.jpg" class="img-responsive" alt="" >
                   </div>
                   <div class="col-sm-3">
                       <p></p>
                   </div>
                   <div class="col-sm-3">
                        <br/>
                         <br/>
                       <a href="AddTeam.php" class="btn btn-lg btn-block btn-success"> Create Team </a> 
                       <br/>
                       <a href="xb1matchlist.php" class="btn btn-lg btn-block btn-success"> Match Finder </a> 
                       <br/>
                       <a href="Addmatches.php?matchtype=XB1" class="btn btn-lg btn-block btn-success"> Post a Match</a> 
                   </div>
                   
                 
         </div>

    <div class="row">
        <div class="col-sm-8">
            
        </div>
    </div>



</div>

</div>




<?php
include "footer.php";
?>

