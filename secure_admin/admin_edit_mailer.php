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
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />
<script src="javascripts/jquery.min.js" type="text/javascript"></script>
<script src="javascripts/gen_validatorv4.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()//When the dom is ready 
{
	$("#usersname").change(function() 
	{ //if theres a change in the username textbox
	
		var usersname = $("#usersname").val();//Get the value in the username textbox
		if(usersname.length > 3)//if the lenght greater than 3 characters
		{
			$("#user_name_availability_status").html('Checking availability...');
			//Add a loading image in the span id="availability_status"
			
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "ajax_check_username.php",  //file name
				data: "usersname="+ usersname,  //data
				success: function(server_response){  
				
				$("#user_name_availability_status").ajaxComplete(function(event, request){ 
				
					if(server_response == '0')//if ajax_check_username.php return value "0"
					{ 
						$("#user_name_availability_status").html('<img src="images/available.png" align="absmiddle"> <font color="Green"> Available </font>');
						document.admin_create_user.check.value += 'hello';
					}  
					else  if(server_response == '1')//if it returns "1"
					{  
						 $("#user_name_availability_status").html('<img src="images/not_available.png" align="absmiddle"> <font color="red">Not Available </font>');
						 document.admin_create_user.check.value += '';
					}  
			
				});
				} 
			
			}); 
			
		}
		else
		{
			$("#user_name_availability_status").html('<font color="#cc0000">User name too short</font>');
		}
	return false;
	});
	
	
	$("#email").change(function() 
	{ //if theres a change in the username textbox
	
		var email = $("#email").val();//Get the value in the username textbox
		if(email.length > 3)//if the lenght greater than 3 characters
		{
			$("#availability_status").html('Checking availability...');
			//Add a loading image in the span id="availability_status"
			
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "ajax_check_email.php",  //file name
				data: "email="+ email,  //data
				success: function(server_response){  
				
				$("#availability_status").ajaxComplete(function(event, request){ 
				
					if(server_response == '0')//if ajax_check_username.php return value "0"
					{ 
						$("#availability_status").html('<img src="images/available.png" align="absmiddle"> <font color="Green"> Available </font>');
						document.admin_create_user.check.value += 'hello';
					}  
					else  if(server_response == '1')//if it returns "1"
					{  
						 $("#availability_status").html('<img src="images/not_available.png" align="absmiddle"> <font color="red">Not Available </font>');
						 document.admin_create_user.check.value += '';
					}  
			
				});
				} 
			
			}); 
			
		}
		else
		{
			$("#availability_status").html('<font color="#cc0000">email too short</font>');
		}
	return false;
	});

});
</script>
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
        <li><a href="admin_dashboard-create-new-user.php" title="member">Create New User</a></li>
        <li><a href="admin_dashboard-manage-users.php" title="applicant">Manage Users </a></li>
        <li><a href="admin_dashboard-change-password.php" title="admin_dashboard-candidate">Change Password</a></li>
        <li class="navigation1"><a href="admin_edit_mailer.php" title="Edit Mailers">Content Editing</a></li>
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
  <!-- Right links starts here --><!-- Right Links ends -->
    <h1>edit content</h1>
    <br />
    <br />
    <a href="admin_edit_reminder.php">Edit reminder content</a><br /><br /><br />
    <a href="admin_edit_acceptance.php">Edit Acceptance letter content</a><br /><br />
    <div> </div>
    <!-- middle box ends here --> 
  </div>
  <!-- Middle left section --> 
  <!-- Middle right section --> 
  
  <!-- Middle right section --> 
  <!-- Main contents Ends here -->
  <div class="clear"></div>
</div>


</body>
</html>