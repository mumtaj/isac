<?php
	ini_set('display_errors','0');
	
	define('DB_HOST', 'localhost');
    define('DB_USER', 'india_isac');
    define('DB_PASSWORD', 'redigital@123');
    define('DB_DATABASE', 'india_isacnew');
	define('SERVER_URL', 'http://indiastudyabroad.org/');
	
	define('payment_gateway_secret_key', 'b2796474414fd1d55d33055ac7f8a9ae');
	define('payment_gateway_account_id', '5293');
	define('payment_gateway_mode', 'LIVE'); //TEST
	
	define('NEWSLETTER_EMAIL_ID', 'baleshbhatt@gmail.com'); 
	
	define('TEMPLATE_URL', 'http://indiastudyabroad.org/wp-content/themes/ISAC_THEME/'); 
	
	//require_once('auth.php');

	
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
	
?>