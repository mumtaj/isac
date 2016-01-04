<?php
session_start();
$admin_name = $_SESSION['SESS_FIRST_NAME'];

    require_once('auth.php');
    //Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
	// checking the user name AND Email
	$query_username_select = "SELECT * FROM admin WHERE login = '$usersname' OR email = '$email'";		
	$query_username_result = mysqlquery($query_username_select); 	
	$query_username_count = mysqlnumrows($query_username_result);
	
	if($_POST != '')
	{
		$status = $_POST['sch_status'];
		$updatedate = date("Y-m-d H:i:s");
		
		$update_sql = "UPDATE scholarship SET scholarship_status = '$status', updated_time = '$updatedate'";
		$update_result = @mysqlquery($update_sql);
		
		echo"
		<script type='text/javascript'>
			window.location = 'admin_dashboard-incomplete-applications-scholarship.php'
		</script>";
	}
	else
	{
		echo"
		<script type='text/javascript'>
			window.location = 'admin_dashboard-incomplete-applications-scholarship.php'
		</script>";	
	}
	
	
?>