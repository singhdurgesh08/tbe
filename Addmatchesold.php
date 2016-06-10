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
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
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
    


<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <script>

  $(document).ready(function(){
    $("#addmatches").validate();
  });
  </script>
</head>


<style>
.error {color:red;}
</style>

        
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

                          <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Date</label>
                            <div class="col-sm-6 input" >
                               <select name="Month" width="100" id="game" required="">
                                <option selected value=""></option>
                                  <option value="January">January</option>
                                  <option value="February">February</option>
                                  <option value="March">March</option>
                                  <option value="January">April</option>
                                  <option value="February">May</option>
                                  <option value="March">June</option>
                                  <option value="January">July</option>
                                  <option value="February">August</option>
                                  <option value="March">September</option>
                                  <option value="January">October</option>
                                  <option value="February">November</option>
                                  <option value="March">December</option>
                                </select>
                                
                                <select name="Day" width="100">
                                  <option selected value=""></option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="1">4</option>
                                  <option value="2">5</option>
                                  <option value="3">6</option>
                                  <option value="1">7</option>
                                  <option value="2">8</option>
                                  <option value="3">9</option>
                                  <option value="1">10</option>
                                  <option value="2">12</option>
                                  <option value="3">23</option>
                                  <option value="1">14</option>
                                  <option value="2">15</option>
                                  <option value="3">16</option>
                                  <option value="1">17</option>
                                  <option value="2">18</option>
                                  <option value="3">19</option>
                                  <option value="1">20</option>
                                  <option value="2">21</option>
                                  <option value="3">22</option>
                                  <option value="2">23</option>
                                  <option value="3">24</option>
                                  <option value="1">25</option>
                                  <option value="2">26</option>
                                  <option value="3">27</option>
                                  <option value="1">28</option>
                                  <option value="2">29</option>
                                  <option value="3">30</option>
                                  <option value="1">31</option>
                                  
                                </select>
                                
                                <select name="Year" width="100">
                                  <option selected value=""></option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                  <option value="2011">2011</option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                  <option value="2011">2011</option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                  <option value="2011">2011</option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                  <option value="2011">2011</option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                  <option value="2011">2011</option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                  <option value="2011">2011</option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                  <option value="2011">2011</option>
                                </select>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Match Time</label>
                            <div class="col-sm-6 input"><input type="text" id="timepicker" name="match_time"  class="form-control" required=""></div>
                        </div>
                  
                    

                        <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Game Mode</label>
                                    <div class="col-sm-6 input"><select name="Game_Mode" id="game" class="form-control" required="">               <option></option>
                                                                <option value="PS4">PS4</option>
                                                                <option value="XB1">XB1</option>
                                                                
                                                                 </select></div>
                                </div>

                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-6">Amount</label>
                            <div class="col-sm-6 input"><input type="text" id="amount" name="Amount"  class="form-control" required="" ></div>
                        </div>
                   </fieldset>
                   
            </div>
        </div>
               <div class="row">
                          <div>
                            <center><h1> Select Team</h1></center>
                        </div>
                </div>
           
            <div class="row">
                    
                             <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>Match Name</th>
                                    <th>Action</th>
                                    </tr>
                                    </thead>
                                    
                                             <tbody>
                                               <tr>
                                                    <td>hello</td>
                                                    <td>hello </td>
                                                    <td>hello </td>
                                              </tr>
                                               <tr>
                                                    <td>hello</td>
                                                    <td>hello </td>
                                                    <td>hello </td>
                                              </tr>
                                               <tr>
                                                    <td>hello</td>
                                                    <td>hello </td>
                                                    <td>hello </td>
                                              </tr>
                                      </tbody>

                             </table>

                        <div class="form-group">
                            <label for="login_password" class="control-label col-sm-1">Rule</label>
                            <div class="col-sm-6 input"><input type="text" name="rule"  class="form-control" required=""></div><br>
                        </div>
                        
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
        

    <?php
    if (isset($_POST['Save'])) {
       
        $Match_Name = $_POST['Match_Name'];
        $Date = $_POST['Month'];
        $Game_Mode = $_POST['Game_Mode'];
        $Amount = $_POST['Amount'];
        $match_time = $_POST['match_time'];
        $rule = $_POST['rule'];
        $userid = $_SESSION['user_data']['id'];


        $query ="INSERT INTO `ps4_match` (`id`, `game_title`, `game_mode`, `amount`, `Date`, `match_time` ,`created_by`,`rule`) VALUES (NULL, '$Match_Name', '$Game_Mode', '$Amount', '$Date' , '$match_time', '$userid', '$rule')";

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