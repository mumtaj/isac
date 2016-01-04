<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) 
    {
        global $link;
		$str = @trim($str);
		if ( get_magic_quotes_gpc() )  $str = stripslashes($str);
		return mysqli_real_escape_string($link, $str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if ( $login == '' ) 
    {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	
    if($password == '') 
    {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if ( $errflag ) 
    {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;

		session_write_close();
		header("location: admin_login.php");
		exit();
	}
	
	//Create query
	$qry = "SELECT * FROM admin WHERE login = '$login' AND passwd = '".md5($_POST['password'])."'";

    $result = $link->query($qry);
	
	//Check whether the query was successful or not
	if( $result ) 
    {
		if( $result->num_rows == 1 ) 
        {
			//echo "Login Successful!!";
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			
			$_SESSION['SESS_MEMBER_ID']  = $member['member_id'];
			$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			
			//$account_type Permission = 1 ==> 1 Full Access
			//$account_type Permission = 1 ==> 2 View Only
			$_SESSION['SESS_ADMIN_PERMISSIONS'] =  $member['permissions'];
			$_SESSION['SESS_ADMIN_TYPE'] = 'ISACADMIN11';
			$_SESSION['SET_PERMISSION'] = ($member['permissions'] == 1) ? 'FULLACCESS' : 'VIEWONLY';
			
			session_write_close();

			header("location: admin_index.php");
			exit();
		}
        else 
        {
			header("location: login-failed.php");
			exit();
		}
	}
    else 
    {
		die("Query failed");
	}
?>