<?php
session_start();
require_once('db_connection.php');

$currency = $_POST['PKR'];
$category1 = $_POST['category'];
$category2 = $_POST['category'];
$category3 = $_POST['category'];
$amount1 = $_POST['Amount'];
$amount2 = $_POST['Amount'];
$amount3 = $_POST['Amount'];
$affiliation = $_POST['radio'];


$sql = "INSERT INTO `d-info` (`currency`, `category1`, `category2`, `category3`, `amount1`, `amount2` , `amount3`, `radio`) VALUES ( '$currency', '$category1', '$category2', '$category3', '$amount1', '$amount2', '$amount3', '$affiliation')";

$rs = mysqli_query($conn, $sql);



mysqli_close($conn);
?>
<!DOCTYPE HTML>  
<html>
<head>
    <title>Giving to U.E.T.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-221382542-1"></script>
<style>
.error {color: #FF0000;}
</style>
</head>

<body>  
    <div class="col-md-12">
      <div class="form-container">
        <form method="POST" action="">
             <h2>Choose your payment type</h2>
            <input type="radio" id="Alumni" name="Affiliation" value="Alumni"><label for="html">Pay by Debit/Credit Card</label><br>
            <input type="radio" id="Faculty" name="Affiliation" value="Faculty"><label for="css">Pay via Bank/ATM/IBFT</label><br>
            <input type="radio" id="Student" name="Affiliation" value="Student"><label for="html">Donate via Cheque</label><br>

            <h2>Please enter your Information</h2>

            <label for="GAD">
              <input type="checkbox" id="GAD" onclick="EnableDisableTextBox(this)" /> Give a day to U.E.T
            </label>
            <br />
            <input type="text" id="Amount" disabled="disabled" placeholder="Amount" />

          </div>


           


            <button type="submit" name="Continue" value="Continue">Continue</button>
  `      </form>
    `</div>
</div>

<?php
if (isset($_POST['Continue']))
  {
$radioVal = $_POST["MyRadio"];

if($radioVal == "First")
{
echo("You chose the first button. Good choice. :D");
}
else if ($radioVal == "Second")
{
echo("Second, eh?");
}
}
?>

<script type="text/javascript">
    function EnableDisableTextBox(GAD) {
        var Amount = document.getElementById("Amount");
        Amount.disabled = GAD.checked ? false : true;
        if (!Amount.disabled) {
            Amount.focus();
        }
    }
</script>

</body>
</html>