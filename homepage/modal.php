<?php
  require_once "../config.php";
  require_once "../header.php";

  $productName = "Product Name";
  $productPrice = "0.00";
  $cartOwnerId = $_SESSION["user_id"];
  $error = "";
  $isClickable = "";

  if (!empty($_REQUEST)) {
    $productId = $_REQUEST["id"];

    $sql = "SELECT * FROM products WHERE product_id = '$productId'";
    $result = $con -> query($sql);
    $resultCount = $result -> num_rows;

    if ($resultCount > 0) {
      $row = $result -> fetch_assoc();
      $productName = $row['product_name'];
      $productPrice = $row['product_price'];
      $productOwnerId = $row['user_id'];
      $productQuantity = $row['product_quantity'];
    }

    if ($cartOwnerId == $productOwnerId) {
      $error = "Owner can't buy his/her own product <br> any input will not be accepted <br> Please Click Close";
      $isClickable = "disabled";
      // echo "<p class=\"bg-danger\" id=\"error\">" . $error . "</p>";
    }
  }
?>
<script type="text/javascript">
  $(document).ready(function(){
    // Trigger the modal with a button
    $('#sellModal').modal('show');
    $('#action-submit').click(function(){
      var productQuantity = $('#quantity').val();
      if (productQuantity.match(/(\D+)/) || productQuantity <= 0 || productQuantity > <?php echo $productQuantity; ?>) {
        var error = "Invalid Input of Quantity";
        $('#error').html(error);
      } else {
        var url ="/TindaJaro/homepage/cart/cart.php?id=<?php echo $productId; ?>&quantity=" + productQuantity;
        window.location = url;
      }
    });
  });

  //ajax
  doAjax("ajax/ajaxmodal.php?id=<?php echo $productId; ?>", "currentQuantity");
</script>
</head>

<body>
  <!-- Modal -->
  <div id="sellModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <a href="/TindaJaro/homepage/vendor.php"><button type="button" class="close">&times;</button></a>
          <h4 class="modal-title">Please Enter The Quantity</h4>
          <p class="bg-danger" id="error"><?php echo $error; ?></p>
        </div>
        <div class="">
          <div class="modal-body">
            <p id="currentQuantity"><?php echo "Product Name: " . $productName . "<br> Product Price: Php " . $productPrice . "<br> Current Quantity: " . $productQuantity; ?></p>
            <div><?php echo "<label for=\"lst\">Quantity: </label>
            <input class=\"form-control textfield\" id=\"quantity\" type=\"text\" name=\"last\" required />"; ?></div>
          </div>
          <div class="modal-footer">
            <a href="/TindaJaro/homepage/vendor.php"><button type="button" class="btn btn-default">Close</button></a>
            <button class="btn btn-primary" id="action-submit" <?php echo $isClickable; ?>>Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
