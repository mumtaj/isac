<?php session_start();

//Include database connection details
require_once('../config/config.php');

$isacid = $_SESSION['SESS_MEMBER_ID']; 

/*echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_SESSION['SESS_MEMBER_GROUP_TYPE'] == 'GROUP')
{
	
	$owner_program = $_POST['owner_program']; //Check Group Owner Thing
 
	if($owner_program != '')
	{
		$program_temp = $_POST['owner_cat'];
		$duration = $_POST['value_set'];
		$arrival = $_POST['owner_subcat3'];
		$fee = $_POST['cost_fees'];
		$email = $_POST['owner_email'];
		$lastname = $_POST['owner_lastname'];
		$name = $_POST['owner_name'];
		$group_process = $_POST['group_id'];
		$gp = 'GROUP';
		
		
		//IF OWNER === YOU ENTER OWNER SECTION - CHECKING OWNER EMAIL
		$check_query1 = "SELECT * FROM registration WHERE isacid = '$isacid'";
		$check_result1 = mysql_query($check_query1);
		$check_row = mysql_fetch_array($check_result1);
		
		if($check_row['email'] ==  $email)
			$correct_owner_email = 'correct';
		else
			$correct_owner_email = 'not_correct';
	}
	else
	{
		$program_temp = $_POST['cat'];
		$duration = $_POST['value_set'];
		$arrival = $_POST['subcat3'];
		$fee = $_POST['cost_fees'];
		$email = $_POST['email'];
		$lastname = $_POST['lastname'];
		$name = $_POST['name'];
		$group_process = $_POST['group_id'];
		$gp = 'GROUP_MEMBER';
	}
	
	$firstinstall = '300';
 	$secondinstall = $fee - $firstinstall;

	$dateofregistration = date('d/m/Y - h:i:s A', time()+19800);
 
 	//selecting the values of arrival i.e month and year 
	$query_arrival_division = mysql_query("SELECT * FROM  isac_arrival_table WHERE arrival_date_full = '$arrival'");
	while($row_arrival_d = mysql_fetch_array($query_arrival_division))
	{
		$arrival_year = $row_arrival_d['arrival_year'];
		$arrival_month = $row_arrival_d['arrival_month'];
	} 

	
	///////////////////////////////////CHECK USER EMAIL Already Regisitered or NOT
	$check_query = "SELECT * FROM registration WHERE email = '$email'";
	$check_result = mysql_query($check_query);
	$check_row = mysql_fetch_array($check_result);
	$gender = $check_row['gender'];	
	
	// uniqueid isac id
	if($owner_program != '')
	{
		$isacid_member= $isacid;	
	}
	else if(mysql_num_rows($check_result) == 0)
	{
		$query1 = mysql_query("SELECT * FROM registration ORDER BY id DESC LIMIT 0,1");
		$row = mysql_fetch_array($query1);
		$a = $row['id'];
		
		$c = $a + '1';
		$isacid_member='ISAC'.$c;
	}
	else
	{
		$isacid_member = $check_row['isacid'];
	}
	
 
	// unique form id
	$idgenration = mysql_query("SELECT * FROM application ORDER BY id DESC LIMIT 0,1");
	while($user_id_gen = mysql_fetch_array($idgenration))
	{
		$unique_id = $user_id_gen['id'];
	}
	
	$unique_id_temp = $unique_id+'1';
	$formid = $isacid.$unique_id_temp;
	
	
	// GETTING GROUP LIMIT
	$grouplimit_sql = "SELECT * FROM  group_limit";
	$grouplimit_result = mysql_query($grouplimit_sql);
	$grouplimit_row = mysql_fetch_array($grouplimit_result);
	
	$grouplimit = $grouplimit_row['maximum'];
	
	
	
	$program_select = mysql_query("SELECT category FROM category where cat_id='$program_temp'");
	while($row = mysql_fetch_array($program_select))
	{
		$program = $row['category'];
	}

	//current date 
	$currentdate = date("d/m/y");
	
	////CHECK USER ALREADY GROUP MEMBER OR NOT
	$check_groupmember_sql = "SELECT * FROM application WHERE email = '$email' AND group_id = '$group_process'";
	$check_groupmember_result = mysql_query($check_groupmember_sql);
	
	$gp_sql = "SELECT * FROM groups WHERE group_id = '$group_process'";
	$gp_result = mysql_query($gp_sql);
	$gp_row = mysql_fetch_array($gp_result);
	
	$gp_members = $gp_row['group_members'] + 1;
	$gp_name = $gp_row['group_name'];
	
	
	/*$gp_members_count_sql = "SELECT registration_fee_count FROM group_members_count WHERE group_id = '$group_process'";
	$gp_members_count_result = mysql_query($gp_members_count_sql);
	$gp_members_count_row = mysql_fetch_array($gp_members_count_result);
	$gp_members_count = $gp_members_count_row['registration_fee_count'] + 1;*/
	
	
	if($correct_owner_email == 'correct' OR $correct_owner_email == '')
	{
		if(mysql_num_rows($check_result) == 0)
		{
			// gen password
			function randomChar($digit) {
				$char = array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
				$keys = array();
				while(count($keys) < $digit) {
					$x = mt_rand(0, count($char)-1);
					if(!in_array($x, $keys)) {
						$keys[] = $x;
					}
				}
				foreach($keys as $key){
					$random_chars .= $char[$key];
				}
				return $random_chars;
			}
		
			$pass = randomChar(8) ;
			$pass;
			
			// sending mail
			$msgTo = $email;
			$msgSubject = "ISAC registration confirmation";    
			$msgHeaders = "To: $msgTo\r\n";
			$msgContent= "Hi $firstname
			
			You have successfully registered on indiastudyabroad.org
			your account details are as follows
			
			 Username - $email
			 Password - $pass
			
			Please retain these details in order to login to your account.
			Apply for program and check your application status.
			We thank you for registering on our site and look forward to welcome you to our programs.";
		
			$msgHeaders .= "From: info@indiastudyabroad.org\r\n";
			$msgHeaders .= "X-Mailer: PHP".phpversion();
			
			$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
			
			// end confirm mail
		
			// searching for test
			$qry_application = "INSERT INTO application(isacid,isac_groupname,firstname,lastname,email,program,user_type, program_id,group_id,formid,fee, 	
											arrival,duration,formdate, first_installment, second_installment, arrival_month,arrival_year, group_limit) 
								VALUES('$isacid_member', '$gp_name', '$name','$lastname','$email','$program', '$gp', '$program_temp','$group_process',
								'$formid','$fee','$arrival','$duration', '$dateofregistration', '$firstinstall','$secondinstall', '$arrival_month','$arrival_year', '$grouplimit')";
			$result = @mysql_query($qry_application);
		
		
			$qry_registration = "INSERT INTO registration(isacid,firstname,lastname,email,password,dateofregistration,group_isac,group_id_isac) 
							VALUES('$isacid_member','$name','$lastname','$email','".md5($pass)."','$dateofregistration','$gp',' $group_process')";
			$result1 = @mysql_query($qry_registration);
			
			$gp_sql = "UPDATE groups SET group_members = '$gp_members' WHERE group_id = '$group_process' AND isacid = '$isacid'";
			$result2 = @mysql_query($gp_sql);
			
			/*$gp_sql2 = "UPDATE group_members_count SET registration_fee_count = '$gp_members_count' WHERE group_id = '$group_process'";
			$result3 = @mysql_query($gp_sql2);*/
			
			$success_result = 'success';
		}
		else if (mysql_num_rows($check_groupmember_result) == 0)
		{
			$qry_application = "INSERT INTO application(isacid,isac_groupname,firstname,lastname,email,gender, program,user_type, program_id,group_id,formid,fee, 	
											arrival,duration,formdate, first_installment, second_installment, arrival_month,arrival_year, group_limit) 
								VALUES('$isacid_member', '$gp_name', '$name','$lastname','$email', '$gender', '$program', '$gp', '$program_temp','$group_process',
								'$formid','$fee','$arrival','$duration', '$dateofregistration', '$firstinstall','$secondinstall', '$arrival_month','$arrival_year', '$grouplimit')";
			$result = @mysql_query($qry_application);
			
			$gp_sql = "UPDATE groups SET group_members = '$gp_members' WHERE group_id = '$group_process' AND isacid = '$isacid'";
			$result2 = @mysql_query($gp_sql);
			
			/*$gp_sql2 = "UPDATE group_members_count SET registration_fee_count = '$gp_members_count' WHERE group_id = '$group_process'";
			$result3 = @mysql_query($gp_sql2);*/
			
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
			echo "window.location = '".SERVER_URL."view_group_details'";
		echo "</script> ";
	}
	else if($success_result == 'not_success')
	{
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."view_group_details?status=false'";
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
