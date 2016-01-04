<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
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
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: admin_login.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM admin WHERE login='$login' AND passwd='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			
			$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			
			//$account_type Permission = 1 ==> 1 Full Access
			//$account_type Permission = 1 ==> 2 View Only
			$_SESSION['SESS_ADMIN_PERMISSIONS'] =  $member['permissions'];
			$_SESSION['SESS_ADMIN_TYPE'] = 'ISACADMIN11';


			//GETTING Admin User Permission Thing
			$userid = $member['member_id'];
			$sql = "SELECT * FROM admin WHERE member_id = '$userid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			
			if($row['permissions'] == 1)
				$user_permission = 'FULLACCESS';	//1
			else
				$user_permission = 'VIEWONLY';//2

			$_SESSION['SET_PERMISSION'] = $user_permission;
			
			session_write_close();
			header("location: admin_index.php");
			exit();
		}else {
			//Login failed
			header("location: login-failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>