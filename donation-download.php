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

    th
    {
      text-align: center;
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
                    <br>                
                </div>
            </div>
        </div>
    </section>


<div id="main">

      <div class="form-group">
          <h3>Here is your payment code:<b><?php echo $inv_id ?></b></h3>
          <hr>
            <p>Thank you for your generous donation to U.E.T. We truly appreciate your commitment. </p>
            <p>To download your donation challan, please <a href="invoice.php" id="create_pdf">click here</a></p>
      </div>
  <div>
</div>

<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
          </div>
          
                </div>
            </div>
            <table class="table table-hover" style="text-align: center;">
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

            <table class="table table-hover" style="text-align: center;">
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

