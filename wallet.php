<?php 
 session_start();
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>

<div class="container">
				<div class="row">
					
					<div class="col-sm-12 text-center">
						<h1>Wallet Detail</h1>
					</div>
				</div>

				
               <form id="add_wallet" name="add_wallet" action="add_wallet.php" method="post">

				<div class="row">
					<div class="col-sm-4 text-center">
						<h1>Add Wallet (USD)</h1>
					</div>
					<div class="col-sm-5 text-center">
						 <h1><input type="text" id="add_amount" name="add_amount"  placeholder="Please Enter Amount"/></h1>
					</div>
					<div class="col-sm-2 text-center">
						<input type="submit" name="add" value="Add" class="btn btn-lg btn-block btn-success"/> 
					</div>
					
				</div>
				</form>
				 <form id="add_wallet" name="add_wallet" action="withdrawal_wallet.php" method="post">
				<div class="row">
					<div class="col-sm-4 text-center">
						<h1>withdrawal from Wallet (USD)</h1>
					</div>
					<div class="col-sm-4 text-center">
						 <h1><input type="text" id="email" name="email"  placeholder="Please Enter Paypal Email" /></h1>
					</div>
					<div class="col-sm-4 text-center">
						 <h1><input type="text" id="add_amount" name="add_amount"  placeholder="Please Enter Amount"/></h1> 
					</div>
					
				</div>
				<div class="row">
					<div class="col-sm-4 text-center">
						
					</div>
					
					<div class="col-sm-4 text-center">
						<input type="submit" name="withdrawal" value="withdrawal" class="btn btn-lg btn-block btn-success"/> 
					</div>
					
				</div>
				</form>
				<div class="row">
					<div class="col-sm-4 text-center">
						&nbsp;
					</div>
					<div class="col-sm-4 text-center">
						
					</div>
					<div class="col-sm-4 text-center">
						
					</div>
					
				</div>
				
</div>
							

<div class="container">
	
	
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