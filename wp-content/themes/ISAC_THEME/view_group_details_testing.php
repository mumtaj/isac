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
	$gender = $user_details['gender'];
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
        <li><a href="my-isac" title="My ISAC">My ISAC</a></li>

        <!--<li>|</li>
        <li><a href="programs" title="Browse Programs">Browse Programs</a></li>
        <li>|</li>
        <li><a href="application" title="Browse Programs">Apply for a program</a></li>-->
    </ul>

                       </div>

  <!--<h1>WELCOME, <?php// echo  $username; ?></h1>-->

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
	$group_id = $app_row['group_id'];
	//
	$query_owner_gp = "SELECT * FROM application WHERE group_id = '$group_id' AND isacid = '$isacid'"; 
 	$result_owner_gp = mysql_query($query_owner_gp);
	$row_owner_gp = mysql_fetch_array($result_owner_gp);
	$gp_cost = $row_owner_gp['fee'];
	
	?>
    <div align="center" style="border-bottom:1px solid #666">
    	<h2>Group Name: <b style="font-size:16px"><?php echo $app_row['group_name']; ?></b></h2> 
        <div style="padding-bottom:6px">
        <?php
            $sql = 'SELECT * FROM group_limit';
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            echo '<b style="font-size:14px; text-align:right; ">Minimum Group Members: '.$row['minimum'].' | ';
            echo 'Maximum Group Members: '.$row['maximum'].'</b>';
        ?>
        </div>
    </div>
    <br />

    <?php
	
	if($group_mem_count < $grouplimit)
	{
		
		if(mysql_num_rows($result_owner_gp) == 0)
		{
		
		
 ?>
	<h2 class="fonts_h2_headlines">Please enter your program details:</h2>
        
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

<form action="<?php bloginfo('template_url'); ?>/isac_process/add_to_group_process.php" method="post" name="owner_applicationform" id="owner_appfrm" onsubmit="return _val(this);">
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
		// onchange=\"owner_reload(this.form)\"
        echo "<select name='owner_cat' style='width:90%' onchange=\"load_duration()\" ID=\"programs\"><option value='000' >Select Program</option>";
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
 		echo "<span id=\"dur\"><select name='owner_subcat'  style='width:80%' id='duration'>";
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
		
		echo "</select></span>";
		}// closing of for loop
		//////////////////  This will end the second drop down list ///////////
		?>
        </td>
		<td width="96">
		<?php  
		  //////////        Starting of third drop downlist /////////
			echo "<span id=\"start_date_dropdown\"><select name='owner_subcat3' style='width:80%'><option value='000' >Select</option>";
			while($arivaldate = mysql_fetch_array($owner_arrival)) 
			{ 
				$arrivaldate1 = $arivaldate['arrival_date_full'];
				
				$days = (strtotime("$arrivaldate1") - strtotime(date("d-m-Y"))) / (60 * 60 * 24);
				if($days > 0)
				{
					echo "<option value='$arivaldate[arrival_date_full]'>$arivaldate[arrival_date_full]</option>";
				}
			}
			echo "</select></span>";
			//////////////////  This will end the third drop down list ///////////
			
			?>
       	</td>
		<td width="132"><input type="text" value="<?=$firstname;?>" name="owner_name" class='grad1_hack' readonly="readonly"/></td>
		<td width="155"><input type="text" value="<?=$lastname;?>" name="owner_lastname" class='grad1_hack' readonly="readonly" /></td>
		<td width="178">
            <input type="text" value="<?=$email;?>" name="owner_email" class='grad1_hack' readonly="readonly" />
            <input type="hidden" value="owner_program" name="owner_program" class='grad1'/>
            <input type="hidden" name="gender" value="<?=$gender;?>" />
        </td>
		<td width="82" class="brn_n"><?php  
		   //////////        Starting of third drop downlist /////////
		
		if($value_set == '')
		{
		echo "<input type='text' disabled='disabled' name='fees' class='grad1_hack' id='gp_cost'/>";
		}
		else
		{
		 $cost_sum = $value_set - $start_date;
		 $cost = $base_amt +($cost_sum * $diff_amt);
		echo $cost;
		echo "<input type='text' name='fees' class='grad1_hack' disabled='disabled' value=' $ $cost' />";
		
		}
		
		//////////////////  This will end the third drop down list ///////////
		
		?><input type="hidden" value="<?php echo $cost; ?>" name="cost_fees" id='cost_fees'/>
		<input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
		<input type="hidden" value="<?php echo $value_set ?>" name="value_set" />
      </td>
   
   
   
   
  </tr>
  <tr>
    <td colspan="7" class="brn_n"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button"  /></td>
  </tr>
    </table>
    </form>



   
     
       
<?php 

	} //GroupLimit If Close
	} //Owner Already create Program or NOT
	
	if(mysql_num_rows($result_owner_gp) == 0)
	{
		
		?>
			<div style=" font-size:14px; padding:10px 20px; text-align:center">
            You will first need to select a program for your group. After this, you can add individuals to your group for the same program.
For more information on applying as a group, please read our <a href="faqs" title="FAQs" target="_blank"><u>FAQs</u></a></div>
		<?php
	}
	else
	{
		?>
        <h2 class="fonts_h2_headlines">Your details:</h2>
        
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
	
	if(mysql_num_rows($result_owner_gp) > 0)
	{
 ?>
  <br />


    
   
    
    <?php
	
	if($group_mem_count <= $grouplimit)
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

<?php

$query_display_gp = "SELECT * FROM application WHERE group_id = '$group_id' AND isacid != '$isacid' ORDER BY id desc";
$result_display_gp = mysql_query($query_display_gp);


		if(mysql_num_rows($result_display_gp) > 0)
		{
	?>
	<h2 class="fonts_h2_headlines">Your members’ details:</h2>
   
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
                <input type="hidden" name="owner" value="no" />
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
		
        <br />
        <?php
			if($group_mem_count < $grouplimit)
			{
				?>
         <h2 class="fonts_h2_headlines">Please enter the details of your group members:</h2>
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
<th width="148">First name</th>
<th>Last name</th>
<th>Email</th>
<th width="80">Gender</th>
<th class="brn_n">Cost</th>



</tr>
  <tr>
    <td width="115"><?php
//////////        Starting of first drop downlist /////////
/*
echo "<select name='cat' onchange=\"reload(this.form)\" style='width:90%' ><option value='000' >Select Program</option>";
while($noticia2 = mysql_fetch_array($quer2)) { 
if($noticia2['cat_id']==@$cat){echo "<option selected value='$noticia2[cat_id]'>$noticia2[category]</option>"."<BR>";}
else{
	echo  "<option value='$noticia2[cat_id]'>$noticia2[category]</option>";
	}
}
echo "</select>";
// selected vale for program
*/
print ($row_owner_gp['program'] != '') ? "<input type='hidden' name='program' value='".$row_owner_gp['program']."'>".$row_owner_gp['program'] : "No Owner Program";

?></td>
    <td width="92"><?php   
	
	//////////        Starting of second drop downlist /////////
/* 
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
} */
// closing of for loop
//////////////////  This will end the second drop down list ///////////

print ($row_owner_gp['duration'] != '') ? "<input type='hidden' name='duration'  value='".$row_owner_gp['duration']."'>".$row_owner_gp['duration']." Weeks" : "N/A";

?></td>
    <td width="84"><?php  
	/*
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
*/
print ($row_owner_gp['arrival'] != '') ? "<input type='hidden' name='arrival'  value='".$row_owner_gp['arrival']."'>".$row_owner_gp['arrival'] : "N/A";

?></td>
    <td ><input type="text" value="" name="name" class='grad1' /></td>
    <td width="148"><input type="text" value="" name="lastname" class='grad1'/></td>
    <td width="148"><input type="text" value="" name="email" class='grad1'/></td>
    <td ><select name="gender" class="grad1"><option value="Male" selected="selected">Male</option><option value="Female">Female</option></select></td>
    
    <td width="85" class="brn_n"><?php  
	  //////////        Starting of third drop downlist /////////

if($value_set == '')   
{
if($row_owner_gp['fee'] != 0 && $row_owner_gp['fee'] != '') 
echo "<input type='text' disabled='disabled' name='fees' class='grad1_hack' value='$". $row_owner_gp['fee']."'/>";
else echo "<input type='text' disabled='disabled' name='fees' class='grad1_hack' value=''/>";
}
else
{
	 $cost_sum = $value_set - $start_date;
 $cost = $base_amt +($cost_sum * $diff_amt);
echo "<input type='text' name='fees' class='grad1_hack' disabled='disabled' value=' $ $cost' />";
}

//////////////////  This will end the third drop down list ///////////

?><input type="hidden" value="<?=$row_owner_gp['fee'];?>" name="cost_fees" />
<input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
<input type="hidden" value="<?php echo $value_set ?>" name="value_set" />
      </td>
   
   
   
   
  </tr>
  <tr>
    
    <td  colspan="8"  class="brn_n"><input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_submit.jpg" title="SUBMIT" alt="SUBMIT" class="reg_submit_button"  /></td>
  </tr>
    </table>
    </form>
<br />
	<?php
			}
	}

	$query_display_gp01 = "SELECT * FROM application WHERE group_id = '$group_id' AND isacid != '$isacid' ORDER BY id desc";
	$result_display_gp01 = mysql_query($query_display_gp01);
	if(mysql_num_rows($result_display_gp01) == 0)
	{
		
		?>
			<div style=" font-size:14px; padding:10px 20px; text-align:center">
			You do not have any members in your group. Please add members by entering individual details above and clicking ‘Submit’.
For more information on our group application process, please read our <a href="faqs" title="FAQs" target="_blank"><u>FAQs</u></a></div>

		<?php
	}
	
	} // end group members check if
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
	
	if(mysql_num_rows($result_owner_gp) > 0)
	{ // start group members count if
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
	} // end group members count if
	}
		if($group_mem_count < $grouplimit)
		{
			if(mysql_num_rows($result_owner_gp) == 0)
			{
		
	?>
<script type="text/javascript" >//<![CDATA[
function _val(_frm) { 
var _err = '';
var owner_cat = _frm.owner_cat[_frm.owner_cat.selectedIndex].value;
var owner_subcat = _frm.owner_subcat[_frm.owner_subcat.selectedIndex].value; 
var owner_subcat3 = _frm.owner_subcat3[_frm.owner_subcat3.selectedIndex].value;
if(owner_cat == 000) _err += "Please select a Program. \n";
if(owner_subcat == 000) _err += "Please select Program Duration. \n";
if(owner_subcat3 == 000) _err += "Please select Arrival Date. \n";
if(_err) {alert(_err); return false;} else return true;
}
//]]></script>
<?php
		} //OWNER ALREDY CREATE PROGRAM OR NOT
	}//GROup LImit If
	
	} // Session Member ID
get_footer(); 
		?>