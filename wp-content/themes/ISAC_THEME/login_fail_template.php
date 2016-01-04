
<?php

/* Template Name: login_FAIL_template */

?>

<?php get_header(); ?>
<?php
$pid = $_SESSION['login_err_prt'];
$id = $_SESSION['login_err'];
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
 <div class="login_section" style="width:950px; margin-left:0px;">
        <h1 style="color:#FF0000;font-size:16px;padding-top:10px;margin-left:10px">The password or username you entered is incorrect. Please try again.</h1>   
   <table align="right" border="0">
    <tbody><tr>
    <td><div style="margin: 0px; padding: 0px; height: 25px;"></div><span style="font-size: 16px;"><strong>Quick Links</strong></span>
<div style="margin: 0px; padding: 0px; height: 12px;"></div>    
    </td>
    </tr><tr>
<td>

<div style="margin-left: 15px; padding-top:">
<a href="http://indiastudyabroad.org/what-is-a-group/" target="_blank" style="color: rgb(172, 84, 25); font-size: 16px; font-weight: bold; text-decoration: none;">What is a group?</a>
<div style="margin: 0px; padding: 0px; height: 8px;"></div>
<a href="http://indiastudyabroad.org/who-is-an-individual/" target="_blank" style="color: rgb(172, 84, 25); font-size: 16px; font-weight: bold; text-decoration: none;">Who is an individual?</a>
<div style="margin: 0px; padding: 0px; height: 8px;"></div>
<a href="http://indiastudyabroad.org/who-is-a-partner/" target="_blank" style="color: rgb(172, 84, 25); font-size: 16px; font-weight: bold; text-decoration: none;">Who is a partner?</a>
</div>
</td>
    </tr>
    </tbody></table>
 
 <div class="left_sect_login_n reg_new_lin lft1">
   <h2 class="fonts_h2_headlines_forms">Student / Group login &nbsp;<a   href="<?=SERVER_URL;?>what-is-studentgroup-login/" target="_blank" class="helplink">What's this?</a></h2>
    <form action="<?php bloginfo('template_url'); ?>/isac_process/login-exec.php" method="post" name="applicationform1" id="appfrm" >
    <span class="space_for_form_2">
    </span>
    
    
    <table width="315" border="0" cellspacing="2" cellpadding="2" class="top_spacing" style="margin-top:18px">
 

  <tr>
        <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
  <tr>
    <td width="80" class="form_text">Username:<br />
     (Your email id)</td>
    <td colspan="2" class="space_for_form_2">
    <input type="text" name="login" class="text_field1" title="Enter Email id" value="<?php echo $id; ?>"/>
    </td>
  </tr>
  <tr>
        <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
  <tr>
    <td class="form_text">Password:</td>
    <td colspan="2" class="space_for_form_2">
    
     <input type="password" name="password" class="text_field1" title="Email id"/> 
    </td>
  </tr>
  <tr>
    <td colspan="3" class="form_text"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /></td>
    </tr>
  <tr>
    <td >&nbsp;</td>
    <td width="96" class="space_for_form_2  form_text"><a href="forgot-password">Forgot Password?</a></td>
    <td width="119" class="space_for_form_2"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" title="LOGIN" alt="LOGIN" class="admin_btn_login" /></td>
  </tr>
    </table>
</form>
    
    <div> </div>
    <!-- middle box ends here --> 
</div>
  <div class="left_sect_login_n reg lft1">
    <h2 class="fonts_h2_headlines_forms">Partner login &nbsp;<a   href="<?=SERVER_URL;?>what-is-partner-login/" target="_blank" class="helplink">What's this?</a></h2>
    <form action="<?php bloginfo('template_url'); ?>/isac_process/login-exec-partner.php" method="post" name="applicationform2" id="appfrm1" >
    <span class="space_for_form_2">
    </span>
    <table width="315" border="0" cellspacing="2" cellpadding="2" class="top_spacing" style="margin-top:18px">
  <tr>
        <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>

  
  <tr>
    <td width="78" class="form_text">Username:<br />
     (Your email id)</td>
    <td colspan="2" class="space_for_form_2">
    <input type="text" name="login" class="text_field1" title="Enter Email id" value="<?php echo $pid; ?>"/>
    </td>
  </tr>
  <tr>
        <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
  <tr>
    <td class="form_text">Password:</td>
    <td colspan="2" class="space_for_form_2">
    
     <input type="password" name="password" class="text_field1" title="Email id"/> 
    </td>
  </tr>
  <tr>
    <td colspan="3" class="form_text"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /></td>
    </tr>
  <tr>
    <td >&nbsp;</td>
    <td width="100" class="space_for_form_2  form_text"><a href="forgot-password">Forgot Password?</a></td>
    <td width="117" class="space_for_form_2"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" title="LOGIN" alt="LOGIN" class="admin_btn_login" /></td>
  </tr>
    </table>
</form>
    
    
    
    
  
    <div> </div>
    <!-- middle box ends here --> 
  </div>
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
<script type="text/javascript">// <![CDATA[
//You should create the validator only after the definition of the HTML form

 var frmvalidator  = new Validator("applicationform1");
  frmvalidator.addValidation("login","maxlen=60");
  frmvalidator.addValidation("login","req","Please enter your username");
  frmvalidator.addValidation("login","email" ,"Please enter a valid username/Email address");
  frmvalidator.addValidation("password","req","Please enter your password");
  

// ]]></script>
<script type="text/javascript">// <![CDATA[
//You should create the validator only after the definition of the HTML form

 var frmvalidator  = new Validator("applicationform2");
 frmvalidator.addValidation("login","maxlen=60");
  frmvalidator.addValidation("login","req","Please enter your username");
  frmvalidator.addValidation("login","email" ,"Please enter a valid username/Email address");
  frmvalidator.addValidation("password","req","Please enter your password");
  

// ]]></script>
<?php get_footer();
