<?php

require_once "../../config.php";
require_once "../../header.php";
require_once "../../navigation.php";
?>

<div>
  <div class="well"><center><h3>My Cart</h3></center></div>
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
      $cartOwnerName = $_SESSION["irstname"];
      $productOwnerId = 0;
      $productId = 0;
      $productName = "";
      $productOwnerName ="";
      $notification = "";

      if (!empty($_REQUEST)) {
        $orderQuantity = $_REQUEST["quantity"];
        $productId = $_REQUEST["id"];
        $productQuantity = 0;
        $productOwnerId = 0;

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

        if ($cartOwnerId == $productOwnerId) {
          //do nothing
        } else {
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
        header('Location: /TindaJaro/homepage/cart/cart.php');
      }
//==============================================================================
      $getOrderSql = "SELECT * FROM orders where cart_owner_id =  $cartOwnerId";
      $orderResult = $con -> query($getOrderSql);
      $orderResultCount = $orderResult -> num_rows;

      if ($orderResultCount > 0) {
        while ($orderRow = $orderResult -> fetch_assoc()) {
          $productOwnerId = $orderRow['product_owner_id'];
          $orderId = $orderRow['order_id'];
          $productId = $orderRow['product_id'];
          $orderQuantity = $orderRow['order_quantity'];
          $dateOrdered = $orderRow['ordered_date'];
          $orderStatus = $orderRow['order_status'];
//==============================================================================
          $productSql = "SELECT * FROM products WHERE product_id ='$productId'";
          $productResult = $con -> query($productSql);
          $productResultCount = $productResult -> num_rows;

          if ($productResultCount > 0) {
            $productRow = $productResult -> fetch_assoc();
            $productOwnerId = $productRow['user_id'];
            $productName = $productRow['product_name'];
          }

          $accountSql = "SELECT * FROM accounts WHERE user_id ='$productOwnerId'";
          $accountResult = $con -> query($accountSql);
          $accountResultCount = $accountResult -> num_rows;

          if ($accountResultCount > 0) {
            $accountRow = $accountResult -> fetch_assoc();
            $productOwnerName = $accountRow['irstname'];
          }

          $removeFromCart = "<a href=\"/TindaJaro/homepage/cart/deletefromcart.php?id=$orderId\"><span class= \"glyphicon glyphicon-trash\"></span></a>";
          $purchaseItem = "<a href=\"/TindaJaro/homepage/cart/purchase.php?id=$orderId\" class=\"btn btn-primary\">Purchase</a>";

          echo "<tr>";
          echo "<td>" . $productOwnerName . "</td>";
          echo "<td>" . $productName . "</td>";
          echo "<td>" . $orderQuantity . "</td>";
          echo "<td>" . $dateOrdered . "</td>";
          echo "<td>" . $orderStatus . "</td>";
          echo "<td>" . $removeFromCart . "   " . $purchaseItem .  "</td>";
          echo "</tr>";
        }
      } else {
        $notification = "Cart is EMPTY";
      }
      ?>
    </tbody>
  </table>
  <h4><center><p class="bg-danger"><?php echo $notification; ?></p></center></h4>
</div>
</body>
