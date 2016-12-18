<?php
require('config.php');

$productId = $_POST['productId'];
$bankQuantity = $_POST['bankQuantity'];
$productQuantity = $_POST['productQuantity'];

if($bankQuantity > $productQuantity)
{
	$sql = "delete from products where id='$productId'";
    $connection->query($sql);
    echo 0;
    die();
}
else
{
	$return=$productQuantity-$bankQuantity;
	$sql = "update products set quantity='$return' where id='$productId'";
    $connection->query($sql);
    echo $return;
    die();
}
die();

?>