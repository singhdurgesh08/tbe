<style>
.dropbtn {
    background-color: #f9f9f9;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}
.dropdown {
    position: relative;
    display: inline-block;
}
.dropdown-content {
    display: none;
    color: black;
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}
.dropdown-content a:hover {background-color: #f1f1f1}
.dropdown:hover .dropdown-content {
    display: block;
}
.dropdown:hover .dropbtn {
    background-color: #3e8e41;

}
.navbar-default .navbar-collapse, .navbar-default .navbar-form {
    border-color: #333;
/*    background-color: black;*/
    color: white;
}
.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
    color: #000;
    background-color: #f1f1f1;
    font-weight: bold;
}
.nav>li>a {
    padding: 11px 50px;
}

</style>
<?php
  $file=$_SERVER["SCRIPT_NAME"];
$userid = $_SESSION['user_data']['id'];

	//$rows = mysql_fetch_row($run1);
	include "config.php"; 
	 $result = mysql_query("select sum(payment_gross) AS value_sum from payments where user_id ='$userid' and payment_type ='ADD' and payment_status ='1'"); 
	  $row = mysql_fetch_array($result);
      $sum = $row['value_sum'];
	  
	  $result2 = mysql_query("select sum(payment_gross) AS value_sum_withdraw from payments where user_id ='$userid' and payment_type ='Withdrawal' and payment_status ='1'"); 
	  $row2 = mysql_fetch_array($result2);
      $withdraw = $row2['value_sum_withdraw'];
	  
	  
	 // echo "<pre>111111111111111111111==============="; print_r($withdraw);
?>
<section class="menu_section">
<div class="container">
    <nav class="navbar navbar-default" role="navigation">
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
	  </div>

	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav top_menu">
		  <li class=" dropdown <?php if(ereg("leadership.php",$file)>0 || ereg("staff.php",$file)>0  || ereg("faq.php",$file)>0) echo " active"; ?>"><a class="active">Team</a>
		  <div class="dropdown-content" style="z-index:999;">
          
            	<?php
            	   	$res = mysql_query("Select * from team where created_by = '$userid'"); 
					
					while($r = mysql_fetch_array($res))
					{
						echo ('<a href=teamdetails.php?teamid=' . $r[id] . '>'. $r[team_name].'</a>');
					} 
					
	   			 
	   			 ?>
          
		</div>
		  </li>

		  
		  <li class="<?php if(ereg("ps4.php",$file)>0) echo " active"; ?>"><a href="ps4.php">PS4</a></li>
		  <li class="<?php if(ereg("xb1.php",$file)>0) echo " active"; ?>"><a href="xb1.php">XB1</a></li>
		  <li class="<?php if(ereg("top50goals.php",$file)>0) echo " active"; ?>"><a href="top50goals.php">top50goals</a></li>
		  <li class=" dropdown <?php if(ereg("leadership.php",$file)>0 || ereg("staff.php",$file)>0  || ereg("faq.php",$file)>0) echo " active"; ?>"><a class="active">Support</a>
		  <div class="dropdown-content" style="z-index:999;">
                        <a href="ticket.php">Ticket</a>
			<a href="leadership.php">Leadership</a>
			<a href="staff.php">Tournament Staff</a>
			<a href="faq.php">Faq</a>
		</div>
		  </li>
		  <li class="dropdown selected">
			<a class="dropbtn" style="color:red;" > <b><?php echo substr($_SESSION['user_data']['user_name'],0,20);?> &nbsp;$ <?php echo  number_format($sum) - number_format($withdraw);?> </b></a>  
			<div class="dropdown-content" style="z-index:999;">
			<a href="myprofile.php">My Profile</a>
                        <a href="editprofile.php">Edit Profile</a>
			<a href="home.php">Home</a>
			<a href="wallet.php">Wallet</a>
			<a href="subscribe_membership.php">Membership</a>
			<a href="Addplaystation.php">Gamertag</a>
			<a href="logout.php">Logout</a>
		</div>
		
		  </li>
		</ul>
	  </div><!-- /.navbar-collapse -->
	</nav></div>
    </section>