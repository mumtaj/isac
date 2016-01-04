<?php
include('../config/config.php');
//Include The Database Connection File 

if(isset($_POST['email']))//If a username has been submitted 
{
$email = mysql_real_escape_string($_POST['email']);//Some clean up :)

$check_for_username = mysql_query("SELECT email FROM registration WHERE email='$email'");
//Query to check if username is available or not 

if(mysql_num_rows($check_for_username))
{
echo '1';//If there is a  record match in the Database - Not Available
}
else
{
echo '0';//No Record Found - Username is available 
}

}

?>