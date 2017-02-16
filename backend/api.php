<?php

require 'config.php';

@$data = $_POST['data'];
// $data = 'qr_data_of_tim';

$sql = "SELECT user_id FROM qr_data WHERE data = '$data'";
$user_id = '';
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
	$user_id = $row['user_id'];

	//Get username
	$sql = "SELECT * FROM users WHERE id = '$user_id'";
	$result = $con->query($sql);
	if($result->num_rows == 1) {
		while ($row = $result->fetch_assoc()) {
			$username = $row['username'];
			print_r($array = json_encode(array("result" => "true", 'username' => $username)));
		}
	} else {
		print_r($array = json_encode(array("result" => "false")));
	}
}



?>