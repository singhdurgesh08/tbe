<html>

<body>

<form action="combotest.php" method="post">
Username: <input type="text" name="Username" /> <br/>
Password: <input type="text" name="Password" /> <br/>

Secret Question: <select name="Secret_Question">
<option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
<option value="What is your place of birth?">What is your place of birth?</option>
<option value="What is your favourite food?"selected="selected">What is your favourite food?</option>
<option value="What is your favourite pet's name?">What is your favourite pet's name?</option>
</select>

<input type='submit' name='submit' value='Submit' />
</form>

</body>

</html>
<?php
//DECLARING VARIABLES
mysql_connect("localhost","root","");
mysql_select_db("inetglobal");


//$host = "I have my IP address in here"; // Host
//$dbuser="web41-admin-2"; // Mysql username 
//$dbpassword="I have my password here"; // Mysql password 
//$db_name="web41-admin-2"; // Database name 
//$tbl_name="Users"; // Table name
if(isset($_POST['submit']))
{
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Secret_Question = $_POST['Secret_Question'];
//$Secret_Answer = $_POST['Secret_Answer'];
//$first_name = $_POST['first_name'];
//$surname = $_POST['surname'];
//$email = $_POST['email'];


//$query = "INSERT into combotest VALUES
  //  ('".$Username."','".$Password."','".$Secret_Question."')";

 $query = "INSERT into user_profile (Username,Password,Secret_Question) VALUES('$Username,$Password,$Secret_Question)";

$result = mysql_query($query);
//var_dump($result);die();	
if ($result)
    echo "user added";
}
?>  