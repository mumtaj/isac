<?php
session_start();
require_once('config/config.php');

//require_once('auth.php');

	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.ie6.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.ie7.css" type="text/css" media="screen" /><![endif]-->


<?php
if ( is_page_template('isac_template.php')) { ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style.css" />
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
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
self.location='application?cat=' + val ;
}
function reload3(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 

self.location='application?cat=' + val + '&cat3=' + val2 ;
}

</script>
</head>

<body <?php if(function_exists('body_class')) body_class(); ?>>
 

  
<div class="art-header">
           <div class="header_isac">
             <a href="index.php"><img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" width="488" height="76" border="0" /></a>
             
             <div id="search">
             <?php
		if($_SESSION['SESS_USER_TYPE'] == 'ISACUSER11')
		{
		
	  echo "<a href='http://redigitalnow.com/blog_test/app1.php'> <img src='http://redigitalnow.com/blog_test/wordpress/images/btn_logout.jpg' width='91' height='28' border='0' class='btn_apply' /> </a> <a href='http://redigitalnow.com/blog_test/login.php'> <img src='http://redigitalnow.com/blog_test/wordpress/images/btn_applynow.jpg' width='91' height='28' border='0' class='btn_apply' /> </a>";
		}
	  else
	  {
      
	  echo " <a href='http://redigitalnow.com/blog_test/student_login.php'> <img src='http://redigitalnow.com/blog_test/wordpress/images/btn_login.jpg' width='91' height='28' border='0' class='btn_apply' /> </a>  
	   <a href='http://redigitalnow.com/blog_test/reg_pls.php'> <img src='http://redigitalnow.com/blog_test/wordpress/images/btn_applynow.jpg' width='91' height='28' border='0' class='btn_apply' /> </a>  
	    <a href='http://redigitalnow.com/blog_test/app1.php'> <img src='http://redigitalnow.com/blog_test/wordpress/images/btn_register.jpg' width='91' height='28' border='0' class='btn_apply' /> </a>";
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
               //   if ( is_home() ) {
  // echo "sushant";
//} else {
   echo get_post_meta($post->ID, "url", true); the_post_thumbnail(); 
//}
                  ?>
					<?php  
					
				//	echo get_post_meta($post->ID, "url", true); the_post_thumbnail(); 
					
					
					?>
            	</div>
                               <!--end  Header image code added -->
            </div>
