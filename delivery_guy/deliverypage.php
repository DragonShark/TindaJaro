<?php
  require_once "../config.php";
  require_once "../header.php";
 ?>
    <a class="btn btn-danger pull-right log-out" href="/TindaJaro/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
    <div class="well table-size"><center><h3>My Pending Delivery</h3></center></div>
     <div class="center-element">
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
         <tbody>
           <?php
              $vendorId = $_SESSION['vendor_id'];
              $cartOwnerName = "";
              $cartOwnerAddress = "";
              $cartProductName = "";

              $orderSql = "SELECT * FROM orders WHERE order_status= 'Checked Out' AND product_owner_id= '$vendorId'";
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
                  $deliverProduct = "<a class=\"btn btn-primary\" href=\"/TindaJaro/delivery_guy/shipped.php?id=$orderId\">Complete Delivery</a>";

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
   </body>
 </html>
