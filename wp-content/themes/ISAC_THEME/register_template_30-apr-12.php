<?php

/* Template Name: REGISTER TEMPLATE */

?>

<?php get_header(); ?>

<script type="text/javascript">
$(document).ready(function()//When the dom is ready 
{
$("#email").change(function() 
{ //if theres a change in the username textbox

var email = $("#email").val();//Get the value in the username textbox
if(email.length > 3)//if the lenght greater than 3 characters
{
$("#availability_status").html('<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" align="absmiddle">&nbsp;Checking availability...');
//Add a loading image in the span id="availability_status"

$.ajax({  //Make the Ajax Request
    type: "POST",  
    url: "<?php bloginfo('template_url'); ?>/isac_process/ajax_check_user.php",  //file name
    data: "email="+ email,  //data
    success: function(server_response){  
   
   $("#availability_status").ajaxComplete(function(event, request){ 

	if(server_response == '0')//if ajax_check_username.php return value "0"
	{ 
	$("#availability_status").html('<img src="<?php bloginfo('template_url'); ?>/images/available.png" align="absmiddle"> <font color="Green"> Available </font>  ');
	document.registerform.check.value += 'hello';
	//add this image to the span with id "availability_status"
	}  
	else  if(server_response == '1')//if it returns "1"
	{  
	 $("#availability_status").html('<img src="<?php bloginfo('template_url'); ?>/images/not_available.png" align="absmiddle"> <font color="red">Not Available </font>');
	 document.registerform.check.value += '';
	}  
   
   });
   } 
   
  }); 

}
else
{

$("#availability_status").html('<font color="#cc0000">Username too short</font>');
//if in case the username is less than or equal 3 characters only 
}



return false;
});

});
</script>
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
    <h1>Registration form</h1>
    <div class="clear"></div>
    <form action="<?php bloginfo('template_url'); ?>/isac_process/register_process.php" method="post" name="registerform" id="registerform" >
      <table width="607" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
        <tr>
          <td width="164" class="form_text">First Name:</td>
          <td colspan="2" class="space_for_form"><input type="text" name="firtsname" class="text_field" title="Enter First Name" /></td>
        </tr>
        <tr>
          <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Last Name:</td>
          <td colspan="2" class="space_for_form_2"><input type="text" name="lastsname" class="text_field" title="Enter Last Name" /></td>
        </tr>
        <tr>
          <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Email:<br />
            (This will be your username)</td>
          <td width="321" class="space_for_form_2">
          <input type="text" name="email" class="text_field"  title="Enter Email" id="email"  /></td>
          <td width="102" class="space_for_form_2"><span style="margin:0px;" id="availability_status"></span></td>
        </tr>
        <tr>
          <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Password:</td>
          <td colspan="2" class="space_for_form_2"><input type="password" name="password" class="text_field"  title="password"  /><input name="check" type="hidden" class="test_search" title="check"  maxlength="40" id="check"/></td>
        </tr>
        <tr>
          <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Confirm Password:</td>
          <td colspan="2" class="space_for_form_2"><input type="password" name="password2" class="text_field"  title="password"  /></td>
        </tr>
        <tr>
          <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text">Date of birth:</td>
          <td colspan="2" class="space_for_form_2"><select name="date" id="date" class="dropdown_small">
              <option value="000">Date</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select>
            <select name="month" id="month" class="dropdown_small">
              <option value="000">Month</option>
              <option value="January">January</option>
              <option value="February">February</option>
              <option value="March">March</option>
              <option value="April">April</option>
              <option value="May">May</option>
              <option value="June">June</option>
              <option value="July">July</option>
              <option value="August">August</option>
              <option value="September">September</option>
              <option value="October">October</option>
              <option value="November">November</option>
              <option value="December">December</option>
            </select>
            <select name="year" id="year" class="dropdown_small">
              <option value="000">Year</option>
              <option value="2010">2010</option>
              <option value="2009">2009</option>
              <option value="2008">2008</option>
              <option value="2007">2007</option>
              <option value="2006">2006</option>
              <option value="2005">2005</option>
              <option value="2004">2004</option>
              <option value="2003">2003</option>
              <option value="2002">2002</option>
              <option value="2001">2001</option>
              <option value="2000">2000</option>
              <option value="1999">1999</option>
              <option value="1998">1998</option>
              <option value="1997">1997</option>
              <option value="1996">1996</option>
              <option value="1995">1995</option>
              <option value="1994">1994</option>
              <option value="1993">1993</option>
              <option value="1992">1992</option>
              <option value="1991">1991</option>
              <option value="1990">1990</option>
              <option value="1989">1989</option>
              <option value="1988">1988</option>
              <option value="1987">1987</option>
              <option value="1986">1986</option>
              <option value="1985">1985</option>
              <option value="1984">1984</option>
              <option value="1983">1983</option>
              <option value="1982">1982</option>
              <option value="1981">1981</option>
              <option value="1980">1980</option>
              <option value="1979">1979</option>
              <option value="1978">1978</option>
              <option value="1977">1977</option>
              <option value="1976">1976</option>
              <option value="1975">1975</option>
              <option value="1974">1974</option>
              <option value="1973">1973</option>
              <option value="1972">1972</option>
              <option value="1971">1971</option>
              <option value="1970">1970</option>
              <option value="1969">1969</option>
              <option value="1968">1968</option>
              <option value="1967">1967</option>
              <option value="1966">1966</option>
              <option value="1965">1965</option>
              <option value="1964">1964</option>
              <option value="1963">1963</option>
              <option value="1962">1962</option>
              <option value="1961">1961</option>
              <option value="1960">1960</option>
            </select></td>
        </tr>
        <tr>
          <td colspan="4"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td height="25" class="form_text">Gender:</td>
          <td colspan="2" class="space_for_form_2"><select name="gender" id="gender" class="dropdown_g">
              <option value="000">Select</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Do not Specify">Do not Specify</option>
            </select></td>
        </tr>
        <tr>
    <td width="150" class="form_text">Phone Number(HOME):</td>
    <td width="319"><input type="text" name="phone_home" class="text_field"  title="Enter Cell Number"/></td>
  </tr>
    <tr>
    <input type="hidden" value="<?php echo $formid  ?>" name="formid" />
            <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
    <tr>
      <td class="form_text" valign="top">Phone Number(MOBILE):</td>
      <td><input type="text" name="cell" class="text_field" title="Enter Cell Number"/></td>
    </tr>
    <tr>
      <td class="form_text" valign="top"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
      <td><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
    </tr>
    <tr>
      <td class="form_text" valign="top">Skype ID:</td>
      <td><input type="text" name="skype" class="text_field"  title="Enter Skype ID"/></td>
    </tr>
    <tr>
      <td class="form_text" valign="top"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
      <td><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
    </tr>
    <tr>
    <td class="form_text" valign="top">Address:</td>
    <td>
    <textarea name="address" id="description" cols="45" rows="4" class="text_field_input"></textarea>
    </td>
  </tr>
    <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
    </tr>
  <tr>
    <td valign="top" class="form_text">Zip / Postal Code: </td>
    <td>
    <input type="text" name="zip" id="name" class="text_field" value="" />
    </td>
  </tr>
    <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
    </tr>
  <tr>
    <td valign="top" class="form_text">City:</td>
    <td>
    <input type="text" name="city" id="name" class="text_field" value="" />
    </td>
  </tr>
  <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
    </tr>
  <tr>
    <td valign="top" class="form_text">State:</td>
    <td>
    <input type="text" name="state" id="name" class="text_field" value=""  />
    </td>
    </td>
      <tr>
        <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
    </tr>
   </tr>
  <tr>
    <td valign="top" class="form_text">Country:</td>
    <td class="space_for_form_2">
      <select name="country" id="country" class="grad">
      <option value="000">Select Country</option>
        <option value="Afghanistan">Afghanistan</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antarctica">Antarctica</option>
                      <option value="Antigua and Barbuda">Antigua and Barbuda</option>
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
                      <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                      <option value="Botswana">Botswana</option>
                      <option value="Bouvet Island">Bouvet Island</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean territory">British Indian Ocean territory</option>
                      <option value="Brunei Darussalam">Brunei Darussalam</option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">Central African Republic</option>
                      <option value="Chad">Chad</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comoros">Comoros</option>
                      <option value="Congo">Congo</option>
                      <option value="Congo, Democratic Republic">Congo, Democratic Republic</option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Ivory Coast">Ivory Coast</option>
                      <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                      <option value="Cuba">Cuba</option>
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
                      <option value="French Southern Territories">French Southern Territories</option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guinea-Bissau">Guinea-Bissau</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Heard and McDonald Islands">Heard and McDonald Islands</option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Iran">Iran</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Korea (north)">Korea (north)</option>
                      <option value="Korea (south)">Korea (south)</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macao">Macao</option>
                      <option value="Macedonia">Macedonia</option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Micronesia">Micronesia</option>
                      <option value="Moldova">Moldova</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montenegro">Montenegro</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Namibia">Namibia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherlands">Netherlands</option>
                      <option value="Netherlands Antilles">Netherlands Antilles</option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau">Palau</option>
                      <option value="Palestinian Territories">Palestinian Territories</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Philippines">Philippines</option>
                      <option value="Pitcairn">Pitcairn</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Romania">Romania</option>
                      <option value="Russian Federation">Russian Federation</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="Saint Helena">Saint Helena</option>
                      <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                      <option value="Saint Lucia">Saint Lucia</option>
                      <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                      <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                      <option value="Samoa">Samoa</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Serbia">Serbia</option>
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
                      <option value="Taiwan">Taiwan</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania">Tanzania</option>
                      <option value="Thailand">Thailand</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Ukraine">Ukraine</option>
                      <option value="United Arab Emirates">United Arab Emirates</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option  value="United States of America">United States of America</option>
                      <option value="Uruguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Vatican City">Vatican City</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Vietnam">Vietnam</option>
                      <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                      <option value="Virgin Islands (US)">Virgin Islands (US)</option>
                      <option value="Western Sahara">Western Sahara</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Zaire">Zaire</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
      </select>
  </td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /></td>
    </tr>
        <tr>
          <td colspan="3" class="form_text"><label>
              <input name="terms" type="checkbox" value="y" class="reg_checkbox" />
              I agree with the <a href="terms.php" target="_blank">terms and conditions</a> mentioned </label></td>
        </tr>
        <tr>
          <td colspan="3" class="form_text"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /></td>
        </tr>
        <tr>
          <td class="form_text">&nbsp;</td>
          <td colspan="2" class="space_for_form_2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button"  /></td>
              <td width="79%" class="form_text">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
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

<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("registerform");
var chktestValidator  = new Validator("registerform");
frmvalidator.addValidation("firtsname","req","Please enter your first name");
frmvalidator.addValidation("email","maxlen=50");
  frmvalidator.addValidation("email","req");
  frmvalidator.addValidation("email","email" ,"Please enter a valid Email Address");
frmvalidator.addValidation("lastsname","req","Please enter your last name");

frmvalidator.addValidation("gender","dontselect=000" , "Please select gender");
frmvalidator.addValidation("date","dontselect=000" , "Please select Date");
frmvalidator.addValidation("month","dontselect=000" , "Please select Month");
frmvalidator.addValidation("year","dontselect=000" , "Please select Year");
frmvalidator.addValidation("password","req","Please enter the password");
frmvalidator.addValidation("password2","eqelmnt=password","The confirmed password is not same as the password");

frmvalidator.addValidation("check","req","This user name is not avalible. Kindly try again");

frmvalidator.addValidation("phone_home","req","Enter Phone number (home)");
frmvalidator.addValidation("cell","req","Enter Phone number (mobile)");
frmvalidator.addValidation("address","req" , "Please Enter your address");
frmvalidator.addValidation("zip","req" , "Please Enter the zip code");
frmvalidator.addValidation("city","req" , "Please Enter city");
frmvalidator.addValidation("state","req" , "Please Enter state");
frmvalidator.addValidation("country","dontselect=000" , "Please select country");
chktestValidator.addValidation("terms","shouldselchk=y","You need to accept the terms and conditions in order to proceed");

//]]></script>


<?php get_footer();
