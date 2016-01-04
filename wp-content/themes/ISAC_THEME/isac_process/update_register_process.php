<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('../config/config.php');
	 $isacid = $_SESSION['SESS_MEMBER_ID'];
?>
<?php
 $reg_details = mysql_query("SELECT * FROM registration WHERE isacid = '$isacid'");


while($user_details = mysql_fetch_array($reg_details))
{
	
	$country = $user_details['country'];
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
//Sanitize the POST values
$firstname = clean($_POST["firtsname"]);
$lastname = clean($_POST["lastsname"]);
$email =clean($_POST["email"]);
$password = clean($_POST["password"]);
$datebirth = clean($_POST["date"]);
$month = clean($_POST["month"]);
$year = clean($_POST["year"]);
$gender = clean($_POST["gender"]);
$phone_home2 = clean($_POST['phone_home']);
$cell = clean($_POST['cell']);

if($phone_home2 == '')
	$phone_home = $cell;
else
	$phone_home = $phone_home2;

$skype = clean($_POST['skype']);
$address = clean($_POST['address']);
$zip = clean($_POST['zip']);
$city = clean($_POST['city']);
$state = clean($_POST['state']);
$country = clean($_POST['country']);
$prinfo = '1';

//$dateofregistration = date('d/m/Y - h:i:s A', time()+19800);

	
	//If there are input validations, redirect back to the registration form
	
// checking the user name

	 $msgTo = $email;
    $msgSubject = "ISAC registration updation";    
   // $msgHeaders = "To: $msgTo\r\n";
   $msgHeaders = "From: ISAC <info@indiastudyabroad.org>";
	 $msgContent= "Hi $firstname

You have successfully updated your personal details on indiastudyabroad.org. Your account details are as follows

 Username - $email
 Password - $password

Please retain these details in order to login to your account,apply for program and check your application status.
We thank you for registering on our site and look forward to welcome you to our programs.";
  //  $msgHeaders .= "From: info@indiastudyabroad.org\r\n";
   // $msgHeaders .= "X-Mailer: PHP".phpversion();
    
    $success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
	
	// end newsletter
	
	
	//Create INSERT query
$qry = "UPDATE registration
SET  firstname = '$firstname',lastname = '$lastname',email = '$email',password = '".md5($password)."',date = '$datebirth',month = '$month',year = '$year',gender = '$gender',phone_number = '$phone_home',phone_mobile = '$cell',skype = '$skype',address = '$address',zip = '$zip',city = '$city',state = '$state',country = '$country',flag_prinfo='$prinfo'  WHERE isacid = '$isacid' ";
	$result = @mysql_query($qry);
	
	
	
if($user_info1==1 &&  $user_info1==1 )
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