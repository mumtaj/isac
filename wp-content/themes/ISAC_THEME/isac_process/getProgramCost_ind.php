<?php session_start();

//Include database connection details
require_once('../config/config.php');

if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_POST['programs2'] != '')
{
	$programs = $_POST['programs2'];
	$duration = $_POST['duration'];
	
	$sql = "SELECT * FROM  isac_duration WHERE program_id = '$programs' ORDER BY id";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	$start_date = $row['start_week'];
	$end_date = $row['end_week'];
	$pr_id = $row['program_id'];
	$base_amt_sc = $row['base_amount'];
	$diff_amt_sc = $row['difference_amount'];
	
	$cost_sum = $duration - $start_date;
	$cost = $base_amt_sc +($cost_sum * $diff_amt_sc);
	
	echo '$'.$cost;
}

?>