<?php session_start();

 //destroy the session 
?>
<?php

/* Template Name: UPDATE_SUCCESS_template */

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
      <table width="540" border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td></td>
    </tr>
  <tr>
    <td height="35" align="center">
     <h5><span style="font-size:18px">Your details has been successfully updated</span></h5><br />

      <div class="btn_cent"><a href="student_panel_dashboard"><img src="<?php bloginfo('template_url'); ?>/images/btn_done.jpg" border="0"  /></a></div>
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
