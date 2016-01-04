
<?php

/* Template Name:register_apply_login for apply button */

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
 <div class="btn_cent" style="margin-top:5px;font-size:14px !important">If you have already applied for an ISAC program in the past please login to your account to apply for a new one</div>
    <div class="btn_cent" style="margin-top:5px"><a href="<?php echo SERVER_URL; ?>student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" border="0"  /></a></div>  
       <div class="btn_cent" style="margin-top:10px;font-size:14px !important"><br />
         If you are new to ISAC, please register to proceed</div>
 <div class="btn_cent" style="margin-top:5px"><a href="<?php echo SERVER_URL; ?>registration-option"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg" border="0"  /></a></div>       
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
          <br />
        </div>
    </div>
</div>
<div class="cleared"></div>

<?php get_footer(); ?>
