<?php
session_start();

require_once('../config/config.php');

if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_POST['isacid'] == $_SESSION['SESS_MEMBER_ID'])
{
	
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	$program_id =  clean($_POST['programs']);
	$program_duration =  clean($_POST['duration_hidden']);
	$program_start_date =  clean($_POST['start_date_hidden']);
	$program_cost =  clean($_POST['fees']);

	
	$firstname =  clean($_POST['firstname']);
	$lastname =  clean($_POST['lastname']);
	$gender =  clean($_POST['gender']);
	$email =  clean($_POST['email']);
	$isacid =  clean($_POST['isacid']);
	
	
	$fellowship =  clean($_POST['fellowship']);
	$believe =  clean($_POST['believe']);
	
	
	$Toggledivs =  clean($_POST['Toggledivs']);
	$details_placement =  clean($_POST['details_placement']);
	$summarize =  clean($_POST['summarize']);
	
	
	$Toggledivs1 =  clean($_POST['Toggledivs1']);
	$travel =  clean($_POST['travel']);
	$impressions =  clean($_POST['impressions']);
	$specific_skills =  clean($_POST['specific_skills']);
	
	
	$vision =  clean($_POST['vision']);
	$understanding =  clean($_POST['understanding']);
	$benefit =  clean($_POST['benefit']);
	
	$member1 =  clean($_POST['member1']);
	$desg1 =  clean($_POST['desg1']);
	$email1 =  clean($_POST['email1']);
	
	$member2 =  clean($_POST['member2']);
	$desg2 =  clean($_POST['desg2']);
	$email2 =  clean($_POST['email2']);

	
	$program_select = mysql_query("SELECT category FROM category where cat_id='$program_id'");
	while($row = mysql_fetch_array($program_select))
	{
		$program = $row['category'];
	}
	
	// unique form id
	$idgenration = mysql_query("SELECT * FROM application ORDER BY id DESC LIMIT 0,1");
	while($user_id_gen = mysql_fetch_array($idgenration))
	{
		$unique_id = $user_id_gen['id'];
	}
	
	$unique_id_temp = $unique_id+'1';
	$formid = $isacid.$unique_id_temp;
	
	$fee = str_replace('$','',$program_cost);
	
	
	
	$firstinstall = '300';
 	$secondinstall = $fee - $firstinstall;

	$dateofregistration = date('d/m/Y - h:i:s A', time()+19800);
	
	
	//selecting the values of arrival i.e month and year 
	$query_arrival_division = mysql_query("SELECT * FROM  isac_arrival_table WHERE arrival_date_full = '$program_start_date'");
	while($row_arrival_d = mysql_fetch_array($query_arrival_division))
	{
		$arrival_year = $row_arrival_d['arrival_year'];
		$arrival_month = $row_arrival_d['arrival_month'];
	} 
	
	
	$qry_application = "INSERT INTO application(isacid,firstname,lastname,email,gender, program,user_type, program_id,formid,fee, 	
											arrival,duration,formdate, first_installment, second_installment, arrival_month,arrival_year, scholarship_status) 
								VALUES('$isacid', '$firstname','$lastname','$email', '$gender','$program', 'SCHOLARSHIP', '$program_id',
								'$formid','$fee','$program_start_date','$program_duration', '$dateofregistration', '$firstinstall','$secondinstall',
								 '$arrival_month','$arrival_year', 'PENDING')";
	$result = @mysql_query($qry_application);
	
	$qry_scholarship = "INSERT INTO scholarship_entry(isacid,formid,que_01,que_02,que_03, que_03a,que_03b, que_04,que_04a,que_04b, 	
											que_05,que_06,que_07, que_08, refer_name1, refer_designation1,refer_email1,
											refer_name2, refer_designation2,refer_email2) 
								VALUES('$isacid', '$formid','$fellowship','$believe', '$Toggledivs','$details_placement', 'summarize', '$Toggledivs1',
								'$travel','$impressions','$specific_skills','$vision', '$understanding', '$benefit','$member1',
								 '$desg1','$email1', '$member2','$desg2','$email2')";
	$result = @mysql_query($qry_scholarship);
	
	
	$msgTo = $email;
	$msgSubject = "ISAC Scholarship Submission";    
	$msgHeaders =  "From: ISAC <info@indiastudyabroad.org>"; // "To: $msgTo\r\n";
	$msgContent= "
		
	Dear $firstname, 

    We have received your scholarship application and our team is reviewing it. 

   We will get in touch with you shortly.

   Sincerely,

   Arunabha Pal
   India Study Abroad Center: www.indiastudyabroad.org
   Email: arunabha@indiastudyabroad.org";
	
	$msgHeaders .= "From: info@indiastudyabroad.org\r\n";
	$msgHeaders .= "X-Mailer: PHP".phpversion();
	
	$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
	
	
	$msgTo = 'info@indiastudyabroad.org, nadeer@fhexperience.co';
	$msgSubject = "ISAC Scholarship Submission";    
	$msgHeaders =  "From: ISAC <info@indiastudyabroad.org>"; // "To: $msgTo\r\n";
	$msgContent= "Hello ISAC Admin,

	$firstname have submitted Scholarship form
	
	Name - $firstname
	Email - $email
	
	Program Name - $program
	Duration - $program_duration
	FEE - $program_cost
	Program Start Date - $program_start_date.";
	
		
	$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
	
	
	 echo"
		<script type='text/javascript'>	
			window.location = '".SERVER_URL."student_panel_dashboard/'
		</script>";
		exit();
}

?>
