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
	
//$tbl_name="category";	
// How many adjacent pages should be shown on each side?
//$sql = "SELECT * FROM $tbl_name  ";
	//$result = mysqlquery($sql);
	

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
             <li class="navigation1"><a href="admin_program.php" title="">Programs Home</a></li> 
        <li><a href="admin_program_create.php" title="">Create Programs</a></li>
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
  <!-- div class="theme">
<img src="images/theme_register.jpg" width="990" height="350" alt="Programs" title="Programs" /></div --> 
  <!-- Theme Image --> 
  <!-- Middle left section -->

  <div class="main_program">
   <div class="main_program_inside">
     <div class="main_program_inside">
  <table width="758" height="112" border="0" align="center" cellpadding="0" cellspacing="0" class="admin_tbl">
      <tr>
    <th style="text-align:center">Category Id</th>
        <th width="276" style="text-align:center">Programs</th>
     
        
        <th width="108"  style="text-align:center">Publish</th>
        <th width="115" class="" style="text-align:center">Edit</th>
              <th width="90" class="brn_n" style="text-align:center">Delete</th>
      </tr>
   
    
      
<?php 
$sql_select_pr = "SELECT * FROM category ";
	$result_pr = mysqlquery($sql_select_pr);
	while($feach_info_pr = mysqli_fetch_array($result_pr))
	{
		$program_name_pr = $feach_info_pr['category'];
		$program_id_pr = $feach_info_pr['cat_id'];
		$publish_val = $feach_info_pr['publish'];
	
?>  
  <tr>  
  <td><?php echo $program_id_pr;  ?></td>
 <td><?php echo $program_name_pr;  ?></td>
 <td >
 
 <?php if($publish_val=='') 
 
 { 
 
echo" <form name='publish' action='publish_action.php' method='post'><input type='hidden' name='prog_id' value='".$program_id_pr."'/><input type='image' src='images/btn_publish.jpg' value='VIEW'  /></form>";
  } 
       
       else
       {
        echo" <form name='publish' action='unpublish_action.php' method='post'><input type='hidden' name='prog_id' value='".$program_id_pr."'/><input type='image' src='images/unpublish.png' value='VIEW' /></form>";
       }
        ?> 
        </td>
        <td><form name="edit" action="admin_program_edit.php" method="post" ><input type="hidden" name="edit_cat_id" value="<?php echo $program_id_pr;  ?>"/><input type="image" src="images/btn_edit.jpg" value="EDIT" /></form>    
   
        </td>
        <td  class="link brn_n">
       <form name='delete' action='del_category_action.php' method='post' onsubmit="return confirm('Are you sure you want to delete this program?')"><input type='hidden' name='prog_id_del' value=' <?php echo $program_id_pr; ?>'/><input type='image' src='images/delete.png' value='DELETE' /></form></td>
        </tr>
      <?php
	} // end value featching pr
	  
	  ?>
      
     
    </table>
  </div>
    </div>
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