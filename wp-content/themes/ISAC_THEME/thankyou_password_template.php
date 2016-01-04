<?php

/* Template Name: THANKYOU_password_template */

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
                                        <table width="600" border="0" cellspacing="0" cellpadding="0" >
                                            <tr>
                                                <td height="35" align="center">
                                                <?php
													if ($_GET['status'] == 'false')
													{
														?>
                                                        <p style="font-size:14px !important;margin-top:10px">
                                                        	We cannot find the email ID you have submitted in our records.<br />
                                                       	Please  <a href="<?php echo SERVER_URL; ?>forgot-password">click here</a> to enter your email ID again. <br />
                                                       	<br />
                                                       	If you have not yet registered with ISAC, please <a href="<?php echo SERVER_URL; ?>registration-option">click here</a> to register.                                                        </p> 
                                                       <!-- <br /><br />
                                                        <div class="btn_cent">
                                                            <a href="<?php// echo SERVER_URL; ?>student-login">
                                                                <img src="<?php// bloginfo('template_url'); ?>/images/btn_login.jpg"  />
                                                            </a>
                                                        </div>
                                                        <br /><br />-->
                                                        <?php
													}
													else
													{
														?>
                                                        <p style="font-size:14px !important">Your details has been sent successfully. Kindly check your E-mail</p> <br /><br />
                                                        <div class="btn_cent">
                                                            <a href="<?php echo SERVER_URL; ?>student-login">
                                                                <img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg"  />
                                                            </a>
                                                        </div>
                                                       
                                                        <?php
													}
												?>
                                                	
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
