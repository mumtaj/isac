<?php define( 'WORDPRESS_BASE', realpath(dirname(__FILE__) ));
define( 'DS', DIRECTORY_SEPARATOR );
 
include ( WORDPRESS_BASE.DS.'wordpress'.DS.'wp-blog-header.php' );

?>
<?php get_header(); ?>
<!– Put here your personal contents in HTML or PHP –>
…
<!– End personal contents –>
<?php get_sidebar(); ?>
<?php get_footer(); ?>