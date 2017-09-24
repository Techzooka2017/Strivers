<?php 
    include 'includes/config.php';
	//require_once 'unirest/src/Unirest.php';
	//include 'includes/config.php';
     require_once 'core.inc.php';
	//require_once 'includes/config.php';

    $json = json_decode(file_get_contents('php://input'), true);
    //echo "string";
    //$json = json_decode($_POST,true);
	// print_r($json);
	// $myfile = fopen("output.txt", "w") or die("Unable to open file!");
	// fwrite($myfile, file_get_contents('php://input'));
	// fclose($myfile);
	//echo $json["id"];

	$mobile = $json['mob_no'];
	$notes = $json['problem_description'];
	$image = $json['image_data'];
						
	$query = "INSERT INTO user (`mobile`) VALUES ('$mobile')";

	$newentry=mysqli_query($con,$query);
	$user_id =  mysqli_insert_id($con);

	$expert_id = rand(1,5);

	$sqlnew="INSERT INTO `requests`(`user_id`,`notes`,`expert_id`) ".
	"VALUES ".
	"('$user_id','$notes', '$expert_id')";
			
	$newentry=mysqli_query($con,$sqlnew);	
	$chk = 0;
	if(!$newentry)
	{				
		$chk=1;
		die('Failed: ' . mysql_error());
	}
	$pk =  mysqli_insert_id($con);
			
	if(!empty($image))
	{
		$img1=base64_decode($image);
		// $bytes = $image;
  //   	$string = implode(array_map("chr", $bytes));
	}	
	header('Content-Type: bitmap; charset=utf-8');
	// if      (substr($string, 0, 4) == "\x89PNG")  header('Content-Type: image/png');
	// else if (substr($string, 0, 2) == "\xFF\xD8") header('Content-Type: image/jpeg');
	// else if (substr($string, 0, 4) == "GIF8")     header('Content-Type: image/gif');
			
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




?>		