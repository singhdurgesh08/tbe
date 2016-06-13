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
						<h1> PS4 Matchs</h1>
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
									<th>Match Time</th>
									<th>Match Name</th>
									<th>Game Mode</th>
									<th>Amount ($)</th>
									<th>Action</th>
									
									</tr>
									</thead>
 									
 							 <tbody>
 							<?php
							  if($des=="")
							         { 
							             $res=mysql_query("Select * from ps4_match where platform ='PS4'");
							         }  $i =1;
						  		 while($r=mysql_fetch_array($res))
						        { ?>
								<tr>
								<td><?php  echo date("d-M-Y h:i:s A", strtotime($r['open_date'])).'&nbsp; To &nbsp;'.date("d-M-Y h:i:s A", strtotime($r['close_date'])); ?></td>
								<td><img src="assets/images/ps4_list.jpg" width="40" class="img-responsive" alt="" style="display:inline;" /><?php echo $r[game_title]; ?></td>
								<td><?php echo $r[platform]; ?></td>
								<td><?php echo $r[amount]; ?></td>
                                                                <td>
                                                                    <?php if($r['match_status']=="2"){   ?>
                                                                    <a href="javascript:void();" class="btn btn-info">Accepted</a>
                                                                    <?php }else {   ?>
                                                                    <a href="javascript:void();" onclick="acceptMatch('<?php echo $r[amount]; ?>','<?php echo $r[id]; ?>');">Accept</a>
                                                                    <?php }   ?>
                                                                    
                                                                          |  
									<a href="matchdetails.php?Matchid=<?php echo $r[0]; ?>"> View Match </a>   | 
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
<div id="join_team" class="modal fade">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Accept Match</h4>
            </div>
            <form method='post' action='join.php' class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="select_team" class="control-label col-sm-6">Select Team</label>
                        <div class="col-sm-6 input"> 
                            <select name="select_team" id="select_team"  class="form-control" required="" >
                                <option value="">Select Team</option>
                                <?php
                                $userid = $_SESSION['user_data']['id'];
                                if ($des == "") {
                                    $res = mysql_query("Select * from team where created_by = '$userid'");
                                } $i = 1;
                                while ($result = mysql_fetch_array($res)) {
                                    ?>
                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['team_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="join_fee" class="control-label col-sm-6">Registration Fee ($)</label>
                        <div class="col-sm-6 input"> 
                            <input type='text' readonly='readonly' class="form-control" required="" name='claim_title' id='claim_title' value='0'/>
                        </div>
                    </div>
                    <input type="hidden" name='matchid' id='matchid' value=''/>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
                        <div class="col-sm-2 input text-center">
                            <button class="btn btn-primary" type="submit" name="submit" value="Join">Save</button>
                        </div>
                        <div class="col-sm-2 input text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
<script>
$(document).ready(function() {
$('#example').DataTable();
//$("#join_team").modal("show");
} );
function acceptMatch(str,id){
    $("#join_team").modal("show");
    $("#claim_title").val(str);
    $("#matchid").val(id);

}
</script>

<?php
	
    

?>



<?php
include "footer.php";
?>