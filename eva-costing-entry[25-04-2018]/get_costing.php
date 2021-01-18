<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	$select_pur_costing		=	"SELECT 
									pur_costing_id,
									pur_costing_name 
								 FROM 
									pur_costings 
								 WHERE 
									pur_costing_deleted_status	 	= 	0  		AND
									pur_costing_active_status 		=	'active'
								 ORDER BY 
									pur_costing_name ASC";
	$result_pur_costing 	= mysql_query($select_pur_costing);
	// Filling up the array
	$pur_costing_data 	= array();
	$data="<option value=''> - Select - </option>";
	while ($record_pur_costing = mysql_fetch_array($result_pur_costing))
	{
	 $data	.= "<option value=".$record_pur_costing['pur_costing_id'].">".$record_pur_costing['pur_costing_name']."</option>";
	}
	
	echo $data;
?>

		