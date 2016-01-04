
<?php

/* Template Name: Questionnaire_TEMPLATE */

?>

<?php get_header(); ?>
<?php require_once('config/config.php'); ?>
<?php $isacid = $_SESSION['SESS_MEMBER_ID']; ?>

<?php

if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '')) {
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
      <span style="color:#F00; font-size:18px; text-align:center"><strong>ACCESS DENIED. <br /><br />
      PLEASE LOGIN TO VIEW THIS RESOURCE</strong></span><br />
<br />

      
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
else
{
?>

<script type="text/javascript">

function getRBtnName(GrpName) {
  var sel = document.getElementsByName(GrpName);
  var fnd = -1;
  var str = '';
  for (var i=0; i<sel.length; i++) {
    if (sel[i].checked == true) { str = sel[i].value;  fnd = i; }
  }
//  return fnd;   // return option index of selection
// comment out next line if option index used in line above  
  return str;
} 

function Validate() {
  var Q = ['Q1yn','Q2yn','Q3yn'];
  var flag = true;
  //var checkbox1 = document.getElementById('checkbox');
  var qualifications1 = document.getElementById('qualifications');
  var interested_in_program1 = document.getElementById('interested_in_program');
  var your_expectations1 = document.getElementById('your_expectations');
  for (var i=0; i<Q.length; i++) { 
	if (getRBtnName(Q[i]) == '') {
	  alert('Select the options #'+(i+1));
	  flag = false;
    }
  }
 /*if (!checkbox1.checked) {
      alert('Check the terms and conditions - Field is required'); 
      flag = false;
    } */
		 if (qualifications1.value == '') {
      alert('Please tell us briefly about your educational qualifications and/or professional experience - Field is required'); 
      flag = false;
	  qualifications1.focus();
	  return false; 
    }
	 if (interested_in_program1.value == '') {
      alert('Why are you interested in this program? - Field is required'); 
	  interested_in_program1.focus();	  
      flag = false; return false;
    }
	 if (your_expectations1.value == '') {
      alert('What are your expectations from the ISAC program? - Field is required'); 
	  your_expectations1.focus();
      flag = false; return false;
    }
   for (var i=0; i<Q.length; i++) {
    if ((getRBtnName(Q[i]) == 'Yes') && (document.getElementById(Q[i]+'Text').value == '')) {
      alert('Description required '); 
      flag = false; return false;
    }
  }
	

  return flag;
}
function RBtnCk(info) {
  var N = info.name;
  var YN = info.value;		// alert(N+' : '+YN);
  var show = 'none';
  if (YN == 'Yes') { show = 'block'; }
  document.getElementById(N+'Text').style.display = show;
}
</script>

<?php
 $reg_details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");


while($user_details = mysql_fetch_array($reg_details))
{
	$firstname = $user_details['firstname'];
	$lastname = $user_details['lastname'];
	$email = $user_details['email'];
	$date = $user_details['date'];
	$month = $user_details['month'];
	$year = $user_details['year'];
	$gender = $user_details['gender'];
	$phone_number = $user_details['phone_number'];
	$phone_mobile = $user_details['phone_mobile'];
	$skype = $user_details['skype'];
	$address = $user_details['address'];
	$zip = $user_details['zip'];
	$city = $user_details['city'];
	$state = $user_details['state'];
	$country = $user_details['country'];
	////////
	$educational_qualifications = $user_details['educational_qualifications'];
	$previous_experience = $user_details['previous_experience']; 
	$previous_experience_describe = $user_details['previous_experience_describe'];
	$visited_india = $user_details['visited_india'];
	$visited_india_locations = $user_details['visited_india_locations'];
	$purpose_of_visit =  $user_details ['purpose_of_visit'];
	$local_language = $user_details ['local_language'];
	$local_language_mention = $user_details['local_language_mention'];
	 $interested_in_program = $user_details['interested_in_program'];
	 $your_expectations = $user_details['your_expectations'];
	 $about_ISAC = $user_details ['about_ISAC'];
	 $user_info = $user_details['flag'];
	 $user_info1 = $user_details['flag2'];	
}
?>
<div id="art-page-background-glare">
    <div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
        <div class="clear"></div>
        <div class="tmp_edit_info_btn lft_nw1"> 
            <a href="my-isac"><img src="<?php bloginfo('template_url'); ?>/images/back_to_ISAC_button.jpg" class="btn_apply_stu" title="BACK TO MYISAC" border="0" hspace="1"/></a>
            
    <a href="register-update"><img src="<?php bloginfo('template_url'); ?>/images/personal_details.jpg" class="btn_apply_stu" title="PERSONAL DETAILS" border="0" /></a>
    <a href="educational_work_details"> <img src="<?php bloginfo('template_url'); ?>/images/student-work-details.jpg" class="btn_apply_stu" title="STUDENT / WORK DETAILS" border="0" /></a>
 <a href="questionnaire">   <img src="<?php bloginfo('template_url'); ?>/images/important_question.jpg" class="btn_apply_stu" title="QUESTIONNAIRE" border="0" /></a>
     </div>
    
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
        <!-- Start form --->
 <div class="tmp_edit_area reg lft_nw1">
  
    <p>All fields are mandatory.</p>
    <h1>Important Questionnaire</h1>
    <form action="<?php bloginfo('template_url'); ?>/isac_process/edit_questionarre_action.php" method="post" name="applicationform1" id="appfrm" onSubmit="return Validate()" >
    <table width="814" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
 
 
  <tr>
    <td colspan="2"><table width="68%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text text_aln_rt">Please tell us briefly about your educational qualifications and/or professional 
        experience<input type="hidden" value="<?php echo $formid; ?>" name="formid" /></td>
        <td valign="top"><textarea name="qualifications" id="qualifications" cols="35" rows="10" class="text_area"><?php  echo $educational_qualifications;  ?></textarea></td>
      </tr>
      <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td width="1%">&nbsp;</td>
        <td width="50%" align="left" valign="top" class="form_text text_aln_rt"> Have you had any previous overseas/study abroad/volunteering experience?</td>
        <td width="49%" valign="middle"><input name="Q1yn" type="radio" id="radio" value="Yes" checked="checked" onclick="RBtnCk(this)" />
          <label for="radio">Yes</label><input type="radio" name="Q1yn" id="radio" value="No" onclick="RBtnCk(this)" />
          <label for="radio">No</label></td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text text_aln_rt">If yes, please describe</td>
        <td valign="top"><textarea  cols="35" rows="10" class="text_area" name="previous_experience_describe"  id="Q1ynText"><?php echo $previous_experience_describe; ?></textarea></td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="1" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text text_aln_rt">Have you come to India before?</td>
        <td width="49%" valign="middle"><input name="Q2yn" type="radio" id="radio3" value="Yes" checked="checked" onclick="RBtnCk(this)"/>
          <label for="radio">Yes</label><input type="radio" name="Q2yn" id="radio3" value="No"  onclick="RBtnCk(this)"/>
          <label for="radio">No</label></td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text text_aln_rt">If yes,<br />
please mention locations</td>
        <td valign="top"><textarea name="visited_india_locations" id="Q2ynText" cols="35" rows="10" class="text_area"><?php echo $visited_india_locations; ?></textarea></td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text text_aln_rt">Purpose of visit</td>
        <td valign="top">
        <select name="purpose_of_visit" id="education2" class="grad">
        <option value="<?php echo $purpose_of_visit; ?>" selected="selected" ><?php echo $purpose_of_visit; ?></option>
        <option value="Tourism">Tourism</option>
        <option value="Business">Business</option>
        <option value="Family Visit">Family Visit</option>
        <option value="Volunteering">Volunteering</option>
        <option value="Experiential Learning">Experiential Learning</option>
        <option value="Others">Others</option>
        </select>
        </td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="middle" class="form_text text_aln_rt">Do you speak any local language (Hindi, Urdu or any other local Indian dialect)?</td>
        <td valign="top"><input name="Q3yn" type="radio" id="local_language" value="Yes" checked="checked" onclick="RBtnCk(this)"  />
          <label for="radio">Yes</label><input type="radio" name="Q3yn" id="radio4" value="No" onclick="RBtnCk(this)" />
          <label for="radio">No</label></td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text text_aln_rt">If yes,  please mention</td>
        <td valign="top"><textarea name="local_language_mention" id="Q3ynText" cols="35" rows="10" class="text_area"><?php echo $local_language_mention; ?></textarea></td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text text_aln_rt"> Why are you interested in this program?</td>
        <td valign="top"><textarea name="interested_in_program" id="interested_in_program" cols="35" rows="10" class="text_area" ><?php echo $interested_in_program;  ?></textarea></td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text text_aln_rt"> What are your expectations from the ISAC program?</td>
        <td valign="top"><textarea name="your_expectations" id="your_expectations" cols="35" rows="10" class="text_area"><?php echo $your_expectations; ?></textarea></td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text text_aln_rt">How did you find out about ISAC?</td>
        <td valign="top"><span class="space_for_form_2">
            <script>
		  function _other(_elem) {
			var _sel =  _elem[_elem.options.selectedIndex].value;
			if(_sel == 'websites') $('#other_entry').show();   
		  	else { $('#other_entry').val(_sel); $('#other_entry').hide();  }  
		  }
		  </script>
          <select name="about_ISAC" id="education3" class="grad" onchange="_other(this)">
           <option value='<?php echo $about_ISAC; ?>' ><?php echo $about_ISAC; ?></option>
            <option value='Through a friend'>Through a friend</option>
            <option value='Online Search' selected="selected">Online  Search</option>
            <option value='Through your university'>Through your university</option>
            <option value='websites'>Study abroad websites</option>
                       
          </select>
       
          
           <span id="other_entry" style="display:none;"><br />Please specify: <input type="text" name="Study_abroad_websites"   class="grad" style="margin-top:7px;"/></span>
        </span></td>
      </tr>
        <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td colspan="3" class="brd"><input type="hidden" name="apptype" value="app4" /></td>
          </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" valign="top" class="form_text mid_t_space"> 
         </td>
        <td valign="top" class="mid_t_space">
          <input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="NEXT" alt="NEXT" class="reg_submit_button"  /></td>
      </tr>
       <tr>
    <td colspan="2" class="note"></td>
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
          <br />
        </div>
    </div>
</div>
<div class="cleared"></div>




<?php get_footer(); ?>
<?php
} // end else
?>