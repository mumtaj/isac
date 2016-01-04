<?php
/* Template Name: create_partner_group  */

get_header();

//Connect to mysql server
$dblink = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$dblink) {
	die('Failed to connect to server: ' . mysql_error());
}
//Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
	die("Unable to select database");
}
if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '') || $_SESSION['SESS_MEMBER_PARTNER_TYPE']!='PARTNER') 
{
?>
                   	
<div id="art-page-background-glare">
<div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
        <!-- Start form --->
 <div class="left_sect reg lft" style="margin-top:35px; margin-bottom:35px;">
  <div class="top_spacing">
      <table width="450" border="0" cellspacing="0" cellpadding="0"  align="center">
    <tr>
      <td width="540"></td>
    </tr>
  <tr>
    <td height="35" align="center">
      <span style="color:#F00; font-size:18px; text-align:center"><strong>ACCESS DENIED. <br />

Kindly Register/login to continue.</strong></span><br />
<br />

      <div class="btn_cent"><a href="registration-option"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg" border="0"  /></a>&nbsp; &nbsp; <a href="student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" border="0"  /></a></div>
    </td>
  </tr>
  

  
  </table>
    </div>

    <!-- middle box ends here --> 
  </div>
<!--END FORM-->
			<?php
			get_sidebar('bottom'); 
			?>
          <div class="cleared"></div>
        </div>
    </div>
</div>
<div class="cleared"></div>

    <?php
} 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_SESSION['SESS_MEMBER_PARTNER_TYPE']=='PARTNER' && $_SESSION['SESS_MEMBER_ID']!='')
{
	$isacid = $_SESSION['SESS_MEMBER_ID'];
	$username = $_SESSION['SESS_FIRST_NAME'] ;
	$partnerid = $_SESSION['SESS_MEMBER_PARTNER_ID'];
	$partnername = $_SESSION['SESS_MEMBER_PARTNER_NAME'];
	
	

?>


<script type="text/javascript">
$(document).ready(function()//When the dom is ready 
{
$("#groupname").change(function() 
{ //if theres a change in the username textbox

var groupname = $("#groupname").val();//Get the value in the username textbox
if(groupname.length > 3)//if the lenght greater than 3 characters
{
$("#availability_status").html('<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" align="absmiddle">&nbsp;Checking availability...');
//Add a loading image in the span id="availability_status"

$.ajax({  //Make the Ajax Request
    type: "POST",  
    url: "<?php bloginfo('template_url'); ?>/isac_process/ajax_check_partner_group_name.php",  //file name
    data: "groupname="+ groupname,  //data
    success: function(server_response){  
   
   $("#availability_status").ajaxComplete(function(event, request){ 

	if(server_response == '0')//if ajax_check_group_name.php return value "0"
	{ 
	$("#availability_status").html('<img src="<?php bloginfo('template_url'); ?>/images/available.png" align="absmiddle"> <font color="Green"> Available </font>  ');
	document.creategroupform.check.value += 'hello';
	//add this image to the span with id "availability_status"
	}  
	else  if(server_response == '1')//if it returns "1"
	{  
	 $("#availability_status").html('<img src="<?php bloginfo('template_url'); ?>/images/not_available.png" align="absmiddle"> <font color="red">Not Available </font>');
	 document.creategroupform.check.value += '';
	}  
   
   });
   } 
   
  }); 

}
else
{

$("#availability_status").html('<font color="#cc0000">Groupname too short</font>');
//if in case the username is less than or equal 3 characters only 
}



return false;
});

});
</script>
<br />
<div id="art-page-background-glare">
    <div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
<div class="art-content-layout">
    <div class="art-content-layout-row">
      <div class="art-layout-cell art-content">
        <!-- Start form --->
<div class="left_sect reg lft_heck" style="margin-top:0px; margin-bottom:35px;">
  <div class="rht_tab">

 <ul>
  <li><a href="create_partner_group" title="Create a group"><b>Create a group</b></a></li>
  <li>|</li>
  <li><a href="student_panel_dashboard_partner" title="My Groups">My Groups</a></li>
  </ul>
        </div><h2 class="fonts_h2_headlines">Create Group</h2>
    
    <br />

	<form action="<?php bloginfo('template_url'); ?>/isac_process/create_partner_group_process.php" method="post" name="creategroupform" id="creategroupform" >
      <table width="607" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
        <tr>
          <td width="164" class="form_text" valign="middle" style="text-align:right">Please Enter Group Name:</td>
          <td class="space_for_form"><input type="text" name="groupname"  id="groupname" class="text_field" title="Enter Group Name" /></td>
          <td width="102" class="space_for_form_2"><span style="margin:0px;" id="availability_status"></span></td>
        </tr>
        <tr>
          <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        
       
        <tr>
          <td class="form_text">&nbsp;</td>
          <td colspan="2" class="space_for_form_2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button"  /></td>
              <td width="79%" class="form_text">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
    </form>
    <div> </div>
    <!-- middle box ends here --> 
    
  </div>
<!--END FORM-->
			<?php
			get_sidebar('bottom'); 
			?>
          <div class="cleared"></div>
        </div>
    </div>
</div>
<div class="cleared"></div>
<br />

<script type="text/javascript">//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("creategroupform");
var chktestValidator  = new Validator("creategroupform");
frmvalidator.addValidation("groupname","req","Please enter your Group name");


//]]></script>
<?php 
} //Else if Condition

get_footer(); 
?>