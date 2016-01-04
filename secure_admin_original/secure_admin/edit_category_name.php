<?php
session_start();

$admin_name = $_SESSION['SESS_FIRST_NAME'];
?>
<?php
//require_once('auth.php');
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

<?php $pr_id = $_POST['edit_cat_id'];  ?>


<?php
 $sel_cat = mysql_query("SELECT * FROM category WHERE cat_id = '$pr_id'");
  while ($row1 = mysql_fetch_array($sel_cat))
  {
	 $category_name = $row1['category'];  
	 $cat_id = $row1['cat_id'] ;
  }
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
         <form name='logout' action='logout.php' method='post'> <input type="image" src="images/btn_logout.jpg" class="btn_apply" title="APPLY NOW"  /></form>
        </div>
      </div>
      <!-- Search Ends Here --> 
    </div>
    <!-- Top Header Ends Here --> 
    <!-- Navigation Starts Here --> 
 <div id="navigation">
              <ul>
        <li><a href="admin_dashboard.php" title="Individual Applications">Individual Applications</a></li>
        <li><a href="admin_dashboard_group.php" title="Group Applications ">Group Applications </a></li>
        <li><a href="calendar.php" title="Calendar">Calendar</a></li>
        <li><a href="admin_program.php" title="Programs">Programs</a></li>
        <li><a href="#" title="Discounts">Discounts</a></li>
        <li><a href="admin_currency.php" title="About">Currency</a>
          </li>

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
  <div class="rht_tab">
  <ul>
  <li><a href="program_dates.php" title="Incomplete Applications">Add Program Duration</a></li>
  <li>|</li>
  <li><a href="program_arrival.php" title="Registered Applications">Add Arrival</a></li>
  </ul>
  </div>
    <h1>Welcome, <?php echo $admin_name?></h1>
    <table border="0" width="955" class="admin_tbl" cellspacing="0" cellpadding="0">
<form method="post" action="edit_category_action.php" name="form_prog">
<tr>
<th width="159" style="text-align:center">Programs </th>

<th width="119" style="text-align:center" class="brn_n"> SUBMIT</th>

</tr>
<tr> 
<td> 

<input type="text" name="category_name" value="<?php echo $category_name; ?>" />
<input type="hidden" name="cat_id_edit"  value="<?php echo $cat_id; ?>"/>
 </td>

   <td class="link brn_n">
   <input type="image" src="images/btn_submit.jpg" value="VIEW" />
</tr>
</form>


</table>
    <br />
    <br />
    
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