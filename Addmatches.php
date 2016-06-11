<?php
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";
include "nav.php";
include "config.php";
?>


<!--        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>-->
        <script src="<?php echo HOSTNAME; ?>assets/js/jquery.timepicker.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo HOSTNAME; ?>assets/css/jquery.timepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo HOSTNAME; ?>assets/css/jquery.datetimepicker.css"/>
        <script src="<?php echo HOSTNAME; ?>assets/build/jquery.datetimepicker.full.js"></script>
        <script>

            $(function() {
               // $("#datepicker").datepicker();
             //   $("#datepicker1").datepicker();
                //$("#timepicker").timepicker();
                $('.some_class').datetimepicker();
            });
        </script>
    


<head>
  <script>

  $(document).ready(function(){
    $("#addmatches").validate();
  });
  </script>
</head>


<style>
.error {color:red;}
</style>

 <div class="home_tab_section">      
<div class="container">

        <div class="row">
            <div class="col-sm-12 text-center">
                <h1><br class="hidden-xs">POST  Match</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <form method='post' action="addmatches.php" id="addmatches" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label for="login_email" class="control-label col-sm-6">Match Name</label>
                            <div class="col-sm-6 input"><input name='Match_Name'  type="text" placeholder="Please Enter Match Name"  class="form-control" required="" ></div>
                        </div>

<!--                          <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Date</label>
                            <div class="col-sm-6 input" >
                            <select name="month" id="month" required="">
                               <option value="">Month</option>
                               <option value="1">January</option>
                               <option value="2">February</option>
                               <option value="3">March</option>
                               <option value="4">April</option>
                               <option value="5">May</option>
                               <option value="6">June</option>
                               <option value="7">July</option>
                               <option value="8">August</option>
                               <option value="9">September</option>
                               <option value="10">October</option>
                               <option value="11">November</option>
                               <option value="12">December</option>

                             </select>
     
                                <select name="day" id="day" required="">
                                   <option value="">Date</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>

                                <select name="year" id="year" required="">
                                    <option value="">Year</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>

                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>


                                </select>
     
    
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Match Time</label>
                            <div class="col-sm-6 input"><input type="text" id="timepicker" name="match_time"  class="form-control" required=""></div>
                        </div>
                  -->
                        <div class="form-group">
                            <label for="match_start_date" class="control-label col-sm-6">Start date & Time</label>
                            <div class="col-sm-6 input"><input type="text" id="timepicker" name="match_start_date"  class="form-control some_class" required=""></div>
                         </div>
                          <div class="form-group">
                            <label for="match_close_date" class="control-label col-sm-6">Close date & Time</label>
                            <div class="col-sm-6 input"><input type="text" id="timepicker" name="match_close_date"  class="form-control some_class" required=""></div>
                         </div>
                          <div class="form-group">
                                <label for="platform" class="control-label col-sm-6">Platform</label>
                                <div class="col-sm-6 input"><select name="platform" id="platform" class="form-control" required="">    
                                        <option value="">Please select Platform</option>
                                        <option value="PS4">PS4</option>
                                        <option value="XB1">XB1</option>

                                    </select></div>
                            </div>

                            <div class="form-group">
                                <label for="login_password" class="control-label col-sm-6">Game Mode</label>
                                <div class="col-sm-6 input">
                                    <select name="Game_Mode" id="Game_mode" class="form-control" required="">
                                        <option value=""> Please select game mode</option>
                                        <option value="1v1 Mycourt">1v1 Mycourt</option>
                                        <option value="2v2 Mycourt">2v2 Mycourt</option>
                                        <option value="3v3 Mycourt">3v3 Mycourt</option>
                                        <option value="Quick Match">Quick Match</option>
                                        <option value="Myteam">Myteam</option>
                                    </select>
                                   
                                </div>
                            </div>

                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Amount</label>
                            <div class="col-sm-6 input"><input type="text" id="amount" name="Amount"  class="form-control" required="" ></div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 input">&nbsp;</div>
                                <div class="col-sm-6 input">
                                    <div>
                                    <center><h3> Select Team</h3></center>
                                </div>
                                </div>
                                
                            </div>
           
                            <div class="row">
                                <div class="col-sm-6 input">&nbsp;</div>
                                <div class="col-sm-6 input">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                               
                                                <th>Match Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $userid = $_SESSION['user_data']['id'];
                                            if ($des == "") {
                                            $res = mysql_query("Select * from team where created_by = '$userid'");
                                            } $i =1;
                                            while ($r = mysql_fetch_array($res)) { // echo "<pre>"; print_r($r);
                                            ?>
                                            <tr>
                                                <td><?php echo $r['team_name']; ?> </td>
                                                <td>
                                                    <input type="radio" name="addteam_id" id="addteam_id" value="<?php echo $r['id']; ?>" selected="selected"/>
                                                </td>
                                            </tr>
                                <?php }
                                ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6 input">&nbsp;</div>
                                <div class="col-sm-6 input">
                                    <div>
                                    <center><a href="javascript:void();" data-toggle="modal" data-target="#match-rule"> Match Rules</a></center>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                   </fieldset>
                   
            </div>
        </div>
              
           
            <div class="row">
                    
                             

                       
                        
                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group">
                            <label for="" class="control-label col-sm-4 back hidden-xs">&nbsp;</label>
                            <div class="col-sm-2 input text-center">

                            <button class="btn btn-lg btn-block btn-success" type="submit" name="Save" value="Save">Save<i class="glyphicon glyphicon-chevron-right"></i></button>
                            </div>
                            <div class="col-sm-2 input text-center">
                            <a href="ps4.php" class="btn btn-lg btn-danger">Cancel<i class="glyphicon glyphicon-chevron-right"></i></a>
                                            
                        </div>
                    </div>
            </div>
        </form>
        </div>
</div>
     
<div id="match-rule" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Rules</h4>
            </div>
             <div class="modal-body">
                <h1> Rules will Coming Soon</h1>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
    <?php
    if (isset($_POST['Save'])) {
       
        $Match_Name = $_POST['Match_Name'];
        //$Date = $_POST['Month'];
        $Game_Mode = $_POST['Game_Mode'];
        $Amount = $_POST['Amount'];
        $match_time = $_POST['match_time'];
        $rule = $_POST['rule'];
        $userid = $_SESSION['user_data']['id'];

        $date = $_POST['year']."-". $_POST['day']."-".$_POST['month'];
        $date = mysql_real_escape_string($date);
        //var_dump($date);die();
        $query ="INSERT INTO `ps4_match` (`id`, `game_title`, `game_mode`, `amount`, `Date`, `match_time` ,`created_by`,`rule`) VALUES (NULL, '$Match_Name', '$Game_Mode', '$Amount', '$date' , '$match_time', '$userid', '$rule')";

        if (mysql_query($query)) {
            echo"<script>alert('Match Added successfullly')</script>";
        }
    }

    
    ?>


    <script>
        function goback(){
        window.location.href = 'ps4.php'
        }
    </script>
  &nbsp;&nbsp;&nbsp;

    <?php
    include "footer.php";
    ?>