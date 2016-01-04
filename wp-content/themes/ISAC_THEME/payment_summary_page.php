<?php

/* Template Name: Payment_Summary_Page  */

?>

<?php

if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '')) {
	
	?>
<?php get_header(); ?>
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

      <div class="btn_cent"><a href="register"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg"  /></a>&nbsp; &nbsp; <a href="student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg"  /></a></div>
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
<?php get_footer();

} 


else { 


get_header(); 

require_once('config/config.php'); 


$isacid = $_SESSION['SESS_MEMBER_ID'];
$formid = $_POST['formid'];
//echo $formid;

$query = "SELECT * FROM application WHERE formid = '$formid'";
$result = mysql_query($query);

      
while($row=mysql_fetch_array($result))
{ 
	$isacid= $row['isacid'];
	$program = $row['program'];
	$formdate = $row['formdate'];
	$registration_fee = $row['registration_fee'];
	$local_language_mention = $row['local_language_mention'];
	$interested_in_program = $row['interested_in_program'];
	$your_expectations = $row['your_expectations'];
	$about_ISAC = $row['about_ISAC'];
	$formid = $row['formid'];
	$flag = $row['flag'];
	$first_installment = $row['first_installment'];
	$second_installment = $row['second_installment'];
	
	// $third_installlment = $row['third_installlment'];
	$fee_second_installment = $row['fee_second_installment'];
	$fee_first_installment = $row['fee_first_installment'];
	
	// $fee_third_installment = $row['fee_third_installment'];
	$full_payment = $row['full_payment'];
	$paid_status = $row['paid_status'];
	
	$group_id = $row['group_id'];
	
	$user_type = $row['user_type'];
	$scholarship_status = $row['scholarship_status'];
 }

	$reg_details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");
	while($user_details = mysql_fetch_array($reg_details))
	{
		$flag_prinfo = $user_details['flag_prinfo'];
		$group_isac = $user_details['group_isac'];
		$flag_prinfo = $user_details['flag_prinfo'];
		
		$contact_home = $user_details['phone_number'];
		$contact_cell = $user_details['phone_mobile'];
		$address = $user_details['address'];
		$zip = $user_details['zip'];
		$city = $user_details['city'];
		$state = $user_details['state'];
		$country = $user_details['country'];
	}
	

	$personal_profile_fiiled_flag = '';
    
	/*if($flag_prinfo == 1) 
	{ 
		$personal_profile_fiiled_flag = 1;		 
	}*/
	if($contact_home == ''  || $contact_cell == '' || $address == '' || $zip == '' || $city == '' || $state == '' || $country == '' )
		$personal_profile_fiiled_flag = 0;		 // fileds required
	else
		$personal_profile_fiiled_flag = 1;

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
 <div class="summary_form reg top_spacing" style="width:900px">
    
    <div class="rht_tab">
 
 <ul>
  <li><a href="<?php SERVER_URL ?>student_panel_dashboard" title="My ISAC"><b style="font-size:14px">Back to My ISAC</b></a></li>
 </li>
<!--  <li>|</li>
  <li><a href="programs" title="Browse Programs">Browse Programs</a></li>
  <li>|</li>
  <li><a href="application" title="Apply a Program">Apply for a Program</a></li>-->

  </ul>
        </div>
   
		 <h2 class="fonts_h2_headlines" style="margin-bottom:10px !important"><?php echo $program ;?></h2>
         
         <?php 
		 	//GETTING Group LImit and Group Members Count
			$sql = "SELECT * FROM groups WHERE group_id = '$group_id'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			
			$total_group_members = $row['group_members'];
			$group_limit =  $row['group_members']; //$row['group_limit']; for payment check
			$group_limit_min =  $row['group_limit']; // for minimum check
			$group_name = $row['group_name'];
			
			
			$group_members_sql = "SELECT * FROM group_members_count WHERE group_id = '$group_id'";
			$group_members_result = mysql_query($group_members_sql);
			$group_members_row = mysql_fetch_array($group_members_result);
			
			$registration_fee_count = $group_members_row['registration_fee_count'];
			$fee_first_inst_count = $group_members_row['fee_first_inst_count'];
			$fee_second_inst_count = $group_members_row['fee_second_inst_count'];
			
			if($group_name != '' AND $group_id != '')
			{
				if ($total_group_members < $group_limit_min)
				{
					?>
					<h4 style="font-size:14px; color:#9d521b; margin:10px 0">You need to have at least <?php echo $group_limit_min;?> member to unlock the group</h4>
					<?php
				}
				else if($registration_fee_count < $group_limit)
				{
					?>
					<h4 style="font-size:14px; color:#9d521b">Only after all the members of your group pay Registration Fee you will be eligible to make a payment for the First Installment</h4>
					<?php
				}
				else if($fee_first_inst_count < $group_limit)
				{
					?>
					<h4 style="font-size:14px; color:#9d521b">Only after all the members of your group pay First Installment you will be eligible to make a payment for the Second Installment</h4>
					<?php
				}
			}
			
			if($user_type == 'SCHOLARSHIP' AND $scholarship_status == 'PENDING')
			{
				?>
					<h4 style="font-size:14px; color:#9d521b">Your Application is Pending. You will be able to pay your fees after approval.</h4>
					<?php	
			}
			else if($user_type == 'SCHOLARSHIP' AND $scholarship_status == 'DENIED')
			{
				?>
					<h4 style="font-size:14px; color:#9d521b">Your Application is Denied by the admin</h4>
					<?php	
			}
		 ?>

    <table width='900' border='0' cellspacing='0' cellpadding='0' class='admin_tbl'>
      <tr>
        <th>Installment</th>
        <th>Amount</th>
        <th class='brn_n'>Status</th>
      </tr>
      <tr>
        <td>Registration Fee</td>
        <td>USD 45</td>
        <td class='link brn_n'>
        	<?php
				// if Group Memebr
				//if($_SESSION['SESS_MEMBER_GROUP_TYPE'] == 'GROUP' AND $group_id != '')

				if($group_name != '' AND $group_id != '')
				{
					// Total Group Members and Your Group Limit Equal, So Open Registration FEE
					if($total_group_members < $group_limit_min)
					{
						?>
						<img src='<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png' alt='PAY NOW' />
						<?php
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						
					}
					elseif($registration_fee == '' AND $fee_first_installment == '' AND $fee_second_installment == '') 
					{
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						else
						{
						?>
							<form name='student' action='proceed_payment_gateway' method='post'>
								<input type='hidden' name='formid' value='<?php echo $formid ;?>'/>
								<input type='hidden' name='amount' value='45'/>
								<input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg'  name='PAY NOW' class='paynow_button' />
							</form>
						<?php	
						}
					}
					else if($registration_fee != '' AND $fee_first_installment == '' AND $fee_second_installment == '')
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
					else
					{
						?>
						<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
				}
				else if($user_type == 'SCHOLARSHIP' AND $scholarship_status == 'APPROVED')
				{
					if($registration_fee == '' AND $fee_first_installment == '' AND $fee_second_installment == '') 
					{
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						else
						{
						?>
							<form name='student' action='proceed_payment_gateway' method='post'>
								<input type='hidden' name='formid' value='<?php echo $formid ;?>'/>
								<input type='hidden' name='amount' value='45'/>
								<input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg'  name='PAY NOW' class='paynow_button' />
							</form>
						<?php
						}
					}
					else if($registration_fee != '' AND $fee_first_installment == '' AND $fee_second_installment == '')
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
					else
					{
						?>
						<img src='<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png' alt='PAY NOW' />
						<?php
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						
					}
					
				}
				else
				{
					
					if($registration_fee == '' AND $fee_first_installment == '' AND $fee_second_installment == '')
					{
						?>
							<form name='student' action='proceed_payment_gateway' method='post'>
								<input type='hidden' name='formid' value='<?php echo $formid ;?>'/>
								<input type='hidden' name='amount' value='45'/>
								
							   <?php 
									if($user_type == 'SCHOLARSHIP' AND $scholarship_status == 'PENDING') 
									{ 
										
										?>
											<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> 
										<?php 
										if($personal_profile_fiiled_flag == 0)
										{
											?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
										}
										
									} 
									else 
									{ 
										if($personal_profile_fiiled_flag == 0)
										{
											?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
										}
										else
										{
										?>
											<input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg'  name='PAY NOW' class='paynow_button' />
										<?php 
										}
									} 
								?>
								
							</form>
						<?php
					}
					else if($registration_fee != '')
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
					else
					{
						?>
						<img src='<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png' alt='PAY NOW' />
						<?php
						
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						
					}
				}
			?>
        </td>
      </tr>
      <tr>
        <td>First Installment</td>
        <td>USD <?php echo $first_installment ;?></td>
        <td class='link brn_n'>
        
        	<?php
				if($group_name != '' AND $group_id != '')
				{
					// Registration Members Count and Group Limit Equal, So open First Installement	
					if($registration_fee_count >= $group_limit_min AND $registration_fee != '' AND $fee_first_installment == '' AND $fee_second_installment == '') 
					{
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						else
						{
						
						?>
                        	<form name='student' action='proceed_payment_gateway' method='post'>
                                <input type='hidden' name='formid' value='<?php echo $formid ;?>'/>
                                <input type='hidden' name='amount' value='<?php echo $first_installment;?>'/>
                                <input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg'  name='PAY NOW' class='paynow_button' />
                            </form>
                        <?php	
						}
					}
					else if($registration_fee != '' AND $fee_first_installment != '')
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
					else
					{
						?>
                        <img src='<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png' alt='PAY NOW' />
                        <?php
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
					}
				}
				else if($user_type == 'SCHOLARSHIP' AND $scholarship_status == 'APPROVED')
				{
					if($registration_fee !='' AND $fee_first_installment == '' AND $fee_second_installment == '')
					{
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						else
						{
						?>
							<form name='student' action='proceed_payment_gateway' method='post'>
								<input type='hidden' name='formid' value='<?php echo $formid ;?>'/>
								<input type='hidden' name='amount' value='<?php echo $first_installment ;?>'/>
								<input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg'  name='PAY NOW' class='paynow_button' />
							</form>
						<?php
						}
					}
					else if($registration_fee != '' AND $fee_first_installment != '')
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
					else
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png' alt='PAY NOW' />
						<?php
							if($personal_profile_fiiled_flag == 0)
							{
								?>
								<a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
							 <?php 
							}
					}
				}
				else
				{
					if($registration_fee !='' AND $fee_first_installment == '' AND $fee_second_installment == '')
					{
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						else
						{
						
						?>
							<form name='student' action='proceed_payment_gateway' method='post'>
								<input type='hidden' name='formid' value='<?php echo $formid ;?>'/>
								<input type='hidden' name='amount' value='<?php echo $first_installment ;?>'/>
								<input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg'  name='PAY NOW' class='paynow_button' />
							</form>
						<?php
						}
					}
					else if($registration_fee != '' AND $fee_first_installment != '')
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
					else
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png' alt='PAY NOW' />
						<?php
							if($personal_profile_fiiled_flag == 0)
							{
								?>
								<a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
							 <?php 
							}
					}
				}
				
			?>
        </td>
      </tr>
      <tr>
        <td>Second Installment</td>
        <td>USD <?php echo $second_installment ;?></td>
        <td class='link brn_n'>
        
        	<?php
				if($group_name != '' AND $group_id != '')
				{
					//Second installement Members Count and Group Limit Equal, So open Second Installement
					if($fee_first_inst_count >= $group_limit_min AND $registration_fee != '' AND $fee_first_installment != '' AND $fee_second_installment == '') 
					{
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						else
						{
						?>
                        	<form name='student' action='proceed_payment_gateway' method='post'>
                                <input type='hidden' name='formid' value='<?php echo $formid ;?>'/>
                                <input type='hidden' name='amount' value='<?php echo $second_installment ;?>'/>
                                <input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg'  name='PAY NOW' class='paynow_button' />
                            </form>
                        <?php	
						}
					}
					else if($registration_fee != '' AND $fee_first_installment != '' AND $fee_second_installment != '')
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
					else
					{
						?>
                        <img src='<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png' alt='PAY NOW' />
                        <?php
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
					}
				}
				else if($user_type == 'SCHOLARSHIP' AND $scholarship_status == 'APPROVED')
				{
					if($registration_fee !='' AND $fee_first_installment !='' AND $fee_second_installment == '')
					{
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						else
						{
						?>
							<form name='student' action='proceed_payment_gateway' method='post'>
								<input type='hidden' name='formid' value='<?php echo $formid ;?>'/>
								<input type='hidden' name='amount' value='<?php echo $second_installment ;?>'/>
								<input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg'  name='PAY NOW' class='paynow_button' />
							</form>
						<?php
						}
					}
					else if($registration_fee != '' AND $fee_first_installment != '' AND $fee_second_installment != '')
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
					else
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png' alt='PAY NOW' />
						<?php
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
					}
				}
				else
				{
					if($registration_fee !='' AND $fee_first_installment !='' AND $fee_second_installment == '')
					{
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<img src="<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png" alt="PAY NOW"> <a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
						else
						{
						?>
							<form name='student' action='proceed_payment_gateway' method='post'>
								<input type='hidden' name='formid' value='<?php echo $formid ;?>'/>
								<input type='hidden' name='amount' value='<?php echo $second_installment ;?>'/>
								<input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg'  name='PAY NOW' class='paynow_button' />
							</form>
						<?php
						}
					}
					else if($registration_fee != '' AND $fee_first_installment != '' AND $fee_second_installment != '')
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
						<?php
					}
					else
					{
						?>
							<img src='<?php bloginfo('template_url'); ?>/images/btn_paynow_g.png' alt='PAY NOW' />
						<?php
						if($personal_profile_fiiled_flag == 0)
						{
							?>
                    		<a href="register-update/" onmouseover="$('#hint').css({'left' : $(this).position().left+20, 'top' : $(this).position().top}); $('#hint').show(1000); " onmouseout="$('#hint').hide(3000)"><em><strong><img src="<?php bloginfo('template_url'); ?>/images/info.gif" border="0" align="top"/></strong></em></a> <span id='hint' style="display:none; position:absolute; color:#D90404; border:#CCC dotted 1px;"><em>Please fill in your Personal Information. Click the icon.</em></span>
                    	 <?php 
						}
					}
				}
			?>
        	
        </td>
      </tr>
      
       <tr>
        <td colspan='3' style='font-size:18px'> 
        	
            <?php
				if($registration_fee !='' AND $fee_first_installment !='' AND $fee_second_installment !='')
        		echo 'Your complete course fees has been paid and there are no pending dues';
			?>
			</td>
      </tr>
      
    </table>

    

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
<?php get_footer(); ?>
<?php } ?>