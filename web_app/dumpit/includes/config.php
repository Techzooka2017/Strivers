<?php //error_reporting (E_ALL ^ E_NOTICE);
		//error_reporting(0);
	$con = mysqli_connect('localhost', 'root', 'kmt111320','dumpit');
	
	if($con)
	{
		// echo ('Pass');
	}
	else 
	{
		die("Cannot connect to database...".mysqli_error($con));
	}

?>