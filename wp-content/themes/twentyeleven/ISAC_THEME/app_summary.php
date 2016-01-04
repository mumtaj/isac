<?php

/* Template Name: SUMMARY APP */

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
 <div class='left_sect reg lft'>
    <h1>Application form - Summary</h1>
    <p>Kindly edit your details if required.</p>
    
      <table width='779' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width="779"><div style="height:auto;float:right;margin-right:170px;margin-top:20px;"><form action='app_program_edit.php' name='edit_program' method='post'>  <input type='hidden' value='<?php echo $formid; ?>' name='formid'/><input type='image' src="images/btn_edit_details.jpg" value='EDIT Program Details' class="edit_back_app"/></form></div>
            <h4>Program Details</h4></td>
        </tr>
        <tr>
          <td><table width='780' border='0' cellspacing='2' cellpadding='2' class='top_spacing'>
              <tr>
                <td width='250' class='form_text'>Select Program:</td>
                <td width='516' class='form_text'><?php echo $program; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Select Duration:</td>
                <td class='form_text'><?php echo $duration .' weeks'; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Select Arrival Date:</td>
                <td class='form_text'><?php echo $arrival; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Total program Fee (USD):</td>
                <td class='form_text'><?php echo '$ '. $fees; ?></td>
              </tr>
              <tr>
                <td colspan='2' class='form_text'><img src='images/spacer.gif' width='1' height='8' /></td>
              </tr>
            </table>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><img src='images/spacer.gif' width='1' height='5' /></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td><h4>Personal Details</h4></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td><table width='780' border='0' cellspacing='2' cellpadding='2' class='top_spacing'>
              <tr>
                <td width='250' class='form_text'>Contact Number (HOME):</td>
                <td width='516' class='space_for_form'><table width='100%' border='0' cellspacing='2' cellpadding='2'>
                    <tr>
                      <td width='34%' class='form_text' ><?php  echo $contact_home; ?></td>
                      <td width='15%' class='form_text'>MOBILE:</td>
                      <td width='51%' class='form_text'><?php  echo $contact_cell; ?></td>
                    </tr>
                    <tr>
                      <td colspan='4'><img src='images/spacer.gif' width='1' height='3' /></td>
                    </tr>
                    <tr>
                      
                   
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td valign='top' class='form_text'>Skype ID: </td>
                <td class='form_text'><?php echo $skype; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text' valign='top'>Address:</td>
                <td class='form_text'><?php echo $address;?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td valign='top' class='form_text'>Zip / Postal Code: </td>
                <td class='form_text'><?php echo $zip;?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td valign='top' class='form_text'>City:</td>
                <td class='form_text'><?php echo $city; ?></td>
              </tr>
              <tr>
                <td valign='top' class='form_text'>State:</td>
                <td class='form_text'><?php  echo $state;?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td valign='top' class='form_text'>Country:</td>
                <td class='form_text'><?php echo $country; ?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td class='brd'>&nbsp;</td>
        </tr>
        <tr>
          <td><img src='images/spacer.gif' width='1' height='5' /></td>
        </tr>
        <tr>
          
        </tr>
        
        
        <tr>
          <td><img src='images/spacer.gif' width='1' height='5' /></td>
        </tr>
        <tr>
          
        </tr>
        
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align='center'><form  method='post' action=' https://secure.ebs.in/pg/ma/sale/pay/' name='frmTransaction' id='frmTransaction'>
       <input name='account_id' type='hidden' value='5880' />
          <input name='mode' type='hidden' value='TEST' />
 <input name='reference_no' type='hidden' value='<?php echo $formid;?>' />
<input name='amount' type='hidden' value='<?php echo $changevaluecn;?>' />
<input name='description' type='hidden' value='<?php echo $program;?>' />
<input name='name' type='hidden' value='<?php echo $name; ?>' />
<input name='address' type='hidden' value='<?php echo $address;?>' />
<input name='city' type='hidden' value='<?php echo $city;?>' />
<input name='state' type='hidden' value='<?php echo $state;?>' />
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
          
          
          
          <input type='image' src='images/btn_proceed_payment.jpg' title='goback' alt='goback' class="proceed_payment"  />
          
          </form> 
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
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
<?php get_footer();
