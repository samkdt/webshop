<?PHP
	
	if (isset($index)) {
		$path = "items";
	} else {
		$path = "../items";
		$index = false;
	}

	if (isset($_GET["item"])){
		$item = $_GET["item"];
		if (file_exists("../items/".$item) && $item !== "." && $item !== ".."){
			echo file_get_contents("../items/".$item);
			echo '<form method="POST" action="addCart.php"><button type="submit" name="vara" value="'.$item.'">Add to Cart</button></form>';
		} else {
			echo "this item does not exist";
		}
	} else {
		$products = array_diff(scandir($path),array(".",".."));
		showAllItems($products, $index);
	}
	
	function showAllItems($products,$link){
		echo "<h2>Alla Produkter som finns:<h2>";
		$linkPath = "item.php?item=";
		if ($link) {
			$linkPath = "modules/item.php?item=";
		}
		foreach($products as $product){
			echo "<a href=".$linkPath.$product.">".$product."</a><br>";
		}
	}
?>
