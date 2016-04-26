<?php
require_once "../../config.php";
require_once "../../header.php";

$product_id = $_REQUEST['id'];


$sql = "DELETE FROM products WHERE product_id = '$product_id'";

if ($con -> query($sql)) {
  header("Location:/SE_4105/homepage/vendor/product.php");
}
 ?>
