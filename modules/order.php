<?PHP
	include "mkreceipt.php";
	
	function folder() {
		$date = date("F:Y");
		$dir = "../orders/".$date;
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
		$file = $dir."/orders.csv";
		if (!file_exists($file)){
			$orderinit = fopen($file,"w") or die("something snea");
			$categorys = "order,namn,berställning,epost,ip,tid,status";
			fwrite($orderinit, $categorys);
			fclose($orderinit);
		}
		$orderid = exec("wc -l < $file")+1;
		$order = fopen($file, "a") or die("Unable to open file!");
		$txt = "\n".$orderid.",".$customername.",".$size . ",".$email."," . $ip.",".$time.",pending";
	
		fwrite($order, $txt);
		fclose($order);
		makereceipt("../orders/",$orderid,$email,$size,$customername,"150");
		updateopd();
		header("LOCATION: ../orders/kvitton/".$orderid.".txt");
	}	

		$name = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$size = $_POST["size"];
		mkorder($name,$lname,$size,$email);

?>
