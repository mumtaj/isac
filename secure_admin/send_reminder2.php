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
	

$sql = "SELECT * FROM application WHERE formid = '$formid' AND isacid = '$isacid' ";
	$result = mysqlquery($sql);
	while($row=mysqli_fetch_array($result)) 
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
		$reminder_first = $row['final_reminder'];
		
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
	$result = mysqlquery($sql);
    while($row=mysqli_fetch_array($result)) 
  { 
  
  $content = $row['content'];
  }
  // geting the footer mailer content
  $sql1 = "SELECT * FROM mailer WHERE type = 'reminder_footer' ";
	$result1 = mysqlquery($sql1);
    while($row1=mysqli_fetch_array($result1)) 
  { 
  
  $content1 = $row1['content'];
  }

	?>
<?php
// $msgTo = $email;

            $message = '<html><body>';
			 $message .= 'Dear '.$firstname.',';
		    $message .= $content;
		    $message .= '<strong>Your program details are:</strong>';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		    $message .= "<tr><td><strong>Program name:</strong></td><td> " .$program."</td></tr>";
			$message .= "<tr><td><strong>Duration in weeks:</strong></td><td> " .$duration."</td></tr>";
			$message .= "<tr><td><strong>Program start date:</strong> </td><td>" .$arrival."</td></tr>";
			$message .= "</table>";
			$message .= "<p> </p>";
			$message .= "<strong>Your Payment status is given below:</strong>";
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<tr><td><strong>Registration fee ($45) </strong> </td><td>" .$reg_fee."</td></tr>";
			$message .= "<tr><td><strong>Deposit ($300) </strong> </td><td>" .$first_install."</td></tr>";
			$message .= "<tr><td><strong>Final Instalment ($".$fee_second_install.") </strong></td><td> " .$second_install."</td></tr>";
			$message .= "</table>";
			$message .= $content1;
			$message .= "</body></html>";
			
			//   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
             
			$to = $email;
			$subject = 'Reminder : ISAC Program Fees';
			$headers = "From:info@indiastudyabroad.org\r\n";
			$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
			$headers .= "CC: info@indiastudyabroad.org\r\n";
			//$headers .= "CC: balesh.work@gmail.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($to, $subject, $message, $headers);
         //   if (mail($to, $subject, $message, $headers)) {
//              echo 'Your message has been sent.';
//            } else {
//              echo 'There was a problem sending the email.';
//            }
//            
	// html mailer
	
$sql = "UPDATE application SET final_reminder = '$reminder_update', Date_last_reminder = '$date_last_reminder' WHERE formid = '$formid' AND isacid = '$isacid'";
$result = mysqlquery($sql);
if($result)
{
	header('location:view_admin_dashboard.php');
}
?>
