<?php
	include 'includes/config.php';
	require_once 'core.inc.php';

	$email_id=mysqli_real_escape_string($con,urldecode($_POST['user_id']));
	// service provider id
	$sp_id=mysqli_real_escape_string($con,urldecode($_POST['sp_id']));
	$start_date=mysqli_real_escape_string($con,urldecode($_POST['start_date']));
	$end_date=mysqli_real_escape_string($con,urldecode($_POST['end_date']));
	$pickup_time=mysqli_real_escape_string($con,urldecode($_POST['pickup_time']));
	$frequency=mysqli_real_escape_string($con,urldecode($_POST['frequency']));
	//$pass_hash = md5($password);
	$user_id = $email_id;
	$query = "SELECT `id` from `user_det` WHERE `email_id`='$email_id'";
		
		if($query_run = mysqli_query($con,$query)){
			
			$num_rows = mysqli_num_rows($query_run);
			if($num_rows > 0){
				$row = mysqli_fetch_assoc( $query_run );
				$user_id = $row['id'];
			}

		}

	$chk = 0;
	$result1 = array();
    	$result1['resultcode']    = 1;
	if(!empty($user_id)){
			
		
				//echo "Ïnvalid username/password combination!";
		$sqlnew="INSERT INTO `request_pickup`(`user_id`,`sp_id`,`start_date`,`end_date`,`pickup_time`,`frequency`) ".
		"VALUES ".
		"('$user_id','$sp_id', '$start_date','$end_date','$pickup_time','$frequency')";
				
		$newentry=mysqli_query($con,$sqlnew);	
		
		if(!$newentry)
		{		
			$result1['resultcode']    = 0;		
			$chk=1;
			
			die('Failed: ' . mysql_error());
		}
		///$pk =  mysqli_insert_id($con);

			}
		else{
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