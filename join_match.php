<?php
session_start();
 if($_SESSION['user_data']['user_name'] ==''){
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
        <div class="col-md-9">
            <div class="jumbotron">
               <div class="row">
                   <div class="col-sm-3">
                       <img src="http://localhost/Dproject/assets/images/PS4.jpg" class="img-responsive" alt="" style="width: 150px;">
                   </div>
					<div>
					<label for="login_email" class="control-label col-sm-50"><h3>Join Match</h3></label>
					<div class="col-sm-4 input"></div>
								

                </div>
             </div> 
         </div>
      </div>
 </div>                 
</div>
<?php include "footer.php"?>




