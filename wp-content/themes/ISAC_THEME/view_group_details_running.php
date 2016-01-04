
<?php

/* Template Name: view_group_details  */

?>

 <?php get_header();
 
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
elseif($_SESSION['SESS_MEMBER_GROUP_TYPE']=='GROUP' && $_SESSION['SESS_MEMBER_ID']!='')
{

$isacid = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['SESS_FIRST_NAME'] ;


if($_POST['group_id'] != '')
{
	$group_id = $_POST['group_id'];
	$_SESSION['SESS_GROUP_ID'] = $group_id;
}
else
{
	$group_id = $_SESSION['SESS_GROUP_ID'];
}


$reg_details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");

while($user_details = mysql_fetch_array($reg_details))
{
	$firstname = $user_details['firstname'];
	$lastname = $user_details['lastname'];
	$email = $user_details['email'];
	$isac_id = $user_details['isacid'];
}




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

                       </div><br />
<br />

  <h1>WELCOME, <?php echo  $username; ?></h1>

<br />

	<?php
		if ($_GET['status'] == 'false')
		{
			?>
            <h2 style="color:#900; text-align:center">
                <b>
                    Create group member failed!<br /> Please check email.
                </b>
            </h2>
            
            <?php
		}
		
		else if ($_GET['del'] == 'true')
		{
			?>
            <h2 style="color:#900; text-align:center">
                <b>
                    Successfully deleted.
                </b>


            </h2>
            
            <?php
		}
		else if ($_GET['del'] == 'false')
		{
			?>
            <h2 style="color:#900; text-align:center">
                <b>
                    Delete record failed!
                </b>
            </h2>
            
            <?php
		}
	?>

    <br />
 <?php
 	// GETTING GROUP LIMIT
	$grouplimit_sql = "SELECT * FROM  group_limit";
	$grouplimit_result = mysql_query($grouplimit_sql);
	$grouplimit_row = mysql_fetch_array($grouplimit_result);
	
	$grouplimit = $grouplimit_row['maximum'];
	
	$app_sql = "SELECT * FROM groups WHERE group_id = '$group_id' AND isacid = '$isacid'";
	$app_result = mysql_query($app_sql);
	$app_row = mysql_fetch_array($app_result);
	
	$group_mem_count = $app_row['group_members'];
	
	$query_owner_gp = "SELECT * FROM application WHERE group_id = '$group_id' AND isacid = '$isacid'";
 	$result_owner_gp = mysql_query($query_owner_gp);
	$row_owner_gp = mysql_fetch_array($result_owner_gp);
	
	?>
    <h2>Group Name: <?php echo $app_row['group_name']; ?></h2> 
    <div style="float: right; margin-top: -35px">
    <?php
		$sql = 'SELECT * FROM group_limit';
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		echo '<b style="font-size:16px; text-align:right; ">Minimum Group Members: '.$row['minimum'].'</b><br />';
		echo '<b style="font-size:16px; text-align:right; ">Maximum Group Members: '.$row['maximum'].'</b>';
	?>
    </div>
    <br /><br />
    <h3 style="">Please enter your program details:</h3>

    <?php
	
	if($group_mem_count < $grouplimit)
	{
		
		if(mysql_num_rows($result_owner_gp) == 0)
		{
		
	
 ?>

<script type="text/javascript">
function owner_reload(form)
{
	var owner_val=form.owner_cat.options[form.owner_cat.options.selectedIndex].value; 
	self.location='view_group_details?owner_cat=' + owner_val ;
}
function owner_reload3(form)
{
	var owner_val=form.owner_cat.options[form.owner_cat.options.selectedIndex].value; 
	var owner_val2=form.owner_subcat.options[form.owner_subcat.options.selectedIndex].value; 
	
	self.location='view_group_details?owner_cat=' + owner_val + '&owner_cat3=' + owner_val2 ;
}

</script>

<form action="<?php bloginfo('template_url'); ?>/isac_process/add_to_group_process.php" method="post" name="owner_applicationform" id="owner_appfrm"  >
    <table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl" >
<?php
$owner_quer2=mysql_query("SELECT * FROM category WHERE publish = 1 order by cat_id"); 

$owner_cat=$_GET['owner_cat']; // This line is added to take care if your global variable is off
if(isset($owner_cat) and strlen($owner_cat) > 0)
{
	$owner_quer=mysql_query("SELECT * FROM isac_duration where program_id=$owner_cat order by id");
	$owner_arrival = mysql_query("SELECT * FROM  isac_arrival_table where program_id=$owner_cat order by sno"); 
}
else
{
	$owner_quer=mysql_query("SELECT test FROM isac_duration"); 
} 
	////////// end of query for second subcategory drop down list box ///////////////////////////
	/////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3///// 

$owner_cat3=$_GET['owner_cat3']; // This line is added to take care if your global variable is off
if(isset($owner_cat3) and strlen($owner_cat3) > 0)
{
	//$quer3=mysql_query("SELECT * FROM subcategory2 where subcat_id=$cat3 order by subcat_id");
	$owner_quer3=mysql_query("SELECT * FROM isac_duration where program_id=$owner_cat3 order by program_id");
	$owner_query_prtable = mysql_query("SELECT * from isac_duration where program_id = $owner_cat3");

}
else
{
	$owner_quer3=mysql_query("SELECT * FROM isac_duration order by id LIMIT 0, 1"); 
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
        <th class="brn_n">Cost</th>
   	</tr>
	<tr>
        <td width="174">
        <?php
        //////////        Starting of first drop downlist /////////
        echo "<select name='owner_cat' onchange=\"owner_reload(this.form)\" style='width:90%' ><option value='000' >Select Program</option>";
        while($owner_noticia2 = mysql_fetch_array($owner_quer2)) 
        { 
            if($owner_noticia2['cat_id']==@$owner_cat)
            {

                echo "<option selected value='$owner_noticia2[cat_id]'>$owner_noticia2[category]</option>"."<BR>";
            }
            else
            {
            echo  "<option value='$owner_noticia2[cat_id]'>$owner_noticia2[category]</option>";
            }
        }
        echo "</select>";
        // selected vale for program
        
        ?>
        </td>
        <td width="81">
		<?php   //////////        Starting of second drop downlist /////////
 		echo "<select name='owner_subcat' onchange=\"owner_reload3(this.form)\" style='width:80%'>";
		 if($owner_cat3 == '')
		 {
			echo "<option value='000'>";
			echo "Select Duration";	
			echo "</option>";
		}
		else
		{
			$value_set = $_GET['owner_cat3'];
			echo "<option value='$value_set'>";
		
			echo $value_set .' weeks';
			echo "</option>";
		}

		while($owner_noticia = mysql_fetch_array($owner_quer)) { 
		
		$start_date = $owner_noticia['start_week'];
		$end_date = $owner_noticia['end_week'];
		$pr_id = $owner_noticia['program_id'];
		$base_amt = $owner_noticia['base_amount_gp'];
		$diff_amt = $owner_noticia['difference_amount_gp'];
		// loop for the ittration
		
		$i = $start_date;
		
		
		for($i;$i<=$end_date;$i++)
		{
			//end loop
			if($$owner_noticia['id']==@$owner_cat3)
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
		?>
        </td>
		<td width="96">
		<?php  
		  //////////        Starting of third drop downlist /////////
			echo "<select name='owner_subcat3' style='width:80%'><option value='000' >Select</option>";
			while($arivaldate = mysql_fetch_array($owner_arrival)) 
			{ 
				$arrivaldate1 = $arivaldate['arrival_date_full'];
				
				$days = (strtotime("$arrivaldate1") - strtotime(date("d-m-Y"))) / (60 * 60 * 24);
				if($days > 0)
				{
					echo "<option value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
				}
			}
			echo "</select>";
			//////////////////  This will end the third drop down list ///////////
			
			?>
       	</td>
		<td width="144"><input type="text" value="<?=$firstname;?>" name="owner_name" class='grad1' readonly="readonly" /></td>
		<td width="155"><input type="text" value="<?=$lastname;?>" name="owner_lastname" class='grad1' readonly="readonly" /></td>
		<td width="168">
            <input type="text" value="<?=$email;?>" name="owner_email" class='grad1' readonly="readonly" />
            <input type="hidden" value="owner_program" name="owner_program" class='grad1'/>
        </td>
		<td width="82" class="brn_n"><?php  
		  //////////        Starting of third drop downlist /////////
		
		if($value_set == '')
		{
		echo "<input type='text' disabled='disabled' name='fees' class='grad1' />";
		}
		else
		{
		 $cost_sum = $value_set - $start_date;
		$cost = $base_amt +($cost_sum * $diff_amt);
		echo "<input type='text' name='fees' class='grad1' disabled='disabled' value=' $ $cost' />";
		}
		
		//////////////////  This will end the third drop down list ///////////
		
		?><input type="hidden" value="<?php echo $cost; ?>" name="cost_fees" />
		<input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
		<input type="hidden" value="<?php echo $value_set ?>" name="value_set" />
      </td>
   
   
   
   
  </tr>
  <tr>
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


   
     
       
<?php 

	} //GroupLimit If Close
	} //Owner Already create Program or NOT
	
	if(mysql_num_rows($result_owner_gp) == 0)
	{
		
		?>
			<h2 style="color:#930; text-align:center"><b>You have no Programs.</b></h2>
		<?php
	}
	else
	{
		?>
        <table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
            <tr>
                <th>Program Name</th>
                <th>Program Duration</th>
                <th>Arrival</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th >Cost</th>
                <th >Edit</th>
                <th class="brn_n">Delete</th>
            </tr>
                 
            <tr>
                <td width="150"><?php echo $row_owner_gp['program'] ?></td>
                <td width="150"><?php echo $row_owner_gp['duration'].' '.'Weeks' ?></td>
                <td width="150"><?php echo $row_owner_gp['arrival'] ?></td>
                <td width="150"><?php echo $row_owner_gp['firstname'] ?></td>
                <td width="150"><?php echo $row_owner_gp['lastname'] ?></td>
                <td width="150"><?php echo $row_owner_gp['email'] ?></td>
                <td width="150">$<?php echo $row_owner_gp['fee'] ?></td>
                <td width="150">
                	<form action="<?php echo SERVER_URL;?>student_panel_dashboard_group_edit" method="post" onsubmit="return confirm('Are you sure you want to edit this record?')">
                    <input type="hidden" value="<?php echo $row_owner_gp['formid'];?>" name="formid" />
                    <input type="hidden" value="<?php echo $row_owner_gp['isacid'];?>" name="edit_isacid" />
                    <input type="hidden" value="<?php echo $group_id;?>" name="edit_groupid" />
                    <input type="hidden" value="<?php echo $row_owner_gp['program_id'];?>" name="edit_programid" />
                    <input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_edit.jpg" value="EDIT" />
                </form>
                </td>
                <td width="150" class="brn_n">
                	<form action="<?php bloginfo('template_url'); ?>/isac_process/delete_to_group_process.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                        <input type="hidden" value="<?php echo $row_owner_gp['formid'];?>" name="formid" />
                        <input type="hidden" value="<?php echo $row_owner_gp['isacid'];?>" name="del_isacid" />
                        <input type="hidden" value="<?php echo $group_id;?>" name="edit_groupid" />
                        <input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_delete.png" value="DELETE" />
                    </form>
            </tr>
        </table>
 		<?php
	}
	
	
 ?>
  <br /><br /> 


    <h3>Please enter group members and their program details:</h3>
    
    <?php
	
	if($group_mem_count < $grouplimit)
	{
	
		?>
 
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
self.location='view_group_details?cat=' + val ;
}
function reload3(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 

self.location='view_group_details?cat=' + val + '&cat3=' + val2 ;
}

</script>

 <form action="<?php bloginfo('template_url'); ?>/isac_process/add_to_group_process.php" method="post" name="applicationform1" id="appfrm"  >
    <table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl" >
<?php
$quer2=mysql_query("SELECT * FROM category WHERE publish = 1 order by cat_id"); 

$cat=$_GET['cat']; // This line is added to take care if your global variable is off
if(isset($cat) and strlen($cat) > 0){
$quer=mysql_query("SELECT * FROM isac_duration where program_id=$cat order by id");
$arrival = mysql_query("SELECT * FROM  isac_arrival_table where program_id=$cat order by sno"); 
}else{$quer=mysql_query("SELECT test FROM isac_duration"); } 
////////// end of query for second subcategory drop down list box ///////////////////////////
/////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3///// 
$cat3=$_GET['cat3']; // This line is added to take care if your global variable is off
if(isset($cat3) and strlen($cat3) > 0){
//$quer3=mysql_query("SELECT * FROM subcategory2 where subcat_id=$cat3 order by subcat_id");
$quer3=mysql_query("SELECT * FROM isac_duration where program_id=$cat3 order by program_id");
 
$query_prtable = mysql_query("SELECT * from isac_duration where program_id = $cat3");

}else{$quer3=mysql_query("SELECT * FROM isac_duration order by id LIMIT 0, 1"); } 
////////// end of query for third subcategory drop down list box ///////////////////////////

?>
         
  <tr>
<th>Program Name</th>
<th>Program Duration</th>
<th>Arrival</th>
<th>First name</th>
<th>Last name</th>
<th>Email</th>
<th class="brn_n">Cost</th>



</tr>
  <tr>
    <td width="174"><?php
//////////        Starting of first drop downlist /////////
echo "<select name='cat' onchange=\"reload(this.form)\" style='width:90%' ><option value='000' >Select Program</option>";
while($noticia2 = mysql_fetch_array($quer2)) { 
if($noticia2['cat_id']==@$cat){echo "<option selected value='$noticia2[cat_id]'>$noticia2[category]</option>"."<BR>";}
else{
	echo  "<option value='$noticia2[cat_id]'>$noticia2[category]</option>";
	}
}
echo "</select>";
// selected vale for program

?></td>
    <td width="81"><?php   //////////        Starting of second drop downlist /////////
 
 if($cat3=='')
 {
	 
echo "<select name='subcat' onchange=\"reload3(this.form)\" style='width:80%'><option value='000'>";
echo "Select Duration";	
	echo "</option>";

}

else
{
	$value_set = $_GET['cat3'];
	echo "<select name='subcat' onchange=\"reload3(this.form)\" style='width:80%'><option value=''>";

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

echo "</select>";
}// closing of for loop
//////////////////  This will end the second drop down list ///////////
?></td>
    <td width="96"><?php  
	  //////////        Starting of third drop downlist /////////
echo "<select name='subcat3' style='width:80%'><option value='000' >Select</option>";
while($arivaldate = mysql_fetch_array($arrival)) 
{ 
	$arrivaldate1 = $arivaldate['arrival_date_full'];
	
	$days = (strtotime("$arrivaldate1") - strtotime(date("d-m-Y"))) / (60 * 60 * 24);
	if($days > 0)
	{
		echo "<option value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
	}
	
	//echo  "<option value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
}
echo "</select>";
//////////////////  This will end the third drop down list ///////////

?></td>
    <td width="144"><input type="text" value="" name="name" class='grad1' /></td>
    <td width="155"><input type="text" value="" name="lastname" class='grad1'/></td>
    <td width="168"><input type="text" value="" name="email" class='grad1'/></td>
    <td width="82" class="brn_n"><?php  
	  //////////        Starting of third drop downlist /////////

if($value_set == '')
{
echo "<input type='text' disabled='disabled' name='fees' class='grad1' />";
}
else
{
	 $cost_sum = $value_set - $start_date;
 $cost = $base_amt +($cost_sum * $diff_amt);
echo "<input type='text' name='fees' class='grad1' disabled='disabled' value=' $ $cost' />";
}

//////////////////  This will end the third drop down list ///////////

?><input type="hidden" value="<?php echo $cost; ?>" name="cost_fees" />
<input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
<input type="hidden" value="<?php echo $value_set ?>" name="value_set" />
      </td>
   
   
   
   
  </tr>
  <tr>
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
	<?php
	}
$query_display_gp = "SELECT * FROM application WHERE group_id = '$group_id' AND isacid != '$isacid' ORDER BY id desc";
$result_display_gp = mysql_query($query_display_gp);


		if(mysql_num_rows($result_display_gp) == 0)
		{
			
			?>
				<h2 style="color:#930; text-align:center"><b>You have no Group Members.</b></h2>
			<?php
		}
		else
		{
	?>

   
      <table width="900" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
       <tr>
  <tr>
<th>Program Name</th>
<th>Program Duration</th>
<th>Arrival</th>
<th>First name</th>
<th>Last name</th>
<th>Email</th>
<th >Cost</th>
<th >Edit</th>
<th class="brn_n">Delete</th>
  </tr>
<?php 

	

			while($row_display_gp=mysql_fetch_array($result_display_gp))
			{ 
			
			?>
				 
	  <tr>
		<td width="150"><?php echo $row_display_gp['program']; ?></td>
		<td width="150"><?php echo $row_display_gp['duration'].' '.'Weeks' ?></td>
		<td width="150"><?php echo $row_display_gp['arrival'] ?></td>
		<td width="150"><?php echo $row_display_gp['firstname'] ?></td>
		<td width="150"><?php echo $row_display_gp['lastname'] ?></td>
		<td width="150"><?php echo $row_display_gp['email'] ?></td>
		<td width="150">$<?php echo $row_display_gp['fee'] ?></td>
		<td width="150">
			<form action="<?php echo SERVER_URL;?>student_panel_dashboard_group_edit" method="post" onsubmit="return confirm('Are you sure you want to edit this record?')">
				<input type="hidden" value="<?php echo $row_display_gp['formid'];?>" name="formid" />
				<input type="hidden" value="<?php echo $row_display_gp['isacid'];?>" name="edit_isacid" />
                <input type="hidden" value="<?php echo $group_id;?>" name="edit_groupid" />
				<input type="hidden" value="<?php echo $row_display_gp['program_id'];?>" name="edit_programid" />
				<input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_edit.jpg" value="EDIT" />
			</form>
	   </td>
		<td width="150" class="brn_n">  
			<form action="<?php bloginfo('template_url'); ?>/isac_process/delete_to_group_process.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
				<input type="hidden" value="<?php echo $row_display_gp['formid'];?>" name="formid" />
				<input type="hidden" value="<?php echo $row_display_gp['isacid'];?>" name="del_isacid" />
                <input type="hidden" value="<?php echo $group_id;?>" name="edit_groupid" />
				<input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_delete.png" value="DELETE" />
			</form>
		</td>
	  </tr>
	
	<?php
	  }
	// Your while loop here		
		?>
        </table>
        <?php
		} // record Count Else end here
	
		?>
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
<?php 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if($group_mem_count < $grouplimit)
	{
		?>
<script type="text/javascript" >//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("applicationform1");

frmvalidator.addValidation("name","req","Please fill group members first name");
frmvalidator.addValidation("lastname","req","Please fill group members last name");
frmvalidator.addValidation("email","maxlen=50");
  frmvalidator.addValidation("email","req");
  frmvalidator.addValidation("email","email" ,"Please enter a valid login Email Address");

frmvalidator.addValidation("cat","dontselect=000" , "select a program");
frmvalidator.addValidation("subcat","dontselect=000" , "select duration");
frmvalidator.addValidation("subcat3","dontselect=000" , "select arrival date");
//]]></script>
	<?php
	}
		if($group_mem_count < $grouplimit)
		{
			if(mysql_num_rows($result_owner_gp) == 0)
			{
		
	?>
<script type="text/javascript" >//<![CDATA[
//You should create the validator only after the definition of the HTML form
var owner_frmvalidator  = new Validator("owner_applicationform");

owner_frmvalidator.addValidation("owner_name","req","Please fill group members first name");
owner_frmvalidator.addValidation("owner_lastname","req","Please fill group members last name");
owner_frmvalidator.addValidation("owner_email","maxlen=50");
owner_frmvalidator.addValidation("owner_email","req");
owner_frmvalidator.addValidation("owner_email","email" ,"Please enter a valid login Email Address");

owner_frmvalidator.addValidation("owner_cat","dontselect=000" , "select a program");
owner_frmvalidator.addValidation("owner_subcat","dontselect=000" , "select duration");
owner_frmvalidator.addValidation("owner_subcat3","dontselect=000" , "select arrival date");

//]]></script>
<?php
		} //OWNER ALREDY CREATE PROGRAM OR NOT
	}//GROup LImit If
	
	} // Session Member ID
get_footer(); 
		?>