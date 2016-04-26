<?php

	require_once "config.php";
	require_once "header.php";

	$warning = "";

	if (isset($_REQUEST['success'])) {
		$warning = "You are successfully registered please log in";
	}
	if (!empty($_POST)) {
		$username = $_POST['usr'];
		$password = $_POST['paswrd'];
		$classification = "Vendor";

		$sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
		$result = $con -> query($sql);
		$data = mysqli_fetch_assoc($result);
		$result_count = $result -> num_rows;

		if ($result_count > 0 ) {
			$_SESSION = $data;
			$_SESSION['logged-in'] = true;
			header("Location: /SE_4105/homepage/vendor/product.php");
			if ($data["classification"] == $classification) {
				header("Location: homepage/vendor.php");
			}
			else {
				header("Location: homepage/customer.php");
			}
		} else {
			$warning = "Invalid Username and Password TRY AGAIN";
		}
	}
?>

	<title>Please Log-in first</title>
</head>
<body>
	<div id="error">
		<h2><?php echo $warning; ?></h1>
	</div>
	<div class="container center-element">
		<form id="Log-in" role="form" method="POST" action="index.php">
			<div class="form-group">
				<label for="username">Username: </label>
				<input class="form-control textfield" id="username" type="text" name="usr" required/>
			</div>
			<div class="form-group">
				<label for="password">Password: </label>
				<input class="form-control textfield" id="password" type="password" name="paswrd" required />
			</div>
			<input class="btn btn-primary" type="submit" value="Log in" />
			<a id="sign-up" href="registration/registration.php">Sign up</a>
		</form>
	</div>
	<div class="center-text">
		<?php require_once "timer.php"; ?>
	</div>
</body>
</html>
