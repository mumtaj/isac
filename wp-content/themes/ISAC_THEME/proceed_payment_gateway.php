<?php

/* Template Name: Proceed_payment_gateway  */

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

?>



<?php get_header(); ?>
<?php require_once('config/config.php'); ?>

<?php
$isacid = $_SESSION['SESS_MEMBER_ID'];
$formid = $_POST['formid'];
$amount = $_POST['amount'];


// currency conversion
$currencych = mysql_query("SELECT * from currency");
while($currencych1 = mysql_fetch_array($currencych))
{
	$changecur = $currencych1['cn'];
} 


//FROM Application TABLE
$query = "SELECT * FROM application WHERE formid = '$formid'";
$result = mysql_query($query);
$row=mysql_fetch_array($result);

$isacid = $row['isacid'];
$program = $row['program'];
$email = $row['email'];
$name = $row['firstname'];
$duration = $row['duration'];
$arrival = $row['arrival'];
$fee = $row['fee'];
$formid = $row['formid'];
$flag = $row['flag'];
$fee_second_installment = $row['fee_second_installment'];

$fee_third_installment = $row['fee_third_installment'];
$full_payment = $row['full_payment'];
$paid_status = $row['paid_status'];

$payment_group_id = $row['group_id'];



//From registration TABLE

$sql = "SELECT * FROM registration WHERE isacid = '$isacid'";
$result1 = mysql_query($sql);
$row1 = mysql_fetch_array($result1);

$contact_home = $row1['phone_number'];
/*if($contact_home == '')
	$contact_home = '02226303555';*/
	
$contact_cell = $row1['phone_mobile'];
/*if($contact_cell == '')
	$contact_cell = '02226303555';*/
$skype = $row1['skype'];

$address = $row1['address'];
/*if($address == '')
	$address = 'India Study Abroad Center (ISAC)';*/

$zip = $row1['zip'];
/*if($zip == '')
	$zip = '400 053';*/

$city = $row1['city'];
/*	if($city == '')
	$city = 'Mumbai';*/
	
$state = $row1['state'];
/*	if($state == '')
	$state = 'Maharashtra';*/
	
$country = $row1['country'];
	/*if($country == '')
	$country = 'India';*/

$personal_profile_fiiled_flag = '';
    
	if($contact_home == ''  || $contact_cell == '' || $address == '' || $zip == '' || $city == '' || $state == '' || $country == '' )
		$personal_profile_fiiled_flag = 0;		 // fileds required
	else
		$personal_profile_fiiled_flag = 1;



$status = $row1['status'];
$university = $row1['university'];
$majoring_in = $row1['majoring_in'];
$educational = $row1['educational'];

$year_of_study = $row1['year_of_study'];
$company = $row1['company'];
$title = $row1['title'];
$academic_qualification = $row1['academic_qualification'];
$educational_qualifications = $row1['educational_qualifications'];
$previous_experience = $row1['previous_experience'];
$previous_experience_describe = $row1['previous_experience_describe'];
$visited_india = $row1['visited_india'];
$visited_india_locations = $row1['visited_india_locations'];
$purpose_of_visit = $row1['purpose_of_visit'];
$local_language = $row1['local_language'];

$local_language_mention = $row1['local_language_mention'];
$interested_in_program = $row1['interested_in_program'];
$your_expectations = $row1['your_expectations'];
$about_ISAC = $row1['about_ISAC'];


		   

if($amount == '45')
{
	$Redirect_Url = SERVER_URL.'payment_sucess_reg?DR={DR}';
	$amountinr = round(45*$changecur);
}
elseif($amount=='300')
{
	$Redirect_Url = SERVER_URL.'payment_sucess_first?DR={DR}';
	$amountinr = round(300*$changecur);
}
else
{
	$Redirect_Url = SERVER_URL.'payment_sucess_second?DR={DR}';
 	$amountinr = round($amount*$changecur);
}
 
 
$secretKey = payment_gateway_secret_key;
$account_id = payment_gateway_account_id;
$amountinr = $amountinr;
$refrence_no = $formid;
$return_url = $Redirect_Url;
$mode = payment_gateway_mode;

$String = "$secretKey|$account_id|$amountinr|$refrence_no|$return_url|$mode";
$secure_hash = md5($String);

if($_POST['formid'] != '')
{
	$_SESSION['reference_no'] = $refrence_no;
	$_SESSION['amountinr'] = $amountinr;
	
	if($payment_group_id != '')
		$_SESSION['payment_group_id'] = $payment_group_id;
}
else
{
	$_SESSION['reference_no'] = '';
	$_SESSION['amountinr'] = '';	
}
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
 <div class="left_sect reg" style="margin: 30px 0 30px 150px ">
  <div class="top_spacing">
  
  <?php
  		if($personal_profile_fiiled_flag == 0)
		{
			?>
            <div align="center">
            	<h5><span style="font-size:18px">Please complete the Personal Information. <a href="register-update/" style="color:#AC5319">Click here</a></span> </h5>
            </div>
            <?php
		}
		else
		{
			?>
            
   <form  method='post' action=' https://secure.ebs.in/pg/ma/sale/pay/' name='frmTransaction' id='frmTransaction'>
    <table width="540" border="0" cellspacing="0" cellpadding="0" align="center" >
    <tr>
    <td height="33" align="center">
     <h5><span style="font-size:18px">Kindly proceed to pay your installment of USD <?php  echo $amount; ?></span> </h5>
    </td>
   </tr>
   <tr>
      <td height="35" align="center">
      	<?php
			
		?>
          <input name='secure_hash' type='hidden' value='<?php echo $secure_hash;?>' />
          <input name='account_id' type='hidden' value='<?php echo $account_id;?>' />
          <input name='mode' type='hidden' value='<?php echo $mode;?>' />
 <input name='reference_no' type='hidden' value='<?php echo $refrence_no;?>' />
<input name='amount' type='hidden' value='<?php echo $amountinr;?>' />
<input name='description' type='hidden' value='<?php echo $program;?>' />
<input name='name' type='hidden' value='<?php echo $name?>' />
<input name='address' type='hidden' value='<?php echo $address?>' />
<input name='city' type='hidden' value='<?php echo $city?>' />
<input name='state' type='hidden' value='<?php echo $state?>' />
<input name='postal_code' type='hidden' value='<?php echo $zip?>' />
<input name='country' type='hidden' value='con' />
<input name='email' type='hidden' value='<?php echo $email?>' />
<input name='phone' type='hidden' value='<?php echo $contact_home?>' />
<input name='ship_name' type='hidden' value='<?php $name?>' />
<input name='ship_address' type='hidden' value='<?php $address?>' />
<input name='ship_city' type='hidden' value='<?php echo $city?>' />
<input name='ship_state' type='hidden' value='<?php echo $state?>' />
<input name='ship_postal_code' type='hidden' value='<?php echo $zip?>' />
<input type='hidden' name='ship_country'  value='con'>
<input name='ship_phone' type='hidden' value='<?php echo $contact_home?>' />
<input name='return_url' type='hidden' size='60' value='<?php echo $Redirect_Url?>' />
          
          
          <input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_proceed_payment.jpg' title='goback' alt='proceed'  class="proceed_payment_btn"  /></td>
    </tr>
  </table>
    </form>
    <?php
		}
		?>
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
<?php get_footer(); ?>
<?php } ?>