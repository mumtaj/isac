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
	

//Include The Database Connection File 

	if(isset($_POST['email']))//If a email has been submitted 
	{
		$email = mysql_real_escape_string($_POST['email']);//Some clean up :)
		
		$check_for_username = mysqlquery("SELECT email FROM admin WHERE email='$email'");
	//Query to check if username is available or not 
	
	if(mysqlnumrows($check_for_username))
		echo '1';//If there is a  record match in the Database - Not Available
	else
		echo '0';//No Record Found - Username is available 
	}

?>