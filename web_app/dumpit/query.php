<?php
	require_once 'core.inc.php';
	require_once './includes/config.php';
	//require_once './twilio-php/Twilio/autoload.php'; // Loads the library 


	if(loggedin())
	{

		// $lis = $_POST['items'];
	 //  $liarray = explode("::", $lis);
	 //  foreach ($liarray as $colony) {
	 //    # code...
	 //    $sqlnew="INSERT INTO `Cities_Colonies`(`city`,`colony`) ".
	 //  "VALUES ".
	 //  "('Aurangabad','$colony')";
	 //  	$newentry=mysqli_query($con,$sqlnew);	
		// if(!$newentry)
		// {				
		// 	echo "0";
		// 	die('Failed: ' . mysql_error());
		// }else{
		// 	echo "1";
		// }
	
	 //  }

		if (isset($_POST['done'])) {
		$f0_submitted = (int) $_POST['f0'];
		$query_update = "UPDATE request_pickup SET status='1' WHERE id ='$f0_submitted'";
		$result_update=mysqli_query($con,$query_update);
		echo "YES";
		#header('Location: home.php');
		}

		if (isset($_POST['confirm'])) {
		$fs_submitted = (int) $_POST['f0'];
		$query_update1 = "UPDATE request_pickup SET is_confirm='1' WHERE id ='$fs_submitted'";
		$result_update1=mysqli_query($con,$query_update1);
		echo "YES";
		#header('Location: home.php');
		}


		if (isset($_POST['reject'])) {
		$f0_submitted = (int) $_POST['f0'];
		$query_update = "UPDATE request_pickup SET status='2' WHERE id ='$f0_submitted'";
		$result_update=mysqli_query($con,$query_update);
		echo "YES";
		#header('Location: home.php');
		}

		// send msg and save to database
		if ($_POST['submit']) {
				$ft_submitted = (int) $_POST['ft'];
		        $text = mysqli_real_escape_string($con,$_POST['comments']);
		        $query="UPDATE requests SET solution='$text' WHERE id ='$ft_submitted'";
		        //$query="INSERT INTO report_list (type) VALUES ('$text')";
		        mysqli_query($con,$query) or die ('Error updating database' . mysqli_error());

		        $query1 = "SELECT mobile from user where id in(select user_id from requests where id = '$ft_submitted')";

		        //mysqli_query($con,$query) or die ('Error updating database' . mysqli_error());
		        $mobile = "+91";
		        if($query_run = mysqli_query($con,$query1)){
				
					$num_rows = mysqli_num_rows($query_run);

					if($num_rows ==0){
						echo "Ïnvalid username/password combination!";
					}else if($num_rows == 1){
					// $user_id = mysql_result($query_run, 0, 'id');
						while($row = mysqli_fetch_assoc($query_run)) {
						   $mobile.= $row['mobile'];
						}
						
					}
				} else {
					//echo "Nooooo";
				}	

				////   message sending code
				// require './vendor/autoload.php';
				// use \Twilio\Rest\Client; 
 
				// $account_sid = 'AC6350acf9811560460afb80b2ebf3ce3d'; 
				// $auth_token = 'd197dd30641e7bc754d002e8c8a7020e'; 
				// $client = new Client($account_sid, $auth_token); 
				 
				// // $messages = $client->accounts("AC6350acf9811560460afb80b2ebf3ce3d") 
				// //   ->messages->create($mobile, array( 
				// //         'From' => "+12567438399",  
				// //         'Body' => $text,      
				// //   ));


				// $message = $client->messages->create(
				//   $mobile, // Text this number
				//   array(
				//     'from' => '+125674383999', // From a valid Twilio number
				//     'body' => 'Hello from Twilio!'
				//   )
				// );
				// print $message->sid;
		        echo "YES";
		 		#header('Location: home.php');
		}

		if (isset($_POST['undos'])) {
		$fus_submitted = (int) $_POST['fus'];
		$query_update = "UPDATE requests SET is_spam='0' WHERE id ='$fus_submitted'";
		$result_update=mysqli_query($con,$query_update);
		#header('Location: spam.php');
		}

		if (isset($_POST['undod'])) {
		$fud_submitted = (int) $_POST['fud'];
		$query_update = "UPDATE requests SET is_done='0' WHERE id ='$fud_submitted'";
		$result_update=mysqli_query($con,$query_update);
		#header('Location: spam.php');
		}

		if (isset($_POST['remove'])) {
		$fr_submitted = (int) $_POST['fr'];
		// $img = $fr_submitted.'.jpg';
		// unlink('images/'.$img);
		$query_del1 = "DELETE FROM  request_pickup WHERE id ='$fr_submitted'";
		$result_del1=mysqli_query($con,$query_del1);
		
		//echo 'entry with id = '.$fs_submitted.'removed from database';
		#header('Location: spam.php');
		}
		mysqli_close();
	}

		//  select in given radius
		// first create a view using this query than fetch only ids 
		// SELECT
		//   id, (
		//     6371 * acos (
		//       cos ( radians(26.5115) )
		//       * cos( radians( latitude ) )
		//       * cos( radians( longitude ) - radians(80.2334) )
		//       + sin ( radians(26.5115) )
		//       * sin( radians( latitude ) )
		//     )
		//   ) AS distance
		// FROM report_list
		// HAVING distance < 5
		// ORDER BY distance
		// LIMIT 0 , 20;
		?>