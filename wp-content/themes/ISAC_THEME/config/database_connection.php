<?php
$mysql_hostname = "localhost";
$mysql_user = "india_isac";
$mysql_password = "redigital@123";
$mysql_database = "india_isacnew";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");

?>