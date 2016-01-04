<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_ADMIN_TYPE']) || (trim($_SESSION['SESS_ADMIN_TYPE']) == '')) {
		header("location: access-denied.php");
		exit();
	}
?>