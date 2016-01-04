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


if($selfhost != $refererhost)
{
	echo"
		<script type='text/javascript'>
			window.location = 'access-denied.php'
		</script>";
	exit();	
}

//GETTING REFERER URL domain name
function GetDomain($url)
{
	$nowww = ereg_replace('www\.','',$url);
	$domain = parse_url($nowww);
	
	if(!empty($domain["host"]))
		return $domain["host"];
	else
		return $domain["path"];
}


//GETTING USER PERMISSION FROM SESSION 
$set_permission = $_SESSION['SET_PERMISSION'];

?>