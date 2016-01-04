<?php session_start();

//Include database connection details
require_once('../config/config.php');

$isacid = $_SESSION['SESS_MEMBER_ID']; 

/*echo '<pre>';
print_r($_POST);
echo '</pre>';*/


if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_SESSION['SESS_MEMBER_GROUP_TYPE'] == 'GROUP')
{
	$del_isacid = $_POST['del_isacid'];
	$formid = $_POST['formid'];
	$edit_groupid = $_POST['edit_groupid'];
	
	$sel_sql = "SELECT * FROM application WHERE isacid = '$del_isacid' AND formid = '$formid'";
	$sel_result = @mysql_query($sel_sql);
	$sel_rw =  @mysql_fetch_array($sel_result);
	if(mysql_num_rows($sel_result) > 0)
	{
		$gp_sql = "SELECT * FROM groups WHERE group_id = '$edit_groupid'";
		$gp_result = mysql_query($gp_sql);
		$gp_row = mysql_fetch_array($gp_result);
		
		$gp_members = $gp_row['group_members'] - 1;
		
	$reg_paidQ = (!empty($sel_rw['registration_fee']) && $sel_rw['registration_fee'] == 'PAID') ? ', registration_fee_count  = (registration_fee_count  - 1) ' : '' ;
		
		$first_install_paidQ = (!empty($sel_rw['fee_first_installment']) && $sel_rw['fee_first_installment'] == 'PAID') ? ', fee_first_inst_count =  (fee_first_inst_count - 1) ' : '';
		
		$second_install_paidQ = (!empty($sel_rw['fee_second_installment']) && $sel_rw['fee_second_installment'] == 'PAID') ? ', fee_second_inst_count = (fee_second_inst_count - 1) ' : '';

// LETS UPDATE THE GROUP MEMBER COUNT TABLE
 $cquery = "UPDATE group_members_count SET st=0 $reg_paidQ $first_install_paidQ $second_install_paidQ WHERE group_id = '$edit_groupid'";		
$update_gcount = @mysql_query($cquery);
		
		
		/*$gp_sql1 = "SELECT * FROM group_members_count WHERE group_id = '$edit_groupid'";
		$gp_result1 = mysql_query($gp_sql1);
		$gp_row1 = mysql_fetch_array($gp_result1);
		
		$gp_members1 = $gp_row1['registration_fee_count'] - 1;*/
		
		
		if($del_isacid != '' AND $formid != '')
		{
			$sql = "DELETE FROM application WHERE isacid = '$del_isacid' AND formid = '$formid'";
			$result = @mysql_query($sql);
			
			$gp_sql = "UPDATE groups SET group_members = '$gp_members' WHERE group_id = '$edit_groupid' AND isacid = '$isacid'";
			$result2 = @mysql_query($gp_sql);
			
			//$gp_sql1 = "UPDATE group_members_count SET registration_fee_count = '$gp_members1' WHERE group_id = '$edit_groupid'";
			//$result3 = @mysql_query($gp_sql1);
			
			$success_result = 'success';
		}
		else
			$success_result = 'not_success';
	}
	else
	{
		$success_result = 'not_success';
	}
	
	if($success_result == 'success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."view_group_details?del=true'";
		echo "</script> ";
	}
	else if($success_result == 'not_success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."view_group_details?del=false'";
		echo "</script> ";
	}
}
else
{
	echo "<script type='text/javascript'>";
		echo "window.location = '".SERVER_URL."view_group_details'";
	echo "</script> ";	
}
?>
