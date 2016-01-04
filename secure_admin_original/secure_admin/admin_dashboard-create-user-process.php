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
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	?>
    <?php
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	
	//Sanitize the POST values
	$firstname = clean($_POST["name"]);
	$usersname = clean($_POST["usersname"]);
	$email =clean($_POST["email"]);
	$password = clean($_POST["password"]);
	$account_type = clean($_POST["account_type"]);
	$createdate = date("Y-m-d H:i:s");
	
	// checking the user name AND Email
	$query_username_select = "SELECT * FROM admin WHERE login = '$usersname' OR email = '$email'";		
	$query_username_result = mysql_query($query_username_select); 	
	$query_username_count = mysql_num_rows($query_username_result);
	
	//if Already there  user name OR Email
	if($query_username_count > 0)
	{
		echo"
		<script type='text/javascript'>
			window.location = 'admin_dashboard-create-new-user.php?status=false'
		</script>";
	}
	else
	{
		//Create INSERT query
		//$account_type Permission = 1 ==> 1 Full Access
		//$account_type Permission = 1 ==> 2 View Only
		$qry = "INSERT INTO admin(firstname,login,passwd,email,permissions,createdate)
							 VALUES('$firstname','$usersname','".md5($password)."', '$email','$account_type','$createdate')";
		$result = @mysql_query($qry);
		
		//Check whether the query was successful or not
		if($result) {
			$msgTo = $email;
			$msgSubject = "ISAC Admin Dashboard registration confirmation";    
			//$msgHeaders = "To: $msgTo\r\n";
			$msgContent= "Hi $firstname,
			
			You have successfully registered on indiastudyabroad.org Admin Dashboard
			your account details are as follows
			
			Username - $usersname
			Password - $password
			
			Please retain these details in order to login to your Admin account.";
			$msgHeaders = "From: info@indiastudyabroad.org";
			//$msgHeaders .= "X-Mailer: PHP".phpversion();
			
			$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
			
			echo"
				<script type='text/javascript'>
					window.location = 'admin_dashboard-create-new-user.php?status=true'
				</script>";
			exit();
		}
		else {
			 die('Could not connect: ' . mysql_error());
		}
	}
?>