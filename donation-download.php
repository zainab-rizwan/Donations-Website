<?php
session_start();
require_once('db_connection.php');

if (isset($_POST["donation-info"]))
{
   $title = $_POST['title'];   
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $address = $_POST['address'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
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
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Donations</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
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
        font-family: 'Varela Round', sans-serif;
        font-size: 18px;
      }


      #main
      {
        margin: 8% 5% 8% 5%;
        height: 100%;
        padding-bottom: 2em;
        border: 1px solid #d0cdd1;
        border-radius: 2em;
        border-top: none;
        display: block;

      }
   
      .rectangle
      {
        border-radius: 2em 2em 0em 0em;
        margin-bottom: 5%;
        position: relative;
        padding: 10px;
        color: white;
        background: #435d7d;
      }

      .form-group
      {
        margin: 4% 8% 4% 8%;
        padding: 1em;
        text-align: left;
      }

      .form-control
      {
        margin-bottom: 1%;
      }

     
</style>
  
</head>
<body>
  <div id="main">
      <div class="rectangle">
        <br>
        <h1 style="padding: 10px;" id="title"> Thank You <?php echo $fname, " ", $lname ?>!</h1>
        <br>
      </div>

          <div class="form-group">
              <h3>Here is your payment code:<b> 1102200005434</b></h3>
              <hr>
              <h4>You can donate via either:</h4>

              <ul>
                <li><b>IBFT:</b></li>
                <p>Through your ABL, Askari, BAFL, BAHL, FBL, Meezan or SCB internet banking portal, add bill payee UET and enter your payment code to pay</p>

                <li><b>ATM:</b></li>
                </p>At any 1LINK ATM, select bill payment, select bill payee (Education - UET), and enter your payment code to pay.</p>

                <li><b>Bank Deposit:</b></li>
                </p>Donate to UET through cash, pay order or bank drafts made in favor of "University of Engineering and Technology" at any branch of ABL, Meezan or BAHL Banks in Pakistan.</p>
              </ul>
              <br>
              <p>To download your donation challan, please <a href="">click here</a></p>
          </div>
      </h3>
  <div>




</body>




</html>