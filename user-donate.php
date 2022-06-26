<?php
session_start();
require_once('db_connection.php');

if (($_POST))
{
   $currency=$_POST['currency'];
   $affiliation = $_POST['affiliation']; 

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
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }



    body
      {
        text-align: center;
        font-family: 'Varela Round', sans-serif;
        font-size: 15px;

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
        padding:0.75em;
        color: white;
        width: 25%;
        height: 3em;
        border:0px solid white ;
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

      .btn
      {
        background: #435d7d;
        color: white;
        width: 25%;
        height: 3.5em;
        border:0px solid white;
        margin: 2% 2% 2% 2%;
        white-space: normal;
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
</style>
  
</head>
<body>
  <div id="main">
      <div class="rectangle">
        <br>
        <h1 id="title" style="padding: 10px;">Donations</h1>
        <br>
      </div>  

          <div class="form-group" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
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
                          $sql = "SELECT batch_id, batch_name FROM batch_fund WHERE batch_id=1 ORDER BY batch_id";
                          $result = mysqli_query($conn, $sql);
                          if(mysqli_num_rows($result) > 0){

                              while ($row = mysqli_fetch_assoc($result)) 
                              {
                                $batch_id=$row['batch_id'];
                                $batch_name=$row['batch_name'];
                                  echo '<tr>';
                                  echo '<td>'. $batch_id .'</td>';
                                  echo '<td>'. $batch_name .'</td>';?>
                                <?php  echo '</tr>';
                              }
                            }?>                            
                        </tbody>
                      </table>



                        <h5>Total Amount:</h5>
                        <h5>In words:</h5>
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
                    <option selected>-</option>
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


</body>




</html>