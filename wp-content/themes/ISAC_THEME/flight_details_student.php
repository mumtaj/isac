<?php

/* Template Name: flight_details  */

?>
<?php
if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '' )) {
	
	?>
<?php get_header(); ?>
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
          <br />
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

<?php  //session variable
$isacid = $_SESSION['SESS_MEMBER_ID'];

// getting the form id 
$formid = $_POST['formid'];
$program_name = $_POST['program_name'];


$details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");


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
$isacid = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['SESS_FIRST_NAME'] ;
$groupid = $_SESSION['SESS_MEMBER_GROUP_ID'];

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
    <h2 class="fonts_h2_footer">Your flight details</h2>
    <div style="text-align:right;padding-top:5px">
    <h4 style="margin:5px 0" >Student name: <span style="font-weight:normal !important"><?php echo $username;   ?></span></h4>
    <h4>Program name: <span style="font-weight:normal !important"><?php echo $program_name;   ?></span></h4>
    </div>
    <h4 style="margin-top:15px;text-align:center;font-size:15px">Please only enter information about the last leg of your journey into India</h4>
    <img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" />
    <form action="<?php bloginfo('template_url'); ?>/isac_process/flight_action.php" method="post" name="applicationform1" id="appfrm" >
      <table width="545" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
       <tr>
          <td class="form_text text_aln_rt">Arriving From<br /></td>
          <td class="space_for_form_2"><input type="text" name="arrivingfrom" value="" /></td>
        </tr>
        <tr>
          <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text text_aln_rt"> Terminal no. </td>
          <td class="space_for_form_2"><input type="text" name="arrival_details"/></td>
        </tr>
        <tr>
          <td width="155" class="form_text text_aln_rt">Flight name</td>
          <td width="376" class="space_for_form"><input  type="text" name="name" value=""/></td>
        </tr>
        <tr>
          <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text text_aln_rt">Flight number</td>
          <td class="space_for_form_2"><input  type="text" name="fno" value=""/></td>
        </tr>
        <tr>
          <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text text_aln_rt">Arrival date</td>
          <td class="space_for_form_2"><select name="date" id="date" class="dropdown_small">
              <option value="000"  selected="selected">Date</option>
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
              <option value="000"  selected="selected">Month</option>
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
              <option value="000" selected="selected">Year</option>
              <option value="2012">2012</option>
              <option value="2013">2013</option>
              <option value="2014">2014</option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
            </select></td>
        </tr>
        <tr>
          <td colspan="3"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="3" /></td>
        </tr>
        <tr>
          <td class="form_text text_aln_rt">Arrival time (IST)</td>
          <td class="space_for_form_2"><select name="time" id="time" class="dropdown_small">
              <option value="000"  selected="selected">Time</option>
              <option value="1.00">1:00</option>
              <option value="1:30">1:30</option>
              <option value="2:00">2:00</option>
               <option value="2:30">2:30</option>
              <option value="3:00">3:00</option>
                <option value="3:30">3:30</option>
              <option value="4:00">4:00</option>
                <option value="4:30">4:30</option>
              <option value="5:00">5:00</option>
              <option value="5:30">5:30</option>
              <option value="6:00">6:00</option>
              <option value="6:30">6:30</option>
              <option value="7:00">7:00</option>
                 <option value="7:30">7:30</option>
              <option value="8:00">8:00</option>
               <option value="8:30">8:30</option>
              <option value="9:00">9:00</option>
               <option value="9:30">9:30</option>
              <option value="10:00">10:00</option>
               <option value="10:30">10:30</option>
              <option value="11:00">11:00</option>
              <option value="11:30">11:30</option>
              <option value="12:00">12:00</option>
               <option value="12:30">12:30</option>
            </select>
            
            <select name="ampm" id="ampm" class="dropdown_small">
              <option value="AM"  selected="selected">AM</option>
              <option value="PM">PM</option>
             
            </select>
            
          </td>
        </tr>
       
   <!--  ---------------------------------------------------------------------------------------------->

        
        <tr>
          <td colspan="2" class="form_text"><img src="<?php bloginfo('template_url'); ?>/images/spacer.gif" width="1" height="8" /></td>
        </tr>
        <tr>
          <input type="hidden" value="<?php echo $formid ?>" name="formid" />
          <td colspan="2" class="form_text" style="text-align:center"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button" /></td>
          </tr>
        <tr>
        <td colspan="2" class="note">&nbsp;</td>
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
          <br />
        </div>
    </div>
</div>
<div class="cleared"></div>

<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("applicationform1");





frmvalidator.addValidation("date","dontselect=000" , "select arrival date");
frmvalidator.addValidation("month","dontselect=000" , "select arrival month");
frmvalidator.addValidation("year","dontselect=000" , "select arrival year");
frmvalidator.addValidation("time","dontselect=000" , "select arrival time");
frmvalidator.addValidation("name","req","Please enter name of flight");
frmvalidator.addValidation("fno","req","Please enter flight number");
frmvalidator.addValidation("arrivingfrom","req","Please fill the arriving Form field");
frmvalidator.addValidation("arrival_details","req","Please enter Arrival/Departure Information");



//]]></script>


<?php get_footer(); ?>
<?php } ?>
