<?php
header ("location: admin_program.php");
?>
<?php

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

    function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

 
	}
	?>
    <?php 
 $pr_id = $_POST['prog_id_del']; 
	?>
    <?php

$sql1 = "DELETE FROM category WHERE cat_id='$pr_id' ";
$sql2 = "DELETE FROM isac_duration WHERE program_id ='$pr_id' ";
$result = @mysql_query($sql1);
$result1 = @mysql_query($sql2);
?>
