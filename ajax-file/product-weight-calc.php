<?php 

	require_once('../includes/config/config.php');

    //supplier ID

	$brand_id  			= $_GET["brand_id"];
	$prd_thick  		= $_GET["prd_thick"];
	$prd_type  			= $_GET["prd_type"];
	$prd_qty_val  		= $_GET["prd_qty_val"];
	
	$select_prd		= "SELECT 
							wc_weight_ton,
							wc_weight_mm
					   FROM
					   		weight_calulation	
					   WHERE
					   		pwc_type			= '".$prd_type."'		AND
							wc_brand_id			= '".$product_id."'		AND
							pwc_thick_ness		= '".$prd_thick."'		AND
							pwc_deleted_status	= 0
					  ORDER BY
					  		pwc_id DESC";
	 $result 		= mysql_query($select_prd);	
	 $array_result 	= mysql_fetch_array($result);
	 
	 echo 	$array_result['pwc_weight']*$prd_qty_val;	 

?>


			 

 

  



 

 