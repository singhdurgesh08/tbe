<?php  ob_start();
    session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
$userid = $_SESSION['user_data']['id'];
include "login-header.php";

include "nav.php"; 
include "config.php"; 
include "common.php"; 
if ((isset($_GET['matchid']) && is_numeric($_GET['matchid'])) && $_GET['action'] == "cancle") {
    $ids = $_GET['matchid'];
    cancleMatch($ids);
    header("location:xb1matchlist.php");
    exit();
}
?>
<div class="home_tab_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 text-center">
                <h1>XB1 Matchs</h1>
            </div>

            <div class="col-sm-2 text-center">
                <a href="Addmatches.php?matchtype=XB1" class="btn btn-lg btn-block btn-success"> Post Matches </a> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Match Time</th>
                            <th>Best out of</th>
                            <th>Game Mode</th>
                            <th>Amount ($)</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php
                          $is_admin = $_SESSION['user_data']['is_admin'];
                          //var_dump($is_admin);die();
                        if ($des == "") {
                            $res = mysql_query("Select * from ps4_match where platform ='XB1'");
                        } $i = 1;
                        while ($r = mysql_fetch_array($res)) { 
                            if(strtotime($r['open_date']) < strtotime(date("d-M-Y h:i:s A"))  || $r['match_status'] =="2") {  continue; } 
                            ?>
                            <tr>
                                <td>
                                    <!--<?php //echo date("d-M-Y h:i:s A", strtotime($r['open_date'])) . '&nbsp; To &nbsp;' . date("d-M-Y h:i:s A", strtotime($r['close_date'])); ?>-->
                                        <?php  echo date("d-M-Y", strtotime($r['open_date']));?><br>
                                        <?php  echo date("h:i:s A", strtotime($r['open_date']))?>
                                </td>
                               
                                <td>
                                 <!--   <img src="assets/images/xb1_list.jpg" width="30" class="img-responsive" alt="" style="display:inline;" /><?php //echo $r[game_title]; ?>-->
                                 1
                                </td>
                                <td><?php echo $r[platform]; ?></td>
                                <td><?php echo $r[amount]; ?></td>
                                <td>
                                   
                                        <?php if($r['match_status']=="2"){   ?>
                                                    <a href="javascript:void();" class="btn btn-info">Accepted</a>
                                                    <?php }else {   ?>
                                                    <a href="javascript:void();" onclick="acceptMatch('<?php echo $r[amount]; ?>','<?php echo $r[id]; ?>');">Accept</a>
                                                     <?php }   ?>
                                    
                                    <!--<a href="matchdetails.php?Matchid=<?php //echo $r[0]; ?>"> View Match </a>   | -->
                                    
                                     <?php 
                                   if ($is_admin == "1" || $r['created_by'] ==$userid) {
                                        echo ('| <a href=xb1matchlist.php?action=cancle&matchid='. $r['id'] . '>Delete</a>');

                                    }
                                 
                                  ?>
                            </tr>

                        <?php }
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
            <form  id="accept_match_xb1" name="accept_match_xb1"  class="form-horizontal" method='post'>
                <div class="modal-body">
                    <div id="div_wait"></div>
                    <div class="form-group">
                        <label for="select_team" class="control-label col-sm-6">Select Team</label>
                        <div class="col-sm-6 input"> 
                            <select name="select_team" id="select_team"  class="form-control" required="" >
                                <option value="">Select Team</option>
                                <?php
                                $userid = $_SESSION['user_data']['id'];
                                if ($des == "") {
                                    $res = mysql_query("Select * from team where created_by = '$userid' and platform ='XB1'");
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
                            <button class="btn btn-primary" type="submit" name="submit" value="Join" onclick="joinMatch();">Save</button>
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
    //$(document).ready(function() {
      //  $('#example').DataTable();
    //});
    function acceptMatch(str,id){
    $("#join_team").modal("show");
    $("#claim_title").val(str);
    $("#matchid").val(id);

}
function joinMatch(){
   $('#accept_match_xb1').validate({
      submitHandler: function(form) {
               $.ajax({
                    url: "ajax_file.php?action=accept_match&user_id=<?php echo $userid; ?>",
                    type: "post",
                    data: $("#accept_match_xb1").serialize(),
                     beforeSend: function(d) {
                      $("#div_wait").html("Please wait we Accepting match .....");
                     },
                     success: function(d) {
                      if(d ==='error'){
                         $("#div_wait").html('<b  style="background-color:red;color:white;"> Sorry ! You have No credit Please add credit from Wallet .</b> ');
                     }else if(d ==='error1'){
                         $("#div_wait").html('<b  style="background-color:red;color:white;"> Sorry ! Please Update GamerTag from profile .</b> ');
                      }else if(d ==='error2'){
                         $("#div_wait").html('<b  style="background-color:red;color:white;">  Sorry ! You can not Accept your Match .</b> '); 
                      }else if(d ==='error3'){
                        $("#div_wait").html('<b  style="background-color:red;color:white;"> Sorry ! Match Already Accepted .</b> '); 
                      }else {
                        window.location.href =' <?php echo HOSTNAME; ?>matchdetails.php?Matchid='+d; 
                      }
                    }         
                     
                });              
        }
    }); 
    
}
</script>

<?php ?>



<?php
include "footer.php";
?>