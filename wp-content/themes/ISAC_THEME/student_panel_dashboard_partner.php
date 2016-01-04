
<?php

/* Template Name: student_panel_dashboard_partner  */

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


?>



<div id="art-page-background-glare">
    <div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content" >
        <!-- Start form --->
 <div class="summary_form reg top_spacing" style="margin-top:15px !important">
  <div class="rht_tab">
 <!-- <a href="register-update"><img src="<?php bloginfo('template_url'); ?>/images/btn_edit_details.jpg"  border="0" class="btn_apply_stu" title="APPLY FOR A PROGRAM" /></a>
  <a href="programs"><img src="<?php bloginfo('template_url'); ?>/images/btn_browse_programs.jpg" class="btn_apply_stu" title="BROWSE PROGRAMS" border="0" /></a>
<a href="application"><img src="<?php bloginfo('template_url'); ?>/images/button_apply_program.jpg" class="btn_apply_stu" title="APPLY FOR A PROGRAM" border="0" /></a>-->
 <ul>
  <li><a href="create_partner_group" title="Create a group">Please create your group</a></li>
  </ul>
        </div><h1 style="color:#930">Partner Name: <?php echo  $partnername; ?></h1><h2 class="fonts_h2_headlines">Program Details</h2><br />

	<?php 
        $query = "SELECT * FROM partner WHERE isacid = '$isacid' AND partner_id = '$partnerid' ORDER BY id desc";
        $result = mysql_query($query);
		if(mysql_num_rows($result) == 0)
		{
			echo '<h2 style="color:#930; text-align:center"><b>You have no Groups.</b></h2> <br /><br /><br /><br />';
		}
		else
		{
		?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
        <tr>
        	<th>Group Name</th>
            <th>Total Members</th>
            <th>Payment Status</th>
            <th>Payment Details</th>
            <th class="brn_n">View</th>
        </tr>
        
		<?php 
         
        while($row=mysql_fetch_array($result))
        { 
       $formid_stu = $row['formid'];
        ?>
        
        <tr>
            <td width="160"><?php echo $row['group_name']; ?></td>
            <td width="100"><?php echo $row['total_members']; ?></td>
            <td width="100"><?php echo $row['paid_status']; ?></td>
            <td width="160">
            	<form name="student" action="<?php echo SERVER_URL; ?>partner_group_payment_details" method="post"> 
                    <input type="hidden" value="<?php echo $row['group_id']; ?>" name="group_id" />
                    <input type="hidden" value="<?php echo $row['group_name']; ?>" name="group_name" />
                    <input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_pmt_details.png" name="Pay now" />
                </form>
           	</td>
            <td width="160" class="brn_n">
            	<form name="student" action="<?php echo SERVER_URL; ?>view_partner_group_members" method="post">
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
 <h2 class="fonts_h2_footer">Essential Reading</h2>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Glimpse-CultureShock</div>
    <div class="footer_new_isac_right">
    <?php 
	
		echo '<a href="http://indiastudyabroad.org/documents/2nd_inst/Glimpse-CultureShock.pdf" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
	
	 ?>
    </div>
  </div>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Pre-Departure Handbook</div>
    <div class="footer_new_isac_right">
     <?php 
	echo '<a href="http://indiastudyabroad.org/documents/2nd_inst/Pre-Departure Handbook v1.2.pdf" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
	 ?>
    </div>
  </div>
  <!--<div class="footer_new_content_section">
    <div class="footer_new_isac_left">Program guide</div>
    <div class="footer_new_isac_right">   <?php 
		//echo '<a href="http://indiastudyabroad.org/documents/2nd_inst/PROGRAM_GUIDE-pre_departure.pdf" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
	
	 ?></div>
  </div>-->
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Hindi phrasebook</div>
    <div class="footer_new_isac_right">   <?php 
		echo '<a href="http://indiastudyabroad.org/documents/third_inst_doc/Hindi_phrasebook.docx" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
	
	 ?></div>
  </div>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Welcome letter</div>
    <div class="footer_new_isac_right"><?php 
	echo '<a href="http://indiastudyabroad.org/documents/third_inst_doc/WELCOME_LETTER.pdf" target="_blank" style="color:#AC5419">DOWNLOAD</a>';
	
	 ?></div>
  </div>
  </div>
 <div class="footer_new_isac_box_footer ">
  <h2 class="fonts_h2_footer">Important Information</h2>
  <div class="footer_new_content_section">
    <div class="footer_new_isac_left">Medical Form</div>
    <div class="footer_new_isac_right"><a href="http://indiastudyabroad.org/documents/third_inst_doc/MedicalFormv_1.doc" target="_blank" style="color:#AC5419">Download</a></div>
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
		echo $date[0];  ?></div>
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
}
get_footer(); 
?>
