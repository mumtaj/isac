<?php
	header ("location: ".$_POST['currentpage_name']."?action=del");

	require_once('config.php');
	require_once('auth.php');
	
	$errmsg_arr = array();
	$errflag = false;

    function clean($str) 
    {
		$str = @trim($str);
		if ( get_magic_quotes_gpc() ) $str = stripslashes($str);
		return mysql_real_escape_string($str);
	}
	
 	$applicationid = $_POST['applicationid']; 
	
    $sql1 = "UPDATE application SET delete_flag  = 1 WHERE formid = '$applicationid' ";
    $result = @mysqlquery($sql1);

?>