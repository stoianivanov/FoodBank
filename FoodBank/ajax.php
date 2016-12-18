<?php
require('config.php');
session_start();


$shop_id=$_SESSION['user_id'];
$productName=$_POST['producName'];
$productType=$_POST['productType'];
$productQuantity=$_POST['productQuantity'];
$productPpu=$_POST['productPpu'];
$productExpiration=$_POST['productExpiration'];

if(isset($_POST['producName']))
{

	$sql = "insert into products (shop_id, quantity, ppu, type, expiration_date, name) values ('$shop_id', '$productQuantity', '$productPpu', '$productType', '$productExpiration', '$productName')";
	$connection->query($sql);
}
die();
?>