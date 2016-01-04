<?php

    session_start();

    $admin_name = $_SESSION['SESS_FIRST_NAME'];

    if ( ! isset($_GET['status']) )      $_GET['status'] = '';
    if ( ! isset($_POST['isacid']) )     $_POST['isacid'] = '';
    if ( ! isset($_POST['partner_id']) ) $_POST['partner_id'] = '';

    require_once('auth.php');
    //Include database connection details
	require_once('config.php');
	
	//$group = $_POST["csi"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
	$isacid = $_POST['isacid'];
	$partner_id = $_POST['partner_id'];

	$query = "SELECT * FROM registration WHERE partner_id_isac = '$partner_id' AND isacid = '$isacid'";
	$result = mysqlquery($query);
	$row = mysqli_fetch_array($result);
	
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
	$("#partnername").change(function() 
	{ //if theres a change in the partner_name textbox
	
		var partnername = $("#partnername").val();//Get the value in the username textbox
		if(partnername.length > 3)//if the lenght greater than 3 characters
		{
			$("#partner_name_availability_status").html('Checking availability...');
			//Add a loading image in the span id="availability_status"
			
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "ajax_check_partnername.php",  //file name
				data: "partnername="+ partnername,  //data
				success: function(server_response){  
				
				$("#partner_name_availability_status").ajaxComplete(function(event, request){ 
				
					if(server_response == '0')//if ajax_check_username.php return value "0"
					{ 
						$("#partner_name_availability_status").html('<img src="images/available.png" align="absmiddle"> <font color="Green"> Available </font>');
						document.admin_create_partner.check.value += 'hello';
					}  
					else  if(server_response == '1')//if it returns "1"
					{  
						 $("#partner_name_availability_status").html('<img src="images/not_available.png" align="absmiddle"> <font color="red">Not Available </font>');
						 document.admin_create_partner.check.value += '';
					}  
			
				});
				} 
			
			}); 
			
		}
		else
		{
			$("#partner_name_availability_status").html('<font color="#cc0000">User name too short</font>');
		}
    	return false;
	});
	
	$("#email").change(function() 
	{ //if theres a change in the username textbox
	
		var email = $("#email").val();//Get the value in the username textbox
		if(email.length > 3)//if the lenght greater than 3 characters
		{
			$("#partner_email_availability_status").html('Checking availability...');
			//Add a loading image in the span id="availability_status"
			
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "ajax_check_partneremail.php",  //file name
				data: "email="+ email,  //data
				success: function(server_response){  
                    $("#partner_email_availability_status").ajaxComplete(function(event, request){ 
                        if(server_response == '0')//if ajax_check_username.php return value "0"
                        { 
                            $("#partner_email_availability_status").html('<img src="images/available.png" align="absmiddle"> <font color="Green"> Available </font>');
                            document.admin_create_partner.check.value += 'hello';
                        }  
                        else  if(server_response == '1')//if it returns "1"
                        {  
                             $("#partner_email_availability_status").html('<img src="images/not_available.png" align="absmiddle"> <font color="red">Not Available </font>');
                             document.admin_create_partner.check.value += '';
                        }  
                    });
				} 
			}); 
		}
		else
		{
			$("#partner_email_availability_status").html('<font color="#cc0000">email too short</font>');
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
        <div class="logo"><img src="images/logo.jpg" alt="INDIA STUDY ABROAD CENTER (Volunteer &amp; Interm with ISAC, the India Specialists)" width="488" height="76" border="0"></div>
        <!-- Logo Ends Here --> 
        <!-- Search Starts Here -->
        <div id="search">
               
<form name="logout" action="logout.php" method="post">    
  <input type="image" src="images/btn_logout.jpg" class="btn_apply" title="LOGOUT"></form>
<a href="admin_index.php"><img src="images/btn_dashboard.jpg" alt="Admin" width="150" height="26" border="0" class="btn_apply11"></a>

       
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
        <li><a href="admin_dashboard-incomplete-applications-scholarship.php" title="admin_dashboard-incomplete-applications-scholarship">Scholarship Applications</a></li>
        <li class="navigation1"><a href="admin_dashboard-incomplete-applications-partners.php" title="admin_dashboard-incomplete-applications-partners">Partner Application</a></li>
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
		if ($_GET['status'] == 'partner')
		{
			?>
            
            <div class="success_reg">
            	 <h4 align="center" class="error">
                    Create Partner Failed!<br /> <br />
                    Please Enter Partner Name.
                </h4>
            </div>
            <?php
		}
		else if ($_GET['status'] == 'false')
		{
			?>
            
            <div class="success_reg">
            	 <h4 align="center" class="error">
                    Create Partner Failed!<br /> <br />
                    Please Enter Email.
                </h4>
            </div>
            <?php
		}
		else if ($_GET['status'] == 'true')
		{
			?>
            <div class="success_reg">
            	<h4 align="center" class="error" style="color:#030">
                    Successfully Created Partner.
                </h4>
            </div>
           	<?php
		}
    ?>
  
    
  <div class="summary_form reg top_spacing">
  <!-- Right links starts here --><!-- Right Links ends -->
    
    
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    	<tr>
        	<td style="width:50%">
            	<h1>Partner Account - Edit</h1>
            <form action="admin_dashboard-edit-partner-process.php" method="post" name="admin_create_partner" id="admin_create_partner">
              <table width="100%" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
        
                <tbody><tr>
                  <td width="164" class="form_text">Partner Name:</td>
                  <td colspan="2" class="space_for_form"><input type="text" name="partnername" id="partnername" class="text_field" title="Enter Partner Name" value="<?php echo $row['isac_partnername'];?>"></td>
                </tr>
                <tr>
                  <td></td>
                  <td class="space_for_form_2"><span style="margin:0px;" id="partner_name_availability_status"></span>
                </tr>
                <tr>
                  <td colspan="4"><img src="images/spacer.gif" width="1" height="3"></td>
                </tr>
                
                <tr>
        
                  <td class="form_text">Leader Name:</td>
                  <td width="321" class="space_for_form_2">
                    <input type="text" name="leadername" id="leadername" class="text_field" title="Enter Leader Name"
                    	value="<?php echo $row['firstname'];?>" >
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td class="space_for_form_2"><span style="margin:0px;" id="leader_name_availability_status"></span>
                </tr>
                <tr>
                  <td colspan="4"><img src="images/spacer.gif" width="1" height="3"></td>
                </tr>
                <tr>
                  <td class="form_text">Email:</td>
                  <td width="321" class="space_for_form_2">
                      <input type="text" name="email" class="text_field" title="Enter Email" id="email" value="<?php echo $row['email'];?>" />
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td class="space_for_form_2"><span style="margin:0px;" id="partner_email_availability_status"></span>
                </tr>
                <tr>
                  <td colspan="4"><img src="images/spacer.gif" width="1" height="3"></td>
                </tr>
        
                <tr>
                  <td class="form_text">New Password:</td>
                  <td colspan="2" class="space_for_form_2"><input type="password" name="password" class="text_field" title="Password">
                  <input name="check" type="hidden" class="test_search" title="check" maxlength="40" id="check"></td>
                </tr>
                <tr>
                  <td colspan="4"><img src="images/spacer.gif" width="1" height="3"></td>
                </tr>
                <tr>
        
                  <td class="form_text">Confirm Password:</td>
                  <td colspan="2" class="space_for_form_2"><input type="password" name="password2" class="text_field" title=" Confirm Password"></td>
                </tr>
                
                <tr>
                  <td colspan="4"><img src="images/spacer.gif" width="1" height="3"></td>
                </tr>
                <tr>
        
                  <td class="form_text">Details:</td>
                  <td colspan="2" class="space_for_form_2"><input type="text" name="details" class="text_area" title="Details" value="<?php echo $row['partner_details'];?>"></td>
                </tr>
                
                <tr>
                  <td colspan="4"><img src="images/spacer.gif" width="1" height="3"></td>
                </tr>
               
               
            
          <tr>
            <td colspan="2" valign="top"><img src="images/spacer.gif" width="1" height="8"></td>
            </tr>
               
        
                <tr>
                  <td class="form_text">&nbsp;</td>
                  <td colspan="2" class="space_for_form_2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td>
                      <input type="hidden" value="<?php echo $isacid; ?>" name="isacid" />
                      <input type="hidden" value="<?php echo $partner_id; ?>" name="partner_id" />
                    
                      <input type="image" src="images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button"></td>
                      <td width="79%" class="form_text">&nbsp;</td>
                    </tr>
                  </tbody></table></td>
                </tr>
        
              </tbody></table>
            </form>
            </td>
            
        </tr>
    </table>
    <br>
    <br>
 
    
    
    <div> </div>
    <!-- middle box ends here --> 
  </div>
  <!-- Middle left section --> 
  <!-- Middle right section --> 
  
  <!-- Middle right section --> 
  <!-- Main contents Ends here -->
  <div class="clear"></div>
</div>
<script type="text/javascript">//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("admin_create_partner");
var chktestValidator  = new Validator("admin_create_partner");
frmvalidator.addValidation("partnername","req","Please enter Partner name");
frmvalidator.addValidation("leadername","req","Please enter Leader Name");
frmvalidator.addValidation("email","maxlen=50");
frmvalidator.addValidation("email","req");
frmvalidator.addValidation("email","email" ,"Please enter a valid Email Address");

frmvalidator.addValidation("password2","eqelmnt=password","The confirmed password is not same as the password");
frmvalidator.addValidation("details","req" , "Please enter Details");
//]]></script>
<!-- Wrapper Ends here -->


</body></html>