<?php

include '../../../backend/config.php';

if(isset($_POST['login'])) {

    //Input
    $username = sha1($_POST['username']);
    $password = sha1($_POST['password']);

    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $query = $con->query($sql);
    if($query->num_rows == 1) {
        while ($results = $query->fetch_assoc()) {
            $_SESSION['admin_user_id'] = $results['id'];

            header("Location: home.php");
        }
    } else {
        echo 0;
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/agon_css.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
        
            <h3>CBB Admin</h3>
            <form class="m-t" role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="*******" required="">
                </div>
                <button name="login" type="submit" class="btn btn-success block full-width m-b">Login</button>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
