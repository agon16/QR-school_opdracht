<?php

session_start();
require 'backend/config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: www.google.com");
} else {
    $user_id = $_SESSION['user_id'];
}

$sql = "SELECT * FROM users WHERE id = '$user_id'";
$query = $con->query($sql);
while( $result = $query->fetch_assoc() ) {
    $id_card        = $result['id_card'];
    $firstname      = $result['firstname'];
    $lastname       = $result['lastname'];
}

$con->close(); //Close connection

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css.map">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" type="text/css" href="css/my_css.css">
    <link rel="stylesheet" type="text/css" href="css/agon_css.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Aanvragen</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <body>
    <div class="container">
        <img style="display: block; margin-left: auto; margin-right: auto;" src="img/Panem_Symbol">
        <div class="form-group">
          <label for="inputsm">Telefoon nummer</label>
          <input class="form-control input-sm" type="number" id="replyNumber" min="0" data-bind="value:replyNumber"  placeholder="+5977211511" />
        </div>
        <div class="form-group">
          <label for="inputsm">Email adress</label>
          <input class="form-control input-sm" id="email" type="text" for="email" placeholder="agon@hotmail.com" >
        </div>
        <div class="checkbox cbb_gegevens">
          <p>
            <label>
              <input type="checkbox" id="request_passport">
              <p>Paspoort aanvragen</p>
            </label>
          </p>
          <p class="right_pos"><label><input type="checkbox" id="request_birth_cert">Geboorteakte aanvragen</label></p>
        </div>
        <button id="send" class="btn btn-primary btn-lg btn-block">Verzoek versturen</button>
    </div>





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/my_js.js"></script>
    <script>
      $('#request_passport').click(function() {
        var elem = document.getElementById('request_passport');
        if(elem.hasAttribute("checked") == true) {
          elem.removeAttribute("checked");
        } else {
          elem.setAttribute('checked', 'checked');
        }
      });

      $('#request_birth_cert').on('mouseup', function() {
        var elem = document.getElementById('request_birth_cert');
        if(elem.hasAttribute("checked") == true) {
          elem.removeAttribute("checked");
        } else {
          elem.setAttribute('checked', 'checked');
        }
      });

      $('#send').click(function() {
        var gsm = $('#replyNumber').val();
        var email = $('#email').val();
        var id_card = '<?php echo $id_card; ?>';
        var name = '<?php echo $firstname.' '.$lastname; ?>';
        var request_passport = '';
        var request_birth_cert = '';
        
        if(document.getElementById('request_passport').hasAttribute("checked") == true) {
          request_passport = 'Passpoort aanvraag';
        }

        if(document.getElementById('request_birth_cert').hasAttribute("checked") == true) {
          request_birth_cert = 'Geboorte akte aanvraag';
        }

        $.post('http://timmy1420.hol.es/email/send.php/send.php', {id_card: id_card, name: name, gsm: gsm, email: email, request_passport: request_passport, request_birth_cert: request_birth_cert}, function(data) {
          //Continue
          alert("Aanvraag verzonden...");
        });

      });
    </script>
  </body>
</html>

<?php

if(isset($_SESSION['user_id'])) {
    echo $_SESSION['user_id'];
}

?>