<?php 
 session_start();
 if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>
<div class="home_tab_section">
<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1>Tournaments</h1>
					</div>
				</div>
                  <div class="row">
					<div class="col-sm-12">
						<P>
						    Here we are going to offer a option where your favorite Youtubers,Streamers, and competive players can host their own Tournaments. Any Suggestions to add to this section 
							Please Tweet us at @TBESportsGaming on Twitter as we made this for you to have a better experience for you guys. 
							Please Give us some time to implement this to the community.  This will only be for Diamond members only who are allowed to participate.
					   </P>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<P>
						   <img src="assets/images/NY.jpg" class="img-responsive" alt="" style="display:inline; " />
					   </P>
					</div>
				</div>



		    	
			</div>
		</div>

<script>
$(document).ready(function() {
$('#example').DataTable();
} );
</script>



<?php
include "footer.php";
?>