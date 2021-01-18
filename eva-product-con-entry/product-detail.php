<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'request_details':requestDetails();
				break;
			case 'get_prodname':prductList();
				break;
			case 'prod_details':productDetails();
				break;
		}
		
	}
	
	function requestDetails(){
	  $query	="SELECT invReqProdId,iRp_productid,product_id,product_name,product_code,iRp_qty,product_type,product_uom_name,product_cost_price,iRq_noofpaking,iRq_pakingdetails,iRq_remarks,department_name,employee_name,iRq_req_type,iRq_warehouseid,godown_name,DATE_FORMAT(iRq_rqdate ,'%d/%m/%Y') iRq_rqdate
				 FROM eng_inventory_request_receipt 
				 LEFT JOIN eng_inventory_request_products ON inventoryRequestId = iRp_inventoryRequestId
				 LEFT JOIN products ON iRp_productid = product_id
				 LEFT JOIN product_uoms ON product_uom_id = product_uom_one_id 	
				 LEFT JOIN hr_employees ON iRq_employee=employee_id
				 LEFT JOIN departments ON iRq_departmentid=department_id
				 LEFT JOIN godowns ON iRq_warehouseid = godown_id
				 WHERE inventoryRequestId = '".$_REQUEST['reqid']."'  AND product_deleted_status=0 AND  product_active_status='active' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	function prductList(){
	
		$val   = $_REQUEST['val'];
	    $query = "SELECT product_id,product_name
				 FROM products 
				 LEFT JOIN product_uoms ON product_uom_id = product_uom_one_id 	
				 WHERE product_deleted_status=0 AND product_active_status='active' and product_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	function productDetails(){
	
		 $query	="SELECT product_id,product_name,product_code,product_type,product_uom_name,product_cost_price
				 FROM products 
				 LEFT JOIN product_uoms ON product_uom_id = product_uom_one_id 	
				 WHERE product_deleted_status=0 AND product_active_status='active' and product_id='".$_REQUEST['id']."' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}	
	
?>

		