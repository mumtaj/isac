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
<?php
$quer2=mysql_query("SELECT * FROM category order by cat_id"); 
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
        <li><a href="admin_dashboard.php" title="About">Admin Dashboard</a>
             
                </li>
                 <li><a href="admin_currency.php" title="About">Currency</a>
                  <li><a href="admin_program.php" title="programs">Add Program</a>
             
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
    <table border="1" width="930" class="admin_tbl">
<form method="post" action="add_amount_diff_action.php" name="form_prog">
<tr>
<th width="324" style="text-align:center">Programs </th>
<th width="236" style="text-align:center">Enter base amount</th>
<th width="236" style="text-align:center">Enter difference</th>
<th width="106"> </th>

</tr>
<tr> 
<td> <?php
//////////        Starting of first drop downlist /////////
echo "<select name='cat' class='grad'>";
while($prog = mysql_fetch_array($quer2)) { 
echo "<option selected value='$prog[cat_id]'>$prog[category]</option>"."<BR>";
}
echo "</select>";
// selected vale for program

?>
 </td>
 <td><input type="text" name="base_amount" /></td>
 
 <td><input type="text" name="difference_amount" /> </td>
   <td class="link brn_n"><input type="image" src="images/btn_submit.jpg" value="VIEW" />
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