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
	
	if(isset($_POST['partnername']))//If a username has been submitted 
	{
		$partnername = mysql_real_escape_string($_POST['partnername']);//Some clean up :)
		
		$sql = "SELECT * FROM registration WHERE isac_partnername='$partnername'";
		$check_for_partnername = mysqlquery($sql);
		//Query to check if username is available or not 
	
	if(mysqlnumrows($check_for_partnername))
		echo '1';//If there is a  record match in the Database - Not Available
	else
		echo '0';//No Record Found - Username is available 
	}

?>