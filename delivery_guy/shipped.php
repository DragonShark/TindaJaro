<?php
  require_once "../config.php";
  require_once "../header.php";

  $orderId = $_REQUEST['id'];

  $sql = "UPDATE orders SET order_status = 'Shipping' WHERE order_id = '$orderId'";
  $con -> query($sql);

  header("Location:/TindaJaro/delivery_guy/deliverypage.php");
 ?>
