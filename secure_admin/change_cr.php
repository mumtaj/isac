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
	
	$cr = $_POST['change'];
	?>
<?php
// How many adjacent pages should be shown on each side?
mysqlquery("UPDATE currency SET cn = '$cr'");
	
header( 'Location:admin_currency.php');
// end new pagination
?>

