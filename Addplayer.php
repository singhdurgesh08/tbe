
<?php 
 session_start();
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php";
$teamid = $_GET['teamid'];

if ($_GET['action'] =='add') 
	{  //echo "11"; die;
		$id = $_GET['id'];

		$userid = $_SESSION['user_data']['id'];
		
		$check="select * from team_list where user_id = '$id' AND team_id = $teamid";
		
		$result = mysql_query($check);
		if ( mysql_num_rows ( $result ) > 0 )
				{
				       echo "<script>alert('Player already exists in your team')</script>";
				}
			else
				{
				   $sql_query ="INSERT INTO `team_list` (`user_id`, `team_id`, `join_date`, `created_by`,`player_status`) VALUES ('$id', '$teamid',now(),'$userid',1)";
				   mysql_query($sql_query);
				   echo "<script>alert('Player added successfully in your team')</script>";
				}
	}

 ?>
<div class="home_tab_section">
<div class="container">
				<div class="row">
					<div class="col-sm-4 text-center">
						<h1>Player List</h1>
					</div>
					<div class="col-sm-3 text-center">
						<h1></h1>
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
							                 <td><?php echo $r[0]; ?> </td>
							                 <td><?php echo $r[3];?> </td>
							                 <td><?php echo $r[4]; ?> </td>
								                <td>
                   									<a href="Addplayer.php?teamid=<?php echo $teamid; ?>&id=<?php echo $r[0];?>&action=add">Click Here To ADD In Team </a>
						                 	   </td>
							                 </tr>

							       <?php  }
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
include "footer.php";
?>

<?php

if (isset($_GET['submit'])) 
	{
		$keywords = isset($_GET['keywords']) ? '%'.$_GET['keywords'].'%' : '';
		$result = mysql_query("SELECT user_name FROM users where user_name like '$keywords'");
		while ($row = mysql_fetch_assoc($result))
		{
    		echo "<div id='submit' onClick='addText(\"".$row['user_name']."\");'>" . $row['user_name'] . "</div>";  
		}
	}




?>
