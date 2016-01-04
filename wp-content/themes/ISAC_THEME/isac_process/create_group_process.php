<?php session_start();

//Include database connection details
require_once('../config/config.php');

$isacid = $_SESSION['SESS_MEMBER_ID']; 


if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_SESSION['SESS_MEMBER_GROUP_TYPE'] == 'GROUP')
{
	$groupname = $_POST['groupname'];
	$group_creator_id = $_SESSION['SESS_MEMBER_ID'];
	
	//current date 
	$currentdate = date("d/m/y");
	
	
	$check_sql = "SELECT * FROM groups WHERE group_name = '$groupname'";
	$check_result = mysql_query($check_sql);
	
	
	$grouplimit_sql = "SELECT * FROM  group_limit";
	$grouplimit_result = mysql_query($grouplimit_sql);
	$grouplimit_row = mysql_fetch_array($grouplimit_result);
	
	$grouplimit = $grouplimit_row['minimum'];
	
	if(mysql_num_rows($check_result) == 0)
	{
		$sql = "SELECT * FROM groups ORDER BY id DESC LIMIT 0,1";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$a = $row['id'] + 1;
		$group_id = 'GP_ISAC'.$a;
		
		$qry_groups = "INSERT INTO groups(group_id, group_name, isacid, group_members, group_limit, group_createtime) 
								VALUES('$group_id','$groupname','$group_creator_id','0', '$grouplimit','$currentdate')";
		$result = @mysql_query($qry_groups);
		
		$qry_groups_count = "INSERT INTO group_members_count(group_id, registration_fee_count, fee_first_inst_count, fee_second_inst_count) 
								VALUES('$group_id','0','0','0')";
		$result_count = @mysql_query($qry_groups_count);
		
		$success_result = 'success';
	}
	else
	{
		$success_result = 'not_success';
	}
	
	
	if($success_result == 'success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."my_groups'";
		echo "</script> ";
	}
	else if($success_result == 'not_success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."my_groups?status=false'";
		echo "</script> ";
	}
}
else
{
	echo "<script type='text/javascript'>";
		echo "window.location = '".SERVER_URL."my_groups'";
	echo "</script> ";	
}
?>