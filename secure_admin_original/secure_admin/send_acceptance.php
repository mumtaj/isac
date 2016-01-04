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
		$fee = $row['fee'];
		
	}
	// query for dynamic mailer, header part of the mailer
	$sql = "SELECT * FROM mailer WHERE type = 'acc_top'";
	$result = mysql_query($sql);
    while($row=mysql_fetch_array($result)) 
  { 
  $content = $row['content'];
  }
  // geting the footer mailer content
  $sql1 = "SELECT * FROM mailer WHERE type = 'acc_footer' ";
	$result1 = mysql_query($sql1);
    while($row1=mysql_fetch_array($result1)) 
  { 
  
  $content1 = $row1['content'];
  }
  // date difference
$duration2 =	explode(" ",$duration);
$duration1 = $duration2[0];
$newdate = strtotime ( $duration1.' week' , strtotime ( $arrival) ) ;
$newdate = date ( 'F j, Y' , $newdate );
$newdate1 = strtotime ( '-1 day' , strtotime ( $newdate) ) ;
$newdate1 = date ( 'F j, Y' , $newdate1 );
$newdate2 = strtotime ( '-1 day' , strtotime ( $newdate1) ) ;
'</br>';
$newdate2 = date ( 'F j, Y' , $newdate2 );
// mailer

            $message = '<html><body>';
			 $message .= 'Dear '.$firstname.',';
		    $message .= $content;
		  //  $message .= '<strong>Your program details are:</strong>';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		    $message .= "<tr><td><strong>Program:</strong></td><td> " .$program."</td></tr>";
			$message .= "<tr><td><strong>Duration in weeks:</strong></td><td> " .$duration."</td></tr>";
			$message .= "<tr><td><strong>Program start date:</strong> </td><td>" .$arrival."</td></tr>";
			$message .= "<tr><td><strong>Cost (USD):</strong> </td><td>" .$fee."</td></tr>";
			$message .= "</table>";
			$message .= "<p></p>";
			$message .= "<p>PLEASE MAKE A CAREFUL NOTE OF THE FOLLOWING DETAILS BEFORE YOU BOOK YOUR FLIGHTS:</p>";
			$message .= "<strong>Your arrival date into India is Sunday,".$arrival.'</strong>';
			$message .= "<p> </p>";
			$message .= "<strong>Your program is for ". $duration1 ." weeks,</strong>";
			$message .= "<p> </p>";
			$message .= "<strong>Program will finish on Friday, ".$newdate2.'</strong>';
			$message .= "<p> </p>";
			$message .= "<strong>You will need to check out of the ISAC accommodation on Saturday, ".$newdate1." before 11AM.</strong>";
			$message .= "<p>All program activities will be conducted Monday to Friday. Weekends are free for your own personal travel and other activities. </p>";
			$message .= "<p> </p>";
			$message .= $content1;
			$message .= "</body></html>";		
			//   CHANGE THE BELOW VARIABLES TO YOUR NEEDS  
			$to = $email;
			$subject = 'ISAC : Acceptance Letter';
			$headers = "From:info@indiastudyabroad.org\r\n";
			$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
			$headers .= "CC: info@indiastudyabroad.org\r\n";
			//$headers .= "CC: balesh.work@gmail.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($to, $subject, $message, $headers);
      // if (mail($to, $subject, $message, $headers)) {
//          header('location:view_admin_dashboard.php');
//        } else {
//            echo 'There was a problem sending the email.';
//          }
            
	// html mailer
	$sql = "UPDATE application SET acceptance_sent = '1' WHERE formid = '$formid' AND isacid = '$isacid'";
$result = mysql_query($sql);
if($result)
{
	header('location:view_admin_dashboard.php');
}

?>
