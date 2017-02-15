<?php 
  session_start();

  if (isset($_SESSION['usr_id'])) {
    header("Location: index.php");
  }

  include('backend/config.php');

  //set validation error flag as false
  $error = false;
  $name= "String";

 
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
            <input type="text" name="id_nummer" id="id_nummer" class="form-control" placeholder="ID-nummer" required="" autofocus="">
              <br>
            <!-- <label for="inputPassword" class="sr-only">Password</label> -->
  		  
  		      <input type="text" name="gebruikersnaam" id="gebruikersnaam" class="form-control" placeholder="Gebruikersnaam" required="" autofocus="" value="<?php if($error) echo $name; ?>">
            <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span> 
              <br>
  		      <input type="text" name="email_adress" id="email_adress" class="form-control" placeholder="E-mailadres" required="" autofocus="" value="<?php if($error) echo $email; ?>"><span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
              <br>
            <input type="password" name="password" id="password" class="form-control" placeholder="Wachtwoord" required="">
            <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
            <br>
            <p><input name="action" type="hidden" value="login"></p>
            <button type="submit" class="btn btn-default btn-block" name="signup">Registreren</button>
            <br>
          <p style="font-size: 20px;">Inloggen met: <a style="text-decoration:none; font-size:20px;" href="login.php" class="btn"><i class="glyphicon glyphicon-qrcode"></i> QR-Code</a></p>
        </div>
         <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

      </div> <!-- /container -->
    </form>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="npm.js"></script>
  </body>
</html>

<?php
 //check if form is submitted

  if (isset($_POST['signup'])) {
    $id_nummer = $_POST['id_nummer'];
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $email = $_POST['email_adress'];
    $password = $_POST['password'];

    //naam bevat alleen letter en spatie
    // if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
    //   $error = true;
    //   $name_error = "Naam moet alleen letter en spatie bevatten";
    // }

    // if (!filter_var($email_adress,FILTER_VALIDATE_EMAIL)) {
    //   $error = true;
    //   $email_error = "Vul graag een goed email adress";
    // }
    // if (strlen($password) < 6) {
    //   $error = true;
    //   $password = "Uw wachtwoord moet minimaal 6 karakters";
    // }
    // if (strlen($id_nummer) == 8) {
    //   $error = true;
    //   $password = "Uw ID nummer moet 8 karakters bevatten inclusief spatie";
    // }

    // if (!$error) {
    //     if(mysqli_query($con, "INSERT INTO user (firstname, email, password) VALUES'$gebruikersnaam', '$email_adress', '$password')")) {
    //         $successmsg = "Succesvol geregistreerd! <a href='home.html'>Click here to Login</a>";
    //     } else {
    //         $errormsg = "Problemen met registreren ... Probeer het opnieuw!";
    //     }
    // }
    $sql = "INSERT INTO user (firstname, email, password) VALUES ('$gebruikersnaam', '$email', '$password')";
    if($con->query($sql)) {
          $successmsg = "Succesvol geregistreerd! <a href='home.html'>Click here to Login</a>";
      } else {
          // $errormsg = "Problemen met registreren ... Probeer het opnieuw!";
        echo mysqli_error($con);
      }

  }
?>