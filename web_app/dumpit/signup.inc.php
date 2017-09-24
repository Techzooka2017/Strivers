<?php
	//require_once 'includes/connfig.php';
	include 'includes/config.php';
	require_once 'core.inc.php';
	if(isset($_POST['email_id']) && isset($_POST['password'])){
		$name = $_POST['name'];
		$pass = $_POST['password'];
		$pass_hash = md5($pass);
		$email_id = $_POST['email_id'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$user_base = $_POST['user_base'];

		if(!empty($email_id) && !empty($pass)){
			
			$query = "SELECT `id` from `service_provider` WHERE `email_id`='$email_id'";
			
			if($query_run = mysqli_query($con,$query)){
				
				$num_rows = mysqli_num_rows($query_run);

				if($num_rows ==0){
					//echo "Ïnvalid username/password combination!";
					$sqlnew="INSERT INTO `service_provider`(`email_id`,`name`,`address`,`contact`,`password`,`user_base`) ".
					"VALUES ".
					"('$email_id','$name', '$address','$contact','$pass_hash','$user_base')";
							
					$newentry=mysqli_query($con,$sqlnew);

					if(!$newentry)
					{
						
						die('Failed: ' . mysql_error());
					}
					// $user_id = $newentry;
					// $_SESSION['user_id'] = $user_id ;
					header('Location: loginform.inc.php');
				}else{ 
					echo "User already exists";
					header('Location: loginform.inc.php');
				}
			} else {
				echo "Some error at server";
			}	
		}else {
			echo "You have to supply username or password";
		}
	} else {
		//echo "Nopz";
	}
?>

<!--<form action="<?php //echo $current_file ; ?>" method = "POST">
	Username : <input type = "text" name = "username">
	Password : <input type = "password" name = "password">
	<input type = "submit" value = "Log in">
</form> -->

<html lang="en">
<head>
  <title>Dumpit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="./js/jquery.min.js"></script>
  		<script src="./js/bootstrap.min.js"></script>
  		<link rel="stylesheet" href="./css/bootstrap.min.css">

  		<script type="text/javascript" src="./queries.js"></script>
</head>
<body>
<!-- <center><img src="images/clean.png" class="img-rounded" alt="DumpIt" width="60%" height="auto" style="max-height:260px;"></center> -->
<center>
<div class="container">
	<h2>Sign up as Admin </h2>
	<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
  <form role="form" action="<?php echo $current_file ; ?>" method = "POST">
    <div class="form-group">
      <input type="text" class="form-control" name="email_id" placeholder="Enter Email">
    </div>
    <div class="form-group">
      
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>

    <div class="form-group">
      
      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
    </div>

    <div class="form-group">
    	<label for="comment">Address:</label>
  		<textarea class="form-control" rows="3" id="comment" name= "address"></textarea>
	</div>

	<div class="form-group">
      
      <input type="text" class="form-control" id="contact" placeholder="Enter contact no" name="contact">
    </div>

    
    	<p>Select type of service you provide for: </p>
    	<label class="radio-inline"><input type="radio" value = "INDIVIDUAL" name="user_base">INDIVIDUAL</label>
		<label class="radio-inline"><input type="radio" value="ORGANISATION" name="user_base">ORGANISATION</label>
		<label class="radio-inline"><input type="radio" value = "BOTH" name="user_base">BOTH</label>
		<p><br></p>

    <button type="submit" class="btn btn-default">Sign Up</button><br>

    <a href="loginform.inc.php"><h3 style="color: #274D8E">Already an admin! Sign In</h3></a>
  </form>
</div>
</div>
</center>

</body> 
</html>