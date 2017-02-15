<?php
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT firstname, password FROM user WHERE firstname = '$username' AND password = '$password'";

$result = mysqli_query($con,$sql);

if ($result->num_rows > 0) {
	header('Location:../views/qr_page.html');
}
else{
	header('Location:../index.html');
};



?>