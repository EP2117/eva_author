<?php 
	require_once('../includes/config/config.php');
    //product ID
	$cus_id 			= $_GET["cus_id"];
	
	$select_product 	=   "SELECT 
								product_uom_name,
								product_thick_ness
							 FROM 
								products
							 LEFT JOIN
								product_uoms
							 ON
								product_uom_id			=  product_product_uom_id
							 WHERE 
								product_id 				= '".$cus_id."' 	AND 
								product_deleted_status 	= 0 
							 ORDER BY 
								product_name ASC";	
	$result_product 	=  mysql_query($select_product);
	$record_product 	= mysql_fetch_array($result_product);
	
	echo $record_product['product_code']."@".$record_product['product_type_name']."@".$record_product['product_uom_name']."@".$record_product['product_total_credit_limit']."@".$record_product['product_minimum_credit_per_day']."@".$record_product['product_payment_days'];
?>

			 
 
  

 
 