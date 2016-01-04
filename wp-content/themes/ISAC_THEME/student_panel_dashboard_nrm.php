<?php
/* Template Name: student_panel_dashboard  */
if($_SESSION['SESS_MEMBER_GROUP_TYPE']=='GROUP')
{
	header('LOCATION:student_panel_dashboard_group');
}
else if($_SESSION['SESS_MEMBER_PARTNER_TYPE']=='PARTNER')
{
	header('LOCATION:student_panel_dashboard_partner');
	
}
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
if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '')) 
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
else 
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
		$date = $user_details['date'];
		$month = $user_details['month'];
		$year = $user_details['year'];
		$gender = $user_details['gender'];
		$isac_id = $user_details['isacid'];
		$group_id = $user_details['group_id_isac'];
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
 <!-- <a href="register-update"><img src="<?php bloginfo('template_url'); ?>/images/btn_edit_details.jpg"  border="0" class="btn_apply_stu" title="APPLY FOR A PROGRAM" /></a>
  <a href="programs"><img src="<?php bloginfo('template_url'); ?>/images/btn_browse_programs.jpg" class="btn_apply_stu" title="BROWSE PROGRAMS" border="0" /></a>
<a href="application"><img src="<?php bloginfo('template_url'); ?>/images/button_apply_program.jpg" class="btn_apply_stu" title="APPLY FOR A PROGRAM" border="0" /></a>-->
 <ul>
  <li><a href="<?php SERVER_URL ?>register-update" title="Personal Information">Personal Information</a></li>
  <li>|</li>
  <li><a href="<?php SERVER_URL ?>programs" title="Browse Programs">Browse Programs</a></li>
  <li>|</li>
  <li><a href="<?php SERVER_URL ?>application" title="Apply a Program">Apply a Program</a></li>

  </ul>
        </div><br />
<br />

	<h1>WELCOME, <?php echo  $username; ?></h1><br /><br />
    
    <h2>Program Details</h2><br />
	<?php
	
	$query = "SELECT * FROM application WHERE isacid = '$isacid' ORDER BY id desc";
		$result = mysql_query($query);
		if(mysql_num_rows($result) == 0)
		{
			echo '<h2 style="color:#930; text-align:center"><b>You have no Programs.</b></h2> <br /><br /><br /><br />';
		}
		else
		{
			?>
	<table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
        <tr>
        	<th>Program Name</th>
            <th>Scholarship</th>
            <th>Duration</th>
            <th>Program Start Date</th>
            <th colspan="2" class="brn_n">&nbsp;</th>
        </tr>
        
		<?php 
		
        
			while($row=mysql_fetch_array($result))
			{ 
		   $formid_stu = $row['formid'];
			?>
			
			<tr>
				<td width="133"><?php echo $row['program']; ?></td>
				<td width="107">
					<?php 
						if ($row['scholarship_status'] == '')
							echo 'Not Applicable';
						else
							echo $row['scholarship_status'];
					?>
				</td>
				<td width="101"><?php echo $row['duration'].'&nbsp;'.'weeks' ?></td>
				<td width="135"><?php echo $row['arrival'] ?></td>
				
				<td width="161"><form name="student" action="<?php echo SERVER_URL; ?>payment_summary" method="post"> <input type="hidden" value="<?php echo $row['formid']; ?>" name="formid" /><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_pmt_details.png" name="Pay now" /></form></td>
				<td width="249" class="brn_n">
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
				<form name="student" action="<?php echo SERVER_URL; ?>flight_details_edit" method="post"> <input type="hidden" value="<?php echo $row['formid']; ?>" name="formid" /><input type="hidden" value="<?php echo $row['program']; ?>" name="program_name" /><input type="image" src="<?php bloginfo('template_url'); ?>/images/enter_details_1.jpg" name="" /></form>
			  <?php
				}
				else
				{
				?>
		<form name="student" action="<?php echo SERVER_URL; ?>flight_details" method="post"> <input type="hidden" value="<?php echo $row['formid']; ?>" name="formid" /><input type="hidden" value="<?php echo $row['program']; ?>" name="program_name" /><input type="image" src="<?php bloginfo('template_url'); ?>/images/enter_details.jpg" name="" /></form>
				<?php
				
				}// ending the flight details 
				?>
				</td>
			</tr>
		<?php
		  } // Your while loop here	
		
?>
    </table>
    <?php
		} //records count else condition
	?>
    <div> </div>
    <!-- middle box ends here --> 
    <div class="footer_new_isac">
  <?php // checking for flight details
	
	$sql_important = "SELECT * FROM application WHERE isacid ='$isac_id' ORDER BY id DESC LIMIT 0,3";
	$sql_important21 = "SELECT * FROM application WHERE isacid ='$isac_id' AND fee_first_installment ='PAID' ORDER BY id DESC LIMIT 0,1";
		    $result_important = mysql_query($sql_important);
			if(mysql_num_rows($result_important))
			{
				$flag = '1';
			}
			else
			{
				$flag = '0';
			}

			// for the essential reading
		    $result_important12 = mysql_query($sql_important21);
			while($row_joining12 = mysql_fetch_array($result_important12))
			{
			   $registration_fee = $row_joining12['registration_fee'];
				$fi = $row_joining12['fee_first_installment'];
				$si = $row_joining12['fee_second_installment'];
				
				if($si == 'PAID')
					$si_status = 'PAID';
				else
					$si_status = 'NOPAID';
			}	
		
			?>
  <div class="footer_new_isac_box_footer">
  <h2>ESSENTIAL READING</h2>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Glimpse-CultureShock</div>
    <div class="footer_new_isac_right">
    <?php 
	if($fi=='PAID')
	{
		echo '<a href="http://indiastudyabroad.org/documents/2nd_inst/Glimpse-CultureShock.pdf" target="_blank">DOWNLOAD</a>';
	}
	else
	{
		echo 'LOCKED';
	}
	 ?>
    </div>
  </div>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">ISAC handbook</div>
    <div class="footer_new_isac_right">
     <?php 
	if($fi=='PAID')
	{
		echo '<a href="http://indiastudyabroad.org/documents/2nd_inst/ISAC_handbook.doc" target="_blank">DOWNLOAD</a>';
	}
	else
	{
		echo 'LOCKED';
	}
	 ?>
    </div>
  </div>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Program guide</div>
    <div class="footer_new_isac_right">   <?php 
	if($fi=='PAID')
	{
		echo '<a href="http://indiastudyabroad.org/documents/2nd_inst/PROGRAM_GUIDE -pre_departure.doc" target="_blank">DOWNLOAD</a>';
	}
	else
	{
		echo 'LOCKED';
	}
	 ?></div>
  </div>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Hindi phrasebook</div>
    <div class="footer_new_isac_right">   <?php 
	if($si_status=='PAID')
	{
		echo '<a href="http://indiastudyabroad.org/documents/third_inst_doc/Hindi_phrasebook.docx" target="_blank">DOWNLOAD</a>';
	}
	else
	{
		echo 'LOCKED';
	}
	 ?></div>
  </div>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Welcome letter</div>
    <div class="footer_new_isac_right"><?php 
	if($si_status=='PAID')
	{
		echo '<a href="http://indiastudyabroad.org/documents/third_inst_doc/WELCOME_LETTER.doc" target="_blank">DOWNLOAD</a>';
	}
	else
	{
		echo 'LOCKED';
	}
	 ?></div>
  </div>
  </div>
 <div class="footer_new_isac_box_footer ">
  <h2>IMPORTANT INFORMATION</h2>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Medical Form</div>
    <div class="footer_new_isac_right"><a href="http://indiastudyabroad.org/documents/third_inst_doc/MedicalFormv_1.doc" target="_blank">Download</a></div>
  </div>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left"></div>
    <div class="footer_new_isac_right"></div>
  </div>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left"></div>

</div>
  </div>
   <div class="footer_new_isac_box_footer no_border_right">
  <h2>MY HISTORY</h2>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Registered on ISAC</div>
    <div class="footer_new_isac_right">
	<?php
	// joining date 
	$sql_joining = "SELECT * FROM registration WHERE isacid ='$isac_id'";
            $result_joining = mysql_query($sql_joining);
			while($row_joining = mysql_fetch_array($result_joining))
			{
	        $dateofregistration = $row_joining['dateofregistration'];
			}	
			
	?>
	<?php echo $dateofregistration;  ?></div>
  </div>
  
   <?php
  while($row_important1 = mysql_fetch_array($result_important))
			{
		    
			 $formdate1 = $row_important1['formdate'];
			 $registration_fee1 = $row_important1['registration_fee'];
			 $first_installment1 = $row_important1['fee_first_installment'];
			 $second_installment1 = $row_important1['fee_second_installment'];
			?>
            <div class="footer_new_content_section">
    <div class="footer_new_isac_left"><?php echo $row_important1['program'];  ?></div>
    <div class="footer_new_isac_right"><?php echo $row_important1['formdate'];  ?></div>
   </div>
    <?php
	
			} // end 
	?>
  
  </div>
</div>
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
