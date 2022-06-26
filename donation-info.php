<?php
session_start();
include 'db_connection.php';

if (isset($_POST["donation-info"]))
{
   echo "helloo";
   $title = $_POST['title'];   
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $address = $_POST['address'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];

   $_SESSION['title'] = $title;
   $_SESSION['fname'] = $fname;
   $_SESSION['lname'] = $lname;
   $_SESSION['email'] = $email;   
   $_SESSION['phone'] = $phone;
   $_SESSION['address'] = $address;
   $_SESSION['city'] = $city;
   $_SESSION['state'] = $state;
   $_SESSION['country'] = $country;

   header('location: donation-download.php');
}


?>


