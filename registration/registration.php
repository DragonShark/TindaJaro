<?php

require_once "../config.php";
require_once "../header.php";

$warning = "";

if (!empty($_POST)) {

	$firstname = $_POST['first'];
	$lastname = $_POST['last'];
	$gender = $_POST['sex'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$username = $_POST['user'];
	$password = $_POST['pass'];

	$sql = $con -> prepare("SELECT username FROM accounts WHERE username =?");
	$sql -> bind_param('s', $username);
	$sql -> execute();
	$sql -> bind_result($username);

	if ($sql -> fetch() > 0) {
			$warning = "Username already exists!";
	}else {
		$sql = $con -> prepare("INSERT INTO accounts (lastname, irstname, gender, email, address, username, password)
												VALUES (?, ?, ?, ?, ?, ?, ?)");
		$sql -> bind_param('sssssss', $lastname, $firstname, $gender, $email, $address, $username, $password);
		$sql -> execute();
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
					<label for="address">Address: </label>
					<input type="address" class="form-control textfield" id="address" type="text" name="address" required />
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
				<input class="btn btn-primary" type="submit" id="Register" value="Register" />
				  <input class="btn btn-info" type="reset" value="Reset" />
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
