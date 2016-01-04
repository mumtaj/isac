<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.ie6.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.ie7.css" type="text/css" media="screen" /><![endif]-->
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
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body <?php if(function_exists('body_class')) body_class(); ?>>
 
  <div class="custom_logo">
  <img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" width="488" height="76" /></div>
<div class="art-header">
           <div class="header_isac">
           
                <?php if(art_get_option('art_header_show_headline')): ?>
                <h1 id="name-text" class="art-logo-name"><a href="<?php  echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
                <?php endif; ?>
                <?php if(art_get_option('art_header_show_slogan')): ?>
                    <h2 id="slogan-text" class="art-logo-text"><?php // bloginfo('description'); ?></h2>
                <?php endif; ?>
           </div>
            </div>
            <div class="art-nav">
            <div class="nav_isac_middle">
            	<div class="l"></div>
            	<div class="r"></div>
            	<ul class="art-menu">
            		<?php echo art_get_menu(art_get_option('art_menu_source'), art_get_option('art_menu_depth'), 'primary-menu'); ?>
            	</ul>
                </div>
            </div>
