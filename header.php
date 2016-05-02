<?php
	if (!isset($_SESSION['logged-in'])) {
		if ($_SERVER['REQUEST_URI'] == '/TindaJaro/registration/registration.php'){
			//do nothing
		}
		else if ($_SERVER['REQUEST_URI'] == '/TindaJaro/index.php?success=true'){
			//do nothing
		}
		else if ($_SERVER['REQUEST_URI'] != '/TindaJaro/index.php') {
			header('Location: index.php');
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta chartset="utf-8">
	<link rel="stylesheet" type="text/css" href="/TindaJaro/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/TindaJaro/fonts/glyphicon-halflings-regular.woff">
	<link rel="stylesheet" type="text/css" href="/TindaJaro/css2/style.css">
  <script src="/TindaJaro/jscript/jquery.min.js"></script>
	<script src="/TindaJaro/jscript/bootstrap.min.js"></script>
