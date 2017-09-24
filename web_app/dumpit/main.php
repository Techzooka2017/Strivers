<?php
	require_once 'core.inc.php';
	require_once 'includes/config.php';
	 if(loggedin()){ 
	 	//echo 'You are not logged in.<a href = "index.php">Go to Login window</a>';
	 	?>
	 	<html>
		<head>
			<title>CleanIt</title>
		<script>
		//document.getElementById("btn").onclick = function() {myFunction()};

		function setColor() {
		    document.getElementById("status").innerHTML = "Actions have been initiated";
		}

		</script>
		<script src="./js/jquery.min.js"></script>
  		<script src="./js/bootstrap.min.js"></script>
  		<link rel="stylesheet" href="./css/bootstrap.min.css">

  		<script type="text/javascript" src="./queries.js"></script>		<script type="text/javascript">

	    function submitdata()
	    {
		
		// var name=document.getElementById( "ta" );
		// //var age=document.getElementById( "age_of_user" );
		// //var course=document.getElementById( "course_of_user" );

		// $.ajax({
		// 		type: 'post',
		// 		url: 'home.php',
		// 		data: {
		// 		actions:name,
		// 		//user_age:age,
		// 		//user_course:course
		// 		},
		// 		success: function (response) {
		// 		alert("Action updated");
		// 		}
		// 	});
		
		// return false;
		
	    }

</script>

		<script type="text/javascript">
    	// var frm = $('#view_admin');
    	// frm.submit(function (ev) {
     //    $.ajax({
     //        type: frm.attr('method'),
     //        //url: frm.attr('action'),
     //        data: frm.serialize(),
     //        success: function (data) {
     //            alert('done');
     //        }
     //    });

     //    ev.preventDefault();
    });
</script>

		</head>
		<body style="background-color:#EEEEEE">
		<div class="wrappers">
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		      <a class="navbar-brand" href="home.php">CleanIt</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav">
		        <li><a href="home.php">Home</a></li>
		        <li><a href="done.php">Done</a></li>
		        <li><a href="spam.php">Spam</a></li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="aboutus.php">About Us</a></li>
		        <li><a href="logout.php">Log out</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
		
		<center><img src="images/clean.png" class="img-rounded" alt="CleanIt" width="60%" height="auto" style="max-height:260px;"></center>
		<center><h1 style="color:#3F51B5">Garbage Section</h1>
		<?php

		//include 'includes/config.php';

		$query="SELECT `id`,`description`,`location`,`action`,`status`,`request`from `report_list` WHERE `spamtrack`='0' AND `status`='0' AND `type`='GARBAGE'";
		//$query="SELECT * FROM report_list";
		$result=mysqli_query($con,$query);
		$num=mysqli_num_rows($result);

		if($num==0){ 
		echo'<div class="col-md-12">
      	<center><h1 style="color:#d2322d">No Entry available till now.</h1></center>
      	<br> 
      	<center><h1 style="color:#d2322d">Once an User will click a pic and sends it using Garbage option of Cleanit App It will be available here.</h1></center>	
      	<br>
      	<center><h1 style="color:#d2322d">For an entry here we will have two options 1.Spam: To mark an entry as spam(example: In case when pic is not a pic of garbage), 2.Done: To mark a entry as Completed task.</h1></center>
      	</div>';
		}

		?>


		<?php

		$i=0;
		while ($row = mysqli_fetch_assoc($result)/*$i < $num */) {

		// $f0=mysql_result($result,$i,"id");
		// $f1=mysql_result($result,$i,"description");
		// $f2=mysql_result($result,$i,"location");
		// $f3=mysql_result($result,$i,"action");
		// $f4=mysql_result($result,$i,"status");
			$f0 = $row['id'];
			$f1 = $row['description'];
			$f2 = $row['location'];
			$f3 = $row['action'];
			$f4 = $row['status'];
			$f5 = $row['request'];
			//$r = "";
			if($f5 == 1){
				$r = "\r\nDustbin is required";
				$f1 .= $r;
			}
		$no=$i+1;
		?>
		<?php echo '<h2><center></center></h2>'; ?>
		<div class="container contain div-<?php echo $f0; ?>">
		<div class="table-responsive">
		<table id="my_table" class="table table-bordered"  style = 'background-color: #ADD8E6'>

		<tr>
		<th>No</th>
		<th>Images</th>
		<th>Description</th>
		<th>Location</th>
		
		<th>Action</th>
		<th>IsSpam</th>
		<th>Status</th>
		</tr>
		<tr>
		 <!-- <td><textarea rows = '5' readonly><?php echo $f0; ?></textarea></td>  -->
		<td align="center"><font face="Arial, Helvetica, sans-serif"><?php echo $no; ?></font></td>
		<?php echo '<td><img src="sg_upload/'.$f0.'.jpg" alt="" style="height:200px;width:320px;" class="image"/></td>';?>
		<!--<td align="center"><font face="Arial, Helvetica, sans-serif" style='<?php if($f1=="Ask for Dustbin") echo "color:#003366"; ?>'><?php echo $f1; ?></font></td> -->
		<td><textarea rows = '5' id="description" readonly ><?php echo $f1; ?></textarea></td> 
		<td><textarea rows = '5' id="location" readonly><?php echo $f2; ?></textarea></td>

		<!--<td align="center"><font face="Arial, Helvetica, sans-serif"><p id = "status" onclick="this.innerHTML='Actions have been taken.';" >No Action has been taken yet.Click here to take action.</p></font></td> -->
		<td align="center">
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="tmp_form" >
    	<textarea name="comments" class="form-control" rows = '5' id = 'ta'><?php echo $f3; ?></textarea>
    	<input type="hidden" name="ft" value="<?php echo $f0; ?>">
    	<img src="./images/ajax-loader.gif" name="wait" style="display:none" class="img-responsive">
    	<button type="submit" class="btn btn-success" name="submit" id="btnsubmit" >Submit</button>
    	<!-- <input name="submit" type="submit" value="submit"/>  -->
		</form>
		</td>
		<td align="center">
		<form id="view_admin1" class="tmp_form" method="post" >
		  <input type="hidden" name="fs" value="<?php echo $f0; ?>">
		  <img src="./images/ajax-loader.gif" name="wait" style="display:none" class="img-responsive">
		  <button type="submit" class="btn btn-warning" name="spam" id="btnspam">Spam</button>
		  <!-- <input type="submit" name="spam" value="Spam" id = "btnspam"> -->
		</form>
		</td>
		<td align="center">
		<form id="view_admin" method="post" class="tmp_form" >
		  <input type="hidden" name="f0" value="<?php echo $f0; ?>">
		  <img src="./images/ajax-loader.gif" name="wait" style="display:none" class="img-responsive">
		  <button type="submit" class="btn btn-default" name = "done" id = "btn" style='<?php if($f4=="1") echo "color:#00ee00"; ?>'>Done</button>
		  <!--<input type="submit" name="done" value="Done" id = "btn" style='<?php if($f4=="1") echo "color:#00ee00"; ?>'> -->
		</form>
		</td>
		</tr>
		</table>
		</div>
		</div>

		<?php
		if (isset($_POST['done'])) {
		$f0_submitted = (int) $_POST['f0'];
		$query_update = "UPDATE report_list SET status='1' WHERE id ='$f0_submitted'";
		$result_update=mysqli_query($con,$query_update);
		header('Location: main.php');}

		if (isset($_POST['spam'])) {
		$fs_submitted = (int) $_POST['fs'];
		$query_update1 = "UPDATE report_list SET spamtrack='1' WHERE id ='$fs_submitted'";
		$result_update1=mysqli_query($con,$query_update1);
		header('Location: main.php');}

		if (isset($_POST['submit'])) {
				$ft_submitted = (int) $_POST['ft'];
		        $text = mysql_real_escape_string($_POST['comments']);
		        $query="UPDATE report_list SET action='$text' WHERE id ='$ft_submitted'";
		        //$query="INSERT INTO report_list (type) VALUES ('$text')";
		        mysqli_query($con,$query) or die ('Error updating database' . mysqli_error());
		 		header('Location: main.php');
		    }

		$i++;
		}

		mysqli_close($con);


		?>
		<!--<center><input type="button" onclick="location.href='logout.php';" value="Log out" class="btn btn-default btn-lg btn-block"/></center>
		-->
		<div>
		</body>
		</html>
		<?php 
      	include './footer.php';
      	?>
	
	
	<?php }?>
	<?php if(!loggedin()){ ?>
		<center>
			<h3>You can't access without Loggedin...! </h3>
			<input type="button" onclick="location.href='index.php';" value="Go to Login window" /></center>
		
  <?php } ?>