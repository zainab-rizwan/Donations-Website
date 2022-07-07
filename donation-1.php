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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="jquery-3.6.0.min.js"></script>
  <script>

    /* Display form when currency is selected */
    function openform() {
          if (document.getElementById('donation-form')) {

              if (document.getElementById('donation-form').style.display == 'none') {
                  document.getElementById('donation-form').style.display = 'block';
              }

          }
    } 

    /* Enable/Disable amounts based on checkbx values */
    function enabledisableAmount() {
        var amount1 = document.getElementById("amount1");
        var amount2 = document.getElementById("amount2");
        var amount3 = document.getElementById("amount3");
        var batches = document.getElementById("batches");
        amount1.disabled = particular1.checked ? false : true;
        if (!amount1.disabled) {
            amount1.focus();
        }
        amount2.disabled = particular2.checked ? false : true;
        if (!amount2.disabled) {
            amount2.focus();
        }
        amount3.disabled = particular3.checked ? false : true;
        if (!amount3.disabled) {
            amount3.focus();
        }
        batches.disabled = particular3.checked ? false : true;
        if (!batches.disabled) {
            batches.focus();
        }
    }  
  </script>
  <script>
    /* Popovers to share more info about particulars (i) */
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();   
    });

    /* Check atleast one donation option is selected */
    $(document).ready(function()
    {
      $("form").submit(function(){
      if ($('input:checkbox').filter(':checked').length < 1){
          alert("Select atleast one donation option to proceed.");
      return false;
      }
      });
    });

  </script>

<style type="text/css">
  /***********Alert Messages***********/
  .alert
  {
    display: flex;
    background: white;
    color: #435d7d;
    padding-left: 1em;
  }

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

  /***********Top portion***********/
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

  /***********Main Form***********/
  form
  {
    margin-bottom: 5%;
  }
  .form-group
  {
    margin: 0% 8% 0% 8%;
    padding: 1em;
  }

  .form-control
  {
    margin-bottom: 1%;
  }

  /***********Form buttons***********/
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

  /***********Form inputs***********/
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

  /********Batch funds************/
    #batches
    {
      outline: none;
    }

    #batches:focus
    {
      border: 1px solid #435d7d;
      outline: none;
      box-shadow: none;
    }

    /*********Hover for info***********/
    #info
    {
      margin:5px;
      margin-top: 2.5px;
    }

    /********Input fields************/
      label
      {
        font-size: 17px;
        display: inline-block;
        text-align: left;
      }

      input[type=number]
      {
        width: 100%;
        margin: 2% 0% 2% 0%;
        height: 2.5em;
        -moz-appearance: textfield;
        box-shadow: none;
      }

      input[type=number]:focus
      {
        box-shadow: none;
        border: 1px solid #435d7d;
        outline: none;
      }

    /********Checkboxes************/
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

      .container-fluid
       {
        position: relative;
        padding-left: 35px;
        width: 100%;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-weight: normal;
      }

      .container-fluid input {
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


    .container-fluid input:checked ~ .checkmark {
      background-color: #2196F3;
    }

    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    .container-fluid input:checked ~ .checkmark:after {
      display: block;
    }

    .container-fluid .checkmark:after {
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

    /********Footer************/
    footer
    {
      background-color:#435d7d;
      color: white;
      padding: 1em;
    }
  </style>

</head>

<body>
     <!----------Top Portion----------->
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

    <section class="section-content" id="secLetStart">
    <div class="container">
            <div class="content">
                <br>         
                <h2>Let's Get Started</h2>
                <p>You can support U.E.T. in a variety of ways - from gifts towards our financial aid and NOP scholars or towards infrastructure and research. To make this gift, please use our secure online giving form. The process consists of <strong> a few easy steps and will only take a moment but the impact will last a lifetime.</strong></p> 
            </div>
    </div>
    </section>
  <br>

  <!----------Form----------->
  <form  action="donation-2.php" method="POST" >
    <div class="form-group">
         <h3>How would you like to pay?</h3>
          <input id="PKR" value="PKR" type="radio" name="currency" onclick="openform()"><label for="PKR">PKR</label>
          <input id="USD" value="USD" type="radio" name="currency" onclick="openform()"><label for="USD">USD</label>
    </div>

    <div id="donation-form"  style="display: none; margin-top: -1%;">
      <div class="form-group" class="">
          <h3>How would you like to help?</h3>
          <p>I want to contribute to: (Select Option(s). As Required)</p>
          <br>       
          <div>
          <!----------Particulars----------->
             <div style="display: inline-block; width:60%; " >

                <!----------Checkbox 1----------->
                <label for="particular1" class="container-fluid">
                  Give a day to U.E.T.<img src="images/info.png" id="info" data-html="true" data-trigger="hover" data-placement="top" data-toggle="popover" data-content="Donate one day of your earnings towards Financial Aid scholars at U.E.T.">
                  <input type="checkbox" name="particulars[]" value="1" id="particular1" onClick="enabledisableAmount(this)">
                  <span class="checkmark"></span>
                </label>
                <input type="number" placeholder="Amount" class="form-control" name="amount[]" id="amount1" min="1" disabled="disabled" required>

                <label for="particular2" class="container-fluid">
                <!----------Checkbox 2----------->
                  Give a day to U.E.T. (Zakat)<img src="images/info.png" id="info" data-html="true" data-trigger="hover" data-placement="top" data-toggle="popover" data-content="Donate one day of your annual earnings towards our Zakat fund.">
                  <input type="checkbox" name="particulars[]" value="2" id="particular2" onClick="enabledisableAmount(this)">
                  <span class="checkmark"></span>
                </label>
                <input type="number" placeholder="Amount" class="form-control" name="amount[]" id="amount2" min="1" disabled="disabled" required>

                <label for="particular3" class="container-fluid">
                 <!----------Checkbox 3----------->
                  Batch Fund<img src="images/info.png" id="info" data-html="true" data-trigger="hover" data-placement="top" data-toggle="popover" data-content="Pool funds by different batches that can be used towards scholarships or university wide initiatives.">
                  <input type="checkbox" name="particulars[]" value="3" id="particular3" onClick="enabledisableAmount(this)">
                  <span class="checkmark"></span>
                </label>
                <select required id="batches" disabled="disabled" class="form-control" name="batchid" style="width: 100%;">

                <?php
                    $sql = "SELECT * FROM batch_fund where batch_id>0";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                          $batch_name=$row['batch_name'];
                          $batch_id=$row['batch_id']; ?>
                          <?php                       
                            echo '<option  name="batchid" value="'. $batch_id. '">' 
                                 . $batch_name 
                                 . ' </option>';
                        }
                    }?>
                  </select>
                <input type="number" placeholder="Amount" class="form-control" name="amount[]" id="amount3" min="1" disabled="disabled" required >
                
              </div>
          </div>      
      </div>
      <!----------Affiliations----------->
        <div class="form-group">
           <h3>What is your Affiliation with U.E.T.?</h3>
           <br>
            <div id="radios">
              <label class="radio-inline" for="Alumni"><input value="Alumni" type="radio" id="affiliation" name="affiliation" class="radio" required>Alumni</label>
              <label class="radio-inline" for="Faculty"><input value="Faculty" type="radio" id="affiliation" name="affiliation" class="radio">Faculty</label>
              <label class="radio-inline" for="Student"><input value="Student" type="radio" id="affiliation" name="affiliation" class="radio">Student</label>
              <label class="radio-inline" for="Staff"><input value="Staff" type="radio" id="affiliation" name="affiliation" class="radio">Staff</label>
              <label class="radio-inline" for="Parent"><input value="Parent" type="radio" id="affiliation" name="affiliation" class="radio">Parent</label>
              <label class="radio-inline" for="Other"><input value="Other" type="radio" id="affiliation" name="affiliation" class="radio">Other</label>
            </div>
          </div>
        <button id="submit" type="submit" class="btn">Submit</button>
      </div>
    </div>
  </form>
<footer>Footer</footer>
</body>
</html>