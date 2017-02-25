<?php 
    
    session_start();
    include('backend/config.php');

    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }

$sql = "SELECT * FROM users WHERE id = '$user_id'";
$query = $con->query($sql);
while( $result = $query->fetch_assoc() ) {
    $credits = $result['credits'];
}

$con->close(); //Close connection

 ?>
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
    <link rel="stylesheet" type="text/css" href="css/inlogcss.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Identify Me || Home</title>

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
        <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            <div class="main_div"></div>
            <center style="
    background-color: white;
    margin: 0 200px;
    height: 400px;
    position: absolute;
    top: 20%;
">
                <img src="img/profile-icon-png-profiles-13.png"  class="img-responsive center-block" width="200"></p>
                <h1>Gebruiker instructies</h1>
                <div class="main-column" class="test_agon">
                        
                        <h3 id="thema">Uw burgerzaken thuis</h3>
                            <p id="instructies">Klik op de die verticale strepen links boven het scherm. Doe de keuze tussen: Passpoort en geboorteakte aanvraag en uittreksel uitprinten. </p> 

                </div>
            </center>                      

        </div>
        <!-- /#page-content-wrapper -->
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#"><i class="fa fa-qrcode" aria-hidden="true"></i>&nbsp; Identify me </a> 
                </li>
                <li class="sidebar-brand">
                    <p style="color: white; text-align: center;"><label>SRD</label><span><?php echo $credits; ?></span></p>
                </li>
            
                <li>
                    <a href="aanvragen.php"><i class="fa fa-id-card-o" aria-hidden="true"></i>&nbsp; Passpoort en geboorteakte aanvraag</a>
                </li>
                    
                <li>
                <a href="uittreksel.php"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp; uittreksel aanvraag </a>
                    
                </li>
               
                <br>
                <br>
                <br>
                <br><!-- 
                 <li>
                   <button type="button" class="btn btn-danger" >Log out</button>

                </li> -->
                 <li>
                    <button onclick="window.location = 'login.php';" class="btn btn-danger" style="width: 100%;">Log out</button>

                </li>
            </ul>
        </nav>
<body>


<script>
function myFunction() {
    window.print();
}
</script>





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="npm.js"></script>
    <script src="js/my_js.js"></script>
  </body>
</html>