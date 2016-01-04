<?php
	header ("location: ".$_POST['currentpage_name']."?action=del");
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
	
 	$applicationid = $_POST['applicationid']; 
	

$sql1 = "UPDATE application SET delete_flag  = 1 WHERE formid = '$applicationid' ";
$result = @mysql_query($sql1);

?>
