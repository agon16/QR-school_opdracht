<?php 
  session_start();

  if(isset($_SESSION['user_id'])) {
    header("Location: login.php");
  }

  // $errMsg = '';
  // if(isset($_SESSION['errMsg'])) {
  //   $errMsg = $_SESSION['errMsg'];
  // }
  if(!isset($errMsg)) {
    $errMsg = '';
  }

  unset($_SESSION['errMsg']);

  include('backend/config.php');

  //set validation error flag as false
 
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
	<link rel="icon" href="img/profile-icon-png-profiles-13.png">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registratie | IdentifyMe</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="background_color">
    <!-- <form method="POST" action="#" autocomplete="off" name="signup"> -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="container">
          <br><br>
        <div class=" jumbotron">
            <p style="text-align: center;"><img src="img/profile-icon-png-profiles-13.png"  class="img-responsive center-block" width="200"></p>
            <h2 style="height:65px; text-align: center;" class="form-signin-heading">Registratie</h2>
            
              <!-- <label for="text" class="sr-only">ID nummer</label> -->
            <input type="text" name="id_card" id="id_card" class="form-control" placeholder="ID-nummer" required="" autofocus="">
              <br>
            <!-- <label for="inputPassword" class="sr-only">Password</label> -->
  		  
  		      <input type="text" name="username" id="username" class="form-control" placeholder="Gebruikersnaam" required="" autofocus="">
              <br>
  		      <input type="text" name="email" id="email" class="form-control" placeholder="E-mailadres" required="" autofocus="">
              <br>
            <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Telefoon" required="" autofocus="">
              <br>
            <input type="password" name="password" id="password" class="form-control" placeholder="Wachtwoord" required="">
            <br>
            <p><input name="action" type="hidden" value="login"></p>
            <button type="submit" class="btn btn-default btn-block" name="signup">Registreren</button>
            <br>
          <p style="font-size: 20px;">Inloggen met: <a style="text-decoration:none; font-size:20px;" href="login.php" class="btn"><i class="glyphicon glyphicon-qrcode"></i> QR-Code</a></p>

          <?php
          //check if form is submitted
          if(isset($_POST['signup'])) {
            $id_card = $_POST['id_card'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $password = $_POST['password'];

            $sql_det = "SELECT * FROM users WHERE id_card = '$id_card'";
            $result_det = $con->query($sql_det);

            $sql = "UPDATE users SET username = '$username', email = '$email', telephone = '$telephone', password = '$password' WHERE id_card = '$id_card'";

            if($result_det) {
              if ($result_det->num_rows > 0) {
                $con->query($sql);
                header("Location: login.php");
                echo "OK";
              } else if($result_det->num_rows == 0) {
                echo '<div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only">Error:</span>
                  ID kaart niet geldig.
                </div>';
              }
            } else {
              echo '<div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only">Error:</span>
                  Problemen met registreren. Probeer het opnieuw a.u.b.
                </div>';
            }
          }

        ?>

        </div>
      </div> <!-- /container -->
    </form>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="npm.js"></script>
  </body>
</html>