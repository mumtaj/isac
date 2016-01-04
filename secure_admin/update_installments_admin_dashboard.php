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
	

	if ($_POST['formid'] != '' AND $_POST['isacid'] != '')
	{
		$formid = $_POST['formid'];
		$isacid = $_POST['isacid'];
		
		$first_installment = $_POST['first_installment'];
		$second_installment = $_POST['second_installment'];
		
		$sql = "SELECT * FROM application WHERE formid = '$formid' AND isacid = '$isacid'";
		$result = mysqlquery($sql);
		$row = mysqli_fetch_array($result);
		$num_rows = mysqlnumrows($result);

		$group_id = $row['group_id'];
		
		if($row['isac_groupname'] != '' AND $row['group_id'] != '')
		{
			$sql1 = "SELECT * FROM group_members_count WHERE group_id = '$group_id'";
			$result1 = mysqlquery($sql1);
			$row1 = mysqli_fetch_array($result1);
		}
		
		if ($_POST['registration_fee'] == 'PAID')
		{
			$registration_fee = $_POST['registration_fee'];
			
			if($row['registration_fee'] == '' OR $row['registration_fee'] != 'PAID')
			{
				$registration_fee_count = $row1['registration_fee_count'] + 1;
			}
			else
				$registration_fee_count = $row1['registration_fee_count'];
		}
		else
		{
			$registration_fee = '';
			$registration_fee_count = $row1['registration_fee_count'];
			if($registration_fee_count != 0 && $row['registration_fee'] == 'PAID') $registration_fee_count -= 1;
		}
			
		if ($_POST['fee_first_installment'] == 'PAID')
		{
			$fee_first_installment = $_POST['fee_first_installment'];
			
			if($row['fee_first_installment'] == '' OR $row['fee_first_installment'] != 'PAID')
			{
				$first_inst_fee_count = $row1['fee_first_inst_count'] + 1;
			}
			else
				$first_inst_fee_count = $row1['fee_first_inst_count'];
			
		}
		else
		{
			$fee_first_installment = '';
			$first_inst_fee_count = $row1['fee_first_inst_count'];
			if($first_inst_fee_count != 0 && $row['fee_first_installment'] == 'PAID') $first_inst_fee_count -= 1;
		}
			
		if ($_POST['fee_second_installment'] == 'PAID')
		{
			$fee_second_installment = $_POST['fee_second_installment'];
			 
			if($row['fee_second_installment'] == '' OR $row['fee_second_installment'] != 'PAID')
			{
				$secound_inst_fee_count = $row1['fee_second_inst_count'] + 1;
			}
			else
				$secound_inst_fee_count = $row1['fee_second_inst_count'];
			
		}
		else
		{
			$fee_second_installment = '';
			$secound_inst_fee_count = $row1['fee_second_inst_count'];
			if($secound_inst_fee_count != 0 && $row['fee_second_installment'] == 'PAID') $secound_inst_fee_count -= 1;
		}
		
		
		
		if($num_rows == 1)
		{
			if($row['isac_groupname'] != '' AND $row['group_id'] != '')
			{
				$update_sql1 = "UPDATE group_members_count SET registration_fee_count = '$registration_fee_count', fee_first_inst_count = '$first_inst_fee_count',
										 fee_second_inst_count = '$secound_inst_fee_count' WHERE group_id = '$group_id'";
				$update_result1 = @mysqlquery($update_sql1);
			}
			
			
			$update_sql	= "UPDATE application SET registration_fee = '$registration_fee', fee_first_installment = '$fee_first_installment',fee_second_installment = '$fee_second_installment' WHERE formid = '$formid' AND isacid = '$isacid'";
			$update_result = mysqlquery($update_sql);
			
			
			if($update_result)
			header('location:view_admin_dashboard.php');
		}
	
	}
?>