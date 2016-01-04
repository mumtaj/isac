<?php
require_once('config.php');
require_once('auth.php');
	
	// auth for the user 
	
	//require_once('auth.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	

$program = $_POST['program'];

 //$prog_id = $_POST['cat'];
	
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

$qrysel = mysqlquery("SELECT cat_id from category ORDER BY cat_id DESC LIMIT 1");
while($row_last_id = mysqli_fetch_array($qrysel))
		{ 
	  $last_cat_id = $row_last_id['cat_id'];
		}
	
$catid_prog = $last_cat_id + '1';

$qry = "INSERT INTO category(cat_id,category) VALUES ('$catid_prog','$program')";	
$sql1 = "INSERT INTO isac_duration(program_id,start_week,end_week,base_amount,difference_amount,base_amount_gp,difference_amount_gp,base_amount_sc,difference_amount_sc,base_amount_part,difference_amount_part) VALUES ('$catid_prog','$start_week','$end_week','$min_amt','$diff_amt','$min_amt1','$diff_amt1','$min_amt2','$diff_amt2','$min_amt3','$diff_amt3')";	  
$result = @mysqlquery($sql1);	
$result1 = @mysqlquery($qry);
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