<?php
session_start();
require_once('db_connection.php');  
  $inv_id = $_SESSION['inv_id']; 
  $title = $_SESSION['title'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $currency = $_SESSION['currency'];
  $total= $_SESSION['total'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Invoice</title>
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
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
  <style>  
    body
    {
      font-size: 12px;
      font-family: Arial;
    }

    .col-md-4
    {
      border: 1px solid black;
      border-top: 0;
      border-bottom: 0;
    }

    #rectangle
    {
      border: 2px solid black;
      padding: 1%;
    }

    hr
    {
        height: 2px;
        background: black;
    }

    #d-info
    {
      font-weight: bold;
      font-size: 15px;
      margin: 5px;
      margin-bottom: -7px;
    }

    #particulars
    {
      margin-top: 4%;
      padding: 3px;
      border: 2px solid black;
    }

    #info
    {
      border: 2px solid black;
      background: #E8E8E8;
      padding: 1%;
    }

    .currency
    {
      float: right; 
      width: 7em; 
      text-align: center; 
      margin-bottom: 2px; 
      margin-right: -2px;
    }

    .form-row
    {
      margin: 2px;
      width: 100%;
      padding:0;
    }
    
    .form-group
    {
      border: 2px solid black;
      justify-content: center;
      margin: 0;
      padding-top: 5px;

    }

    .col-md-9
    {
      text-align: left;
    }

    .col-md-3
    {
      border-left: 0;
      text-align:right;
    }

    footer
    {
      background-color:#435d7d;
      color: white;
      padding: 1em;
    }

    .btn
      {
        background: #435d7d;
        color: white;
        width: 20rem;
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

    .section-top-bg {
    width: 100%;
    height: 350px;
    background-image: url(images/top-bg-1.jpg);
    background-size: cover;
    background-position: 50.00% 85.00%;
    overflow: hidden;
}
    
    .table-sm
    {
      text-align: center; 
      border: 2px solid black; 
      width: 32rem;
       border-collapse: collapse;
    }



  </style> 
</head>
<body>   
  <section class="section-top-bg" id="secMain"></section>
  <div style="display: flex; justify-content: center;">
    <input type="button" class="btn" id="create_pdf" value="Download Invoice">
  </div>
<hr>
<form class="form" style="opacity: 0.5;">                                           
  <div class="container-fluid"  id="htmlContent"> 
   <div class="row">
      <div class="col-md-4" style="border-left: 0;">
        <div>
         <p style="float: right;"><b><u><i>Bank Copy</i></u></b></p>
            <p><img src="images/uet.jpeg" width="250"></p>
        </div>
        <p id="rectangle" style="font-size: 12px;">U.E.T. NTN </p>
        <div id="d-info">
          <p>Invoice #: <?php echo $inv_id ?><span><br>
          Name: <?php echo " " . $title . " " . $fname . " " . $lname ?> <br>
          U.E.T. Donation</span></p>
        </div>
        <hr>
        <p id="rectangle" class="currency"><?php echo $currency ?></p>
       
        <div class="particulars">
        <?php  
        $sql= "SELECT particular_id, amount, batch_id FROM invoice_particulars WHERE invoice_id=$inv_id";
        $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0)
          {
            while ($row = mysqli_fetch_assoc($result)) 
            {
              $amount=$row['amount']; 
              $particular_id=$row['particular_id'];
              $batch_id=$row['batch_id']; 
              if($batch_id=='0')
              {
                $batch_name=" ";

              }
              else
              {
                $sql1="SELECT batch_name FROM batch_fund where batch_id=$batch_id";
                $result1= mysqli_query($conn, $sql1);
                while($row = mysqli_fetch_array($result1)) 
                {
                       $batch_name=$row['batch_name'];
                      
                }
              }

              $sql2="SELECT particular_name FROM particulars where particular_id=$particular_id";
              $result2= mysqli_query($conn, $sql2);
              while($row = mysqli_fetch_array($result2)) 
              {
                    $particular_name=$row['particular_name'];
              }
             
              echo '<div class="form-row">' .
              '<div class="form-group col-md-9">';
                  echo '<p>' .$particular_name . " " . $batch_name. '</p>';
               echo '</div>' .
                '<div class="form-group col-md-3">' .
                  '<p>' . $amount . '</p>' .
               ' </div>'.
             '</div> ';        
            } 
          }                                          
        ?> 
          <div class="form-row">
               <div class="form-group col-md-9">
                  <p><b>Total payable:</b></p>
                </div>
                <div class="form-group col-md-3">
                  <p><b><?php echo $total ."/-" ?></b></p>
               </div>
          </div>
        </div> 
          <hr>    
         <div style="position: relative; height: 320px;">    
            <div style="position: absolute; bottom: 5px; width: 100%;">
             <p id="rectangle" style="font-size: 11px; text-align: center;">This is a computer generated voucher and does not need signature or stamp.</p>
            </div>
        </div> 
      </div>

      <div class="col-md-4" >
         <div>
          <p style="float: right;"><b><u><i>Donor Copy</i></u></b></p>
          <p><img src="images/uet.jpeg" width="250"></p>
        </div>
       <p id="rectangle" style="font-size: 12px;">U.E.T. NTN </p>
        <div id="d-info">
          <p>Invoice #: <?php echo $inv_id ?><span><br>
          Name:<?php echo " " .  $title . " " . $fname . " " . $lname ?> <br>
          U.E.T. Donation</span></p>
        </div>
        <hr>        
        <p id="rectangle" class="currency"><?php echo $currency ?></p>
                <div class="particulars">
        <?php  
        $sql= "SELECT particular_id, amount, batch_id FROM invoice_particulars WHERE invoice_id=$inv_id";
        $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0)
          {
            while ($row = mysqli_fetch_assoc($result)) 
            {
              $amount=$row['amount']; 
              $particular_id=$row['particular_id'];
              $batch_id=$row['batch_id']; 
              if($batch_id=='0')
              {
                $batch_name=" ";

              }
              else
              {
                $sql1="SELECT batch_name FROM batch_fund where batch_id=$batch_id";
                $result1= mysqli_query($conn, $sql1);
                while($row = mysqli_fetch_array($result1)) 
                {
                       $batch_name=$row['batch_name'];
                      
                }
              }

              $sql2="SELECT particular_name FROM particulars where particular_id=$particular_id";
              $result2= mysqli_query($conn, $sql2);
              while($row = mysqli_fetch_array($result2)) 
              {
                    $particular_name=$row['particular_name'];
              }
             
              echo '<div class="form-row">' .
              '<div class="form-group col-md-9">';
                  echo '<p>' .$particular_name . " " . $batch_name. '</p>';
               echo '</div>' .
                '<div class="form-group col-md-3">' .
                  '<p>' . $amount . '</p>' .
               ' </div>'.
             '</div> ';        
            } 
          }                                          
        ?> 
            <div class="form-row">
               <div class="form-group col-md-9">
                  <p><b>Total payable:</b></p>
                </div>
                <div class="form-group col-md-3">
                  <p><b><?php echo $total ."/-" ?></b></p>
               </div>
          </div>
        </div>
        <hr> 
        <div style="position: relative; height: 320px;">    
            <div style="position: absolute; bottom: 5px; width: 100%;">
             <p id="rectangle" style="font-size: 11px; text-align: center;">This is a computer generated voucher and does not need signature or stamp.</p>
            </div>
        </div>
      </div>

      <div class="col-md-4" style="font-size: 12px; border-right: 0;">
        <p id="info">Important Information</p>
        <p><u><b>Mode of payment</b></u></p>
        <p>Your donation slip has been generated. You can pay via either Bill, Online/Credit/Debit Card, ATM or Bank Deposit </p>
        <p><b>Bank Information</b></p>
        <div class="table-wrapper">
          <!----------Table 1----------->
            <table class="table-sm table-hover table-bordered ">
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
        </div>
        <br>
            <!----------Table 2------------>
            <table class="table-sm table-hover table-bordered ">
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
      </div>
    </div>
</div>
</form>
</body>
<footer>Footer</footer>
</html>
<script>
    (function () {
        var
         form = $('.form'),
         cache_width = form.width(),
         a4 = [820, 300.28]; // for a4 size paper width and height

        $('#create_pdf').on('click', function () {
            $('body').scrollTop(0);
            createPDF();
        });
        function createPDF() {
            getCanvas().then(function (canvas) {
                var
                 img = canvas.toDataURL("image/png"),
                 doc = new jsPDF({
                     unit: 'px',
                     format: 'a4',
                     orientation: 'landscape',
                 });

                doc.addImage(img, 'JPEG', 20, 20);
                doc.setFont('Courier');
                doc.setFontType('normal');
                doc.save('invoice.pdf');
                form.width(cache_width);
            });
        }

        function getCanvas() {
            form.width((a4[0] * 1.3));
            return html2canvas(form, {
                imageTimeout: 2000,
                removeContainer: true
            });
        }
    }());
</script>
