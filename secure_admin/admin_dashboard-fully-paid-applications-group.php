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
	
$tbl_name="groups";	
// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	
	/* First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.	*/
	
	/* Get data. Group ID and Group Limit */
	$group_limit_data = array();
	$group_limit_sql = "SELECT group_id, group_limit, group_members, isacid FROM $tbl_name ORDER BY group_id DESC";
	$group_limit_result = mysqlquery($group_limit_sql);
	
	while ($group_limit_row = mysqli_fetch_array($group_limit_result))
	{
		array_push($group_limit_data, array('group_limit_group_id'=>$group_limit_row['group_id'], 
											'group_limit_count'=>$group_limit_row['group_limit'],
											'group_members_count'=>$group_limit_row['group_members']));
	}
	

	/* Get data. Group ID and fee_count */
	$fee_data = array();
	$fee_sql = "SELECT group_id, registration_fee_count, fee_first_inst_count, fee_second_inst_count 
																		FROM group_members_count ORDER BY group_id DESC";
	$fee_result = mysqlquery($fee_sql);
	
	while ($fee_row = mysqli_fetch_array($fee_result))
	{
		array_push($fee_data, array('fee_group_id'=>$fee_row['group_id'], 'reg_fee_count'=>$fee_row['registration_fee_count'],
									'fee_first_inst_count'=>$fee_row['fee_first_inst_count'],
									'fee_second_inst_count'=>$fee_row['fee_second_inst_count']));
	}
	
	
	
	//Final Data Puching to Array
	$i=0;
	$fullpaid_group_data = array();
	$download_group_data = array();
	foreach ($group_limit_data as $limit_data)
	{
		
		
		/*print $limit_data['group_limit_group_id']."==".$fee_data[$i]['fee_group_id'];
		print  "<br>AND<br>";
		print $limit_data['group_limit_count']." ==". $fee_data[$i]['reg_fee_count'];
		print  "<br>AND<br>";
		print $limit_data['group_limit_count']." == ".$fee_data[$i]['fee_first_inst_count'];
		print  "<br>AND<br>";
		print $limit_data['group_limit_count']." == ".$fee_data[$i]['fee_second_inst_count'];
		*/

		
		
		if ($limit_data['group_limit_group_id'] == $fee_data[$i]['fee_group_id'] AND $limit_data['group_members_count'] == $fee_data[$i]['reg_fee_count'] AND $limit_data['group_members_count'] == $fee_data[$i]['fee_first_inst_count'] AND $limit_data['group_members_count'] == $fee_data[$i]['fee_second_inst_count'])
		{
			array_push($fullpaid_group_data, '"'.$limit_data['group_limit_group_id'].'"');
			array_push($download_group_data, $limit_data['group_limit_group_id']);
		}
		$i++;
	}
	
	

	
	$implode_fullpaid_data = implode(',',$fullpaid_group_data); //Final data implode
	$implode_download_group_data = implode(',',$download_group_data); //download_group_data implode
	
	$total_pages = count($fullpaid_group_data); // Total Records
	
	/* Setup vars for query. */
	$targetpage = "admin_dashboard-fully-paid-applications-group.php"; 	//your file name  (the name of this file)
	$limit = 15; 							//how many items to show per page
	$page = ( ! empty($_GET['page']) ) ? $_GET['page'] : 1;
	if($page) 
		$start = ($page - 1) * $limit; 		//first item to display on this page
	else
		$start = 0;							//if no page var is given, set start to 0
	
	
	//Get Print DATA
	$query = "SELECT * FROM $tbl_name WHERE group_id IN ($implode_fullpaid_data) LIMIT $start, $limit ";
	$result = mysqlquery($query);
	
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
       <li class="navigation1"><a href="admin_dashboard-incomplete-applications-group.php" title="Group Applications ">Group Applications </a></li>
        <li><a href="admin_dashboard-incomplete-applications-scholarship.php" title="admin_dashboard-incomplete-applications-scholarship">Scholarship Applications</a></li>
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
  
  <?php
		if ( ! empty($_GET['action']) && $_GET['action'] == 'del')
		{
			?>
            
            <div class="success_reg">
            	Successfully Deleted
            </div>
            <?php
		}
    ?>
  
  <div class="summary_form reg top_spacing">
  <!-- Right links starts here -->
  <div class="rht_tab">
  <ul>
  <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
  <li><a href="admin_dashboard-applications-group-limit.php" title="Group Limit">Group Limit</a></li>
  <li>|</li>
  	<?php
		}
		?>
  <li><a href="admin_dashboard-incomplete-applications-group.php" title="Incomplete Applications">Incomplete Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-registered-applications-group.php" title="Registered Applications">Registered Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-deposits-recived-applications-group.php" title="Deposits Received">Deposits Received</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-fully-paid-applications-group.php" title="Fully Paid"><strong>Fully Paid</strong></a></li>
  </ul>
  </div>
  <h1>Group Applications</h1>
  <!-- Right Links ends -->
  
  <div class="clearr"></div>
  
  <?php
		if ($total_pages > 0)
		{
  	?>
  
  <!-- Total Records -->
  <div class="total_count">
  	Total Groups: <b><?php// echo $total_pages; ?></b>
  </div>

    <table width="939" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
      <tr>
        <th width="106" style="text-align:center">Group Name</th>
        <th width="103" style="text-align:center">Leader Name</th>
        <th width="105" style="text-align:center">Gender</th>
        <th width="121" style="text-align:center">Email</th>
        <th width="60" style="text-align:center">Group Members</th>
        
        <th width="62" class="brn_n" >&nbsp;</th>
      </tr>
      <?php 
	  	
	  	while($row=mysqli_fetch_array($result)) 
  		{
	  		$isacid = $row['isacid'];
			$reg_sql = "SELECT isacid, firstname, email, gender FROM registration WHERE isacid = '$isacid'";
			$reg_result = mysqlquery($reg_sql);
			while($reg_row = mysqli_fetch_array($reg_result)) 
  			{
		?>
      <tr>
       	<td><?php echo $row['group_name'];?></td>
        <td><?php echo $reg_row['firstname'];?></td>
        <td><?php 
				if ($reg_row['gender'] == '')
					echo '--';
				else
					echo $reg_row['gender'];?></td>
        <td class="link"><?php echo $reg_row['email'];?></td>
        <td class="link"><?php echo $row['group_members'];?></td>
        
      
        <td class="link brn_n">
          <form action="admin_dashboard_view_group_members.php" method="post">
            <input type="hidden" value="<?php echo $row['group_id'];?>" name="groupid" />
            <input type="hidden" value="<?php echo $currentpage;?>" name="currentpage" />
            <input type="image" src="images/btn_view.jpg" value="VIEW" />
          </form></td>
      </tr>
      <?php } }?>
    </table>
    <br />
    <br />
    <?php echo $pagination; ?>
    <!--<div style="padding:10px" >
    	<form action="download_groups.php" method="post">
            <input type="hidden" value="<?php// echo $implode_download_group_data;?>" name="group_data" />
            <input type="hidden" value="fullpaid" name="group_type" />
            <input type="image" src="images/btn_download.png" value="Download Excel" />
          </form>
    </div>-->
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