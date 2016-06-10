<?php 
 session_start();
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>
<style>


#exTab1 .tab-content {
    color : white;
    background-color: #428bca;
    padding : 5px 15px;
}

#exTab2 h3 {
    color : white;
    background-color: #428bca;
    padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
    border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
    border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
    color : white;
    background-color: #428bca;
    padding : 5px 15px;
}






</style>
<div class="home_tab_section">
<div class="container">
<div class="row">
        <div class="col-sm12 text-center">
                <h1>Wallet</h1>
        </div>


</div>
   
    <div id="exTab2" class="container">	
    <ul class="nav nav-tabs">
        <li class="active">
            <a  href="#1" data-toggle="tab">Overview</a>
        </li>
        <li><a href="#2" data-toggle="tab">Without clearfix</a>
        </li>
        <li><a href="#3" data-toggle="tab">Solution</a>
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
</div>
 </div>
<?php
include "footer.php";
?>




