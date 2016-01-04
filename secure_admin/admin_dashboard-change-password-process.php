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
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	
	//Sanitize the POST values
	$current_password = clean($_POST["current_password"]);
	$newpassword = clean($_POST["password"]);
	
	// checking the user name AND Email
	$current_member_id = $_SESSION['SESS_MEMBER_ID'];
	$query_select = "SELECT * FROM admin WHERE member_id = '$current_member_id' AND passwd='".md5($current_password)."'";		
	$query_result = mysqlquery($query_select); 	
	$query_count = mysqlnumrows($query_result);
	$query_row = mysqli_fetch_array($query_result);
	
	//if Already there  user name OR Email
	if($query_count > 0)
	{
		$qry = "UPDATE admin SET passwd='".md5($newpassword)."' 
							WHERE member_id = '$current_member_id' AND passwd='".md5($current_password)."'";
		$result = @mysqlquery($qry);
		
		$name = $query_row['firstname'];
		$email = $query_row['email'];
		
		if($result) {
			$msgTo = $email;
			$msgSubject = "ISAC Admin Dashboard - Change Password confirmation";    
			//$msgHeaders = "To: $msgTo\r\n";
			$msgContent= "Hi $name,
			
			You have successfully changed on indiastudyabroad.org Admin Dashboard Password.
		
			New Password - $newpassword.";
			
			$msgHeaders = "From: info@indiastudyabroad.org";
			//$msgHeaders .= "X-Mailer: PHP".phpversion();
			
			$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
			
			echo"
				<script type='text/javascript'>
					window.location = 'admin_dashboard-change-password.php?status=true'
				</script>";
			exit();
		}
		else {
			 die('Could not connect: ' . mysql_error());
		}
		
		
	}
	else
	{
		echo"
		<script type='text/javascript'>
			window.location = 'admin_dashboard-change-password.php?status=false'
		</script>";
	}
?>