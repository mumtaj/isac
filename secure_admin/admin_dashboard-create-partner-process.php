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
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	
	//Sanitize the POST values
	$partnername = clean($_POST['partnername']);
	$leadername = clean($_POST['leadername']);
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	$details = clean($_POST['details']);

	// checking the user name AND Email
	$query_partner_select = "SELECT * FROM registration WHERE email = '$email' OR isac_partnername = '$partnername'";		
	$query_partner_result = mysqlquery($query_partner_select); 	
	$query_partner_count = mysqlnumrows($query_partner_result);
	
	
	$query1 = mysqlquery("SELECT * FROM registration ORDER BY id DESC LIMIT 0,1");
	while($row = mysqli_fetch_array($query1))
	{
		$a = $row['id'];
	}
	$c = $a + '1';
	$isacid='ISAC'.$c;
	$partnerid = 'PART_ISAC'.$c;
	
	$dateofregistration = date('d/m/Y - h:i:s A', time()+19800);
	
	//if Already there  user name OR Email
	if($query_partner_count > 0)
	{
		echo"
		<script type='text/javascript'>
			window.location = 'admin_dashboard-create-new-partner.php?status=false'
		</script>";
	}
	else
	{
		//Create INSERT query
		$qry = "INSERT INTO registration(isacid, firstname, email, password, dateofregistration, 
											isac_partnername, partner_isac, partner_id_isac, partner_details) 
					VALUES('$isacid','$leadername', '$email','".md5($password)."','$dateofregistration', 
											'$partnername',  'PARTNER', '$partnerid', '$details')";
		$result = @mysqlquery($qry);
		
	
		//Check whether the query was successful or not
		if($result) {
			$msgTo = $email;
			$msgSubject = "ISAC Admin Dashboard Partner registration confirmation";    
			//$msgHeaders = "To: $msgTo\r\n";
			$msgContent= "Hi $leadername,
			
			You have successfully registered on indiastudyabroad.org Admin Dashboard
			your account details are as follows
			
			Username - $email
			Password - $password
			
			Please retain these details in order to login to your Admin account.";
			$msgHeaders = "From: info@indiastudyabroad.org";
			//$msgHeaders .= "X-Mailer: PHP".phpversion();
			
			$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
			
			echo"
				<script type='text/javascript'>
					window.location = 'admin_dashboard-create-new-partner.php?status=true'
				</script>";
			exit();
		}
		else {
			 die('Could not connect: ' . mysql_error());
		}
	}
?>