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
	

	if(isset($_POST['partnername']))//If a username has been submitted 
	{
		$partnername = mysql_real_escape_string($_POST['partnername']);//Some clean up :)
		
		$sql = "SELECT * FROM registration WHERE isac_partnername='$partnername'";
		$check_for_partnername = mysql_query($sql);
		//Query to check if username is available or not 
	
	if(mysql_num_rows($check_for_partnername))
		echo '1';//If there is a  record match in the Database - Not Available
	else
		echo '0';//No Record Found - Username is available 
	}

?>