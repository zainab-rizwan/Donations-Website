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

  <script>
    function openform() {
          if (document.getElementById('donation-form')) {

              if (document.getElementById('donation-form').style.display == 'none') {
                  document.getElementById('donation-form').style.display = 'block';
              }

          }
    } 

    function enabledisableAmount() {
        var amount1 = document.getElementById("amount1");
        var amount2 = document.getElementById("amount2");
        var amount3 = document.getElementById("amount3");
        var batches = document.getElementById("batches");
        var amount4 = document.getElementById("amount4");
        amount1.disabled = particular1.checked ? false : true;
        if (!amount1.disabled) {
            amount1.focus();
        }
        amount2.disabled = particular2.checked ? false : true;
        if (!amount2.disabled) {
            amount2.focus();
        }
        amount3.disabled = particular3.checked ? false : true;
        if (!amount3.disabled){
            amount3.focus();
            batches.focus();
        }
        amount4.disabled = particular4.checked ? false : true;
        if (!amount4.disabled) {
            amount4.focus();
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
        margin: 4% 8% 4% 8%;
        padding: 1em;
      }

      .form-control
      {
        margin-bottom: 1%;
      }

      .btn
      {
        background: #435d7d;
        color: white;
        width: 25%;
        height: 3.5em;
        border:0px solid white ;
        margin: 3% 3% 3% 3%;
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

      input[name="currency"] 
      {
            display: none;
      }
      
      input[name="currency"]+label 
      {
        background: #435d7d;
        border-radius: 4px;
        text-align: center;
        padding:0.75em;
        color: white;
        width: 25%;
        height: 3em;
        border:0px solid white ;
        margin: 3% 3% 3% 3%;
        font-weight: normal;
      }

    input[name="currency"]:checked+label {
        color: #435d7d;
        background:white;
        border: 1px solid #435d7d;
        outline: none;
    }

    input[name="pay-type"]:hover+label {
        color: #435d7d;
        background:white;
        border: 1px solid #435d7d;
        outline: none;
    }

    input[name="pay-type"]:focus+label {
        color: #435d7d;
        background:white;
        border: 1px solid #435d7d;
        outline: none;
    }



      label
      {
        font-size: 17px;
        display: inline-block;
        text-align: left;
      }

      input[type=number]
      {
        width: 70%;
        height: 2.5em;
        margin-top: -1%;
        display: inline-block;
        -moz-appearance: textfield;
        box-shadow: none;
      }

      input[type=number]:focus
      {
        box-shadow: none;
        border: 1px solid #435d7d;
        outline: none;
      }

      .container 
      {
        position: relative;
        padding-left: 35px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-weight: normal;
      }

      .container input {
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
      }

      .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        margin-right: -1000px !important;
      }


    .container input:checked ~ .checkmark {
      background-color: #2196F3;
    }

    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    .container input:checked ~ .checkmark:after {
      display: block;
    }

    .container .checkmark:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }
    #Div2 {
    display: none;
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

      <div class="form-group">
         <h3>How would you like to pay?</h3>
          <input id="pkr" type="radio" name="currency" onclick="openform()"><label for="pkr">PKR</label>
          <input id="usd" type="radio" name="currency" onclick="openform()"><label for="usd">USD</label>
      </div>
  <div>
                                        
  <form  action="user-donate.php" method="post">
    <div id="donation-form"  style="display: none;">
      <div class="form-group">
          <h3>How would you like to help?</h3>
          <p>I want to contribute to: (Select Option(s). As Required)</p>
          <br>       
          <div>
             <div>
                <label for="particular1" class="container">Give a day to U.E.T.
                  <input type="checkbox" name="particulars" id="particular1" onClick="enabledisableAmount(this)">
                  <span class="checkmark"></span>
                </label>
                <input type="number" placeholder="Amount" class="form-control" id="amount1" min="1" disabled="disabled" required>

                <label for="particular2" class="container">Give a day to U.E.T. (Zakat)
                  <input type="checkbox" name="particulars" id="particular2" onClick="enabledisableAmount(this)">
                  <span class="checkmark"></span>
                </label>
                <input type="number" placeholder="Amount" class="form-control" id="amount2" disabled="disabled" required>

                <label for="particular3" class="container">Batch Fund
                  <input type="checkbox" name="particulars" id="particular3" onClick="enabledisableAmount(this)">
                  <span class="checkmark"></span>
                </label>
                <input type="number" placeholder="Amount" class="form-control" id="amount3" disabled="disabled" required >
                   <select required id="batches" class="form-control">
                    <option selected>-</option>
                    <?php
                        $sql = "SELECT * FROM batch_fund";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while ($row = mysqli_fetch_assoc($result)) 
                            {
                              $batch_name=$row['batch_name'];
                              $batch_id=$row['batch_id'];                            
                                echo '<option>' 
                                    . $batch_name 

                                    . ' </option>';
                            }

                        }?>
                  </select>

                <label for="particular4" class="container">
                  Interloop Endowment Fund
                  <input type="checkbox" name="particulars" id="particular4" onClick="enabledisableAmount(this)">
                  <span class="checkmark"></span>
                </label>
                <input type="number" placeholder="Amount" class="form-control" id="amount4" disabled="disabled" required >
          
          
          
              </div>
          </div>      
      </div>



        <div class="form-group">
           <h3>What is your Affiliation with U.E.T.?</h3>
           <br>
            <div id="radios">
              <label class="radio-inline" for="Alumni"><input value="Alumni" type="radio" name="Affiliation" class="radio" required>Alumni</label>
              <label class="radio-inline" for="Faculty"><input value="Faculty" type="radio" name="Affiliation" class="radio">Faculty</label>
              <label class="radio-inline" for="Student"><input value="Student" type="radio" name="Affiliation" class="radio">Student</label>
              <label class="radio-inline" for="Staff"><input value="Staff" type="radio" name="Affiliation" class="radio">Staff</label>
              <label class="radio-inline" for="Parent"><input value="Parent" type="radio" name="Affiliation" class="radio">Parent</label>
              <label class="radio-inline" for="Other"><input value="Other" type="radio" name="Affiliation" class="radio">Other</label>
            </div>
          </div>
        <button id="submit" type="submit" class="btn" style="margin-top: -10px;">Submit</button>
      </div>
    </div>
  </form>

</body>
</html>