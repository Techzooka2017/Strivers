<?php
	include 'includes/config.php';
	//require_once 'core.inc.php';
	require_once 'core.inc.php';

	$email_id=mysqli_real_escape_string($con,urldecode($_POST['list']));

	// $json = json_decode(file_get_contents('php://input'), true);

	// $email_id = $json['email_id'];
	// $password = $json['password'];

	//echo $
	//echo $email_id;

	$chk = 0;
	$result = array();
    $result['status']    = array();
    // $result['name'] = array();
    // $result['price'] = array();
    // $result['contact'] = array();
    // $result['provider']['name'] = array();
    // $result['provider']['price'] = array();
    // $result['provider']['contact'] = array();
    //$result['provider'] = array();

	if(!empty($email_id)){
			
		$query = "SELECT `id`, `name`, `price`, `contact` from `service_provider`";
		
		if($query_run = mysqli_query($con,$query)){
			
			$num_rows = mysqli_num_rows($query_run);


			if($num_rows >=1){
				//echo "Ïnvalid username/password combination!";
				$rows = array();
				$result['status'] = 1;
				while ($row = mysqli_fetch_assoc( $query_run )) {
					$rows[] = $row;
				}

				$result['provider'] = $rows;

			}else{
				$result['status']    = 0;
			}
		}else{
			$result['status']    = 0;
			$chk = 1;
		}
	}else {
		$result['status']    = 0;
		$chk = 1;
	}

	echo json_encode($result);

 ?>