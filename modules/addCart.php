<?PHP

	$product = $_POST["vara"];
	$name = "varukorgg";
	if(isset($_COOKIE[$name])){
		$varor = json_decode($_COOKIE[$name]);
		$varor[] = $product;
	} else {
		$varor = [$product];
	}

	setcookie($name, json_encode($varor), time()+3600, "/webshop/");
	header("LOCATION: ../index.php");
?>