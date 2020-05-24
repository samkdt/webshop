<?PHP
	$cookie_name = "varukorgg";

	if(!isset($_COOKIE[$cookie_name])) {
  		echo "Du har inget i din varukorg";
	} else {
  		echo "Dessa produkter finns i din varukorg<br>";
  		$varor = json_decode($_COOKIE[$cookie_name]);
  		foreach ($varor as $vara) {
  			echo $vara."<br>";
  		}
	}
?>