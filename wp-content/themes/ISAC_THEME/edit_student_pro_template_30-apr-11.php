<?php

/* Template Name: EDU_STUDENT_TEMPLATE */

?>

<?php get_header(); ?>
<?php require_once('config/config.php'); ?>
<?php $isacid = $_SESSION['SESS_MEMBER_ID']; ?>



<style type="text/CSS">
div.RBtnTab {
	display:none;
}
</style>
<script type="text/javascript">

//Create an array
  var allPageTags = new Array();

  function doSomethingWithClasses(theClass) {
//Populate the array with all the page tags
    var allPageTags=document.getElementsByTagName("*");
//Cycle through the tags using a for loop
    for (var i=0; i<allPageTags.length; i++) {
//Pick out the tags with our class name
      if (allPageTags[i].className==theClass) {
//Manipulate this in whatever way you want
        allPageTags[i].style.display='none';
		      }
    }
  }

function Show(ids) {
  doSomethingWithClasses('RBtnTab');

  var obj = document.getElementById(ids);
  if (obj.style.display != 'block') { obj.style.display = 'block'; }
                               else { obj.style.display = 'none'; }
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
	$uni_name = $user_details['uni_name'];
	$majoring_in = $user_details['majoring_in'];
	$educational = $user_details['educational'];
	$year_of_study = $user_details['year_of_study'];
	$company = $user_details['company'];
	$title = $user_details['title'];
	$academic_qualification = $user_details['academic_qualification'];

	
}


?>


<div id="art-page-background-glare">
    <div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
        <div class="clear"></div>
        <div style="width:547px; height:auto; float:right"> 
    <a href="register-update"><img src="<?php bloginfo('template_url'); ?>/images/personal_details.jpg" class="btn_apply_stu" title="PERSONAL DETAILS" border="0" /></a>
    <a href="educational_work_details"> <img src="<?php bloginfo('template_url'); ?>/images/student-work-details.jpg" class="btn_apply_stu" title="STUDENT / WORK DETAILS" border="0" /></a>
 <a href="questionnaire">   <img src="<?php bloginfo('template_url'); ?>/images/important_question.jpg" class="btn_apply_stu" title="QUESTIONNAIRE" border="0" /></a>
     </div>
    
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
        <!-- Start form --->
 <div class="left_sect reg lft">
  <h1>Student/Work Details</h1>
  <p>All fields are mandatory</p>

  
    <label for="lDIV1">
      <input name='rbtab' type="radio" id="lDIV1" onClick="Show('DIV1')" value='Student' checked="checked" >
      Student</label>
    <label for="lDIV2">
      <input id="lDIV2" type="radio" name='rbtab' value='Professional' onClick="Show('DIV2')">
      Professional</label>
    <div id='Content' style="display:block">
    <br />
    <div id='DIV1' class="RBtnTab">
    <h4>Educational Details:</h4>
    <form action="<?php bloginfo('template_url'); ?>/isac_process/student_pro_action.php" method="post" name="appstu" id="appfrm" >
    <table width="469" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
      <tr><input type="hidden" value="Student" name='rbtab'/>
        <td width="150" class="form_text">Name of University:</td>
        <td width="319" class="space_for_form"><?php echo $uni_name; ?></td>
      </tr>
      <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
      </tr>
      <tr>
        <td class="form_text">Majoring in:</td>
        <td class="space_for_form_2"><input type="text" name="majoring" id="name5" value="<?php  echo $majoring_in; ?>" class="text_field" /></td>
      </tr>
      <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
      </tr>
      <tr>
        <td class="form_text">Educational Level:</td>
        <td class="space_for_form_2"><select name="education" id="education2" class="grad">
           <!-- <option  value="000" selected="selected">Select</option>-->
           <option value="<?php echo $educational;  ?>">Graduate</option>
             <option value="Graduate">Graduate</option>
            <option value="Undergraduate">Undergraduate</option>
            <option value="Other">Other</option>
          </select></td>
      </tr>
      <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
      </tr>
      <tr>
        <td class="form_text">Year of study:</td>
        <td class="space_for_form_2"><select name="Year" id="Year2" class="dropdown_small">
        <option value="<?php  echo $year_of_study; ?>"><?php echo $year_of_study; ?> </option>
         <option value="2011">2011</option>
         <!--<option  value="000" selected="selected">Select</option>-->
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
  
          </select></td>
      </tr>
      <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td class="space_for_form_2"><input type="hidden" name="formid" value="<?php echo $formid ; ?>" /></td>
        <td class="space_for_form_2"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="NEXT" alt="NEXT"  /></td>
      </tr>
      <tr>
        <td colspan="2" class="note">Note: You will be able to edit all your details on the summary page</td>
      </tr>
    </table>
</form>
</div>

<!-- end student   -->
<div id='DIV2' class="RBtnTab">
<h4>Work Details:</h4>
<form action="<?php bloginfo('template_url'); ?>/isac_process/student_pro_action.php" method="post" name="apppro" id="appfrm" >
  <table width="469" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
    <tr>
      <td width="150" class="form_text">Company:</td><input type="hidden" value="Professional" name='rbtab'/>
      <td width="319" class="space_for_form"><input type="text" name="comp" value="<?php echo $company; ?>" id="name4" class="text_field" /></td>
    </tr>
    <tr>
      <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
    </tr>
    <tr>
      <td class="form_text">Title:</td>
      <td class="space_for_form_2"><input type="text" name="title" value="<?php echo $title; ?>" id="name5" class="text_field" /></td>
    </tr>
    <tr>
      <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
    </tr>
    <tr>
      <td class="form_text">Academic qualification:</td>
      <td class="space_for_form_2"><input type="text" name="acdm_qualification"  value="<?php echo $academic_qualification; ?>" id="name3" class="text_field" /></td>
    </tr>
    <tr>
      <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
    </tr>
    <tr>
      <td class="form_text"> Educational Level: </td>
      <td class="space_for_form_2"><select name="education" id="education2" class="grad">
            <option value="<?php echo $educational; ?>"> <?php echo $educational; ?> </option>
     <!-- <option  value="000" selected="selected">select</option>-->
          <option value="Graduate" >Graduate</option>
          <option value="Undergraduate">Undergraduate</option>
          <option value="Other">Other</option>
        </select></td>
    </tr>
    <tr>
      <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /></td>
    </tr>
    <tr>
      <td class="space_for_form_2"><input type="hidden" name="formid" value="<?php echo $formid ; ?>" /></td>
      <td class="space_for_form_2"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="NEXT" alt="NEXT"  /></td>
    </tr>
    <tr>
      <td colspan="2" class="note">Note: You will be able to edit all your details on the summary page</td>
    </tr>
  </table>
  </form>
  </div>
  <!-- end professinal  -->
  </div>

<div class="space_for_form_2"> </div>
<br />
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

<script type="text/javascript">//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("appstu");
frmvalidator.addValidation("university","req","Enter university");
frmvalidator.addValidation("majoring","req" , "Enter majoring in");
frmvalidator.addValidation("education","dontselect=000" , "Please Enter education");
frmvalidator.addValidation("Year","dontselect=000" , "Please Enter year");

//]]></script>

<script type="text/javascript">//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("apppro");
frmvalidator.addValidation("comp","req","Enter company");
frmvalidator.addValidation("title","req" , "Enter title");
frmvalidator.addValidation("education","dontselect=000" , "Please Enter education");
frmvalidator.addValidation("acdm_qualification","req" , "acdm_qualification");

//]]></script>
<?php get_footer();
