<?php
  require_once "config.php";
  require_once "header.php";

  $target_file = "";
  $warning = "";

  if (!empty($_POST)) {

  	$productname = $_POST['productName'];
  	$producttype = $_POST['productType'];
  	$productquantity = $_POST['productQuantity'];
  	$productprice = $_POST['productPrice'];
  	$user_id = $_SESSION['user_id'];
  	$target_dir ="../photos/";
    $target_file = $target_dir . basename($_FILES["upload_file"]["name"]);

  	echo move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file);

    if ($product_price == "" && $product_price < 0) {
      $warning = "sdfghsdfghjklkjhgfdcfvbnml,khytgfnk,likujygthnl";
    } else {
      $sql = "INSERT INTO products(product_name, product_type, product_quantity, product_price, user_id, product_photo)
      VALUES(
        '$productname',
        '$producttype',
        '$productquantity',
        '$productprice',
        '$user_id',
        '$target_file');";

        $con -> query($sql);
        header("Location: /SE_4105/homepage/vendor/product.php");
    }
  	}
 ?>

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sellModal">Open Modal</button>

<!-- Modal -->
<div id="sellModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">WARNING!!!</h4>
      </div>
      <div class="modal-body">
        <p><?php echo $warning; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>
