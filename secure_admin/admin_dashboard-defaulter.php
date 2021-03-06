<?php
session_start();

$admin_name = $_SESSION['SESS_FIRST_NAME'];
?>
<?php
	require_once('auth.php');
?>
<?php 
    //Include database connection details
	require_once('config.php');
	
	//$group = $_POST["csi"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
$tbl_name="application";	
// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE registration_fee = 'PAID' AND fee_first_installment = 'PAID' AND fee_second_installment = '' AND final_reminder = '3'";
	$total_pages = mysqli_fetch_array(mysqlquery($query));
	$total_pages = $total_pages["num"];
	
	/* Setup vars for query. */
	$targetpage = "admin_dashboard-member.php"; 	//your file name  (the name of this file)
	$limit = 15; 								//how many items to show per page
	$page = ( ! empty($_GET['page']) ) ? $_GET['page'] : 1;
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name WHERE registration_fee = 'PAID' AND fee_first_installment = 'PAID' AND fee_second_installment = ''  AND final_reminder = '3' ORDER BY id DESC LIMIT $start, $limit ";
	$result = mysqlquery($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">« previous</a>";
		else
			$pagination.= "<span class=\"disabled\">« previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next »</a>";
		else
			$pagination.= "<span class=\"disabled\">next »</span>";
		$pagination.= "</div>\n";		
	}

// end new pagination
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/test.js"></script>
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
        <div class="logo"><img src="images/logo.jpg" alt="INDIA STUDY ABROAD CENTER (Volunteer &amp; Interm with ISAC, the India Specialists)" width="488" height="76" border="0" /></div>
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
        <li><a href="admin_dashboard-member.php" title="member">Member</a></li>
        <li><a href="admin_dashboard_applicant.php" title="applicant">Applicant </a></li>
        <li><a href="admin_dashboard-candidate.php" title="admin_dashboard-candidate">Candidate</a></li>
        <li><a href="admin_dashboard-student.php" title="">Student</a></li>
        <li><a href="admin_dashboard-prospect.php" title="">Prospect</a></li>
        <li class="navigation1"><a href="admin_dashboard-defaulter.php" title="">Defaulter</a></li>
      </ul>
            </div> 
    <!-- Navigation Ends Here --> 
  </div>
  <!-- Top Head Ends Here --> 
  
</div>
<!-- Header Ends here --> 
<!-- Main contents Starts here -->
<div id="container_cl"> 
  <!-- Theme Image --> 
  <!-- div class="theme">
<img src="images/theme_register.jpg" width="990" height="350" alt="Programs" title="Programs" /></div --> 
  <!-- Theme Image --> 
  <!-- Middle left section -->
  <div class="summary_form reg top_spacing">
  <!-- Right links starts here --><!-- Right Links ends -->
    <h1>DEFAULTER</h1>
    (Paid $45 , Paid $300 but not paid rest of the amount after 3 final reminder)
    <table width="1129" height="87" border="0" cellpadding="0" cellspacing="0" class="admin_tbl">
      <tr>
        <th width="106" style="text-align:center">ISAC ID</th>
        <th width="106" style="text-align:center">Application ID</th>
          <th width="106" style="text-align:center">Group ID</th>
        <th width="103" style="text-align:center">Name</th>
        <th width="105" style="text-align:center">Last Name</th>
        <th width="121" style="text-align:center">Email</th>
        <th width="92" style="text-align:center">Contact Number</th>
        <th width="126" style="text-align:center">Program</th>
        <th width="86" style="text-align:center">Duration</th>
        <th width="71" style="text-align:center">Applied on</th>
        
        <th width="62" class="brn_n">&nbsp;</th>
      </tr>
      <?php while($row=mysqli_fetch_array($result)) 
  
  { ?>
      <tr>
   <td><?php echo $row['isacid'];?></td>
        <td><?php echo $row['formid'];?></td>
           <td><?php echo $row['group_id'];?></td>
        <td><?php echo $row['firstname'];?></td>
        <td><?php echo $row['lastname'];?></td>
        <td class="link"><?php echo $row['email'];?></td>
        <td><?php echo $row['contact_home'];?></td>
        <td><?php echo $row['program'];?></td>
        <td><?php echo $row['duration'];?></td>
        <td><?php echo $row['formdate'];?></td>
        <td class="link brn_n">
          <form action="view_admin_dashboard.php" method="post">
            <input type="hidden" value="<?php echo $row['formid'];?>" name="formid" />
            <input type="image" src="images/btn_view.jpg" value="VIEW" />
          </form></td>
      </tr>
      <?php } ?>
    </table>
    <br />
    <br />
    <?php echo $pagination; ?>
    
    <table width="600" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
  <tr>
    <td colspan="2" class="brn_n"><strong>Statistics</strong></td>
    </tr>
  <tr>
    <td width="261">TOTAL STUDENTS :</td>
    <td width="337" class="brn_n">	<?php 
	$query1 = "SELECT COUNT(*) as num FROM $tbl_name WHERE fee_first_installment = 'PAID' AND fee_second_installment = '' AND gender = 'Male' AND final_reminder = '3'";
	$query2 = "SELECT COUNT(*) as num FROM $tbl_name WHERE fee_first_installment = 'PAID' AND fee_second_installment = ''  AND gender = 'Female' AND final_reminder = '3'";
	$total_stu = mysqli_fetch_array(mysqlquery($query));

	echo $total_st_dis = $total_stu["num"]; 
	?>
	</td>
  </tr>
  <tr>
    <td>MALE:</td>
    <td class="brn_n"><?php $total_stu_m = mysqli_fetch_array(mysqlquery($query1));

	echo $total_st_dis_m = $total_stu_m["num"]; 
	?></td>
  </tr>
  <tr>
    <td>FEMALE:</td>
    <td class="brn_n"><?php $total_stu_fm = mysqli_fetch_array(mysqlquery($query2));

	echo $total_st_dis_fm = $total_stu_fm["num"]; 
	?></td>
  </tr>
  <tr>
    <td colspan="2"><a href="download_result_member_5.php" target="_blank">DOWNLOAD EXCEL </a></td>
    </tr>
  
</table>
    <div> </div>
    <!-- middle box ends here --> 
  </div>
  <!-- Middle left section --> 
  <!-- Middle right section --> 
  
  <!-- Middle right section --> 
  <!-- Main contents Ends here -->
  <div class="clear"></div>
</div>

<!-- Wrapper Ends here -->

</body>
</html>