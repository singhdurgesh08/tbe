<?php 
 session_start();
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>
<style>

.nav.nav-tabs li:first-child a {
    margin-left: 0;
}
.nav.nav-tabs li.active a {
    background: #fff;
    border-bottom: 0 !important;
    border-color: #d9d9d9;
    border-top: 0;
    color: #DF0A0A;
    position: relative;
    top: 1px;
    z-index: 1;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    color: #555;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
    cursor: default;
}
.nav.nav-tabs li a {
    -webkit-border-top-left-radius: 4px;
    -webkit-border-top-right-radius: 4px;
    -moz-border-radius-top-left: 4px;
    -moz-border-radius-top-right: 4px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background: #f0f0f0;
    border: 1px solid transparent;
    border-bottom: 0;
    color: inherit;
    cursor: pointer;
    font-weight: bold;
    margin-left: 10px;
    padding: 10px 25px;
    position: relative;
    text-align: center;
    top: -1px;
}
.nav>li>a:hover, .nav>li>a:focus {
    text-decoration: none;
    background-color: #eee;
}
.nav-tabs>li>a {
    margin-right: 2px;
    line-height: 1.428571429;
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
}

a:active, a:hover {
    outline: 0;
}
.tab-content>.tab-pane {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #fff;
    border: 1px solid #d9d9d9;
    border-top-left-radius: 0 !important;
    margin-bottom: 10px;
    padding: 10px;
    padding-bottom: 0;
}
.nav.nav-tabs li.active a::after {
    content: '';
    position: absolute;
    right: 0;
    top: 0;
    -webkit-border-top-left-radius: 4px;
    -webkit-border-top-right-radius: 4px;
    -moz-border-radius-top-left: 4px;
    -moz-border-radius-top-right: 4px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background: #5bc0de;
    height: 5px;
    width: 100%;
}

</style>
<div class="home_tab_section">
    <div class="container">
        <div class="row">
            <div class="tabset-cashier col-md-12 ng-isolate-scope">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="ng-isolate-scope active">
                        <a href="#1" data-toggle="tab">Deposit</a>
                    </li>
                    <li role="presentation" class="ng-isolate-scope">
                        <a href="#2" data-toggle="tab">Enter your Paypal Email</a>
                    </li>
                    <li role="presentation" class="ng-isolate-scope">
                        <a href="#3" data-toggle="tab">Transfer</a>
                    </li>
                  
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="1">
              
                        <form id="add_wallet" name="add_wallet" action="add_wallet.php" method="post"  class="form-horizontal">

                            <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="add_amount" name="add_amount" class="form-control" placeholder="Enter Amount ($5 minimum)" required="" min="10"/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input name="agree" type="checkbox" required="" class="required">
                                    I have read and agree to the tbeGaming <a href="term-service.php" translate="" target="_blank">Terms and Conditions</a>

                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-2 text-center">
                                    <button type="submit" name="add" value="Add" class="btn btn-info"><span class="ng-scope">Pay With PayPal</span></button>
                                </div>

                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="2">
                        <form id="add_wallet" name="add_wallet" action="withdrawal_wallet.php" method="post"  class="form-horizontal">

                            <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter Partner Paypal Email" required=""/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="add_amount" name="add_amount"   class="form-control" placeholder="Enter Amount ($5 minimum)" required="" min="10"/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input name="agree" type="checkbox" required="" class="required">
                                    I have read and agree to the tbeGaming <a href="term-service.php" translate="" target="_blank">Terms and Conditions</a>

                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-2 text-center">
                                    <button type="submit" name="withdrawal" value="withdrawal" class="btn btn-info"><span class="ng-scope">Pay With PayPal</span></button>
                                </div>

                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="tab-pane" id="3">
                        <form id="add_wallet" name="add_wallet" action="withdrawal_wallet.php" method="post"  class="form-horizontal">

                            <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter Partner Paypal Email" required=""/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8 text-center">
                                    <input type="text" id="add_amount" name="add_amount"   class="form-control" placeholder="Enter Amount ($5 minimum)" required="" min="10"/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input name="agree" type="checkbox" required="" class="required">
                                    I have read and agree to the tbeGaming <a href="term-service.php" translate="" target="_blank">Terms and Conditions</a>

                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-2 text-center">
                                    <button  style="display:none;" type="submit" name="withdrawal" value="withdrawal" class="btn btn-info"><span class="ng-scope">Pay With PayPal</span></button>
                                </div>

                            </div>
                             <div class="row">
                                <div class="col-sm-8"> &nbsp;  </div>
                            </div>
                        </form>
                         <div class="row">
                                <div class="col-sm-8 btn btn-info"> Coming soon Transfer Feature </div>
                            </div>
                    </div>
                </div>
                
            </div>
        </div><!--row end-->
    </div>
<!--<div class="container">
<div class="row">
        <div class="col-sm12 text-center">
                <h1>Wallet</h1>
        </div>


</div>
   
    <ul class="nav nav-tabs">
        <li role="presentation" class="active">
            <a  href="#1" data-toggle="tab">Overview</a>
        </li>
        <li role="presentation"><a href="#2" data-toggle="tab">Without clearfix</a>
        </li>
        <li role="presentation"><a href="#3" data-toggle="tab">Solution</a>
        </li>
    </ul>

    <div class="tab-content ">
        <div class="tab-pane active" id="1">
           <form id="add_wallet" name="add_wallet" action="add_wallet.php" method="post">

          <div class="row">
              <div class="col-sm-4 text-center">
                  <h1>Add Wallet (USD)</h1>
              </div>
              <div class="col-sm-5 text-center">
                  <h1><input type="text" id="add_amount" name="add_amount"  placeholder="Please Enter Amount"/></h1>
              </div>
              <div class="col-sm-2 text-center">
                  <input type="submit" name="add" value="Add" class="btn btn-lg btn-block btn-success"/> 
              </div>

          </div>
      </form>
        </div>
        <div class="tab-pane" id="2">
          <form id="add_wallet" name="add_wallet" action="withdrawal_wallet.php" method="post">
          <div class="row">
              <div class="col-sm-4 text-center">
                  <h1>withdrawal from Wallet (USD)</h1>
              </div>
              <div class="col-sm-4 text-center">
                  <h1><input type="text" id="email" name="email"  placeholder="Please Enter Paypal Email" /></h1>
              </div>
              <div class="col-sm-4 text-center">
                  <h1><input type="text" id="add_amount" name="add_amount"  placeholder="Please Enter Amount"/></h1> 
              </div>

          </div>
          <div class="row">
              <div class="col-sm-4 text-center">

              </div>

              <div class="col-sm-4 text-center">
                  <input type="submit" name="withdrawal" value="withdrawal" class="btn btn-lg btn-block btn-success"/> 
              </div>

          </div>
      </form>
        </div>
        <div class="tab-pane" id="3">
            <h3>add clearfix to tab-content (see the css)</h3>
        </div>
    </div>


    <div class="row">
        <div class="col-sm12 text-center">
                <h1></h1>
        </div>


</div>
    <div class="row">
        <div class="col-sm12 text-center">
                <h1></h1>
        </div>


</div>
    <div class="row">
        <div class="col-sm12 text-center">
                <h1></h1>
        </div>


</div>
    <div class="row">
        <div class="col-sm12 text-center">
                <h1></h1>
        </div>


</div>
</div>-->
 </div>
<?php
include "footer.php";
?>



