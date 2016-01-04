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

	if ($_POST['formid'] != '' AND $_POST['isacid'] != '')
	{
		$formid = $_POST['formid'];
		$isacid = $_POST['isacid'];
		
		if ($_POST['medical_status_form'] == 'Filled')
			$medical_status = $_POST['medical_status_form'];
		else
			$medical_status = '';
			
		$sql = "SELECT * FROM application WHERE formid = '$formid' AND isacid = '$isacid'";
		$result = mysql_query($sql);
		$num_rows = mysql_num_rows($result);
		
		if($num_rows == 1)
		{
			$update_sql	= "UPDATE application SET medical_status = '$medical_status' WHERE formid = '$formid' AND isacid = '$isacid'";
			$update_result = mysql_query($update_sql);
			
			if($update_result)
			header('location:view_admin_dashboard.php');
		}
	
	}
?>