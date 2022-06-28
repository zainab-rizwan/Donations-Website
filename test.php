<?php 
    function numberTowords($num)
    { 
    $ones = array( 
    1 => "one", 
    2 => "two", 
    3 => "three", 
    4 => "four", 
    5 => "five", 
    6 => "six", 
    7 => "seven", 
    8 => "eight", 
    9 => "nine", 
    10 => "ten", 
    11 => "eleven", 
    12 => "twelve", 
    13 => "thirteen", 
    14 => "fourteen", 
    15 => "fifteen", 
    16 => "sixteen", 
    17 => "seventeen", 
    18 => "eighteen", 
    19 => "nineteen" 
    ); 
    $tens = array( 
    1 => "ten",
    2 => "twenty", 
    3 => "thirty", 
    4 => "forty", 
    5 => "fifty", 
    6 => "sixty", 
    7 => "seventy", 
    8 => "eighty", 
    9 => "ninety" 
    ); 
    $hundreds = array( 
    "hundred", 
    "thousand", 
    "million", 
    "billion", 
    "trillion", 
    "quadrillion" 
    ); //limit t quadrillion 
    $num = number_format($num,2,".",","); 
    $num_arr = explode(".",$num); 
    $wholenum = $num_arr[0]; 
    $decnum = $num_arr[1]; 
    $whole_arr = array_reverse(explode(",",$wholenum)); 
    krsort($whole_arr); 
    $rettxt = ""; 
    foreach($whole_arr as $key => $i){ 
    if($i < 20){ 
    $rettxt .= $ones[$i]; 
    }elseif($i < 100){ 
    $rettxt .= $tens[substr($i,0,1)]; 
    $rettxt .= " ".$ones[substr($i,1,1)]; 
    }else{ 
    $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
    $rettxt .= " ".$tens[substr($i,1,1)]; 
    $rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
    $rettxt .= " ".$hundreds[$key]." "; 
    } 
    } 
    if($decnum > 0){ 
    $rettxt .= " and "; 
    if($decnum < 20){ 
    $rettxt .= $ones[$decnum]; 
    }elseif($decnum < 100){ 
    $rettxt .= $tens[substr($decnum,0,1)]; 
    $rettxt .= " ".$ones[substr($decnum,1,1)]; 
    } 
    } 
    return $rettxt; 
    } 

    extract($_POST);
    if(isset($convert))
    {
    echo "<p align='center' style='color:blue'>".numberTowords("$num")."</p>";
    }

?>

<html>
    <head>
        <title>Conver Number to Words in PHP</title>
    </head>
    <body>
        <form method="post">
            <table border="1" align="center">
                <tr>
                <td>Enter Your Numbers</td>
                <Td><input type="text" name="num" value="<?php if(isset($num)){echo $num;}?>"/></Td>
                </tr>
                <tr>
                <td colspan="2" align="center">
                <input type="submit" value="Conver Number to Words" name="convert"/>
                </td>
                </tr>
            </table>
        </form>
    </body>
</html>