<?php session_start();

//Include database connection details
require_once('../config/config.php');

$isacid = $_SESSION['SESS_MEMBER_ID']; 

if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_SESSION['SESS_MEMBER_PARTNER_TYPE'] == 'PARTNER')
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
		$gp = 'PART_GP_OWNER';
		$gender = $_POST['gender'];
		
		
		
		//IF OWNER === YOU ENTER OWNER SECTION - CHECKING OWNER EMAIL
		$check_query1 = "SELECT * FROM registration WHERE isacid = '$isacid'";
		$check_result1 = mysql_query($check_query1);
		$check_row1 = mysql_fetch_array($check_result1);
		
		if($check_row1['email'] ==  $email)
			$correct_owner_email = 'correct';
		else
			$correct_owner_email = 'not_correct';
	}
	else
	{
		
		$program_temp = $_POST['cat'];
		$duration = $_POST['owner_subcat'];
		$arrival = $_POST['owner_subcat3'];
		$fee = $_POST['cost_fees'];
		$email = $_POST['email'];
		$lastname = $_POST['lastname'];
		$name = $_POST['name'];
		$group_process = $_POST['group_id'];
		$gp = 'PART_GP_MEMBER';
		$gender = $_POST['gender'];
	}

	$firstinstall = '300';
 	$secondinstall = $fee - $firstinstall;
	$dateofregistration = date('d/m/Y - h:i:s A', time()+19800);
 
 // selecting the values of arrival i.e month and year 
	$query_arrival_division = mysql_query("SELECT * FROM  isac_arrival_table WHERE arrival_date_full = '$arrival'");
	while($row_arrival_d = mysql_fetch_array($query_arrival_division))
	{
		$arrival_year = $row_arrival_d['arrival_year'];
		$arrival_month = $row_arrival_d['arrival_month'];
	} 

	// unique form id
	$idgenration = mysql_query("SELECT * FROM application ORDER BY id DESC LIMIT 0,1");
	while($user_id_gen = mysql_fetch_array($idgenration))
	{
		$unique_id = $user_id_gen['id'];
	}
	
	$unique_id_temp = $unique_id+'1';
	$formid = $isacid.$unique_id_temp;
	
	
	$program_select = mysql_query("SELECT category FROM category where cat_id='$program_temp'");
	while($row = mysql_fetch_array($program_select))
	{
		$program = $row['category'];
	}

	//current date 
	$currentdate = date("d/m/y");
	
	$part_sql = "SELECT * FROM partner WHERE group_id = '$group_process'";
	$part_result = mysql_query($part_sql);
	$part_row = mysql_fetch_array($part_result);
	
	$part_gp_members = $part_row['total_members'] + 1;
	$part_gp_name = $part_row['group_name'];
	$part_name = $part_row['partner_name'];
	$partner_id = $_SESSION['SESS_MEMBER_PARTNER_ID'];
	
	////CHECK USER ALREADY GROUP MEMBER OR NOT
	$check_groupmember_sql = "SELECT * FROM application WHERE email = '$email' AND program = '$program' AND group_id = '$group_process' AND partner_id = '$partner_id'";
	$check_groupmember_result = mysql_query($check_groupmember_sql);
	
	
	
	///////////////////////////////////CHECK USER EMAIL Already Regisitered or NOT
	$check_query = "SELECT * FROM registration WHERE email = '$email'";
	$check_result = mysql_query($check_query);
	$check_row = mysql_fetch_array($check_result);
	//$gender = $check_row['gender'];
	
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
			$qry_application = "INSERT INTO application(isacid,isac_groupname, isac_partnername, firstname,lastname,email,gender,program,user_type, program_id,
											group_id, partner_id, formid,fee, arrival,duration,formdate, first_installment, second_installment,
											arrival_month,arrival_year) 
								VALUES('$isacid_member', '$part_gp_name', '$part_name', '$name','$lastname','$email','$gender','$program', '$gp', '$program_temp',
								'$group_process', '$partner_id', '$formid','$fee','$arrival','$duration', '$dateofregistration', '$firstinstall','$secondinstall',
								'$arrival_month','$arrival_year')";
			$result = @mysql_query($qry_application);
		
		
			$qry_registration = "INSERT INTO registration(isacid,firstname,lastname,email,password,gender,dateofregistration,group_id_isac, partner_isac,partner_id_isac) 
							VALUES('$isacid_member','$name','$lastname','$email','".md5($pass)."','$gender','$dateofregistration','$group_process', '$gp', '$partner_id')";
			$result1 = @mysql_query($qry_registration);
			
			$gp_sql = "UPDATE partner SET total_members = '$part_gp_members' WHERE group_id = '$group_process' AND isacid = '$isacid' AND partner_id = '$partner_id'";
			$result2 = @mysql_query($gp_sql);
			
			$success_result = 'success';
		}
		else if (mysql_num_rows($check_groupmember_result) == 0)
		{
			$qry_application = "INSERT INTO application(isacid,isac_groupname, isac_partnername, firstname,lastname,email, gender, program,user_type, program_id,
											group_id, partner_id, formid,fee, arrival,duration,formdate,first_installment, second_installment,
											arrival_month,arrival_year) 
								VALUES('$isacid_member', '$part_gp_name', '$part_name', '$name','$lastname','$email', '$gender', '$program', '$gp', '$program_temp',
								'$group_process', '$partner_id', '$formid','$fee','$arrival','$duration', '$dateofregistration', '$firstinstall','$secondinstall',
								'$arrival_month','$arrival_year')";
			$result = @mysql_query($qry_application);
			
			$gp_sql = "UPDATE partner SET total_members = '$part_gp_members' WHERE group_id = '$group_process' AND isacid = '$isacid' AND partner_id = '$partner_id'";
			$result2 = @mysql_query($gp_sql);
			
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