<?PHP
	include "mkreceipt.php";
	
	function folder() {
		$date = date("F:Y");
		$dir = "../orders";
		if (!file_exists($dir)){
			mkdir($dir, 0777, true);
		}
		return $dir;
	}
	
	function updateopd(){
		
		$yeet = "../orders/opd.txt";
		$hej = fopen($yeet,"a") or die("nåt snea, du ör för smallbrain");
		fwrite($hej,"\nenmindrekvar");
		fclose($hej);

	}
	
	function mkorder($name,$lname,$size,$email){
		$ip =  $_SERVER['REMOTE_ADDR'];
		$time = date("d/H:i");
		$dir = folder();
		$customername = $name." ".$lname;
		$salt = random_bytes(10);
		$pepper = "yolo";
		$file = $dir."/order.csv";
		if (!file_exists($file)){
			$orderinit = fopen($file,"w") or die("something snea");
			$categorys = "'order','ordernr','salt','namn','berställning','epost','ip','tid','status'";
			fwrite($orderinit, $categorys);
			fclose($orderinit);
		}
		$orderid = exec("wc -l < $file")+1;
		$ordernr = hash("tiger192,3",$orderid . $salt . $pepper);
		$order = fopen($file, "a") or die("Unable to open file!");
		$txt = "\n'".$orderid."','".$ordernr."','".$salt."','".$customername."','".$size . "','".$email."','" . $ip."','".$time."','pending'";
	
		fwrite($order, $txt);
		fclose($order);
		makereceipt("../orders/",$orderid,$ordernr,$email,$size,$customername,"150");
		updateopd();
		header("LOCATION: showreceipt.php?k=".$ordernr);
	}	

		$name = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$size = $_POST["size"];
		mkorder($name,$lname,$size,$email);

?>
