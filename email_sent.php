<?php
require('db_connection.php');
include('auth.php');
header("Cache-Control: no cache");

$emailr = $_SESSION["emailr"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Reset Password</title>
<style type="text/css">
html {
     height: 100%;
     width: 100%;
 }

 body {
     background: url("images/top-bg-2.jpg") no-repeat center center fixed;
     background-size: cover;

 }
 /******************Navbar******************/
   ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #e7e7e7;
    background-color: white;
  }

  li {
    float: right;
  }

  li a {
    display: block;
    color: #666;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  li a:hover:not(.active) {
    background-color: #ddd;
  }

  li a.active {
    color: white;
    background-color: #04AA6D;
  }
  
 /***********Alerts***********/
 .alert
  {
      padding: 20px;
      background-color: #f44336; /* Red */
      color: white;
      margin-bottom: 15px;
  }

/***********Registration form***********/
 #container {
     background-color: black;
     padding: 3em;
     opacity: 0.75;
     width: 0 auto;
     width: 70%;
     margin: 8rem;
 }

 h3 {
     text-align: center;
     vertical-align: middle;
     line-height: 3rem;
     height: 3rem;
     color: white;
 }

 fieldset {
     border: 0;
     text-align: center;
 }

 p
 {
  color: white;
  margin-bottom: 1em;
  word-wrap: break-word;
  text-align: center;
  margin-left: 25%;
  margin-right: 25%;
 }

 /***********Input fields***********/
 input[type="button"] {
     border: 1px solid black;
     display: block;
     width: 12em;
     height: 3em;
     margin: 0 auto;
     color: black;
     background-color: white;
     padding: 0.7rem;
     cursor: pointer;
     border-radius: 15px;
 }

 input[type="button"]:hover {
     background-color: black;
     color: white;       
     border: 1px solid white;
 }

 input {
     background: transparent;
     border-bottom: 1px solid white;
     border-top: 0;
     border-left: 0;
     border-right: 0;
     padding: 10px;
     width: 25rem;
     color: white;
 }



 ::placeholder {
     color: #d3d3d3;
 }

 /***********Alert************/
   .alert-success
   {
    background-color: #39C16C ;
   }

</style>
</head>
<body>
  <!---------Navbar-------->
  <ul>
      <li><a href="logout.php">Logout</a></li>
    <li><a href="dashboard.php"><?php echo $_SESSION['username']; ?></a></li>
  </ul>

  <!-----------Alert------------>
   <?php if (isset($_SESSION['message'])): ?>
  <div class="alert alert-<?=$_SESSION['msg_type']?>" >
    <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
  </div>
  <?php endif ?>
    <br>

  <!-----------Reset Password------------>
  <br>
<div style="display:flex; justify-content: center;">
 <div id="container" class="form">
         <h3>Email Sent</h3>
         <form name="reset_password" action="" method="post" style="text-align: center;">
            <fieldset>
               <br>
               <p>An email has been sent to <strong><?php echo $emailr ?></strong>. Please check your mailbox for an email to reset your password.</p>
               <br>
               <input type="button" name="submit" onclick="location.href='reset_password_req.php';" value="Go Back"/>
               <br><br>
            </fieldset>
         </form>
      </div>
      <a href="reset_password.php" style="color: white;">Test Link</a>
</div>
</body>
</html>