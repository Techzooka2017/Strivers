<?php
	include 'includes/config.php';
	require_once 'core.inc.php';

	$email_id=mysqli_real_escape_string($con,urldecode($_POST['email_id']));
	$name=mysqli_real_escape_string($con,urldecode($_POST['name']));
	$address=mysqli_real_escape_string($con,urldecode($_POST['address']));
	$mobile=mysqli_real_escape_string($con,urldecode($_POST['mobile']));
	$password=mysqli_real_escape_string($con,urldecode($_POST['password']));
	$category=mysqli_real_escape_string($con,urldecode($_POST['category']));
	$pass_hash = md5($password);

	$chk = 0;
	$result1 = array();
    	$result1['resultcode']    = 1;
	if(!empty($email_id)){
			
		$query = "SELECT `id` from `user_det` WHERE `email_id`='$email_id'";
		
		if($query_run = mysqli_query($con,$query)){
			
			$num_rows = mysqli_num_rows($query_run);

			if($num_rows ==0){
				//echo "Ïnvalid username/password combination!";
				$sqlnew="INSERT INTO `user_det`(`email_id`,`name`,`address`,`mobile`,`password`,`category`) ".
				"VALUES ".
				"('$email_id','$name', '$address','$mobile','$pass_hash','$category')";
						
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
	if($chk != 1){
		echo "1";
	}else{
		echo "0";
	} 
	//echo json_encode($result1);

 ?>