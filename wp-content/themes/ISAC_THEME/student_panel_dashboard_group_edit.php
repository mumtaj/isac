<?php

/* Template Name: student_panel_dashboard_group_edit  */

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
			$("#dur").focus();
			
			$.ajax({
				type: "POST",
				url: SERVER_URL+"/getProgramStartDate.php",
				data: dataString,
				cache: false,
				success: function(response)
				{
					$("#start_date_dropdown").html(response);
					$("#start_date_dropdown").focus();
					
					
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
		url: SERVER_URL+"/getProgramCost_gp.php",
		data: dataString,
		cache: false,
		success: function(response)
		{
			
			$("#gp_cost").val(response);
			$("#cost_fees").val(response.replace('$',''));
			$("#gp_cost").focus();
			
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


if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '' || $_SESSION['SESS_MEMBER_GROUP_TYPE']!='GROUP')) {
	
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
      <span style="color:#F00; font-size:18px; text-align:center"><strong>
Please log in to continue</strong></span><br />
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
elseif($_SESSION['SESS_MEMBER_GROUP_TYPE']=='GROUP' && $_SESSION['SESS_MEMBER_ID']!='')
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


$reg_details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");
while($user_details = mysql_fetch_array($reg_details))
{
	$firstname = $user_details['firstname'];
	$lastname = $user_details['lastname'];
	$email = $user_details['email'];
	$isac_id = $user_details['isacid'];
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
	$prg = $edit_app_details['program'];
	$edit_sex = $edit_app_details['gender'];
}


$isacid = $_SESSION['SESS_MEMBER_ID'];



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
        <li><a href="my_groups" title="Browse Programs"><b>My Groups</b></a></li>
        <li>|</li>
        <li><a href="register-update" title="Apply a Program">Personal Information</a></li>
        <li>|</li>
        <li><a href="programs" title="Browse Programs">Browse Programs</a></li>
        <li>|</li>
        <li><a href="application" title="Browse Programs">Apply for a program</a></li>
    </ul>

                       </div>

	
<h2 class="fonts_h2_headlines">Edit your program details</h2>

    <br />

<script  src="<?php echo SERVER_URL; ?>js/gen_validatorv4.js" type="text/javascript"></script>
<script type="text/javascript">
function reload(form)
{
	var val=form.cat.options[form.cat.options.selectedIndex].value; 
	self.location='student_panel_dashboard_group_edit?cat=' + val ;
}
function reload3(form)
{
	var val=form.cat.options[form.cat.options.selectedIndex].value; 
	var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 
	
	self.location='student_panel_dashboard_group_edit?cat=' + val + '&cat3=' + val2 ;
}

</script>

<form action="<?php bloginfo('template_url'); ?>/isac_process/edit_to_group_process.php" method="post" name="applicationform" id="appfrm"  onsubmit="return _val(this)">
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
	$quer3=mysql_query("SELECT * FROM subcategory2 where subcat_id=$cat3 order by subcat_id");
	$query_prtable = mysql_query("SELECT * from isac_duration where program_id = $cat3");

}
else
{
	$quer3=mysql_query("SELECT * FROM isac_duration order by id LIMIT 0, 1"); 
} 
////////// end of query for third subcategory drop down list box ///////////////////////////

$owner = (!empty($_POST['owner']) && $_POST['owner'] == 'no') ? false : true;
?>
         
    <tr>
        <th>Program Name</th>
        <th>Program Duration</th>
        <th>Arrival</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <?php  if(!$owner) { print"<th>Gender</th>"; } ?>
        <th width="41" class="brn_n">Cost</th>
   	</tr>
	<tr>
        <td width="145">
        <?php
	

		
        //////////        Starting of first drop downlist /////////
		if($owner) {
        echo "<select name='cat'  style='width:90%' onchange=\"load_duration()\" ID=\"programs\"><option value='000' >Select Program</option>";
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
		} //owner if end
		else print "<input type='hidden' name='cat' value='".$prg."' >".$prg;
        ?>
        </td>
        <td width="105">
		<?php   //////////        Starting of second drop downlist /////////
		//onchange=\"reload3(this.form)\"
		if($owner) {
 		echo "<span id=\"dur\"><select name='owner_subcat'  style='width:80%' id='duration' onchange='load_cost()'>";
		
		if($_POST['edit_programid'] != '')
		{
			$quer=mysql_query("SELECT * FROM isac_duration where program_id=$edit_programid order by id");
			
			while($noticia = mysql_fetch_array($quer))
			{ 
		
			$start_date = $noticia['start_week'];
			$end_date = $noticia['end_week'];
			$pr_id = $noticia['program_id'];
			$base_amt = $noticia['base_amount_gp'];
			$diff_amt = $noticia['difference_amount_gp'];
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
			$base_amt = $noticia['base_amount_gp'];
			$diff_amt = $noticia['difference_amount_gp'];
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
		} //owner if end
		else print "<input type='hidden' name='owner_subcat' value='".$edit_duration."' >".$edit_duration." Weeks";
		?>
        </td>
		<td width="83">
		<?php  
		  //////////        Starting of third drop downlist /////////
		  if($owner) {
			echo "<select name='arrival' style='width:80%'><option value='000' >Select</option>";
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
								echo "<option value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
							}
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
					}
				}
				
		} //owner if end
		else print "<input type='hidden' name='arrival' value='".$edit_arrival."' >".$edit_arrival;		
			
			//echo "</select>";
			//////////////////  This will end the third drop down list ///////////
			
			?>
       	</td>
		<td width="124">
        <?php  if($owner) { ?>    <input type="text" readonly="readonly" value="<?php echo $edit_firstname; ?>" name="name" class='grad1' /><input type="hidden" name="owner_js" value="yes" /><?php } else { ?> <input type="text" value="<?php echo $edit_firstname; ?>" name="name" class='grad1' /><input type="hidden" name="owner_js" value="no" /><?php } ?>
        
        
        </td>
		<td width="126">
        <?php  if($owner) { ?>
        <input type="text" readonly="readonly" value="<?php echo $edit_lastname ; ?>" name="lastname" class='grad1'/><?php } else { ?>
         <input type="text"  value="<?php echo $edit_lastname ; ?>" name="lastname" class='grad1'/><?php } ?>
        
        </td>
		<td width="138">
        <?php  if($owner) { ?>
            <input type="text" readonly="readonly" value="<?php echo $edit_email; ?>" name="email" class='grad1'/><?php } else { ?>
             <input type="text"   value="<?php echo $edit_email; ?>" name="email" class='grad1'/><input type="hidden" name="ind_update" value="yes" />
            <?php } ?>
        </td>
        
         <?php  if(!$owner) { ?>
        <td>
        <select name="gender" class="grad1">
       <?php 
	   if($edit_sex == 'Male') 
	   print '<option value="Male" selected="selected">Male</option>
        <option value="Female">Female</option>';
		else print '<option value="Male">Male</option>
        <option value="Female" selected="selected">Female</option>';
        ?>
        </select>
        
        </td>
        <?php } ?>
		<td width="68" class="brn_n"><?php  
		  //////////        Starting of third drop downlist /////////
		
		if($_POST['edit_programid'] != '')
		{
			echo "<input type='text' disabled='disabled' name='fees' value=$".$edit_fee." class='grad1' id='gp_cost'/>";
		}
		else
		{
			if($value_set == '')
			{
				echo "<input type='text' disabled='disabled' name='fees' class='grad1' id='gp_cost' value='$".$edit_fee."' />";
			}
			else
			{
				$cost_sum = $value_set - $start_date;
				$cost = $base_amt +($cost_sum * $diff_amt);
				echo "<input type='text' name='fees' class='grad1' disabled='disabled' value=' $ $cost' />";
			}
		}
		
		//////////////////  This will end the third drop down list ///////////
		
		
		if($_POST['edit_programid'] != '')
		{
			?>
            <input type="hidden" value="<?php echo $edit_fee; ?>" name="cost_fees" id='cost_fees' />
            <input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
            <input type="hidden" value="<?php echo $$edit_duration; ?>" name="value_set" />
            <input type="hidden" value="<?php echo $edit_formid; ?>" name="edit_formid" />
            <input type="hidden" value="<?php echo $edit_isacid; ?>" name="edit_isacid" />
            <?php
		}
		else
		{
		?>

        
            <input type="hidden" value="<?php echo $cost; ?>" name="cost_fees" />
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
    <td colspan="7" class="brn_n" style="text-align:center"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button"  /></td>
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
function _val(_frm) { 
var _err = '';
var owner =  (_frm.owner_js.value == 'yes') ? true : false ;
if(owner) { 
var cat = _frm.cat[_frm.cat.selectedIndex].value;
var owner_subcat = _frm.owner_subcat[_frm.owner_subcat.selectedIndex].value; 
var arrival = _frm.arrival[_frm.arrival.selectedIndex].value;
if(cat == 000) _err += "Please select a Program. \n";
if(owner_subcat == 000) _err += "Please select Program Duration. \n";
if(arrival == 000) _err += "Please select Arrival Date. \n"; }

if(!owner) { 
var fname = _frm.name.value;
var lname = _frm.lastname.value;
var email = _frm.email.value.match(/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/);
if(!fname) _err += "Please enter First Name. \n";
if(!lname) _err += "Please enter Last Name. \n";
if(!email) _err += "Please enter a valid Email Address. \n"; }


if(_err) {alert(_err); return false;} else return true;
}
//]]></script>
<?php 
}
get_footer(); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>