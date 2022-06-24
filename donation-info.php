<?php
session_start();
include 'db_connection.php';

<?php 
   if (isset($_POST["mybutton"]))
   {
       echo $_POST["mybutton"];
   }
?>


