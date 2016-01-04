<?php
function customError($errno, $errstr)
  {
  echo "<b>Error:</b> [$errno] $errstr<br />";
//  echo "Ending Script";
  } 

//set_error_handler("customError");


/* Template Name: student_panel_dashboard  */

if(!empty($_SESSION['SESS_MEMBER_GROUP_TYPE']) && $_SESSION['SESS_MEMBER_GROUP_TYPE']=='GROUP')
{
	header('LOCATION:student_panel_dashboard_group');
}
else if(!empty($_SESSION['SESS_MEMBER_PARTNER_TYPE']) && $_SESSION['SESS_MEMBER_PARTNER_TYPE']=='PARTNER')
{
	header('LOCATION:student_panel_dashboard_partner');
	
}
//get_header();

	//Connect to mysql server

get_header();
 
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
      <table width="510" border="0" cellspacing="0" cellpadding="0"  align="center" >
    <tr>
      <td width="475"></td>
    </tr>
  <tr>
    <td height="35" align="center">
 <div class="btn_cent" style="margin-top:5px;font-size:14px !important">
  <h2 class="fonts_h2_headlines_next" style="margin-bottom:10px !important">Kindly log in or register to access this section
   </h2>
   <p>
     If you have already registered with ISAC or attended a program with us, please use the username and password which has been sent to you</p>
 </div>
    <div class="btn_cent" style="margin-top:5px"><a href="<?php echo SERVER_URL; ?>student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" border="0"  /></a></div>  
       <div class="btn_cent" style="margin-top:10px;font-size:14px !important"><br />
         If you are new to ISAC, please register to continue.</div>
 <div class="btn_cent" style="margin-top:5px"><a href="<?php echo SERVER_URL; ?>register"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg" border="0"  /></a></div> 
 <div class="btn_cent" style="margin-top:5px">
   <p><span class="btn_cent" style="margin-top:5px"><span class="btn_cent" style="margin-top:10px"><br />
     If you have already registered with us</span> but forgotten your password,</span></p>
   <p><span class="btn_cent" style="margin-top:5px;font-size:14px !important">please <a href="<?php echo SERVER_URL; ?>forgot-password">click here</a> to retrieve your password.</span></p>
 </div>      
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
	$groupid = (!empty($_SESSION['SESS_MEMBER_GROUP_ID'])) ? $_SESSION['SESS_MEMBER_GROUP_ID'] : '';
	



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
		$fill_flag = $user_details['flag'];
		$flag_fill_1 = $user_details['flag2'];
		$group_isac = $user_details['group_isac'];
		$flag_prinfo = $user_details['flag_prinfo'];
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

<?php if($fill_flag != 1 || $flag_fill_1 != 1 || $group_isac == ' ') { ?>
 <span style="color:red;margin-left:50px"><img src="<?php bloginfo('template_url'); ?>/images/personalinfo.png" /></span> <?php }

elseif(($group_isac=='GROUP_MEMBER' && $flag_prinfo != 1) || $fill_flag != 1 || $flag_fill_1 != 1)
 {
	 ?>
	  <span style="color:red;margin-left:50px"><img src="<?php bloginfo('template_url'); ?>/images/personalinfo.png" /></span>
      <?php
	  
 }
  else
 {
	 
 }
  ?>
 <ul>
  <li>
  <?php
  if($group_isac=='GROUP_MEMBER')
  {
  ?>
  <a href="<?php SERVER_URL ?>register-update" title="Personal Information">Personal Information</a>
  <?php
  }
  else
  {
  ?>
  <a href="<?php SERVER_URL ?>educational_work_details" title="Personal Information">Personal Information</a>
  <?php
  }
  
  ?>
  </li>
  <li>|</li>
  <li><a href="<?php SERVER_URL ?>programs" title="Browse Programs">Browse Programs</a></li>
  <li>|</li>
  <li><a href="<?php SERVER_URL ?>application" title="Apply a Program">Apply for a Program</a></li>

  </ul>
        </div>

	<h1 style="color:#930">Welcome <?php echo  $username; ?></h1><br />
    
    <h2 class="fonts_h2_headlines">Program Details</h2><br />
	<?php
	
	$query = "SELECT * FROM application WHERE isacid = '$isacid' ORDER BY id desc";
		$result = mysql_query($query);
		if(mysql_num_rows($result) == 0)
		{
			echo '<h2 style="text-align:center"><b style=color:#666 important!" >You do not have any Programs, kindly <a style="color:#930;" href="'.SERVER_URL.'application">apply</a> for a program.</b></h2> <br /><br /><br /><br />';
		}
		else
		{
			?>
           
	<table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
        <tr>
        	<th>Program Name</th>
            <th>Scholarship</th>
            <th width="96">Group Name</th>
            <th>Duration</th>
            <th>Program Start Date</th>
            <th >Amount Paid (In USD)</th>
            <th >Next Installment Due (In USD)</th>
            <th>Payment status</th>
            <th class="brn_n">Flight Details
            <div style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; height:3px;"></div>
            <a   href="<?=SERVER_URL;?>what-is-flight-details" target="_blank" class="helplink">What's this?</a>
            </th>
          
        </tr>
        
		<?php 
		
        
			while($row=mysql_fetch_array($result))
			{ 
		   $formid_stu = $row['formid'];
		$reg_fee_stauts = $row['registration_fee'];
		$firstinstallement_status = $row['fee_first_installment'];        
		$secondinstallement_status = $row['fee_second_installment'];
		$due_installement_first = '300';
		$due_reg = '45';
		$final_payment = $row['second_installment'];
		if($reg_fee_stauts =='PAID' && $firstinstallement_status=='PAID' && $secondinstallement_status=='PAID')
		{
			$total_payment = ($due_reg + $due_installement_first + $final_payment );
			$total_due_next_installement = '0';
		}
		elseif($reg_fee_stauts =='PAID' && $firstinstallement_status=='PAID' && $secondinstallement_status!='PAID')
		{
			$total_payment = ($due_reg + $due_installement_first);
			$total_due_next_installement = $final_payment;
			
		}
		elseif($reg_fee_stauts =='PAID' && $firstinstallement_status!='PAID' && $secondinstallement_status!='PAID')
		{
			$total_payment = $due_reg;
			$total_due_next_installement = $due_installement_first;
			
		}
		elseif($reg_fee_stauts !='PAID' && $firstinstallement_status!='PAID' && $secondinstallement_status!='PAID')
		{
			$total_payment = '0';
			$total_due_next_installement = $due_reg;
			
		}
			?>

			<tr>
				<td width="127"><?php echo $row['program']; ?></td>
				<td width="110">
					<?php 
						if ($row['scholarship_status'] == '')
							echo 'Not Applicable';
						else
							echo $row['scholarship_status'];
					?>
				</td>
                <td>
<?php
$group_name = (trim($row['isac_groupname']) != '') ? "<a href='view-group-members/?view_members=".base64_encode(trim($row['group_id']))."' style='color:#AC5419;'>".$row['isac_groupname']."</a>" : 'Not Applicable';  //nrm		?>				
				<?=$group_name;?></td>
				<td width="75"><?php echo $row['duration'].'&nbsp;'.'weeks' ?></td>
				<td width="115"><?php echo $row['arrival'] ?></td>
				
				<td width="94"><?php echo $total_payment;   ?></td>
				<td width="94"><?php echo $total_due_next_installement;   ?></td>
				<td width="137"><form name="student" action="<?php echo SERVER_URL; ?>payment_summary" method="post"> <input type="hidden" value="<?php echo $row['formid']; ?>" name="formid" /><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_pmt_details1.jpg" name="Pay now" /></form></td>
				<td width="80" class="brn_n">
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
				<form name="student" action="<?php echo SERVER_URL; ?>flight_details_edit" method="post"> <input type="hidden" value="<?php echo $row['formid']; ?>" name="formid" /><input type="hidden" value="<?php echo $row['program']; ?>" name="program_name" /><input type="image" src="<?php bloginfo('template_url'); ?>/images/f2.png" name="" title="EDIT YOUR FLIGHT DETAILS" /></form>
			  <?php
				}
				else
				{
				?>
		<form name="student" action="<?php echo SERVER_URL; ?>flight_details" method="post"> <input type="hidden" value="<?php echo $row['formid']; ?>" name="formid" /><input type="hidden" value="<?php echo $row['program']; ?>" name="program_name" /><input type="image" src="<?php bloginfo('template_url'); ?>/images/f1.png" name=""  title="ENTER YOUR FLIGHT DETAILS"/></form>
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
 <h2 class="fonts_h2_footer">Essential Reading  
            <a   href="<?=SERVER_URL;?>what-is-essential-reading" target="_blank" class="helplink">What's this?</a></h2>
 
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Glimpse-CultureShock</div>
    <div class="footer_new_isac_right">
    <?php 
	if($fi=='PAID')
	{
		echo '<a   href="http://indiastudyabroad.org/documents/2nd_inst/Glimpse-CultureShock.pdf" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
	}
	else
	{
		echo 'LOCKED';
	}
	 ?>
    </div>
  </div>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Pre-Departure Handbook</div>
    <div class="footer_new_isac_right">
     <?php 
	if($fi=='PAID')
	{
		echo '<a href="http://indiastudyabroad.org/documents/2nd_inst/Pre-Departure Handbook v1.2.pdf" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
	}
	else
	{
		echo 'LOCKED';
	}
	 ?>
    </div>
  </div>
  <!--<div class="footer_new_content_section">
    <div class="footer_new_isac_left">Program guide</div>
    <div class="footer_new_isac_right">   <?php 
	/*if($fi=='PAID')
	{
		echo '<a href="http://indiastudyabroad.org/documents/2nd_inst/PROGRAM_GUIDE-pre_departure.pdf" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
	}
	else
	{
		echo 'LOCKED';
	}*/
	 ?></div>
  </div>-->
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Hindi phrasebook</div>
    <div class="footer_new_isac_right">   <?php 
	if($si_status=='PAID')
	{
		echo '<a href="http://indiastudyabroad.org/documents/third_inst_doc/Hindi_phrasebook.docx" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
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
		echo '<a href="http://indiastudyabroad.org/documents/third_inst_doc/WELCOME_LETTER.pdf" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
	}
	else
	{
		echo 'LOCKED';
	}
	 ?></div>
  </div>
  </div>
 <div class="footer_new_isac_box_footer ">
  <h2 class="fonts_h2_footer">Important Information</h2>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Medical Form
     <div style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; height:3px;"></div>
            <a   href="<?=SERVER_URL;?>what-is-medical-information" target="_blank" class="helplink">What's this?</a>
    </div>
    
    <div class="footer_new_isac_right"><a href="http://indiastudyabroad.org/documents/third_inst_doc/MedicalFormv_1.doc" target="_blank" style="color:#AC5419">Download</a></div>
    
  <?php if($fill_flag != 1) { ?>  <div><br /><br /><br />
 <span style="color:red; float:left">It is critical to fill in your personal information</span> </div><?php } ?>
   
    
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
  <h2 class="fonts_h2_footer">My History</h2>
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
	<?php $date = explode(" ",$dateofregistration);
		echo $date[0]; ?></div>
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
    <div class="footer_new_isac_right"><?php 
			$date01 = explode(" ",$row_important1['formdate']);
			echo $date01[0];
		  ?></div>
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
mysql_close($dblink);

get_footer(); 
?>
