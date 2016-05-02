<?php

require_once "../../config.php";
require_once "../../header.php";
require_once "../../navigation.php";

?>

<!-- php to show product -->
  <div class="well"><center><h3>My Products</h3></center></div>
    <table class="table table-hover table-size" border="4">
      <thead>
        <tr>
          <th>Product Image</th>
          <th>Product Name</th>
          <th>Product Quantity</th>
          <th>Product Price</th>
          <th>Product Date</th>
          <th>Modify</th>
        </tr>
      </thead>
      <tbody id="product">
        <?php
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
      </tbody>
    </table>
  <script type="text/javascript">
    var timer = function(){
    myTimer()
  };
    var myVar = setInterval(timer, 1000);
    function myTimer() {

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 & xmlhttp.status == 200) {
          document.getElementById("product").innerHTML = xmlhttp.responseText;
        }
      }
        xmlhttp.open("GET", "../ajaxproduct.php", true);
        xmlhttp.send();
  }
  </script>
</body>
</html>
