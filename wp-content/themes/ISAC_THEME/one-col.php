<?php

/* Template Name: ONE COLUMNNNN */

?>








<?php get_header(); ?>

<div class="art-content-layout">

    <div class="art-content-layout-row">

        <div class="art-layout-cell art-content">

         <!--<div style="width:625px; height:15px;  background:#00F">

             </div>-->

    

 
  <div class="single_page">
 <div class="single_page_header">

	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

    </div>

    



              

       <div style="font-family:calibri; font-size:13px">      

   <?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

        <?php

		global $post;

		echo ($post->post_content);

        ?>

	<?php endwhile; ?>

<?php endif; ?>

</div>

            </div>

            

            

          <div class="cleared"></div>

        </div>

        

    </div>

</div>

<div class="cleared"></div>

<?php get_footer();