<?php
	include 'includes/config.php';
	require_once 'core.inc.php';

	$token=mysqli_real_escape_string($con,urldecode($_POST['token']));
	$city=mysqli_real_escape_string($con,urldecode($_POST['city']));
	$colony=mysqli_real_escape_string($con,urldecode($_POST['colony']));

	$chk = 0;
	$result1 = array();
    	$result1['resultcode']    = 1;
	if(!empty($token)){
			
		$query = "SELECT `id` from `user_register` WHERE `token`='$token' AND `city`='$city' AND `colony`='$colony'";
		
		if($query_run = mysqli_query($con,$query)){
			
			$num_rows = mysqli_num_rows($query_run);

			if($num_rows ==0){
				//echo "Ïnvalid username/password combination!";
				$sqlnew="INSERT INTO `user_register`(`token`,`city`,`colony`) ".
				"VALUES ".
				"('$token','$city', '$colony')";
						
				$newentry=mysqli_query($con,$sqlnew);	
				
				if(!$newentry)
				{		
					$result1['resultcode']    = 0;		
					$chk=1;
					
					die('Failed: ' . mysql_error());
				}
				///$pk =  mysqli_insert_id($con);

			}
		}else{
			$result1['resultcode']    = 0;
			$chk = 1;
		}
	}else {
		$result1['resultcode']    = 0;
		$chk = 1;
	}


	// $sqlnew="INSERT INTO `user_register`(`token`,`city`,`colony`) ".
	// "VALUES ".
	// "('$token','$city', '$colony')";
			
	// $newentry=mysqli_query($con,$sqlnew);	
	
	// if(!$newentry)
	// {				
	// 	$chk=1;
	// 	die('Failed: ' . mysql_error());
	// }
	// $pk =  mysqli_insert_id($con);
	/*if($chk != 1){
		echo "1";
	}else{
		echo "0";
	} */
	echo json_encode($result1);

 ?>