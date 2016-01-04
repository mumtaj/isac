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
	?>
    <?php
		
	// checking the user name AND Email
	$query_username_select = "SELECT * FROM admin WHERE login = '$usersname' OR email = '$email'";		
	$query_username_result = mysql_query($query_username_select); 	
	$query_username_count = mysql_num_rows($query_username_result);
	
	if($_POST != '')
	{
		$status = $_POST['sch_status'];
		$updatedate = date("Y-m-d H:i:s");
		
		$update_sql = "UPDATE scholarship SET scholarship_status = '$status', updated_time = '$updatedate'";
		$update_result = @mysql_query($update_sql);
		
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