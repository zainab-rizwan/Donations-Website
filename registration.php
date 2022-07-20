<?php
require('db_connection.php');
include('auth.php');
if (isset($_REQUEST['username'])){
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn,$username); 
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn,$email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn,$password);
    $pass=md5($password);

    $sql1="INSERT into admin (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql1); 
    $stmt->bind_param("sss", $username, $pass, $email);
    $result1 = $stmt->execute();
  //  $result1 = $stmt->get_result();

    if($result1)
    {
        echo
            $_SESSION['message'] = "You are registered successfully."; 
            $_SESSION['msg_type'] = "success";
            header('location: dashboard.php');
    }  
}
    else{

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
<title>Sign Up</title>
<style type="text/css">
html {
     height: 100%;
     width: 100%;
 }

 body {
     background: url("images/top-bg-2.jpg") no-repeat center center fixed;
     background-size: cover;

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
     margin: 7rem;
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

 /***********Input fields***********/
 input[type="submit"] {
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

 input[type="submit"]:hover {
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

 input[type="text"]:focus,
 input[type="email"]:focus,
 input[type="password"]:focus {
     outline: 0;
     border-color: transparent;
     border: 1px solid white;

 }

 ::placeholder {
     color: #d3d3d3;
 }

</style>
</head>
<body>
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
  <!-----------Registration Form------------>
<div style="display:flex; justify-content: center;">
 <div id="container" class="form">
         <h3>Register</h3>
         <form name="registration" action="" method="post">
            <fieldset>
               <br/>
               <input type="text" name="username" id="username" placeholder="Username" required autofocus>
               <br/><br/>
               <input type="email" name="email" id="email" placeholder="Email" required>
               <br/><br/>
               <input type="password" name="password" id="password" placeholder="Password" required>
               <br/><br/>
               <label for="submit"></label>
               <input type="submit" name="submit" value="Register"/>
               <br><br>
            </fieldset>
         </form>
      </div>
  <?php }; ?>
</div>
</body>
</html>