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
	   $query	="SELECT pRp_product_id,pRp_qty,product_id,product_name,product_code,product_type,product_uom_name,supplier_name,supplier_location,DATE_FORMAT(pR_purchase_date ,'%d/%m/%Y') pR_purchase_date,IFNULL((SELECT SUM(grnP_accept) FROM grn_details LEFT JOIN grn_details_products ON grnId = grnP_grnId WHERE grn_purchaseId = '".$_REQUEST['poid']."' and grnP_product_id = pRp_product_id group by grnP_product_id),0) as received_qty
				  FROM purchase_order 
				  LEFT JOIN purchase_order_products ON purchaseId = pRp_purchaseId
				  LEFT JOIN products ON pRp_product_id = product_id
				  LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id 
				  LEFT JOIN suppliers ON pR_supplier_id = supplier_id	
				  WHERE purchaseId = '".$_REQUEST['poid']."'  AND product_deleted_status=0 AND  product_active_status='active' ";
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
				 LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id 	
				 WHERE product_deleted_status=0 AND product_active_status='active' and product_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	function productDetails(){
	
		 $query	="SELECT product_id,product_name,product_code,product_type,product_uom_name
				 FROM products 
				 LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id 	
				 WHERE product_deleted_status=0 AND product_active_status='active' and product_id='".$_REQUEST['id']."' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}	
	
?>

		