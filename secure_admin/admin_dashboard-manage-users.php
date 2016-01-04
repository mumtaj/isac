<?php
session_start();

$admin_name = $_SESSION['SESS_FIRST_NAME'];


if ( ! isset($_GET['status']) ) $_GET['status'] = '';

	require_once('auth.php');

    //Include database connection details
	require_once('config.php');
	
	//$group = $_POST["csi"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
	$sql = "SELECT * FROM admin";
	$result = mysqlquery($sql);
	
	
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
        <li><a href="admin_dashboard-create-new-user.php" title="member">Create New User</a></li>
        <li class="navigation1"><a href="admin_dashboard-manage-users.php" title="applicant">Manage Users </a></li>
        <li><a href="admin_dashboard-change-password.php" title="admin_dashboard-candidate">Change Password</a></li>
        <li><a href="admin_edit_mailer.php" title="Edit Mailers">Content Editing</a></li>
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
		if ($_GET['status'] == 'false')
		{
			?>
            
            <div class="success_reg">
            	 <h4 align="center" class="error">
                    Change Password Failed<br /> <br />
                    Please enter your current Password.<br /><br />
                </h4>
            </div>
            <?php
		}
		else if ($_GET['status'] == 'true')
		{
			?>
            <div class="success_reg">
            	<h4 align="center" class="error" style="color:#030">
                    Successfully Changed your Password.
                </h4>
            </div>
           	<?php
		}
    ?>
  
  <div class="summary_form reg top_spacing">
  <!-- Right links starts here --><!-- Right Links ends -->
    <h1>Manage Users</h1>
    
    <table width="400" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
      
      <?php while($row=mysqli_fetch_array($result)) 
  
  { ?>
      <tr>
        <td width="106" style="text-align:center"><?php echo $row['firstname'];?></td>
        <td width="106" style="text-align:center">
        	<form action="admin_dashboard-edit-user.php" method="post">
            	<input type="hidden" value="<?php echo $row['member_id'];?>" name="memberid" />
            	<input type="image" src="images/btn_edit.jpg" value="EDIT" />
          	</form> 
     	</td>
       
      </tr>
      <?php } ?>
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