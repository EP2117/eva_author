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
	    $query	="SELECT 	production_order_product_detail_id,production_order_product_detail_product_id,product_id,product_name,product_code,product_type,product_uom_name,production_order_product_detail_qty,product_colour_name,product_thick_ness,production_order_product_detail_width_feet,product_cost_price,DATE_FORMAT(production_order_date ,'%d-%m-%Y') as production_order_date
				  FROM production_order 
				  LEFT JOIN production_order_product_details ON production_order_id = production_order_product_detail_production_order_id
				  LEFT JOIN products ON production_order_product_detail_product_id = product_id
				  LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id 
				  LEFT JOIN product_colours ON product_product_colour_id=product_colour_id
				  WHERE production_order_id = '".$_REQUEST['poid']."'  AND product_deleted_status=0 AND  product_active_status='active' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	function prductList(){
		
		$val   = $_REQUEST['val'];
	    $query = "SELECT product_con_entry_child_product_detail_id,product_con_entry_child_product_detail_code,product_con_entry_child_product_detail_name
				 FROM product_con_entry_child_product_details 
				 LEFT JOIN product_uoms ON product_con_entry_child_product_detail_uom_id = product_uom_id 	
				 WHERE product_con_entry_child_product_detail_deleted_status=0 AND product_con_entry_child_product_detail_name LIKE '%$val%' LIMIT 15";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	function productDetails(){
	
		  $query	="SELECT product_con_entry_child_product_detail_code,product_uom_name,product_colour_name,product_con_entry_child_product_detail_thick_ness,product_con_entry_child_product_detail_width_inches,product_con_entry_child_product_detail_width_inches ,IFNULL((SELECT sum(stock_ledger_product_quantity*stock_ledger_product_length_inches) as open_bal
							 FROM 
								stock_ledger
							WHERE 
								stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' 					AND  	
								stock_ledger_status 		= 0																	AND
								stock_ledger_company_id 	= '".$_SESSION[SESS.'_session_company_id']."' 						AND
								stock_ledger_date			<	'".NdateDatabaseFormat($_REQUEST['ds_date'])."'				    AND
								stock_ledger_product_id		= product_con_entry_child_product_detail_id							AND
								stock_ledger_prd_type		= '2'
							GROUP BY 
								stock_ledger_product_id),0) AS length
				 FROM product_con_entry_child_product_details 
				 LEFT JOIN product_uoms ON product_con_entry_child_product_detail_uom_id = product_uom_id  	
				 LEFT JOIN product_colours ON product_con_entry_child_product_detail_color_id=product_colour_id
				 WHERE product_con_entry_child_product_detail_deleted_status=0 AND product_con_entry_child_product_detail_id='".$_REQUEST['id']."' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}	
	
?>

		