<?php

    session_start();
    include('backend/config.php');

    if(isset($_SESSION['user_id'])) {
        echo $_SESSION['user_id'];
    }

    if(isset($_POST['login'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($_POST['username']) || empty($_POST['password'])) {
            echo "Vul in velden";
        } else {
            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $query = $con->query($sql);
            if($query->num_rows == 1) {

                $result = $query->fetch_assoc();

                $_SESSION['user_id'] = $result['id'];

                header("location: menu.php");
            } else if($query->num_rows == 0) {
                $alertMsg = '<div class="alert alert-warning" role="alert">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                      <span class="sr-only">Fout melding!:</span>
                      Inlog gegevens niet juist
                    </div>';
            } else {
                // echo mysqli_error($con);
                $alertMsg = '<div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                      <span class="sr-only">Fout melding!:</span>
                      Systeem melding'.mysqli_error($con).'
                    </div>';
            }
        }

    }

    if(isset($_GET['qrcode'])) { //Fetch QR Code data from upload qr-code
        $qrcode = $_GET['qrcode'];
        // echo $qrcode;
        $username_encryption = 'enabled';
        $username_input = '<input type="password" value="'.$qrcode.'" class="form-control" placeholder="Gebruikersnaam" name="username">';
    } else {
        $username_encryption = 'disabled';
        $username_input = '<input type="text" class="form-control" placeholder="Gebruikersnaam" name="username">';
    }
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css.map"> -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" type="text/css" href="css/homecss.css">
	<link rel="icon" href="Panem_Symbol.png">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Identify Me</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    </head>

<body style="background-color:#000;">
    <div class="main">
    	<figure></figure>
    	<figure></figure>
    	<figure></figure>
    	<figure></figure>
    	<figure></figure>
    </div>
        
            <nav class="navbar navbar-primary navbar-fixed-top">
            <div class="container container-fluid">    

                <div class="row nav">
                    <div class="col-sm-3">
    				
                        <p>Indentify me</p>
                    </div>
                    <i class="glyphicon glyphicon-user user"></i>
                    <div class="pull-right nav">

                        <form class="navbar-form navbar-right form" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div>
                                <?php echo $username_input; ?>

                                <input type="password" class="form-control" placeholder="Wachtwoord" name="password">

                                <button type="submit" class="btn btn-default" name="login">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

<div class=" panel pull-right pan">
  <div class="panel-body panstuff">
    <img src="Panem_Symbol.png" width="340" class="img-responsive center-block"></br>

        <?php 
            if(isset($alertMsg)) {
                echo $alertMsg;
            } 
        ?>
    
        <h2> Log ook in met de QR-Code</h2></br>


    <button class="btn btn-default" data-toggle="modal" data-target="#myModal" id="scan_init">Scan QR-Code</button>
    <button class="btn btn-default" type="file" id="qr_upload">Upload QR-Code</button>
        <br><br>

    <form action="backend/uploads/qrupload.php" method="post" enctype="multipart/form-data">
        <input class="pull-right" type="file" name="qr_image" style="display: none">
        <input type="submit" name="submit" style="display: none">
    </form>

	<div id="spacer" style="display: none">
        <br><br>
    </div>

	<p style="font-size: 20px;">Nog geen account:</p>  <a style="font-size: 20px; text-decoration:none;" href="index.html"><i class="glyphicon glyphicon-user sign"></i> 
        Registreren</a>
  </div>
</div>

<h1 id="eloket">
E-loket
</h1><br>
<h3 id="burgerzaken">voor burgerzaken</h3><br><br>
<h3 id="scan">Scan, log in en print</h3>

<!-- QR-Code Modal window -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Scan met QR-Code</h4>
      </div>
      <div class="modal-body">
        <!-- <img src="qrcode.jpg" width="150" class="img-responsive center-block"> -->
        <div align="center">
            <p>Hou de QR-Code voor de camera om het te scannen.</p>
            <div id="videoError">
                <!-- Error content here -->
            </div>
            <div id="scanner" style="width:450px;height:450px;">
                <!-- Scanner here -->
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

<!-- Bootstrap JS -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!-- QR-Code JS -->
<script type="text/javascript" src="js/html5-qrcode.min.js"></script>
<script type="text/javascript" src="js/my_js.js"></script>
<script type="text/javascript">
    var username_encryption = '<?php echo $username_encryption; ?>';
    if(username_encryption == 'enabled') {
        $('[name="username"]').attr('text', 'password');
    }
</script>

</body>

</html>
