<?php
require('db_connection.php');
include("auth.php");
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
<title>Donation Records</title>
<style type="text/css">
   html {
       height: 100%;
       width: 100%;
   }
   /******************Navbar******************/
   ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #e7e7e7;
    background-color: #f3f3f3;
  }

  li {
    float: right;
  }

  li a {
    display: block;
    color: #666;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  li a:hover:not(.active) {
    background-color: #ddd;
  }

  li a.active {
    color: white;
    background-color: #04AA6D;
  }

  /******************Main board******************/
   #container {
       background-color: black;
       padding: 3em;
       opacity: 0.7;
       width: 0 auto;
       margin: 9.6%;
       margin-bottom: 1%;
       margin-top: 1%;
       text-align: center;
   }

   h3 {
       text-align: center;
       vertical-align: middle;
       line-height: 3rem;
       height: 3rem;
       color: white;
   }

   p
   {
    color: white;
    font-size: 15px;
   }

   
   td
   {
    text-align: left;
   }

   /******************Table******************/
   .container
   {
    padding-left:5.5rem;
    padding-right:5.5rem;
   }

   /***********Alert************/
   .alert-success
   {
    background-color: #39C16C ;
    color: white;
   }



</style>
</head>
<body>
  <!---------Navbar-------->
  <ul>
      <li><a href="logout.php">Logout</a></li>
    <li><a href="dashboard.php"><?php echo $_SESSION['username']; ?></a></li>
  </ul>


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

  <!---------Main Board-------->
  <div id="container">
    <h3>Donation Records</h3>
  </div>

  <br>

  <!---------Table-------->
  <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                  <table class="table table-hover table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Donor ID</th>
                            <th>Donor</th>
                            <th>Email</th>
                            <th>Affiliation</th>
                            <th>Invoice ID</th>
                            <th>Currency</th>
                            <th>Payment method</th>
                            <th>Date of invoice</th>
                            <th>Status</th>
                            <th>Date of payment</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql="SELECT * FROM users AS U INNER JOIN invoice AS I on U.user_id= I.user_id INNER JOIN (SELECT invoice_id, SUM(Amount) as total FROM invoice_particulars GROUP BY invoice_id) AS IP on I.id= IP.invoice_id";
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      if(mysqli_num_rows($result) > 0){
                          $id=0;
                          while ($row = mysqli_fetch_assoc($result)) 
                          {
                            $id=$id+1;
                            $donor_id=$row['user_id'];
                            $title=$row['title'];
                            $fname=$row['fname'];
                            $lname=$row['lname'];
                            $affiliation=$row['affiliation'];
                            $email=$row['email'];
                            $invoice_id=$row['id'];
                            $currency=$row['currency'];
                            $payment_method=$row['payment_method'];
                            $dateofinvoice=$row['dateofinvoice'];
                            $status=$row['status'];  
                            $stat='';  
                            if($status == 0)
                            {
                              $stat='Unpaid';
                            }                 
                            else
                            {
                              $stat='Paid';
                            }     
                            $dateofpayment=$row['dateofpayment']; 
                            $dop=''; 
                            if($dateofpayment==0)
                            {
                              $dop='-';
                            } 
                            else  
                            {
                              $dop=$dateofpayment;
                            }
                            $amount=$row['total'];

                              echo '<tr>';
                              echo '<td>'. $id .'</td>';
                              echo '<td>'. $donor_id .'</td>';
                              echo '<td>'. $title.''.$fname.''.$lname.'</td>';
                              echo '<td>'. $email .'</td>';
                              echo '<td>'. $affiliation .'</td>';
                              echo '<td>'. $invoice_id .'</td>';
                              echo '<td>'. $currency .'</td>';
                              echo '<td>'. $payment_method .'</td>';
                              echo '<td>'. $dateofinvoice .'</td>';
                              echo '<td>'. $stat .'</td>';
                              echo '<td>'. $dop .'</td>';
                              echo '<td>'. $amount .'</td>';
                              echo '</tr>';
                          }
                      }?>                          
                    </tbody>
                  </table>
                </div>
            </div>

        </div>
  </div>
<br>
</body>
</html>