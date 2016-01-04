<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		header("location: access-denied.php");
		exit();
	}
	elseif(!isset($_SESSION['SESS_USER_TYPE'])||(trim($_SESSION['SESS_USER_TYPE']) == '')) {
		header("location: access-denied.php");
		exit();
	}
?>