<?php
require_once "../../config.php";
require_once "../../header.php";

$orderId = $_REQUEST['id'];

$sql = "UPDATE orders SET order_status = 'Pending' WHERE order_id = '$orderId'";
$con -> query($sql);

header("Location:/TindaJaro/homepage/cart/cart.php");
 ?>
