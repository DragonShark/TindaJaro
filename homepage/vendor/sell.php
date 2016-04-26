<?php
require_once "../../header.php";
require_once "../../config.php";
require_once "../../navigation.php";

$target_file = "";
$warning = "";

if (!empty($_POST)) {

	$productname = $_POST['productName'];
	$producttype = $_POST['productType'];
	$productquantity = $_POST['productQuantity'];
	$productprice = $_POST['productPrice'];
	$user_id = $_SESSION['user_id'];
	$target_dir ="../photos/";
	$target_file = $target_dir . basename($_FILES["upload_file"]["name"]);
	$string = "/(\D+)/";
	$integer = "/([A-Za-z]+)/";


	echo move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file);

	$priceContainString = preg_match($integer, $productprice);
	$quantityContainString = preg_match($string, $productquantity);

	if ($priceContainString || $quantityContainString || $productprice <= 0 || $productquantity <= 0) {
		$warning = "Invalid input of Price or Quantity Please repeat";
		echo "<div class=\"alert alert-warning\">
  					<strong>Warning!</strong>" . $warning;
		echo "</div>";
	}else {
		$sql = "INSERT INTO products(product_name, product_type, product_quantity, product_price, user_id, product_photo)
		VALUES(
			'$productname',
			'$producttype',
			'$productquantity',
			'$productprice',
			'$user_id',
			'$target_file');";

			$con -> query($sql);
			header("Location: /TindaJaro/homepage/vendor/product.php");
		}
	}
	?>

	<div class="secondary-layer row">
		<div class="container-sell col-md-8">
			<form class="form-inline" role="form" action="/TindaJaro/homepage/vendor/sell.php" method="POST" enctype="multipart/form-data">
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="productName">Product Name:</label>
					</div>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="productName" id="productName" placeholder="Product Name" required />
					</div>
				</div><br><br>
				<div class="form-group row">
					<div class="col-sm-6 pull-left">
						<label for="productType">Product Type:</label>
					</div>
					<div class="col-sm-6">
						<div class="radio pull-left">
							<label><input type="radio" name="product Type" id="meat" value="meat" checked/>Meat</label>
						</div><br>
						<div class="radio pull-left">
							<label><input type="radio" name="product Type" id="fish" value="fish"/>Fish</label>
						</div><br>
						<div class="radio pull-left">
							<label><input type="radio" name="product Type" id="vegetables" value="vegetable"/>Vegetable</label>
						</div><br>
						<div class="radio pull-left">
							<label><input type="radio" name="product Type" id="fruit" value="fruit"/>Fruit</label>
						</div>
					</div>
				</div><br><br>
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="productQuantity">Product Quantity:</label>
					</div>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="productQuantity" id="productQuantity" placeholder="Product Quantity" required />
					</div>
				</div><br><br>
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="productPrice">Product Price:</label>
					</div>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="productPrice" id="productPrice" placeholder="Product Price" required />
					</div>
				</div><br><br>
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="productPhoto">Product Photo:</label>
					</div>
					<div class="col-sm-6">
						<input class="btn btn-primary" id="product Photo" type="file" value="Browse" name="upload_file" value="Upload Photo" />
					</div>
				</div><br><br>
				<div class="row">
					<div class="col-sm-6">
						<!-- Empty -->
					</div>
					<div class="col-sm-6">
						<button class="btn btn-warning" type="submit">Add Product</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
