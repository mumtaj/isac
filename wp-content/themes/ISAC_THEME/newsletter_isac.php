<?php

require_once('config/config.php');

if($_POST['newsletter'] != '')
{
	$txtSearch = $_POST['newsletter'];
	
	$msgTo = NEWSLETTER_EMAIL_ID;
	$msgSubject = "Newletter";
	$msgContent = " Subscribers Id -  '$txtSearch'";
	//  $bcc1 = "$emailaddressteamleader";
	// $bcc = "$emailaddressunithead";
	
	$msgHeaders = "To: $msgTo\r\n";
	$msgHeaders .= "From: ISAC\r\n";
	// $msgHeaders .= "Bcc: $bcc\r\n";
	// $msgHeaders .= "Bcc: $bcc1\r\n";
	$msgHeaders .= "X-Mailer: PHP".phpversion();
    
    $success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
	
	
	$msgTo1 = "$txtSearch";
	$msgSubject1 = "ISAC Newsletter Subscription";
	$msgContent1 = " Thank you for subscribing to our newsletter";
	//  $bcc1 = "$emailaddressteamleader";
	// $bcc = "$emailaddressunithead";
	
	$msgHeaders1 = "To: $msgTo1\r\n";
	$msgHeaders1 .= "From: ISAC\r\n";
	// $msgHeaders .= "Bcc: $bcc\r\n";
	// $msgHeaders .= "Bcc: $bcc1\r\n";
	$msgHeaders1 .= "X-Mailer: PHP".phpversion();
    
    $success1 = mail($msgTo1, $msgSubject1, $msgContent1, $msgHeaders1);
	
	
 header( 'Location:'.SERVER_URL ) ;
}

?>

