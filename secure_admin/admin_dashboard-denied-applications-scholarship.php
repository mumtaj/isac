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
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE scholarship_status = 'DENIED' AND user_type = 'SCHOLARSHIP' ORDER BY id DESC";
	$total_pages = mysqli_fetch_array(mysqlquery($query));
	$total_pages = $total_pages["num"];
	
	/* Setup vars for query. */
	$targetpage = "admin_dashboard-incomplete-applications-scholarship.php"; 	//your file name  (the name of this file)
	$limit = 10; 								//how many items to show per page
	$page = ( ! empty($_GET['page']) ) ? $_GET['page'] : 1;
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
$sql = "SELECT * FROM $tbl_name WHERE scholarship_status = 'DENIED' AND user_type = 'SCHOLARSHIP' ORDER BY id DESC LIMIT $start, $limit ";
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
        <li><a href="admin_dashboard-incomplete-applications.php" title="Individual Applications">Individual Applications</a></li>
        <li><a href="admin_dashboard-incomplete-applications-group.php" title="Group Applications ">Group Applications </a></li>
        <li class="navigation1"><a href="admin_dashboard-incomplete-applications-scholarship.php" title="admin_dashboard-incomplete-applications-scholarship">Scholarship Applications</a></li>
        <li><a href="admin_dashboard-incomplete-applications-partners.php" title="admin_dashboard-incomplete-applications-partners">Partner Application</a></li>
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
  <!-- Right links starts here -->
  <div class="rht_tab">
  <ul>
  <li><a href="admin_dashboard-pending-applications-scholarship.php" title="Approvals Applications"><strong>Approvals</strong></a></li>
  <li>|</li>
  <li><a href="admin_dashboard-incomplete-applications-scholarship.php" title="Incomplete Applications">Incomplete Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-registered-applications-scholarship.php" title="Registered Applications">Registered Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-deposits-recived-applications-scholarship.php" title="Deposits Received">Deposits Received</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-fully-paid-applications-scholarship.php" title="Fully Paid">Fully Paid</a></li>
  </ul>
  </div>
  <h1>Scholarships</h1>
  <div class="clearr"></div>
  
  <div class="left_btns">
  	<a href="admin_dashboard-pending-applications-scholarship.php" title="Pending Scholarship Applications"><img src="images/btn_pending_deact.png" /></a>&nbsp;&nbsp;
    <a href="admin_dashboard-approved-applications-scholarship.php" title="Approved Scholarship Applications"><img src="images/btn_approved_deact.png" /></a>&nbsp;&nbsp;
    <a href="admin_dashboard-denied-applications-scholarship.php" title="Denied Scholarship Applications"><img src="images/btn_denied_act.png" /></a>
  </div>
  
  <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
  <div class="rht_tab2" >
        <ul>
            <li><a href="admin_dashboard-scholarship-status.php" title="Scholarship Status"><img src="images/schlorship_status.png" title="scholarship status"/></a></li>
        </ul>
    </div>
    <?php
		}
		?>
    
     <div class="clearr"></div>
  <?php
		if ($total_pages > 0)
		{
  	?>
  
  <!-- Total Records -->
  <div class="total_count">
  	Total Records: <b><?php echo $total_pages; ?></b>
  </div>
  <!-- Right Links ends -->
    
    <table width="939" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
      <tr>
        <th width="106" style="text-align:center">Application ID</th>
        <th width="103" style="text-align:center">Full Name</th>
        <th width="105" style="text-align:center">Gender</th>
        <th width="121" style="text-align:center">Email</th>
        <th width="126" style="text-align:center">Program</th>
        <th width="60" style="text-align:center">Duration</th>
        <th width="92" style="text-align:center">Program Start Date</th>
        <th width="71" style="text-align:center">Form Submission Date</th>
        <th width="71" style="text-align:center">Status</th>
        
        <th width="62" class="brn_n">&nbsp;</th>
      </tr>
      <?php while($row=mysqli_fetch_array($result)) 
  
  { ?>
      <tr>
        <td><?php echo $row['formid'];?></td>
        <td><?php echo $row['firstname'].' '.$row['lastname'];?></td>
        <td><?php 
				if ($row['gender'] == '')
					echo '--';
				else
					echo $row['gender'];?></td>
        <td class="link"><?php echo $row['email'];?></td>
        <td><?php echo $row['program'];?></td>
        <td><?php echo $row['duration'];?></td>
        <td><?php 
				if ($row['arrival'] == '000')
					echo '--';
				else
					echo $row['arrival'];?></td>
        <td><?php 
				if ($row['formdate'] == '')
					echo '--';
				else
					echo $row['formdate'];?></td>
        <td><?php echo $row['scholarship_status'];?></td>
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
    <?php
		}
		else
		{
			?>
            <div class="no_records">No Records Found</div>
            <?php
				
		}
	?>
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