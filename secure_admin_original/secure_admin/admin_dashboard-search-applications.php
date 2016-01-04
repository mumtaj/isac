<?php
session_start();

$admin_name = $_SESSION['SESS_FIRST_NAME'];
?>
<?php
	require_once('auth.php');
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
        <li class="navigation1"><a href="admin_dashboard-incomplete-applications.php" title="Individual Applications">Individual Applications</a></li>
        <li><a href="admin_dashboard-incomplete-applications-group.php" title="Group Applications ">Group Applications </a></li>
        <li><a href="admin_dashboard-pending-applications-scholarship.php" title="admin_dashboard-incomplete-applications-scholarship">Scholarship Applications</a></li>
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
  <!-- Search area -->
  
  <div class="summary_form reg top_spacing">
  
  <!-- Right links starts here -->
  <div class="rht_tab">
  <ul>
   <li><a href="admin_dashboard-search-applications.php" title="Incomplete Applications"><strong>Search Applications</strong></a></li><li> |</li>
  <li><a href="admin_dashboard-incomplete-applications.php" title="Incomplete Applications">Incomplete Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-registered-applications.php" title="Registered Applications">Registered Applications</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-deposits-recived-applications.php" title="Deposits Received">Deposits Received</a></li>
  <li>|</li>
  <li><a href="admin_dashboard-fully-paid-applications.php" title="Fully Paid">Fully Paid</a></li>
  </ul>
  </div>
  
  
  
  <h1 >Search</h1>
  <!-- Right Links ends -->
  <div class="clearr"></div>

  <!-- Total Records -->

  
  
    <table width="939" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
      <tr>
        
        <th width="103" style="text-align:center">Name</th>
     
              <th width="103" style="text-align:center">Email</th>
        <th width="62" style="text-align:center">SEARCH</th>
      
      </tr>
     
      <tr>
      <form name="search" id="search" action="admin_dashboard-search-applications.php"  method="post">
        <td><input type="text" name="name" value="" class="text_field" /></td>
        <td><input type="text" name="email" value="" class="text_field" /><input type="hidden" name="doSearch" value="1"> </td>
         <td><input type="image" src="images/btn_submit.jpg" value="VIEW" /></td>
        </form>
   </tr>
    </table>

    
    
    <div> </div>
    <!-- middle box ends here --> 
  </div>
  <?php
  // start search action 
   if($_POST['doSearch']==1)
   {
  ?>
  <?php 
	$name = $_POST['name'];
	$email_ind = $_POST['email'];
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
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name WHERE firstname LIKE '%$name%' AND email LIKE '%$email_ind%' AND delete_flag = '' ORDER BY id DESC ";
	$result = mysql_query($sql);
?>
  <!-- End search area  -->
  <div class="summary_form reg top_spacing">
  
  <!-- Right links starts here -->

  <!-- Right Links ends -->
  <div class="clearr"></div>
  
  
  <!-- Total Records -->

  <table width="939" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
      <tr>
        <th width="106" style="text-align:center">Application ID</th>
        <th width="103" style="text-align:center">Name</th>
        <th width="105" style="text-align:center">Last Name</th>
        <th width="121" style="text-align:center">Email</th>
        <th width="126" style="text-align:center">Program</th>
        <th width="60" style="text-align:center">Duration</th>
        <th width="92" style="text-align:center">Program Start Date</th>
        <th width="71" style="text-align:center">Form Submission Date</th>
        
        <th width="62">&nbsp;</th>
        <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
        <th width="80" class="brn_n" >&nbsp;</th>
        <?php
		}
		?>
      </tr>
      <?php while($row=mysql_fetch_array($result)) 
  
  { ?>
      <tr>
        <td><?php echo $row['formid'];?> </td>
        <td><?php echo $row['firstname'];?></td>
        <td><?php echo $row['lastname'];?></td>
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
        <td valign="middle">
          <form action="view_admin_dashboard.php" method="post">
            <input type="hidden" value="<?php echo $row['formid'];?>" name="formid" />
            <input type="hidden" value="<?php echo $currentpage;?>" name="currentpage" />
            <input type="image" src="images/btn_view.jpg" value="VIEW" />
          </form></td>
     
      <?php
	 	if($set_permission == 'FULLACCESS')
		{
			?>
           <td class="link brn_n" valign="middle">
            <form action="del_application_action.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                <input type="hidden" value="<?php echo $row['formid'];?>" name="applicationid" />
                <input type="hidden" value="<?php echo $currentpage; ?>" name="currentpage_name" />
                <input type="image" src="images/btn_delete.png" value="DELETE" />
              </form>
          </td>
          <?php
		}
		?>
         
      </tr>
      <?php } ?>
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
<?php
// end search area display
   }
   else
   {
	   // no display 
   }
?>
</body>
</html>