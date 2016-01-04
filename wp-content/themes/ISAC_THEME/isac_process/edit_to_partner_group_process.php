<?php session_start();

//Include database connection details
require_once('../config/config.php');

$isacid = $_SESSION['SESS_MEMBER_ID']; 
$partnerid = $_SESSION['SESS_MEMBER_PARTNER_ID'];

if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_SESSION['SESS_MEMBER_PARTNER_TYPE'] == 'PARTNER')
{
	$program_temp = $_POST['owner_cat'];
	$duration = $_POST['owner_subcat'];
	$arrival = $_POST['owner_subcat3'];
	$fee = $_POST['hideen_fees'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$group_process = $_POST['group_id'];
	
	$edit_formid = $_POST['edit_formid'];
	$edit_isacid = $_POST['edit_isacid'];
	
	// selecting the values of arrival i.e month and year 
	$query_arrival_division = mysql_query("SELECT * FROM  isac_arrival_table WHERE arrival_date_full = '$arrival'");
	while($row_arrival_d = mysql_fetch_array($query_arrival_division))
	{
		$arrival_year = $row_arrival_d['arrival_year'];
		$arrival_month = $row_arrival_d['arrival_month'];
	} 

	
	$program_select = mysql_query("SELECT category FROM category where cat_id='$program_temp'");
	while($row = mysql_fetch_array($program_select))
	{
		$program = $row['category'];
	}
	
	////CHECK USER ALREADY GROUP MEMBER OR NOT
	$check_groupmember_sql = "SELECT * FROM application WHERE email = '$email' AND program = '$program' AND group_id = '$group_process' AND partner_id = '$partnerid'";
	$check_groupmember_result = mysql_query($check_groupmember_sql);
	
	if (mysql_num_rows($check_groupmember_result) == 0)
	{
		if($edit_formid != '' AND $edit_isacid != '')
		{
			$sql = "UPDATE application SET program = '$program', program_id = '$program_temp', fee = '$fee', gender = '$gender',
											duration = '$duration', arrival = '$arrival', arrival_month = '$arrival_month',  
											arrival_year = '$arrival_year'
									WHERE isacid = '$edit_isacid' AND formid = '$edit_formid'";
			$result = mysql_query($sql);
			
			$success_result = 'success';
		}
		else
		{
			$success_result = 'not_success';
		}
	}
	else
	{
		$success_result = 'not_success';
	}
	
	if($success_result == 'success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."add_partner_group_members'";
		echo "</script> ";
	}
	else if($success_result == 'not_success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."add_partner_group_members?status=false'";
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