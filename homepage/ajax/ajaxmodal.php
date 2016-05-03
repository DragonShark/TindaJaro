<?php

require_once "../../config.php";

if (!empty($_REQUEST)) {
  $productId = $_REQUEST["id"];

  $sql = "SELECT * FROM products WHERE product_id = '$productId'";
  $result = $con -> query($sql);
  $resultCount = $result -> num_rows;

  if ($resultCount > 0) {
    $row = $result -> fetch_assoc();
    $productName = $row['product_name'];
    $productPrice = $row['product_price'];
    $productQuantity = $row['product_quantity'];

    echo "Product Name: " . $productName . "<br> Product Price: Php " . $productPrice . "<br> Current Quantity: " . $productQuantity;
  }
}
?>
