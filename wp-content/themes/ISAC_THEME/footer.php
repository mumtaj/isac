<!--<link href="css/style.css" rel="stylesheet" type="text/css" />-->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<div class="cleared"></div>
        </div>
    </div><!--DIv ARt-sheet -->
    <div id="footer_wp"> 
          <!-- Footer Contets starts here -->
          <div class="footer_t_wp"> 
    <!-- Subscribe to newsletter -->
    <div class="newsletter">
              <h2>Subscribe to our newsletter</h2>
              <form name="ccoptin" id="newsletter_isac" action="http://visitor.r20.constantcontact.com/d.jsp" target="_blank" method="post">
              <input type="text" name="ea" class="nws_letter">
              <input type="image" name="go" value="GO" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" class="btn_submit" title="SUBMIT"><input type="hidden" name="llr" value="bjgcy8bab"> <input type="hidden" name="m" value="1101516577057"> <input type="hidden" name="p" value="oi"></form>
              
              <div class="archive_hk"><a href="http://archive.constantcontact.com/fs087/1101516577057/archive/1102322273360.html" target="_blank" title="View past newsletters" style="color: #AC5419 !important;">View past newsletters</a></div>
              <div class="followus">
              <h2>Follow us</h2>
              <span class="social_media"><a href="https://www.facebook.com/pages/ISAC-India-Study-Abroad-Center/78440640595" target="_blank" class="facebook" title="Facebook"></a><a href="http://twitter.com/#!/ISAC_INDIA" target="_blank" class="twitter" title="Twitter"></a><a href="http://www.linkedin.com/pub/hansal-mehta/7/380/86" target="_blank" class="linkedin" title="Linkedin"></a><!--<a href="http://www.youtube.com/isac" target="_blank" class="youtube" title="youtube"></a><a href="http://www.slideshare.net/" target="_blank" class="slideshare" title="Slideshare"></a>--></span> </div>
            </div>
            
    <!-- Subscribe to newsletter --> 
    <!-- Tweets -->
    <div class="tweets">
              <h2>Tweets</h2>
             <?php
			 require_once('isactwitter.html');
			 ?>
            </div>
    <!-- Tweets --> 
    <!-- Follow us -->
    
    
    <div class="add_india">
              <h2>Contact</h2>
        
        <p>India Study Abroad Center (ISAC), Suite 411, Reliable Business Center, Off New Link Road, Oshiwara, Andheri(W), Mumbai, Maharashtra, <br />India - 400 102</p>
		<p>Email: <a href="mailto:info@indiastudyabroad.org" title="info@indiastudyabroad.org">info@indiastudyabroad.org</a></p>
		<p>Phone (Off): +91-22-4014-3517</p>
        
             
             <!-- <p>Phone (Off): +91-22-2630-3555;</p>
              <p>(Mob): +91-982-059-7692</p>-->
            </div>
    
    
  
    
    
    <!-- Follow us --> 
  </div>

    
   <div class="clear01"></div>

	<div style="width:990px; margin:0 auto">	<p>Beyond Borders Learning Programs (INDIA) Pvt. Ltd is a company
incorporated under the Companies Act, 1956 (No. 1 of 1956) with Corporate
Identity No. U93000MH2012PTC231717</p>
	</div>
    <div class="brd"></div>
  <div class="brd"></div>
  <div class="footer_t_wp">
    <ul>
              <li><a href="<?php echo SERVER_URL; ?>about/who-we-are/" title="About ISAC">About ISAC</a></li>
              <li>|</li>
              <li><a href="<?php echo SERVER_URL; ?>programs/" title="Programs">Programs</a></li>
              <li>|</li>
              <li><a href="<?php echo SERVER_URL; ?>locations/" title="Locations">Locations</a></li>
              <li>|</li>
              <li><a href="<?php echo SERVER_URL; ?>contact/" title="Contact">Contact</a></li>
              <li>|</li>
              <li><a href="<?php echo SERVER_URL; ?>privacy-policy" title="Privacy Policy">Privacy Policy</a></li>
              <li>|</li>
              <li><a href="<?php echo SERVER_URL; ?>terms-of-use" title="Terms of Use">Terms of Use</a></li>
               <li><a href="http://www.fhexperience.co/" target="_blank" title="Fountainhead Promotions &amp;  Events Pvt. Ltd." style="font-size:10px;padding-left:60px">Site designed and developed by Fountainhead Digital</a></li>
              
             
           </ul>
          
  </div>
  	
          <!-- Footer Contets ends here --> 
        </div>
        
    <div class="cleared"></div>
    <p class="art-page-footer"></p>
</div>
    </div>
</div>
    <div id="wp-footer">
	        <?php wp_footer(); ?>
	        <!-- <?php printf(__('%d queries. %s seconds.', THEME_NS), get_num_queries(), timer_stop(0, 3)); ?> -->
    </div>
    
    <script type="text/javascript">// <![CDATA[
//You should create the validator only after the definition of the HTML form

 var frmvalidator  = new Validator("ccoptin");
  frmvalidator.addValidation("ea","maxlen=50");
  frmvalidator.addValidation("ea","req");
  frmvalidator.addValidation("ea","email" ,"Please enter a valid email ID");



// ]]></script>
</body>
</html>

