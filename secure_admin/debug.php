<?php

//print_r function
function p($data)
{
	echo "<pre>";
		print_r($data);
	echo "</pre>";	
}

//die function
function d($data)
{
	echo "<pre>";
		print_r($data);
	echo "</pre>";
	die();
}

//Getting Current page name
$currentpath = $_SERVER["PHP_SELF"];
$currentpath_explode = Explode('/', $currentpath);
$currentpage = $currentpath_explode[count($currentpath_explode) - 1];

$selfhost = $_SERVER['HTTP_HOST'];

$referer = $_SERVER['HTTP_REFERER'];
$refererhost = GetDomain($referer);

if ( $selfhost != $refererhost )
{
	echo "<script type='text/javascript'> window.location = 'access-denied.php'; </script>";
	exit();	
}

//GETTING REFERER URL domain name
function GetDomain($url)
{
	$domain = parse_url( str_replace('www\.','',$url) );
	
	return empty($domain["host"]) ? $domain["path"] : empty($domain["port"]) ? $domain["host"] : $domain["host"] .":". $domain["port"];
}

//GETTING USER PERMISSION FROM SESSION 
$set_permission = isset($_SESSION['SET_PERMISSION']) ? $_SESSION['SET_PERMISSION'] : '';


$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if( ! $link ) { die('Failed to connect to server: ' . mysql_error()); }
$db = mysqli_select_db($link, DB_DATABASE);
if ( ! $db )  { die("Unable to select database"); }

function mysqlquery( $sql )
{
    global $link;

    return $link->query($sql);
}

function mysqlnumrows( $result )
{
    return $result->num_rows;
}

?>