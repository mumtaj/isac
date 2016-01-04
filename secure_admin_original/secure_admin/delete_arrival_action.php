<?php
header ("location: program_arrival.php");

require_once('config.php');
	
	// auth for the user 
	
	require_once('auth.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
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
	$arrival_id_update = $_POST['sno'];
	
    $update_arrival = mysql_query ("DELETE FROM isac_arrival_table WHERE sno ='$arrival_id_update'");

	?>
