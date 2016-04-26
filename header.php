<?php
	session_start();
	if (!isset($_SESSION['logged-in'])) {
		if ($_SERVER['REQUEST_URI'] == '/SE_4105/registration/registration.php'){
			//do nothing
		}
		else if ($_SERVER['REQUEST_URI'] == '/SE_4105/index.php?success=true'){
			//do nothing
		}
		else if ($_SERVER['REQUEST_URI'] != '/SE_4105/index.php') {
			header('Location: index.php');
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta chartset="utf-8">
	<link rel="stylesheet" type="text/css" href="/SE_4105/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/SE_4105/fonts/glyphicon-halflings-regular.woff">
	<link rel="stylesheet" type="text/css" href="/SE_4105/css2/style.css">
  <script src="/SE_4105/jscript/jquery.min.js"></script>
	<script src="/SE_4105/jscript/bootstrap.min.js"></script>
