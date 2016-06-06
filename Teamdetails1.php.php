
<?php 
 session_start();
 //echo "<pre>"; print_r($_SESSION);
include "login-header.php";?>
<?php include "nav.php";?>
<?php// echo 'Welcome to TBS'?>
	
	<style>
 		ul#menu 
 		{
 			padding: 50
 		}
 		ul#menu li {
 		display:inline;
 	    }
 		ul#menu li a
 		{background-color: black;
    		
 			color: white;
 			padding: 10px 20px;
 			text-decoration: none;
 			border-radius: 4px 4px 0 0;

 		}
 		ul#menu li a:hover {
 			background-color: blue;
 		}
 		
       .container{width:100%; height:300px; background-color:none; float:left}
       .footer{width:100%; height:30px; background-color:#00F; color:#FFF; font-size:20px; float:centre}
     </style>
    <style>
.menu_simple ul {
margin: 0;

padding: 0;

width:185px;

list-style-type: none;

}

.menu_simple {
     position: absolute;
    top: 350px;
    right: 150px;
   }

.menu_simple ul li a {
text-decoration: none;
color: white;

padding: 10.5px 11px;

background-color: #005555;

display:block;
}

.menu_simple ul li a:visited {
color: white;
}

.menu_simple ul li a:hover, .menu_simple ul li .current 
color: white;
background-color: #5FD367;
}
</style>
    <div>

    	<ul id="menu">
    	<ul>

    		<li><a href="#">ROSTER</a></li>
    		<li><a href="#">RANK</a></li>
    		<li><a href="#">ROLE</a></li>
    		<li><a href="#">SOCIAL MEDIA</a></li>
    		<li><a href="#">W-L</a></li>
    		<li><a href="#">ELIGILIBTY</a></li>
    		<li><a href="#">DATE JOINED</a></li>
    	</ul>
    </div>
    <div class="container">
</div>  
    <div>

    	<ul id="menu">
    	<ul>

    		<li><a href="#">RECENT MATCHES</a></li>
    		<li><a href="#">RESULT</a></li>
    		<li><a href="#">DATE</a></li>
    		
    		<li><a href="#">INFO</a></li>
    	</ul>
    </div>
   <div class="menu_simple">
<ul>
<li><a href="#">Match Finder</a></li>
<li><a href="#">Add Member</a></li>
<li><a href="#">Disable Team</a></li>
<li><a href="#">Edit Team</a></li>
<li><a href="#">Edit Roster</a></li>
</ul>
</div>
	
<?php include "footer.php";?>

