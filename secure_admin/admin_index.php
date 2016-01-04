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
	require_once('auth.php');
	
	//$group = $_POST["csi"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
//$tbl_name="category";	
// How many adjacent pages should be shown on each side?
//$sql = "SELECT * FROM $tbl_name  ";
	//$result = mysqlquery($sql);
	

// end new pagination
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />

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

  <div class="main_program">
   <div class="main_program_inside">
     <div class="main_program_inside">
     <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
            	<table width="758" height="112" border="0" align="center" cellpadding="0" cellspacing="0" class="admin_tbl">
    
  <tr>  
 <td><a href="admin_dashboard-incomplete-applications.php"><img src="images/admin_dashboard_useraccounts.png"  /></a></td>
 <td ><a href="admin_program.php"><img src="images/admin_dashboard_05.png" /></a></td>
        <td><a href="calendar.php"><img src="images/admin_dashboard_calendar.png"  /></a>   
   
        </td>
        </tr>
        <tr>  
 <td><a href="admin_currency.php"><img src="images/admin_dashboard_15.png"  /></a></td>
        <td><a href="admin_dashboard-create-new-user.php"><img src="images/admin_dashboard_settings.png" /></a>   
   
        </td>
        <td  class="link brn_n">&nbsp;</td>
        </tr>
   </table>
            <?php	
		}
		else
		{
			?>
            <table width="758" height="112" border="0" align="center" cellpadding="0" cellspacing="0" class="admin_tbl">
    
  <tr>  
 <td><a href="admin_dashboard-incomplete-applications.php"><img src="images/admin_dashboard_useraccounts.png"  /></a></td>
 <td ><a href="calendar.php"><img src="images/admin_dashboard_calendar.png"  /></a></td>
        <td>   
   
        </td>
        </tr>
        
   </table>
            <?php
		}
	 ?>
  
  </div>
    </div>
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