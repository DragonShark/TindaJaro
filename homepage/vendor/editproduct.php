<?php
require_once "../../config.php";
require_once "../../header.php";
require_once "../../navigation.php";

$product_id = $_REQUEST['id'];

$sql = "SELECT * FROM products WHERE product_id ='$product_id'";
$result = $con -> query($sql);
$result_count = $result -> num_rows;

if ($result_count > 0) {
  $row = $result -> fetch_assoc();
  $product_id = $row['product_id'];
  $product_name = $row['product_name'];
  $product_type = $row['product_type'];
  $product_quantity = $row['product_quantity'];
  $product_price = $row['product_price'];
  $product_photo = $row['product_photo'];
  $meat_status = "unchecked";
  $fruit_status = "unchecked";
  $fish_status = "unchecked";
  $vegetable_status = "unchecked";

  if ($product_type == "meat") {
    $meat_status = "checked";
  }
  elseif ($product_type == "fish") {
    $fish_status = "checked";
  }
  elseif ($product_type == "vegetable") {
    $vegetable_status = "checked";
  }
  elseif ($product_type == "fruit") {
    $fruit_status = "checked";
  }

  if (isset($_POST['submit']) && !empty('$_POST')) {
    $product_name = $_POST['productName'];
  	$product_type = $_POST['productType'];
  	$product_quantity = $_POST['productQuantity'];
  	$product_price = $_POST['productPrice'];
  	$target_dir ="../photos/";
    $product_photo = $target_dir . basename($_FILES["upload_file"]["name"]);
    $string = "/(\D+)/";
  	$integer = "/([A-Za-z]+)/";

    $priceContainString = preg_match($integer, $product_price);
  	$quantityContainString = preg_match($string, $product_quantity);

    if ($priceContainString || $quantityContainString || $product_price <= 0 || $product_quantity <= 0) {
      $warning = "Invalid input of Price or Quantity Please repeat";
      echo "<div class=\"alert alert-warning\">
              <strong>Warning!</strong>" . $warning;
      echo "</div>";
    }else {
      if (empty($_FILES["upload_file"])) {
        $sql = "UPDATE products SET
              product_name = '$product_name',
              product_type = '$product_type',
              product_quantity = '$product_quantity',
              product_price = '$product_price'
              WHERE product_id = '$product_id'";

      }else {
        $sql = "UPDATE products SET
              product_name = '$product_name',
              product_type = '$product_type',
              product_quantity = '$product_quantity',
              product_price = '$product_price',
              product_photo = '$product_photo'
              WHERE product_id = '$product_id'";

              move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file);
      }

      $con -> query($sql);
      header("Location: /SE_4105/homepage/vendor/product.php");
    }

  }

}

?>

<div class="secondary-layer row">

<div class="well"><center><h4><b><i>Edit Product</i></b></h4></center></div>

  <div class="container-sell col-md-4">
    <form class="form-inline" role="form" action="/SE_4105/homepage/vendor/editproduct.php?id=<?php echo $product_id?>" method="POST" enctype="multipart/form-data">
      <div class="form-group row">
        <div class="col-sm-6">
          <label for="productName">Product Name:</label>
        </div>
        <div class="col-sm-6">
          <input class="form-control" type="text" name="productName" id="productName" value=<?php echo $product_name; ?> required />
        </div>
      </div><br><br>
      <div class="form-group row">
        <div class="col-sm-6 pull-left">
          <label for="productType">Product Type:</label>
        </div>
        <div class="col-sm-6">
          <div class="radio pull-left">
            <label><input type="radio" name="productType" id="meat" value="meat" <?php echo $meat_status; ?>/>Meat</label>
          </div><br>
          <div class="radio pull-left">
            <label><input type="radio" name="productType" id="fish" value="fish" <?php echo $fish_status; ?>/>Fish</label>
          </div><br>
          <div class="radio pull-left">
            <label><input type="radio" name="productType" id="vegetable" value="vegetable" <?php echo $vegetable_status; ?>/>Vegetable</label>
          </div><br>
          <div class="radio pull-left">
            <label><input type="radio" name="productType" id="fruit" value="fruit" <?php echo $fruit_status; ?>/>Fruit</label>
          </div>
        </div>
      </div><br><br>
      <div class="form-group row">
        <div class="col-sm-6">
          <label for="productQuantity">Product Quantity:</label>
        </div>
        <div class="col-sm-6">
          <input class="form-control" type="text" name="productQuantity" id="productQuantity" value=<?php echo $product_quantity; ?> required />
        </div>
      </div><br><br>
      <div class="form-group row">
        <div class="col-sm-6">
          <label for="productPrice">Product Price:</label>
        </div>
        <div class="col-sm-6">
          <input class="form-control" type="text" name="productPrice" id="productPrice" value=<?php echo $product_price; ?> required />
        </div>
      </div><br><br>
      <div class="form-group row">
        <div class="col-sm-6">
          <label for="productPhoto">Product Photo:</label>
        </div>
        <div class="col-sm-6">
          <input class="btn btn-primary" id="productPhoto" type="file" value="Browse" name="upload_file" />
        </div>
      </div><br><br>
      <div class="row">
        <div class="col-sm-6">
          <!-- Empty -->
        </div>
        <div class="col-sm-6">
          <button class="btn btn-warning" type="submit" name="submit">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-4">
    <h3><u><b>Current Photo:</b></u></h3>
    <img class="image" src=<?php echo $product_photo; ?> alt=<?php echo $product_name . ".jpeg"; ?> />
  </div>
</div>
</body>
</html>
