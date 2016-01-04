
<?php

/* Template Name:Gallery Template */

?>
<?php get_header(nrm); ?>

<div id="art-page-background-glare">
<div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
         <h2 class="art-postheader" style="margin-top:15px !important;margin-left:10px !important">Gallery</h2>
        <div style="margin-left:70px !important;z-index:2">
       
			<?php 
			  get_sidebar('top'); 
			  global $post;
			  if (have_posts()){
			  	if (art_get_option('art_single_pagination')) {
			  		
				}
				while (have_posts())  
				{
					the_post();
					art_post_wrapper(
						array(
								'id' => art_get_post_id(), 
								'class' => art_get_post_class(),
								'thumbnail' => art_get_post_isac(), // Showing thumbnail on individual post (sushant)
							
								'content' => art_get_content(), // 'content' => 'My post content',
								
						)
					);
					comments_template();
				}
				
			  } else {    
				art_post_wrapper(
					array(
							'title' => __('Not Found', THEME_NS),
							'content' => '<p class="center">' 
							.__( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', THEME_NS) 
							. '</p>' . "\r\n" . art_get_search()
					)
				);
			  } 
			  get_sidebar('bottom'); 
			?>
          <div class="cleared"></div>
          </div>
        </div>
    </div>
</div>
<div class="cleared"></div>

<?php get_footer(); ?>
