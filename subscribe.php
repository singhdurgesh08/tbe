<?php 
include "config.php";
session_start();
if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
 }
include "login-header.php";?>
<?php include "nav.php";?>

<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <script>

  $(document).ready(function(){
    $("#editform").validate();
  });
  </script>
</head>



<style>
 thead th {
    background-color: #006DCC;
    color: white;
}

tbody td {
    background-color: #EEEEEE;
}

</style>


<div class="container">
    <div class="row">
        
        <!--/span-->
        <div>
          <div class="row">
              &nbsp;
          </div>
        </div>
        <div class="col-md-9">
                       <h2><b> Checkout</b></h2>
                   </div>
                </div>
             
         </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                                                    </tr>
                            </thead>

                            <tbody>
                                <tr>
                                        <td>fff</td>
                                        <td>fdgf</td>
                                        <td>fff</td>
                                        <td>fdgf</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
    </div>
                
               
                
                   
         </div>
            </div>
      </div>
        
    </div>
    <!--/row-->
</div>

<hr>

<div class="container">
    <div class="row">
                    <div class="col-sm-6 text-center">
                        <h3><br class="hidden-xs">Billing Address</h3>
                    </div>

 <div class="row">
                    <div class="col-sm-6 text-center">
                        <h3><br class="hidden-xs">Payment Option</h3>
                    </div>

                <div class="row">
                    <div class="col-sm-6">
                        <form method='post' id="editform" class="form-horizontal">

                        <fieldset>

                
                                <div class="form-group">

                                    <label for="login_password" class="control-label col-sm-6">First Name</label>
                                    <div class="col-sm-6 input"><input name='First_Name' id="name" placeholder="Please Enter First Name" class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Last Name</label>
                                    <div class="col-sm-6 input"><input name='Last_Name' id="lname"  placeholder="Please Enter Last Name"  class="form-control" required=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Address</label>
                                    <div class="col-sm-6 input"><input name='Address' id="address" placeholder="Please Enter Street address"  class="form-control" required="" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">City</label>
                                    <div class="col-sm-6 input"><input name='City' id="city"  placeholder="Please Enter City"  class="form-control" required="" ></div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">State</label>
                                    <div class="col-sm-6 input"><select name="State" id="state" class="form-control" required="">               <option></option>
                                                                <option value="Delhi">Delhi</option>
                                                                <option value="Banglore">Banglore</option>
                                                                <option value="Chennai">Chennai</option>
                                                                 </select></div>
                                </div>
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Postal code</label>
                                    <div class="col-sm-6 input"><input name='zip' id="zip"  placeholder="Please Enter Postal code" class="form-control" required="" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Country</label>
                                    <div class="col-sm-6 input"><input name='Country' id="country"  placeholder="Please Enter Country"  class="form-control" required="" ></div>
                                </div>
                                <div class="form-group">
                                    <label for="login_password" class="control-label col-sm-6">Phone</label>
                                    <div class="col-sm-6 input"><input name='paypal_email' id="paypal"  placeholder="Please Enter 0123456789"  class="form-control" required="" ></div>
                                
                            </div>
                        </fieldset>
                </form>
                </div>

   <div class="col-sm-6">
    <div class="hidden-xs">
      
        
          <div class="col-sm-6 ">
            <label class="radio">
                <h3><input type="radio" name="optradio">Paypal</h3></label>
                <p>Please enter your billing information for TBE Sport gaming records,
                 then click "checkout with PayPal" to finalize your payment at PayPal.</p>
            
                </div>
                </div>
        <p></p>
           <p></p>

        <label class="checkbox-inline">
      <input type="checkbox" value=""><a href="#">I agree to the term of service and for my subscription.</a>
    
    </label>
        
          
       <div> &nbsp; </div>
        <div>&nbsp;</div>
      <div class="well">
        <button class="btn btn-lg btn-block btn-success" type="submit" name="Update" id="Update"
         value="Update">Checkout with PAYPAL <i class="glyphicon glyphicon-chevron-right"></i></button>
        <div><center><strong>Fast,&nbsp; Easy,&nbsp; secure</strong></center> </div>
        
      </div>
    </div>
  </div>
</div>


<?php

?>

<?php include "footer.php";?>


