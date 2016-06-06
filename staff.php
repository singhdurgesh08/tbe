<?php 
 session_start();
  if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}
include "login-header.php";?>
<?php include "nav.php";?>
<?php include "config.php"; ?>

<style>
 thead th {
    background-color: #006DCC;
    color: white;
}

tbody td {
    background-color: #EEEEEE;
}
Ha
</style>
<div class="container">
    <div class="row">
        
        <!--/span-->
        <div class="col-md-9">
            
               <div class="row">
                   
                   <div class="col-sm-2">
                       <img src="<?php echo HOSTNAME; ?>assets/images/icon_keys.png" width="80" class="img-responsive" alt="" >
                   </div>
                   
                   <div>
                                <h2><b>SUPPORT</b></h2>                            
                   </div>
                </div>

            <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                   
         </div>
                <div class="row">
                        <p>
                        <h4>Our staff strives to bring you the best in competitive online gaming.<br>
                        For questions, please visit our helpful FAQ page, or submit a ticket at our Ticket Center.
                    </h4></p>
                   </div>
                   
         </div>
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                   
         </div>
                <div class="row">
                    <div class="col-sm-10">


                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <caption class="text-center"> </caption>  
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Staff Member</th>
                                    <th>Position</th>
                                    <th>Social Media</th>
                                                                    </tr>
                            </thead>

                            <tbody>
                                <tr>
                                        <td >ABC</td>
                                        <td> OLT Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/fb.png" width="20" class="img-responsive" alt="" >
                                        </td>
                                </tr>
                                <tr>
                                        <td >CYX</td>
                                        <td> Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/twitter.jpg" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                <tr>
                                        <td >DDDDD</td>
                                        <td> OLT Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/fb.png" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                <tr>
                                        <td >ZZZZZZZZZ</td>
                                        <td> Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/twitter.jpg" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                <tr>
                                        <td >ABC</td>
                                        <td> OLT Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/twitter.jpg" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                <tr>
                                        <td >CYX</td>
                                        <td> Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/fb.png" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                <tr>
                                        <td >DDDDD</td>
                                        <td> OLT Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/twitter.jpg" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                <tr>
                                        <td >ZZZZZZZZZ</td>
                                        <td> Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/fb.png" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                <tr>
                                        <td >ABC</td>
                                        <td> OLT Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/fb.png" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                <tr>
                                        <td >CYX</td>
                                        <td> Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/fb.png" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                <tr>
                                        <td >DDDDD</td>
                                        <td> OLT Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/fb.png" width="20" class="img-responsive" alt="" ></td>
                                </tr>
                                 
                                 <tr>
                                        <td >ZZZZZZZZZ</td>
                                        <td> Manager </td>
                                        <td ><img src="<?php echo HOSTNAME; ?>assets/images/fb.png" width="20" class="img-responsive" alt="" ></td>
                                </tr>

                                </tbody>
                        </table>
                    </div>
    </div>
                
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                   
         </div>
                
                <div class="row">
                   <div class="col-sm-12">
                    &nbsp;
                   </div>
                   
         </div>
            </div>
      </div>
        
    </div>
    <!--/row-->
</div>




<?php
include "footer.php";
?>