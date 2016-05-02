<?php

require_once "../../config.php";

$sql = "SELECT * FROM products";
$result = $con -> query($sql);
$result_count = $result -> num_rows;

if ($result_count > 0) {
  while ($row = $result -> fetch_assoc()) {
    $product_photo = str_replace("../", "", $row['product_photo']);
    $product_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];
    $product_name = $row['product_name'];
    $product_date = $row['product_date'];
    $product_id = $row['product_id'];
    $product_image = "<img class= \"container-image\" src=\"$product_photo\" alt=\"$product_name.jpeg\" />";
    $addToCart = "<a href=\"/TindaJaro/homepage/modal.php?id=$product_id\"><span class= \"glyphicon glyphicon-shopping-cart\"></span></a>";

    echo "<tr> ";
    echo "<td>" . $product_image . "</td>";
    echo "<td>" . $product_name . "</td>";
    echo "<td>" . $product_quantity . "</td>";
    echo "<td>" . $product_price . "</td>";
    echo "<td>" . $product_date . "</td>";
    echo "<td>" . $addToCart . "</td>";
    echo "</tr>";
  }
}

 ?>
