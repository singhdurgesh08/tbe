<?php 
 session_start();
 if($_SESSION['user_data']['user_name'] ==''){
header("location: login.php");
exit();
}
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>
<div class="home_tab_section">
<div class="container">
				<div class="row">
					<div class="col-sm-10 text-center">
						<h1> PS4 Match List</h1>
					</div>
					
					<div class="col-sm-2 text-center">
						 <a href="Addmatches.php" class="btn btn-lg btn-block btn-success"> Add Matches </a> 
					</div>
					
				</div>
			<div class="row">
					<div class="col-sm-12">
		                     <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
									<tr>
									<th>ID</th>
									<th>Match Name</th>
									<th>Action</th>
									</tr>
									</thead>
 									
 							 <tbody>
 							<?php
							  if($des=="")
							         { 
							             $res=mysql_query("Select * from ps4_match where game_mode ='PS4'");
							         }  $i =1;
						  		 while($r=mysql_fetch_array($res))
						        { ?>
								<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $r[1]; ?></td>
								<td> <a href="matchdetails.php?Matchid=<?php echo $r[0]; ?>"> Match Details </a>   | 
								     <a href="javascript:delete_id(<?php echo $r[0]; ?>)">Delete</a>

								     <script type="text/javascript">
										function delete_id(id)
										{
										     if(confirm('Sure To Remove This Record ?'))
										     {
										        window.location.href='matchlist.php?delete_id='+id;
										     }
										}
										</script>

									<?php
										if(isset($_GET['delete_id']))
										{
										    $sql_query="DELETE FROM ps4_match WHERE id=".$_GET['delete_id'];
											mysql_query($sql_query);
										    header("Location: matchlist.php");
										  
										}
										?>
								</tr>
							      
							     <?php    }
							?>
							</tbody>
			     		</table>
		    	
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
	
    

?>



<?php
include "footer.php";
?>