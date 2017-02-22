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
    $married        = $result['married'];
    $birth_date     = $result['birth_date'];
    $birth_place    = $result['birth_place'];
    $address        = $result['address'];
    $housenumber    = $result['housenumber'];
    $gender         = $result['gender'];

    //Gender
    if($gender == 'male') {
        $gender = 'M';
    } else if($gender == 'female') {
        $gender = 'V';
    }

    //Married
    if($married == 'no') {
        $married = 'Ongehuwd';
    } else if($married == 'yes') {
        $married == 'Gehuwd';
    }

    $current_date = date('d m Y');
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
    <link rel="stylesheet" type="text/css" href="css/agon_css.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HOME</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <div class="print_window" style="background: #F4F4F4" align="center">
            <br>
        <button class="btn btn-success" onclick="printJob();">Uitprinten</button>
        <button class="btn btn-primary" onclick="window.location = 'menu.php';">Terug</button>
            <br>
            <br>
    </div>

        <div class="main_uittreksel">
            <div class="cbb_gegevens">   
                <h1 class="hoofd_letter">Bureau voor burgerzaken</h1>
                <p><label class="hoofd_letter lbl_grote_80 lbl_border">distrikt</label><span>Wanica</span></p>
                <p class="center"><label class="hoofd_letter lbl_grote_80 lbl_border">bureau</label><span>pad van wanica</span></p>
                <hr class="style-seven">
            </div>
            <div class="cbb_bevolking">
                <h3>Bewijs van Inschrijving in het bevolkingsregister</h3>
                <hr class="style-seven">
            </div>
            <br>
            <div class="cbb_gegevens">
                <p><label class="lbl_grote_170 hoofd_letter lbl_border">Identiteitsnummer</label><span><?php echo $id_card; ?></span></p>
                <p class="center"><label class="lbl_grote_80 hoofd_letter lbl_border">Geslacht</label><span><?php echo $gender; ?></span></p>
            </div>
            <div class="cbb_gegevens">
                <p><label class="lbl_grote_170 hoofd_letter lbl_border">naam</label><span><?php echo $lastname; ?></span></p>
            </div>
            <div class="cbb_gegevens">
                <p><label class="lbl_grote_170 hoofd_letter lbl_border">Voorna(a)m(en)</label><span><?php echo $firstname; ?></span></p>
            </div>
            <div class="cbb_gegevens">
                <p><label class="lbl_grote_170 hoofd_letter lbl_border">Burgerlijke Staat</label><span><?php echo $married; ?></span></p>
            </div>
            <div class="cbb_gegevens">
                <p><label class="lbl_grote_170 hoofd_letter lbl_border">Geboortedatum</label><span><?php echo $birth_date; ?></span></p>
                <p class="center"><label class="lbl_grote_80 hoofd_letter lbl_border">Te</label><span><?php echo $birth_place; ?></span></p>
            </div>
            <div class="cbb_gegevens">
                <p><label class="lbl_grote_170 hoofd_letter lbl_border">Adress</label><span><?php echo $address; ?></span></p>
                <p style="float: right;"><label class="lbl_grote_80 hoofd_letter lbl_border">NR</label><span><?php echo $housenumber; ?></span></p>
            </div>
            <div class="cbb_gegevens">
                <p><label class="lbl_grote_170 hoofd_letter lbl_border">Registratiedatum</label></p>
            </div>
            <br>
            <br>
            <div class="cbb_gegevens">
                <p><label style="margin-right: 5px;" class="lbl_grote_170 hoofd_letter">leges</label><span>SRD1,-</span></p>
                <p class="center"><label class="hoofd_letter lbl_grote_170" style="
    margin-right: 5px;"">Datum van afgifte</label><span><?php echo $current_date; ?></span></p>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/my_js.js"></script>

        <script type="text/javascript">
            function printJob() {
                var windowPrint = document.getElementsByClassName('print_window')[0];
                windowPrint.style.display = "none";

                setTimeout(function() {
                    window.print();
                    windowPrint.style.display = "";
                }, 1500);



            }
        </script>
    </body>
</html>