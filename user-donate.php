<?php
require_once('db_connection.php');
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

      .btn
      {
        background: #435d7d;
        color: white;
        width: 25%;
        height: 3.5em;
        border:0px solid white;
        margin: 2% 2% 2% 2%;
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
        outline: none;
      }

      .btn:active
      {
        color: #435d7d;
        background:white;
        border: 1px solid #435d7d;
        outline: none;
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
        margin-bottom: 3%;
        align-items: center;
        justify-content: center;
        outline-offset: -16px;
        outline: 1px solid blue;

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
               <h3>Your Gift Summary</h3>
               <br><br>
                 <div class="form-row" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                   <div class="form-group col-lg-4" style="margin-top: -8%;">
                      <h4>You choose to pay in</h4>
                      <h2>PKR</h2>
                      <br>
                      <h4>Your Affiliation with U.E.T.</h4>
                      <h2>PKR</h2>
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
                        <input value="Edit Selection" type="button" class="btn" />
                     </div>
                  </div>
            </div>
          </div>
          <br>
          <div class="form-group">
             <h3>Choose Your Payment Type</h3>
              <input value="Pay by Debit/Credit Card" type="button" name="currency" class="btn" id="show1"/>
              <input value="Pay via Bank/ATM/IBFT"  type="button" name="currency" class="btn" id="show"/>
              <input value="Donate via Cheque"  type="button" name="currency" class="btn" id="show"/>
          </div>
      </h3>
  <div>


  <form  action="donation-download.php" method="post">
    <div id="donation-form" >
      <div class="form-group">
          <h3>Please Enter Your Information</h3>
          <br>   
          <div class="container col-md-12">    
            <div class="form-row">
                <div class="form-group col-md-2">
                  <label for="title">Title (*):</label>
                   <select required id="title" class="form-control" style="height: 4em;" >
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
                  <input type="text" class="form-control" id="fname" required>
                </div>
                <div class="form-group col-md-5">
                  <label for="lname">Last Name (*):</label>
                  <input type="text" class="form-control" id="lname" required>
                </div>
              </div>

              <div class="form-row">
                 <div class="form-group col-md-6">
                    <label for="email">Email Address (*):</label>
                    <input type="email" class="form-control" id="email" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="phone">Phone (*):</label>
                    <input type="phone" class="form-control" id="phone" required>
                 </div>
              </div>


              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="address">Address (*):</label>
                  <textarea required class="form-control" id="address"></textarea>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="country">Country (*):</label>
                  <input type="text" class="form-control" id="country" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="state">State (*):</label>
                   <input type="text" class="form-control" id="state" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="city">City (*):</label>
                  <input type="text" class="form-control" id="city" required>
                </div>
              </div>         
         </div>
         <br>
        <button id="submit" type="submit" class="btn" style="margin-top: -10px;">Continue</button>
      </div>
    </div>
  </form>


</body>




</html>