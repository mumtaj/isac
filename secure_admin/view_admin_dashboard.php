<?php
    session_start();

    $admin_name = $_SESSION['SESS_FIRST_NAME'];

    if ( ! isset($_POST['formid']) ) $_POST['formid'] = '';

	require_once('auth.php');

    //Include database connection details
	require_once('config.php');
	
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
	if ($_POST['formid'] == '')
	{
		$formid = $_SESSION['formid_isac'];
	}
	elseif  ($_POST['formid'] != '')
	{
		$formid = $_POST['formid'];
		$_SESSION['formid_isac'] = $formid;
	}
    //echo $formid;

    $query = "SELECT * FROM application WHERE formid = '$formid'";

    $result = mysqlquery($query);
          
    while ( $row = mysqli_fetch_array($result) )
    { 
        $isacid= $row['isacid'];
        $firstname = $row['firstname'];
        $email = $row['email'];
        $lastname = $row['lastname'];
        $program = $row['program'];
        $duration = $row['duration'];
        $arrival = $row['arrival'];
        $fee = $row['fee'];
        $formdate = $row['formdate'];
        $flag = $row['flag'];
        $registration_fee = $row['registration_fee'];
        $first_installment = $row['first_installment'];
        $second_installment = $row['second_installment'];
        // $third_installlment = $row['third_installlment'];
        $fee_second_installment = $row['fee_second_installment'];
        $fee_first_installment = $row['fee_first_installment'];

        // $fee_third_installment = $row['fee_third_installment'];
        $full_payment = $row['full_payment'];
        $paid_status = $row['paid_status'];
        $user_type = $row['user_type'];

        $first_reminder = $row['first_reminder'];
        $second_reminder = $row['second_reminder'];
        $final_reminder = $row['final_reminder'];
        $Date_last_reminder = $row['Date_last_reminder'];

        $medical_status = $row['medical_status'];
        $acc_status = $row['acceptance_sent'];
        $doc1_status = $row['doc_1'];
        $doc2_status = $row['doc2'];

        $educational_qualifications02 = $row['educational_qualifications'];
        $previous_experience02 = $row['previous_experience'];
        $previous_experience_describe02 = $row['previous_experience_describe'];
        $visited_india02 = $row['visited_india'];
        $visited_india_locations02 = $row['visited_india_locations'];
        $purpose_of_visit02 = $row['purpose_of_visit'];
        $local_language02 = $row['local_language'];

        $local_language_mention02 = $row['local_language_mention'];
        $interested_in_program02 = $row['interested_in_program'];
        $your_expectations02 = $row['your_expectations'];
        $about_ISAC02 = $row['about_ISAC'];
    }

    $flight_query = "SELECT * FROM arrival_flight WHERE formid = '$formid'";
    $flight_result = mysqlquery($flight_query);

    while ( $flight_row = mysqli_fetch_array($flight_result) )
    {
        $airline_name = $flight_row['airline_name'];
        $flight_number = $flight_row['flight_num'];
        $arrival_date = $flight_row['arrival_day'].'-'.$flight_row['arrival_month'].'-'.$flight_row['arrival_year'];
        $arrival_time = $flight_row['arrival_time'].' '.$flight_row['arrival_time1'];
        $comments = $flight_row['commnets'];
    } 

    // registration table fields
    $query = "SELECT * FROM registration WHERE isacid = '$isacid'";
    $result = mysqlquery($query);
          
    while($row=mysqli_fetch_array($result))
    { 
        $date = $row['date'];
        $month = $row['month'];
        $year = $row['year'];
        $gender = $row['gender'];
        $contact_home = $row['phone_number'];
        $contact_cell = $row['phone_mobile'];
        $skype = $row['skype'];
        $address = $row['address'];
        $zip = $row['zip'];
        $city = $row['city'];
        $state = $row['state'];
        $country = $row['country'];
        $status = $row['student_professional_status'];
        $university = $row['uni_name'];
        $majoring_in = $row['majoring_in'];
        $educational = $row['educational'];

        $title =$row['title'];
        $year_of_study = $row['year_of_study'];
        $company = $row['company'];
        $academic_qualification = $row['academic_qualification'];

        $educational_qualifications01 = $row['educational_qualifications'];
        $previous_experience01 = $row['previous_experience'];
        $previous_experience_describe01 = $row['previous_experience_describe'];
        $visited_india01 = $row['visited_india'];
        $visited_india_locations01 = $row['visited_india_locations'];
        $purpose_of_visit01 = $row['purpose_of_visit'];
        $local_language01 = $row['local_language'];

        $local_language_mention01 = $row['local_language_mention'];
        $interested_in_program01 = $row['interested_in_program'];
        $your_expectations01 = $row['your_expectations'];
        $about_ISAC01 = $row['about_ISAC'];
    }

	if($educational_qualifications01 != '')
		$educational_qualifications = $educational_qualifications01;
	else if($educational_qualifications02 != '')
		$educational_qualifications = $educational_qualifications02;
	
	if($previous_experience01 != '')
		$previous_experience = $previous_experience01;
	else if($previous_experience02 != '')
		$previous_experience = $previous_experience02;
	
	if($previous_experience_describe01 != '')
		$previous_experience_describe = $previous_experience_describe01;
	else if($previous_experience_describe02 != '')
		$previous_experience_describe = $previous_experience_describe02;
	
	if($visited_india01 != '')
		$visited_india = $visited_india01;
	else if($visited_india02 != '')
		$visited_india = $visited_india02;
	
	if($visited_india_locations01 != '')
		$visited_india_locations = $visited_india_locations01;
	else if($visited_india_locations02 != '')
		$visited_india_locations = $visited_india_locations02;
	
	if($purpose_of_visit01 != '')
		$purpose_of_visit = $purpose_of_visit01;
	else if($purpose_of_visit02 != '')
		$purpose_of_visit = $purpose_of_visit02;
	
	if($local_language01 != '')
		$local_language = $local_language01;
	else if($local_language02 != '')
		$local_language = $local_language02;
	
	if($local_language_mention01 != '')
		$local_language_mention = $local_language_mention01;
	else if($local_language_mention02 != '')
		$local_language_mention = $local_language_mention02;
	
	if($interested_in_program01 != '')
		$interested_in_program = $interested_in_program01;
	else if($interested_in_program02 != '')
		$interested_in_program = $interested_in_program02;
	
	if($your_expectations01 != '')
		$your_expectations = $your_expectations01;
	else if($your_expectations02 != '')
		$$your_expectations = $your_expectations02;
		
	if($about_ISAC01 != '')
		$about_ISAC = $about_ISAC01;
	else if($about_ISAC02 != '')
		$about_ISAC = $about_ISAC02;
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />

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
        <li class="<?php echo $menu_sel2;?>"><a href="admin_dashboard-pending-applications-scholarship.php" title="admin_dashboard-incomplete-applications-scholarship">Scholarship Applications</a></li>
        <li class="<?php echo $menu_sel3;?>"><a href="admin_dashboard-incomplete-applications-partners.php" title="admin_dashboard-incomplete-applications-partners">Partner Application</a></li>
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
        	<?php
			if($set_permission == 'FULLACCESS')
			{
				?>
            <tr>
            	<td><h1><?php echo $page_heading;?></h1> </td>
                <td align="right">
                	<form action="edit_admin_dashboard.php" method="post" >
                        <input type="hidden" value="<?php echo $formid;?>" name="formid" />
                        <input type="hidden" value="<?php echo $isacid;?>" name="isacid" />
                        <input type="image" src="images/btn_edit.jpg" value="EDIT" />
                    </form>
                </td>
            </tr>
            <?php
			}
			?>
            <tr>
          		<td colspan="2"><h4>Installments</h4></td>
        		</tr>
        </table>
    	
        <table width="939" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
        <tr>
          	<th style="text-align:center">Installment</th>
          	<th style="text-align:center">Amount</th>
          	<th style="text-align:center">Status</th>
          	<th style="text-align:center">Total Reminders sent</th>
          	<th style="text-align:center">Last reminder sent on</th>
          	<th style="text-align:center">Form submission date</th>
            <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
          	<th style="text-align:center">Reminders</th>
			<th class="brn_n" style="text-align:center">Documents</th>	
           <?php
		}
		?>
          
        </tr>
        <tr>
          	<td>Registration fee</td>
          	<td> $ 45</td>
          	<td>
            	<?php
					
					if ($registration_fee == '')
						echo 'Unpaid';
					else
						echo $registration_fee;
				?>
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
            <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
            <td >
            	<?php
					if ($registration_fee == 'PAID')
					{
						?>
                        <img src="images/btn_send_reminder_deact.png" />
                        <?php
					}
					else
					{
						?>
                        <form action="send_reminder.php" method="post" onsubmit="return confirm('Are you sure you want to send reminder?')" >
                            <input type="hidden" value="<?php echo $formid;?>" name="formid" />
                            <input type="hidden" value="<?php echo $isacid;?>" name="isacid" />
                            <input type="image" src="images/btn_send_reminder.png" value="Send Reminder" />
                        </form>
                        <?php
					}
				?>
            	
            </td>
            <td class="brn_n" style="text-align:center">
            	<?php
					if ($acc_status == '1' OR $registration_fee=='')
					{
						?>
                              
                          
                            <input type="image" src="images/btn_send_acceptance1.png" value="Send Acceptance" />
                        <?php
					}
					else
					{
						?>
                       
                            <form action="send_acceptance.php" method="post" onsubmit="return confirm('Are you sure you want to send acceptance?')" >
                            <input type="hidden" value="<?php echo $formid;?>" name="formid" />
                            <input type="hidden" value="<?php echo $isacid;?>" name="isacid" />
                            <input type="image" src="images/btn_send_acceptance.png" value="Send Acceptance" />
                        </form>
                        <?php
					}
				?>
            </td>
            <?php
			}
		?>
        </tr>
        <tr>
          <td>First Installment</td>
          <td>$ <?php echo $first_installment; ?></td>
          <td>
            	<?php
					if ($fee_first_installment == '')
						echo 'Unpaid';
					else
						echo $fee_first_installment;
				?>
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
            <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
            <td>
            	<?php
					if ($fee_first_installment == 'PAID' OR $registration_fee == '')
					{
						?>
                        <img src="images/btn_send_reminder_deact.png" />
                        <?php
					}
					else
					{
						?>
                        <form action="send_reminder1.php" method="post" onsubmit="return confirm('Are you sure you want to send reminder?')" >
                            <input type="hidden" value="<?php echo $formid;?>" name="formid" />
                            <input type="hidden" value="<?php echo $isacid;?>" name="isacid" />
                            <input type="image" src="images/btn_send_reminder.png" value="Send Reminder" />
                        </form>
                        <?php
					}
				?>
            	
            </td>
            <td class="brn_n" style="text-align:center">
            	<?php
					if ($doc1_status == '1' OR $fee_first_installment=='')
					{
						?>
                        <img src="images/btn_send_acceptance_deact.png" />
                        <?php
					}
					else
					{
						?>
                        <form action="send_documents-first.php" method="post" onsubmit="return confirm('Are you sure you want to send acceptance?')" >
                           <input type="hidden" value="<?php echo $formid;?>" name="formid" />
                            <input type="hidden" value="<?php echo $isacid;?>" name="isacid" />
                            <input type="image" src="images/btn_send_docs.jpg" value="Send Acceptance" />
                        </form>
                        <?php
					}
				?>
            </td>
            <?php
		}
		?>
        </tr>
        <tr>
          <td>Second Installment</td>
          <td>$ <?php echo $second_installment;?></td>
          <td>
            	<?php
					if ($fee_second_installment == '')
						echo 'Unpaid';
					else
						echo $fee_second_installment;
				?>
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
            <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
            <td>
            	<?php
					if ($fee_second_installment == 'PAID' OR $fee_first_installment == '' OR $registration_fee == '')
					{
						?>
                        <img src="images/btn_send_reminder_deact.png" />
                        <?php
					}
					else
					{
						?>
                        <form action="send_reminder2.php" method="post" onsubmit="return confirm('Are you sure you want to send reminder?')" >
                            <input type="hidden" value="<?php echo $formid;?>" name="formid" />
                            <input type="hidden" value="<?php echo $isacid;?>" name="isacid" />
                            <input type="image" src="images/btn_send_reminder.png" value="Send Reminder" />
                        </form>
                        <?php
					}
				?>
            	
            </td>
            <td class="brn_n" style="text-align:center">
            	<?php
					if ($doc2_status == '1' OR $fee_second_installment=='')
					{
						?>
                        <img src="images/btn_send_acceptance_deact.png" />
                        <?php
					}
					else
					{
						?>
                       <form action="send_documents-second.php" method="post" onsubmit="return confirm('Are you sure you want to send acceptance?')" >
                           <input type="hidden" value="<?php echo $formid;?>" name="formid" />
                            <input type="hidden" value="<?php echo $isacid;?>" name="isacid" />
                            <input type="image" src="images/btn_send_docs.jpg" value="Send Acceptance" />
                        </form>
                        <?php
					}
				?>
            </td>
            <?php
		}
		?>
        </tr>
      </table>
      
      <table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><h4>Program Details</h4></td>
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
                <td valign="top" class="form_text"> Duration:</td>
                <td valign="top" class="form_text"><?php echo $duration;?></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Date:</td>
                <td valign="top" class="form_text"><?php echo $arrival;?></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Total program Fee:</td>
                <td valign="top" class="form_text"><?php echo $fee;?></td>
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
            </table>
          
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
                    <td align="right"><b>Medical Information</b>:
                    	<?php
							if ($medical_status == '' )
								echo 'Pending';
							else
								echo $medical_status;
						?>
                    	
                    </td>
                </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td><table width="780" border="0" cellspacing="2" cellpadding="2" class="top_spacing">
              <tr>
                <td width="250" valign="top" class="form_text"> Program:</td>
                <td width="516" valign="top" class="form_text"><?php echo $program; ?></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text"> Airline Name:</td>
                <td valign="top" class="form_text"><?php echo (!empty($airline_name)) ? $airline_name : ""; ?></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Flight Number:</td>
                <td valign="top" class="form_text"><?php echo (!empty($flight_number)) ? $flight_number : "";?></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Arrival Date:</td>
                <td valign="top" class="form_text"><?php echo (!empty($arrival_date)) ? $arrival_date : "";?></td>
              </tr>
               <tr>
                <td colspan="3" valign="top"><img src="images/spacer.gif" width="1" height="3" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Arrival time (IST):</td>
                <td valign="top" class="form_text"><?php echo (!empty($arrival_time)) ? $arrival_time : "";?></td>
              </tr>
              <tr>
                <td colspan="2" class="form_text"><img src="images/spacer.gif" width="1" height="8" /></td>
              </tr>
              <tr>
                <td valign="top" class="form_text">Arriving from:</td>
                <td valign="top" class="form_text"><?php echo (!empty($comments)) ? $comments : "";?></td>
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
                <td height="27" valign="top" class="form_text">Contact Numbe(mobile)r:</td>
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
          <td><?php if( (!empty($status))  && $status =='Student'){
			  ?><br />

    <table width='780' border='0' cellspacing='2' cellpadding='2' class='top_spacing'>
              <tr>
                <td width='250' class='form_text'>
				
				
					  Name of University:
                     
                     </td>
                <td width='516' class='space_for_form'><?php echo (!empty($university)) ? $university : ""; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Majoring in:</td>
                <td class='space_for_form_2'><?php echo (!empty($majoring_in)) ? $majoring_in : ""; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Educational Level:</td>
                <td class='space_for_form_2'><?php echo (!empty($educational)) ? $educational : ""; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Year of study:</td>
                <td class='space_for_form_2'><?php echo (!empty($year_of_study)) ? $year_of_study : ""; ?></td>
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
                <td width='516' class='space_for_form'><?php echo (!empty($company)) ? $company : ""; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Title:</td>
                <td class='space_for_form_2'><?php echo $title; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Educational Level:</td>
                <td class='space_for_form_2'><?php echo (!empty($educational)) ? $educational : ""; ?></td>
              </tr>
              <tr>
                <td colspan='3'><img src='images/spacer.gif' width='1' height='3' /></td>
              </tr>
              <tr>
                <td class='form_text'>Academic qualification:</td>
                <td class='space_for_form_2'><?php echo (!empty($academic_qualification)) ? $academic_qualification : ""; ?></td>
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
                <td width="400" valign="bottom" class="space_for_form"><?php echo ( ! empty($educational_qualifications) ) ? $educational_qualifications : "";?></td>
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
                      <td width="45%" valign="bottom"><?php echo ( ! empty($previous_experience_describe) ) ? $previous_experience_describe : "";?></td>
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
                      <td width="45%" valign="top" class="form_text"><?php echo ( ! empty($visited_india) ) ? $visited_india : "";?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">If yes, then Please mention locations</td>
                      <td valign="top" class="form_text"><?php echo ( ! empty($visited_india_locations) ) ? $visited_india_locations : "";?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(c) Purpose of visit</td>
                      <td class="form_text"><?php echo ( ! empty($purpose_of_visit) ) ? $purpose_of_visit : ""; ?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(d) Do you speak any local language (Hindi, Urdu or any other local Indian dialect)?<br />
                        If yes, then please mention</td>
                      <td valign="top" class="form_text"><?php echo ( ! empty($local_language_mention) ) ? $local_language_mention : "";?></td>
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
                      <td valign="top" class="form_text"><?php echo ( ! empty($interested_in_program) ) ? $interested_in_program : "";?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(f) What are your expectations from the ISAC program?</td>
                      <td class="form_text"><?php echo ( ! empty($your_expectations) ) ? $your_expectations : ""; ?> </td>
                    </tr>
                    <tr>
                      <td colspan="3"><img src="images/spacer.gif" width="1" height="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" valign="top" class="form_text">(g) How did you find out about ISAC?</td>
                      <td class="form_text"><span class="space_for_form_2"> <?php echo ( ! empty($about_ISAC) ) ? $about_ISAC : "";?> </span></td>
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