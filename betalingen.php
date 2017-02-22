<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css.map">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" type="text/css" href="css/my_css.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HOME</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
  <body class="background_color">
    <div id="wrapper" class="active">
    <div id="wrapper">
        <div class="overlay"></div>
    <p style="text-align: center;"><img src="img/betalingen.png"  class="img-responsive center-block" width="200"></p>
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="menu.html"><i class="fa fa-qrcode" aria-hidden="true"></i>&nbsp; Identify me </a> 
                </li>
            
                <li>
                    <a href="betalingen.html"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp; Betalingen </a>
                </li>
                <li>
                    <a href="passpoort.html"><i class="fa fa-id-card-o" aria-hidden="true"></i>&nbsp; Passpoort aanvraag </a>
                </li>
                <li>
                <a href="familie.html"><i class="fa fa-address-book-o" aria-hidden="true"></i>&nbsp; Familieboek aanvraag </a>

                </li>
                    
                <li>
                <a href="uittreksel.html"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp; uittreksel  </a>
                    
                </li>
                <li>
                    <a href="homescan.html"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; log out </a>

                </li>
                <li>
                   <button onclick="myFunction()">Print</button>
                   </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        Betalingen.                         
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
<body>


<script>
function myFunction() {
    window.print();
}
</script>

</body>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="npm.js"></script>
    <script src="js/my_js.js"></script>
  </body>
</html>