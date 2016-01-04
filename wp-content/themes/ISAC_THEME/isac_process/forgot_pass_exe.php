<?php
	//Include database connection details
	require_once('../config/config.php');
	
	//Sanitize the POST values
	if($_POST['login'] != '')
	{
		//Function to sanitize values received from the form. Prevents SQL injection
		function clean($str) 
		{
			$str = @trim($str);
			if(get_magic_quotes_gpc()) 
			{
				$str = stripslashes($str);
			}
			return mysql_real_escape_string($str);
		}		
		
		$login = clean($_POST['login']);
		
		$sql = "SELECT email FROM registration WHERE email = '$login'";
		$result = mysql_query($sql);
		
		if(mysql_num_rows($result) > 0)
		{
			//password gen
			function randomChar($digit) 
			{
				$char = array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
				$keys = array();
				while(count($keys) < $digit) 
				{
					$x = mt_rand(0, count($char)-1);
					if(!in_array($x, $keys)) 
					{
						$keys[] = $x;
					}
				}
			
				foreach($keys as $key)
				{
					$random_chars .= $char[$key];
				}
				
				return $random_chars;
			}
			
			$pass = randomChar(8);
			$pass;
			//end
			
			
			$msgTo = $login;
			$msgSubject = "ISAC Change password request";    
			$msgHeaders = "From: ISAC <info@indiastudyabroad.org>"; //"To: $msgTo\r\n";
			$msgContent= "Hi,
			
			You have successfully changed your Indiastudyaborad.org account password
			your account details are as follows
			
			Username - $login
			Password - $pass
			
			Please retain these details in order to login to your account.";
			//$msgHeaders .= "From: info@indiastudyabroad.org\r\n";
			//$msgHeaders .= "X-Mailer: PHP".phpversion();
			
			$success = mail($msgTo, $msgSubject, $msgContent, $msgHeaders);
			
			//Create query
			mysql_query("UPDATE registration SET password= '".md5($pass)."' WHERE email = '$login'");
			
			header("location: ".SERVER_URL."thankyou-password");
			exit();
		}
		else
		{
			header("location: ".SERVER_URL."thankyou-password?status=false");
			exit();
		}
	}
	else
	{
		header("location: ".SERVER_URL."thankyou-password?status=false");
		exit();	
	}
?>