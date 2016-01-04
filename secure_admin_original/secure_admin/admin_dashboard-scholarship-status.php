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
        <li><a href="admin_dashboard-incomplete-applications-group.php" title="Group Applications ">Group Applications </a></li>
        <li class="navigation1"><a href="admin_dashboard-incomplete-applications-scholarship.php" title="admin_dashboard-incomplete-applications-scholarship">Scholarship Applications</a></li>
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
  <li><a href="admin_dashboard-pending-applications-scholarship.php" title="Approvals Applications">Approvals</a></li>
  <li>|</li>
  
  <li><a href="admin_dashboard-incomplete-applications-scholarship.php" title="Incomplete Applications">Incomplete Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-registered-applications-scholarship.php" title="Registered Applications">Registered Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-deposits-recived-applications-scholarship.php" title="Deposits Received">Deposits Received</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-fully-paid-applications-scholarship.php" title="Fully Paid">Fully Paid</a></li>
  </ul>
  </div>
  
  <h1>Scholarships</h1>
  <div class="clearr"></div>

    <div class="rht_tab2" >
        <ul>
            <li><a href="admin_dashboard-scholarship-status.php" title="Scholarship Status"><strong>Scholarship Status</strong></a></li>
        </ul>
    </div>
     <div class="clearr"></div>
        <form action="admin_dashboard-scholarship-status-process.php" method="post" name="scholarship_status_form" id="scholarship_status_form" >
            <table width="700" cellspacing="0" cellpadding="0" style="margin-top:18px;">
               
               	<tr>
                 	<td align="left" style="padding-left:20px" class="group_limit_form_text"><b>Scholarships Status:</b></td>
                 </tr>
                <tr>
                    <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                </tr>
                <tr>
                 	<td align="left" width="180" style="font-family:Verdana, Geneva, sans-serif; padding:3px 0 0 20px ">
                    
                    	<?php
							$sql = "SELECT * FROM scholarship";
							$result = mysql_query($sql);
							$row = mysql_fetch_array($result);
							
							if($row['scholarship_status'] == '1')
							{
								?>
                                	<input type="radio" checked="checked" value="1" name="sch_status"  /> Active
                                    <input type="radio" value="0" name="sch_status" /> Inactive
                                <?php
							}
							else 
							{
								?>
                                	<input type="radio"  value="1" name="sch_status"  /> Active
                                    <input type="radio" checked="checked" value="0" name="sch_status" /> Inactive
                               
                               	<?php
							}
							
						?>
                    	
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><img src="images/spacer.gif" width="1" height="20" /></td>
                </tr>
                <tr>
                 	<td>
                        <input type="image" src="images/btn_submit.jpg" title="Submit" alt="Submit" class="admin_btn_login" />
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                </tr>
                
                
            </table>
    </form>
    <br /><br /><br /><br />
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
var frmvalidator  = new Validator("scholarship_status_form");
var chktestValidator  = new Validator("scholarship_status_form");
frmvalidator.addValidation("sch_status","req","Please select any one");
//]]></script>
<!-- Wrapper Ends here -->

</body>
</html>