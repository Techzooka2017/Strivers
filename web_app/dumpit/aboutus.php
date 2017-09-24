<?php
  require 'core.inc.php';
  require 'includes/config.php';
   if(loggedin()){ 
    ?>
      <html lang="en">
      <head>
        <title>CleanIt</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="./js/jquery.min.js"></script>
      <script src="./js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="./css/bootstrap.min.css">

      <script type="text/javascript" src="./queries.js"></script>
      </head>
      <body style="background-color:#6666ff">
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
                  <li ><a href="home.php">Home</a></li>
                  <li><a href="done.php">Done</a></li>
                  <li><a href="spam.php">Spam</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li class="active"><a href="aboutus.php">About Us</a></li>
                  <li><a href="logout.php">Log out</a></li>
                </ul>
              </div>
            </div>
          </nav>
      <center><img src="includes/images/clean.jpg" class="img-rounded" alt="CleanIt" width="50%" height="auto" style="max-height:220px;"></center>
      <center>
      <div class="container-fluid">
      
      <div class="col-md-12" style="color:#FF8833">
      <h3>DumpIt ushers the advent of a new era by bridging the gap between two revolutionary ideas in India, the "Digital India" initiative . DumpIt is a step towards achieving the vision of the Swachh Bharat Abhiyan and to handle waste effectively which is to accomplish a "Clean and Healthy India" using technology.</h3>
      </div>
      <div class="col-md-12" style="color:#FFFFFF">
        <h3>We at DumpIt provide an effective platform where users can request for garbage pickups  to various service providers. It provides key features like raise a request to pick garbage, users will be made aware using app thus educating each individual we aim to achieve effective management of waste around us.</h3>
      </div>
      <div class="col-md-12">
        <h3 style="color:#0F6D06"> DumpIt promotes cleanliness and sanitation through a mobile application which enables vigilant citizens to request garbage pickups handled by the various service providers. The effect would be holistic development of the surroundings. Effective waste management is need of today, DumpIt is the way to achieve it.</h3>
      </div>
    
      </div>
      </center>
      </div>
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