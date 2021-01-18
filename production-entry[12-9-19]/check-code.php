<?php  

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');
	$frm_date		= NdateDatabaseFormat($_REQUEST['frm_date']); 
	$to_date		= NdateDatabaseFormat($_REQUEST['to_date']); 
	$diff_days		= diff_days($frm_date,$to_date)+1;
	echo  $diff_days;
?>

