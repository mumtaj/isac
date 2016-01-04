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
	
	$member_id = $_POST['memberid'];
	
	$sql = "SELECT * FROM admin WHERE member_id = '$member_id'";
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
        <li ><a href="admin_dashboard-create-new-user.php" title="member">Create New User</a></li>
        <li class="navigation1"><a href="admin_dashboard-manage-users.php" title="applicant">Manage Users </a></li>
        <li ><a href="admin_dashboard-change-password.php" title="admin_dashboard-candidate">Change Password</a></li>
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
                    Create New User Failed!<br /> <br />
                    Please enter User Name and Email.<br /><br />
                </h4>
            </div>
            <?php
		}
		else if ($_GET['status'] == 'true')
		{
			?>
            <div class="success_reg">
            	<h4 align="center" class="error" style="color:#030">
                    Successfully Created New User.
                </h4>
            </div>
           	<?php
		}
    ?>
  
  <div class="summary_form reg top_spacing">
  <!-- Right links starts here --><!-- Right Links ends -->
    <h1>Manage Users - Edit</h1>
    
    <form action="admin_dashboard-edit-user-process.php" method="post" name="admin_edit_user" id="admin_edit_user" >
      <table width="607" border="0" cellspacing="2" cellpadding="2" class="top_spacing">

        <tr>
          <td width="164" class="form_text">Name:</td>
          <td colspan="2" class="space_for_form"><input type="text" name="name" class="text_field" title="Enter Name" value="<?php echo $row['firstname'] ?>" /></td>
        </tr>
        <tr>
          <td colspan="4"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>

          <td class="form_text">User Name:</td>
          <td width="321" class="space_for_form_2">
          	<input type="text" name="usersname" id="usersname" class="text_field" title="Enter User Name" value="<?php echo $row['login'] ?>" />
            <input type="hidden" name="memberid" id="memberid" class="text_field"  value="<?php echo $row['member_id'] ?>" />
          </td>
          <td width="102" class="space_for_form_2"><span style="margin:0px;" id="user_name_availability_status"></span></td>
        </tr>
        <tr>
          <td colspan="4"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Email:</td>
          <td width="321" class="space_for_form_2">
              <input type="text" name="email" class="text_field"  title="Enter Email" id="email" value="<?php echo $row['email'] ?>"  />
          </td>
          <td width="102" class="space_for_form_2"><span style="margin:0px;" id="availability_status"></span></td>
        </tr>
        <tr>
          <td colspan="4"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>

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
          <td colspan="4"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td height="25" class="form_text">Account Type</td>
          <td colspan="2" class="space_for_form_2"><select name="account_type" id="account_type" class="dropdown_g">
              <option value="000">Select</option>
              
              <?php
			  	if($row['permissions'] == 1)
				{
					?>
					<option value="2">View Only</option>
             		<option value="<?php echo $row['permissions']; ?>" selected="selected">Full Access</option>
                    <?php
				}
				else if($row['permissions'] == 2)
				{
					?>
					<option value="<?php echo $row['permissions']; ?>" selected="selected">View Only</option>
             		<option value="1" >Full Access</option>
                    <?php
				}
			  ?>
            </select></td>
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
<script type="text/javascript" >//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("admin_edit_user");
var chktestValidator  = new Validator("admin_edit_user");
frmvalidator.addValidation("name","req","Please enter name");
frmvalidator.addValidation("usersname","req","Please enter your User Name");
frmvalidator.addValidation("email","maxlen=50");
frmvalidator.addValidation("email","req");
frmvalidator.addValidation("email","email" ,"Please enter a valid Email Address");

frmvalidator.addValidation("password2","eqelmnt=password","The confirmed password is not same as the password");
frmvalidator.addValidation("account_type","dontselect=000" , "Please select Account Type");
//]]></script>
<!-- Wrapper Ends here -->

</body>
</html>