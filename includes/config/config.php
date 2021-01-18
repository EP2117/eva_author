<?php
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
ob_start();

session_start();

/* //Web
$host     	= 'localhost';

$username 	= 'authorsm_eva';

$password 	= '3va123!@#';

$database 	= 'authorsm_eva';
define("PROJECT_PATH", "http://authorsmyanmar.com/eva/"); */
//local

$host     	= 'localhost';

$username 	= 'root';

$password 	= '';

$database 	= 'arasoft_erp_eva';

//define("PROJECT_PATH", "https://arasoftwares.in/eva/");
define("PROJECT_PATH", "http://localhost/eva/");
define("PROJECT_FOOTER", "&copy; 2018 Authors | Design By : <a href='http://www.binarytheme.com/' target='_blank' > www.Authorsmyanmar.com </a>");

define("SESS", "erp_eva");

$connection = mysql_connect($host, $username, $password);

if (!$connection) { 	

	die('Could not connect: ' . mysql_error());

}

mysql_select_db($database, $connection);

// Timezone Setting

date_default_timezone_set('Asia/Rangoon');

// No script    PLEASE edit URL in noscript.php

//echo "<noscript><meta http-equiv='refresh' content='0;url=http://server/projects/comfy/ja-erp/sein-family/development/noscript.php'></noscript>";









?>  