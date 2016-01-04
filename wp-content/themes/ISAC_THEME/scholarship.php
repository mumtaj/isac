<?php

/* Template Name: SCHOLARSHIP */

?>
<?php
get_header();

require_once('config/config.php');

$sch_sql = "SELECT * FROM scholarship";
$sch_result = mysql_query($sch_sql);
$sch_row = mysql_fetch_array($sch_result);
$scholarship_status = $sch_row['scholarship_status'];

if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '')) {
	
	?>
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
              <td height="35" align="center"><?php
	if($scholarship_status=='1')
	{
	?>
                <h2 class="fonts_h2_headlines_next">Scholarships are currently available</h2>
                <?php
	}
	else
	{
	?>
                <span style="color:#333; font-size:16px; text-align:center"><strong>Scholarships are currently unavailable. We still encourage you to apply for our other ISAC programs. </strong></span>
                <?php
    }
	?>
                <br />
                <br />
                <div class="btn_cent" style="margin-top:5px">Please log in to apply for a scholarship</div>
                <div class="btn_cent" style="margin-top:5px"><a href="<?php echo SERVER_URL; ?>student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" border="0"  /></a></div>
                <div class="btn_cent" style="margin-top:10px"><br />
                  If you are new to ISAC, please register to proceed</div>
                <div class="btn_cent" style="margin-top:5px"><a href="<?php echo SERVER_URL; ?>register"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg" border="0"  /></a></div></td>
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
else if ($_SESSION['SESS_MEMBER_GROUP_TYPE'] == 'GROUP' || $_SESSION['SESS_MEMBER_PARTNER_TYPE'] == 'PARTNER')
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
        <div class="top_spacing" style="margin-top:10px !important">
          <table width="450" border="0" cellspacing="0" cellpadding="0"  align="center">
            <tr>
              <td width="540"></td>
            </tr>
            <tr>
              <td height="35" align="center"><span style="color:#000; font-size:16px; text-align:center;">Scholarships are applicable only to individual students.<br />
                For information on other promotions, please <a href="<?php echo SERVER_URL; ?>contact">contact us</a></span></td>
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


else if ($scholarship_status == 0)
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
              <td height="35" align="center"><?php
	if($scholarship_status=='1')
	{
	?>
                <h2 class="fonts_h2_headlines_next">Scholarships are currently available</h2>
                <?php
	}
	else
	{
	?>
                <span style="color:#333; font-size:16px; text-align:center"><strong>Scholarships are currently unavailable. We still encourage you to apply for our other ISAC programs. </strong></span>
                <?php
    }
	?>
                <br />
                <br />
                <div class="btn_cent" style="margin-top:5px" align="center"><a href="<?php SERVER_URL ?>application" title="Apply a Program"><img src='<?php bloginfo('template_url'); ?>/images/btn_applynow.jpg' width='91' height='28' border='0'  /></a></div></td>
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

else { 

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
		url: SERVER_URL+"/getProgramCost.php",
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
<style type="text/css">
.fellow_form {
	height: auto;
	width: 720px;
	margin-right: auto;
	margin-left: auto;
}
.box_left {
	float: left;
	height: 40px;
	width: 350px;
	font-size:13px;
	font-family:Calibri;
	margin-right:20px;
}
.box_left_full {
	float: left;
	height: 50px;
	width: 700px;
	font-size:13px;
	font-family:Calibri;
	margin-right:20px;
}
.box_right {
	float: left;
	height: auto;
	width: 350px;
	margin-bottom: 15px;
}
.box_left1 {
	float: left;
	height: 110px;
	width: 350px;
	font-size:13px;
	font-family:Calibri;
	margin-right:20px;
}
.box_right1 {
	float: left;
	height: 110px;
	width: 350px;
}
.text_field3 {
	width:112px;
	height:25px;
	background-color:#faf8f4;
	border:1px solid #d6d6d6;
	padding:2px 0 0 5px;
	color:#161616;
}
.grad3 {
	width:103px;
	height:25px;
	background:#faf8f4;
	border:1px solid #d6d6d6;
	padding:2px 0 0 5px;
	color:#161616;
}
.text_area {
	width:312px;
	height:56px;
	background-color:#faf8f4;
	border:1px solid #d6d6d6;
	padding:2px 0 0 5px;
}
.hide {
	display:none;
}
.hide1 {
	display:none;
}
</style>
<div id="art-page-background-glare">
<div id="art-page-background-glare-image">
<div id="art-main">
<div class="art-sheet">
<div class="art-sheet-body">
<div class="art-content-layout">
  <div class="art-content-layout-row">
    <div class="art-layout-cell art-content">
      <?php 
			  get_sidebar('top'); 
			  global $post;
			  if (have_posts()){
				while (have_posts())  
				{
					the_post();
					art_post_wrapper(
						array(
								'id' => art_get_post_id(), 
								'class' => art_get_post_class(),
								'thumbnail' => art_get_post_isac(), // Showing thumbnail on individual post (sushant)
								'title' => art_get_meta_option($post->ID, 'art_show_post_title') ? get_the_title() : '',  
								
								'content' => art_get_content(), // 'content' => 'My post content',
								
						)
					);
					comments_template();
				}
				
			  } else {    
				art_post_wrapper(
					array(
							'title' => __('Not Found', THEME_NS),
							'content' => '<p class="center">' 
							.__( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', THEME_NS) 
							. '</p>' . "\r\n" . art_get_search()
					)
				);
			  } 
			  get_sidebar('bottom'); 
			?>
      <?php
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
      <div class="fellow_form">
        <form action="<?php bloginfo('template_url'); ?>/isac_process/scholarship_process.php" method="post" name="fellowship" id="fellowship" >
          <p>&nbsp; </p>
          <div class="box_left" style="text-align:right">Select Program : </div>
          <div class="box_right">
            <?php
			$query = "SELECT * FROM category WHERE publish = 1 ORDER BY cat_id";
			$result = mysql_query($query);
			
			
			
		?>
            <select name = 'programs' id = 'programs' onchange="load_duration();" class='grad'>
              <option value='000' >Select Program</option>
              <?php
				while($row = mysql_fetch_array($result))
				{
					?>
              <option value="<?php echo $row['cat_id']; ?>" ><?php echo $row['category'];?> </option>
              <?php	
				}
			?>
            </select>
          </div>
          <div class="box_left" style="text-align:right"> Select Duration :</div>
          <div class="box_right">
            <input type="hidden" id="duration_hidden"  name="duration_hidden" value="" />
            <span id="duration_dropdown">
            <select name='duration' id='duration' onchange="load_cost();" class='grad'>
              <option value='000' >Select Duration</option>
            </select>
            </span> </div>
          <div class="box_left" style="text-align:right"> Select Arrival Date : </div>
          <div class="box_right">
            <input type="hidden" id="start_date_hidden" name="start_date_hidden" value="" />
            <span id="start_date_dropdown">
            <select name='program_start_date' id="program_start_date" onchange="load_start_date();" class='grad'>
              <option value='000' >Select Date</option>
            </select>
            </span> </div>
          <div class="box_left" style="text-align:right"> Total Program Fee : </div>
          <div class="box_right">
            <input type='text' name='fees' id='fees' class='grad'  readonly="readonly" value="" />
            <input type="hidden" value="<?php echo $firstname ?>" name="firstname" />
            <input type="hidden" value="<?php echo $lastname ?>" name="lastname" />
            <input type="hidden" value="<?php echo $date ?>" name="date" />
            <input type="hidden" value="<?php echo $month ?>" name="month" />
            <input type="hidden" value="<?php echo $year ?>" name="year" />
            <input type="hidden" value="<?php echo $gender?>" name="gender" />
            <input type="hidden" value="<?php echo $email ?>" name="email" />
            <input type="hidden" value="<?php echo $isacid ?>" name="isacid" />
          </div>
          <div class="box_left" style="text-align:right"> Why are you applying for this scholarship : </div>
          <div class="box_right">
            <textarea name="fellowship" id="fellowship" cols="45" rows="5" class="text_area"></textarea>
          </div>
          <div class="box_left" style="text-align:right"> Why do you believe you are<br />
            the best candidate for this scholarship? </div>
          <div class="box_right">
            <textarea name="believe" id="believe" cols="45" rows="5" class="text_area"></textarea>
          </div>
          <div class="box_left" style="text-align:right"> Have you interned/volunteered before? </div>
          <div id="tabs">
            <div class="box_right">
              <div id="nav"> Yes
                <input type="radio" name="Toggledivs" onclick="Toggle('div1');" />
                No
                <input type="radio" name="Toggledivs" onclick="Toggle('div2');" />
              </div>
            </div>
            <div id="div1" class="tab">
              <p>
              <div class="box_left" style="text-align:right">If yes, please specify details of placement including duration, nature of work and country of placement</div>
              <div class="box_right">
                <textarea  cols="45" rows="15" class="text_area" name="details_placement"></textarea>
              </div>
              <br />
              </p>
              <p>
              <div class="box_left" style="text-align:right">Summarize your goals and achievements <br />
                from the experience (150 words) </div>
              <div class="box_right">
                <textarea name="summarize" id="summarize" cols="45" rows="5" class="text_area"></textarea>
              </div>
              </p>
            </div>
            <div id="div2" class="tab"> </div>
          </div>
          <div class="box_left" style="text-align:right"><span class="form_text">Have you travelled to India before?</span></div>
          <div id="tabs1">
            <div class="box_right">
              <div id="nav1"> Yes
                <input type="radio" name="Toggledivs1" onclick="Toggle1('div3');" />
                No
                <input type="radio" name="Toggledivs1" onclick="Toggle1('div4');" />
              </div>
            </div>
            <div id="div3" class="tab1">
              <p>
              <div class="box_left" style="text-align:right"><span class="form_text">If yes, please specify nature of travel <i>(work/business/study/leisure etc.</i> ), duration and place of stay</span></div>
              <div class="box_right">
                <textarea name="travel"  cols="45" rows="15" class="text_area"></textarea>
              </div>
              <br />
              </p>
              <div class="box_left" style="text-align:right"><span class="form_text">What are your impressions of India? What did you gain from your experience in the country? <i>(150 words)</i></span></div>
              <div class="box_right">
                <textarea name="impressions" id="impressions" cols="45" rows="5" class="text_area"></textarea>
              </div>
              </p>
            </div>
            <div id="div4" class="tab1"> </div>
          </div>
          <div class="box_left1" style="text-align:right"><span class="form_text">What specific skills do you have, that you believe will be useful to the placement site? <br />
            <i> (Summarize and present in bullet points, special skills and qualifications you have acquired from employment, previous volunteer/internship work, experiential learning or through other activities, including hobbies or sports)</i></span></div>
          <div class="box_right1" style="height:120px !important">
            <textarea name="specific_skills" id="specific_skills" cols="45" rows="" class="text_area" style="height:100px !important"></textarea>
          </div>
          <div class="box_left" style="text-align:right"><span class="form_text">Tell us about your vision for a better world and your role as a change-maker in realizing this vision. <i>(250 words)</i></span></div>
          <div class="box_right">
            <textarea name="vision" id="vision" cols="45" rows="5" class="text_area"></textarea>
          </div>
          <div class="box_left" style="text-align:right"><span class="form_text">Please tell us about your understanding of the placement site (Educate Girls) and the work done by them. (200 words)<br />
            <i> (Specify your understanding of their social reform model, their impact and the long-term benefits of their work)</i></span></div>
          <div class="box_right">
            <textarea name="understanding" id="understanding" cols="45" rows="5" class="text_area"></textarea>
          </div>
          <div class="box_left" style="text-align:right"><span class="form_text">Tell us how you can benefit or continue assisting the placement site after completion of your fellowship.<i>(150 words)</i></span></div>
          <div class="box_right">
            <textarea name="benefit" id="benefit" cols="45" rows="5" class="text_area"></textarea>
          </div>
          <div class="box_left_full"><span class="form_text">Please give us 2 specific references with email ids that we may contact. (Ensure that you have obtained necessary consent from the references for ISAC contacting them)</i></span></div>
          <div class="box_left" style="font-size:15px !important;text-decoration:underline"> <strong>Faculty member 1</strong></div>
          <div class="box_right"> </div>
          <div class="box_left" style="text-align:right"><span class="form_text" style="text-align:right"> Name: </span></div>
          <div class="box_right">
            <input type="text" name="member1" class="text_field" />
          </div>
          <div class="box_left" style="text-align:right"><span class="form_text">Designation : </span></div>
          <div class="box_right">
            <input type="text" name="desg1" class="text_field" />
          </div>
          <div class="box_left" style="text-align:right"><span class="form_text">Email-ID : </span></div>
          <div class="box_right">
            <input type="text" name="email1" class="text_field" />
          </div>
          <div class="box_left" style="font-size:15px !important;text-decoration:underline"><strong>Faculty member 2</strong></div>
          <div class="box_right"> </div>
          <div class="box_left" style="text-align:right"><span class="form_text">Name: </span></div>
          <div class="box_right">
            <input type="text" name="member2" class="text_field" />
          </div>
          <div class="box_left" style="text-align:right"><span class="form_text">Designation : </span></div>
          <div class="box_right">
            <input type="text" name="desg2" class="text_field" />
          </div>
          <div class="box_left" style="text-align:right"><span class="form_text">Email-ID : </span></div>
          <div class="box_right">
            <input type="text" name="email2" class="text_field" />
          </div>
          <div style="width:720px;float:left" class="form_text">
            <input name="checkbox" type="checkbox" value="y"  id="checkbox" checked="checked"/>
            <span style="font-size:14px !important"> By submitting this application, I affirm that the facts set forth in it are true and complete. </span></div>
          <div style="text-align:center; padding-top:10px; padding-bottom:10px;float:left;width:720px">
            <input  type='image' src='<?php bloginfo('template_url'); ?>/images/btn_submit.jpg'  class='btn'  title='Submit' />
          </div>
        </form>
      </div>
      <div class="cleared"></div>
      <br />
      <br />
    </div>
  </div>
</div>
<div class="cleared"></div>
<script type="text/javascript">// <![CDATA[
//You should create the validator only after the definition of the HTML form
 var frmvalidator  = new Validator("fellowship");

frmvalidator.addValidation("programs","dontselect=000" , "select a program");  
frmvalidator.addValidation("duration_hidden","req" , "select duration");
frmvalidator.addValidation("start_date_hidden","req", "select program start date");

//frmvalidator.addValidation("fellowship","req","Please enter why you are applying for this fellowship");
//frmvalidator.addValidation("believe","req","Please enter why do you believe you are the best candidate for this fellowship");

//frmvalidator.addValidation("summarize","req","Please enter your goals and achievements from experience");
//frmvalidator.addValidation("impressions","req","Please enter your impressions of India");
<!--frmvalidator.addValidation("specific_skills","req","Please enter specific skills you have, that you believe will be useful to the placement site");

//frmvalidator.addValidation("vision","req","Please enter your vision for a better world and your role as a change-maker");
//frmvalidator.addValidation("understanding","req","Please enter about your understanding of the placement site (Educate Girls)");
//frmvalidator.addValidation("benefit","req","Please enter how you can benefit or continue assisting the placement site after completion of your fellowship");-->

//frmvalidator.addValidation("member1","req","Please enter faculty's member name");
//frmvalidator.addValidation("desg1","req","Please enter faculty's member designation");
//frmvalidator.addValidation("email1","email","Please enter faculty's member email-id");
 frmvalidator.addValidation("checkbox","shouldselchk=y", "Please check the ISAC fellowship terms and conditions");

// ]]></script>
<?php 
}
get_footer();
?>
