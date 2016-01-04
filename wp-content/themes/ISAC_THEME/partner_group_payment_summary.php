
<?php

/* Template Name: partner_group_payment_summary  */

?>

 <?php get_header();
 
 //Connect to mysql server
$dblink = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$dblink) {
	die('Failed to connect to server: ' . mysql_error());
}

//Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
	die("Unable to select database");
}


if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '' || $_SESSION['SESS_MEMBER_PARTNER_TYPE'] != 'PARTNER')) {
	
	?>

<div id="art-page-background-glare">
<div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
        <!-- Start form --->
 <div class="left_sect reg lft" style="margin-top:35px; margin-bottom:35px;">
  <div class="top_spacing">
      <table width="450" border="0" cellspacing="0" cellpadding="0"  align="center">
    <tr>
      <td width="540"></td>
    </tr>
  <tr>
    <td height="35" align="center">
      <span style="color:#F00; font-size:18px; text-align:center"><strong>ACCESS DENIED. <br />

Kindly Register/login to continue.</strong></span><br />
<br />

      <div class="btn_cent"><a href="registration-option"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg" border="0"  /></a>&nbsp; &nbsp; <a href="student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" border="0"  /></a></div>
    </td>
  </tr>
  

  
  </table>
    </div>

    <!-- middle box ends here --> 
  </div>
<!--END FORM-->
			<?php
			get_sidebar('bottom'); 
			?>
          <div class="cleared"></div>
        </div>
    </div>
</div>
<div class="cleared"></div>


<?php

} 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_SESSION['SESS_MEMBER_PARTNER_TYPE']=='PARTNER' && $_SESSION['SESS_MEMBER_ID']!='')
{

$isacid = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['SESS_FIRST_NAME'] ;
$partnerid = $_SESSION['SESS_MEMBER_PARTNER_ID'];
$partnername = $_SESSION['SESS_MEMBER_PARTNER_NAME'];

if($_POST['group_id'] != '')
{
	$group_id = $_POST['group_id'];
	$_SESSION['SESS_PARTNER_GROUP_ID'] = $group_id;
}
else
{
	$group_id = $_SESSION['SESS_PARTNER_GROUP_ID'];
}

$partner_sql = "SELECT * FROM partner WHERE isacid = '$isacid' AND group_id = '$group_id' AND partner_id = '$partnerid'";
$partner_result = mysql_query($partner_sql);
$partner_row =  mysql_fetch_array($partner_result);

?>

<br />
<div id="art-page-background-glare">
    <div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
        <!-- Start form --->
 <div class="summary_form reg top_spacing">
  <div class="rht_tab">

 <ul>
  <li><a href="create_partner_group" title="Create a group">Create a group</a></li>
          <li>|</li>
        <li><a href="student_panel_dashboard_partner" title="My Groups">My Groups</a></li>
  </ul>
        </div>
     <h2 class="fonts_h2_headlines" style="width:900px !important">Group Name: <?php echo $partner_row['group_name']; ?></h2> <br /><br />
    <h2>Total cost: $<?php echo $_POST['total_fee']; ?></h2><br />

	<?php 
        $query = "SELECT * FROM application WHERE group_id = '$group_id' AND partner_id = '$partnerid' ORDER BY id desc";
        $result = mysql_query($query);
		
		?>

	<?php 
			get_sidebar('top'); 
			global $post;
			if (have_posts()){
				while (have_posts())  
				{
					the_post();
					art_post_wrapper(
						array(
								'id' => art_get_post_id(), 
								'class' => art_get_post_class(),
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
    
  </div>
<!--END FORM-->
		
          <div class="cleared"></div>
        </div>
    </div>
</div>
<div class="cleared"></div>
<br />
<?php 
}
get_footer(); 
?>
