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
	require_once('auth.php');
	
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
//$tbl_name="category";	
// How many adjacent pages should be shown on each side?
//$sql = "SELECT * FROM $tbl_name  ";
	//$result = mysql_query($sql);
	

// end new pagination
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="all" />
</style><script language="JavaScript" src="javascripts/gen_validatorv4.js"
    type="text/javascript" xml:space="preserve"></script>
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
             <li><a href="admin_program.php" title="">Programs Home</a></li> 
        <li class="navigation1"><a href="admin_program_create.php" title="">Create Programs</a></li>
        <li><a href="program_arrival.php" title="">Manage Program Dates</a></li>
        <li><a href="admin_scholarship.php" title="">Manage scholarship</a></li>
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
 <div class="main_program1">
   <div class="main_program_inside1">
    <table width="745" border="0" class="admin_tbl" cellspacing="0" cellpadding="0">
     <form method="post" action="prog_add.php" name="form_prog" id="form_prog">
      <tr>
        <td colspan="2" class="link brn_n"><strong>Create New Program</strong></td>
        </tr>
      <tr>
    <td width="363">Program Name</td>
    <td width="380" class="link brn_n"><input type="text" value="" name="program" size="40" /></td>
  </tr>
  <tr>
    <td>Enter Start week</td>
    <td class="link brn_n"><input type="text" name="start_week" size="15" id="start_week" /></td>
  </tr>
  <tr>
    <td>Enter End week</td>
    <td class="link brn_n"><input type="text" name="end_week" size="15" /></td>
  </tr>
  <tr>
    <td colspan="2" class="link brn_n"><strong>Individual Cost Details</strong></td>
    </tr>
  <tr>
    <td>Enter Program cost</td>
    <td class="link brn_n"><input type="text" name="base_amount" size="15" /></td>
  </tr>
  <tr>
    <td>Enter additional week cost</td>
    <td class="link brn_n"><input type="text" name="difference_amount" size="15" /></td>
  </tr>
  <tr>
    <td colspan="2" class="link brn_n"><strong>Group Cost details</strong></td>
    </tr>
  <tr>
    <td>Enter Program cost</td>
    <td class="link brn_n"><input type="text" name="base_amount1" size="15" /></td>
  </tr>
  <tr>
    <td>Enter additional week cost</td>
    <td class="link brn_n"><input type="text" name="difference_amount1" size="15" /></td>
  </tr>
  <tr>
    <td colspan="2" class="link brn_n"><strong>Enter Scholarship Cost Details</strong></td>
    </tr>
    
  <tr>
    <td>Enter Program cost</td>
    <td class="link brn_n"><input type="text" name="base_amount2" size="15" /></td>
  </tr>
  <tr>
    <td>Enter additional week cost</td>
    <td class="link brn_n"><input type="text" name="difference_amount2" size="15" /></td>
  </tr>
  <tr>
    <td colspan="2" class="link brn_n"><strong>Enter Partner Cost Details</strong></td>
    </tr>
    
  <tr>
    <td>Enter Program cost</td>
    <td class="link brn_n"><input type="text" name="base_amount3" size="15" /></td>
  </tr>
  <tr>
    <td>Enter additional week cost</td>
    <td class="link brn_n"><input type="text" name="difference_amount3" size="15" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="link brn_n"><input type="image" src="images/btn_submit.jpg" value="VIEW" /></td>
  </tr>
  </form>
    </table>
    <div> </div>
    <!-- middle box ends here --> 
  </div>
  </div>
  
  <!-- Middle left section --> 
  <!-- Middle right section --> 
  
  <!-- Middle right section --> 
  <!-- Main contents Ends here -->
  <div class="clear"></div>
</div>

<!-- Wrapper Ends here -->
<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("form_prog");

 frmvalidator.EnableMsgsTogether();
 frmvalidator.addValidation("program","req","Please enter program name");
 frmvalidator.addValidation("start_week","req","Please enter start week");
  frmvalidator.addValidation("start_week","numeric");
  frmvalidator.addValidation("end_week","req","Please enter end week");
  frmvalidator.addValidation("base_amount","req","Please enter base amount");
  frmvalidator.addValidation("difference_amount","req","Please enter additional week cost");
  frmvalidator.addValidation("base_amount1","req","Please enter base amount");
  frmvalidator.addValidation("difference_amount1","req","Please enter additional week cost");
  frmvalidator.addValidation("base_amount2","req","Please enter base amount");
  frmvalidator.addValidation("difference_amount2","req","Please enter additional week cost");
  frmvalidator.addValidation("base_amount3","req","Please enter base amount");
  frmvalidator.addValidation("difference_amount3","req","Please enter additional week cost");
    frmvalidator.addValidation("end_week","numeric");
  frmvalidator.addValidation("base_amount","numeric");
  frmvalidator.addValidation("difference_amount","numeric");
  frmvalidator.addValidation("base_amount1","numeric");
  frmvalidator.addValidation("difference_amount1","numeric");
  frmvalidator.addValidation("base_amount2","numeric");
  frmvalidator.addValidation("difference_amount2","numeric");
  frmvalidator.addValidation("base_amount3","numeric");
  frmvalidator.addValidation("difference_amount3","numeric");
//]]></script>
</body>
</html>