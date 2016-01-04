<?php session_start(); 
 require_once('../config/config.php');
?>
<?php $isacid = $_SESSION['SESS_MEMBER_ID']; ?>
<?php
 $reg_details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");
while($user_details = mysql_fetch_array($reg_details))
{
	$user_info = $user_details['flag'];
	$user_info1 = $user_details['flag2'];	
}
?>
<?php

function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
}

 $student_professional_status = clean($_POST['rbtab']);
 $university = clean($_POST['university']);
 $majoring_in = clean($_POST['majoring']);
 $educational = clean($_POST['education']);
 $year_of_study = clean($_POST['Year']);
 $company = clean($_POST['comp']);
 $title = clean($_POST['title']);
 $academic_qualification = clean($_POST['acdm_qualification']);
 $formid = clean($_POST['formid']);
 $flag1 = '1';


$reg_update = mysql_query("UPDATE registration SET student_professional_status = '$student_professional_status', uni_name = '$university', majoring_in='$majoring_in',educational= '$educational' , year_of_study='$year_of_study' ,company='$company', title='$title' ,academic_qualification='$academic_qualification', flag2='$flag1' WHERE isacid = '$isacid'");



if($user_info==1)
{
	
	echo "  <script type='text/javascript'>";

echo "window.location = '".SERVER_URL."my-isac'";

echo "</script> "  ;
	

}
else
{
	echo "  <script type='text/javascript'>";

echo "window.location = '".SERVER_URL."questionnaire'";

echo "</script> "  ;
	
}




?>