<?php
if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '')) {
	
	?>
<?php get_header(); ?>
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

      <div class="btn_cent"><a href="register"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg"  /></a>&nbsp; &nbsp; <a href="student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg"  /></a></div>
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
<?php get_footer();

} 


else { 

?>



<?php

/* Template Name: application_EDIT_form  */

?>
<?php get_header(); ?>
<?php require_once('config/config.php'); ?>

<script type="text/javascript"> 
function Toggle(thediv) { 
	document.getElementById("div1").style.display = "none"; 
	document.getElementById("div2").style.display = "none"; 
	document.getElementById(thediv).style.display = "block"; 
} 

function Toggle1(thediv1) { 
	document.getElementById("div3").style.display = "none"; 
	document.getElementById("div4").style.display = "none"; 
	document.getElementById(thediv1).style.display = "block"; 
} 

var SERVER_URL = '<?php bloginfo('template_url'); ?>/isac_process';

function load_duration()
{
	var programs= $("#programs").val();

	var dataString = 'programs='+ programs;
	
	$.ajax({
		type: "POST",
		url: SERVER_URL+"/getDuration.php",
		data: dataString,
		cache: false,
		success: function(response)
		{
			$("#duration_dropdown").html(response);
			$("#duration_dropdown").focus();
			
			$.ajax({
				type: "POST",
				url: SERVER_URL+"/getProgramStartDate.php",
				data: dataString,
				cache: false,
				success: function(response)
				{
					$("#start_date_dropdown").html(response);
					$("#start_date_dropdown").focus();
					
					
				}
			 });
		}
	 });

return false;
}

function load_cost()
{
	var duration= $("#duration").val();
	var programs2= $("#programs").val();
	
	if(duration == '000')
		$("#duration_hidden").val('');
	else
		$("#duration_hidden").val(duration);
	
	
	var dataString = 'duration='+ duration+'&programs2='+ programs2;
	
	$.ajax({
		type: "POST",
		url: SERVER_URL+"/getProgramCost_ind.php",
		data: dataString,
		cache: false,
		success: function(response)
		{
			$("#fees").val(response);
			$("#fees").focus();
			
			$("#fees_hidden").val('');
		}
	 });

return false;
}

function load_start_date()
{

	var program_start_date= $("#program_start_date").val();
	
	if(program_start_date == '000')
		$("#start_date_hidden").val('');
	else
		$("#start_date_hidden").val(program_start_date);
}
</script>


<?php
$isacid = $_SESSION['SESS_MEMBER_ID'];
 $form_id = $_SESSION['formid'];
$details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");


while($user_details = mysql_fetch_array($details))
{
	$firstname = $user_details['firstname'];
	$lastname = $user_details['lastname'];
	$email = $user_details['email'];
	$date = $user_details['date'];
	$month = $user_details['month'];
	$year = $user_details['year'];
	$gender = $user_details['gender'];
	$isacid = $user_details['isacid'];
	
}

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
 <div class="left_sect reg lft">
    <h1>Application form </h1>
    <p>All fields are mandatory</p>
    <img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" />
    <h4>Program Details</h4>
    <img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" />
    <form action="<?php bloginfo('template_url'); ?>/isac_process/app_update_action.php" method="post" name="applicationform1" id="appfrm"  onsubmit="return _val(this);">
      <table width="520" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
        <tr>
          <td width="150" class="form_text">Select Program:</td>
          <td width="319" class="space_for_form">
          	<?php
			
			$get_formid = $_POST['formid'];
			$sql = "SELECT * FROM application WHERE formid = '$get_formid'";
			$result1 = mysql_query($sql);
			$row1 = mysql_fetch_array($result1);
			$get_programid = $row1['program_id'];
			$get_duration = $row1['duration'];
			$get_arrival = $row1['arrival'];
			$get_cost = $row1['fee'];
			
			
			
			$query = "SELECT * FROM category WHERE publish = 1 ORDER BY cat_id";
			$result = mysql_query($query);
		?>
         <select name = 'programs' id = 'programs' onchange="load_duration();" class='grad'>
         	<option value='000' >Select Program</option>
            <?php
				while($row = mysql_fetch_array($result))
				{
					if($row['cat_id'] == $get_programid)
					{
					?>
                    	<option value="<?php echo $row['cat_id']; ?>" selected="selected" ><?php echo $row['category'];?> </option>
                    <?php		
					}
					else
					{
					?>
                    	<option value="<?php echo $row['cat_id']; ?>" ><?php echo $row['category'];?> </option>
                    <?php	
					}
					
				}
			?>
		 </select>
          
          </td>
        </tr>
        <tr>
          <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Select Duration:</td>
          <td class="space_for_form_2">
 				<input type="hidden" id="duration_hidden"  name="duration_hidden" value="<?php echo $get_duration;?>" />
         
          	<span id="duration_dropdown">
                <select name='duration' id='duration' onchange="load_cost();" class='grad'>
                 	<option value='<?php echo $get_duration;?>' selected="selected" ><?php echo $get_duration.' Weeks';?></option>
                </select>
            </span>
 			</td>
        </tr>
        <tr>
          <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Select Arrival Date:</td>
          <td class="space_for_form_2">
          	<input type="hidden" id="start_date_hidden" name="start_date_hidden" value="<?php echo $get_arrival;?>" /> 
            
        	<span id="start_date_dropdown">
               <select name='program_start_date' id="program_start_date" onchange="load_start_date();" class='grad'> 
                 <option value='<?php echo $get_arrival;?>' selected="selected" ><?php echo $get_arrival;?></option>
                </select>
            </span>
          </td>
        </tr>
        <tr>
          <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Total Program Fee:</td>
          <td class="space_for_form_2">
          
           <input type='text' name='fees' id='fees' class='grad'  readonly="readonly" value="$<?php echo $get_cost;?>" />
           <input type='hidden' name='get_formid' id='get_formid' class='grad' value="<?php echo $get_formid;?>" />

</td>
        </tr>
      

      <!--  ---------------------------------------------------------------------------------------------->

       
        
        <tr>
          <td colspan="2" class="form_text"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /></td>
        </tr>
        <tr>
          <input type="hidden" value="<?php echo $firstname ?>" name="firstname" />
          <input type="hidden" value="<?php echo $lastname ?>" name="lastname" />
          <input type="hidden" value="<?php echo $date ?>" name="date" />
          <input type="hidden" value="<?php echo $month ?>" name="month" />
          <input type="hidden" value="<?php echo $year ?>" name="year" />
          <input type="hidden" value="<?php echo $gender?>" name="gender" />
          <input type="hidden" value="<?php echo $email ?>" name="email" />
          <input type="hidden" value="<?php echo $isacid ?>" name="isacid" />
          <td class="form_text">&nbsp;</td>
          <td class="space_for_form_2"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button" /></td>
        </tr>
        <tr>
          <td colspan="2" class="note">Note: You will be able to edit  your details on the summary page</td>
        </tr>
      </table>
      <!-- ------------------------------------------------------------------------------------------------->
      
    </form>
    <div> </div>
    <!-- middle box ends here --> 
  </div>
<!--END FORM-->
			<?php
			get_sidebar('bottom'); 
			?>
          <div class="cleared"></div>
          <br />
        </div>
    </div>
</div>
<div class="cleared"></div>

<script language="JavaScript" type="text/javascript"
  >//<![CDATA[
function _val(_frm) { 
var _err = '';
var programs = _frm.programs[_frm.programs.selectedIndex].value;
var duration = _frm.duration[_frm.duration.selectedIndex].value;
if(programs == 000) _err += "Please select a program.\n";
if(duration == 000) _err += "Please select program duration.\n";
if($('#program_start_date').val() == 000) _err += "please select program start date.\n";
if(_err) { alert(_err); return false;} else return true;
}
//]]></script>
<?php get_footer(); ?>
<?php } ?>
