<?php

require_once('config.php');
	
	// auth for the user 
	
	//require_once('auth.php');
	
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
	echo $prog_id = $_POST['cat'];
	$min_amt = $_POST['base_amount'];
	$diff_amt = $_POST['difference_amount'];
	
	$sql1 = "INSERT INTO program_cost(program_id,base_amount,difference_amount) VALUES ('$prog_id','$min_amt','$diff_amt')";
    $result = @mysql_query($sql1);
	?>
    
    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>