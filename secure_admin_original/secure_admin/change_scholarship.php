<?php
session_start();

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
	$cr = $_POST['change'];
	?>
<?php
// How many adjacent pages should be shown on each side?
mysql_query("UPDATE scholarship SET scholarship_status = '$cr'");
	
header( 'Location:admin_scholarship.php');
// end new pagination
?>

