<?php
session_start();
require_once('db_connection.php');
$f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);    



if (($_POST))
{
   $currency=$_POST['currency'];
   $affiliation = $_POST['affiliation']; 
   $particulars=$_POST['particulars'];
   $amount = $_POST['amount']; 

   $_SESSION['currency'] = $currency;
   $_SESSION['affiliation'] = $affiliation;
   

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
  
  <script type="text/javascript">

    function openform() {
          if (document.getElementById('info-form')) {

              if (document.getElementById('info-form').style.display == 'none') {
                  document.getElementById('info-form').style.display = 'block';
              }

          }
    } 

  </script>

  <style type="text/css">
    input:-webkit-autofill,
    textarea:-webkit-autofill,
    select:-webkit-autofill
    {
      -webkit-animation-name: autofill;
      -webkit-animation-fill-mode: both;
    }
    body
      {
        text-align: center;
        font-family: 'Varela Round', sans-serif;
        font-size: 15px;
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
      width: 95%;
      height: auto;
      background-color: white;
      margin-top: 150px;
      padding: 1% 9% 2% 9%;
      margin-left: auto;
      margin-right: auto;
  }
  .intro-div h1{
      text-align: center;
      color: #04198B;
      padding-bottom: 1%;
  }
   p{
      text-align: center;
      font-size: 95%;
      word-wrap: break-word;
  }
  .content{
      text-align: center;
      padding: 0% 7% 0% 6%;
  }

  h2.head-pay{
      text-align: center;
      padding-top: 30px;
  }

      .form-group
      {
        padding: 10px;
      }
      .container
      {
          padding-left: 8%;
          padding-right: 8%;
          padding-bottom: 5%;
      }

      #pay-types
      {
        display: flex;
        justify-content: center;
        padding-bottom: 3em;
      }
      input[name="paytype"] 
      {
            display: none;
      }
      
      input[name="paytype"]+label 
      {
        background: #435d7d;
        border-radius: 4px;
        font-size: 15px;
        text-align: center;
        padding:1.25%;
        color: white;
        width: 25.2%;
        height: 3.5em;
        border:0px solid white;
        margin: 2% 2% 2% 2%;
        word-wrap: break-word;
        font-weight: normal;
      }

    input[name="paytype"]:checked+label {
        color: #435d7d;
        background:white;
        border: 1px solid #435d7d;
        outline: none;
    }

    input[name="paytype"]:hover+label {
        color: #435d7d;
        background:white;
        border: 1px solid #435d7d;
        outline: none;
    }

    input[name="paytype"]:focus+label {
        color: #435d7d;
        background:white;
        border: 1px solid #435d7d;
        outline: none;
    }


    @media only screen and (max-width: 960px) {
      input[name="paytype"]+label 
      {

        height: 5em;
        padding: 2%;

      }
    }

      .btn
      {
        background: #435d7d;
        color: white;
        width: 25%;
        height: 3.5em;
        border:0px solid white;
        margin: 2% 2% 2% 2%;
        word-wrap: break-word;

      }

      .btn:hover {
        color: #435d7d;
        background:white;
        border: 1px solid #435d7d;
      }

      .btn:focus
      {
        color: #435d7d;
        background:white;
        border: 1px solid #435d7d;
        outline: 0 !important;
        box-shadow: none;
      }



      label
      {
        font-size: 17px;
        float: left;
        font-weight: normal;
      }

      input[type="text"], input[type="password"], input[type="email"], input[type="textarea"], input[type="phone"]
      {
        height: 4em;
      }

      input[type="text"], input[type="password"], input[type="email"], input[type="phone"]:focus
      {
        box-shadow: none !important;
        outline: none !important;
      }

      textarea:focus
      {
         box-shadow: none !important;
        outline: none !important;
      }

      #title:focus
      {
         box-shadow: none !important;
        outline: none !important;
      }


      #gift-summary
      {
        margin-top: -3%;
        height: 100%;
        margin-bottom: 2%;
        align-items: center;
        justify-content: center;
        border:1px solid #435d7d;

      }

      #gift-summary h3, h5
      {
        color: white;
        background: #435d7d;
        padding: 1em;
      }


      #gift-summary .btn
      {
        width: 40%;
      }

      table
      {
        text-align: left;
      }

    footer
    {
      background-color:#435d7d;
      color: white;
      padding: 1em;
    }
  </style>
  
</head>
<body">
  <section class="section-top-bg" id="secMain">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="intro-div">
                    <br>
                    <h1><strong>DONATE ONLINE</strong></h1>
                    <p>Your support has enabled us to change the lives of numerous talented and deserving students. Our
                        team is here to help you route your gift. No matter where you are based, you can donate to U.E.T.
                        today.
                    </p>
                    <br>                
                </div>
            </div>
        </div>
    </section>


 
          <div class="form-group" style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding-top: 5em;">
              <div class="container-lg col-lg-10" id="gift-summary">
               <h3 style="margin: 0px -15px 0px -15px;">Your Gift Summary</h3>
               <br><br>
                 <div class="form-row">
                   <div class="form-group col-lg-5">
                      <h4>You choose to pay in</h4>
                      <h2><?php echo $currency; ?></h2>
                      <br>
                      <h4>Your Affiliation with U.E.T.</h4>                     
                      <h2><?php echo $affiliation; ?></h2>
                   </div>
                   
                    <div class="form-group col-lg-6">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Amount</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $total=0;
                          $index=array();
                          $res_amount=array();
                          $batches=array();
                          foreach( $particulars as $key => $particular ) {
                                $sql = "SELECT particular_id, particular_name FROM particulars WHERE particular_id= $particular";
                                if ($particular==3)
                                {                                  
                                  $batchid=$_POST['batchid'];
                                }
                                else
                                {
                                  $batchid=0;
                                }
                                 array_push($batches, $batchid);
                                 $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                  while ($row = mysqli_fetch_assoc($result)) 
                                {
                                  $particular_id=$row['particular_id'];
                                  $particular_name=$row['particular_name'];
                                  $total+=$amount[$key];
                                  array_push($index, $particular_id);
                                  array_push($res_amount, $amount[$key]);
                                    echo '<tr>';
                                    echo '<td>'. $particular_name .'</td>';
                                    echo '<td>'. $amount[$key] .'</td>';?>
                                  <?php  echo '</tr>'; }
                                }  
                              }
                              $_SESSION['total'] = $total;
                              $pid_amount=array_combine($index,$res_amount);
                              $pid_bid= array_combine($index,$batches);
                              $_SESSION['pid_amount'] = $pid_amount; 
                              $_SESSION['pid_bid'] = $pid_bid;                      
                              ?>                                                 
                        </tbody>
                      </table>

                        <h5>Total Amount: <?php echo $total . " ". $currency ?></h5>
                        <h5>In Words: <?php echo ucfirst($f->format($total)); ?></h5>

                        <input value="Edit Selection" type="button" onclick="history.back()" class="btn"/>
                     </div>
                  </div>
            </div>
          </div>
  <div>


  <form  action="donation-download.php" method="post">
     <div class="form-group">
             <h3>Choose Your Payment Type</h3>
              <div id="pay-types">
               <input id="debit-credit" value="Pay by Debit/Credit Card" type="radio" name="paytype" onclick="openform()"><label for="debit-credit">Pay by Debit/Credit Card</label>
              <input id="bank-atm-ibft" value="Pay via Bank/ATM/IBFT" type="radio" name="paytype" onclick="openform()"><label for="bank-atm-ibft">Pay via Bank/ATM/IBFT</label>
               <input id="cheque" value="Donate via Cheque" type="radio" name="paytype" onclick="openform()"><label for="cheque">Donate via Cheque</label>
             </div>
    </div>

    <div id="info-form" style="display: none;" >
      <div class="form-group">
          <h3>Please Enter Your Information</h3>
          <br>   
          <div class="container col-md-12">    
            <div class="form-row">
                <div class="form-group col-md-2">
                  <label for="title">Title (*):</label>
                   <select required id="title" name="title" class="form-control" style="height: 4em;" >
                    <option disabled selected value></option>
                    <option>Mr.</option>
                    <option>Mrs.</option>
                    <option>Ms.</option>
                    <option>Miss</option>
                    <option>Dr.</option>
                    <option>M/s</option>
                  </select>
                </div>
                <div class="form-group col-md-5">
                  <label for="fname">First Name (*):</label>
                  <input type="text" name="fname" class="form-control" id="fname" required>
                </div>
                <div class="form-group col-md-5">
                  <label for="lname">Last Name (*):</label>
                  <input type="text" name="lname" class="form-control" id="lname" required>
                </div>
              </div>

              <div class="form-row">
                 <div class="form-group col-md-6">
                    <label for="email">Email Address (*):</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="phone">Phone (*):</label>
                    <input type="phone" name="phone" class="form-control" id="phone" required>
                 </div>
              </div>


              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="address">Address (*):</label>
                  <textarea required class="form-control" name="address" id="address"></textarea>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="country">Country (*):</label>
                  <input type="text" class="form-control" name="country" id="country" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="state">State (*):</label>
                   <input type="text" class="form-control" name="state" id="state" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="city">City (*):</label>
                  <input type="text" class="form-control" name="city" id="city" required>
                </div>
              </div>         
         </div>
         <br>
        <button name="donation-info" type="submit" class="btn" style="margin-top: -10px;">Continue</button>
      </div>
    </div>
  </form>
</div>
</div>
<footer>Footer</footer>

</body>




</html>