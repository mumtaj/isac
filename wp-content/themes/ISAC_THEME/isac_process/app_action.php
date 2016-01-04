<?php session_start();
	
	
	//Include database connection details
	require_once('../config/config.php');
	
	
	$isacid = $_SESSION['SESS_MEMBER_ID']; 
	
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	$program_temp = clean($_POST['programs']);
	$duration = clean($_POST['duration']);
	$arrival = clean($_POST['program_start_date']);
	$program_cost = clean($_POST['fees']);
	$isacid = clean($_POST['isacid']);
	
	
	$idgenration = mysql_query("SELECT * FROM application ORDER BY id DESC LIMIT 0,1");
	while($user_id_gen = mysql_fetch_array($idgenration))
	{
		$unique_id = $user_id_gen['id'];
	}
	$unique_id_temp = $unique_id+'1';
	$formid = $isacid.$unique_id_temp;
	
	
	$program_select = mysql_query("SELECT category FROM category where cat_id='$program_temp' ORDER BY cat_id DESC LIMIT 0,1");
	while($row = mysql_fetch_array($program_select))
	{
		$program = $row['category'];
	}
	
	//current date 
	$currentdate = date("d/m/y");
	// cost break for the program
	$fee = str_replace('$','',$program_cost);
	$firstinstall = '300';
	$secondinstall = $fee-$firstinstall;
	 
	$reg_query = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");
	while ($row1 = mysql_fetch_array($reg_query))
	{
		$name = $row1['firstname'];
		$lname = $row1['lastname'];
		$email = $row1['email'];
		$gender = $row1['gender'];
		$contact_home = $row1['phone_number'];
		$contact_cell = $row1['phone_mobile'];
		$skype = $row1['skype'];
		$address = $row1['address'];
		$zip = $row1['zip'];
		$city = $row1['city'];
		$state = $row1['state'];
		$country = $row1['country'];
}
	
	$qry = "INSERT INTO application(isacid,firstname, lastname, email, gender, program,formid,fee,program_id, arrival,duration,formdate,first_installment,second_installment) VALUES('$isacid', '$name', '$lname', '$email', '$gender', '$program','$formid','$fee', '$program_temp', '$arrival','$duration','$currentdate','$firstinstall','$secondinstall')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) { 
	echo "  <script type='text/javascript'>";
		echo "window.location = '".SERVER_URL."summary_application?formid=$formid'";
	echo "</script> "  ;
	}
	
	else {
	 die('Could not connect: ' . mysql_error());
	}
?>