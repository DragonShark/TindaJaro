<?php

require_once "../config.php";
require_once "../header.php";
require_once "../navigation.php";

?>

  <div id="greeting">
    <h3>Welcome to TindaJaro.ph</h3>
  </div>
  <!-- php to show product -->
  <div class="well table-size"><center><h3>All Products in the Market</h3></center></div>
  <table class="table table-hover table-size" border="4">
    <thead>
      <tr>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Product Quantity</th>
        <th>Product Price</th>
        <th>Product Date</th>
        <th>Add to Cart</th>
      </tr>
    </thead>
    <tbody id="product">
    <?php
      $notification = "";
      $productOwnerId = $_SESSION['user_id'];

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
      } else {
        $notification = "No Product Available";
        echo "<h4><center><p class=\"bg-danger table-size\">" . $notification . "</p></center></h4>";
      }
      ?>
    </tbody>
  </table>
  <script type="text/javascript">
    doAjax("ajax/ajaxvendor.php", "product");
  </script>
</body>
</html>
