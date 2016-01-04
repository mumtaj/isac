<?php
/* Template Name: my_groups  */



get_header();
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
if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '') || $_SESSION['SESS_MEMBER_GROUP_TYPE']!='GROUP') 
{
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
elseif($_SESSION['SESS_MEMBER_GROUP_TYPE']=='GROUP' && $_SESSION['SESS_MEMBER_ID']!='') 
{
	$isacid = $_SESSION['SESS_MEMBER_ID'];
	$username = $_SESSION['SESS_FIRST_NAME'] ;
	$groupid = $_SESSION['SESS_MEMBER_GROUP_ID'];
	
	$reg_details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");
	
	
	while($user_details = mysql_fetch_array($reg_details))
	{
		$firstname = $user_details['firstname'];
		$lastname = $user_details['lastname'];
		$email = $user_details['email'];
		$isac_id = $user_details['isacid'];
	}
	
	$isacid = $_SESSION['SESS_MEMBER_ID'];

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
  <li><a href="my_groups" title="My Groups"><b>My Groups</b></a></li>
  <li>|</li>
  <li><a href="register-update" title="Personal Information">Personal Information</a></li>
<!--  <li>|</li>
  <li><a href="programs" title="Browse Programs">Browse Programs</a></li>
  <li>|</li>
  <li><a href="application" title="Apply a Program">Apply for a Program</a></li>-->

  </ul>
        </div>
     <h2 class="fonts_h2_headlines" style="width:900px">My Groups</h2>
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
  
    	<tr>
        	<td height="44"> </td>
            <td align="right" style="padding-top:5px !important">
            	<a href="create_group" title="Create Group"><img src="<?php bloginfo('template_url'); ?>/images/btn_create_group.png" /></a>
                
                 <div style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; height:3px;"></div>
            <a   href="<?=SERVER_URL;?>whats-this-create-a-group" target="_blank" class="helplink">What's this?</a>
            </td>
        </tr>
    </table>
    
    <br />
    
    <?php
	$query = "SELECT * FROM groups WHERE isacid = '$isacid' ORDER BY id desc";
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 0)
	{
		echo '<h2 style="text-align:center"><b style=color:#666 important!" >You do not seem to have any groups, Please  <a href="create_group" title="Create Group" style="color:#930;">Create a Group</a></b></h2> <br /><br /><br /><br />';
	}
	else
	{
	?>

	<table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
        <tr>
        	<th>Group Name</th>
            <th>Group Members</th>
            <th class="brn_n">Group Information</th>
        </tr>
        
		<?php 
        
        while($row=mysql_fetch_array($result))
        { 
        ?>
        
        <tr>
            <td width="133"><?php echo $row['group_name']; ?></td>
            <td width="107"><?php echo ($row['group_members']<1) ? '&nbsp; &nbsp; &nbsp; &nbsp;  0' : $row['group_members']; ?> <?php if($row['group_members']<1) { ?> &nbsp; <a href="javascript:;" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(1000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please add members to your group.</em></span><?php } ?></td>
                               
            <td width="161">
            	<form name="student" action="<?php echo SERVER_URL; ?>view_group_details" method="post">
                	<input type="hidden" value="<?php echo $row['group_id']; ?>" name="group_id" />
                    <input type="image" src="<?php bloginfo('template_url'); ?>/images/enter_button.jpg" name="View" />
             	</form>
           	</td>
        </tr>
	<?php
      } // Your while loop here			
?>
    </table>
    
    <?php
      } // Your while loop here			
?>
    <div> </div>
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
<br />
<?php 
} //Else if Condition

get_footer(); 
?>
