<?php

require_once "../../config.php";
require_once "../../header.php";
require_once "../../navigation.php";
?>

<div class="">
  <table class="table table-hover table-size" border="3">
    <thead>
      <tr>
        <th>Product owner</th>
        <th>Product name</th>
        <th>Product Quantity</th>
        <th>Date Ordered</th>
        <th>Status</th>
        <th>Modify</th>
      </tr>
    </thead>
    <tbody>
      <?php

      $cartOwnerId = $_SESSION["user_id"];

      if (!empty($_REQUEST)) {

        $productId = $_REQUEST["id"];
        $orderQuantity = $_REQUEST["quantity"];
        $productQuantity = 0;

        $sql = "SELECT * FROM products WHERE product_id ='$productId'";
        $result = $con -> query($sql);
        $resultCount = $result -> num_rows;

        if ($resultCount > 0) {
          $row = $result -> fetch_assoc();
          $productId = $row['product_id'];
          $productOwnerId = $row['user_id'];
          $productName = $row['product_name'];
          $productQuantity = $row['product_quantity'];
        }

        $currentQuantity = $productQuantity - $orderQuantity;
        $updateQuantitySql = "UPDATE products SET product_quantity= '$currentQuantity' WHERE product_id = '$productId'";
        $con -> query($updateQuantitySql);

        $insertSql = "INSERT INTO orders(product_owner_id, cart_owner_id, product_id, order_status, order_quantity)
        VALUES(
          $productOwnerId,
          $cartOwnerId,
          $productId,
          'In-Cart',
          $orderQuantity
        )";
        $con ->query($insertSql);
      }

      $getOrderSql = "SELECT * FROM orders where cart_owner_id =  $cartOwnerId";
      $orderResult = $con -> query($getOrderSql);
      $orderResultCount = $orderResult -> num_rows;

      if ($orderResultCount > 0) {
        while ($orderRow = $orderResult -> fetch_assoc()) {
          $orderId = $orderRow['order_id'];
          $orderQuantity = $orderRow['order_quantity'];
          $dateOrdered = $orderRow['ordered_date'];
          $orderStatus = $orderRow['order_status'];
          $removeFromCart = "<a href=\"/TindaJaro/homepage/cart/deletefromcart.php?id=$orderId\"><span class= \"glyphicon glyphicon-trash\"></span></a>";
          $purchaseItem = "<a href=\"\" class= \"btn btn-primary\">Purchase</a>";

          echo "<tr>";
          echo "<td>" . "</td>";
          echo "<td>" . "</td>";
          echo "<td>" . $orderQuantity . "</td>";
          echo "<td>" . $dateOrdered . "</td>";
          echo "<td>" . $orderStatus . "</td>";
          echo "<td>" . $removeFromCart . "   " . $purchaseItem .  "</td>";
          echo "</tr>";
        }
      }
      ?>
    </tbody>
  </table>
</div>
</body>
