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
}
else
{
  header('location: donation-2.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Donations</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="styleshaeet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='jquery-3.2.1.min.js'></script>

  <style type="text/css">

  body
    {
      text-align: center;
      font-family: 'Varela Round', sans-serif !important;
      font-size: 18px;
    }

   /***************Top section***************/
  .section-top-bg {
    width: 100%;
    height: 350px;
    background-image: url(images/top-bg-1.jpg);
    background-size: cover;
    background-position: 50.00% 85.00%;
    overflow: hidden;
    }

  .intro-div {
      width: 95% !important;
      background-color: white;
      margin-top: 170px;
      padding: 2% 9% 2% 9%;
      margin-left: auto;
      margin-right: auto;
      word-wrap: break-word;
      text-overflow: ellipsis;     
  }
  .intro-div h1{
      text-align: center;
      color: #04198B;
      padding-bottom: 1%;
  }
   p{
      font-size: 18px;

  }

  /***************Introductory***************/
  .form-group
  {
    margin: 1% 8% 0% 8%;
    padding: 1em;
    text-align: left;
  }

  .form-control
  {
    margin-bottom: 1%;
  }

  /***************Footer***************/
  footer
  {
    background-color:#435d7d;
    color: white;
    padding: 1em;
  }

  /***************Table***************/
  th
  {
    text-align: center;
  } 

  .table-wrapper
  {
     display: inline-block; 
     float: left; 
  }
</style>
  
</head>
<body>

<!----------Top Section------------>
    <section class="section-top-bg" id="secMain">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="intro-div">
                    <br>
                    <h1><b>Thank You <?php echo $fname . " " . $lname ; ?>!</b></h1>
                    <br>                
                </div>
            </div>
        </div>
    </section>

<!----------Introductory------------>
<div id="main">
      <div class="form-group">
          <h3>Here is your payment code:<b><?php echo $inv_id ?></b></h3>
          <hr>
            <p>Thank you for your generous donation to U.E.T. We truly appreciate your commitment. </p>
            <p>To download your donation challan, please <a href="invoice.php" id="create_pdf">click here</a></p>
      </div>
  <div>
</div>

<!----------Bank Information------------>
<div class="container">
        <div class="table-wrapper">
          <!----------Table 1----------->
            <table class="table table-hover table-bordered " style="text-align: center; float: right;">
              <thead>
                  <tr>
                      <th>Account Title</th>
                      <th>UET Lahore Alumni Fund</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>Account Number</td>
                    <td>01287903038101</td>
                  </tr> 
                  <tr>
                    <td>Bank name</td>
                    <td>Habib Bank Account</td>
                  </tr>
                  <tr>
                    <td>Bank Address</td>
                    <td>UET, Lahore</td>
                  </tr>
                  <tr>
                    <td>IBAN</td>
                    <td>PK27HABB0001287903038101</td>
                  </tr>
                  <tr>
                    <td>Swift Code</td>
                    <td>HABBPKKA</td>
                  </tr> 
                   <tr>
                    <td>Branch Code</td>
                    <td>0128</td>
                  </tr>                              
              </tbody>
            </table>
            <!----------Table 2------------>
            <table class="table table-hover table-bordered " style="text-align: center;">
              <thead>
                  <tr>
                      <th>Account Title</th>
                      <th>UET Zakat Fund</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>Account Number</td>
                    <td>01280035900301</td>
                  </tr> 
                  <tr>
                    <td>Bank name</td>
                    <td>Habib Bank Account</td>
                  </tr>
                  <tr>
                    <td>Bank Address</td>
                    <td>UET, Lahore</td>
                  </tr>
                  <tr>
                    <td>IBAN</td>
                    <td>PK27HABB0001287903038101</td>
                  </tr>
                  <tr>
                    <td>Swift Code</td>
                    <td>HABBPKKA</td>
                  </tr> 
                   <tr>
                    <td>Branch Code</td>
                    <td>0128</td>
                  </tr>                              
              </tbody>
            </table>
        </div>
    </div>
</div>
<footer>Footer</footer>
</body>
</html>

