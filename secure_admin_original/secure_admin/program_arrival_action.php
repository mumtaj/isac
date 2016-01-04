<?php
$prog_id = $_POST['prog'];
header("location: program_arrival.php?pid=$prog_id");
?>
<?php 
    //Include database connection details
	require_once('config.php');
	require_once('auth.php');
		
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

	
	
	?>   
    <?php
	 $prog_id = clean($_POST['prog']);
	 $day = clean($_POST['day']);
	 $month = clean($_POST['month']);
	 $year = clean($_POST['year']);
	 
	 $arrival_full =$day.'-'.$month.'-'.$year;
	
	$qry = "INSERT INTO  isac_arrival_table(program_id,arrival_date,arrival_month,arrival_year,arrival_date_full) VALUES ('$prog_id','$day','$month','$year','$arrival_full')";
    $result = @mysql_query($qry);
	//Check whether the query was successful or not
	if($result) {
		
		
	}else {
		 die('Could not connect: ' . mysql_error());
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>