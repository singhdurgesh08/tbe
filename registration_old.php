<?php
ob_start();
session_start();
include "header.php";
include "nav_before_login.php";
?>

<script>
    var rootpath = '<?php echo HOSTNAME; ?>';
</script>

<script>


    $(function() {
       // $("#DOB").datepicker();
        $("#registration").validate({
// Specify the validation rules
            rules: {
                
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                pass: {
                    required: true,
                    minlength: 5
                    
                },
                 confirm_pass: {
                    required: true,
                    minlength: 5,
                    equalTo : '[name="pass"]'
                    
                },
                
                terms: "required"
            },
// Specify the validation error messages
            messages: {
                
                name: "Please enter your user name",
                 email: {
                    required:"Please enter a email address",
                    email: "Please enter a valid email address"
                },
                pass: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                 confirm_pass: {
                    required: "Please provide a confirm password",
                    minlength: "Your confirm password must be at least 5 characters long",
                    equalTo : 'Please enter password and confirm password same'
                    
                },
                
                terms: "Please accept our policy"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });


</script>
<div class="container">
    <div class="signup_form_page">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1 class="signup_title"><br class="hidden-xs">Register Account</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form method='post' action='registration.php' class="form-horizontal" id="registration">
                    <fieldset>
                        <div class="form-group">
                            <label for="user_name" class="control-label col-sm-4">User Name</label>
                            <div class="col-sm-7 input"><input name='name'  type="text" placeholder="Please Enter User Name"  class="form-control" required=""></div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label col-sm-4">Email</label>
                            <div class="col-sm-7 input"><input name='email'  placeholder="Please Enter Email"  class="form-control" ></div>
                        </div>

                        <div class="form-group">
                            <label for="user_pasword" class="control-label col-sm-4"> Password</label>
                            <div class="col-sm-7 input"><input type='password' name='pass'  placeholder="Please Enter password"  class="form-control" required=""></div>
                        </div>

                        <div class="form-group">
                            <label for="user_pasword" class="control-label col-sm-4">Confirm Password</label>
                            <div class="col-sm-7 input"><input type='password' name='confirm_pass'  placeholder="Please Enter confirm password"  class="form-control" required=""></div>
                        </div>





                    </fieldset>
                    <div class="col-sm-12 text-center">
                        <p><input type="checkbox" required name="terms"><u></u> I accept the Privacy <a href="term-service.php" target="_blank">Terms of service </a> of tbesportsgaming</p>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-6 back hidden-xs">&nbsp;</label>
                        <div class="col-sm-12 input text-center">
                            <button class="btn btn-md btn-block btn-success sign_up_button" type="submit" name="submit" value="Sign Up">Sign Up <i class="glyphicon glyphicon-chevron-right"></i></button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

</div>



<?php include "footer.php"; ?>
<?php
include "config.php";

if (isset($_POST['submit'])) {
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_pass = $_POST['pass'];
    $confirm_pass = $_POST['confirm_pass'];
  //  $Address = $_POST['Address'];
    //$DOB = $_POST['DOB'];
    //$State = $_POST['State'];
    //$Country = $_POST['Country'];
    $Membership = "1";

    if ($user_name == '') {
        echo "<script>alert('please enter your name')</script>";
        exit();
    }

    if ($user_email == '') {
        echo "<script>alert('please enter your email')</script>";
        exit();
    }

    if ($user_pass == '') {
        echo "<script>alert('please enter your password')</script>";
        exit();
    }
   
    $check_name = "select * from users where user_name ='$user_name'";
    $run = mysql_query($check_name);
    
    if (mysql_num_rows($run) >= 1) {
        echo "<script>alert('Name $user_name is already exits')</script>";
        exit();
    }

    $check_email = "select * from users where user_email ='$user_email'";
    $run = mysql_query($check_email);
    
    if (mysql_num_rows($run) >= 1) {
        echo "<script>alert('Email $user_email is already exits')</script>";
        exit();
    }
  
     $query="INSERT INTO `users` (`id`,`user_name`, `user_email`, `user_pass`, `confirm_pass`, `membership_id`, `createddate`, `is_admin`) VALUES (NULL, '$user_name', '$user_email', '$user_pass', '$confirm_pass','1',CURRENT_TIMESTAMP, '0')";


    if (mysql_query($query)) {
        echo"<script>alert('Registration successfullly completed')</script>";
    }
}
?>
