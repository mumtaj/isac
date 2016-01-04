<?php
session_start();

$admin_name = $_SESSION['SESS_FIRST_NAME'];
?>
<?php
	require_once('auth.php');
?>
<?php 
    //Include database connection details
	require_once('config.php');
	
	  $formid = $_POST["formid"];	
	 $isacid = $_POST["isacid"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
$sql = "SELECT * FROM application WHERE formid = '$formid' AND isacid = '$isacid' ";
	$result = mysql_query($sql);
	while($row=mysql_fetch_array($result)) 
	{
		$email = $row['email'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$program = $row['program'];
		$duration = $row['duration'];
		$arrival = $row['arrival'];
		$reg_fee1 = $row['registration_fee'];
		$first_install1 = $row['fee_first_installment'];
		$second_install1 = $row['fee_second_installment'];
		$fee_second_install = $row['second_installment'];
		$reminder_first = $row['first_reminder'];
		
	}
	if($reg_fee1=='')
	{
		$reg_fee ='PENDING';
	}
	else
	{
		$reg_fee ='PAID';
	}
	// for first install
	if($first_install1=='')
	{
		$first_install ='PENDING';
	}
	else
	{
		$first_install ='PAID';
	}
	// for second install
	if($second_install1=='')
	{
		$second_install ='PENDING';
	}
	else
	{
		$second_install ='PAID';
	}
	 $reminder_update= $reminder_first + '1';
	$date_last_reminder = date("d/m/Y");
	// query for dynamic mailer, header part of the mailer
	$sql = "SELECT * FROM mailer WHERE type = 'reminder_top'";
	$result = mysql_query($sql);
    while($row=mysql_fetch_array($result)) 
  { 
  
  $content = $row['content'];
  }
  // geting the footer mailer content
  $sql1 = "SELECT * FROM mailer WHERE type = 'reminder_footer' ";
	$result1 = mysql_query($sql1);
    while($row1=mysql_fetch_array($result1)) 
  { 
  
  $content1 = $row1['content'];
  }

	?>
<?php
// $msgTo = $email;

            $message = '<html><body>';
			 $message .= 'Dear '.$firstname.',';
			 $message .= "<p></p>";
		    $message .= 'Please find below the links of your program documents. We recommend that you go through these documents before you begin your ISAC program. You can also download these document from your MY ISAC panel.';
			$message .= "<p></p>";
			$message .= "<a href='indiastudyabroad.org/documents/third_inst_doc/Hindi_phrasebook.docx' target='_blank'>Hindi_phrasebook.docx</a>";
			$message .= "<p></p>";
			$message .= "<a href='indiastudyabroad.org/documents/third_inst_doc/WELCOME_LETTER.doc' target='_blank'>WELCOME_LETTER.doc</a>";
			$message .= "<p></p>";
			$message .= "<p></p>";
$message .= "Sincerely,";
$message .= "<p></p>";
$message .= "Arunabha Pal";
$message .= "<p></p>";
$message .= "India Study Abroad Center: www.indiastudyabroad.org";
$message .= "<p></p>";
$message .= "<p>Email: arunabha@indiastudyabroad.org</p>";
			$message .= "</body></html>";
			
			//   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
             
			$to = $email;
			$subject = 'ISAC Program Documents';
			$headers = "From:info@indiastudyabroad.org\r\n";
			$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
			$headers .= "CC: info@indiastudyabroad.org\r\n";
			//$headers .= "CC: balesh.work@gmail.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($to, $subject, $message, $headers);
         //   if (mail($to, $subject, $message, $headers)) {
//              header('location:view_admin_dashboard.php');
//            } else {
//              echo 'There was a problem sending the email.';
//            }
//            
	// html mailer
$sql = "UPDATE application SET doc2 = '1' WHERE formid = '$formid' AND isacid = '$isacid'";
$result = mysql_query($sql);
if($result)
{
	header('location:view_admin_dashboard.php');
}
?>
