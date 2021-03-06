<?php
  require_once "../../config.php";
  require_once "../../header.php";
  require_once "../../navigation.php";
 ?>

     <div class="">
       <div class="well table-size"><center><h3>Ordered Product</h3></center></div>
       <table class="table table-hover table-size" border="4">
         <thead>
           <tr>
             <th>Buyer Name</th>
             <th>Buyer address</th>
             <th>Ordered Product</th>
             <th>Ordered Product Quantity</th>
             <th>Status</th>
             <th>Deliver Product</th>
           </tr>
         </thead>
         <tbody id="product">
           <?php
              $userId = $_SESSION['user_id'];
              $cartOwnerName = "";
              $cartOwnerAddress = "";
              $cartProductName = "";

              $orderSql = "SELECT * FROM orders WHERE order_status= 'Pending' AND product_owner_id= '$userId'";
              $orderResult = $con -> query($orderSql);
              $orderResultCount = $orderResult -> num_rows;

              if ($orderResultCount > 0) {
                while ($orderRow = $orderResult -> fetch_assoc()) {
                  $orderId = $orderRow['order_id'];
                  $buyerId = $orderRow['cart_owner_id'];
                  $orderedProductId = $orderRow['product_id'];

                  //============================================================

                  $cartOwnerSql = "SELECT * FROM accounts WHERE user_id='$buyerId'";
                  $cartOwnerResult = $con -> query($cartOwnerSql);
                  $cartOwnerResultCount = $cartOwnerResult -> num_rows;

                  if ($cartOwnerResultCount > 0) {
                    $cartOwnerRow = $cartOwnerResult -> fetch_assoc();
                    $cartOwnerName = $cartOwnerRow['irstname'];
                    $cartOwnerAddress = $cartOwnerRow['address'];
                  }

                  //============================================================

                  $orderedProductSql = "SELECT * FROM products WHERE product_id = '$orderedProductId'";
                  $orderedProductResult = $con -> query($orderedProductSql);
                  $orderedProductResultCount = $orderedProductResult -> num_rows;

                  if ($orderedProductResultCount > 0) {
                    $orderedProductRow = $orderedProductResult -> fetch_assoc();
                    $cartProductName = $orderedProductRow['product_name'];
                  }

                  $orderedProductStatus = $orderRow['order_status'];
                  $orderedQuantity = $orderRow['order_quantity'];
                  $deliverProduct = "<a class=\"btn btn-primary\" href=\"/TindaJaro/homepage/order/deliver.php?id=$orderId\">Deliver</a>";

                  echo "<tr>";
                  echo "<td>" . $cartOwnerName . "</td>";
                  echo "<td>" . $cartOwnerAddress . "</td>";
                  echo "<td>" . $cartProductName . "</td>";
                  echo "<td>" . $orderedProductStatus . "</td>";
                  echo "<td>" . $orderedQuantity . "</td>";
                  echo "<td>" . $deliverProduct . "</td>";
                  echo "</tr>";
                }
              }
            ?>
         </tbody>
       </table>
     </div>
     <script type="text/javascript">
       doAjax("../ajax/ajaxpendingorder.php", "product");
     </script>
   </body>
 </html>
