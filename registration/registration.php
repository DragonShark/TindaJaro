<?php
require_once "../header.php";
require_once "../config.php";

$warning = "";
$classification = "Vendor";

if (!empty($_POST)) {

	$irstname = $_POST['first'];
	$lastname = $_POST['last'];
	$gender = $_POST['sex'];
	$email = $_POST['email'];
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$class = $_POST['class'];

	if ($classification == $class) {
	} else {
		$classification = "Customer";
	}

	$sql = "SELECT * FROM accounts WHERE username='$username'";
	$result = $con -> query ($sql);
	$count = $result -> num_rows;

	if ($count > 0) {
		$warning = "Username already exists!";
	} else {
		$sql = "INSERT INTO accounts(lastname, irstname, gender, email, username, password, classification)
		VALUES(
			'$lastname',
			'$irstname',
			'$gender',
			'$email',
			'$username',
			'$password',
			'$classification');";

			$con -> query($sql);
			header("Location:/TindaJaro/index.php?success=true");
		}
	}
	?>

	<title>Registration Page</title>
</head>
<body>
	<div id="warning">
		<h2><?php echo $warning; ?></h1>
		</div>
		<div class="container">
			<form id="Registration" role="form" method="POST" action="registration.php">
				<div class="form-group">
					<label for="fst">Firstname: </label>
					<input class="form-control textfield" id="fst" type="text" name="first" required />
				</div>
				<div class="form-group">
					<label for="lst">Lastname: </label>
					<input class="form-control textfield" id="lst" type="text" name="last" required />
				</div>
				<div>
					<label>Gender: </label> <br>
					<input id="male" type="radio" value="Male" name="sex" checked /> Male <br>
					<input id="female" type="radio" value="Female" name="sex" /> female
				</div> <br>
				<div class="form-group">
					<label for="eml">Email: </label>
					<input type="email" class="form-control textfield" id="eml" type="text" name="email" required />
				</div>
				<div class="form-group">
					<label for="usr">Username: </label>
					<input class="form-control textfield" id="usr" type="text" name="user" required />
				</div>
				<div class="form-group">
					<label for="pswrd">Password: </label>
					<input class="form-control textfield" id="pswrd" type="password" name="pass" required /> <br>
					<input class="btn btn-warning center-block" type="button" value="Show Password" onmousedown="showpassword()" onmouseup="hidepassword()">
				</div> <br>
				<div>
					<label>Do you want to sign up as a vendor?</label> <br>
					<input id="Vendor" type="checkbox" value="Vendor" name="class" /> YES, I want to sign up as a vendor
				</div> <br>
				<input class="btn btn-primary" type="submit" id="Register" value="Register" />
			</form>
		</div>
	</body>
	<script type="text/javascript">
	function showpassword() {
		document.getElementById('pswrd').type = "text";
	}
	function hidepassword() {
		document.getElementById('pswrd').type = "password";
	}
	</script>
	</html>
