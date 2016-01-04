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
        <li ><a href="admin_dashboard-create-new-user.php" title="member">Create New User</a></li>
        <li><a href="admin_dashboard-manage-users.php" title="applicant">Manage Users </a></li>
        <li class="navigation1"><a href="admin_dashboard-change-password.php" title="admin_dashboard-candidate">Change Password</a></li>
        <li><a href="admin_edit_mailer.php" title="Edit Mailers">Content Editing</a></li>
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
  
  
  	<?php
		if ($_GET['status'] == 'false')
		{
			?>
            
            <div class="success_reg">
            	 <h4 align="center" class="error">
                    Change Password Failed<br /> <br />
                    Please enter your current Password.<br /><br />
                </h4>
            </div>
            <?php
		}
		else if ($_GET['status'] == 'true')
		{
			?>
            <div class="success_reg">
            	<h4 align="center" class="error" style="color:#030">
                    Successfully Changed your Password.
                </h4>
            </div>
           	<?php
		}
    ?>
  
  <div class="summary_form reg top_spacing">
  <!-- Right links starts here --><!-- Right Links ends -->
    <h1>Change Password</h1>
    
    <form action="admin_dashboard-change-password-process.php" method="post" name="admin_dashboard-change-password" id="admin_dashboard-change-password" >
      <table width="607" border="0" cellspacing="2" cellpadding="2" class="top_spacing">

        <tr>
          <td width="164" class="form_text">Current Password:</td>
          <td colspan="2" class="space_for_form"><input type="password" name="current_password" class="text_field" title="Enter Current Password" /></td>
        </tr>
        <tr>
          <td colspan="4"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>

          <td class="form_text">New Password</td>
          <td colspan="2" class="space_for_form_2"><input type="password" name="password" class="text_field" title="Enter New Password" /></td>
        </tr>
        <tr>
          <td colspan="4"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
         <tr>

          <td class="form_text">Confirm Password:</td>
          <td colspan="2" class="space_for_form_2"><input type="password" name="password2" class="text_field"  title="Confirm Password"  /></td>
        </tr>
        
        
       
       
    
  <tr>
    <td colspan="2" valign="top"><img src="images/spacer.gif" width="1" height="8" /></td>
    </tr>
       

        <tr>
          <td class="form_text">&nbsp;</td>
          <td colspan="2" class="space_for_form_2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><input type="image" src="images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button"  /></td>
              <td width="79%" class="form_text">&nbsp;</td>
            </tr>
          </table></td>
        </tr>

      </table>
    </form>
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
<script type="text/javascript" >//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("admin_dashboard-change-password");
var chktestValidator  = new Validator("admin_dashboard-change-password");
frmvalidator.addValidation("current_password","req" ,"Please enter the current password");
frmvalidator.addValidation("password","req","Please enter the new password");
frmvalidator.addValidation("password2","eqelmnt=password","The confirmed password is not same as the password");

//]]></script>

</body>
</html>