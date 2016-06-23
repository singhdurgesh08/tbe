<?php 
 session_start();
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>

<div class="">
		<div class="container">
			<div class="col-sm-12 text-center"><h3>Membership</h3></div>
			<div class="col-sm-12 home_price_seection">
				<div class="col-md-6 text-center home_price_box">
					<div class="home_price_title">
						<div>FREE</div>
						<div class="home_price_amount">$0</div>
						<div>
							<ul class="home_price_list">
								<li>You will get 25 Percent earnings</li>
								
							</ul>
						</div>
					</div>
				</div>
				
				<div class="col-md-6 text-center home_price_box">
					<div class="home_price_title">
						<div>Diamond membership</div>
						<div class="home_price_amount">$9.99</div>
						<div>
							<ul class="home_price_list">
								<li>Keep all earnings</li>
								<li>Faster response</li>
								<li>Custom profile</li>
								<li>Challenge teams</li>
								<li>Instand teams disband</li>
								<li>Username changes</li>
								<li>Premun support</li>
							</ul>
                                                    <form id="add_wallet" name="add_wallet" action="subscribe_dimond_membership.php" method="post">

				                    <input type="hidden" id="add_amount" name="add_amount"  value="9.99"/>
					
						    <input type="submit" name="add" value="Subscribe Membership" class="btn btn-lg btn-block btn-success"/> 
					
				                     </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php

if (isset($_POST['Team_details'])) 
	{
		 
	}
if (isset($_POST['Delete'])) 
	{
		//Delete also remains.		
	}
?>



<?php
include "footer.php";
?>