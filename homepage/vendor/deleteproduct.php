<?php
require_once "../../config.php";
require_once "../../header.php";

$productId = $_REQUEST['id'];

    $sql = "DELETE FROM products WHERE product_id = '$productId'";
    $con -> query($sql);

    header("Location:/TindaJaro/homepage/vendor/product.php");
?>
