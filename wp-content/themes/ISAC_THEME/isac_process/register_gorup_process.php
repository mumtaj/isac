<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('../config/config.php');
	
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
$uni_name = clean($_POST['uni_name']);
$uni_contact = clean($_POST['uni_contact']);
$gp = clean($_POST['GP']);

$dateofregistration = date('d/m/Y - h:i:s A', time()+19800);

	$query1 = mysql_query("SELECT * FROM registration ORDER BY id DESC LIMIT 0,1");
	while($row = mysql_fetch_array($query1))
  {
 $a = $row['id'];

  }
   $c = $a + '1';
 $isacid='ISAC'.$c;
	//If there are input validations, redirect back to the registration form
	 //group id genenration
 $g = $a + '1';
 $gp_isacid ="GP_ISAC".$g;
 
 
// checking the user name
$query_username_select = mysql_query("SELECT * FROM registration WHERE email = '$email'");		
	// newsletter
if(mysql_num_rows($query_username_select))
{
	 echo"
	 <script type='text/javascript'>

window.location = 'register-check-username'

</script>";
}
else
{
	 $msgTo = $email;
    $msgSubject = "ISAC registration confirmation";    
    $msgHeaders = "To: $msgTo\r\n";
	 $msgContent= "Hi $firstname

You have successfully registered on indiastudyabroad.org
your account details are as follows

 Username - $email
 Password - $password

Please retain these details in order to login to your account.
Apply for program and check your application status.
We thank you for registering on our site and look forward to welcome you to our programs.";
    $msgHeaders .= "From: info@indiastudyabroad.org\r\n";
    $msgHeaders .= "X-Mailer: PHP".phpversion();
    
    $success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
	
	// end newsletter
	/****************INFO Email**************************/
	$msgTo_admin = "info@indiastudyabroad.org";
    $msgSubject_admin = "New ISAC Group registration";    
    
	$msgHeaders_admin = "From: ISAC <info@indiastudyabroad.org>";
	 $msgContent_admin= "Hi 

      New Group registration Details:
	  
		First Name: $firstname
		Last Name: $lastname
		Email: $email
		
		Date of Birth: $datebirth/$month/$year
		Gender: $gender
		
		Address: $address
		City: $city
		Zip: $zip
		State: $state
		Country: $country
		
		Phone Number: $phone_home
		Phone Mobile: $cell
		
		Date of Registration: $dateofregistration
	  
	  
	  ";
    
  //  mail("nadeermadampat@gmail.com","Test Mail","test message my dear", $msgHeaders);
    $success_admin = mail($msgTo_admin, $msgSubject_admin, $msgContent_admin, $msgHeaders_admin);
	
	/******************************************/
	
	//Create INSERT query
$qry = "INSERT INTO registration(isacid,firstname,lastname,email,password,date,month,year,gender,dateofregistration,phone_number,phone_mobile,skype,address,zip,city,state,country,group,group_id) VALUES('$isacid','$firstname','$lastname','$email','".md5($password)."','$datebirth','$month','$year','$gender','$dateofregistration','$phone_home','$cell','$skype','$address','$zip','$city','$state','$country','$gp','$gp_isacid')";
	$result = @mysql_query($qry);
	
	
	
	//Check whether the query was successful or not
	if($result) {
		unset($_COOKIE['prefill']);
			setcookie('prefill','$email',time()+60*60*24*10,'/','indiastudyabroad.org',false,true);
			
					 echo"
	 <script type='text/javascript'>

window.location = '".SERVER_URL."register-success'
</script>";
		exit();
	}else {
		 die('Could not connect: ' . mysql_error());
	}
}
?>