<?php
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login");
    exit();
}

//var_dump($platform);die();

include "login-header.php";
include "nav.php";
include "config.php";
?>
<div class="home_tab_section">
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1><br class="hidden-xs">PS4 Match</h1>
        </div>
    </div>
    
    
               <div class="row">
                   <div class="col-sm-4">
                       <img src="<?php echo HOSTNAME; ?>assets/images/PS4.jpg" class="img-responsive" alt="" >
                   </div>
                   <div class="col-sm-3">
                       <p></p>
                   </div>
                   <div class="col-sm-3">
                        <br/>
                         <br/>
                       <a href="AddTeam?platform=PS4" class="btn btn-lg btn-block btn-success"> Create Team </a> 
                       <br/>
                       <a href="Matchlist" class="btn btn-lg btn-block btn-success"> Match Finder </a> 
                       <br/>
                       <a href="Addmatches?matchtype=PS4" class="btn btn-lg btn-block btn-success"> Post a Match </a> 
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