<?PHP
checkopd();

	function mkopd(){
		$hej = fopen($yeet,"w") or die("nåt snea, du ör för smallbrain");
		fwrite($hej,date("d/m"));
		fclose($hej);
	}


	function checkopd(){
	if(!file_exists("./orders")){
		mkdir("./orders");
	}	
		$yeet = "./orders/opd.txt";
		if (file_exists($yeet)){
			if(exec(head -n1 $yeet) != date("d/m")){
			mkopd();
			}			
	
			if (exec(" wc -l < $yeet") > 4){
				echo "DU KOM FÖRSENT, FÖRSÖk IGEN IMORGON";
			} else {
				include "form.php";
			}

		} else {
			mkopd();
			include "form.php";
		}

	
	}
?>
