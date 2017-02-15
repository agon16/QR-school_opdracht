<?php

	$host = 'localhost';
	$database = 'identify_me';
	$username = 'root';
	$password = '';

	$con=new mysqli($host, $username, $password, $database);
	if($con->connect_error) {
		die("Connection failed: ".$con->connect_error);
		mysqli_close($con);
	}

?>