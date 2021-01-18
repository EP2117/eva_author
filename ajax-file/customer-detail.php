<?php 
	require_once('../includes/config/config.php');
    //customer ID
	$cus_id 			= $_GET["cus_id"];
	
	$select_customer 	=   "SELECT 
								customer_code,
								customer_type_name, 
								city_name,
								customer_total_credit_limit,
								customer_minimum_credit_per_day,
								customer_payment_days,
								customer_billing_address,
								customer_contact_no
							 FROM 
								customers
							 LEFT JOIN
								cities
							 ON
								city_id						=  customer_city_id
							 LEFT JOIN
								customer_types
							 ON
								customer_type_id			=  customer_customer_type_id
							 WHERE 
								customer_id 				= '".$cus_id."' 	AND 
								customer_deleted_status 	= 0 
							 ORDER BY 
								customer_name ASC";	
	$result_customer 	=  mysql_query($select_customer);
	$record_customer 	= mysql_fetch_array($result_customer);
	
	echo $record_customer['customer_code']."@".$record_customer['customer_type_name']."@".$record_customer['city_name']."@".$record_customer['customer_total_credit_limit']."@".$record_customer['customer_minimum_credit_per_day']."@".$record_customer['customer_payment_days']."@".$record_customer['customer_billing_address']."@".$record_customer['customer_contact_no'];
?>

			 
 
  

 
 