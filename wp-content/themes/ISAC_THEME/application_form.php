<?php
if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '')) {
	?>
<?php get_header(); ?>
<link href="css/style.css" rel="stylesheet" type="text/css" />

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
    <td height="35" align="center"><br />
<br />
 <div class="btn_cent" style="margin-top:5px"> If you have already registered with us or applied for a program in the past you could login with your id now, to apply for programs.</div>
    <div class="btn_cent" style="margin-top:5px"><a href="<?php echo SERVER_URL; ?>student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" border="0"  /></a></div>  
       <div class="btn_cent" style="margin-top:10px">

If you are new to ISAC, you can Apply for a program after you Register with us</div>
 <div class="btn_cent" style="margin-top:5px"><a href="<?php echo SERVER_URL; ?>registration-option/"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg" border="0"  /></a></div>       
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

/* Template Name: application_form  */

?>
<?php get_header(); 

require_once('config/config.php'); 



?>

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

function load_duration_startDate(program_id)
{
	var dataString = 'programs='+ program_id;
	
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

/* function load_start_date()
{

	var program_start_date= $("#program_start_date").val();
	
	if(program_start_date == '000')
		$("#start_date_hidden").val('');
	else
		$("#start_date_hidden").val(program_start_date);
} */
</script>




<?php  //session variable
$isacid = $_SESSION['SESS_MEMBER_ID'];

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
    <h2 class="fonts_h2_headlines">Application form </h2>
    <p style="margin:10px 0 10px;font-size:10px">(All fields are mandatory)</p>
    <img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" />
    <form action="<?php bloginfo('template_url'); ?>/isac_process/app_action.php" method="post" name="applicationform1" id="appfrm" onsubmit="return _val(this)" >
      <table width="476" border="0" align="center" cellspacing="2" cellpadding="2" class="top_spacing">
        <tr>
          <td width="124" class="form_text" style="text-align:right;font-size:14px">Select Program:</td>
          <td width="338" class="space_for_form" >
          	<?php
			
			if ($_GET['cat'] != '') //Coming from Programs Page
				$program_id = $_GET['cat'];
			
			
			$query = "SELECT * FROM category WHERE publish = 1 ORDER BY cat_id";
			$result = mysql_query($query);
			
			
			
		?>
         <select name = 'programs' id = 'programs' onchange="load_duration();" class='grad'>
         	<option value='000' >Select Program</option>
            <?php
				while($row = mysql_fetch_array($result))
				{
					if($program_id != '')
					{
						if($program_id == $row['cat_id'])
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
						?>
							<script type="text/javascript">
                            	$(function() {
									load_duration_startDate('<?php echo $program_id; ?>');
								});
                            </script>
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
          <td class="form_text" style="text-align:right;font-size:14px">Select Duration:</td>
          <td class="space_for_form_2">
          	<input type="hidden" id="duration_hidden"  name="duration_hidden" value="" />
         
          	<span id="duration_dropdown">
                <select name='duration' id='duration' onchange="load_cost();" class='grad'>
                 	<option value='000' selected="selected" >Select Duration</option>
                </select>
            </span>
 			</td>
        </tr>
        <tr>
          <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text" style="text-align:right;font-size:14px">Select Arrival Date:</td>
          <td class="space_for_form_2">
          	
            
        	<span id="start_date_dropdown">
              <!-- onchange="load_start_date();" -->
               <select name='program_start_date' id="program_start_date"  class='grad'> 
                 <option value='000' >Select Date</option>
                </select>
            </span>
          </td>
        </tr>
        <tr>
          <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text" style="text-align:right;font-size:14px">Total Program Fee:</td>
          <td class="space_for_form_2">
		  <input type='text' name='fees' id='fees' class='grad'  readonly="readonly" value="" />

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
          <td colspan="2" class="form_text" style="text-align:center"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button" /></td>
          </tr>
        <tr>
        <td colspan="2" class="note" style="padding-top:15px">Note: You will be able to edit all your details on the summary page</td>
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

<script language="JavaScript" type="text/javascript" xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
/*var frmvalidator  = new Validator("applicationform1");

frmvalidator.addValidation("programs","dontselect=000" , "select a program");  
frmvalidator.addValidation("duration","dontselect=000" , "select duration");
frmvalidator.addValidation("program_start_date","dontselect=000", "select program start date");
*/

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
