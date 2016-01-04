<?php
session_start();

$admin_name = $_SESSION['SESS_FIRST_NAME'];
?>
<?php
	require_once('auth.php');
?>
<?php 
    //Include database connection details
	require_once('config.php');
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
 if($_POST['doSearch']==1) {
 //query database
 $program_id = $_POST['prog'];
 $arrival_date = $_POST['arrival'];
 $week =  $_POST['week'];
 $month =  $_POST['month'];
 $year =  $_POST['year'];
 //get results// 
 // search query 1 for all terms 
if($program_id =='0000' && $arrival_date =='0000' && $week =='0000' && $month =='0000' && $year =='0000')
 {
	 $query_all = "SELECT * FROM application ORDER BY id DESC";
	 $query_all_stu = "SELECT COUNT(*) as num FROM application ORDER BY id DESC";
	  $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE gender='Female' ORDER BY id DESC";
	   $query_all_m = "SELECT COUNT(*) as num FROM application WHERE gender='Male' ORDER BY id DESC";

 } 
 elseif($program_id !='0000' && $arrival_date =='0000' && $week =='0000' && $month =='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND gender='Male' ORDER BY id DESC ";
 }
 elseif($program_id !='0000' && $arrival_date !='0000' && $week =='0000' && $month =='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND gender='Male' ORDER BY id DESC ";
 }
 elseif($program_id !='0000' && $arrival_date !='0000' && $week !='0000' && $month =='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%'  ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND gender='Male' ORDER BY id DESC ";
 }
 elseif($program_id !='0000' && $arrival_date !='0000' && $week !='0000' && $month !='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%'  ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Male' ORDER BY id DESC ";
 }
 elseif($program_id !='0000' && $arrival_date !='0000' && $week !='0000' && $month !='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
// if all querys are matching in the database 
// query for calculating total number of students
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  // query for count female
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	// count males
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id !='0000' && $arrival_date =='0000' && $week !='0000' && $month =='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' AND gender='Male' ORDER BY id DESC ";
 }
 elseif($program_id !='0000' && $arrival_date =='0000' && $week !='0000' && $month !='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Male' ORDER BY id DESC ";
 }
  elseif($program_id !='0000' && $arrival_date =='0000' && $week !='0000' && $month !='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%'  AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id !='0000' && $arrival_date =='0000' && $week =='0000' && $month !='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$month%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$month%' ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$month%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$month%' AND gender='Male' ORDER BY id DESC ";
 }
elseif($program_id !='0000' && $arrival_date =='0000' && $week =='0000' && $month !='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id !='0000' && $arrival_date =='0000' && $week =='0000' && $month =='0000' && $year !='0000')
 {
	
$query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%'  AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND arrival LIKE '%$year%' ORDER BY id DESC";
$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id !='0000' && $arrival_date !='0000' && $week =='0000' && $month !='0000' && $year =='0000')
 {
  $query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id !='0000' && $arrival_date !='0000' && $week =='0000' && $month !='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
  elseif($program_id !='0000' && $arrival_date !='0000' && $week !='0000' && $month =='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND arrival LIKE '%$arrival_date%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id !='0000' && $arrival_date =='0000' && $week !='0000' && $month =='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
  elseif($program_id !='0000' && $arrival_date !='0000' && $week =='0000' && $month =='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%'  AND arrival LIKE '%$arrival_date%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE program LIKE '%$program_id%' AND arrival LIKE '%$arrival_date%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id =='0000' && $arrival_date !='0000' && $week =='0000' && $month =='0000' && $year =='0000')
 {
  $query_all = "SELECT * FROM application WHERE arrival LIKE '%$arrival_date%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE arrival LIKE '%$arrival_date%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE arrival LIKE '%$arrival_date%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE arrival LIKE '%$arrival_date%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id =='0000' && $arrival_date !='0000' && $week !='0000' && $month =='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%'  ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND gender='Male' ORDER BY id DESC ";
 }
 elseif($program_id =='0000' && $arrival_date !='0000' && $week !='0000' && $month !='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%'  ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Male' ORDER BY id DESC ";
 }
 elseif($program_id =='0000' && $arrival_date !='0000' && $week !='0000' && $month !='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";

  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }


 elseif($program_id =='0000' && $arrival_date !='0000' && $week =='0000' && $month !='0000' && $year =='0000')
 {
  $query_all = "SELECT * FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id =='0000' && $arrival_date !='0000' && $week =='0000' && $month !='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
  elseif($program_id =='0000' && $arrival_date !='0000' && $week !='0000' && $month =='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE  arrival LIKE '%$arrival_date%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
   elseif($program_id =='0000' && $arrival_date !='0000' && $week =='0000' && $month =='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%'  AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE  arrival LIKE '%$arrival_date%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }

 elseif($program_id =='0000' && $arrival_date =='0000' && $week !='0000' && $month =='0000' && $year =='0000')
 {
  $query_all = "SELECT * FROM application WHERE duration LIKE '%$week%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE duration LIKE '%$week%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE duration LIKE '%$week%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE duration LIKE '%$week%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id =='0000' && $arrival_date == '0000' && $week !='0000' && $month !='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%'  ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Male' ORDER BY id DESC ";
 }
 elseif($program_id =='0000' && $arrival_date == '0000' && $week !='0000' && $month !='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE  duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";

    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";

	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }


  elseif($program_id =='0000' && $arrival_date == '0000' && $week !='0000' && $month =='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id =='0000' && $arrival_date =='0000' && $week !='0000' && $month !='0000' && $year =='0000')
 {
	$query_all = "SELECT * FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' ORDER BY id DESC "; 
	$query_all_stu = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%'  ORDER BY id DESC ";
	$query_all_fm = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Female' ORDER BY id DESC ";
	$query_all_m = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND gender='Male' ORDER BY id DESC ";
 }
 elseif($program_id =='0000' && $arrival_date =='0000' && $week !='0000' && $month !='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";

  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 
 
  elseif($program_id =='0000' && $arrival_date =='0000' && $week !='0000' && $month =='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE   duration LIKE '%$week%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id =='0000' && $arrival_date =='0000' && $week =='0000' && $month !='0000' && $year =='0000')
 {
 $query_all = "SELECT * FROM application WHERE arrival LIKE '%$month%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE arrival LIKE '%$month%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE arrival LIKE '%$month%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE arrival LIKE '%$month%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id =='0000' && $arrival_date =='0000' && $week =='0000' && $month !='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE   arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";

  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE   arrival LIKE '%$month%' AND arrival LIKE '%$year%' ORDER BY id DESC";
    $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE   arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE   arrival LIKE '%$month%' AND arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
 elseif($program_id =='0000' && $arrival_date =='0000' && $week =='0000' && $month =='0000' && $year !='0000')
 {
  $query_all = "SELECT * FROM application WHERE arrival LIKE '%$year%' ORDER BY id DESC";
  $query_all_stu = "SELECT COUNT(*) as num FROM application WHERE arrival LIKE '%$year%' ORDER BY id DESC";
     $query_all_fm = "SELECT COUNT(*) as num FROM application WHERE arrival LIKE '%$year%' AND gender='Female' ORDER BY id DESC";
	    $query_all_m = "SELECT COUNT(*) as num FROM application WHERE arrival LIKE '%$year%' AND gender='Male' ORDER BY id DESC";
 }
else
{
	//$query_all = "SELECT * FROM application ";
}
 }// end do search query ?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/test.js"></script>
</head>
<body>
<!-- Wrapper Starts here -->
<div id="wrapper"> 
  <!-- Header Starts here -->
  <div class="header"> 
    <!-- Top Head Starts Here -->
    <div class="topH"> 
      <!-- Top Header starts Here -->
      <div class="top_header"> 
        <!-- Logo Starts Here -->
        <div class="logo"><img src="images/logo.jpg" alt="INDIA STUDY ABROAD CENTER (Volunteer &amp; Interm with ISAC, the India Specialists)" width="488" height="76" border="0" /></div>
        <!-- Logo Ends Here --> 
        <!-- Search Starts Here -->
        <div id="search">
               
<form name='logout' action='logout.php' method='post'>    
  <input type='image' src='images/btn_logout.jpg' class='btn_apply' title='LOGOUT'  /></form>
<a href="admin_index.php"><img src="images/btn_dashboard.jpg" alt="Admin" width="150" height="26" border="0" class='btn_apply11' /></a>

       
                </div>
      </div>
      <!-- Search Ends Here --> 
    </div>
    <!-- Top Header Ends Here --> 
    <!-- Navigation Starts Here --> 
 <div id="navigation"> </div> 
    <!-- Navigation Ends Here --> 
  </div>
  <!-- Top Head Ends Here --> 
  
</div>
<!-- Header Ends here --> 
<!-- Main contents Starts here -->
<div id="container_cl"> 
 

  <div class="summary_form reg top_spacing">
  <form method="post" action="calendar.php" name="form_prog">
  <table width="1157" class="admin_tbl" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="353"><strong>Program</strong></td>
    <td width="200"><strong>Arrival</strong></td>
    <td width="134"><strong>week </strong></td>
    <td width="110"><strong>month</strong></td>
    <td ><strong>year</strong></td>
    <td class="brn_n">&nbsp;</td>
    </tr>
   <tr>
    <td> <?php
$quer1=mysql_query("SELECT * FROM category WHERE publish='1'"); 
//////////        Starting of first drop downlist /////////
echo "<select name='prog' class='grad1'>";
echo "<option selected='selected' value='00000'>--SELECT--</option>";
while($prognm = mysql_fetch_array($quer1)) { 
echo "<option value='$prognm[category]'>$prognm[category]</option>"."<BR>";
}
echo "</select>";
// selected vale for program

?></td>
    <td> <?php
$quer2=mysql_query("SELECT  DISTINCT * FROM isac_arrival_table GROUP BY arrival_date_full ORDER BY arrival_date_full ASC"); 
//////////        Starting of first drop downlist /////////
echo "<select name='arrival' class='grad1'>";
echo "<option selected='selected' value='00000'>--SELECT--</option>";
while($prog_arrival = mysql_fetch_array($quer2)) { 
echo "<option value='$prog_arrival[arrival_date_full]'>$prog_arrival[arrival_date_full]</option>"."<BR>";
}
echo "</select>";
// selected vale for program

?></td>
    <td>
    <select name="week" id="week" class='grad1' >
    <option value="0000" selected="selected">-SELECT-</option> 
<option value="1">1</option> 
<option value="2">2</option> 
<option value="3">3</option> 
<option value="4">4</option> 
<option value="5">5</option> 
<option value="6">6</option> 
<option value="7">7</option> 
<option value="8">8</option> 
<option value="9">9</option> 
<option value="10">10</option> 
<option value="11">11</option> 
<option value="12">12</option> 
<option value="13">13</option> 
<option value="14">14</option> 
<option value="15">15</option> 
<option value="16">16</option> 
<option value="17">17</option> 
<option value="18">18</option> 
<option value="19">19</option> 
<option value="20">20</option> 
<option value="21">21</option> 
<option value="22">22</option> 
<option value="23">23</option> 
<option value="24">24</option> 
<option value="25">25</option> 
<option value="26">26</option> 
<option value="27">27</option> 
<option value="28">28</option> 
</select></td>
    <td><select name="month" id="month" class='grad1' >
     <option value="0000" selected="selected">-SELECT-</option> 
<option value="January">January</option> 
<option value="February">February</option> 
<option value="March">March</option> 
<option value="April">April</option> 
<option value="May">May</option> 
<option value="June">June</option> 
<option value="July">July</option> 
<option value="August">August</option> 
<option value="September">September</option> 
<option value="October">October</option> 
<option value="November">November</option> 
<option value="December">December</option> 
</select></td>
    <td width="110" ><select name="year" id="year" class='grad1'>
     <option value="0000" selected="selected">-SELECT-</option> 
<option value="2012">2012</option> 
<option value="2013">2013</option>
<option value="2014">2014</option> 
<option value="2015">2015</option> 
<option value="2016">2016</option> 
<option value="2017">2017</option> 
</select>
<input type="hidden" name="doSearch" value="1"> <!-- if searhed show result  -->
</td>
    <td width="75" class="brn_n"><input type="image" src="images/btn_submit.jpg" value="VIEW" /></td>
    </tr>
</table>
 </form> 
 
 <?php if($_POST['doSearch']) { //a search request was made display my search results ?>
<?php

$sql11_na = mysql_query("SELECT * FROM category WHERE category LIKE '%$program_id%'");
while($result_na_pr = mysql_fetch_array($sql11_na))
{

$name_cat_nr = $result_na_pr['category'];
	
};
// creating sesions for selected result output
 $_SESSION['$query_all'] = $query_all ; // creating session for query
//$_SESSION['$arrival_date'] = $arrival_date_session ;
//$_SESSION['$week'] = $week_session;
//$_SESSION['$month'] = $month_session ;
//$_SESSION['$year'] = $year_session;
//end sessions
?>
   <table width="1160" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
      <tr>
        <th height="29" style="text-align:center">Selection :</th>
        <th height="29" colspan="3" style="text-align:center"><?php 
		if($name_cat_nr=='')
		{
			echo '-';
		}
		else
		{
		echo $name_cat_nr;
		}
		 ?></th>
        <th style="text-align:center" ><?php
		if($arrival_date=='0000')
		{
			echo '-';
		}
		else
		{
		 echo $arrival_date; 
		}
		 ?></th>
        <th style="text-align:center" ><?php
		if($week=='0000')
		{
			echo '-';
		}
		else
		{
		echo $week;
		}
		 ?></th>
        <th style="text-align:center" ><?php
		if($month=='0000')
		{
			echo '-';
		}
		else
		{
		echo $month; 
		}
		 ?></th>
        <th style="text-align:center"><?php
		if($year=='0000')
		{
			echo '-';
		}
		else
		{
		 echo $year; 
		}
		 ?></th>
        <th class="brn_n" style="text-align:center">&nbsp;</th>
      </tr>
      <tr>
        <td height="29" colspan="9" style="text-align:center" class="brn_n">&nbsp;</td>
      </tr>
      <tr>
        <th width="81" style="text-align:center">ISAC id</th> 
        <th width="83" height="29" style="text-align:center">Group ID</th>
       
       
        <th width="105" style="text-align:center">First Name</th>
        <th width="133" style="text-align:center" >Last Name</th>
         <th width="98" style="text-align:center">Gender</th>
        <th width="185" style="text-align:center" >Email</th>
        <th width="209" style="text-align:center" >Program</th>
        <th width="133" style="text-align:center">Duration</th>
        <th width="131" class="brn_n" style="text-align:center">Program Date</th>
      </tr>
     <?php 
$quer_display=mysql_query($query_all);

  while($prog_display = mysql_fetch_array($quer_display)) {  ?>
 
      <tr>
          <td><?php echo $prog_display['isacid']; ?></td>
        <td><?php echo $prog_display['group_id']; ?></td>
      
      
        <td><?php echo $prog_display['firstname']; ?></td>
        <td ><?php echo $prog_display['lastname']; ?></td>
          <td><?php echo $prog_display['gender']; ?></td>
        <td><?php echo $prog_display['email']; ?></td>
        <td ><?php echo $prog_display['program']; ?></td>
        <td >
			<?php 
			
			$prog_duration = explode(" ",$prog_display['duration']); // Removing Old Records "Weeks" text	
				
				if($prog_duration[0] == 1)
					echo $prog_duration[0].' Week';
				else
					echo $prog_duration[0].' Weeks'; 
			?>
        </td>
        <td class="brn_n" ><?php echo $prog_display['arrival']; ?></td>
      </tr>
      <?php
	    } // end while loop
	  ?>
    </table>

<table width="600" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
  <tr>
    <td colspan="2" class="brn_n"><strong>SEARCH RESULT</strong></td>
    </tr>
  <tr>
    <td width="261">TOTAL STUDENTS :</td>
    <td width="337" class="brn_n">	<?php 
	
	$total_stu = mysql_fetch_array(mysql_query($query_all_stu));

	echo $total_st_dis = $total_stu[num]; 
	?>
	</td>
  </tr>
  <tr>
    <td>MALE:</td>
    <td class="brn_n"><?php $total_stu_m = mysql_fetch_array(mysql_query($query_all_m));

	echo $total_st_dis_m = $total_stu_m[num]; 
	?></td>
  </tr>
  <tr>
    <td>FEMALE:</td>
    <td class="brn_n"><?php $total_stu_fm = mysql_fetch_array(mysql_query($query_all_fm));

	echo $total_st_dis_fm = $total_stu_fm[num]; 
	?></td>
  </tr>
  <tr>
    <td>DOWNLOAD EXCEL (Result)</td>
    <td class="brn_n"><a href="download_result.php" target="_blank">DOWNLOAD EXCEL </a></td>
  </tr>
   <tr>
    <td>DOWNLOAD EXCEL (Full database )</td>
    <td class="brn_n"><a href="download_all.php" target="_blank">DOWNLOAD EXCEL </a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="brn_n">&nbsp;</td>
  </tr>
</table>
<?php

 } ?> 
    <div> </div>
    <!-- middle box ends here --> 
  </div>
  <!-- Middle left section --> 
  <!-- Middle right section --> 
  
  <!-- Middle right section --> 
  <!-- Main contents Ends here -->
  <div class="clear"></div>
</div>

<!-- Wrapper Ends here -->

</body>
</html>