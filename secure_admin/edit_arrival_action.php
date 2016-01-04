<?php
$ar_id1 =$_POST['ar_id']; 
header ("location: program_arrival.php?pid=$ar_id1");

require_once('config.php');
	
	// auth for the user 
	
	require_once('auth.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	$ar_id =$_POST['ar_id']; // id for the program fo no error two var for updating
    $ar_up_dt = $ar_day."-".$ar_mo."-".$ar_yr; // updating value according to privious date
	 $arrival_id_update = $_POST['sno1'];
	
	 $day = $_POST['day1'];
	
	 $month = $_POST['month1'];
		
	$year = $_POST['year1'];
	
	$full_date = $day."-".$month."-".$year;
// for update or delete action : identifying the type of button
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //something posted

    if (isset($_POST['UPDATE'])) {	
	
	mysqlquery ("UPDATE isac_arrival_table SET arrival_date='$day', arrival_month='$month', arrival_year='$year', arrival_date_full='$full_date' WHERE sno='$arrival_id_update'");
	 
	
        // update button
    } else {
		
	mysqlquery ("DELETE FROM isac_arrival_table WHERE sno='$arrival_id_update'");
		// delete 
    }
}
?>
