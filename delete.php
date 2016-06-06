<?php
	include "config.php";

	mysqli_query("DELETE FROM student WHERE id='$id'");
	//mysqli_close($con);

?>