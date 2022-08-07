<?php
require('db_connection.php');
include('auth.php');
header("Cache-Control: no cache");
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

  input[type="password"]
  {
    margin-bottom: 2em;
  }

 input[type="password"]:focus, {
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

<?php
if (isset($_GET["token"]) && isset($_GET["emailr"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"]))
{
  $token = $_GET["token"];
  $emailr = $_GET["emailr"];
  $curDate = date("Y-m-d H:i:s");

  $sql = "SELECT * FROM password_reset where token=? and email=?";
  $stmt = $conn->prepare($sql); 
  $stmt->bind_param("ss",$token, $emailr);
  $stmt->execute();
  $result = $stmt->get_result();
  if(mysqli_num_rows($result) == 0)
  {
    $_SESSION['message'] = 'Invalid Link. Either the link copied was incorrect or this token has been already used before, in which case it has been deactivated.';
    $_SESSION['msg_type'] = "Error";
    header('location: reset_password_req.php');
  
  }
  else
  {
    while ($row = mysqli_fetch_assoc($result)) 
      {
        $expiry = $row['expiry'];
        if ($expiry >= $curDate)
        {
?>

<div style="display:flex; justify-content: center;">
 <div id="container" class="form">
         <h3>Reset Password</h3>
         <form name="update" action="" method="post" style="text-align: center;">
            <fieldset>
               <br>
               <input type="hidden" name="action" value="update"/>
               <input type="hidden" name="emailr" value="<?php echo $emailr;?>">
               <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
               <input type="password" name="new_pass" id="new_pass" placeholder="New Password" required>
               <br>
               <input type="password" name="con_pass" id="con_pass" placeholder="Confirm Password" required>
               <br><br><br>
               <input type="submit" name="submit" value="Reset Password"/>
               <br>
            </fieldset>
         </form>


      </div>
</div>
</body>
</html>

<?php       
  }
    else
    {
        $_SESSION['message'] = 'This link has been expired. Enter your email address to receive a new link.';
        $_SESSION['msg_type'] = "Error";
        header('location: reset_password_req.php');
    }
  }
  }
} 


if(isset($_POST["emailr"]) && isset($_POST["action"]) && ($_POST["action"]=="update"))
{
  echo "kijuhygfghjkioiuhygfcvbjhghjkjhgvcvbnhjk";
  $new_pass = mysqli_real_escape_string($conn,$_POST["new_pass"]);
  $con_pass = mysqli_real_escape_string($conn,$_POST["con_pass"]);
  $emailr = $_POST["emailr"];
  $curDate = date("Y-m-d H:i:s");
  if ($new_pass!=$con_pass)
  {
    echo "error";
  }
  else
  {
    $new_pass = md5($new_pass);
    //update password
    $query = "UPDATE admin SET password=? WHERE email=?";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("ss",$new_pass, $emailr);
    $stmt->execute();

    //delete entry from temporary table
    $query2 = "DELETE FROM password_reset WHERE email=?";
    $stmt = $conn->prepare($query2); 
    $stmt->bind_param("s", $emailr);
    $stmt->execute();
    $_SESSION['message'] = "Your password has been successfully reset. Login again with your new password"; 
    header("Location: logout.php");
  
  }

}?>