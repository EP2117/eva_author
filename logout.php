<?php 
	require_once('includes/config/config.php');
	require_once('includes/config/utility-class.php');
 
session_destroy();	
header("Location:index.php?msg=3");
?>
