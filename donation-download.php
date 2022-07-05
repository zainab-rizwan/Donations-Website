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
  $total= $_SESSION['total'];
  $date = date('Y-m-d');
  $pid_amount= $_SESSION['pid_amount'];
  $pid_bid= $_SESSION['pid_bid'];

  ###Users
  $user_id = 0;
  $sql1 = "INSERT INTO `users` (`user_id`, `title`,`fname`,`lname`,`affiliation`,`email`,`phone`,`address`,`city`,`state`,`country`) VALUES ( ' $user_id', '$title','$fname', '$lname','$affiliation', '$email','$phone', '$address','$city', '$state', '$country')";
   if ($conn->query($sql1) === TRUE) {
    $user_id = $conn->insert_id;  
  } else {
      echo $conn->error;
  } 

  ###invoice
  $inv_id = 0;

  $sql2 = "INSERT INTO `invoice` (`id`, `user_id`,`currency`,`payment_method`,`status`,`dateofinvoice`) VALUES ( '$inv_id', '$user_id','$currency','$paytype', 'UNPAID','$date')";
   if ($conn->query($sql2) === TRUE) {
    $inv_id = $conn->insert_id; 
    $_SESSION['inv_id'] = $inv_id;  
  } else {
      echo $conn->error;
  }

  ###invoice_particulars
  $par_inv_id = 0;
  foreach ($pid_amount as $key => $value) {
    $particular_id=$key;
    $amount=$value;
    $batchid= $pid_bid[$particular_id];
    $sql3 = "INSERT INTO `invoice_particulars` (`invoice_particulars_id`, `invoice_id`,`particular_id`,`amount`,`batch_id`) VALUES ( 'par_$inv_id', '$inv_id','$particular_id','$amount', $batchid)";
     if ($conn->query($sql3) === TRUE) {
      $par_inv_id = $conn->insert_id;   
    } else {
        echo $conn->error;
    }
  } 
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
        font-family: 'Varela Round', sans-serif;
        font-size: 18px;
      }


  .section-top-bg {
    width: 100%;
    height: 350px;
    background-image: url(images/top-bg.png);
    background-size: cover;
    background-position: 50.00% 60.00%;
    overflow: hidden;
}

  .intro-div {
      width: 95% !important;
      height: auto;
      background-color: white;
      margin-top: 170px;
      padding: 1% 9% 2% 9%;
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

    footer
    {
      background-color:#435d7d;
      color: white;
      padding: 1em;
    }



     
</style>
  
</head>
<body>


    <section class="section-top-bg" id="secMain">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="intro-div">
                    <br>
                    <h1><strong>Thank You <?php echo $fname . " " . $lname ; ?>!</strong></h1>
                    <p>Thank you for your generous donation to U.E.T. We truly appreciate your commitment.
                    </p>
                    <br>                
                </div>
            </div>
        </div>
    </section>


<div id="main">

      <div class="form-group">
          <h3>Here is your payment code:<b><?php echo $inv_id ?></b></h3>
          <hr>
          <h4>You can donate via either:</h4>

        <ul>
            <li><b>IBFT:</b></li>
            <p>Through your ABL, Askari, BAFL, BAHL, FBL, Meezan or SCB internet banking portal, add bill payee UET and enter your payment code to pay</p>

            <li><b>ATM:</b></li>
            <p>At any 1LINK ATM, select bill payment, select bill payee (Education - UET), and enter your payment code to pay.</p>

            <li><b>Bank Deposit:</b></li>
            <p>Donate to UET through cash, pay order or bank drafts made in favor of "University of Engineering and Technology" at any branch of ABL, Meezan or BAHL Banks in Pakistan.</p>
        </ul>
            <br>
            <p>To download your donation challan, please <a href="invoice.php" id="generatePDF">click here</a></p>
      </div>
  <div>
</div>
</div>
<footer>Footer</footer>



</body>




</html>