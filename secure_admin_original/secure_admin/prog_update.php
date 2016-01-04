<?php
require_once('config.php');
require_once('auth.php');
	
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

$program = $_POST['program'];

 //$prog_id = $_POST['cat'];
$program_id = $_POST['prog_id'];
$start_week = $_POST['start_week'];
$end_week = $_POST['end_week'];
$min_amt = $_POST['base_amount'];
$diff_amt = $_POST['difference_amount'];
$min_amt1 = $_POST['base_amount1'];
$diff_amt1 = $_POST['difference_amount1'];
$min_amt2 = $_POST['base_amount2'];
$diff_amt2 = $_POST['difference_amount2'];
$min_amt3 = $_POST['base_amount3'];
$diff_amt3 = $_POST['difference_amount3'];	 
$update_cat = mysql_query("UPDATE category SET category = '$program' WHERE cat_id = '$program_id'");
$update_records = mysql_query("UPDATE isac_duration SET start_week='$start_week',end_week='$end_week', base_amount='$min_amt',difference_amount='$diff_amt',base_amount_gp='$min_amt1',difference_amount_gp='$diff_amt1', base_amount_sc='$min_amt2',difference_amount_sc='$diff_amt2', base_amount_part='$min_amt3',difference_amount_part='$diff_amt3' WHERE program_id ='$program_id'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
<!--
window.location = "admin_program.php"
//-->
</script>
</head>

<body>



</body>
</html>