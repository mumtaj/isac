<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('../config/config.php');
	
?>
    <?php
	
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	//Sanitize the POST values
$flightname = clean($_POST["name"]);
$fno = clean($_POST["fno"]);
$date =clean($_POST["date"]);
$month = clean($_POST["month"]);
$year = clean($_POST["year"]);
$time = clean($_POST['time']);
$ampm = clean($_POST['ampm']);
$formid = clean($_POST['formid']);
$comments = clean($_POST['comment']);
$arrivingfrom = clean($_POST['arrivingfrom']);
$arrival_details = clean($_POST['arrival_details']);
// selecting the values
$sql = mysql_query("SELECT * FROM application WHERE formid = '$formid'");
	while($row = mysql_fetch_array($sql))
	{
		$firstname = ucfirst($row['firstname']);
		$email = $row['email'];
		$program = $row['program'];
		$duration = $row['duration'];
		$arrival = $row['arrival'];
		$group_id = $row['group_id'];
		$sex_prefix = ($row['arrival'] == 'Female') ? 'her' : 'his';
	}

//Create INSERT query
$qry = "INSERT INTO arrival_flight(formid,student_name,	group_id,airline_name,flight_num,arrival_day,arrival_month,arrival_year,arrival_time,arrival_time1,commnets,arrival_info) VALUES('$formid','$firstname','$group_id','$flightname','$fno','$date','$month','$year','$time','$ampm','$arrivingfrom','$arrival_details')";
	$result = @mysql_query($qry);
	
	
	// unique form id
	

	$arriaval_date = $date.'/'.$month.'/'.$year;
	
	
	
	//$msgTo ='info@indiastudyabroad.org';
	$msgTo ='info@indiastudyabroad.org';
	
	$msgSubject = "ISAC Flight Tickets Booked.";
	$msgContent= "Dear ISAC Admin,
	
	$firstname has entered $sex_prefix flight details. Please check below details.
		
	Student Name - $firstname
	Email - $email
	Program - $program
	Duration - $duration Weeks
	Program Start Date - $arrival
	
	
	Flight Name - $flightname
	Flight Number - $fno
	Flight Time - $time $ampm
	Arrival Date - $arriaval_date
	Arriving from - $arrivingfrom
	Terminal no - $arrival_details";
	
	$msgHeaders = "From: ISAC <info@indiastudyabroad.org>";
	//$msgHeaders .= "X-Mailer: PHP".phpversion();
	
	$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
	
	
	//Check whether the query was successful or not
	if($result) {
		echo "<script type='text/javascript'>";
			echo "window.location = '".SERVER_URL."my-isac'";
		echo "</script> ";
		
		exit();
	}else {
		 die('Sorry! There was an error occured while updating your flight details. Please try again later.');
	}
?>