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
	$memberid = $_POST["memberid"];
	$firstname = clean($_POST["name"]);
	$usersname = clean($_POST["usersname"]);
	$email =clean($_POST["email"]);
	$password = clean($_POST["password"]);
	$account_type = clean($_POST["account_type"]);
	$createdate = date("Y-m-d H:i:s");
	
	// checking the user name AND Email
	$query_username_select = "SELECT * FROM admin WHERE login = '$usersname'";		
	$query_username_result = mysqlquery($query_username_select); 	
	$query_username_count = mysqlnumrows($query_username_result);
	
	//if Already there  user name OR Email
	if($query_username_count > 1)
	{
		echo"
		<script type='text/javascript'>
			window.location = 'admin_dashboard-manage-users.php?status=false'
		</script>";
	}
	else
	{
		//Create INSERT query
		//$account_type Permission = 1 ==> 1 Full Access
		//$account_type Permission = 1 ==> 2 View Only
		
		if($password == '')
		{
			$qry = "UPDATE admin SET firstname = '$firstname', login = '$usersname',
									 email = '$email', permissions = '$account_type' WHERE member_id = '$memberid'";
			$result = @mysqlquery($qry);
		
		}
		else
		{
			$qry = "UPDATE admin SET firstname = '$firstname', login = '$usersname', passwd = '".md5($password)."',
									 email = '$email', permissions = '$account_type' WHERE member_id = '$memberid'";
			$result = @mysqlquery($qry);
		}
		
		//Check whether the query was successful or not
		if($result) {
			echo"
				<script type='text/javascript'>
					window.location = 'admin_dashboard-manage-users.php?status=true'
				</script>";
			exit();
		}
		else {
			 die('Could not connect: ' . mysql_error());
		}
	}
?>