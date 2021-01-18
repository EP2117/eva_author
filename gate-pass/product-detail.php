<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'request_details':gatepassDetails();
				break;
		}
		
	}
	
	function gatepassDetails(){
	   $query	="SELECT pdo_entry_id,pdo_entry_product_detail_product_id,product_name,product_code,product_colour_name,product_thick_ness,pdo_entry_product_detail_width_inches,pdo_entry_product_detail_width_mm,pdo_entry_product_detail_width_inches,pdo_entry_product_detail_length_feet,product_uom_name,customer_name,pdo_entry_vehicle_no,pdo_entry_driver_name,pdo_entry_product_detail_qty,pdo_entry_delivery_type
				  FROM pdo_entry 
				  LEFT JOIN pdo_entry_product_details ON pdo_entry_id = pdo_entry_product_detail_pdo_entry_id
				  LEFT JOIN products ON pdo_entry_product_detail_product_id = product_id
				  LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id 
				  LEFT JOIN product_colours ON product_colour_id = product_product_colour_id 
				  LEFT JOIN customers ON pdo_entry_customer_id = customer_id
				  WHERE pdo_entry_id = '".$_REQUEST['gatepassid']."'  AND product_deleted_status=0 AND  product_active_status='active' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}

?>

		