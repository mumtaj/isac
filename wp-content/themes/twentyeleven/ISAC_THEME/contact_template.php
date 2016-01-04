<?php

/* Template Name: contact_template */

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
        
        <?php 
			global $post;
			if (have_posts()){
				while (have_posts())  
				{
					the_post();
					art_post_wrapper(
						array(
								'id' => art_get_post_id(), 
								'class' => art_get_post_class(),
								//'thumbnail' => art_get_post_thumbnail(),
								'title' => art_get_meta_option($post->ID, 'art_show_page_title') ? get_the_title() : '', 
								'before' => art_get_metadata_icons('edit', 'header'),
								'content' => art_get_content(), // 'content' => 'My post content',
								)
							);
					comments_template();
				}
				// previous_post_link | next_post_link
				// art_pagination(array('next_link' => art_get_previous_post_link('&laquo; %link'),'prev_link' => art_get_next_post_link('%link &raquo;')));
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
	
			?>
        
        
<form method="post" action="askme.php">
          <table width="600" height="345" border="0" cellspacing="0" cellpadding="0" class="marg_table">
            <tr>
              <td width="115" height="44">Name :</td>
              <td width="485"><input type="text" name="name" size="43"/></td>
            </tr>
            <tr>
              <td height="37">Email :</td>
              <td><input type="text" name="email" size="43"/></td>
            </tr>
            <tr>
              <td height="42">Telephone no :</td>
              <td><input type="text" name="tel" size="43"/></td>
            </tr>
            <tr>
              <td height="94" style="vertical-align:top"><br />
                <br />
                Address :</td>
              <td><textarea name="address" cols="34" rows="4"></textarea></td>
            </tr>
            <tr>
              <td height="90" style="vertical-align:top"><br />
                <br />
                Query :</td>
              <td><textarea name="query" cols="34" rows="4"></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td></td>
              <td><input value="Submit" type="submit" class="btn"/>&nbsp;</td>
            </tr>
          </table>
          </form>
   </div>
   
   <div class="art-layout-cell art-sidebar1">
          <?php get_sidebar('default'); ?>
          <div class="cleared"></div>
        </div>
    </div>
</div>
  

<?php get_footer();
?>
