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

      <div class="btn_cent"><a href="registration-option/"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg" border="0"  /></a>&nbsp; &nbsp; <a href="student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" border="0"  /></a></div>
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




<?php

/* Template Name: SUMMARY APP */

?>

<?php get_header(); ?>
<?php require_once('config/config.php'); ?>
<?php
$formid = $_GET['formid'];
$_SESSION['formid']=$formid;  //create form-ID session

?>

<?php   // session variables
  $isacid = $_SESSION['SESS_MEMBER_ID']; 

 $form_id = $_SESSION['formid'];
 $_SESSION['reference_no'] =  $form_id;
?>

<?php
 $query = "SELECT * FROM application WHERE isacid = '$isacid' && formid='$formid'";
//$query = "SELECT * FROM application WHERE isacid = '$isacid'";
 $result = @mysql_query($query);
 
 while ($row = mysql_fetch_array($result))
 {
			
	 	   $program = $row['program'];
		   $duration = $row['duration'];
		   $arrival = $row['arrival'];
		   $fees = $row['fee'];
		
		   $firstname = $row['firstname'];
		   $lastname = $row['lastname'];
		  
		  // $formid = $row['formid'];
	 
 }
$Redirect_Url = SERVER_URL.'payment_sucess_reg?DR={DR}';
 
$currencych = mysql_query("SELECT * from currency");
while($currencych1 = mysql_fetch_array($currencych))
{
	$changecur = $currencych1['cn'];
} 

 
$secretKey = payment_gateway_secret_key;
$account_id = payment_gateway_account_id;
$amountinr = round(45*$changecur);
$refrence_no = $formid;
$return_url = $Redirect_Url;
$mode = payment_gateway_mode;

$String = "$secretKey|$account_id|$amountinr|$refrence_no|$return_url|$mode";
$secure_hash = md5($String);
?>
<?php

$reg_query = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");
 while ($row1 = mysql_fetch_array($reg_query))
 {

	        $name = $row1['firstname'];
		    $lname = $row1['lastname'];
		  $email = $row1['email'];
	   	     
		   
			
			$contact_home = $row1['phone_mobile'];
if($contact_home == '')
	$contact_home = '02226303555';
	
$contact_cell = $row1['phone_mobile'];
$skype = $row1['skype'];

$address = $row1['address'];
if($address == '')
	$address = 'India Study Abroad Center (ISAC)';

$zip = $row1['zip'];
if($zip == '')
	$zip = '400 053';

$city = $row1['city'];
	if($city == '')
	$city = 'Mumbai';
	
$state = $row1['state'];
	if($state == '')
	$state = 'Maharashtra';
	
$country = $row1['country'];
	if($country == '')
	$country = 'India';
 }
?>

<?php 



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
 <div class='left_sect reg lft'>
    <h2 class="fonts_h2_footer">Application form - Summary</h2>
    <p style="font-size:11px;margin-top:10px;margin-bottom:10px">(Kindly edit your details if required.)</p>
    
      <table width='591' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td colspan="2">
            </td>
        </tr>
        <tr>
          <td colspan="2"><table width='589' border='0' cellspacing='2' cellpadding='2' class='top_spacing'>
              <tr>
                <td width='223' class='form_text'>Selected Program:</td>
                <td width='352' class='form_text'><?php echo $program; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='<?php bloginfo('template_url'); ?>/images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Selected Duration:</td>
                <td class='form_text'><?php echo $duration .' weeks'; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='<?php bloginfo('template_url'); ?>/images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Selected Arrival Date:</td>
                <td class='form_text'><?php echo $arrival; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='<?php bloginfo('template_url'); ?>/images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'><strong>Total Program Fee (USD)</strong>:</td>
                <td class='form_text'><strong><?php echo '$ '. number_format($fees,2); ?></strong></td>
              </tr>
           <tr>
                <td colspan='3'><img src='<?php bloginfo('template_url'); ?>/images/spacer.gif' width='1' height='3' /></td>
              </tr>     
              
                
              <tr>
                <td class='form_text' style="padding-left:10px; font-size:11px;">Registration Fees (USD):</td>
                <td class='form_text' style="font-size:11px;"><?php echo '$ 45.00 '; ?></td>
              </tr>
              
              
              
              <tr>
                <td class='form_text' style="padding-left:10px; font-size:11px;">First Instalment Amount (USD):</td>
                <td class='form_text' style="font-size:11px;"><?php echo '$ 300.00'; ?></td>
              </tr>
              
              
             
              <tr>
                <td class='form_text' style="padding-left:10px; font-size:11px;">Second Instalment Amount (USD):</td>
                <td class='form_text' style="font-size:11px;"><?php echo '$'. number_format(($fees-300),2); ?></td>
              </tr>
              
              
              <tr>
                <td colspan='3'><img src='<?php bloginfo('template_url'); ?>/images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text' style="font-size:14px;"><strong>Payment Due Now (USD)</strong>:</td>
                <td class='form_text' style="font-size:14px;"><strong><?php echo '$ 45.00'; ?></strong></td>
              </tr>
              
              
              <tr>
               
              
              
              <tr>
                <td colspan='2' class='form_text'><img src='<?php bloginfo('template_url'); ?>/images/spacer.gif' width='1' height='8' /></td>
              </tr>
            </table>
        
        
     
        <tr>
         <td width="205" align='right' style="padding-right:15px" valign="bottom"> <form action='<?php echo SERVER_URL; ?>summary_application_edit' name='edit_program' method='post'>  <input type='hidden' value='<?php echo $form_id; ?>' name='formid'/><input type='image' src="<?php bloginfo('template_url'); ?>/images/btn_edit_details.jpg" value='EDIT Program Details' class="edit_back_app"/></form></td>
          <td width="386" align='left' valign="bottom"><form  method='post' action=' https://secure.ebs.in/pg/ma/sale/pay/' name='frmTransaction' id='frmTransaction'>
       <input name='secure_hash' type='hidden' value='<?php echo $secure_hash;?>' />
          <input name='account_id' type='hidden' value='<?php echo $account_id;?>' />
          <input name='mode' type='hidden' value='<?php echo $mode;?>' />
 <input name='reference_no' type='hidden' value='<?php echo $form_id;?>' />
<input name='amount' type='hidden' value='<?php echo $amountinr; ?>' />
<input name='description' type='hidden' value='<?php echo $program;?>' />
<input name='name' type='hidden' value='<?php echo $name; ?>' />
<input name='address' type='hidden' value='<?php echo $address;?>' />
<input name='city' type='hidden' value='<?php echo $city;?>' />
<input name='postal_code' type='hidden' value='<?php echo $zip;?>' />
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
          
          
          
          <br />
          <input type='image' src='<?php bloginfo('template_url'); ?>/images/btn_proceed_payment.jpg' title='PROCEED' alt='PROCEED' class="proceed_payment"  />
          
          <input name='state' type='hidden' value='<?php echo $state;?>' />
          </form> 
          </td>
         
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
  
    
    <!-- middle box ends here --> 
  </div>
<!--END FORM-->
			<?php
			get_sidebar('bottom'); 
			?>
          <div class="cleared"></div>
          <br />
        </div>
    </div>
</div>
<div class="cleared"></div>
<?php get_footer(); ?>

<?php } ?>
