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
	
	//$group = $_POST["csi"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
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
$sch_sql = "SELECT * FROM scholarship";
$sch_result = mysql_query($sch_sql);
$sch_row = mysql_fetch_array($sch_result);
$scholarship_status = $sch_row['scholarship_status'];
// end new pagination
if($scholarship_status=='1')
{	
$scholarship_status1='ON';	
$action = 'ACTIVE';
}
else
{
$scholarship_status1='OFF';
$action = 'INACTIVE';	
}
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
               
<form name='logout' action='logout.php' method='post'>    
  <input type='image' src='images/btn_logout.jpg' class='btn_apply' title='LOGOUT'  /></form>
<a href="admin_index.php"><img src="images/btn_dashboard.jpg" alt="Admin" width="150" height="26" border="0" class='btn_apply11' /></a>

       
                </div>
      </div>
      <!-- Search Ends Here --> 
    </div>
    <!-- Top Header Ends Here --> 
    <!-- Navigation Starts Here --> 
 <div id="navigation">
              <ul>
             <li><a href="admin_program.php" title="">Programs Home</a></li> 
        <li><a href="admin_program_create.php" title="">Create Programs</a></li>
        <li><a href="program_arrival.php" title="">Manage Program Dates</a></li>
        <li><a href="admin_scholarship.php" title=""  class="navigation1">Manage scholarship</a></li>
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
    <h1>Welcome, <?php echo $admin_name?></h1>
    <table width="627" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
      <tr>
        <th width="185" style="text-align:center">Current status</th>
        <th width="200" style="text-align:center">Change status</th>
     
        
        <th width="241" class="brn_n" style="text-align:center">Submit</th>
      </tr>
      
      <tr>
        <td><?php echo $action;?></td>
       
       
      
    
      <form action="change_scholarship.php" method="post">
        <td><select name="change">
     <option value="<?php echo $scholarship_status;  ?>" ><?php echo $scholarship_status1; ?></option>   
   <option value="1" >ON</option>
   <option value="0" >OFF</option>
        
        </select></td>
        <td class="link brn_n"><input type="image" src="images/btn_submit.jpg" value="VIEW" />
        </form>
      </tr>
     
    </table>
    <br />
    <br />
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