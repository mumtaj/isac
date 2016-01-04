<?php

/* Template Name: payment_sucess_first  */

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

	 $secret_key = payment_gateway_secret_key;	 // Your Secret Key
if(isset($_GET['DR'])) {
	 require('Rc43.php');
	 $DR = preg_replace("/\s/","+",$_GET['DR']);

	 $rc4 = new Crypt_RC4($secret_key);
 	 $QueryString = base64_decode($DR);
	 $rc4->decrypt($QueryString);
	 $QueryString = split('&',$QueryString);

	 $response = array();
	 foreach($QueryString as $param){
	 	$param = split('=',$param);
		$response[$param[0]] = urldecode($param[1]);
	 }
}

$refrence_no = $_SESSION['reference_no']; // Our FormID
$amountinr = $_SESSION['amountinr']; // Our Amount

if($_SESSION['payment_group_id'] != '')
	$payment_group_id = $_SESSION['payment_group_id']; //Our Group ID

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
 <div class="left_sect reg" style="margin: 30px 0 30px  80px; width:700px ">
  <div class="top_spacing">
   
   <?php
   if($refrence_no == $response['MerchantRefNo'])
   {
	   if($response['ResponseCode'] == 0 AND $response['IsFlagged'] == "NO") //SuccessFully Payment Done.
		{
	
			$Order_Id=$response['MerchantRefNo'];
			?>
			
		 <table width="700" border="0" cellspacing="0" cellpadding="0" >
		<tr>
		<td height="33">
		 <span class="fonts_h2_headlines" style="border:none !important" >
			Your Payment has been accepted. Thanks!</span> <br /><br />
				  You may now access other information, apply for programs or make payments, anytime.
		 <br /><br />
		 
         
         <div>For any queries or clarifications, please contact us at <a href='mailto:info@indiastudyabroad.org'>info@indiastudyabroad.org</a></div>
          <br /><br />
            <div align="center" >
            	<a href="my-isac" title="Back to My ISAC"><img src="<?php bloginfo('template_url'); ?>/images/back_to_ISAC_button.jpg" alt="Back to My ISAC" /></a>
           	</div> <br /><br />
		</td>
	   </tr>
	   <tr>
		  <td height="35" align="center">
			</td>
		</tr>
	  </table>
		  
		<?php
			$Order_Id;
			// value from the database
			$status='PAID';
			mysql_query("UPDATE application SET fee_second_installment = '$status' WHERE formid = '$Order_Id'");
			
			if($payment_group_id != '')
			{
				$sql = "SELECT * FROM group_members_count WHERE group_id = '$payment_group_id'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				
				$fee_second_inst_count = $row['fee_second_inst_count'] + 1;
				
				$update_sql = "UPDATE group_members_count SET fee_second_inst_count = '$fee_second_inst_count' WHERE group_id = '$payment_group_id'";
				$update_result = @mysql_query($update_sql);
			}
	
			//Here you need to put in the routines for a successful 
			//transaction such as sending an email to customer,
			//setting database status, informing logistics etc etc
			
			
			// currency conversion
			$currencych = mysql_query("SELECT * from currency");
			while($currencych1 = mysql_fetch_array($currencych))
			{
				$changecur = $currencych1['cn'];
			}
			
			
			$query2 = mysql_query("SELECT * FROM application WHERE formid = '$Order_Id'");
			$row2 = mysql_fetch_array($query2);
			$isac_id = $row2['isacid'];
			$second_installment = $row2['second_installment'];

			$second_installment_amountinr = round($second_installment*$changecur);
			
			$query1 = mysql_query("SELECT * FROM registration WHERE isacid = '$isac_id'");
			$row = mysql_fetch_array($query1);
			$email = $row['email'];
			$firstname = $row['firstname'];
			
			
			$msgTo = $email;
			$msgSubject = "ISAC - Successfully received your Payment";    
			
			$msgHeaders = "From: ISAC <info@indiastudyabroad.org>";
			$msgContent= "Dear $firstname
			
			Thank you for your payment of USD $second_installment or INR $second_installment_amountinr.  <br />
			Look forward to your participation in the ISAC program soon.
			<br />

 
            <b>The ISAC TEAM</b><br />
			India Study Abroad Center (ISAC), the India Specialists<br />
			Suite 411, Reliable Business Center<br />
			Andheri West, Mumbai - 400 102<br />
			w : http://www.indiastudyabroad.org<br />
			e : info@indiastudyabroad.org<br />
			o : +91-22-4014 3517
		
			";
			
			$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
			
		}
		else if($response['ResponseCode'] == 0 AND $response['IsFlagged'] == "YES") //Your Transaction Done, but Some Transaction verifiying there.
		{
			
			?>
			<table width="700" border="0" cellspacing="0" cellpadding="0" >
		<tr>
		<td height="33">
		 <h5><span style="font-size:18px">
			 Your Transaction Under Process. </span><br /><br />
			   Please contact <a href='mailto:admin@indiastudyabroad.org'>admin@indiastudyabroad.org</a>
		 </h5>
		 <div>For any queries or clarifications, please contact us at <a href='mailto:info@indiastudyabroad.org'>info@indiastudyabroad.org</a></div>
          <br /><br />
            <div align="center" >
            	<a href="my-isac" title="Back to My ISAC"><img src="<?php bloginfo('template_url'); ?>/images/back_to_ISAC_button.jpg" alt="Back to My ISAC" /></a>
           	</div> <br /><br />
		</td>
	   </tr>
	   <tr>
		  <td height="35" align="center">
			</td>
		</tr>
	  </table>
			<?php
			
			//Here you need to put in the routines/e-mail for a  "Batch Processing" order
			//This is only if payment for this transaction has been made by an American Express Card
			//since American Express authorisation status is available only after 5-6 hours by mail from ccavenue and at the "View Pending Orders"
		}	
		else //Transaction Failed
		{
			
			?>
			  <table width="700" border="0" cellspacing="0" cellpadding="0" >
		<tr>
		<td height="33">
		 <h5><span style="font-size:18px">
			Transaction Failed. </span> </h5><br />
		 <div>Please try again or contact <a href='mailto:admin@indiastudyabroad.org'>admin@indiastudyabroad.org</a></div><br />
				<div>For any queries or clarifications, please contact us at <a href='mailto:info@indiastudyabroad.org'>info@indiastudyabroad.org</a></div>
               <br /><br />
            <div align="center" >
            	<a href="my-isac" title="Back to My ISAC"><img src="<?php bloginfo('template_url'); ?>/images/back_to_ISAC_button.jpg" alt="Back to My ISAC" /></a>
           	</div> <br /><br />
		</td>
	   </tr>
	   <tr>
		  <td height="35" align="center">
			</td>
		</tr>
	  </table>
			<?php
			
			//Here you need to simply ignore this and dont need
			//to perform any operation in this condition
		}

   }
   else //Transaction Failed
	{
		
		?>
		  <table width="700" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td>
	 <h5><span style="font-size:18px">
		Transaction Failed.  </span></h5><br />
	 <div>Please try again or contact <a href='mailto:admin@indiastudyabroad.org'>admin@indiastudyabroad.org</a></div><br />
			<div>For any queries or clarifications, please contact us at <a href='mailto:info@indiastudyabroad.org'>info@indiastudyabroad.org</a></div>
            <br /><br />
            <div align="center" >
            	<a href="my-isac" title="Back to My ISAC"><img src="<?php bloginfo('template_url'); ?>/images/back_to_ISAC_button.jpg" alt="Back to My ISAC" /></a>
           	</div> <br /><br />
	</td>
   </tr>
   <tr>
	  <td height="35">
		</td>
	</tr>
  </table>
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