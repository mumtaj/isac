<?php session_start();

//Include database connection details
require_once('../config/config.php');

if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_SESSION['SESS_MEMBER_PARTNER_TYPE'] == 'PARTNER' AND $_POST['groupname'] != '')
{
	
	//current date 
	$currentdate = date("d/m/y");
	
	$groupname = $_POST['groupname'];
	
	$check_sql = "SELECT * FROM partner WHERE group_name = '$groupname'";
	$check_result = mysql_query($check_sql);
	
	
	if(mysql_num_rows($check_result) == 0)
	{
		$sql = "SELECT * FROM partner ORDER BY id DESC LIMIT 0,1";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$a = $row['id'] + 1;
		
		$isacid = $_SESSION['SESS_MEMBER_ID'];
		$partner_id = $_SESSION['SESS_MEMBER_PARTNER_ID'];
		$partner_name = $_SESSION['SESS_MEMBER_PARTNER_NAME'];
		
		$group_id = 'PART_GP_ISAC'.$a;
		
		
		$qry_groups = "INSERT INTO partner(isacid, partner_id, partner_name, group_id, group_name, total_amount, paid_status, total_members) 
								VALUES('$isacid', '$partner_id','$partner_name','$group_id','$groupname','0', 'PENDING', '0')";
		$result = @mysql_query($qry_groups);
		
		$success_result = 'success';
	}
	else
	{
		$success_result = 'not_success';
	}
	
	if($success_result == 'success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."add_partner_group_members?group_id=$group_id'";
		echo "</script> ";
	}
	else if($success_result == 'not_success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."student_panel_dashboard_partner?status=false'";
		echo "</script> ";
	}
}
else
{
	echo "<script type='text/javascript'>";
		echo "window.location = '".SERVER_URL."student_panel_dashboard_partner'";
	echo "</script> ";	
}
?>