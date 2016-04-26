<?php
require_once "../header.php";
require_once "../config.php";
require_once "../navigation.php";

?>
<div id="greeting">
  <h3>Welcome to TindaJaro.ph</h3>
</div>
<!-- php to show product -->
<div class="well"><center><h3>All Products in the Market</h3></center></div>
  <table class="table table-hover table-size" border="4">
    <thead>
      <tr>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Product Quantity</th>
        <th>Product Price</th>
        <th>Product Date</th>
      </tr>
    </thead>
    <tbody>
      <?php

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

            echo "<tr> ";
            echo "<td>" . $product_image . "</td>";
            echo "<td>" . $product_name . "</td>";
            echo "<td>" . $product_quantity . "</td>";
            echo "<td>" . $product_price . "</td>";
            echo "<td>" . $product_date . "</td>";
            echo "</tr>";
          }
      }
        ?>
    </tbody>
  </table>
</body>
</html>
