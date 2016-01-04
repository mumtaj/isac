<?php

/* Template Name:STUDENT LOGIN */

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
    <h1>Student login</h1>
    <form action="login-exec.php" method="post" name="applicationform1" id="appfrm" >
    <span class="space_for_form_2">
    </span>
    <table width="520" border="0" cellspacing="2" cellpadding="2" class="top_spacing" style="margin-top:18px">
  <tr>
        <td colspan="4"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>

  <tr>
        <td colspan="4"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
  <tr>
    <td width="87" class="form_text">Username:<br />
     (Your email id)</td>
    <td colspan="2" class="space_for_form_2">
    <input type="text" name="login" class="text_field" title="Enter Email id"/>
    </td>
  </tr>
  <tr>
        <td colspan="4"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
  <tr>
    <td class="form_text">Password:</td>
    <td colspan="2" class="space_for_form_2">
    
     <input type="password" name="password" class="text_field" title="Email id"/> 
    </td>
  </tr>
  <tr>
    <td colspan="3" class="form_text"><img src="images/spacer.gif" width="1" height="8" /></td>
    </tr>
  <tr>
    <td >&nbsp;</td>
    <td width="102" class="space_for_form_2  form_text"><a href="forgot_password.php">Forgot Password?</a></td>
    <td width="311" class="space_for_form_2"><input type="image" src="images/btn_login.jpg" title="LOGIN" alt="LOGIN" class="admin_btn_login" /></td>
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
<?php get_footer();
