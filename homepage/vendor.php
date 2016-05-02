<?php

require_once "../config.php";
require_once "../header.php";
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
        <th>Add to Cart</th>
      </tr>
    </thead>
    <tbody id="product">
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
    </tbody>
  </table>
  <script type="text/javascript">
    doAjax("ajax/ajaxvendor.php", "product");
    // var timer = function(){
    //   myTimer()
    // };
    // var myVar = setInterval(timer, 1000);
    // function myTimer() {
    //
    //   var xmlhttp = new XMLHttpRequest();
    //   xmlhttp.onreadystatechange = function() {
    //     if (xmlhttp.readyState == 4 & xmlhttp.status == 200) {
    //       document.getElementById("product").innerHTML = xmlhttp.responseText;
    //     }
    //   }
    //   xmlhttp.open("GET", "ajax/ajaxvendor.php", true);
    //   xmlhttp.send();
    // }
  </script>
</body>
</html>
