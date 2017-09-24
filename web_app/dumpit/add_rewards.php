<?php
	include 'includes/config.php';
	//require_once 'core.inc.php';
	require_once 'core.inc.php';

	$email_id=mysqli_real_escape_string($con,urldecode($_POST['email_id']));
	$password=mysqli_real_escape_string($con,urldecode($_POST['password']));
	$pass_hash = md5($password);

	$chk = 0;
	$result1 = array();
	//$result1['status'][] = array();
    $result1['status']    = array();
	if(!empty($email_id)){
			
		$query = "SELECT `id`, `name`, `reward_points` from `user_det` WHERE `email_id`='$email_id' AND `password` = '$pass_hash'";
		
		if($query_run = mysqli_query($con,$query)){
			
			$num_rows = mysqli_num_rows($query_run);

			if($num_rows ==1){
				//echo "Ïnvalid username/password combination!";
				$row = mysqli_fetch_assoc( $query_run );
				$result1['status']   = 1;
				$result1['name'] = $row['name'];
				$result1['reward_point'] = $row['reward_points'];

			}else{
				$result1['status']    = 0;
			}
		}else{
			$result1['status']    = 0;
			$chk = 1;
		}
	}else {
		$result1['status']    = 0;
		$chk = 1;
	}

	echo json_encode($result1);

 ?>