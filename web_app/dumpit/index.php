<?php
	require_once 'core.inc.php';
	require_once 'includes/config.php';

	if(loggedin()){
	
	//echo '<a href = "logout.php">Log out</a>';
	header("Location: home.php");
	}
	else{
		include 'signup.inc.php';
		//echo "string";
	}
	//echo "string";
?>