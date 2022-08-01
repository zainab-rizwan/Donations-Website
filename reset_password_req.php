<?php
require('db_connection.php');
include('auth.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


if (isset($_POST['emailr'])){ 
  $emailr = ($_POST["emailr"]);
  $emailr = filter_var($emailr, FILTER_SANITIZE_EMAIL);
  $emailr = filter_var($emailr, FILTER_VALIDATE_EMAIL);
  $_SESSION['emailr'] = $emailr;


  $sql =("SELECT * FROM admin WHERE email=?");
  $stmt = $conn->prepare($sql); 
  $stmt->bind_param("s", $emailr);
  $stmt->execute();
  $result = $stmt->get_result();

  if(mysqli_num_rows($result) > 0)
  {    
      $token = md5((2418*2).$emailr);
      $addKey = substr(md5(uniqid(rand(),1)),3,10);
      $token = $token . $addKey;
      $_SESSION['emailr'] = $emailr;
      $_SESSION['token'] = $token;
 
      $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
      $expiry = date("Y-m-d H:i:s",$expFormat);
      
      $sql1="INSERT into password_reset (email, token, expiry) VALUES (?, ?, ?)";

      $stmt = $conn->prepare($sql1); 
      $stmt->bind_param("sss", $emailr, $token, $expiry);
      $result1 = $stmt->execute();
      if($result1)
      {
        $mail = new PHPMailer();    
        $mail->IsSMTP(); 
        $mail->Host = "smtp.gmail.com"; 
        $mail->SMTPAuth = true;   
        $mail->SMTPSecure = 'tls';                            
        $mail->Username = 'zainabriz0027@gmail.com';               
        $mail->Password = 'ekfikyfkpjyrxsgr';                     
        $mail->Port = 587;                                   
        $mail->setFrom($emailr);
        $mail->addAddress($emailr);                            

        $mail->isHTML(true);                                       
        $mail->Subject = 'Reset Password';
        $output='<p>A request has been received to reset the password for your account.</p>';
        $output.='<p>Please click on the following link to reset your password.</p>';
        $output.='<hr>';
        $output.='<p><a href="http://localhost/donate/reset_password.php?token='.$token.'&emailr='.$emailr.'&action=reset" target="_blank">http://localhost/donate/reset_password.php?token='.$token.'&emailr='.$emailr.'&action=reset</a></p>';   
        $body = $output; 
        $mail->Body  = $body;

        if(!$mail->Send())
        {
          $_SESSION['message'] = "Error" .$mail->ErrorInfo;
          $_SESSION['msg_type'] = "Error";
          header('location: reset_password_req.php');
        }
        else
        {
          $_SESSION['message'] = "Email Sent"; 
          $_SESSION['msg_type'] = "success";
          header('location: email_sent.php');
        }
      }     
      else
      {      
        $_SESSION['message'] = "An error occured";
        $_SESSION['msg_type'] = "Error";
        header('location: reset_password_req.php');
      }
   }
  else
  {
     echo
        $_SESSION['message'] = "Email does not exist.";
        $_SESSION['msg_type'] = "error"; 
        header('location: reset_password_req.php');
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
     margin: 6rem;
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

  input[type="email"]
  {
    margin-bottom: 2em;
  }

 input[type="email"]:focus, {
     outline: 0;
     border-color: transparent;
     border: 1px solid white;

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
  <!-----------Navbar------------>
  <ul>
      <li><a href="logout.php">Logout</a></li>
    <li><a href="dashboard.php"><?php echo $_SESSION['username']; ?></a></li>
  </ul>
  <!------------Alert------------>
   <?php if (isset($_SESSION['message'])): ?>
  <div class="alert alert-<?=$_SESSION['msg_type']?>" >
    <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
  </div>
  <?php endif ?>
    <br>
  <!--------Reset Password--------->
  <br>
<div style="display:flex; justify-content: center;">
 <div id="container" class="form">
         <h3>Reset Password</h3>
         <form name="reset" action="" method="post" style="text-align: center;">
            <fieldset>
               <br>
               <p>Please enter your email address. You will receive a link to create a new password via email.</p>
               <br>
               <input type="email" name="emailr" id="emailr" placeholder="Email" required>
               <br><br>
               <input type="submit" name="submit" value="Reset Password"/>
               <br><br>
            </fieldset>
         </form>
      </div>
  <?php }; ?>
</div>
</body>
</html>