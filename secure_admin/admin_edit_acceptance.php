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
	
    $sql = "SELECT * FROM mailer WHERE type = 'acc_top' ";
	$result = mysqlquery($sql);
    while($row=mysqli_fetch_array($result)) 
    { 
        $content = $row['content'];
    }

    $sql1 = "SELECT * FROM mailer WHERE type = 'acc_footer' ";
	$result1 = mysqlquery($sql1);
    while($row1=mysqli_fetch_array($result1)) 
    {  
        $content1 = $row1['content'];
    }

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/sample.js" type="text/javascript"></script>
	<link href="ckeditor/sample.css" rel="stylesheet" type="text/css" />
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
        <li><a href="admin_dashboard-create-new-user.php" title="member">Create New User</a></li>
        <li><a href="admin_dashboard-manage-users.php" title="applicant">Manage Users </a></li>
        <li><a href="admin_dashboard-change-password.php" title="admin_dashboard-candidate">Change Password</a></li>
        <li class="navigation1"><a href="admin_edit_mailer.php" title="Edit Mailers">Content Editing</a></li>
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
  <!-- Right links starts here --><!-- Right Links ends -->
    <h1>edit Acceptance Details</h1>
    <br />
    <br />
   <form action="acceptance_process.php" method="post">
		<p>
		<strong>Header Section</strong><br />
<br />
	
		  <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"><?php echo $content; ?></textarea>
		</p>
		<p>
			<input type="submit" value="Submit header section" />
		</p>
	</form><br /><br />
	<strong>Footer Section</strong><br /><br /> <form action="acceptance_process.php" method="post">
		<p>
			
		  <textarea class="ckeditor" cols="80" id="editor2" name="editor2" rows="10"><?php echo $content1; ?></textarea>
		</p>
		<p>
			<input type="submit" value="Submit footer section" />
		</p>
	</form>
    <div> </div>
    <!-- middle box ends here --> 
  </div>
  <!-- Middle left section --> 
  <!-- Middle right section --> 
  
  <!-- Middle right section --> 
  <!-- Main contents Ends here -->
  <div class="clear"></div>
</div>


</body>
</html>