
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
<link href="<?php bloginfo('template_url'); ?>/css/style.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.ie6.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.ie7.css" type="text/css" media="screen" /><![endif]-->


<?php
if ( is_page_template('isac_template.php')) { ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style.css" />
<?php } ?>


<?php if(WP_VERSION < 3.0): ?>
<link rel="alternate" type="application/rss+xml" title="<?php printf(__('%s RSS Feed', THEME_NS), get_bloginfo('name')); ?>" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php printf(__('%s Atom Feed', THEME_NS), get_bloginfo('name')); ?>" href="<?php bloginfo('atom_url'); ?>" />
<?php endif; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if (is_file(TEMPLATEPATH .'/favicon.ico')):?>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
<?php endif; ?>
<?php
remove_action('wp_head', 'wp_generator');
wp_enqueue_script('jquery');
if ( is_singular() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/script.js"></script>
<link href="<?php bloginfo('template_url'); ?>/css/style.css" rel="stylesheet" type="text/css" />
<!--<link href="<?php bloginfo('template_url'); ?>/css/screen.css" rel="stylesheet" type="text/css" media="all" />-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/js/gen_validatorv4.js" type="text/javascript" ></script>


</head>

<body <?php if(function_exists('body_class')) body_class(); ?>>
 

  
<div class="art-header">
           <div class="header_isac">
             <a href="<?php echo SERVER_URL; ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" width="488" height="76" border="0" /></a>
             
             <div id="search">
             <?php
		if($_SESSION['SESS_USER_TYPE'] != '')
		{
		?>
	  <a href='<?php echo SERVER_URL; ?>logout'> <img src='<?php bloginfo('template_url'); ?>/images/btn_logout.jpg' width='91' height='28' border='0' class='btn_apply' /> </a> <a href='<?php echo SERVER_URL; ?>application'> <img src='<?php bloginfo('template_url'); ?>/images/btn_applynow.jpg' width='91' height='28' border='0' class='btn_apply' /> </a>
      <?php
		}
	  else
	  {
      ?>
	  <a href='<?php echo SERVER_URL; ?>student-login'> <img src='<?php bloginfo('template_url'); ?>/images/btn_login.jpg' width='91' height='28' border='0' class='btn_apply' /> </a>  
	   <a href='<?php echo SERVER_URL; ?>apply_reg_option/'> <img src='<?php bloginfo('template_url'); ?>/images/btn_applynow.jpg' width='91' height='28' border='0' class='btn_apply' /> </a>  
	    <a href='<?php echo SERVER_URL; ?>registration-option/'> <img src='<?php bloginfo('template_url'); ?>/images/btn_register.jpg' width='91' height='28' border='0' class='btn_apply' /> </a>
	  <?php
      }
	  ?>
           </div>
        
           </div>
           
            </div>
            <div class="art-nav">
            <div class="nav_isac_middle">
            	<div class="l"></div>
            	<div class="r"></div>
            	<ul class="art-menu">
            		<?php echo art_get_menu(art_get_option('art_menu_source'), art_get_option('art_menu_depth'), 'primary-menu'); ?>
                    
                   <!-- Header image code added -->
                  
              </ul>
                
                </div>
                  <div style="margin-left:auto; margin-right:auto; width:990px;">
                  
                  
                 <?php 
               
   echo get_post_meta($post->ID, "url", true); the_post_thumbnail(); 


                  ?>
					<?php  
					
				
					
					
					?>
            	</div>
                               <!--end  Header image code added -->
            </div>
