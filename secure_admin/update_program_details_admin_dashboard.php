<?php
session_start();

$admin_name = $_SESSION['SESS_FIRST_NAME'];
?>
<?php
	require_once('auth.php');
?>
<?php 
    //Include database connection details
	require_once('config.php');
	
	//$group = $_POST["csi"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	

	if ($_POST['formid'] != '' AND $_POST['isacid'] != '' AND $_POST['program_name'] != '')
	{
		
		$program_id = $_POST['program_name'];
		$program_duration = $_POST['program_duration'];
		$program_start_date = $_POST['program_start_date'];
		$program_fee = $_POST['program_fee'];
	
		$formid = $_POST['formid'];
		$isacid = $_POST['isacid'];
		
		$sql = "SELECT * FROM application WHERE formid = '$formid' AND isacid = '$isacid'";
		$result = mysqlquery($sql);
		$num_rows = mysqlnumrows($result);
		
		if($num_rows == 1)
		{
			$cat_sql = "SELECT * FROM category WHERE cat_id = '$program_id'";
			$cat_result = mysqlquery($cat_sql);
			$cat_row = mysqli_fetch_array($cat_result);
			
			$program_name = $cat_row['category'];
			
			$update_sql	= "UPDATE application SET program = '$program_name', duration = '$program_duration', arrival = '$program_start_date', 
													fee = '$program_fee', program_id = '$program_id' 
													WHERE formid = '$formid' AND isacid = '$isacid'";
			$update_result = mysqlquery($update_sql);
			
			if($update_result)
			header('location:view_admin_dashboard.php');
		}
	
	}
?>