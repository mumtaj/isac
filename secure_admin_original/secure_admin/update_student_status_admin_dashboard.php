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
	
	//$group = $_POST["csi"];	
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

	if ($_POST['formid'] != '' AND $_POST['isacid'] != '' AND $_POST['scholarship_status'] != '')
	{
		$formid = $_POST['formid'];
		$isacid = $_POST['isacid'];
		
		$scholarship_status = $_POST['scholarship_status'];
		
		$sql = "SELECT * FROM application WHERE formid = '$formid' AND isacid = '$isacid'";
		$result = mysql_query($sql);
		// selecting the email for user
		
		while ($row = mysql_fetch_array($result))
  {
	 $first_name_s = $row['firstname'];
	 $program_name = $row['program'];  
	 $week = $row['duration'];
	 $start_date = $row['arrival'];
	 $email = $row['email'];
	
	  
  }
		// end
		$num_rows = mysql_num_rows($result);
		
		if($num_rows == 1)
		{
			$update_sql	= "UPDATE application SET scholarship_status = '$scholarship_status' WHERE formid = '$formid' AND isacid = '$isacid'";
			$update_result = mysql_query($update_sql);
			// mail 
			$msgTo = $email;
	$msgSubject = "ISAC Scholarship Approved";    
	//$msgHeaders = "To: $msgTo\r\n";
	$msgContent= "Hi $first_name_s, 

	You scholarship is approved. 
	
	Kindly login to MY ISAC section on the website to complete your profile and proceed to payment.

    For further information please contact info@indiastudyabroad.org.
	
	Sincerely,

   Arunabha Pal
   India Study Abroad Center: www.indiastudyabroad.org
   Email: arunabha@indiastudyabroad.org
	";
	
	$msgHeaders = "From: info@indiastudyabroad.org";
	//$msgHeaders .= "X-Mailer: PHP".phpversion();
	
	$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
			// end mail
			
			if($update_result)
			header('location:view_admin_dashboard.php');
		}
	
	}
?>