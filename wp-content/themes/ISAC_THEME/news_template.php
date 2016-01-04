<?php

/* Template Name: news */

?>
<?php get_header(); ?>
<style>
.art-postheader
{
	font-size:16px !important;
}
.size
{
	
  text-transform: uppercase;
  font-size: 26px;
  font-family: GrandesignNeueSerifRegular;
  font-weight: normal;
  margin: 5px 0 5px 0;

}
.art-post-body
{
	margin-left:-20px !important;
	
}
.art-metadata-icons
{
	font-family:Calibri !important; font-size: 13px !important;color:#666666 !important
}
.art-postcontent
{
	width:607px !important;
	float:right !important;
	
}
</style>
<div id="art-page-background-glare">
    <div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
        <h2 class="size" style="margin-top:15px !important;margin-left:0px !important">NEWS</h2>
<?php 
			  get_sidebar('top'); 
			  global $post;// start post 4
			  if (!is_paged()) {
      query_posts('cat=4');
} // end cat 4
			  if (have_posts()){
			  	if (art_get_option('art_single_pagination')) {
			  		// previous_post_link | next_post_link
				//	art_pagination(array('next_link' => art_get_previous_post_link('&laquo; %link'),'prev_link' => art_get_next_post_link('%link &raquo;')));
				}
				while (have_posts())  
				{
					the_post();
					art_post_wrapper(
						array(
								'id' => art_get_post_id(), 
								'class' => art_get_post_class(),
								'thumbnail' => art_get_post_isac(), // Showing thumbnail on individual post
								'title' => art_get_meta_option($post->ID, 'art_show_post_title') ? get_the_title() : '',  
								'before' => art_get_metadata_icons('date,edit', 'header'),
								'content' => art_get_content(), // 'content' => 'My post content',
								//'after' => art_get_metadata_icons('category,tag', 'footer')
								
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
<div class="cleared"></div>
<?php get_footer();