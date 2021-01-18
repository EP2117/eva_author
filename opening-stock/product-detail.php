<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	$select_product		=	"SELECT 
								product_id,
								product_name,
								product_code,
								product_type,
								product_uniq_id,
								brand_name,
								product_category_name,
								product_uom_name,
								product_cost_price
							 FROM 
								products
							 LEFT JOIN
								brands
							 ON
								brand_id			= product_brand_id 
							 LEFT JOIN
								product_categories
							 ON
								product_category_id	= product_product_category_id 
							LEFT JOIN
								product_uoms
							 ON
								product_uom_id		= product_uom_one_id 	
							 WHERE 
								product_deleted_status 	= 	0 			AND 
								product_active_status 	=	'active'	
							 ORDER BY 
								product_name ASC";
		$result_product 		= mysql_query($select_product);
		$array_result=array();
		while ($record_product = mysql_fetch_array($result_product)){
			$array_result[] =$record_product;
		}
		echo json_encode($array_result);
?>
	