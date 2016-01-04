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
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	?>
<?php
	$tbl_name="application";	
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	
	if ($_POST['group_id'] == '' AND $_POST['partner_id'] == '')
	{
		$group_id = $_SESSION['group_id'];
		$partner_id = $_SESSION['partner_id'];
		
	}
	else if ($_POST['group_id'] != '' AND $_POST['partner_id'] != '')
	{
		$group_id = $_POST['group_id'];
		$partner_id = $_POST['partner_id'];
		
		$_SESSION['group_id'] = $group_id;
		$_SESSION['partner_id'] =  $partner_id;
	}
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE group_id = '$group_id' AND partner_id = '$partner_id'";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "admin_dashboard-partner-group_members.php"; 	//your file name  (the name of this file)
	$limit = 20; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name WHERE group_id = '$group_id' AND partner_id = '$partner_id' LIMIT $start, $limit ";
	$result = mysql_query($sql);
	
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

$psql = "SELECT * FROM application WHERE group_id = '$group_id' AND partner_id = '$partner_id' AND user_type = 'GP_PART'";
$presult = mysql_query($psql);
$prow=mysql_fetch_array($presult);

$partner_sql = "SELECT * FROM partner WHERE group_id = '$group_id' ";
$partner_result = mysql_query($partner_sql);
$partner_row=mysql_fetch_array($partner_result);

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
        <li><a href="admin_dashboard-incomplete-applications-scholarship.php" title="admin_dashboard-incomplete-applications-scholarship">Scholarship Applications</a></li>
        <li class="navigation1"><a href="admin_dashboard-incomplete-applications-partners.php" title="admin_dashboard-incomplete-applications-partners">Partner Application</a></li>
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
  
    <a href="admin_dashboard-incomplete-applications-partners.php"><img src="images/btn_goback.jpg"  /></a>
  </div>
   <h4>Partners Name: <?php echo $partner_row['partner_name']; ?></h4>

   <h2>Group Name: <?php echo $partner_row['group_name']; ?></h2>
   <div class="clearr"></div>
   <?php
		if(mysql_num_rows($result) == 0)
		{
			?>
            <br /><br />
            <h3 style="color:#930; font-size:18px; text-align:center"><b>You have no members for this Group.</b></h3>
            <br /><br />
            
            <?php
		}
		else
		{
	?>
    <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
   <table cellpadding="0" cellspacing="0" border="0" width="100%">
   		<tr>
        	<td style="width:50px"><h2>Status: </h2></td>
            <td>
            	<form action="admin_dashboard-partner-group-invoice-sent.php" method="post" onsubmit="return confirm('Are you sure you want to Save?')">
                    <select name="invoice_status" id="invoice_status" class="dropdown_g" >
                    	<?php
							if($partner_row['paid_status'] == 'PENDING')
							{
								$flag = 'selected="selected"';
							}
							else if($partner_row['paid_status'] == 'Invoice Sent')
							{
								$flag1 = 'selected="selected"';
							}
							else if($partner_row['paid_status'] == 'PAID')
							{
								$flag2 = 'selected="selected"';
							}
						?>
                            <option value="Pending" <?php echo $flag; ?>>Pending</option>
                            <option value="Invoice Sent"   <?php echo $flag1; ?>>Invoice Sent</option>
                            <option value="Paid"  <?php echo $flag2; ?>>Paid</option>
                    </select>
                    
                    <input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
                    <input type="hidden" value="<?php echo $partner_id; ?>" name="partner_id" />
                    <input type="image" src="images/btn_save.png" value="SAVE" />
                </form>
            </td>
        </tr>
   </table>
   <?php
		}
	?>
        	
   <div class="clearr"></div>
   <div align="center">
	
    
    <table width="930" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
      <tbody><tr>
        <th width="65" style="text-align:center">Partner ID</th>
        <th width="120" style="text-align:center">Student Name</th>
        <th width="106" style="text-align:center">Gender</th>
        <th width="103" style="text-align:center">Email</th>
        <th width="130" style="text-align:center">Program</th>
        <th width="105" style="text-align:center">Duration</th>
        <th width="62" class="brn_n">&nbsp;</th>
      </tr>
      <?php
	  	while($row=mysql_fetch_array($result)) 
  			{ 
		$group_id =	$row['group_id'] ;
	    $gp_name =$row['isac_groupname'];
	  ?>
            <tr>
        <td><?php echo $row['partner_id'];?></td>
        <td><?php echo $row['firstname'];?></td>
        <td><?php echo $row['gender'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['program'];?></td>
        <td><?php echo $row['duration'];?></td>
        <td class="link brn_n">
          <form action="view_admin_dashboard.php" method="post">
            <input type="hidden" value="<?php echo $row['formid']; ?>" name="formid">
            <input type="image" src="images/btn_view.jpg" value="VIEW">
          </form></td>
      </tr>
       <?php
			}
	  ?>
          </tbody></table>
          </div>
  
    <br />
    <br />
    <?=$pagination?>
     <div style="padding:10px; float:left" >
    	<form action="download_groups_members.php" method="post">
            <input type="hidden" value="<?php echo $group_id ?>" name="groupid" />
            <input type="hidden" value="<?php echo $gp_name ?>" name="groupname" />
            <input type="image" src="images/btn_download.png" value="Download Excel" />
          </form>
          
    </div>
     <div style="padding:10px" >
    	<form action="download_groups_members-flight-details.php" method="post">
            <input type="hidden" value="<?php echo $group_id ?>" name="groupid" />
            <input type="hidden" value="<?php echo $gp_name ?>" name="groupname" />
            <input type="image" src="images/btn_flight.png" value="Download Excel Flight Details" />
          </form>
          
    </div>
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