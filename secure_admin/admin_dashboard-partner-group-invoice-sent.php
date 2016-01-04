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
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
	
	//Sanitize the POST values
	$group_id = $_POST['group_id'];
	$partner_id = $_POST['partner_id'];
	
	if($_POST['invoice_status'] == 'Pending')
		$invoice_status = 'PENDING';
	else if ($_POST['invoice_status'] == 'Invoice Sent')
		$invoice_status = 'Invoice Sent';
	else if ($_POST['invoice_status'] == 'Paid')
		$invoice_status = 'PAID';
	
	// checking the user name AND Email
	$partner_sql = "SELECT * FROM partner WHERE partner_id = '$partner_id' AND group_id = '$group_id' ";		
	$partner_result = mysqlquery($partner_sql); 	
	$partner_count = mysqlnumrows($partner_result);
	
	
	//if Already there  user name OR Email
	if($partner_count > 1)
	{
		echo"
		<script type='text/javascript'>
			window.location = 'admin_dashboard-partner-group-members.php?status=false'
		</script>";
	}
	else
	{
		//Create INSERT query
		$qry = "UPDATE partner SET paid_status = '$invoice_status' WHERE partner_id = '$partner_id' AND group_id = '$group_id' ";
		$result = @mysqlquery($qry);
	
	
		if($result) {
			echo"
				<script type='text/javascript'>
					window.location = 'admin_dashboard-partner-group-members.php?status=true'
				</script>";
			exit();
		}
		else {
			 die('Could not connect: ' . mysql_error());
		}
	}
?>
