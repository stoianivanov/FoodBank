<?php
require('config.php');

echo 5;
die();

if(isset($_POST['producName'])
{


	$sql = "insert into users (username, password, email, realname, type, type_id) values ('$username', '$password', '$email', 'Pesho', '$type', '1')";
	$connection->query($sql);
}
?>