<?php  ob_start();
    session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login");
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
    header("location:xb1matchlist");
    exit();
}
?>
<div class="home_tab_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 text-center">
                <h1>XB1 Match Finder</h1>
            </div>

            <div class="col-sm-2 text-center">
                <a href="Addmatches?matchtype=XB1" class="btn btn-lg btn-block btn-success"> Post a Match </a> 
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
                           // if(strtotime($r['open_date']) < strtotime(date("d-M-Y h:i:s A"))  || $r['match_status'] =="2") {  continue; } 
                            //Match Status 2 Means Match Accepted
                            if($r['match_status'] == "2") {
                               continue;
                            }elseif(strtotime($r['open_date']) < strtotime(date("d-M-Y h:i:s A"))){ //Match date is old Means Match Expire
                                 cancleMatch($r['id']);
                            }else{
                          ?>
                            <tr>
                                <td>
                                     <?php  echo date("Y-m-d",strtotime($r['open_date'])) . " EST ".date("h:i A",strtotime($r['open_date'])); ?>
                                     
                                </td>
                               
                                <td> 1 </td>
                                <td><?php echo $r[game_mode]; ?></td>
                                <td><?php echo $r[amount]; ?></td>
                                <td>
                                   
                                        <?php if($r['match_status']=="2"){   ?>
                                                    <a href="javascript:void();" class="btn btn-info">Accepted</a>
                                                    <?php }else {   ?>
                                                    <a href="javascript:void();" onclick="acceptMatch('<?php echo $r['amount']; ?>','<?php echo $r['id']; ?>','<?php echo $r['game_mode']; ?>','<?php echo $r['platform']; ?>');">Accept</a>
                                                     <?php }   ?>
                                    
                                    <!--<a href="matchdetails.php?Matchid=<?php //echo $r[0]; ?>"> View Match </a>   | -->
                                    
                                     <?php 
                                   if ($is_admin == "1" || $r['created_by'] ==$userid) {
                                        echo ('| <a href=xb1matchlist?action=cancle&matchid='. $r['id'] . '>Cancel</a>');

                                    }
                                 
                                  ?>
                            </tr>

                            <?php }}
                        ?>
                    </tbody>
                </table>


            </div>
        </div>
         <div>
        <?php 
 $userId = $_SESSION['user_data']['id'];
 $user_name = $_SESSION['user_data']['user_name'];
 $finalimage = $_SESSION['user_data']['user_image'];
 if ($finalimage) {
    $image = HOSTNAME . "upload/" . $finalimage;
} else {
    $image = HOSTNAME . "assets/images/profile-1.png";
}
?>

<!-- <script src="http://www.shoutbox.com/chat/chat.js.php"></script>
<script>
    var chat = new Chat(<?php echo $userId;?>,"<?php echo $user_name;?>","<?php echo $image;?>");
    chat.traductions.enterYourTextHere = "Enter your Message ";
</script>
<style>
.shoutBoxContainer {
 height:450px;
}
</style>-->
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
                        <label for="help" class="control-label col-sm-12">You need to select same game mode and  same platform type team</label>
                        
                    </div>
                    <div class="form-group">
                        <label for="select_team" class="control-label col-sm-6">Select your team</label>
                        <div class="col-sm-6 input"> 
                            <select name="select_team" id="select_team"  class="form-control" required="" >
                                <option value="">Select your team</option>
                                <?php
                                $userid = $_SESSION['user_data']['id'];
                                if ($des == "") {
                                    $res = mysql_query("Select * from team where created_by = '$userid' and platform ='XB1' and Status ='1'");
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
                        <div class="col-sm-3 input text-center">
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
    
   function acceptMatch(str,id,gamemode,platform){
     $.getJSON("ajax_file.php?action=updateTeam&user_id=<?php echo $userid; ?>&gamemode="+gamemode+"&platform="+platform, function(result){
        $("#select_team").html(); 
        var options = '';
        options += '<option value="">Select your team"</option>';
        for (var i = 0; i < result.length; i++){
            options += '<option value="' + result[i].id + '">' + result[i].team_name + '</option>';
        }
        $("#select_team").html(options);
            
    });
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
                      $("#div_wait").html("Please wait accepting your match .....");
                     },
                     success: function(d) {
                          var res = d.split(":");
                        if(res['0']==="success"){
                             window.location.href =' <?php echo HOSTNAME; ?>matchdetails?Matchid='+res['1']; 
                        }else{
                             $("#div_wait").html('<b  style="background-color:red;color:white;">' +d+ '</b> ');
                      }
                     
                    }         
                     
                });              
        }
    }); 
    
}

$(document).ready(function() {
$('#example').DataTable();
} );
</script>

<?php ?>



<?php
include "footer.php";
?>