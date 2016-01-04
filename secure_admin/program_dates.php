<?php
session_start();

$admin_name = $_SESSION['SESS_FIRST_NAME'];
?>
<?php
	//require_once('auth.php');
?>
<?php 
    //Include database connection details
	require_once('config.php');
	
	//$group = $_POST["csi"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	

	?>



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
         <form name='logout' action='logout.php' method='post'> <input type="image" src="images/btn_logout.jpg" class="btn_apply" title="APPLY NOW"  /></form>
        </div>
      </div>
      <!-- Search Ends Here --> 
    </div>
    <!-- Top Header Ends Here --> 
    <!-- Navigation Starts Here --> 
 <div id="navigation">
              <ul>
        <li><a href="admin_dashboard.php" title="Individual Applications">Individual Applications</a></li>
        <li><a href="admin_dashboard_group.php" title="Group Applications ">Group Applications </a></li>
        <li><a href="calendar.php" title="Calendar">Calendar</a></li>
        <li><a href="admin_program.php" title="Programs">Programs</a></li>
        <li><a href="#" title="Discounts">Discounts</a></li>
        <li><a href="admin_currency.php" title="About">Currency</a>
          </li>

      </ul>
            </div> 
    <!-- Navigation Ends Here --> 
  </div>
  <!-- Top Head Ends Here --> 
  
</div>
<!-- Header Ends here --> 
<!-- Main contents Starts here -->
<div id="container"> 
  <!-- Theme Image --> 
  <!-- div class="theme">
<img src="images/theme_register.jpg" width="990" height="350" alt="Programs" title="Programs" /></div --> 
  <!-- Theme Image --> 
  <!-- Middle left section -->
  <div class="summary_form reg top_spacing">
  <div class="rht_tab">
  <ul>
  <li><a href="program_dates.php" title="Incomplete Applications">Add Program Duration</a></li>
  <li>|</li>
  <li><a href="program_arrival.php" title="Registered Applications">Add Arrival</a></li>
  </ul>
  </div>
    <h1>Welcome, <?php echo $admin_name?></h1>
    <table border="0" width="955" class="admin_tbl" cellspacing="0" cellpadding="0">
<form method="post" action="prog_dates_action.php" name="form_prog">
<tr>
<th width="159" style="text-align:center">Programs </th>
<th width="129" style="text-align:center">Enter Start week</th>
<th width="131" style="text-align:center">Enter End week</th>
<th width="165" style="text-align:center"> Enter Program cost </th>
<th width="212" style="text-align:center"> Enter additional week cost </th>
<th width="119" style="text-align:center" class="brn_n"> SUBMIT</th>

</tr>
<tr> 
<td> 
<select name="cat" class="grad">
<?php 
$sql_select_pr = "SELECT * FROM category ";
	$result_pr = mysqlquery($sql_select_pr);
	while($feach_info_pr = mysqli_fetch_array($result_pr))
	{
		$program_name_pr = $feach_info_pr['category'];
		$program_id_pr = $feach_info_pr['cat_id'];
	
?>  
<option value="<?php echo $program_id_pr; ?>"><?php echo $program_name_pr; ?></option>
<?php
	} // end  while
?>
</select>
 </td>
 <td><input type="text" name="start_week" size="3" /></td>
 
 <td><input type="text" name="end_week" size="3" /> </td>
 
 <td><input type="text" name="base_amount" size="3" /></td>
 
 <td><input type="text" name="difference_amount" size="3" /> </td>
   <td class="link brn_n"><input type="image" src="images/btn_submit.jpg" value="VIEW" />
</tr>
</form>


</table>
    <br />
    <br />
    <table border="0" width="955" class="admin_tbl" cellspacing="0" cellpadding="0">
<form method="post" action="prog_dates_action.php" name="form_prog">
<tr>
<th width="159" style="text-align:center">Programs </th>
<th width="129" style="text-align:center">Enter Start week</th>
<th width="131" style="text-align:center">Enter End week</th>
<th width="165" style="text-align:center">Enter base amount</th>
<th width="212" style="text-align:center">Enter difference amount</th>
<th width="119" style="text-align:center">EDIT</th>
<th width="119" style="text-align:center" class="brn_n">DELETE</th>

</tr>
<?php
	// selecting all values from table
	$query1=mysqlquery("SELECT * FROM isac_duration"); 
	while($duration_iz = mysqli_fetch_array($query1)) 
	{
		$program_id_iz = $duration_iz['program_id'];
		$start_week_iz = $duration_iz['start_week'];
		$end_week_iz = $duration_iz['end_week'];
		$base_amount_iz = $duration_iz['base_amount'];
		$difference_amount_iz = $duration_iz['difference_amount'];
// start select value of program name from program table	
$quer_sql1=mysqlquery("SELECT * FROM category WHERE cat_id = '$program_id_iz'"); 	
	while($arrival_pr = mysqli_fetch_array($quer_sql1)) 
	{
	?>
<tr> 
<td><?php echo $arrival_pr['category'];   ?></td>
 <td><?php echo $start_week_iz;   ?></td>
 
 <td><?php echo $end_week_iz;   ?></td>
 
 <td><?php echo $base_amount_iz;   ?></td>
 
 <td><?php echo $difference_amount_iz;   ?></td>
   <td>
   <a href="edit_program.php?val=<?php echo $arrival_pr['cat_id']; ?>"><input type="image" src="images/btn_edit.jpg" value="VIEW" /></a></td>
   
      <td class="link brn_n">  <a href="program_delete_action.php?val=<?php echo $arrival_pr['cat_id']; ?>"><input type="image" src="images/delete.png" value="DELETE" /></a></td>
</tr>
<?php
	}
	}// end
?>
</form>


</table>
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