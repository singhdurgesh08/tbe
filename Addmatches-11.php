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


        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<!--        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>-->
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
        <script src="<?php echo HOSTNAME; ?>assets/js/jquery.timepicker.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo HOSTNAME; ?>assets/css/jquery.timepicker.css" />

        <script>


            $(function() {
                $("#datepicker").datepicker();
                $("#datepicker1").datepicker();
                $("#timepicker").timepicker();
            });


        </script>
    
        <div class="home_tab_section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1><br class="hidden-xs">POST  Match</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <form method='post' action='Addmatches.php' class="form-horizontal">
                            <fieldset>
                                <div class="form-group">
                                    <label for="login_email" class="control-label col-sm-6">Game Title</label>
                                    <div class="col-sm-6 input"><input name='Game_Title'  type="text" placeholder="Please Enter Match Name"  class="form-control" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Gamertag</label>
                                    <div class="col-sm-6 input"><select name="Game_Mode" class="form-control" >
                                            <option value="PS4">PS4</option>
                                            <option value="XB1">XB1</option>
                                        </select></div>
                                </div>


                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Registration Open Date</label>
                                    <div class="col-sm-6 input"> <input type="text" id="datepicker" name='from' value=""  class="form-control" />  
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Registration Open Date</label>
                                    <div class="col-sm-6 input"> <input type="text" id="datepicker1" name='from1' value=""  class="form-control" />  
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Start Time</label>
                                    <div class="col-sm-6 input"><input type="text" id="timepicker" name="form2"  class="form-control" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Minimum Team Size</label>
                                    <div class="col-sm-6 input"><input name='Min_Size'  placeholder="Please Enter Minimum Team Size"  class="form-control" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Maximum Team Size</label>
                                    <div class="col-sm-6 input"><input name='Max_Size'  placeholder="Please Enter Maximum Team Size"  class="form-control" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Prize1</label>
                                    <div class="col-sm-6 input"><input name='Prize1'  placeholder="Please Enter Prize1"  class="form-control" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Prize2</label>
                                    <div class="col-sm-6 input"><input name='Prize2'  placeholder="Please Enter Prize2"  class="form-control" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Prize3</label>
                                    <div class="col-sm-6 input"><input name='Prize3'  placeholder="Please EnterPrize3"  class="form-control" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Bracket Type</label>
                                    <div class="col-sm-6 input"><input name='Bracket_Type'  placeholder="Please Enter Bracket Type"  class="form-control" ></div>
                                </div>



                            </fieldset>

                            <div class="form-group">
                                <label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
                                <div class="col-sm-2 input text-center">
                                    <button class="btn btn-lg btn-block btn-success" type="submit" name="Save" value="Save">Save<i class="glyphicon glyphicon-chevron-right"></i></button>

                                </div>

                                <div class="col-sm-2 input text-center">
                                    <a href="ps4.php" class="btn btn-lg btn-danger">Cancel<i class="glyphicon glyphicon-chevron-right"></i></a>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    <?php
    if (isset($_POST['Save'])) {
        $Game_Title = $_POST['Game_Title'];
        $Game_Mode = $_POST['Game_Mode'];
        $Open_Date = date('Y-m-d', strtotime($_POST['from']));
        $Close_Date = date('Y-m-d', strtotime($_POST['from1']));
        $Start_Time = date('H:i:s', strtotime($_POST['Start_Time']));
        $Min_Size = $_POST['Min_Size'];
        $Max_Size = $_POST['Max_Size'];
        $Prize1 = $_POST['Prize1'];
        $Prize2 = $_POST['Prize2'];
        $Prize3 = $_POST['Prize3'];
        $Bracket_Type = $_POST['Bracket_Type'];
        $userid = $_SESSION['user_data']['id'];

        $query = "INSERT INTO `ps4_match` (`id`, `game_title`, `game_mode`, `open_date`, `close_date`, `start_time`, `minimum_size`, `maximum_size`, `prize1`, `prize2`, `prize3`, `bracket_type`,`created_date`,`created_by`) VALUES (NULL, '$Game_Title', '$Game_Mode', '$Open_Date', '$Close_Date','$Start_Time','$Min_Size', '$Max_Size', '$Prize1', '$Prize2', '$Prize3', '$Bracket_Type',now(),'$userid')";
        
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


    <?php
    include "footer.php";
    ?>