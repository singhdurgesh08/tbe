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
					<div class="col-sm-4 text-center">
						<h1>Top 50Goals List</h1>
					</div>
					<div class="col-sm-6 text-center">
						 <h1></h1>
					</div>
					<div class="col-sm-2 text-center">
<!--						 <a href="#" class="btn btn-lg btn-block btn-success"> Add Top50 </a> -->
					</div>
				</div>

				


				<div class="row">
					<div class="col-sm-12">
                          

                              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
									<tr>
                                                                            <th>ID</th>
                                                                            <th>User Name</th>
                                                                            <th>User Email</th>
                                                                            <th>Action</th>
									</tr>
									</thead>
 									
 							 <tbody>
 							<?php
							  if($des=="")
							         { 
							             $res=mysql_query("Select * from users");
							         }
							         while($r=mysql_fetch_row($res))
							         { ?>
							                <tr>
							                 <td><?php echo $r[0];?></td>
							                 <td><?php echo $r[1];?></td>
							                 <td><?php echo $r[2];?></td>
								                <td>
                   							<a href="#">Delete </a>
						                 	   </td>
							                 </tr>

							       <?php  }
						?>
							</tbody>
			     		</table>
		    	
			</div>
		</div>
</div>
							

<script>
$(document).ready(function() {
$('#example').DataTable();
} );
</script>
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