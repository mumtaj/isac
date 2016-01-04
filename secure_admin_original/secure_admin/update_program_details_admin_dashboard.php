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

	if ($_POST['formid'] != '' AND $_POST['isacid'] != '' AND $_POST['program_name'] != '')
	{
		
		$program_id = $_POST['program_name'];
		$program_duration = $_POST['program_duration'];
		$program_start_date = $_POST['program_start_date'];
		$program_fee = $_POST['program_fee'];
	
		$formid = $_POST['formid'];
		$isacid = $_POST['isacid'];
		
		$sql = "SELECT * FROM application WHERE formid = '$formid' AND isacid = '$isacid'";
		$result = mysql_query($sql);
		$num_rows = mysql_num_rows($result);
		
		if($num_rows == 1)
		{
			$cat_sql = "SELECT * FROM category WHERE cat_id = '$program_id'";
			$cat_result = mysql_query($cat_sql);
			$cat_row = mysql_fetch_array($cat_result);
			
			$program_name = $cat_row['category'];
			
			$update_sql	= "UPDATE application SET program = '$program_name', duration = '$program_duration', arrival = '$program_start_date', 
													fee = '$program_fee', program_id = '$program_id' 
													WHERE formid = '$formid' AND isacid = '$isacid'";
			$update_result = mysql_query($update_sql);
			
			if($update_result)
			header('location:view_admin_dashboard.php');
		}
	
	}
?>