<?php
session_start();
require_once('db_connection.php');  
require('fpdf184/fpdf.php');

#data
if(isset($_GET))
{
  $inv_id = $_SESSION['inv_id']; 
  $title = $_SESSION['title'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $currency = $_SESSION['currency'];
  $total= $_SESSION['total'];
}
else
{
  header('location: donation-1.php');
}


#HTML Class
class PDF extends FPDF
{
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';

    function WriteHTML($html)
    {
        // HTML parser
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extract attributes
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
}

#Page settings
$pdf = new PDF('P','mm','A4');
$pdf->AddPage('L');



#------------Bank Copy------------#
#Head
$image="images/uet-logo.png";
$pdf->Image($image, 4, 2, 18);
$pdf->SetFont('Arial', '',10);
$pdf->Text(25, 10, 'U.E.T. Donations');
$pdf->Text(25, 15, 'University of Engineering & Technology');
$pdf->SetY(6);
$pdf->SetX(79);
$pdf->WriteHTML('<b><i><u>Bank Copy</u></i></b>');
#User Information
$pdf->SetLineWidth(0.4);
$pdf->Rect(5,25,92,5);
$pdf->Text(6, 28.5, 'U.E.T. NTN');
$pdf->SetFont('Arial', 'B',11);
$pdf->Text(5, 37, 'Invoice #:');
$pdf->Text(24, 37, sprintf('%014d', $inv_id));
$pdf->Text(5, 43, 'Name:');
$pdf->Text(18, 43, $title ." ". $fname. " ". $lname);
$pdf->Text(5, 49, 'U.E.T. Donation');
$pdf->Text(5, 52.5, '___________________________________________');

#Table
$pdf->Rect(75,55,23,5.5);
$pdf->SetFont('Arial', '',10);
$pdf->Text(83, 59, $currency);

$pdf->SetY(62);

$sql= "SELECT particular_id, amount, batch_id FROM invoice_particulars WHERE invoice_id=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $inv_id);
$stmt->execute();
$result = $stmt->get_result();
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
      $sql1= "SELECT batch_name FROM batch_fund where batch_id=?";
      $stmt = $conn->prepare($sql1); 
      $stmt->bind_param("i", $batch_id);
      $stmt->execute();
      $result1 = $stmt->get_result();
      while($row = mysqli_fetch_array($result1)) 
      {
             $batch_name=$row['batch_name'];
            
      }
    }

    $sql2="SELECT particular_name FROM particulars where particular_id=?";
    $stmt = $conn->prepare($sql2); 
    $stmt->bind_param("i", $particular_id);
    $stmt->execute();
    $result2 = $stmt->get_result();
    while($row = mysqli_fetch_array($result2)) 
    {
          $particular_name=$row['particular_name'];
    }   
    $y = $pdf->GetY();
    $pdf->SetX(5);
    $pdf->MultiCell(70, 5.5,  $particular_name, 1, 'L');  
    $pdf->SetY($y);
    $pdf->SetX(75);
    $pdf->MultiCell(23, 5.5,  $amount, 1, 'R'); 
    $pdf->MultiCell(70, 1,  "");

  } 
  $pdf->SetX(5);
  $pdf->SetFont('Arial', 'B',10);
  $y = $pdf->GetY();
  $pdf->MultiCell(70, 5.5,  "Total Payable", 1, 'L');
  $pdf->SetY($y);
  $pdf->SetX(75); 
  $pdf->Cell(23, 5.5,  $total. "/-", 1, 'R');
  $pdf->MultiCell(70, 5,  "");
  $pdf->SetX(3.5);
  $pdf->WriteHTML('________________________________________________');
}  

#Divider
$pdf->SetX(99);
$pdf->Line(101,1,101,200);
#Note
$pdf->SetFont('Arial', '',7.4);
$pdf->Text(5, 198, 'This is a computer generated voucher and does not need a sugnature or stamp');
$pdf->Rect(3,194,95,6);

#------------Donor Copy------------#
#Head
$image="images/uet-logo.png";
$pdf->Image($image, 104, 2, 18);
$pdf->SetFont('Arial', '',10);
$pdf->Text(125, 10, 'U.E.T. Donations');
$pdf->Text(125, 15, 'University of Engineering & Technology');
$pdf->SetY(6);
$pdf->SetX(178);
$pdf->WriteHTML('<b><i><u>Donor Copy</u></i></b>');
#User Information
$pdf->SetLineWidth(0.4);
$pdf->Rect(105,25,93,5);
$pdf->Text(106, 28.5, 'U.E.T. NTN');
$pdf->SetFont('Arial', 'B',11);
$pdf->Text(105, 37, 'Invoice #:');
$pdf->Text(124, 37, sprintf('%014d', $inv_id));
$pdf->Text(105, 43, 'Name:');
$pdf->Text(118, 43, $title ." ". $fname. " ". $lname);
$pdf->Text(105, 49, 'U.E.T. Donation');
$pdf->Text(105, 52.5, '___________________________________________');

#Table
$pdf->Rect(175,55,23,5.5);
$pdf->SetFont('Arial', '',10);
$pdf->Text(183, 59, $currency);

$pdf->SetY(62);

$sql= "SELECT particular_id, amount, batch_id FROM invoice_particulars WHERE invoice_id=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $inv_id);
$stmt->execute();
$result = $stmt->get_result();
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
      $sql1= "SELECT batch_name FROM batch_fund where batch_id=?";
      $stmt = $conn->prepare($sql1); 
      $stmt->bind_param("i", $batch_id);
      $stmt->execute();
      $result1 = $stmt->get_result();
      while($row = mysqli_fetch_array($result1)) 
      {
             $batch_name=$row['batch_name'];
            
      }
    }

    $sql2="SELECT particular_name FROM particulars where particular_id=?";
    $stmt = $conn->prepare($sql2); 
    $stmt->bind_param("i", $particular_id);
    $stmt->execute();
    $result2 = $stmt->get_result();
    while($row = mysqli_fetch_array($result2)) 
    {
          $particular_name=$row['particular_name'];
    }   
    $y = $pdf->GetY();
    $pdf->SetX(105);
    $pdf->MultiCell(70, 5.5,  $particular_name, 1, 'L');  
    $pdf->SetY($y);
    $pdf->SetX(175);
    $pdf->MultiCell(23, 5.5,  $amount, 1, 'R'); 
    $pdf->MultiCell(70, 1,  "");

  } 
  $pdf->SetX(105);
  $pdf->SetFont('Arial', 'B',10);
  $y = $pdf->GetY();
  $pdf->MultiCell(70, 5.5,  "Total Payable", 1, 'L');
  $pdf->SetY($y);
  $pdf->SetX(175);
  $pdf->Cell(23, 5.5,  $total. "/-", 1, 'R');
  $pdf->MultiCell(70, 5,  "");
  $pdf->SetX(103.5);
  $pdf->WriteHTML('________________________________________________');
}  

#Divider
$pdf->SetX(99);
$pdf->Line(202,1,202,200);
#Note
$pdf->SetFont('Arial', '',7.4);
$pdf->Text(106, 198, 'This is a computer generated voucher and does not need a sugnature or stamp');
$pdf->Rect(104,194,95,6);

#------------Important Information------------#
#Head
$pdf->SetFont('Arial', '',8);
$pdf->Text(205.5, 9, 'Important Information');
$pdf->SetLineWidth(0.4);
$pdf->Rect(204.5,4,90,7);
#Information
$pdf->SetFont('Arial', '',8);
$pdf->SetY(13);
$pdf->SetX(204);
$pdf->WriteHTML('<b><u>Mode of Payment</u></b>');
$pdf->Text(205, 22, 'Your donation slip has been generated. You can pay via either Bill,');
$pdf->Text(205, 26, 'Online/Credit/Debit Card, ATM or Bank Deposit.');
$pdf->SetY(30);
$pdf->SetX(204);
$pdf->WriteHTML('<b><u>Bank Information</u></b>');

#Table 1, Column 1
$pdf->SetLineWidth(0.4);
$pdf->Rect(205,36,35,7);
$pdf->SetY(37);
$pdf->SetX(206);
$pdf->WriteHTML('<b>Account Title</b>');
$pdf->Rect(205,43,35,7);
$pdf->Text(207, 47.5, 'Account Number');
$pdf->Rect(205,50,35,7);
$pdf->Text(207, 54.5, 'Bank Name');
$pdf->Rect(205,57,35,7);
$pdf->Text(207, 61.5, 'Bank Address');
$pdf->Rect(205,64,35,7);
$pdf->Text(207, 68.5, 'IBAN');
$pdf->Rect(205,71,35,7);
$pdf->Text(207, 75.5, 'Swift Code');
$pdf->Rect(205,78,35,7);
$pdf->Text(207, 82.5, 'Branch Code');

#Table 1, Column 2
$pdf->SetLineWidth(0.4);
$pdf->Rect(240,36,54.5,7);
$pdf->SetY(37);
$pdf->SetX(241);
$pdf->WriteHTML('<b>U.E.T. Lahore Alumni Fund</b>');
$pdf->Rect(240,43,54.5,7);
$pdf->Text(242, 47.5, '01287903038101');
$pdf->Rect(240,50,54.5,7);
$pdf->Text(242, 54.5, 'Habib Bank Account');
$pdf->Rect(240,57,54.5,7);
$pdf->Text(242, 61.5, 'U.E.T., Lahore');
$pdf->Rect(240,64,54.5,7);
$pdf->Text(242, 68.5, 'PK27HABB0001287903038101');
$pdf->Rect(240,71,54.5,7);
$pdf->Text(242, 75.5, 'HABBPKKA');
$pdf->Rect(240,78,54.5,7);
$pdf->Text(242, 82.5, '0128');

#Table 2, Column 1
$pdf->SetLineWidth(0.4);
$pdf->Rect(205,88,35,7);
$pdf->SetY(89);
$pdf->SetX(206);
$pdf->WriteHTML('<b>Account Title</b>');
$pdf->Rect(205,95,35,7);
$pdf->Text(207, 99.5, 'Account Number');
$pdf->Rect(205,102,35,7);
$pdf->Text(207, 106.5, 'Bank Name');
$pdf->Rect(205,109,35,7);
$pdf->Text(207, 113.5, 'Bank Address');
$pdf->Rect(205,116,35,7);
$pdf->Text(207, 120.5, 'IBAN');
$pdf->Rect(205,123,35,7);
$pdf->Text(207, 127.5, 'Swift Code');
$pdf->Rect(205,130,35,7);
$pdf->Text(207, 134.5, 'Branch Code');

#Table 2, Column 2
$pdf->SetLineWidth(0.4);
$pdf->Rect(240,88,54.5,7);
$pdf->SetY(89);
$pdf->SetX(241);
$pdf->WriteHTML('<b>U.E.T. Zakat Fund</b>');
$pdf->Rect(240,95,54.5,7);
$pdf->Text(242, 99.5, '01280035900301');
$pdf->Rect(240,102,54.5,7);
$pdf->Text(242, 106.5, 'Habib Bank Account');
$pdf->Rect(240,109,54.5,7);
$pdf->Text(242, 113.5, 'U.E.T., Lahore');
$pdf->Rect(240,116,54.5,7);
$pdf->Text(242, 120.5,'PK13HABB0001280035900301');
$pdf->Rect(240,123,54.5,7);
$pdf->Text(242,127.5, 'HABBPKKA');
$pdf->Rect(240,130,54.5,7);
$pdf->Text(242, 134.5, '0128');

#Print pdf
$pdf->Output('invoice.pdf', 'D');
?>