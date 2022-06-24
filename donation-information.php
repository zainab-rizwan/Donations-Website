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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>

<body>  

      <form action="insert.php" method="post" id="DonationForm" name="DonationForm">
        <div class="col-md-12">
            <div class="form-container">

               <h2 class="head-pay">How Would You Like To Pay?</h2>
                  <input type="radio" id="PKR" name="PKR" value="PKR"><label for="PKR">PKR</label><br>
                  <input type="radio" id="USD" name="USD" value="USD"><label for="USD">USD</label><br>

                <h2>How would you like to help?</h2>
                <p><b>I want to contribute to:</b> <span class="red">(Select Option(s). As Required)</span></p>
        
                <form class="payment-form">
                  <div class="form-group">
                      <input type="checkbox" onClick="enableDisableAmount('checkbox','chkDon-','txtDon-',37,37,'N','')" class="form-check-input" id="chkDon-37" name="chkDon-37" value="37"  >
                      <label for="chkDon-37" class="form-check-label">Give a Day to UET <img src="images/info.png" data-html="true" data-trigger="hover" data-placement="top"  data-toggle="popover"  data-content="Donate one day of your earnings towards Financial Aid scholars at UET"></label>
                      
                      <input type="text" autocomplete="off" maxlength="8" disabled value="" onkeypress="return isNumberKey(this.value,event);" id="txtDon-37" name="txtDon-37" class="form-control" placeholder="Amount in ">
                    </div>
                  
                  <div class="form-group">
                    <input type="checkbox" onClick="enableDisableAmount('checkbox','chkDon-','txtDon-',38,38,'N','')" class="form-check-input" id="chkDon-38" name="chkDon-38" value="38"  >
                    <label for="chkDon-38" class="form-check-label">Give a Day to LUMS - Zakat <img src="images/info.png" data-html="true" data-trigger="hover" data-placement="top"  data-toggle="popover"  data-content="Donate one day of your annual earnings towards our Zakat fund"></label>
                    
                    <input type="text" autocomplete="off" maxlength="8" disabled value="" onkeypress="return isNumberKey(this.value,event);" id="txtDon-38" name="txtDon-38" class="form-control" placeholder="Amount in ">
                  </div>
                  

                  <div class="form-group">
                    <input type="checkbox" onClick="enableDisableAmount('checkbox','chkDon-','txtDon-',3,3,'N','chkDonL-')" class="form-check-input" id="chkDon-3" name="chkDon-3" value="3"  >
                    <label for="chkDon-3" class="form-check-label">Class Fund <img src="images/info.png" data-html="true" data-trigger="hover" data-placement="top"  data-toggle="popover"  data-content="Pool funds by different batches that can be used towards scholarships or university wide initiatives"></label>
                    
                    <select disabled style="text-align:left;" class="form-control" id="chkDonL-3" name="chkDonL-3">
                    <option value="0">Choose...</option>
                       <option  value="4">B.Sc. 1998 Scholarship Fund</option>

                    </select>
                    <input type="text" autocomplete="off" maxlength="8" disabled value="" onkeypress="return isNumberKey(this.value,event);" id="txtDon-3" name="txtDon-3" class="form-control" placeholder="Amount in ">
                  </div>                                                                                              
                </form>


                <h2>What is your Affiliation with UET?</h2>
                <p><span class="red">(Select One. Required)</span></p>
                <div class="form-group">

                        <div class="div-radio">
                            <input type="radio"  onClick="enableDisableOther('N',1)"  class="form-check-input radio-inline" name="rdAff" id="rdAff-1" value="1"  >
                            <label for="rdAff-1" class="form-check-label label-inline">Alumni</label>
                        </div>
                        
                        <div class="div-radio">
                            <input type="radio"  onClick="enableDisableOther('N',2)"  class="form-check-input radio-inline" name="rdAff" id="rdAff-2" value="2"  >
                            <label for="rdAff-2" class="form-check-label label-inline">Faculty</label>
                        </div>
                        
                        <div class="div-radio">
                            <input type="radio"  onClick="enableDisableOther('N',3)"  class="form-check-input radio-inline" name="rdAff" id="rdAff-3" value="3"  >
                            <label for="rdAff-3" class="form-check-label label-inline">Student</label>
                        </div>
                        
                        <div class="div-radio">
                            <input type="radio"  onClick="enableDisableOther('N',4)"  class="form-check-input radio-inline" name="rdAff" id="rdAff-4" value="4"  >
                            <label for="rdAff-4" class="form-check-label label-inline">Staff</label>
                        </div>
                        
                        <div class="div-radio">
                            <input type="radio"  onClick="enableDisableOther('N',5)"  class="form-check-input radio-inline" name="rdAff" id="rdAff-5" value="5"  >
                            <label for="rdAff-5" class="form-check-label label-inline">Parent</label>
                        </div>
                        

                        <div class="div-radio">
                            <input type="radio"  onClick="enableDisableOther('Y',6)"  class="form-check-input radio-inline" name="rdAff" id="rdAff-6" value="6"  >
                            <label for="rdAff-6" class="form-check-label label-inline">Other</label>
                        </div>
                        
                        <input type="text" maxlength="30" autocomplete="off" disabled class="form-control input-small" placeholder="Please Specify" name="txtAff-6" id="txtAff-6" value="">
                         
                    <div class="text-center">
                        <button type="button" onClick="window.location.href='insert.php';" class="continue-btn">Continue</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
</body>

<script type="text/javascript">
  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
  });
</script>

<script>
  $(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
  });
  var ajax_load='<div class="loading"><img  src="images/loading.gif" height="60px" /></div>';
  
  function isNumberKey(evt)
  {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
     {
      return false;
    }
    else
    {       
      return true;
    }
  
  }

    function SubMe(ID)
  {
    document.suForm.suaction.value=ID;
    document.suForm.submit();
  }
  function enableDisableAmount(objType,objName,objAmountName,objID,masterObjID,subCat,objList)
  {
    if (objType=="checkbox")
    {
      if( $('#' + objName + objID).prop("checked") == true)
      {
        $("#" + objAmountName + objID).prop( "disabled", false);
        if (objList!="")    
          $("#" + objList + objID).prop( "disabled", false);
      }
      else
      {
        $("#" + objAmountName + objID).prop( "disabled", true);
        if (objList!="")    
          $("#" + objList + objID).prop( "disabled", true);
      }   
    } 
    if ((objType=="radio") && (subCat=="Y"))
    {
      hidDonCStr=affStr=$("#hidDonCStr" + masterObjID).val();
      hidDonCStr = hidDonCStr.split(",");
      for (i=0;i<hidDonCStr.length;i++)
      {
        $("#" + objAmountName + hidDonCStr[i]).prop( "disabled", true);       
      }
      
      $("#" + objAmountName + objID).prop( "disabled", false);        
    }
  }
  
  function enableDisableOther(otherStatus,objID)
  {
    affStr=$("#hidAffStr").val();
    affStr = affStr.split(",");
    for (i=0;i<affStr.length;i++)
    {
      otherOpt=affStr[i];
      otherOpt=otherOpt.split("-");
      if (otherOpt[1]=="Y")
        $("#txtAff-" + otherOpt[0]).prop( "disabled", true);
    }
    if (otherStatus=="Y")
    {
      $("#txtAff-" + objID).prop( "disabled", false);
    }
  }
  function refreshCurrency(selID)
  {
    totalCurObj=$('#hidCurCounter').val();
    for (i=1;i<=totalCurObj;i++)
    {
      $('#CUR-' + i).removeClass().addClass("currency-btn");
      
    }
    if (selID>=1)
    {
      $('#CUR-' + selID).removeClass().addClass("currency-btn-selected");
      
    }
  }
  function setCurrency(selID,mode)
  {
    totalCurObj=$('#hidCurCounter').val();
    for (i=1;i<=totalCurObj;i++)
    {
      $('#CUR-' + i).removeClass().addClass("currency-btn");
      
    }
        
    if (selID>=1)
    {
      $('#CUR-' + selID).removeClass().addClass("currency-btn-selected");
      $("#secDonation").show();
      
      $("#secDonation").html(ajax_load);    
      $.post(       
        "get-donation-information791c.html?_CURID=" + selID + "&_MODE=",    
        function(responseText)
        {
          $("#secDonation").html(responseText);
        },
        "html"
      );
      $(window).scrollTop($('#secDonation').offset().top);
    }   
  }
  
  

</script>



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