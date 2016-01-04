<?php
	header ("location: admin_dashboard-incomplete-applications-group.php");
?>
<?php
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

 
	}
	
 	$minimum_limit = $_POST['minimum_limit']; 
	$maximum_limit = $_POST['maximum_limit'];
	$current_date = date('Y-m-d H:i:s');
	

$sql1 = "UPDATE group_limit SET minimum  = '$minimum_limit', maximum  = '$maximum_limit', update_time  = '$current_date' ";
$result = @mysqlquery($sql1);

?>
