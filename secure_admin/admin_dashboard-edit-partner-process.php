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
	$partnername = clean($_POST['partnername']);
	$leadername = clean($_POST['leadername']);
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	$details = clean($_POST['details']);


 	$isacid = $_POST['isacid'];
	$partner_id = $_POST['partner_id'];

	
	
	// checking the user name AND Email
	$query_partner_select = "SELECT * FROM registration WHERE email = '$email' OR isac_partnername = '$partnername'";		
	$query_partner_result = mysqlquery($query_partner_select); 	
	$query_partner_count = mysqlnumrows($query_partner_result);
	
	
	//if Already there  user name OR Email
	if($query_partner_count > 1)
	{
		//echo "<script type='text/javascript'> window.location = 'admin_dashboard-create-new-partner.php?status=update_false'; </script>";
	}
	else
	{
		//Create INSERT query
		if($password == '')
		{
			$qry = "UPDATE registration SET firstname = '$leadername', email = '$email',
									 isac_partnername = '$partnername', partner_details = '$details' 
									 WHERE partner_id_isac = '$partner_id' AND isacid = '$isacid'";
			$result = @mysqlquery($qry);
		
		}
		else
		{
			$qry = "UPDATE registration SET firstname = '$leadername', email = '$email', password = '". md5($password). "', isac_partnername = '$partnername', partner_details = '$details' WHERE partner_id_isac = '$partner_id' AND isacid = '$isacid'";
			$result = @mysqlquery($qry);
		}
	
	
		if($result) {
			//echo "<script type='text/javascript'> window.location = 'admin_dashboard-create-new-partner.php?status=update_true'; </script>";
			exit();
		}
		else {
			 die('Could not connect: ' . mysql_error());
		}
	}
?>
