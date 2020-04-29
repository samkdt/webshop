<?PHP

	function makereceipt($dir,$orderid,$ordernr,$customeremail,$size,$customername,$price){
		$dir .= "kvitton/";
		if(!file_exists($dir)){
			mkdir($dir);
		}

		date_default_timezone_set("Europe/Stockholm");
		$txt =	"*********************************\n". 
			"ordernummer:".$orderid ."\n".
			"Datum:".date("d/m-Y")."\n".
			"klockan".date("H:i:s")."\n".
			"*********************************\n".
			"Tack ".$customername." för din beställning!\n".
			"Kundens epost: ".$customeremail."\n".
			"beställing: ".$size."\n".
			"pris: ".$price."kr\n".
			"*********************************\n".
			"Glöm inte swisha pris till nr Med ditt ordernummer!\n".
			"skriv till samkdt99@gmail.com vid frågor";
		$kvitto = fopen($dir.$ordernr.".txt","w") or die("walla error");
		fwrite($kvitto, $txt);
		fclose($kvitto);
		
	}
	

?>
