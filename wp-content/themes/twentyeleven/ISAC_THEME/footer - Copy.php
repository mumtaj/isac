<link href="style.css" rel="stylesheet" type="text/css" />
    <div class="art-footer">
                <div class="art-footer-t"></div>
                <div class="art-footer-body">
                    <?php get_sidebar('footer'); ?>
                    
                  <div class="art-footer-text">
                      <?php  echo do_shortcode(art_get_option('art_footer_content')); ?>
                  </div>
            		<div class="cleared"></div>
                </div>
            </div>
    		<div class="cleared"></div>
        </div>
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
</body>
</html>

