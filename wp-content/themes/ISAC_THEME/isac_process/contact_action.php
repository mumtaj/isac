<?php

	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$tel = $_POST['contact'];
	$query = $_POST['product-type2'];
	$description = $_POST['description2'];
	if($email!='')
	{
	
	$msgTo = "info@indiastudyabroad.org";
	$msgSubject = "Query from CONTACT FORM";
	$msgContent = "Query from Contact form \n\n\n Name : ".$name."\n \n Email :".$email." \n \n Telephone Number : ".$tel." \n \n Description :".$description." \n\n
	Type of Query  :".$query." : \n \n";
	//$bcc1 = "$emailaddressteamleader";
	// $bcc = "$emailaddressunithead";
	
	$msgHeaders = "To: $msgTo\r\n";
	$msgHeaders .= "From: $email\r\n";
	//  $msgHeaders .= "Bcc: $bcc\r\n";
	// $msgHeaders .= "Bcc: $bcc1\r\n";
	$msgHeaders .= "X-Mailer: PHP".phpversion();
	
	$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
	
	echo "<script type='text/javascript'>";
		echo "window.location = ".SERVER_URL."thanks";
	echo "</script> ";
	}
	else
	{
		echo "<script type='text/javascript'>";
		echo "window.location = ".SERVER_URL."thanks";
	echo "</script> ";
	}

?>
    