<form method="post" action="<?PHP echo $_SERVER["PHP_SELF"];?>">

	firstName:	<input type="text" name="fname">
	lastName:	<input type="text" name="lname">
	email:		<input type="email" name="email">
	storlek:	<select id="size" name="size">
				<option value="small">small</option>
				<option value="medium">medium</option>
				<option value="large">large</option>
			</select>	
	<input type="submit">

</form>


<?PHP
checkopd();
	function folder() {
		$date = date("F:Y");
		$dir = "./orders/".$date;
		if (!file_exists($dir)){
			mkdir($dir, 0777, true);
		}
		return $dir;
	}

	function checkopd(){
		$yeet = "./orders/opd.txt";
		if (file_exists($yeet)){
			if (exec(" wc -l < $yeet") > 4){
				echo "DU KOM FÖRSENT, FÖRSÖk IGEN IMORGON";
			}
		} else {
			$hej = fopen($yeet,"w") or die("nåt snea, du ör för smallbrain");
			fwrite($hej,date("d/f"));
			fclose($hej);
		}

	
	}

	function updateopd(){
		
		$yeet = "./orders/opd.txt";
		$hej = fopen($yeet,"a") or die("nåt snea, du ör för smallbrain");
		fwrite($hej,"\nenmindrekvar");
		fclose($hej);

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
		$orderid = exec("wc -l < $file")+1;
		$receipt = fopen($file, "a") or die("Unable to open file!");
		$txt = "\n".$orderid.",".$name." ".$lname.",".$order . ",".$email."," . $ip.",".$time.",pending";
	
		fwrite($receipt, $txt);
		fclose($receipt);
		updateopd();
		echo "Beställning gjord, kolla din epost för kvitto glöm inte betala";
	}	

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$name = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$order = $_POST["size"];
		mkreceipt($name,$lname,$order,$email);

	}

?>
