<?php
require_once "../../config.php";
require_once "../../header.php";

$orderId = $_REQUEST['id'];
$productId = 0;
$productQuantity = 0;
$orderQuantity = 0;

$sql = "DELETE FROM orders WHERE order_id = '$orderId'";
$con -> query($sql);

$orderSql = "SELECT * FROM orders WHERE order_id='$orderId'";
$result = $con -> query($orderSql);
$resultCount = $result -> num_rows;

if ($resultCount > 0) {
  $row = $result -> fetch_assoc();
  $productId = $row['product_owner_id'];
  $orderQuantity = $row['order_quantity'];
}

$productSql = "SELECT * FROM products WHERE product_id = '$productId'";
$productResult = $con -> query($productSql);
$productResultCount = $productResult -> num_rows;

if ($productResultCount > 0) {
  $productRow = $productResult -> fetch_assoc();
  $productQuantity = $productRow['product_quantity'];
}

$currentProductQuantity = $productQuantity + $orderQuantity;
$updateProductSql = "UPDATE products SET product_quantity ='$currentProductQuantity'";
header("Location:/TindaJaro/homepage/cart/cart.php");
 ?>
