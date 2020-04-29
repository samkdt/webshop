<?PHP

	function sendreceipt($customeremail){
		
		$to = $customeremail;
		$subject = "Betalning";
		$txt = "Tack för ditt köp";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text;charset=UTF-8" . "\r\n";
		$headers .= "From: samkdt99@gmail.com" . "\r\n" .
		"CC: somebodyelse@example.com";

		$mail = mail($to,$subject,$txt,$headers);
		
		if($mail){
			echo "beställning gick igenom";
		} else {
			echo "nånting snea";
		}
		
	}
	
	sendreceipt("neo.leijondahl@gmail.com");

?>
