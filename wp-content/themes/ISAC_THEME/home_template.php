<?php

/* Template Name: HOME PAGE */

?>

<?php get_header(); ?>

<div id="art-page-background-glare">
    <div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">

<div style="height:397px;width:940px;background-image:url(<?php bloginfo('template_url'); ?>/images/themeBG.jpg);padding:12px">
       <?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?></div>
<div class="art-content-layout">
 
    <div class="art-content-layout-row">
    
        <div class="art-layout-cell art-content">
   <!-- place the code here   -->
   <div class="left_sect">
<div class="news_u">
 <h2>News and Updates</h2>
              <!-- Box Starts here -->
		<?php
    	
			 query_posts('cat=4&amp;showposts='. '&showposts=2'); ?>
		<?php while (have_posts()) : the_post();
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
		?>
		<div class="box_mid top_marg">
        <div style="float:left;margin-right:5px;">
			<?php if ( has_post_thumbnail() ) {  ?>
                <?php if ($xs_enable_timthumb == "true") { ?>
                  	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/timthumb/timthumb.php?src=<?php echo $thumbnail[0]; ?>&amp;h=70&amp;w=70" height="70" width="70" alt="<?php the_title(); ?>" /> </a>
				<?php } else { ?>
   	     			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbnail[0]; ?>" width="70" height="70" alt="<?php the_title(); ?>"  /> </a></div>
                 <?php } } ?>
                
        <div > <p><?php echo get_the_twitter_excerpt().'...' ?>	</p></div>
  <a href="news" title="<?php the_title(); ?>" class="link"> read more »</a>
<!-- /xs-read-more -->
			
            </div>
		<?php endwhile; wp_reset_query(); ?>
        </div>
        <!-- END first column -->
        
        <div class="news_u">
 <h2>Testimonials</h2>
              <!-- Box Starts here -->
		<?php
    	
			 query_posts('cat=5&amp;showposts='. '&showposts=2'); ?>
		<?php while (have_posts()) : the_post();
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
		?>
		<div class="box_mid top_marg">
        <div style="float:left;margin-right:5px;">
			<?php if ( has_post_thumbnail() ) {  ?>
                <?php if ($xs_enable_timthumb == "true") { ?>
                  	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/timthumb/timthumb.php?src=<?php echo $thumbnail[0]; ?>&amp;h=70&amp;w=70" height="70" width="70" alt="<?php the_title(); ?>" /> </a>
				<?php } else { ?>
   	     			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbnail[0]; ?>" width="70" height="70" alt="<?php the_title(); ?>"  /> </a></div>
                 <?php } } ?>
                
        <div > <p><?php echo get_the_twitter_excerpt().'...' ?></p></div>
  <a href="about/testimonials/" title="<?php the_title(); ?>" class="link"> read more »</a>
<!-- /xs-read-more -->
			
            </div>
		<?php endwhile; wp_reset_query(); ?>
        </div>
        <!-- END SECOND -->
        </div>
   <!-- END code for first block -->
   </div>
   
   <div class="art-layout-cell art-sidebar1">
          <?php get_sidebar('default'); ?>
          <div class="cleared"></div>
        </div>
    </div>
</div>
  

<?php get_footer();
?>
