<?php 
	error_reporting(E_ERROR);
	include 'includes/config.php';
        require_once 'core.inc.php';
	//require_once 'includes/config.php';
	$loc=mysqli_real_escape_string($con,urldecode($_POST['location']));
	$description=mysqli_real_escape_string($con,urldecode($_POST['description']));
	$type=mysqli_real_escape_string($con,urldecode($_POST['type']));
	//$pincode=mysqli_real_escape_string($con,urldecode($_POST['pincode']));
	$request=mysqli_real_escape_string($con,urldecode($_POST['request']));
	$lat = mysqli_real_escape_string($con,$_POST['latitude']);
	$lang = mysqli_real_escape_string($con,$_POST['longitude']);

	$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lang).'&sensor=false';
	$json = @file_get_contents($url);
	$data=json_decode($json);
	$status = $data->status;
	if($status=="OK"){
		$or = 'or';
		$location = $loc."\n".$or."\n".$data->results[0]->formatted_address;
	}
	else
	{
	 $location = $loc;
	}
						
	//$image=$_REQUEST['image'];
	//if($pincode == 431133){
	$image=$_REQUEST['image'];
	$sqlnew="INSERT INTO `report_list`(`location`,`latitude`,`longitude`, `description`,`type`,`request`) ".
	"VALUES ".
	"('$location','$lat', '$lang','$description','$type',$request)";
			
	$newentry=mysqli_query($con,$sqlnew);	
	$chk = 0;
	if(!$newentry)
	{				
		$chk=1;
		die('Failed: ' . mysqli_error($con));
	}
	$pk =  mysqli_insert_id($con);
			
	if(!empty($image))
	{
		$img1=base64_decode($image);
	}	
	header('Content-Type: bitmap; charset=utf-8');
			
	if(!empty($image))
	{
		$file = fopen('images/'.$pk.'.jpg', 'wb');
		fwrite($file, $img1);
		fclose($file);
		if($chk==0){
			echo "1";
		}
		else{
			echo "0";
		}
	}
//}else{
	//echo 1;
//}

?>			