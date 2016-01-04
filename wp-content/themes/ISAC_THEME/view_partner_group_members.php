
<?php

/* Template Name: view_partner_group_members  */

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


/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';*/

if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '' || $_SESSION['SESS_MEMBER_PARTNER_TYPE'] != 'PARTNER')) {
	
	?>
 <link href="css/style.css" rel="stylesheet" type="text/css" />
 

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
 <!-- <a href="register-update"><img src="<?php bloginfo('template_url'); ?>/images/btn_edit_details.jpg"  border="0" class="btn_apply_stu" title="APPLY FOR A PROGRAM" /></a>
  <a href="programs"><img src="<?php bloginfo('template_url'); ?>/images/btn_browse_programs.jpg" class="btn_apply_stu" title="BROWSE PROGRAMS" border="0" /></a>
<a href="application"><img src="<?php bloginfo('template_url'); ?>/images/button_apply_program.jpg" class="btn_apply_stu" title="APPLY FOR A PROGRAM" border="0" /></a>-->
 <ul>
  <li><a href="create_partner_group" title="Create a group">Create a group</a></li>
          <li>|</li>
        <li><a href="student_panel_dashboard_partner" title="My Groups">My Groups</a></li>
  </ul>
        </div>
<h2>Group Name: <?php echo $partner_row['group_name']; ?></h2> 
    <h2 class="fonts_h2_headlines" style="width:900px !important">Program Details</h2>
	<?php 
        $query = "SELECT * FROM application WHERE group_id = '$group_id' AND partner_id = '$partnerid' ORDER BY id desc";
        $result = mysql_query($query);
		if(mysql_num_rows($result) == 0)
		{
			echo '<h2 style="color:#930; text-align:center"><b>You have no Group members.</b></h2> <br />';
		?>
			<div align="center">
			<form name="student" action="<?php echo SERVER_URL; ?>add_partner_group_members" method="post">
				<input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
				<input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_add_group_member.png" name="Add Your Group Members" />
			</form>
			</div>
			<br /><br /><br />
		<?php
		}
		else
		{
		?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
        <tr>
        	<th>First name</th>
            <th>Email</th>
           	<th>Program Name</th>
            <th>Duration</th>
            <th>Program Start Date</th>
            <th >Flight Details</th>
            <th class="brn_n">&nbsp;</th>
        
        </tr>
        
		<?php 
         
        while($row=mysql_fetch_array($result))
        { 
       $formid_stu = $row['formid'];
        ?>
        
        <tr>
           <td width="158"><?php echo $row['firstname']; ?></td>
           <td width="99"><?php echo $row['email']; ?></td>
           <td width="158"><?php echo $row['program']; ?></td>
           <td width="99"><?php echo $row['duration']; ?></td>
           <td width="102"><?php echo $row['arrival']; ?></td>
           
            <td width="245">
            <?php // checking for flight details
			$sql_details = "SELECT * FROM arrival_flight WHERE formid='$formid_stu'";
			$result_details = mysql_query($sql_details);
			while($row_details = mysql_fetch_array($result_details))
			{
			$formid_flight = $row_details['formid'];
			}
			if($formid_flight==$formid_stu)
			{
			?>
                <form name="student" action="<?php echo SERVER_URL; ?>flight_details_partner_edit" method="post"> 
                    <input type="hidden" value="<?php echo $row['formid']; ?>" name="formid" />
                    <input type="hidden" value="<?php echo $row['program']; ?>" name="program_name" />
                    <input type="image" src="<?php bloginfo('template_url'); ?>/images/f2.png" name="" />
                </form>
          <?php
			}
			else
			{
			?>
                <form name="student" action="<?php echo SERVER_URL; ?>flight_details_partner" method="post"> 
                    <input type="hidden" value="<?php echo $row['formid']; ?>" name="formid" />
                    <input type="hidden" value="<?php echo $row['program']; ?>" name="program_name" />
                    <input type="image" src="<?php bloginfo('template_url'); ?>/images/f1.png" name="" />
                </form>
            <?php
			
			}// ending the flight details 
			?>
            </td>
            <td width="83" class="brn_n">
            	<form name="student" action="<?php echo SERVER_URL; ?>add_partner_group_members" method="post">
                	<input type="hidden" value="<?php echo $row['group_id']; ?>" name="group_id" />
                    <input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_view.jpg" name="View" />
             	</form>
            </td>
        </tr>
	<?php
      } // Your while loop here			
		}//Record count else close here
?>
    </table>
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
}
get_footer(); 
?>
