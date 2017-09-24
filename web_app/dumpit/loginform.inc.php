<?php
	//require_once 'includes/connfig.php';
	include 'includes/config.php';
	require_once 'core.inc.php';
	if(isset($_POST['email_id']) && isset($_POST['password'])){
		$email_id = $_POST['email_id'];
		$pass = $_POST['password'];
		$pass_hash = md5($pass);

		if(!empty($email_id) && !empty($pass)){
			
			$query = "SELECT `id` from `service_provider` WHERE `email_id`='$email_id' AND `password`='$pass_hash' ";
			
			if($query_run = mysqli_query($con,$query)){
				
				$num_rows = mysqli_num_rows($query_run);

				if($num_rows ==0){
					echo "Ïnvalid username/password combination!";
				}else if($num_rows == 1){
					// $user_id = mysql_result($query_run, 0, 'id');
					while($row = mysqli_fetch_assoc($query_run)) {
					   $user_id = $row['id'];
					   $_SESSION['user_id'] = $user_id ;
					}
					//$_SESSION['user_id'] = $user_id ;
					header('Location: index.php');
				}
			} else {
				//echo "Nooooo";
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
<!-- <center><img src="images/clean.png" class="img-rounded" alt="CleanIt" width="60%" height="auto" style="max-height:260px;"></center> -->
<center>
<div class="container">
	<h2>Log in to Admin Panel</h2>
	<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
  <form role="form" action="<?php echo $current_file ; ?>" method = "POST">
    <div class="form-group">
      <input type="text" class="form-control" name="email_id" placeholder="Enter email_id">
    </div>
    <div class="form-group">
      
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    <button type="submit" class="btn btn-default">Log in</button>
  </form>
</div>
</div>
</center>

</body>
</html>