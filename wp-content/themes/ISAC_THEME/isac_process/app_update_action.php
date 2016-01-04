<?php session_start();

	//Include database connection details
	require_once('../config/config.php');
	
	$formid = $_SESSION['formid'];
	$isacid = $_SESSION['SESS_MEMBER_ID'];
	
		
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	$program_temp = clean($_POST['programs']);
	$duration = clean($_POST['duration']);
	$arrival = clean($_POST['program_start_date']);
	$program_cost = clean($_POST['fees']);
	$isacid = clean($_POST['isacid']);
	
	$get_formid = clean($_POST['get_formid']);
	
	
	$program_select = mysql_query("SELECT category FROM category where cat_id='$program_temp' ORDER BY cat_id DESC LIMIT 0,1");
	while($row = mysql_fetch_array($program_select))
	{
		$program = $row['category'];
	}
	
	//current date 
	$currentdate = date("d/m/y");
	// cost break for the program
	$fee = str_replace('$','',$program_cost);
	$firstinstall = '300';
	$secondinstall = $fee-$firstinstall;

	
	$qry = "UPDATE application SET program='$program', duration='$duration', arrival='$arrival', fee='$fee', first_installment='$firstinstall', second_installment='$secondinstall', program_id = '$program_temp' WHERE formid = '$get_formid'";
	$result = @mysql_query($qry);
	
	
	//Check whether the query was successful or not
	if($result) { 
	echo "<script type='text/javascript'>";
		echo "window.location = '".SERVER_URL."summary_application?formid=$formid'";
	echo "</script>";
	}
		
	else {
		 die('Could not connect: ' . mysql_error());
	}
?>