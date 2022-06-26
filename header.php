

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
 <title>Giving to LUMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/responsive.css">
<link href="../../maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-221382542-1"></script>
<style type="text/css">

.section-top-bg {
    width: 100%;
    height: 543px;
    background-image: url(images/top-bg.png);
    background-size: cover;
    background-position: 50.00% 90.00%;
    overflow: hidden;
}

.intro-div {
    width: 85%;
    height: auto;
    background-color: white;
    margin-top: 350px;
    padding: 30px 125px 60px 125px;
    margin-left: auto;
    margin-right: auto;
}
.intro-div h1{
    text-align: center;
    color: #04198B;
    padding-bottom: 15px;
}
.intro-div p{
    text-align: center;
}

.section-content{
    margin-bottom: 0px;
}
.section-currency{
    margin-bottom: 0px;
}
.content{
    text-align: center;
    padding: 0px 160px 0px 160px;
}
.content h2{
    text-align: left;
}
h2.head-pay{
    text-align: center;
    padding-top: 30px;
}
.content p{
    text-align: left;
}

    

</style>
</head>
<body>

    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="images/uet.jpeg" height="125" alt="CoolBrand">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>


    <section class="section-top-bg" id="secMain">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="intro-div">
                    <h1>Donate Online</h1>
                    <p>Your support has enabled us to change the lives of numerous talented and deserving students. Our
                        team is here to help you route your gift. No matter where you are based, you can donate to LUMS
                        today.
                    </p>                    
                </div>
            </div>
        </div>
    </section>

        <section class="section-content" id="secLetStart">
        <div class="container">
            <div class="col-md-12">
                <div class="content">
                                          
                    <h2>Let's Get Started</h2>
                    <p>You can support LUMS in a variety of ways - from gifts towards our financial aid and NOP scholars or towards infrastructure and research. To make this gift, please use our secure online giving form. The process consists of <strong> a few easy steps and will only take a moment but the impact will last a lifetime.</strong></p> 
                </div>
            </div>
        </div>

    </section>

   

 <section class="section-currency">
        <div class="container" id="secAmountSelection" style="display:block">
            <div class="col-md-12">
                <div class="content">
                    <h2 class="head-pay">How Would You Like To Pay?</h2>
                                            <button type="button" value="1" id="CUR-1" name="CUR-1" class="currency-btn" onClick="setCurrency(1)">PKR</button>
                                            <button type="button" value="2" id="CUR-2" name="CUR-2" class="currency-btn" onClick="setCurrency(2)">USD</button>
                                        <input type="hidden" id="hidCurCounter" name="hidCurCounter" value="2">
                </div>
                
            </div>
        </div>
    </section>
    <section class="section-category-amount-affiliation">
        <div class="container" id="secDonation" style="display:none">                                    
            
        </div>
    </section>
    


</body>
<script>
    function setCurrency(selID)
    {
                
        if (selID>=1)
        {
            $('#CUR-' + selID).removeClass().addClass("currency-btn-selected");
            $("#secDonation").show();
            
            $("#secDonation").html(ajax_load);      
            $.post(           
                "index.html" + selID + "&_MODE=",        
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
</html>