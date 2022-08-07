<?php
session_start();
require_once('db_connection.php');
header("Cache-Control: no cache");

if(isset($_POST["donation-info"])  && !empty($_POST))
{

  $title = $_POST['title'];   

  $fname = stripslashes($_REQUEST['fname']);
  $fname = mysqli_real_escape_string($conn,$fname);

  $lname = stripslashes($_REQUEST['lname']);
  $lname = mysqli_real_escape_string($conn,$lname);

  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn,$email);

  $phone = stripslashes($_REQUEST['phone']);
  $phone = mysqli_real_escape_string($conn,$phone);

  $address = stripslashes($_REQUEST['address']);
  $address = mysqli_real_escape_string($conn,$address);

  $city = stripslashes($_REQUEST['city']);
  $city = mysqli_real_escape_string($conn,$city);

  $state = stripslashes($_REQUEST['state']);
  $state = mysqli_real_escape_string($conn,$state);

  $country = stripslashes($_REQUEST['country']);
  $country = mysqli_real_escape_string($conn,$country);

  $paytype = $_POST['paytype'];

  $_SESSION['title'] = $title;
  $_SESSION['fname'] = $fname;
  $_SESSION['lname'] = $lname;
  $_SESSION['email'] = $email;   
  $_SESSION['phone'] = $phone;
  $_SESSION['address'] = $address;
  $_SESSION['city'] = $city;
  $_SESSION['state'] = $state;
  $_SESSION['country'] = $country;
  $_SESSION['paytype'] = $paytype;

  $currency = $_SESSION['currency'];
  $affiliation = $_SESSION['affiliation'];
  $total= $_SESSION['total'];
  $date = date('Y-m-d');
  $pid_amount= $_SESSION['pid_amount'];
  $pid_bid= $_SESSION['pid_bid'];

  //Insert into users
  $user_id = 0;
  $sql1 = "INSERT INTO users (user_id, title, fname, lname, affiliation, email, phone, address, city, state, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql1); 
  $stmt->bind_param("isssssissss", $user_id, $title, $fname, $lname, $affiliation, $email, $phone, $address, $city, $state, $country);
  $result1 = $stmt->execute();

  if ($result1) {
    $user_id = $conn->insert_id;  
  } else {
      echo $conn->error;
  } 

  //Insert into invoice
  $inv_id = 0;
  $sql2 = "INSERT INTO invoice (id, user_id, currency, payment_method, status, dateofinvoice) VALUES (?, ?, ?,?, ?,?)";
  $status='UNPAID';
  $stmt = $conn->prepare($sql2); 
  $stmt->bind_param("iissss", $inv_id, $user_id, $currency, $paytype, $status, $date);
  $result2 = $stmt->execute();

  if ($result2) {
    $inv_id = $conn->insert_id; 
    $_SESSION['inv_id'] = $inv_id;  
  } else {
      echo $conn->error;
  }

  //Insert into invoice_particulars
  $par_inv_id = 0;
  foreach ($pid_amount as $key => $value) {
    $particular_id=$key;
    $amount=$value;
    $batchid= $pid_bid[$particular_id];
    $sql3 = "INSERT INTO `invoice_particulars` (`invoice_particulars_id`, `invoice_id`,`particular_id`,`amount`,`batch_id`) VALUES ('par_$inv_id', '$inv_id','$particular_id','$amount', $batchid)";
     if ($conn->query($sql3) === TRUE) {
      $par_inv_id = $conn->insert_id;   
    } else {
        echo $conn->error;
    }
  } 
  header('location: donation-3.php');
}
else
{
  header('location: donation-2.php');
}
?>