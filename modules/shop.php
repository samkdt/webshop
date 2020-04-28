<?PHP
checkopd();

	function checkopd(){
		
		$yeet = "./orders/opd.txt";
		if (file_exists($yeet)){
			if (exec(" wc -l < $yeet") > 4){
				echo "DU KOM FÖRSENT, FÖRSÖk IGEN IMORGON";
			}
			else {
				include "form.php";
			}
		} else {
			$hej = fopen($yeet,"w") or die("nåt snea, du ör för smallbrain");
			fwrite($hej,date("d/f"));
			fclose($hej);
			include "form.php";
		}

	
	}
?>
