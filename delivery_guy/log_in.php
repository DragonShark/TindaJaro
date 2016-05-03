<?php

	require_once "../config.php";
	require_once "../header.php";

	$warning = "";
  if (isset($_SESSION['logged-in'])) {
    header("Location: /TindaJaro/delivery_guy/deliverypage.php");
  }

	else if (!empty($_POST)) {
		$username = $_POST['usr'];
		$password = $_POST['paswrd'];

		$sql = "SELECT * FROM deliveryguy WHERE username = '$username' AND password = '$password'";
		$result = $con -> query($sql);
		$data = mysqli_fetch_assoc($result);
		$result_count = $result -> num_rows;

		if ($result_count > 0 ) {
			$_SESSION = $data;
      $_SESSION['logged-in'] == true;
      header("Location: /TindaJaro/delivery_guy/deliverypage.php");
		} else {
			$warning = "Invalid Username and Password TRY AGAIN <br> This lg_in page is for delivery guy ONLY";
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
		<form id="Log-in" role="form" method="POST" action="/TindaJaro/delivery_guy/log_in.php">
			<div class="form-group">
				<label for="username">Username: </label>
				<input class="form-control textfield" id="username" type="text" name="usr" required/>
			</div>
			<div class="form-group">
				<label for="password">Password: </label>
				<input class="form-control textfield" id="password" type="password" name="paswrd" required />
			</div>
			<input class="btn btn-primary" type="submit" value="Log in" />
		</form>
	</div>
	<div class="center-text">
		Welcome Mr. Delivery Guy
	</div>
</body>
</html>
