<?php
  $filepath = realpath(dirname(__FILE__));
  include_once $filepath.'/../../lib/Session.php';
  Session::init();
 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Register System php</title>

    <!-- Bootstrap -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="inc/bootstrap.min.css"/>
    <script src="inc/jquery.min.js"></script>
    <script src="inc/bootstrap.min.js"></script> -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <?php
        if(isset($_GET['action']) && $_GET['action'] == "logout"){
          Session::destroy();
        }

   ?>





  <body>

    <div class="container">
       <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Login register System php</a>
          </div>
          <ul class="nav navbar-nav pull-right">


            <?php

              $id= Session::get("id");
              $userlogin=Session::get("login");
              if($userlogin == true ){
             ?>
             <li> <a href="index.php">Home</a> </li>
            <li> <a href="profile.php?id=<?php echo $id ?>">Profile</a> </li>
            <li> <a href="?action=logout">logout</a> </li>

          <?php }else{
             ?>
             <li> <a href="login.php">Login</a> </li>
            <li> <a href="register.php">Register</a> </li>
          <?php } ?>
          </ul>
        </div>
      </nav>
