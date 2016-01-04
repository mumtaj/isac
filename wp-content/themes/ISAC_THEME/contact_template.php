<?php

/* Template Name: Contact_template  */

?>
<?php get_header(); ?>


<?php
  $isacid = $_SESSION['SESS_MEMBER_ID'];






$query = "SELECT * FROM application WHERE isacid = '$isacid'";
 $result = mysql_query($query);
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
 <div class="left_sect_cont">
    <h1>Contact</h1><br>

    <p>Any queries or feedback? Write to us</p><br>

    <form action="isac_process/contact_action.php" method="post" name="appfrm" id="appfrm" >
    <table width="552" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
  <tr>
    <td width="184" class="form_text">Name:</td>
    <td width="287" class="space_for_form"><input type="text" name="name" id="name3" class="text_field" /></td>
  </tr>
  <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
  <tr>
    <td class="form_text">Email Address:</td>
    <td class="space_for_form_2"><input type="text" name="email" id="name4" class="text_field" /></td>
  </tr>
  <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
  <tr>
    <td class="form_text">Contact Number:</td>
    <td class="space_for_form_2"><input type="text" name="contact" id="name5" class="text_field" /></td>
  </tr>
  <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
  <tr>
    <td class="form_text">Type of Query:</td>
    <td class="space_for_form_2"><select name="product-type2" id="product-type2" class="list_box" >
      <option value="general">General</option>
      <option value="university">University</option>
      <option value="media">Media</option>
      <option value="support">Support</option>
      <option value="other">Other</option>
    </select></td>
  </tr>
   <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
  <tr>
    <td class="form_text">Description:</td>
    <td class="space_for_form_2"><textarea name="description2" id="description2" cols="45" rows="5" class="text_field_input"></textarea></td>
  </tr>
  <tr>
    <td colspan="2" class="form_text"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /></td>
    </tr>
  <tr>
    <td class="form_text">&nbsp;</td>
    <td class="space_for_form_2"> <input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button"  /></td>
  </tr>
    </table>
</form>
    <!-- middle box ends here --> 
  </div>
<!--END FORM-->


<div class="left_sect_cont"><!-- Enroll Section Starts here -->
    <div class="contact_us_div">
      <h3>India</h3>
      <p>India Study Abroad Center (ISAC), suite 411,<br />
        Reliable Pride, New Oshiwara Link Road,<br />
        Andheri(W), Mumbai, Maharashtra, India - 400 053.<br />
        Email: <a href="mailto:info@indiastudyabroad.org" title="info@indiastudyabroad.org">info@indiastudyboard.org</a><br />
        Phone(Off): +91-22-2630-3555<br />
        (Mob): +91-982-059-7692 </p>
    </div>
    <div class="contact_us_div">
      <h3>USA</h3>
      <p>Voicemail Only: +1-415-287-0144<br />
        Fax: +1-309-218-6022<br />
        Email: <a href="mailto:info@indiastudyabroad.org" title="info@indiastudyabroad.org">info@indiastudyboard.org</a> </p>
    </div>
    <div class="contact_us_div">
      <h3>Australia</h3>
      <p>Voicemail Only: +1-415-287-0144<br />
        Fax: +1-309-218-6022<br />
        Email: <a href="mailto:info@indiastudyabroad.org" title="info@indiastudyabroad.org">info@indiastudyboard.org</a> </p>
    </div>
    <div class="contact_us_div">
      <h3>Europe</h3>
      <p>Voicemail Only: +1-415-287-0144<br />
        Fax: +1-309-218-6022<br />
        Email: <a href="mailto:info@indiastudyabroad.org" title="info@indiastudyabroad.org">info@indiastudyboard.org</a> </p>
    </div>
    <!-- Enroll Section Ends here --> 
    <!-- Testimonials Starts here --> 
    <!--  --> 
    
    <!-- --> 
    <!-- Testimonials Ends here --> <br>
<br>

  </div>
			<?php
			get_sidebar('bottom'); 
			?>
          <div class="cleared"></div>
        </div>
    </div>
</div>
<div class="cleared"></div>

<script type="text/javascript">// <![CDATA[
//You should create the validator only after the definition of the HTML form

 var frmvalidator  = new Validator("appfrm");
  frmvalidator.addValidation("email","maxlen=50");
  frmvalidator.addValidation("email","req");
  frmvalidator.addValidation("email","email" ,"Please enter Email Address");
  frmvalidator.addValidation("name","req","Please enter your Name");
   frmvalidator.addValidation("contact","req","Please enter your contact details");
    frmvalidator.addValidation("product-type2","req","Please enter your query");
	  frmvalidator.addValidation("description2","req","Please enter your description");

// ]]></script>

<?php get_footer();
