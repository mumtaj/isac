<?php session_start();

//Include database connection details
require_once('../config/config.php');

$isacid = $_SESSION['SESS_MEMBER_ID']; 

if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_SESSION['SESS_MEMBER_PARTNER_TYPE'] == 'PARTNER')
{
	$del_isacid = $_POST['del_isacid'];
	$formid = $_POST['formid'];
	$edit_groupid = $_POST['edit_groupid'];
	$partner_id = $_SESSION['SESS_MEMBER_PARTNER_ID'];
	
	
	$sel_sql = "SELECT * FROM application WHERE isacid = '$del_isacid' AND formid = '$formid' AND group_id = '$edit_groupid'  AND partner_id = '$partner_id'";
	$sel_result = @mysql_query($sel_sql);
	
	
	if(mysql_num_rows($sel_result) > 0)
	{
		
		$part_sql = "SELECT * FROM partner WHERE group_id = '$edit_groupid' AND partner_id = '$partner_id' AND isacid = '$isacid'";
		$part_result = mysql_query($part_sql);
		$part_row = mysql_fetch_array($part_result);
		
		$part_members = $part_row['total_members'] - 1;
		
		
		
		if($del_isacid != '' AND $formid != '')
		{
			$sql = "DELETE FROM application WHERE isacid = '$del_isacid' AND formid = '$formid' AND group_id = '$edit_groupid'  AND partner_id = '$partner_id'";
			$result = @mysql_query($sql);
			
			$gp_sql = "UPDATE partner SET total_members = '$part_members' WHERE group_id = '$edit_groupid' AND isacid = '$isacid' AND partner_id = '$partner_id'";
			$result2 = @mysql_query($gp_sql);
			
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
			echo "window.location = '".SERVER_URL."add_partner_group_members?del=true'";
		echo "</script> ";
	}
	else if($success_result == 'not_success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location =' ".SERVER_URL."add_partner_group_members?del=false'";
		echo "</script> ";
	}
}
else
{
	echo "<script type='text/javascript'>";
		echo "window.location = '".SERVER_URL."add_partner_group_members'";
	echo "</script> ";	
}
?>
