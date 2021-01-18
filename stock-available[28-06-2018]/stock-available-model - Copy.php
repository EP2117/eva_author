<?php 


	function stockDetailsList(){
		
				  
		$where = " stock_ledger_status =0 AND stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND stock_ledger_company_id = '".$_SESSION[SESS.'_session_company_id']."' AND stock_ledger_date BETWEEN '".NdateDatabaseFormat($_REQUEST['from_date'])."' AND '".NdateDatabaseFormat($_REQUEST['to_date'])."' ";
		
		if(!empty($_REQUEST['brandid'])){
			$where .= " AND product_brand_id='".$_REQUEST['brandid']."'";
		}
		if(!empty($_REQUEST['type'])){
			$where .= "AND product_product_category_id='".$_REQUEST['type']."'";
		}
		if(!empty($_REQUEST['product_status'])){
			$where .= " AND dms_product_status='".$_REQUEST['product_status']."'";
		}
		if(!empty($_REQUEST['category'])){
			$where .= " AND dms_product_status='".$_REQUEST['category']."'";
		}
		if(!empty($_REQUEST['productname'])){
			$where .= " AND product_brand_id='".$_REQUEST['productname']."'";
		}
		if(!empty($_REQUEST['color'])){
			$where .= "AND product_product_category_id='".$_REQUEST['color']."'";
		}
		if(!empty($_REQUEST['width'])){
			$where .= " AND product_thick_ness='".$_REQUEST['width']."'";
		}
		if(!empty($_REQUEST['thik'])){
			$where .= " AND product_thick_ness='".$_REQUEST['thik']."'";
		}
		
		$table		= "stock_ledger";
		if(!empty($_REQUEST['warehouseid'])){
			$where .= " AND stock_ledger_godown_id='".$_REQUEST['warehouseid']."'";
		}
		$query	= "SELECT 
						product_id ,
						product_code, 
						product_name,
						product_cost_price,
						brand_name,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_length_feet  ELSE NULL END)  as pur_length_feet,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_length_meter  ELSE NULL END)  as pur_length_meter,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_weight_tone  ELSE NULL END)  as pur_weight_tone,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_weight_kg  ELSE NULL END)  	as pur_weight_kg,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_length_feet  ELSE NULL END)  as sal_length_feet,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_length_meter  ELSE NULL END)  as sal_length_meter,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_weight_tone  ELSE NULL END)  as sal_weight_tone,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_weight_kg  ELSE NULL END)  	as sal_weight_kg,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_product_length_inches  ELSE NULL END)  as sal_qty,
						sum(stock_ledger_product_quantity*stock_ledger_length_feet) as closing_bal,
						sum(stock_ledger_product_quantity*stock_ledger_length_meter) as closing_bal,
						sum(stock_ledger_product_quantity*stock_ledger_weight_tone) as closing_bal,
						sum(stock_ledger_product_quantity*stock_ledger_weight_kg) as closing_bal,
						product_category_name,
						p_uom.product_uom_name as p_uom_name,
						child_uom.product_uom_name as c_uom_name,
						product_con_entry_child_product_detail_code,
						product_con_entry_child_product_detail_name,
						stock_ledger_prd_type,
						stock_ledger_product_id
					FROM 
						".$table."
					LEFT JOIN 
						products 
					ON 
						product_id 												= stock_ledger_product_id
						
					LEFT JOIN 
						brands 
					ON 
						product_brand_id 										= brand_id
					LEFT JOIN 
						product_categories 
					ON 
						product_product_category_id								=	product_category_id
					LEFT JOIN 
						product_con_entry_child_product_details 
					ON 
						product_con_entry_child_product_detail_id				= stock_ledger_product_id	
					LEFT JOIN 
						product_uoms as p_uom
					ON 
						p_uom.product_uom_id 									= product_product_uom_id
					LEFT JOIN 
						product_uoms as  child_uom
					ON 
						child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
					WHERE
					  $where
					GROUP BY 
						stock_ledger_prd_type,stock_ledger_product_id";	
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function stock_opening($product_stock_from_date,$product_id,$stock_ledger_prd_type){
		$select_opening	= " SELECT 
								stock_ledger_product_id, 
								sum(stock_ledger_product_quantity*stock_ledger_product_length_inches) as open_bal
							 FROM 
								stock_ledger
							WHERE 
								stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' 					AND  	
								stock_ledger_status 		= 0																	AND
								stock_ledger_company_id 	= '".$_SESSION[SESS.'_session_company_id']."' 						AND
								stock_ledger_date			<	'".NdateDatabaseFormat($product_stock_from_date)."'				AND
								stock_ledger_product_id		= '".$product_id."'													AND
								stock_ledger_prd_type		= '".$stock_ledger_prd_type."'
							GROUP BY 
								stock_ledger_product_id";
			$result_dc_entry = mysql_query($select_opening);
			$count_dc_entry  = mysql_num_rows($result_dc_entry);
			$record_dc_entry = mysql_fetch_array($result_dc_entry);
			
			return $record_dc_entry['open_bal'];
	}

?>
