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
	
	$groupid = $_POST['groupid'];
	$backpage = $_POST['currentpage'];
	
	//* Get data. */
	$sql = "SELECT * FROM application WHERE group_id = '$groupid'";
	$result = mysqlquery($sql);
	
	//Get Group Name
	$groupname_sql = "SELECT * FROM application WHERE group_id = '$groupid' AND user_type='GROUP'";
	$groupname_result = mysqlquery($groupname_sql);
	$groupname_row = mysqli_fetch_array($groupname_result);
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
  	<a href="<?php echo $backpage; ?>" title="Back"><img src="images/btn_goback.jpg" /></a>
  </div>
  <h1>Group Name: <?php echo $groupname_row['isac_groupname']; ?></h1>
  <!-- Right Links ends -->
  
  <div class="clearr"></div>
  
  <?php
		if (mysqlnumrows($result) > 0)
		{
  	?>
  
  <!-- Total Records -->
  <div class="total_count">
  	Groups Members: <b><?php echo mysqlnumrows($result); ?></b>
  </div>
  
    <table width="939" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
      <tr>
        <th width="103" style="text-align:center">Student Name</th>
        <th width="105" style="text-align:center">Gender</th>
        <th width="121" style="text-align:center">Email</th>
        <th width="126" style="text-align:center">Program</th>
        <th width="86" style="text-align:center">Duration</th>
        <th width="92" style="text-align:center">Program Start Date</th>
        <th width="71" style="text-align:center">From Submission Date</th>
        
        <th width="62" class="brn_n" >&nbsp;</th>
      </tr>
      <?php while($row=mysqli_fetch_array($result)) 
  
  { ?>
      <tr>
       	<td><?php echo $row['firstname'];?></td>
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
    <?php //echo $pagination; ?>
    <div style="padding:10px; float:left" >
    	<form action="download_groups_members.php" method="post">
            <input type="hidden" value="<?php echo $groupid ?>" name="groupid" />
            <input type="hidden" value="<?php echo $groupname_row['isac_groupname'] ?>" name="groupname" />
            <input type="image" src="images/btn_download.png" value="Download Excel" />
          </form>
          
    </div>
     <div style="padding:10px" >
    	<form action="download_groups_members-flight-details.php" method="post">
            <input type="hidden" value="<?php echo $groupid ?>" name="groupid" />
            <input type="hidden" value="<?php echo $groupname_row['isac_groupname'] ?>" name="groupname" />
            <input type="image" src="images/btn_flight.png" value="Download Excel Flight Details" />
          </form>
          
    </div>
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