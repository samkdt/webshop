<form method="post" action="<?PHP echo $_SERVER["PHP_SELF"];?>">

	firstName:	<input type="text" name="fname">
	lastName:	<input type="text" name="lname">
	email:		<input type="email" name="email">
	order:		<input type="text" name="order">
	<input type="submit">

</form>


<?PHP

	function folder() {
		$date = date("F:Y");
		$dir = "./customers/".$date;
		if (!file_exists($dir)){
			mkdir($dir, 0777, true);
		}
		return $dir;
	}
	
	function mkreceipt($name,$lname,$order,$email){
		$ip =  $_SERVER['REMOTE_ADDR'];
		$time = date("d/H:i");
		$dir = folder();
		$file = $dir."/orders.csv";
		if (!file_exists($file)){
			$receiptinit = fopen($file,"w") or die("something snea");
			$categorys = "order,namn,berställning,epost,ip,tid,status";
			fwrite($receiptinit, $categorys);
			fclose($receiptinit);
		}
		$orderid = exec("cat $file | wc -l")+1;
		$receipt = fopen($file, "a") or die("Unable to open file!");
		$txt = "\n".$orderid.",".$name." ".$lname.",".$order . ",".$email."," . $ip.",".$time.",pending";
	
		fwrite($receipt, $txt);
		fclose($receipt);
		echo "Beställning gjord, kolla din epost för kvitto glöm inte betala";
	}	

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$name = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$order = $_POST["order"];
		mkreceipt($name,$lname,$order,$email);

	}

?>
