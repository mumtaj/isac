<?php
include('../config/config.php');
//Include The Database Connection File 

if(isset($_POST['groupname']))//If a username has been submitted 
{
$groupname = mysql_real_escape_string($_POST['groupname']);//Some clean up :)

$check_for_groupname = mysql_query("SELECT group_name FROM partner WHERE group_name='$groupname'");
//Query to check if username is available or not 

if(mysql_num_rows($check_for_groupname))
{
echo '1';//If there is a  record match in the Database - Not Available
}
else
{
echo '0';//No Record Found - Username is available 
}

}

?>