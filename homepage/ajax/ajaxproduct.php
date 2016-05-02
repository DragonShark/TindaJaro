<?php

require_once "../../config.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM products where user_id = '$user_id'";
$result = $con -> query($sql);
$result_count = $result -> num_rows;

if ($result_count > 0) {
  while ($row = $result -> fetch_assoc()) {
    $product_photo = $row['product_photo'];
    $product_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];
    $product_name = $row['product_name'];
    $product_date = $row['product_date'];
    $product_id = $row['product_id'];
    $product_image = "<img class= \"container-image\" src=\"$product_photo\" alt=\"$product_name.jpeg\" />";
    $edit_product = "<a id=\"edit-$product_name\" href= \"/TindaJaro/homepage/vendor/editproduct.php?id=$product_id\"><span class= \"glyphicon glyphicon-edit\"></span></a>";
    $remove_product = "<a href=\"/TindaJaro/homepage/vendor/deleteproduct.php?id=$product_id\"><span class= \"glyphicon glyphicon-trash\"></span></a>";

    echo "<tr> ";
    echo "<td>" . $product_image . "</td>";
    echo "<td>" . $product_name . "</td>";
    echo "<td>" . $product_quantity . "</td>";
    echo "<td>" . $product_price . "</td>";
    echo "<td>" . $product_date . "</td>";
    echo "<td>" . $edit_product . " " . $remove_product . "</td>";
    echo "</tr>";
  }
}
?>
