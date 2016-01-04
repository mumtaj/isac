<?php

/* Template Name: application_form*/

?>
<?php get_header(); ?>
<?php
$quer2=mysql_query("SELECT * FROM category order by cat_id"); 

$cat=$_GET['cat']; // This line is added to take care if your global variable is off
if(isset($cat) and strlen($cat) > 0){
$quer=mysql_query("SELECT * FROM isac_duration where program_id=$cat order by id");
 

$arrival = mysql_query("SELECT * FROM isac_arrival where programme_id=$cat order by id"); 
}else{$quer=mysql_query("SELECT test FROM subcategory"); } 
////////// end of query for second subcategory drop down list box ///////////////////////////
/////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3///// 
$cat3=$_GET['cat3']; // This line is added to take care if your global variable is off
if(isset($cat3) and strlen($cat3) > 0){
//$quer3=mysql_query("SELECT * FROM subcategory2 where subcat_id=$cat3 order by subcat_id");
$quer3=mysql_query("SELECT * FROM subcategory2 where subcat_id=$cat3 order by subcat_id");
 
$query_prtable = mysql_query("SELECT * from isac_duration where program_id = $cat3");

}else{$quer3=mysql_query("SELECT * FROM isac_duration order by id LIMIT 0, 1"); } 
////////// end of query for third subcategory drop down list box ///////////////////////////

?>


<?php
$isacid = $_SESSION['SESS_MEMBER_ID'];
$details = mysql_query("SELECT * FROM registration");
//if(mysql_num_rows($details))
//{
//	header ("location: http://www.redigital.co");
//}
//	else
//	{
		
//}




while($user_details = mysql_fetch_array($details))
{
	$firstname = $user_details['firstname'];
	$lastname = $user_details['lastname'];
	$email = $user_details['email'];
	$date = $user_details['date'];
	$month = $user_details['month'];
	$year = $user_details['year'];
	$gender = $user_details['gender'];
	$isacid = $user_details['isacid'];
	
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
 <div class="left_sect reg lft">
    <h1>Application form </h1>
    <p>All fields are mandatory</p>
    <img src="images/spacer.gif" width="1" height="8" />
    <h4>Program Details</h4>
    <img src="images/spacer.gif" width="1" height="8" />
    <form action="summary-app" method="post" name="applicationform1" id="appfrm" >
      <table width="520" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
        <tr>
          <td width="150" class="form_text">Select Program:</td>
          <td width="319" class="space_for_form"><?php
//////////        Starting of first drop downlist /////////
echo "<select name='cat' onchange=\"reload(this.form)\" class='grad'><option value='000' >Select Program</option>";
while($noticia2 = mysql_fetch_array($quer2)) { 
if($noticia2['cat_id']==@$cat){echo "<option selected value='$noticia2[cat_id]'>$noticia2[category]</option>"."<BR>";}
else{
	echo  "<option value='$noticia2[cat_id]'>$noticia2[category]</option>";
	}
}
echo "</select>";
// selected vale for program

?></td>
        </tr>
        <tr>
          <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Select Duration:</td>
          <td class="space_for_form_2">
 <?php   //////////        Starting of second drop downlist /////////
echo "<select name='subcat' onchange=\"reload3(this.form)\" class='grad'><option value='000'>";
if($cat3=='')
{
	
echo "Select Duration";	
	
}

else
{
	$value_set = $_GET['cat3'];
	echo $value_set .' weeks';
	
}
echo "</option>";
while($noticia = mysql_fetch_array($quer)) { 

$start_date = $noticia['start_week'];
$end_date = $noticia['end_week'];
$pr_id = $noticia['program_id'];
$base_amt = $noticia['base_amount'];
$diff_amt = $noticia['difference_amount'];
// loop for the ittration

$i = $start_date;


for($i;$i<=$end_date;$i++)
{

//end loop

if($noticia['id']==@$cat3)
{
	echo "<option selected value='$i'>$i weeks</option>"."<BR>";
	}
else
{
	echo  "<option value='$i'>$i weeks</option>";}
}

echo "</select>";
}// closing of for loop
//////////////////  This will end the second drop down list ///////////
?></td>
        </tr>
        <tr>
          <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Select Arrival Date:</td>
          <td class="space_for_form_2"><?php  
	  //////////        Starting of third drop downlist /////////
echo "<select name='subcat3' class='grad' ><option value='000'>Select Arrival Date</option>";
while($arivaldate = mysql_fetch_array($arrival)) { 
echo  "<option value='$arivaldate[arrivel]'>$arivaldate[arrivel]</option>";
}
echo "</select>";
//////////////////  This will end the third drop down list ///////////

?></td>
        </tr>
        <tr>
          <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Total Program Fee:</td>
          <td class="space_for_form_2"><?php  
	  //////////        Starting of third drop downlist /////////

if($value_set == '')
{
echo "<input type='text' class='text_field' disabled='disabled' name='fees' />";
}
else
{
	 $cost_sum = $value_set - $start_date;
 $cost = $base_amt +($cost_sum * $diff_amt);
echo "<input type='text' name='fees' class='grad' disabled='disabled' value=' $ $cost' />";
}

//////////////////  This will end the third drop down list ///////////

?>
<input type="hidden" value="<?php echo $cost1 ?>" name="fees" />
<input type="hidden" value="<?php echo $value_set ?>" name="value_set" />
<input type="hidden" value="<?php echo $cost ?>" name="cost_fees" />

</td>
        </tr>
        
        
        <tr>
          <td height="57" colspan="2" class="form_text"><h4>Personal Details</h4></td>
        </tr>

      <!--  ---------------------------------------------------------------------------------------------->

        <tr>
          <td width="150" class="form_text">Phone Number (HOME)</td>
          <td width="319" class="space_for_form">
          <input type="text" class="text_field"  name="home"/>
          </td>
        </tr>
        <tr>
          <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Phone Number (MOBILE):</td>
          <td class="space_for_form_2">
          <input type="text" class="text_field"  name="cell"/>
 </td>
        </tr>
        <tr>
          <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Skype ID:</td>
          <td class="space_for_form_2">
          <input type="text" class="text_field"  name="skype"/>
          </td>
        </tr>
        <tr>
          <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Address:</td>
          <td class="space_for_form_2">
<textarea class="text_field_input" cols="45" rows="4"  name="address"></textarea>
<input type="hidden" value="<?php echo $cost1 ?>" name="fees" />
</td>
        </tr>
        <tr>
        <td height="27" class="form_text" >Zip / Postal code </td>
         <td><input type="text" class="text_field"  name="zip"/></td>
        </tr>
        
        <tr>
        <td height="27" class="form_text" >City: </td>
         <td><input type="text" class="text_field"  name="city"/> </td>
        </tr>
        
        <tr>
        <td height="27" class="form_text" >State: </td>
         <td><input type="text" class="text_field"  name="state"/></td>
        </tr>
        
        <tr>
        <td height="27" class="form_text" >Country: </td>
         <td><select name="country" id="country" class="grad">
                  <option value="000">Country</option>
                  <option value="Afganistan">Afghanistan</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="American Samoa">American Samoa</option>
                  <option value="Andorra">Andorra</option>
                  <option value="Angola">Angola</option>
                  <option value="Anguilla">Anguilla</option>
                  <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
                  <option value="Aruba">Aruba</option>
                  <option value="Australia">Australia</option>
                  <option value="Austria">Austria</option>
                  <option value="Azerbaijan">Azerbaijan</option>
                  <option value="Bahamas">Bahamas</option>
                  <option value="Bahrain">Bahrain</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Barbados">Barbados</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Belgium">Belgium</option>
                  <option value="Belize">Belize</option>
                  <option value="Benin">Benin</option>
                  <option value="Bermuda">Bermuda</option>
                  <option value="Bhutan">Bhutan</option>
                  <option value="Bolivia">Bolivia</option>
                  <option value="Bonaire">Bonaire</option>
                  <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                  <option value="Botswana">Botswana</option>
                  <option value="Brazil">Brazil</option>
                  <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                  <option value="Brunei">Brunei</option>
                  <option value="Bulgaria">Bulgaria</option>
                  <option value="Burkina Faso">Burkina Faso</option>
                  <option value="Burundi">Burundi</option>
                  <option value="Cambodia">Cambodia</option>
                  <option value="Cameroon">Cameroon</option>
                  <option value="Canada">Canada</option>
                  <option value="Canary Islands">Canary Islands</option>
                  <option value="Cape Verde">Cape Verde</option>
                  <option value="Cayman Islands">Cayman Islands</option>
                  <option value="Central African Republic">Central African Republic</option>
                  <option value="Chad">Chad</option>
                  <option value="Channel Islands">Channel Islands</option>
                  <option value="Chile">Chile</option>
                  <option value="China">China</option>
                  <option value="Christmas Island">Christmas Island</option>
                  <option value="Cocos Island">Cocos Island</option>
                  <option value="Colombia">Colombia</option>
                  <option value="Comoros">Comoros</option>
                  <option value="Congo">Congo</option>
                  <option value="Cook Islands">Cook Islands</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="Cote DIvoire">Cote D'Ivoire</option>
                  <option value="Croatia">Croatia</option>
                  <option value="Cuba">Cuba</option>
                  <option value="Curaco">Curacao</option>
                  <option value="Cyprus">Cyprus</option>
                  <option value="Czech Republic">Czech Republic</option>
                  <option value="Denmark">Denmark</option>
                  <option value="Djibouti">Djibouti</option>
                  <option value="Dominica">Dominica</option>
                  <option value="Dominican Republic">Dominican Republic</option>
                  <option value="East Timor">East Timor</option>
                  <option value="Ecuador">Ecuador</option>
                  <option value="Egypt">Egypt</option>
                  <option value="El Salvador">El Salvador</option>
                  <option value="Equatorial Guinea">Equatorial Guinea</option>
                  <option value="Eritrea">Eritrea</option>
                  <option value="Estonia">Estonia</option>
                  <option value="Ethiopia">Ethiopia</option>
                  <option value="Falkland Islands">Falkland Islands</option>
                  <option value="Faroe Islands">Faroe Islands</option>
                  <option value="Fiji">Fiji</option>
                  <option value="Finland">Finland</option>
                  <option value="France">France</option>
                  <option value="French Guiana">French Guiana</option>
                  <option value="French Polynesia">French Polynesia</option>
                  <option value="French Southern Ter">French Southern Ter</option>
                  <option value="Gabon">Gabon</option>
                  <option value="Gambia">Gambia</option>
                  <option value="Georgia">Georgia</option>
                  <option value="Germany">Germany</option>
                  <option value="Ghana">Ghana</option>
                  <option value="Gibraltar">Gibraltar</option>
                  <option value="Great Britain">Great Britain</option>
                  <option value="Greece">Greece</option>
                  <option value="Greenland">Greenland</option>
                  <option value="Grenada">Grenada</option>
                  <option value="Guadeloupe">Guadeloupe</option>
                  <option value="Guam">Guam</option>
                  <option value="Guatemala">Guatemala</option>
                  <option value="Guinea">Guinea</option>
                  <option value="Guyana">Guyana</option>
                  <option value="Haiti">Haiti</option>
                  <option value="Hawaii">Hawaii</option>
                  <option value="Honduras">Honduras</option>
                  <option value="Hong Kong">Hong Kong</option>
                  <option value="Hungary">Hungary</option>
                  <option value="Iceland">Iceland</option>
                  <option value="India">India</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Iran">Iran</option>
                  <option value="Iraq">Iraq</option>
                  <option value="Ireland">Ireland</option>
                  <option value="Isle of Man">Isle of Man</option>
                  <option value="Israel">Israel</option>
                  <option value="Italy">Italy</option>
                  <option value="Jamaica">Jamaica</option>
                  <option value="Japan">Japan</option>
                  <option value="Jordan">Jordan</option>
                  <option value="Kazakhstan">Kazakhstan</option>
                  <option value="Kenya">Kenya</option>
                  <option value="Kiribati">Kiribati</option>
                  <option value="Korea North">Korea North</option>
                  <option value="Korea Sout">Korea South</option>
                  <option value="Kuwait">Kuwait</option>
                  <option value="Kyrgyzstan">Kyrgyzstan</option>
                  <option value="Laos">Laos</option>
                  <option value="Latvia">Latvia</option>
                  <option value="Lebanon">Lebanon</option>
                  <option value="Lesotho">Lesotho</option>
                  <option value="Liberia">Liberia</option>
                  <option value="Libya">Libya</option>
                  <option value="Liechtenstein">Liechtenstein</option>
                  <option value="Lithuania">Lithuania</option>
                  <option value="Luxembourg">Luxembourg</option>
                  <option value="Macau">Macau</option>
                  <option value="Macedonia">Macedonia</option>
                  <option value="Madagascar">Madagascar</option>
                  <option value="Malaysia">Malaysia</option>
                  <option value="Malawi">Malawi</option>
                  <option value="Maldives">Maldives</option>
                  <option value="Mali">Mali</option>
                  <option value="Malta">Malta</option>
                  <option value="Marshall Islands">Marshall Islands</option>
                  <option value="Martinique">Martinique</option>
                  <option value="Mauritania">Mauritania</option>
                  <option value="Mauritius">Mauritius</option>
                  <option value="Mayotte">Mayotte</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Midway Islands">Midway Islands</option>
                  <option value="Moldova">Moldova</option>
                  <option value="Monaco">Monaco</option>
                  <option value="Mongolia">Mongolia</option>
                  <option value="Montserrat">Montserrat</option>
                  <option value="Morocco">Morocco</option>
                  <option value="Mozambique">Mozambique</option>
                  <option value="Myanmar">Myanmar</option>
                  <option value="Nambia">Nambia</option>
                  <option value="Nauru">Nauru</option>
                  <option value="Nepal">Nepal</option>
                  <option value="Netherland Antilles">Netherland Antilles</option>
                  <option value="Netherlands">Netherlands (Holland, Europe)</option>
                  <option value="Nevis">Nevis</option>
                  <option value="New Caledonia">New Caledonia</option>
                  <option value="New Zealand">New Zealand</option>
                  <option value="Nicaragua">Nicaragua</option>
                  <option value="Niger">Niger</option>
                  <option value="Nigeria">Nigeria</option>
                  <option value="Niue">Niue</option>
                  <option value="Norfolk Island">Norfolk Island</option>
                  <option value="Norway">Norway</option>
                  <option value="Oman">Oman</option>
                  <option value="Pakistan">Pakistan</option>
                  <option value="Palau Island">Palau Island</option>
                  <option value="Palestine">Palestine</option>
                  <option value="Panama">Panama</option>
                  <option value="Papua New Guinea">Papua New Guinea</option>
                  <option value="Paraguay">Paraguay</option>
                  <option value="Peru">Peru</option>
                  <option value="Phillipines">Philippines</option>
                  <option value="Pitcairn Island">Pitcairn Island</option>
                  <option value="Poland">Poland</option>
                  <option value="Portugal">Portugal</option>
                  <option value="Puerto Rico">Puerto Rico</option>
                  <option value="Qatar">Qatar</option>
                  <option value="Republic of Montenegro">Republic of Montenegro</option>
                  <option value="Republic of Serbia">Republic of Serbia</option>
                  <option value="Reunion">Reunion</option>
                  <option value="Romania">Romania</option>
                  <option value="Russia">Russia</option>
                  <option value="Rwanda">Rwanda</option>
                  <option value="St Barthelemy">St Barthelemy</option>
                  <option value="St Eustatius">St Eustatius</option>
                  <option value="St Helena">St Helena</option>
                  <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                  <option value="St Lucia">St Lucia</option>
                  <option value="St Maarten">St Maarten</option>
                  <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                  <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                  <option value="Saipan">Saipan</option>
                  <option value="Samoa">Samoa</option>
                  <option value="Samoa American">Samoa American</option>
                  <option value="San Marino">San Marino</option>
                  <option value="Sao Tome & Principe">Sao Tome &amp; Principe</option>
                  <option value="Saudi Arabia">Saudi Arabia</option>
                  <option value="Senegal">Senegal</option>
                  <option value="Seychelles">Seychelles</option>
                  <option value="Sierra Leone">Sierra Leone</option>
                  <option value="Singapore">Singapore</option>
                  <option value="Slovakia">Slovakia</option>
                  <option value="Slovenia">Slovenia</option>
                  <option value="Solomon Islands">Solomon Islands</option>
                  <option value="Somalia">Somalia</option>
                  <option value="South Africa">South Africa</option>
                  <option value="Spain">Spain</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="Sudan">Sudan</option>
                  <option value="Suriname">Suriname</option>
                  <option value="Swaziland">Swaziland</option>
                  <option value="Sweden">Sweden</option>
                  <option value="Switzerland">Switzerland</option>
                  <option value="Syria">Syria</option>
                  <option value="Tahiti">Tahiti</option>
                  <option value="Taiwan">Taiwan</option>
                  <option value="Tajikistan">Tajikistan</option>
                  <option value="Tanzania">Tanzania</option>
                  <option value="Thailand">Thailand</option>
                  <option value="Togo">Togo</option>
                  <option value="Tokelau">Tokelau</option>
                  <option value="Tonga">Tonga</option>
                  <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                  <option value="Tunisia">Tunisia</option>
                  <option value="Turkey">Turkey</option>
                  <option value="Turkmenistan">Turkmenistan</option>
                  <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                  <option value="Tuvalu">Tuvalu</option>
                  <option value="Uganda">Uganda</option>
                  <option value="Ukraine">Ukraine</option>
                  <option value="United Arab Erimates">United Arab Emirates</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="United States of America">United States of America</option>
                  <option value="Uraguay">Uruguay</option>
                  <option value="Uzbekistan">Uzbekistan</option>
                  <option value="Vanuatu">Vanuatu</option>
                  <option value="Vatican City State">Vatican City State</option>
                  <option value="Venezuela">Venezuela</option>
                  <option value="Vietnam">Vietnam</option>
                  <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                  <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                  <option value="Wake Island">Wake Island</option>
                  <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                  <option value="Yemen">Yemen</option>
                  <option value="Zaire">Zaire</option>
                  <option value="Zambia">Zambia</option>
                  <option value="Zimbabwe">Zimbabwe</option>
                </select></td>
        </tr>
        
        <tr>
          <td colspan="2" class="form_text"><img src="images/spacer.gif" width="1" height="8" /></td>
        </tr>
        <tr>
          <input type="hidden" value="<?php echo $firstname ?>" name="firstname" />
          <input type="hidden" value="<?php echo $lastname ?>" name="lastname" />
          <input type="hidden" value="<?php echo $date ?>" name="date" />
          <input type="hidden" value="<?php echo $month ?>" name="month" />
          <input type="hidden" value="<?php echo $year ?>" name="year" />
          <input type="hidden" value="<?php echo $gender?>" name="gender" />
          <input type="hidden" value="<?php echo $email ?>" name="email" />
          <input type="hidden" value="<?php echo $isacid ?>" name="isacid" />
          <td class="form_text">&nbsp;</td>
          <td class="space_for_form_2"><input type="image" src="images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button" /></td>
        </tr>
        <tr>
          <td colspan="2" class="note">Note: You will be able to edit all your details on the summary page</td>
        </tr>
      </table>
      <!-- ------------------------------------------------------------------------------------------------->
      
    </form>
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
<?php get_footer();
