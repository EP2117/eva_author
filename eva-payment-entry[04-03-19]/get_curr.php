<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	$select_currency		=	"SELECT 
									currency_id,
									currency_name 
								 FROM 
									currencies 
								 WHERE 
									currency_deleted_status	 	= 	0  		AND
									currency_active_status 		=	'active'
								 ORDER BY 
									currency_name ASC";
	$result_currency 	= mysql_query($select_currency);
	// Filling up the array
	$currency_data 	= array();
	$data='';
	while ($record_currency = mysql_fetch_array($result_currency))
	{
	 $data	.= "<option value='".$record_currency['currency_id']."'>'".$record_currency['currency_name']."'</option>";
	}
	
	echo $data;

?>

		