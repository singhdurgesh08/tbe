<?php session_start();
     ob_start();
if(session_destroy())
	{
		session_destroy();
	header("Location:/");
	}
?>
