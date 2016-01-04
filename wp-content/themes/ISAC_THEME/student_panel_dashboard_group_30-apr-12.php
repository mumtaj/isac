<?php
/* Template Name: student_panel_dashboard_group  */
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


if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '' || $_SESSION['SESS_MEMBER_GROUP_TYPE']!='GROUP')) {
	
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
	$date = $user_details['date'];
	$month = $user_details['month'];
	$year = $user_details['year'];
	$gender = $user_details['gender'];
	$isac_id = $user_details['isacid'];
	$group_id = $user_details['group_id_isac'];
	
}

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
  <li><a href="my_groups" title="My Groups">My Groups</a></li>
  <li>|</li>
  <li><a href="register-update" title="Personal Information">Personal Information</a></li>
  <li>|</li>
  <li><a href="programs" title="Browse Programs">Browse Programs</a></li>
  <li>|</li>
  <li><a href="application" title="Apply a Program">Apply a Program</a></li>

  </ul>
        </div><br />
<br />

	<h1>WELCOME, <?php echo  $username; ?></h1><br /><br />
    
    

	<?php 
       	$query = "SELECT * FROM application WHERE isacid = '$isacid' AND partner_id = '' ORDER BY id desc";
        $result = mysql_query($query);
		
		if(mysql_num_rows($result) == 0)
		{
			echo '<h2 style="color:#930; text-align:center"><b>You have no Programs.</b></h2> <br /><br /><br /><br />';
		}
		else
		{
			$group_data = array();
			$individual_data = array();
			
			while($row=mysql_fetch_array($result))
			{
				$row_formid = $row['formid'];
				
				$sql_details = "SELECT * FROM arrival_flight WHERE formid='$row_formid'";
				$result_details = mysql_query($sql_details);
				$row_details = mysql_fetch_array($result_details);
				
				$formid_flight = $row_details['formid'];
	
				if($formid_flight == $row_formid)
					$flight_details_flag = 'done'; 
				else
					$flight_details_flag = 'not_done'; 
				
				
				
				if($row['group_id'] != '')
				{
					array_push($group_data, array('formid'=>$row['formid'], 'program'=>$row['program'], 'duration'=>$row['duration'], 'arrival'=>$row['arrival'],
														 'isac_groupname'=>$row['isac_groupname'], 'flight_details_flag'=>$flight_details_flag));
				}
				else
				{
					array_push($individual_data, array('formid'=>$row['formid'], 'program'=>$row['program'], 'duration'=>$row['duration'], 'arrival'=>$row['arrival'],
														'flight_details_flag'=>$flight_details_flag ));
				}
			} //While Closed
			
						
			$individual_data_count = count($individual_data);
			$group_data_count = count($group_data);
			
			if($group_data_count != '')
			{
				?>
                <h2>Group Program Details</h2>
                <table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
                <tr>
                    <th>Program Name</th>
                    <th>Group Name</th>
                    <th>Duration</th>
                    <th>Program Start Date</th>
                    <th colspan="2" class="brn_n">&nbsp;</th>
                </tr>
                <?php
				foreach ($group_data as $group)
				{
					?>
                    	<tr>
                        <td width="153"><?php echo $group['program']; ?></td>
                        <td width="101"><?php echo $group['isac_groupname']; ?></td>
                        <td width="101"><?php echo $group['duration']; ?></td>
                        <td width="135"><?php echo $group['arrival']; ?></td>
                        
                        <td width="161">
                        	<form name="student" action="<?php echo SERVER_URL; ?>payment_summary" method="post"> 
                            	<input type="hidden" value="<?php echo $group['formid']; ?>" name="formid" />
                                <input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_pmt_details.png" name="Pay now" />
                           	</form>
                       	</td>
                        <td width="200" class="brn_n">
                        
						<?php // checking for group_data flight details
							if($group['flight_details_flag'] == 'done')
							{
							?>
								<form name="student" action="<?php echo SERVER_URL; ?>flight_details_edit" method="post"> 
									<input type="hidden" value="<?php echo $group['formid']; ?>" name="formid" />
									<input type="hidden" value="<?php echo $group['program']; ?>" name="program_name" />
									<input type="image" src="<?php bloginfo('template_url'); ?>/images/enter_details_1.jpg" name="" />
								</form>
						  	<?php
							}
							else
							{
							?>
								<form name="student" action="<?php echo SERVER_URL; ?>flight_details" method="post"> 
									<input type="hidden" value="<?php echo $group['formid']; ?>" name="formid" />
									<input type="hidden" value="<?php echo $group['program']; ?>" name="program_name" />
									<input type="image" src="<?php bloginfo('template_url'); ?>/images/enter_details.jpg" name="" />
								</form>
							<?php
							
							}// ending the group_data flight details 
                        ?>
                        </td>
                    </tr>
                    <?php
				}//$group_data foreach close
				?>
                </table>
                <br /><br />
                <?php
			}//$group_data If Condition
			
			if($individual_data_count != '')
			{
				?>
                <h2>Individual Program Details</h2>
                <table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
                <tr>
                    <th>Program Name</th>
                    <th>Duration</th>
                    <th>Program Start Date</th>
                    <th colspan="2" class="brn_n">&nbsp;</th>
                </tr>
                <?php
				foreach ($individual_data as $individual)
				{
					?>
                    	<tr>
                        <td width="153"><?php echo $individual['program']; ?></td>
                        <td width="101"><?php echo $individual['duration']; ?></td>
                        <td width="135"><?php echo $individual['arrival']; ?></td>
                        
                        <td width="161">
                        	<form name="student" action="<?php echo SERVER_URL; ?>payment_summary" method="post"> 
                            	<input type="hidden" value="<?php echo $individual['formid']; ?>" name="formid" />
                                <input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_pmt_details.png" name="Pay now" />
                           	</form>
                       	</td>
                        <td width="200" class="brn_n">
                        
						<?php // checking for flight details
							if($individual['flight_details_flag'] == 'done')
							{
							?>
								<form name="student" action="<?php echo SERVER_URL; ?>flight_details_edit" method="post"> 
									<input type="hidden" value="<?php echo $individual['formid']; ?>" name="formid" />
									<input type="hidden" value="<?php echo $individual['program']; ?>" name="program_name" />
									<input type="image" src="<?php bloginfo('template_url'); ?>/images/enter_details_1.jpg" name="" />
								</form>
						  	<?php
							}
							else
							{
							?>
								<form name="student" action="<?php echo SERVER_URL; ?>flight_details" method="post"> 
									<input type="hidden" value="<?php echo $individual['formid']; ?>" name="formid" />
									<input type="hidden" value="<?php echo $individual['program']; ?>" name="program_name" />
									<input type="image" src="<?php bloginfo('template_url'); ?>/images/enter_details.jpg" name="" />
								</form>
							<?php
							
							}// ending the flight details 
                        ?>
                        </td>
                    </tr>
                    <?php
				}//$individual_data foreach close
				?>
                </table>
                <?php
			}//$individual_data If Condition
		}//Record count else close here
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
}
get_footer(); 
?>
