<?php

require 'config.php';

@$id = $_POST['id'];

$sql = "SELECT * FROM users WHERE id_card = '$id'";
$result = $con->query($sql);
if($result->num_rows == 1) {
	while ($row = $result->fetch_assoc()) {
		$username = $row['username'];
		print_r($array = json_encode(array("result" => "true", 'username' => $username)));
	}
} else {
	print_r($array = json_encode(array("result" => "false")));
}

?>