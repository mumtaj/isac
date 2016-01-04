<?php
    session_start();

    $admin_name = $_SESSION['SESS_FIRST_NAME'];

	require_once('auth.php');
    //Include database connection details
	require_once('config.php');
	
	//$group = $_POST["csi"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	

$upload_var = $_POST['editor1'];
$upload_var1 = $_POST['editor2'];

if($upload_var=='')
{
$content_upload = $upload_var1;
	$type = 'acc_footer';
}
else if($upload_var1=='')
{
	$content_upload = $upload_var;
	$type = 'acc_top';
}
else
{
	
}
$date_current = date("F j, Y");

$sql = "UPDATE mailer SET content = '$content_upload', date_modified = '$date_current' WHERE type='$type'";

$result = mysqlquery($sql,$link);
if($result)
{
header('LOCATION:admin_edit_exceptance.php');
}
?>

