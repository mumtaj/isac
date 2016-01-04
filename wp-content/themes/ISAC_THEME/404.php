<?php get_header(); ?>
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
        <div style="width:950px;margin:0 auto;" >
			<?php 
			get_sidebar('top'); 
			
			art_post_wrapper(
				array(
						'title' => __('Not Found', THEME_NS),
						'content' => '<p class="center">' 
						.__( 'Apologies, but the page you requested could not be found. ', THEME_NS) 
						. '</p>' . "\r\n" 
				)
			);

			
			?>
            </div>
          <div class="cleared"></div>
        </div>
       
    </div>
</div>
<div class="cleared"></div>
<?php get_footer();