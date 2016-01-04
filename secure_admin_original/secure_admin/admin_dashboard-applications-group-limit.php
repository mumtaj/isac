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
	
	$sql = 'SELECT * FROM group_limit';
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />
<script src="javascripts/jquery.min.js" type="text/javascript"></script>
<script src="javascripts/gen_validatorv4.js" type="text/javascript"></script>
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
        <li><a href="admin_dashboard-incomplete-applications.php" title="Individual Applications">Individual Applications</a></li>
        <li class="navigation1"><a href="admin_dashboard-incomplete-applications-group.php" title="Group Applications ">Group Applications </a></li>
        <li><a href="admin_dashboard-incomplete-applications-scholarship.php" title="admin_dashboard-incomplete-applications-scholarship">Scholarship Applications</a></li>
        <li><a href="admin_dashboard-incomplete-applications-partners.php" title="admin_dashboard-incomplete-applications-partners">Partner Application</a></li>
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
  <!-- Right links starts here -->
  <div class="rht_tab">
  <ul>
  <li><a href="admin_dashboard-group-limit.php" title="Group Limit"><strong>Group Limit</strong></a></li>
  <li>|</li>
  <li><a href="admin_dashboard-incomplete-applications-group.php" title="Incomplete Applications">Incomplete Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-registered-applications-group.php" title="Registered Applications">Registered Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-deposits-recived-applications-group.php" title="Deposits Received">Deposits Received</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-fully-paid-applications-group.php" title="Fully Paid">Fully Paid</a></li>
  </ul>
  </div>
  <h1>Group Applications</h1>
  <!-- Right Links ends -->
  
  <div class="clearr"></div>
  
    <form action="group_limit.php" method="post" name="grouplimit_form" id="grouplimit_form" >
        <table width="520" border="0" cellspacing="2" cellpadding="2" class="top_spacing" style="margin-top:18px">
            <tr>
                <td width="220" class="group_limit_form_text">Minimum Group Members</td>

                <td width="10" >
                    <input name="minimum_limit" type="text"  id="minimum_limit" value="<?php echo $row['minimum'] ; ?>" class="group_limit_text_field"   />
                </td>
                <td class="space_for_form_2">
                    <input type="image" src="images/btn_setlimit.png" title="Minimum Limit" alt="Minimum Limit" class="admin_btn_login" />
                </td>
            </tr>
            <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
            </tr>
            <tr>
            	<td class="group_limit_form_text">Maximum Group Members</td>
                <td >
                    <input name="maximum_limit" type="text" class="group_limit_text_field" value="<?php echo $row['maximum'] ; ?>" id="maximum_limit" /> 
                </td>
                <td class="space_for_form_2">
                    <input type="image" src="images/btn_setlimit.png" title="Maximum Limit" alt="Maximum Limit" class="admin_btn_login" />
                </td>
            </tr>
            <tr>
                <td colspan="2" class="form_text"><img src="images/spacer.gif" width="1" height="8" /></td>
            </tr>
            
        </table>
    </form>
  
    <div> </div>
    <!-- middle box ends here --> 
  </div>
  <!-- Middle left section --> 
  <!-- Middle right section --> 
  
  <!-- Middle right section --> 
  <!-- Main contents Ends here -->
  <div class="clear"></div>
</div>
<script type="text/javascript" >//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("grouplimit_form");
var chktestValidator  = new Validator("grouplimit_form");
frmvalidator.addValidation("minimum_limit","req","Please enter mininum limit");
frmvalidator.addValidation("maximum_limit","req","Please enter maximum limit");

//]]></script>
<!-- Wrapper Ends here -->

</body>
</html>