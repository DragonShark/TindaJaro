<?php

  require_once "../../config.php";

  $productOwnerId = $_SESSION['user_id'];
  $notification = "";

  $sql = "SELECT * FROM products WHERE user_id != '$productOwnerId'";
  $result = $con -> query($sql);
  $result_count = $result -> num_rows;

  if ($result_count > 0) {
    while ($row = $result -> fetch_assoc()) {
      $productPhoto = str_replace("../", "", $row['product_photo']);
      $productPrice = $row['product_price'];
      $productQuantity = $row['product_quantity'];
      $productName = $row['product_name'];
      $productDate = $row['product_date'];
      $productId = $row['product_id'];
      $productImage = "<img class= \"container-image\" src=\"$productPhoto\" alt=\"$productName.jpeg\" />";
      $addToCart = "<a href=\"/TindaJaro/homepage/modal.php?id=$productId\"><span class= \"glyphicon glyphicon-shopping-cart\"></span></a>";

      if (!$productQuantity <= 0) {
        echo "<tr> ";
        echo "<td>" . $productImage . "</td>";
        echo "<td>" . $productName . "</td>";
        echo "<td>" . $productQuantity . "</td>";
        echo "<td>" . $productPrice . "</td>";
        echo "<td>" . $productDate . "</td>";
        echo "<td>" . $addToCart . "</td>";
        echo "</tr>";
      } else {
        $deleteSql = "DELETE FROM products WHERE product_quantity= 0";
        $con -> query($deleteSql);
      }
    }
  }
 ?>
