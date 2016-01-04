<?php
header ("location: program_arrival.php");

require_once('config.php');
	
	// auth for the user 
	
	require_once('auth.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	$arrival_id_update = $_POST['sno'];
	
    $update_arrival = mysqlquery ("DELETE FROM isac_arrival_table WHERE sno ='$arrival_id_update'");

	?>
