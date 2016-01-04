<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once("../config/config.php");
	
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
	$login = $_POST['login'];
	$password = $_POST['password'];
	$_SESSION['login_err']=$login;// login fail session
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
		header("location: ".SERVER_URL."login-fail");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM registration WHERE email='$login' AND password='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['isacid'];
			$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
			
			
			if($member['group_isac']=='GROUP')
			{
				$_SESSION['SESS_MEMBER_GROUP_TYPE'] = $member['group_isac'];

				$_SESSION['SESS_USER_TYPE'] = 'ISACGROUP11';
				
				session_write_close();
				header("location: ".SERVER_URL."Student_Panel_Dashboard_group");
			}
			else if($member['partner_isac']=='PARTNER')
			{
				$_SESSION['SESS_MEMBER_PARTNER_ID'] = $member['partner_id_isac'];    //ADDED for creating GROUP  ID SESSION
				$_SESSION['SESS_MEMBER_PARTNER_TYPE'] = $member['partner_isac'];
				$_SESSION['SESS_MEMBER_PARTNER_NAME'] = $member['isac_partnername'];
				
				$_SESSION['SESS_USER_TYPE'] = 'ISACPARTNER11';
				
				session_write_close();
				header("location: ".SERVER_URL."Student_Panel_Dashboard_partner");
			}
			else if($member['scholarship_status']!= '')
			{
				$_SESSION['SESS_USER_TYPE'] = 'STUDENT';
				
				session_write_close();
				header("location: ".SERVER_URL."Student_Panel_Dashboard");
			}
			
			else
			{
				$_SESSION['SESS_USER_TYPE'] = 'ISACUSER11';
				
				session_write_close();
			header("location: ".SERVER_URL."Student_Panel_Dashboard");
			}
			exit();
		}else {
			//Login failed
		header("location: ".SERVER_URL."login-fail");
			exit();
		}
	}else {
		die("Query failed");
	}
?>