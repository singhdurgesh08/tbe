<?php
session_start();

if ($_SESSION['user_data']['user_name'] == '') {
    header("location: login.php");
    exit();
}

include "login-header.php";
?>
<?php include "nav.php"; ?>
<?php include "config.php";

?>
<div class="home_tab_section">
<div class="container">
    <div class="row">
        <div class="col-sm-4 text-center">
            <h1>Payment </h1>
        </div>
        <div class="col-sm-6 text-center">
            <h1></h1>
        </div>
   </div>

   <div class="row">
        <div class="col-sm-12">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Payment Type</th>
                        <th>User Id</th>
                        <th>Payment Gross</th>
                        <th>Payment Status</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>

                             <tbody>
                                <tr>
                                    <td>kk</td>
                                    <td>kk</td>
                                    <td>kk</td>
                                    <td>kk</td>
                                    <td>kk</td>
                                    <td>kk</td>
                                </tr>
                             </tbody>
                    </table>
                   </div>
                </div>
     </div>



<?php
include "footer.php";
?>