<?php
include "header.php";
include "nav_before_login.php";
?>
<?php
include "config.php";

if(empty($_GET['id']) && empty($_GET['code']))
{

 header("location: index.php");
}

if(isset($_GET['id']) && isset($_GET['code']))
{
 //$id = base64_decode($_GET['id']);
 $id = $_GET['id'];
 $code = $_GET['code'];
 
 $statusY = "1";
 $statusN = "0";
 
$check_user ="select * from users where id ='$id'";
$run = mysql_query($check_user);
if(mysql_num_rows($run)>0)
 {
  $row = mysql_fetch_assoc($run);
  if($row['status']==$statusN)
  {
    $query = "UPDATE users set status = '$statusY' WHERE id='" . $_GET["id"]. "'";
    $result = mysql_query($query);
   
   
   $msg = "
             <div class='alert alert-success'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>Wow !</strong>  Your Account is Now Activated : <a href='login'>Login here</a>
          </div>
          "; 
  }
  else
  {
   $msg = "
             <div class='alert alert-danger'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>sorry !</strong>  Your Account is allready Activated : <a href='login'>Login here</a>
          </div>
          ";
  }
 }
 else
 {
  $msg = "
         <div class='alert alert-danger'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>sorry !</strong>  No Account Found : <a href='registration'>Signup here</a>
      </div>
      ";
 } 
}

?>

<div class="container">
    

    <div style="max-width:819px;">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1 class="signup_title"><br class="hidden-xs">Email Confirmation</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form method='post' action='registration.php' class="form-horizontal" id="registration">
                    <fieldset>
                        <div class="form-group">
                             <?php if(isset($msg)) echo $msg;  ?>
                        </div>

                        

                       </fieldset>
                   
                </form>

            </div>

        </div>
    </div>

</div>



<?php include "footer.php"; ?>


