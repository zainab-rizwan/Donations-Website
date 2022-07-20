<?php
require('db_connection.php');
session_start();
if (isset($_POST['username']))
{
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn,$username);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn,$password);
  $pass=md5($password);
  $query = "SELECT * FROM admin WHERE username=? and password=?";
  $stmt = $conn->prepare($query); 
  $stmt->bind_param("ss", $username, $pass);
  $stmt->execute();
  $result = $stmt->get_result();
  $rows = mysqli_num_rows($result);
  if($rows==1)
  {
      $_SESSION['username'] = $username;
      header("Location: dashboard.php");
  }else
  {
  echo 
     $_SESSION['message'] = "Username/password is incorrect."; 
     $_SESSION['msg_type'] = "Error!";
    header('location: login.php');
      }
}else{
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
<title>Sign In</title>
<style type="text/css">
   html {
       height: 100%;
       width: 100%;
   }

   .alert
    {
        padding: 20px;
        background-color: #f44336; /* Red */
        color: white;
        margin-bottom: 15px;
    }

   body {
       background: url("images/top-bg-2.jpg") no-repeat center center fixed;
       background-size: cover;

   }
   /***********Login form************/
   #container {
       background-color: black;
       padding: 3em;
       opacity: 0.75;
       width: 0 auto;
       width: 70%;
       margin: 9rem;
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
   /***********Input Types************/
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

   /***********Alert************/
   .alert-success
   {
    background-color: #39C16C ;
   }

</style>
</head>

<body>
  <!-----------Alerts-------------->
  <?php if (isset($_SESSION['message'])): ?>
  <div class="alert alert-<?=$_SESSION['msg_type']?>" >
    <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
  </div>
  <?php endif ?>
  <br>

  <!-----------Login Form-------------->
  <div style="display:flex; justify-content: center;">
    <div id="container" class="form">
           <h3>Sign In</h3>
           <form name="login" action="" method="post">
              <fieldset>
                 <br/>
                 <input type="text" name="username" id="username" placeholder="Username" required autofocus>
                 <br/><br/>
                 <input type="password" name="password" id="password" placeholder="Password" required>
                 <br/><br/>
                 <label for="submit"></label>
                 <input type="submit" name="submit" value="Login"/>
                 <br><br>
              </fieldset>
           </form>
      </div>
    </div>
<?php } ?>
</body>
</html>