<?php

/* Template Name: edit_partner_group_members  */
?>
<?php

get_header();

?>
<SCRIPT>   
var SERVER_URL = '<?php bloginfo('template_url'); ?>/isac_process';


function load_duration()
{
	var programs= $("#programs").val();

	var dataString = 'programs='+ programs + '&p=diff';
	
	$.ajax({
		type: "POST",
		url: SERVER_URL+"/getDuration.php",
		data: dataString,
		cache: false,
		success: function(response)
		{   
			
			$("#dur").html(response);
			//$("#dur").focus();
			
			$.ajax({
				type: "POST",
				url: SERVER_URL+"/getProgramStartDate.php",
				data: dataString,
				cache: false,
				success: function(response)
				{
					
					$("#start_date_dropdown").html(response);
					//$("#start_date_dropdown").focus();
					
					
				}
			 });
		}
	 });

return false;
}

function load_cost()
{
	var duration= $("#duration").val();
	var programs2= $("#programs").val();
	
	if(duration == '000')
		$("#duration_hidden").val('');
	else
		$("#duration_hidden").val(duration);
	
	
	var dataString = 'duration='+ duration+'&programs2='+ programs2;
	
	$.ajax({
		type: "POST",
		url: SERVER_URL+"/getProgramCost_pat.php",
		data: dataString,
		cache: false,
		success: function(response)
		{
			
			$("#hid_fee").val(response.replace('$',''));
			//$("#hid_fee").val(response);
			$("#cost_fees").val(response);
			//$("#gp_cost").focus();
			
			$("#fees_hidden").val('');
		}
	 });

return false;
}

function load_start_date()
{

	var program_start_date= $("#program_start_date").val();
	
	if(program_start_date == '000')
		$("#start_date_hidden").val('');
	else
		$("#start_date_hidden").val(program_start_date);
}
</script>

<?php  
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


if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '' || $_SESSION['SESS_MEMBER_PARTNER_TYPE'] != 'PARTNER')) {
	
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
elseif($_SESSION['SESS_MEMBER_PARTNER_TYPE'] == 'PARTNER' && $_SESSION['SESS_MEMBER_ID']!='')
{

$isacid = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['SESS_FIRST_NAME'] ;
$groupid = $_SESSION['SESS_MEMBER_GROUP_ID'];



if($_POST['edit_isacid'] != '')
{
	$edit_isacid = $_POST['edit_isacid'];
	$edit_formid = $_POST['formid'];
	$edit_programid = $_POST['edit_programid'];
	$group_id = $_POST['edit_groupid'];
	
	$_SESSION['edit_isacid'] =  $edit_isacid; 
	$_SESSION['edit_formid'] =  $edit_formid; 
	$_SESSION['edit_programid'] =  $edit_programid; 
	$_SESSION['edit_groupid'] =  $group_id; 
}
else
{
	$edit_isacid = $_SESSION['edit_isacid']; 
 	$edit_formid = $_SESSION['edit_formid']; 
	$edit_programid = $_SESSION['edit_programid']; 
	$group_id = $_SESSION['edit_groupid']; 
}


$app_details = mysql_query("SELECT * FROM application WHERE isacid = '$edit_isacid' AND formid = '$edit_formid'");
while($edit_app_details = mysql_fetch_array($app_details))
{
	$edit_duration = $edit_app_details['duration'];
	$edit_firstname = $edit_app_details['firstname'];
	$edit_lastname = $edit_app_details['lastname'];
	$edit_email = $edit_app_details['email'];
	$edit_arrival = $edit_app_details['arrival'];
	$edit_fee = $edit_app_details['fee'];
	$edit_gender = $edit_app_details['gender'];
}
$isacid = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['SESS_FIRST_NAME'] ;
$partnerid = $_SESSION['SESS_MEMBER_PARTNER_ID'];
$partnername = $_SESSION['SESS_MEMBER_PARTNER_NAME'];

$partner_sql = "SELECT * FROM partner WHERE isacid = '$isacid' AND group_id = '$group_id' AND partner_id = '$partnerid'";
$partner_result = mysql_query($partner_sql);
$partner_row =  mysql_fetch_array($partner_result);

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
	<ul>
         <li><a href="create_partner_group" title="Create a group">Create a group</a></li>
          <li>|</li>
        <li><a href="student_panel_dashboard_partner" title="My Groups">My Groups</a></li>
    </ul>
                       </div><br />
<br />

  <h1>Partner Name: <?php echo  $partnername; ?></h1><br />

	<h2>Group Name: <?php echo $partner_row['group_name']; ?></h2> <br /><br />
<h3>Please edit program details:</h3>


<script type="text/javascript">
function reload(form)
{
	var val=form.cat.options[form.cat.options.selectedIndex].value; 
	self.location='edit_partner_group_members?cat=' + val ;
}
function reload3(form)
{
	var val=form.cat.options[form.cat.options.selectedIndex].value; 
	var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 
	
	self.location='edit_partner_group_members?cat=' + val + '&cat3=' + val2 ;
}

</script>

<form action="<?php bloginfo('template_url'); ?>/isac_process/edit_to_partner_group_process.php" method="post" name="applicationform" id="appfrm"  onsubmit="return _val(this)">
    <table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl" >
<?php
$quer2=mysql_query("SELECT * FROM category WHERE publish = 1 order by cat_id"); 

$cat=$_GET['cat']; // This line is added to take care if your global variable is off
if(isset($cat) and strlen($cat) > 0)
{
	$quer=mysql_query("SELECT * FROM isac_duration where program_id=$cat order by id");
	$arrival = mysql_query("SELECT * FROM  isac_arrival_table where program_id=$cat order by sno"); 
}
else
{
	$quer=mysql_query("SELECT test FROM subcategory"); 
} 
	////////// end of query for second subcategory drop down list box ///////////////////////////
	/////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3///// 

$cat3=$_GET['cat3']; // This line is added to take care if your global variable is off
if(isset($cat3) and strlen($cat3) > 0)
{
	//$quer3=mysql_query("SELECT * FROM subcategory2 where subcat_id=$cat3 order by subcat_id");
	$quer3=mysql_query("SELECT * FROM isac_duration where program_id=$cat3 order by program_id");
	$query_prtable = mysql_query("SELECT * from isac_duration where program_id = $cat3");

}
else
{
	$quer3=mysql_query("SELECT * FROM isac_duration order by id LIMIT 0, 1"); 
} 
////////// end of query for third subcategory drop down list box ///////////////////////////

?>
         
    <tr>
        <th>Program Name</th>
        <th>Program Duration</th>
        <th>Arrival</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Gender</th>
        <th class="brn_n">Cost</th>
   	</tr>
	<tr>
        <td width="174">
        <?php
        //////////        Starting of first drop downlist /////////
        echo "<select name='owner_cat' id='programs' onchange=\"load_duration()\" style='width:90%' ><option value='000' >Select Program</option>";
        while($noticia2 = mysql_fetch_array($quer2)) 
        { 
            if($_POST['edit_programid'] != '')
			{
				if($noticia2['cat_id'] == $edit_programid)
				{
					echo "<option selected value='$noticia2[cat_id]'>$noticia2[category]</option>"."<BR>";
				}
				else
				{
					echo  "<option value='$noticia2[cat_id]'>$noticia2[category]</option>";
				}
			}
			else 
			{
				if($noticia2['cat_id'] == $cat)
				{
					echo "<option selected value='$noticia2[cat_id]'>$noticia2[category]</option>"."<BR>";
				}
				else
				{
					echo  "<option value='$noticia2[cat_id]'>$noticia2[category]</option>";
				}	
			}
        }
        echo "</select>";
        // selected vale for program
        
        ?>
        </td>
        <td width="81">
		<?php   //////////        Starting of second drop downlist /////////
 		echo "<span id=\"dur\"><select name='owner_subcat' id='duration' style='width:80%'>";
		
		if($_POST['edit_programid'] != '')
		{
			$quer=mysql_query("SELECT * FROM isac_duration where program_id=$edit_programid order by id");
			
			while($noticia = mysql_fetch_array($quer))
			{ 
		
			$start_date = $noticia['start_week'];
			$end_date = $noticia['end_week'];
			$pr_id = $noticia['program_id'];
			$base_amt = $noticia['base_amount_part'];
			$diff_amt = $noticia['difference_amount_part'];
			// loop for the ittration
			
			$i = $start_date;
			
			if($noticia['id'] == $edit_programid)
			{
				
			}
			for($i;$i<=$end_date;$i++)
			{
				//end loop
				if($i == $edit_duration)
				{
					echo "<option selected='selected' value='$i'>$i weeks</option>"."<BR>";
				}
				else
				{
					echo  "<option value='$i'>$i weeks</option>";}
				}
			
			
			}// closing of for loop
		}
		else 
		{
			if($cat3 == '')
			{
				echo "<option value='000'>";
				echo "Select Duration";	
				echo "</option>";
			}
			else
			{
				$value_set = $_GET['cat3'];
				echo "<option value='$value_set'>";
			
				echo $value_set .' weeks';
				echo "</option>";
			}
	
			while($noticia = mysql_fetch_array($quer)) { 
			
			$start_date = $noticia['start_week'];
			$end_date = $noticia['end_week'];
			$pr_id = $noticia['program_id'];
			$base_amt = $noticia['base_amount_part'];
			$diff_amt = $noticia['difference_amount_part'];
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
			
			
			}// closing of for loop
		}
		
		
		
		
		echo "</select></span>";
		//////////////////  This will end the second drop down list ///////////
		?>
        </td>
		<td width="96">
		<?php  
		  //////////        Starting of third drop downlist /////////
			echo "<span id='start_date_dropdown'><select name='owner_subcat3' style='width:80%'><option value='000' >Select</option>";
				if($_POST['edit_programid'] != '')
				{
					$arrival = mysql_query("SELECT * FROM  isac_arrival_table where program_id=$edit_programid order by sno"); 
					while($arivaldate = mysql_fetch_array($arrival)) 
					{ 
						
						if($arivaldate['arrival_date_full'] == $edit_arrival)
						{
							echo "<option selected value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
						}
						else
						{
							$arrivaldate1 = $arivaldate['arrival_date_full'];
	
							$days = (strtotime("$arrivaldate1") - strtotime(date("d-m-Y"))) / (60 * 60 * 24);
							if($days > 0)
							{
								echo  "<option value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
							}
							
							
							//echo "<option value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
						}
						
						
					}
				}
				else
				{
					while($arivaldate = mysql_fetch_array($arrival)) 
					{
						$arrivaldate1 = $arivaldate['arrival_date_full'];
	
						$days = (strtotime("$arrivaldate1") - strtotime(date("d-m-Y"))) / (60 * 60 * 24);
						if($days > 0)
						{
							echo  "<option value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
						}
						
						//echo  "<option value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
					}
				}
				
				
			
		echo "</select></span>";
			//////////////////  This will end the third drop down list ///////////
			
			?>
       	</td>
		<td width="144"><input type="text" readonly="readonly" value="<?php echo $edit_firstname; ?>" name="name" class='grad1_hack' /></td>
		<td width="155"><input type="text" readonly="readonly" value="<?php echo $edit_lastname ; ?>" name="lastname" class='grad1_hack'/></td>
		<td width="168">
            <input type="text" readonly="readonly" value="<?php echo $edit_email; ?>" name="email" class='grad1_hack'/>
        </td>
        <td width="100">
        	<select name="gender" id="gender">
        	<?php
				if($edit_gender == 'Male')
				{
					echo '<option value="000">Select Gender</option>';
					echo '<option value="Male" selected="selected">Male</option>';
	            	echo '<option value="Female">Female</option>';
				}
				else if($edit_gender == 'Female')
				{
					echo '<option value="000">Select Gender</option>';
					echo '<option value="Male">Male</option>';
	            	echo '<option value="Female"  selected="selected">Female</option>';
				}
				else
				{
					echo '<option value="000" selected="selected">Select Gender</option>';
					echo '<option value="Male">Male</option>';
	            	echo '<option value="Female">Female</option>';	
				}
			?>
            </select>
        </td>
		<td width="82" class="brn_n"><?php  
		  //////////        Starting of third drop downlist /////////
		
		
		//////////////////  This will end the third drop down list ///////////
		
		
		if($_POST['edit_programid'] != '')
		{
			?>
            <input type='text' disabled='disabled' value="<?php echo '$ '.$edit_fee; ?>" name='cost_fees' class='grad1_hack' id='cost_fees' />
            <input type="hidden" value="<?php echo $edit_fee; ?>" name="hideen_fees" id="hid_fee" />
            <input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
            <input type="hidden" value="<?php echo $edit_duration; ?>" name="value_set" />
            <input type="hidden" value="<?php echo $edit_formid; ?>" name="edit_formid" />
            <input type="hidden" value="<?php echo $edit_isacid; ?>" name="edit_isacid" />
            <?php
		}
		else
		{
		?>
            <input type='text' disabled='disabled' value="<?php echo '$ '.$edit_fee; ?>" name='cost_fees' class='grad1_hack' id='cost_fees' />
            <input type="hidden" value="<?php echo $cost; ?>" name="hideen_fees" id="hid_fee" />
            <input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
            <input type="hidden" value="<?php echo $value_set ?>" name="value_set" />
            <input type="hidden" value="<?php echo $edit_formid; ?>" name="edit_formid" />
            <input type="hidden" value="<?php echo $edit_isacid; ?>" name="edit_isacid" />
        <?php
		}
		?>
      </td>
   
   
   
   
  </tr>
  <tr>
    <td class="brn_n">&nbsp;</td>
    <td class="brn_n">&nbsp;</td>
    <td class="brn_n">&nbsp;</td>
    <td class="brn_n">&nbsp;</td>
    <td class="brn_n">&nbsp;</td>
    <td class="brn_n">&nbsp;</td>
    <td >&nbsp;</td>
    <td class="brn_n"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button"  /></td>
  </tr>
    </table>
    </form>
<br />


  <br /><br /> 


    
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
<br />

<script type="text/javascript" >//<![CDATA[
//You should create the validator only after the definition of the HTML form
/*var frmvalidator  = new Validator("applicationform");

frmvalidator.addValidation("name","req","Please fill group members first name");
frmvalidator.addValidation("lastname","req","Please fill group members last name");
frmvalidator.addValidation("email","maxlen=50");
frmvalidator.addValidation("email","req");
frmvalidator.addValidation("email","email" ,"Please enter a valid login Email Address");
frmvalidator.addValidation("gender","dontselect=000" , "select gender");

frmvalidator.addValidation("cat","dontselect=000" , "select a program");
frmvalidator.addValidation("subcat","dontselect=000" , "select duration");
frmvalidator.addValidation("subcat3","dontselect=000" , "select arrival date");*/

function _val(_frm) { 
	var _err = '';
	var owner_cat = _frm.owner_cat[_frm.owner_cat.selectedIndex].value;
	var owner_subcat = _frm.owner_subcat[_frm.owner_subcat.selectedIndex].value; 
	var owner_subcat3 = _frm.owner_subcat3[_frm.owner_subcat3.selectedIndex].value;

	var gender = _frm.gender[_frm.gender.selectedIndex].value;
	
	if(owner_cat == 000) _err += "Please select a Program. \n";
	if(owner_subcat == 000) _err += "Please select Program Duration. \n";
	if(owner_subcat3 == 000) _err += "Please select Arrival Date. \n";
	if(gender == 000) _err += "Please select gender. \n";

	
	if(_err) {alert(_err); return false;} else return true;
}


//]]></script>

<?php 
}
get_footer(); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
