<?php
session_start();
session_unset();
session_destroy();

echo "<script>alert('The profile has been deleted.');</script>";
header("location: login.php");
exit();
?>


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<style type="text/css">
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
</body>
</html>