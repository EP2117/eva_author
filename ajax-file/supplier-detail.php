<?php 
	require_once('../includes/config/config.php');
    //supplier ID
	$cus_id 			= $_GET["cus_id"];
	
	$select_supplier 	=   "SELECT 
								supplier_code,
								supplier_type_name, 
								city_name,
								supplier_total_credit_limit,
								supplier_minimum_credit_per_day,
								supplier_payment_days,
								country_name
							 FROM 
								suppliers
							 LEFT JOIN
								cities
							 ON
								city_id						=  supplier_city_id
							 LEFT JOIN
								countries
							 ON
								country_id					=  supplier_country_id	
							 LEFT JOIN
								supplier_types
							 ON
								supplier_type_id			=  supplier_supplier_type_id
							 WHERE 
								supplier_id 				= '".$cus_id."' 	AND 
								supplier_deleted_status 	= 0 
							 ORDER BY 
								supplier_name ASC";	
	$result_supplier 	=  mysql_query($select_supplier);
	$record_supplier 	= mysql_fetch_array($result_supplier);
	
	echo $record_supplier['supplier_code']."@".$record_supplier['supplier_type_name']."@".$record_supplier['city_name']."@".$record_supplier['supplier_total_credit_limit']."@".$record_supplier['supplier_minimum_credit_per_day']."@".$record_supplier['supplier_payment_days']."@".$record_supplier['country_name'];
?>

			 
 
  

 
 