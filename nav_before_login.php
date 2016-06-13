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
</style>
<?php
  $file=$_SERVER["SCRIPT_NAME"]; ?>
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
		  <li class="<?php if(ereg("teamlist.php",$file)>0) echo " active"; ?>"><a href="teamlist.php">Team</a></li>
		  <li class="<?php if(ereg("ps4.php",$file)>0) echo " active"; ?>"><a href="ps4.php">PS4</a></li>
		  <li class="<?php if(ereg("xb1.php",$file)>0) echo " active"; ?>"><a href="xb1.php">XB1</a></li>
		  <li class="<?php if(ereg("top50goals.php",$file)>0) echo " active"; ?>"><a href="top50goals.php">Top 50 Goats</a></li>
		  <li class=" dropdown <?php if(ereg("leadership.php",$file)>0 || ereg("staff.php",$file)>0  || ereg("faq.php",$file)>0) echo " active"; ?>"><a class="active">Support</a>
		  <div class="dropdown-content" style="z-index:999;">
			<a href="leadership.php">Leadership</a>
			<a href="staff.php">Tournament Staff</a>
			<a href="faq.php">Faq</a>
		</div>
		  </li>
		  
		</ul>
	  </div><!-- /.navbar-collapse -->
	</nav>
</div>
</section>