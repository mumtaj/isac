<?php
    session_start();

    $admin_name = $_SESSION['SESS_FIRST_NAME'];

	require_once('auth.php');
	require_once('config.php');
	
	$errmsg_arr = array();
	//$errflag = false;
	
	if ($_POST['formid'] == '')
	{
		$formid = $_SESSION['formid_isac'];
		
	}
	else if  ($_POST['formid'] != '')
	{
		$formid = $_POST['formid'];
	}
	
    $query = "SELECT * FROM application WHERE formid = '$formid'";
    $result = mysqlquery($query);

    while ( $row = mysqli_fetch_array($result) )
    { 
        $isacid = ( !empty($row['isacid']) ) ? $row['isacid'] : ''; 
        $firstname = ( !empty($row['firstname']) ) ? $row['firstname'] : ''; 
        $email = ( !empty($row['email']) ) ? $row['email'] : ''; 
        $lastname = ( !empty($row['lastname']) ) ? $row['lastname'] : ''; 
        $program = ( !empty($row['program']) ) ? $row['program'] : ''; 
        $duration = ( !empty($row['duration']) ) ? $row['duration'] : ''; 
        $arrival = ( !empty($row['arrival']) ) ? $row['arrival'] : ''; 
        $fee = ( !empty($row['fee']) ) ? $row['fee'] : ''; 
        $formdate = ( !empty($row['formdate']) ) ? $row['formdate'] : ''; 
        $flag = ( !empty($row['flag']) ) ? $row['flag'] : ''; 
        $registration_fee = ( !empty($row['registration_fee']) ) ? $row['registration_fee'] : ''; 
        $first_installment = ( !empty($row['first_installment']) ) ? $row['first_installment'] : ''; 
        $second_installment = ( !empty($row['second_installment']) ) ? $row['second_installment'] : ''; 
        $fee_second_installment = ( !empty($row['fee_second_installment']) ) ? $row['fee_second_installment'] : ''; 
        $fee_first_installment = ( !empty($row['fee_first_installment']) ) ? $row['fee_first_installment'] : ''; 

        $full_payment = ( !empty($row['full_payment']) ) ? $row['full_payment'] : ''; 
        $paid_status = ( !empty($row['paid_status']) ) ? $row['paid_status'] : ''; 
        $user_type = ( !empty($row['user_type']) ) ? $row['user_type'] : ''; 

        $first_reminder = ( !empty($row['first_reminder']) ) ? $row['first_reminder'] : ''; 
        $second_reminder = ( !empty($row['second_reminder']) ) ? $row['second_reminder'] : ''; 
        $final_reminder = ( !empty($row['final_reminder']) ) ? $row['final_reminder'] : ''; 
        $Date_last_reminder = ( !empty($row['Date_last_reminder']) ) ? $row['Date_last_reminder'] : ''; 

        $medical_status = ( !empty($row['medical_status']) ) ? $row['medical_status'] : ''; 
        $acc_status = ( !empty($row['acceptance_sent']) ) ? $row['acceptance_sent'] : ''; 
        $doc1_status = ( !empty($row['doc_1']) ) ? $row['doc_1'] : ''; 
        $doc2_status = ( !empty($row['doc2']) ) ? $row['doc2'] : ''; 
    } 

    //GET Flight Details
    echo $flight_query = "SELECT * FROM arrival_flight WHERE formid = '$formid'";
    $flight_result = mysqlquery($flight_query);
    while ( $flight_row = mysqli_fetch_array($flight_result) )
    {
        $airline_name = ( ! empty($flight_row['airline_name']) ) ? $flight_row['airline_name'] : '';
        $flight_number = ( ! empty($flight_row['flight_num']) ) ? $flight_row['flight_num'] : '';
        $comments = ( ! empty($flight_row['commnets']) ) ? $flight_row['commnets'] : "";

        $arrival_date = ( ! empty($flight_row['arrival_day']) && ! empty($flight_row['arrival_month'])  && ! empty($flight_row['arrival_year']) ) ? $flight_row['arrival_day'] .'-'. $flight_row['arrival_month'] .'-'. $flight_row['arrival_year'] : '';

        $arrival_time = ( ! empty($flight_row['arrival_time']) && ! empty($flight_row['arrival_time1']) ) ?
                        $flight_row['arrival_time'].' '.$flight_row['arrival_time1'] : '';
    }

    // registration table fields
    $query = "SELECT * FROM registration WHERE isacid = '$isacid'";
    $result = mysqlquery($query);
    while ( $row = mysqli_fetch_array($result) )
    { 
        $date = ( ! empty($row['date']) ) ?  $row['date'] : '';
        $month = ( ! empty($row['month']) ) ?  $row['month'] : '';
        $year = ( ! empty($row['year']) ) ?  $row['year'] : '';
        $contact_home = ( ! empty($row['phone_number']) ) ?  $row['phone_number'] : '';
        $contact_cell = ( ! empty($row['phone_mobile']) ) ?  $row['phone_mobile'] : '';
        $skype = ( ! empty($row['skype']) ) ?  $row['skype'] : '';
        $address = ( ! empty($row['address']) ) ?  $row['address'] : '';
        $zip = ( ! empty($row['zip']) ) ?  $row['zip'] : '';
        $city = ( ! empty($row['city']) ) ?  $row['city'] : '';
        $state = ( ! empty($row['state']) ) ?  $row['state'] : '';
        $country = ( ! empty($row['country']) ) ?  $row['country'] : '';
        $status = ( ! empty($row['status']) ) ?  $row['status'] : '';
        $university = ( ! empty($row['university']) ) ?  $row['university'] : '';
        $majoring_in = ( ! empty($row['majoring_in']) ) ?  $row['majoring_in'] : '';
        $educational = ( ! empty($row['educational']) ) ?  $row['educational'] : '';
        $gender = ( ! empty($row['gender']) ) ?  $row['gender'] : '';

        $title =( ! empty($row['title']) ) ?  $row['title'] : '';
        $year_of_study = ( ! empty($row['year_of_study']) ) ?  $row['year_of_study'] : '';
        $company = ( ! empty($row['company']) ) ?  $row['company'] : '';
        $academic_qualification = ( ! empty($row['academic_qualification']) ) ?  $row['academic_qualification'] : '';
        $educational_qualifications = ( ! empty($row['educational_qualifications']) ) ?  $row['educational_qualifications'] : '';
        $previous_experience = ( ! empty($row['previous_experience']) ) ?  $row['previous_experience'] : '';
        $previous_experience_describe = ( ! empty($row['previous_experience_describe']) ) ?  $row['previous_experience_describe'] : '';
        $visited_india = ( ! empty($row['visited_india']) ) ?  $row['visited_india'] : '';
        $visited_india_locations = ( ! empty($row['visited_india_locations']) ) ?  $row['visited_india_locations'] : '';
        $purpose_of_visit = ( ! empty($row['purpose_of_visit']) ) ?  $row['purpose_of_visit'] : '';
        $local_language = ( ! empty($row['local_language']) ) ?  $row['local_language'] : '';

        $local_language_mention = ( ! empty($row['local_language_mention']) ) ?  $row['local_language_mention'] : '';
        $interested_in_program = ( ! empty($row['interested_in_program']) ) ?  $row['interested_in_program'] : '';
        $your_expectations = ( ! empty($row['your_expectations']) ) ?  $row['your_expectations'] : '';
        $about_ISAC = ( ! empty($row['about_ISAC']) ) ?  $row['about_ISAC'] : '';
	}

    //Programs Data
    $program_data = array(); 
    $program_query = "SELECT * FROM category WHERE publish = 1";
    $program_result = mysqlquery($program_query);
    while($program_row = mysqli_fetch_array($program_result))
    {
        array_push($program_data, array('program_id'=>$program_row['cat_id'], 'program'=>$program_row['category']));
    }
    // Getting program data

    $program_query_my_pg = "SELECT * FROM category WHERE category ='$program' AND publish = 1";
    $program_result_my_pg = mysqlquery($program_query_my_pg);
    while ( $program_row_my_pg = mysqli_fetch_array($program_result_my_pg) )
    {
        $cat_id_my_pg = ( ! empty($program_row_my_pg['cat_id']) ) ? $program_row_my_pg['cat_id'] : "";
    }
    //Program Start Date Data

    //Porgram Details - if Program name Changed So Getting the Prorgam ID from GET Method

	$get_program_id = $cat_id_my_pg;

    $program_start_data = array();
    $program_start_query = "SELECT * FROM isac_arrival_table WHERE program_id = '$get_program_id'";
    $program_start_result = mysqlquery($program_start_query);
    while($program_start_row = mysqli_fetch_array($program_start_result))
    {
        array_push($program_start_data, array('program_id'=>$program_start_row['program_id'], 
                        'program_start_date'=>$program_start_row['arrival_date_full']));
    } 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="javascripts/jquery.min.js"></script>

</head>
<body>
<!-- Wrapper Starts here -->
<div id="wrapper"> 
  <!-- Header Starts here -->
  <div class="header"> 
    <!-- Top Head Starts Here -->
    <div class="topH"> 
              <!-- Top Header starts Here -->
              <div class="top_header"> 
        <!-- Logo Starts Here -->
        <div class="logo"><img src="images/logo.jpg" alt="INDIA STUDY ABROAD CENTER (Volunteer &amp; Interm with ISAC, the India Specialists)" width="488" height="76" border="0" /> </div>
        <!-- Logo Ends Here --> 
        <!-- Search Starts Here -->
        <div id="search">
               
<form name='logout' action='logout.php' method='post'>    
  <input type='image' src='images/btn_logout.jpg' class='btn_apply' title='LOGOUT'  /></form>
<a href="admin_index.php"><img src="images/btn_dashboard.jpg" alt="Admin" width="150" height="26" border="0" class='btn_apply11' /></a>

       
                </div>
      </div>
              <!-- Search Ends Here --> 
            </div>
    <!-- Top Header Ends Here --> 
    <!-- Navigation Starts Here --> 
 <div id="navigation">
        <ul>
          
          <?php
            if ($user_type == '')
            {
                 $menu_sel = 'navigation1';
                 $page_heading = 'INDIVIDUAL';
            }
            else if ($user_type == 'GROUP' OR $user_type == 'GROUP_MEMBER')
            {
                 $menu_sel1 = 'navigation1';
                 $page_heading = 'Group';
            }
            else if ($user_type == 'SCHOLARSHIP')
            {
                 $menu_sel2 = 'navigation1';
                 $page_heading = 'SCHOLARSHIPS';
            }
            else if ($user_type == 'GP_PART' OR $user_type == 'GP_PART_MEMBER')
            {
                 $menu_sel3 = 'navigation1';
                 $page_heading = 'PARTNERS';
            }
            else 
            {
                $menu_sel = '';
                $page_heading = '';
            }
          ?>
       
        <li class="<?php echo $menu_sel;?>"><a href="admin_dashboard-incomplete-applications.php" title="Individual Applications">Individual Applications</a></li>
        <li class="<?php echo $menu_sel1;?>"><a href="admin_dashboard-incomplete-applications-group.php" title="Group Applications ">Group Applications </a></li>
        <li class="<?php echo $menu_sel2;?>"><a href="admin_dashboard-incomplete-applications-scholarship.php" title="Scholarship Applications">Scholarship Applications</a></li>
        <li class="<?php echo $menu_sel3;?>"><a href="admin_dashboard-incomplete-applications-partners.php" title="Partner Application">Partner Application</a></li>
      </ul>
    </div> 
    <!-- Navigation Ends Here --> 
  </div>
  <!-- Top Head Ends Here --> 
  
</div>
<!-- Header Ends here --> 
<!-- Main contents Starts here -->
<div id="container"> 
  <!-- Theme Image --> 
  <!-- div class="theme">
<img src="images/theme_register.jpg" width="990" height="350" alt="Programs" title="Programs" /></div --> 
  <!-- Theme Image --> 
  <!-- Middle left section -->
  <div class="summary_form reg top_spacing">
  		<table cellpadding="0" cellspacing="0" border="1" width="100%">
        	<tr>
            	<td><h1><?php echo $page_heading;?></h1> </td>
                <td align="right"></td>
            </tr>
            <?php
				if($user_type == 'SCHOLARSHIP' AND $scholarship_status == 'PENDING')
				{
			?>
            <tr>
            	<td colspan="2" style="padding-top:10px">
                	<table cellpadding="0" cellspacing="0" width="100%" border="0">
                    	<tr>
                        	<td style="width:85px">
                            	 <form action="update_student_status_admin_dashboard.php" method="post" onsubmit="return confirm('Are you sure you want to Approved?')" >
                                    <input type="hidden" value="<?php echo $formid;?>" name="formid" />
                                    <input type="hidden" value="<?php echo $isacid;?>" name="isacid" />
                                    <input type="hidden" value="APPROVED" name="scholarship_status" />
                                    <input type="image" src="images/btn_approved_deact.png" value="APPROVED" />
                                </form>
                            </td>
                            <td align="left">
                            	<form action="update_student_status_admin_dashboard.php" method="post" onsubmit="return confirm('Are you sure you want to Denied?')" >
                                    <input type="hidden" value="<?php echo $formid;?>" name="formid" />
                                    <input type="hidden" value="<?php echo $isacid;?>" name="isacid" />
                                    <input type="hidden" value="DENIED" name="scholarship_status" />
                                    <input type="image" src="images/btn_denied_deact.png" value="DENIED" />
                                </form>
                            </td>
                        </tr>
                    </table>
                </td>
            
            <?php
				}
				else if($user_type == 'SCHOLARSHIP' AND $scholarship_status == 'APPROVED')
				{
			?>
           
                <td >
                     <img src="images/btn_approved_deact.png" title="Approved" />
                </td>
           
           <?php
				}
				else if($user_type == 'SCHOLARSHIP' AND $scholarship_status == 'DENIED')
				{
			?>
           
                <td >
                	<img src="images/btn_denied_deact.png" title="Denied" />
                </td>
            
            <?php
				}
			?>
            
            
            <tr>
          		<td colspan="2"><h4>Installments</h4></td>
        		</tr>
        </table>
    	<form action="update_installments_admin_dashboard.php" method="post" onsubmit="return confirm('Are you sure you want to Save?')" >
        <table width="939" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
        <tr>
          	<th width="139" style="text-align:center">Installment</th>
          	<th width="119" style="text-align:center">Amount</th>
          	<th width="162" style="text-align:center">Status</th>
          	<th width="227" style="text-align:center">Total Reminders sent</th>
          	<th width="144" style="text-align:center">Last reminder sent on</th>
          	<th width="146" style="text-align:center">Form submission date</th>
          	
          
        </tr>
        <tr>
          	<td>Registration fee</td>
          	<td> $ 45</td>
          	<td>
            	<?php
					if ($registration_fee == 'PAID')
					{
						$registration_fee1= 'PAID';
					}
					else
					{
						$registration_fee1= 'UNPAID';
					}
						?>
                       	<select name='registration_fee' id="registration_fee" class="dropdown_g">
                        <option value="<?php echo $registration_fee1;  ?>" selected="selected"><?php echo $registration_fee1;  ?></option>
                        	<option value="PAID">PAID</option>
                			<option value="UNPAID" >UNPAID</option>
                        </select>
           </td>
         	<td>
            	<?php
					if ($registration_fee == 'PAID')
						echo ' ';
					else if ($first_reminder == '' OR $first_reminder == '0')
						echo '0';
					else
						echo $first_reminder;
				?>
            </td>
            <td>
            	<?php
					if ($registration_fee == 'PAID')
						echo ' ';
					else if ($Date_last_reminder == '')
						echo '--';
					else
						echo $Date_last_reminder;
				?>
            </td>
            <td>
            	<?php
					if ($formdate == '')
						echo '--';
					else
						echo $formdate;
				?>
            </td>
           
        </tr>
        <tr>
          <td>First Installment</td>
          <td>$ <?php echo $first_installment; ?></td>
          <td>
            	<?php
					if ($fee_first_installment == 'PAID')
					{
						$fee_first_installment1 = 'PAID';
					}
					else
					{
						$fee_first_installment1 = 'UNPAID';
					}
						?>
                       	<select name='fee_first_installment' id="fee_first_installment" class="dropdown_g">               <option value="<?php echo $fee_first_installment1; ?>" selected="selected"><?php echo $fee_first_installment1; ?></option>
                        	<option value="PAID">PAID</option>
                			<option value="UNPAID" >UNPAID</option>
                        </select>
                   
            </td>
         	<td>
            	<?php
					if ($fee_first_installment == 'PAID')
						echo ' ';
					else if ($second_reminder == '' OR $second_reminder == '0')
						echo '0';
					else
						echo $second_reminder;
				?>
            </td>
            <td>
            	<?php
					if ($fee_first_installment == 'PAID')
						echo ' ';
					else if ($second_reminder == '' OR $second_reminder == '0')
						echo '--';
					else
						echo $Date_last_reminder;
				?>
            </td>
            <td></td>
           
           
        </tr>
        <tr>
          <td>Second Installment</td>
          <td>$ <?php echo $second_installment;?></td>
          <td>
            	<?php
					if ($fee_second_installment == 'PAID')
					{
						$fee_second_installment1= 'PAID';
					}
					else
					{
						$fee_second_installment1= 'UNPAID';
					}
						?>
                       	<select name='fee_second_installment' id="fee_second_installment" class="dropdown_g">
                        	<option value="<?php echo $fee_second_installment1;  ?>" selected="selected"><?php echo $fee_second_installment1;  ?></option>
                            <option value="PAID">PAID</option>
                			<option value="UNPAID" >UNPAID</option>
                        </select>
                       
				
            </td>
         	<td>
            	<?php
					if ($fee_second_installment == 'PAID')
						echo ' ';
					else if ($final_reminder == '' OR $final_reminder == '0')
						echo '0';
					else
						echo $final_reminder;
				?>
            </td>
            <td>
            	<?php
					if ($fee_second_installment == 'PAID')
						echo ' ';
					else if ($final_reminder == '' OR $final_reminder == '0')
						echo '--';
					else
						echo $Date_last_reminder;
				?>
            </td>
            <td></td>
            
          
        </tr>
         <tr>
          	<td></td>
          	<td></td>
          	<td>
            	
                    <input type="hidden" value="<?php echo $formid; ?>" name="formid" />
                    <input type="hidden" value="<?php echo $isacid; ?>" name="isacid" />

                    <input type="hidden" value="<?php echo $first_installment; ?>" name="first_installment" />
                    <input type="hidden" value="<?php echo $second_installment; ?>" name="second_installment" />
                    <input type="image" src="images/btn_save.png" value="SAVE" />
               
            	</td>
         	<td></td>
            <td></td>
            <td></td>
            
        </tr>
      </table>
       </form>
      <table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><h4>Program Details</h4></td>
        </tr>
        <tr>
          <td>
          <form method="post" action="update_program_details_admin_dashboard.php" onsubmit="return confirm('Are you sure you want to Save?')">
          <table width="780" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
              <tr>
                <td width="250" valign="top" class="form_text"> Program:</td>
                <td width="516" valign="top" class="form_text">
					<select name='program_name' id="program_name" class="dropdown_big">
                    <?php
						foreach($program_data as $programs)
						{
							if($programs['program_id'] == $get_program_id)
								echo '<option value="'.$programs['program_id'].'" selected="selected" >'.$programs['program'].'</option>';
							else
								echo '<option value="'.$programs['program_id'].'" >'.$programs['program'].'</option>';
						}
					?>
                   </select>
                   
				
			  </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text"> Duration:</td>
                <td valign="top" class="form_text">
					<input type="text" name="program_duration" value="<?php echo $duration;?>" class="text_field_small2"/>
				</td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Date:</td>
                <td valign="top" class="form_text">
					<select name='program_start_date' id="program_start_date" class="dropdown_g2">
                    <?php
						foreach($program_start_data as $program_start)
						{
							if( $program_start['program_start_date'] == $arrival )
								echo '<option value="'.$program_start['program_start_date'].'" selected="selected" >'. $program_start['program_start_date'].'</option>';
							else
								echo '<option value="'.$program_start['program_start_date'].'" >'. $program_start['program_start_date'].'</option>';
						}
					?>
                   </select>
				
				</tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Total program Fee:</td>
                <td valign="top" class="form_text">
					<input type="text" name="program_fee" value="<?php echo $fee;?>" class="text_field_small2" />
			 </tr>
               <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Applied on:</td>
                <td valign="top" class="form_text"><?php echo $formdate;?></td>
              </tr>
              <tr>
                <td colspan="2" class="form_text"><img src="images/spacer.gif" width="1" height="8" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text"></td>
                <td valign="top" class="form_text">
                	<input type="hidden" value="<?php echo $formid; ?>" name="formid" />
                    <input type="hidden" value="<?php echo $isacid; ?>" name="isacid" />
                	<input type="image" src="images/btn_save.png" value="SAVE" />
                </td>
              </tr>
              <tr>
                <td colspan="2" class="form_text"><img src="images/spacer.gif" width="1" height="8" /></td>
              </tr>
            </table>
          	</form>
        <tr>
          <td class="brd">&nbsp;</td>
        </tr>
        <tr>
          <td><img src="images/spacer.gif" width="1" height="5" /></td>
        </tr>
        <tr>
          <td>
          	<table cellpadding="0" cellspacing="0" border='0' width="100%">
            	<tr>
                	<td><h4>Flight Details</h4></td>
                    <td align="right">
                   		<form action="update_medical_status_admin_dashboard.php" method="post" onsubmit="return confirm('Are you sure you want to save?')" >
                    	<b>Medical Information</b>:
                    	
                    	<?php
                        if ( $medical_status == '' OR $medical_status == 'Pending' )
                        {
                            ?>
                            <select name='medical_status_form' id="medical_status_form" class="dropdown_g">
                                <option value="Filled" >Filled</option>
                                <option value="Pending" selected="selected">Pending</option>
                            </select>
                            <?php	
                        }
                        else
                        {
                            ?>
                            <select name='medical_status_form' id="medical_status_form" class="dropdown_g">
                                <option value="Filled" selected="selected">Filled</option>
                                <option value="Pending" >Pending</option>
                            </select>
                            <?php	
                        }
						?>
                        	<input type="hidden" value="<?php echo $formid; ?>" name="formid" />
                    		<input type="hidden" value="<?php echo $isacid; ?>" name="isacid" />
                            <input type="image" src="images/btn_save.png" value="SAVE" />
                        </form>
					</td>
                </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td><table width="780" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
              <tr>
                <td width="250" valign="top" class="form_text"> Program:</td>
                <td width="516" valign="top" class="form_text"><?php echo $program;?></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text"> Airline Name:</td>
                <td valign="top" class="form_text"><?php if (!empty($airline_name)) echo $airline_name; ?></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Flight Number:</td>
                <td valign="top" class="form_text"><?php if (!empty($flight_number)) echo $flight_number;?></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Arrival Date:</td>
                <td valign="top" class="form_text"><?php if (!empty($arrival_date)) echo $arrival_date;?></td>
              </tr>
               <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Arrival time (IST):</td>
                <td valign="top" class="form_text"><?php if (!empty($arrival_time)) echo $arrival_time;?></td>
              </tr>
              <tr>
                <td colspan="2" class="form_text"><img src="images/spacer.gif" width="1" height="8" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Arriving from:</td>
                <td valign="top" class="form_text"><?php if (!empty($comments)) echo $comments;?></td>
              </tr>
              <tr>
                <td colspan="2" class="form_text"><img src="images/spacer.gif" width="1" height="8" /></td>
              </tr>
            </table>
          
        <tr>
          <td class="brd">&nbsp;</td>
        </tr>
        <tr>
          <td><img src="images/spacer.gif" width="1" height="5" /></td>
        </tr>
        <tr>
          <td><h4>Personal Details</h4></td>
        </tr>
      
        <tr>
          <td><table width="780" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
              
                <td width="250" class="form_text">First Name :</td>
                <td width="516" valign="bottom" class="space_for_form"><?php echo $firstname;?></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td class="form_text" valign="top">Last Name :</td>
                <td valign="bottom" class="space_for_form_2"><?php echo $lastname;?></td>
              <tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              
                <td width="250" class="form_text">Email:</td>
                <td width="516" valign="bottom" class="space_for_form"><?php echo $email;?></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td class="form_text" valign="top">Date of Birth:</td>
                <td valign="bottom" class="space_for_form_2"><?php echo $date;?>-<?php echo $month;?>-<?php echo $year;?></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              
                <td valign="top" class="form_text">Gender: </td>
                <td valign="bottom" class="space_for_form_2"><?php echo $gender;?></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td height="27" valign="top" class="form_text">Contact Number:</td>
                <td valign="bottom"><?php echo $contact_home;?></td>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td height="27" valign="top" class="form_text">Contact Number(Mobile):</td>
                <td valign="bottom"><?php echo $contact_cell;?></td>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Address: </td>
                <td valign="bottom" class="space_for_form_2"><?php echo $address;?></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Zip / Postal Code:</td>
                <td valign="bottom" class="space_for_form_2"><?php echo $zip;?></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">City:</td>
                <td valign="bottom" class="space_for_form_2"><?php echo $city;?></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">State:</td>
                <td valign="bottom" class="space_for_form_2"><?php echo $state;?></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Country:</td>
                <td valign="bottom" class="space_for_form_2"><?php echo $country;?></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td class="brd">&nbsp;</td>
        </tr>
        <tr>
          <td><img src="images/spacer.gif" width="1" height="5" /></td>
        </tr>
        <tr>
          <td><h4>Educational / Professional Details:</h4></td>
        </tr>
        <tr>
          <td><?php if($status =='Student'){
			  ?><br />

    <table width='780' border='0' cellspacing='2' cellpadding='2' class='top_spacing'>
              <tr>
                <td width='250' class='form_text'>
				
				
					  Name of University:
                     
                     </td>
                <td width='516' class='space_for_form'><?php echo $university ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Majoring in:</td>
                <td class='space_for_form_2'><?php echo $majoring_in ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Educational Level:</td>
                <td class='space_for_form_2'><?php echo $educational ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Year of study:</td>
                <td class='space_for_form_2'><?php echo $year_of_study ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
            </table>
			
			<?php
            
            }
			else
			{
				
				?>
                 <table width='780' border='0' cellspacing='2' cellpadding='2' class='top_spacing'>
              <tr>
                <td width='250' class='form_text'>
				
				
					 Company:
                     
                     </td>
                <td width='516' class='space_for_form'> <?php echo $company ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Title:</td>
                <td class='space_for_form_2'><?php echo $title ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Educational Level:</td>
                <td class='space_for_form_2'><?php echo $educational ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Academic qualification:</td>
                <td class='space_for_form_2'><?php echo $academic_qualification ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
            </table>
            <?php
            
				
			}
            ?></td>
        </tr>
        <tr>
          <td class="brd">&nbsp;</td>
        </tr>
        <tr>
          <td><img src="images/spacer.gif" width="1" height="5" /></td>
        </tr>
        <tr>
          <td><h4>Questionnaire</h4></td>
        </tr>
        <tr>
          <td><table width="900" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
              <tr>
                <td width="486" valign="top" class="form_text">1. Please share a little about your education or work with us </td>
                <td width="400" valign="bottom" class="space_for_form"><?php echo $educational_qualifications;?></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td colspan="2" class="form_text">2. Please provide short answers to the following questions:</td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                      <td width="1%">&nbsp;</td>
                      <td width="54%" align="left" valign="top" class="form_text">(a) Have you had any previous overseas/study abroad/volunteering experience?<br />
                        If yes, then please describe</td>
                      <td width="45%" valign="bottom"><?php echo $previous_experience_describe;?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(b) Have you come to India before?</td>
                      <td width="45%" valign="top" class="form_text"><?php echo $visited_india;?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">If yes, then Please mention locations</td>
                      <td valign="top" class="form_text"><?php echo $visited_india_locations;?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(c) Purpose of visit</td>
                      <td class="form_text"><?php echo $purpose_of_visit;?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(d) Do you speak any local language (Hindi, Urdu or any other local Indian dialect)?<br />
                        If yes, then please mention</td>
                      <td valign="top" class="form_text"><?php echo $local_language_mention;?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(e) Why are you interested in this program?</td>
                      <td valign="top" class="form_text"><?php echo $interested_in_program;?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(f) What are your expectations from the ISAC program?</td>
                      <td class="form_text"><?php echo $your_expectations;?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(g) How did you find out about ISAC?</td>
                      <td class="form_text"><span class="space_for_form_2"> <?php echo $about_ISAC;?> </span></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td colspan="3" class="brd">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    
    
    <!-- middle box ends here --> 
  </div>
  <!-- Middle left section --> 
  <!-- Middle right section --> 
  
  <!-- Middle right section --> 
  <!-- Main contents Ends here -->
  <div class="clear"></div>
</div>
<!-- Footer Starts here -->
<div id="footer"> 
  <!-- Footer Contets starts here -->
  <div class="footer_t"> 
    <!-- Subscribe to newsletter -->
    <div class="newsletter">
      <h2>Subscribe to our newsletter</h2>
      <input type="text" name="newsletter" class="nws_letter" value="Enter Email Address" onFocus="if(this.value == 'Enter Email Address') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Enter Email Address';}" title="Enter Email Address" />
      <input type="image" src="images/btn_submit.jpg" class="btn_submit" title="SUBMIT"  />
    </div>
    <!-- Subscribe to newsletter --> 
    <!-- Tweets -->
    <div class="tweets">
      <h2>Tweets</h2>
    </div>
    <!-- Tweets --> 
    <!-- Follow us -->
    <div class="followus">
      <h2>Follow us</h2>
      <span class="social_media"><a href="http://www.facebook.com/" target="_blank" class="facebook" title="Facebook"></a><a href="http://www.twitter.com/" target="_blank" class="twitter" title="Twitter"></a><a href="http://www.linkedin.com/isac" target="_blank" class="linkedin" title="Linkedin"></a><a href="http://www.youtube.com/isac" target="_blank" class="youtube" title="youtube"></a><a href="http://www.slideshare.net/" target="_blank" class="slideshare" title="Slideshare"></a></span> </div>
    <!-- Follow us --> 
  </div>
  <div class="brd"></div>
  <div class="footer_t">
    <div class="add_india">
      <h2>India<img src="images/flag_india.png" alt="" width="30" height="32" /></h2>
      <p>India Study Abroad Center (ISAC), Suite 411, 
        Reliable Pride, New Oshiwara Link Road, 
        Andheri (W),Mumbai, Maharashtra, India - 400 053</p>
      <p>Email: <a href="mailto:info@indiastudyabroad.org" title="info@indiastudyabroad.org">info@indiastudyabroad.org</a></p>
      <p>Phone (Off): +91-22-2630-3555;</p>
      <p>(Mob): +91-982-059-7692</p>
    </div>
    <div class="mid_box">
      <div class="usa">
        <h2>USA<img src="images/flag_usa.png" width="30" height="32" alt="" /></h2>
        <p>Voicemail Only: +1-415-287-0144</p>
        <p>Fax: +1-309-218-6022</p>
        <p>Email: <a href="mailto:info@indiastudyabroad.org" title="info@indiastudyabroad.org">info@indiastudyabroad.org</a></p>
      </div>
      <div class="aust">
        <h2>Australia<img src="images/flag_austrailia.png" width="30" height="32" alt="" /></h2>
        <p>Voicemail Only: +1-415-287-0144</p>
        <p>Fax: +1-309-218-6022</p>
        <p>Email: <a href="mailto:info@indiastudyabroad.org" title="info@indiastudyabroad.org">info@indiastudyabroad.org</a></p>
      </div>
    </div>
    <div class="europe">
      <h2>Europe<img src="images/flag_europe.png" width="30" height="32" alt="" /></h2>
      <p>Voicemail Only: +1-415-287-0144</p>
      <p>Fax: +1-309-218-6022</p>
      <p>Email: <a href="mailto:info@indiastudyabroad.org" title="info@indiastudyabroad.org">info@indiastudyabroad.org</a><br />
        <br />
        <br />
        <br />
      </p>
    </div>
  </div>
  <div class="brd"></div>
  <div class="footer_t">
    <ul>
      <li><a href="who_we_are.html" title="About ISAC">About ISAC</a></li>
      <li>|</li>
      <li><a href="programs.html" title="Programs">Programs</a></li>
      <li>|</li>
      <li><a href="location__mumbai.html" title="Locations">Locations</a></li>
      <li>|</li>
      <li><a href="contact.html" title="Contact">Contact</a></li>
      <li>|</li>
      <li><a href="privacy.html" title="Privacy Policy">Privacy Policy</a></li>
      <li>|</li>
      <li><a href="terms.html" title="Terms of Use">Terms of Use</a></li>
      <li>|</li>
      <li><a href="sitemap.html" title="Sitemap">Sitemap</a></li>
    </ul>
  </div>
  <!-- Footer Contets ends here --> 
</div>
<!-- Footer Ends here --> 
<!-- Wrapper Ends here --> 

</body>
</html>