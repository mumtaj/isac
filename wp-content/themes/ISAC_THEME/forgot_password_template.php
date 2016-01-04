
<?php

/* Template Name: FORGOT password */

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
 <div class="left_sect reg lft">
  
    <form action="<?php bloginfo('template_url'); ?>/isac_process/forgot_pass_exe.php" method="post" name="applicationform1" id="appfrm" >
    <span class="space_for_form_2">
    </span>
    <table width="444" border="0" cellspacing="2" cellpadding="2" class="top_spacing" style="margin-top:18px" align="center">
 

  <tr>
        <td colspan="4" style="font-size:16px !important"><strong><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" />Please enter your username/email ID to retrieve your password<br />
            <br />
        </strong></td>
        </tr>
  <tr>
    <td width="105" class="form_text">Username:<br />
     (Your email id)</td>
    <td colspan="2" class="space_for_form_2">
    <input type="text" name="login" class="text_field" title="Enter Email id"/>
    </td>
  </tr>
  <tr>
        <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
  
  
  <tr>
    <td >&nbsp;</td>
    <td width="97" class="space_for_form_2  form_text">&nbsp;</td>
    <td width="222" class="space_for_form_2"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_enter.jpg" title="ENTER" alt="ENTER" class="reg_submit_button" /></td>
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
          <br  />
        </div>
    </div>
</div>
<div class="cleared"></div>

<script type="text/javascript">// <![CDATA[
//You should create the validator only after the definition of the HTML form

 var frmvalidator  = new Validator("appfrm");
  frmvalidator.addValidation("login","maxlen=50");
  frmvalidator.addValidation("login","req");
  frmvalidator.addValidation("login","email" ,"Please enter a valid login Email Address");
  
  

// ]]></script>

<?php get_footer();
