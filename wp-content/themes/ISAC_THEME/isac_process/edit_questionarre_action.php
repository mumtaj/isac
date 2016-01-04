<?php 
session_start();
 require_once('../config/config.php');
  ?>
  
<?php $isacid = $_SESSION['SESS_MEMBER_ID']; 


function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
}

 $educational_qualifications = clean($_POST['qualifications']);
 $previous_experience = clean($_POST['Q1yn']);
 $previous_experience_describe = clean($_POST['previous_experience_describe']);
 $visited_india = clean($_POST['Q2yn']);
 $visited_india_locations = clean($_POST['visited_india_locations']);
 $purpose_of_visit = clean($_POST['purpose_of_visit']);
 $local_language = clean($_POST['Q3yn']);
 $local_language_mention = clean($_POST['local_language_mention']);
 $interested_in_program = clean($_POST['interested_in_program']);
 $your_expectations = clean($_POST['your_expectations']);
 $about_ISAC = clean($_POST['Study_abroad_websites']);
 $flag='1';
 $formid = clean($_POST['formid']);


$update = mysql_query("UPDATE registration SET educational_qualifications= '$educational_qualifications' , previous_experience='$previous_experience' ,previous_experience_describe='$previous_experience_describe',visited_india= '$visited_india' , visited_india_locations='$visited_india_locations' ,purpose_of_visit='$purpose_of_visit', local_language='$local_language' ,local_language_mention='$local_language_mention' , interested_in_program='$interested_in_program' ,your_expectations='$your_expectations',about_ISAC='$about_ISAC',flag='$flag' WHERE isacid = '$isacid'");

?>
<?php
 $reg_details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");
while($user_details = mysql_fetch_array($reg_details))
{
	$user_info = $user_details['flag'];
	$user_info1 = $user_details['flag2'];	
}

if($user_info1==1)
{
	
	echo "  <script type='text/javascript'>";

echo "window.location = '".SERVER_URL."my-isac'";

echo "</script> "  ;
	

}
else
{
	echo "  <script type='text/javascript'>";

echo "window.location = '".SERVER_URL."educational_work_details'";

echo "</script> "  ;
	
}




?>