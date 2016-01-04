<?php
header ("location: admin_program.php");

require_once('config.php');
	
	// auth for the user 
	
	require_once('auth.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	

    function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

     $pr_id = $_POST['prog_id_del']; 

$sql1 = "DELETE FROM category WHERE cat_id='$pr_id' ";
$sql2 = "DELETE FROM isac_duration WHERE program_id ='$pr_id' ";
$result = @mysqlquery($sql1);
$result1 = @mysqlquery($sql2);
?>
