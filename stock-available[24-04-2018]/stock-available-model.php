<?php 


	function stockDetailsList(){
				  
		$where = " stock_ledger_status =0 AND stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND stock_ledger_company_id = '".$_SESSION[SESS.'_session_company_id']."' AND stock_ledger_date BETWEEN '".NdateDatabaseFormat($_REQUEST['from_date'])."' AND '".NdateDatabaseFormat($_REQUEST['to_date'])."' ";
		
		if(!empty($_REQUEST['colorid'])){
			$where .= "AND stock_ledger_colour_id='".$_REQUEST['colorid']."'";
		}
		if(!empty($_REQUEST['thik'])){
			$where .= " AND stock_ledger_thick_ness='".$_REQUEST['thik']."'";
		}
		
		$table		= "stock_ledger";
		if(!empty($_REQUEST['warehouseid'])){
			$where .= " AND stock_ledger_godown_id='".$_REQUEST['warehouseid']."'";
		}
		
		if($_REQUEST['product_status']==2){
		if($_REQUEST['warehouseid']==2){
			
			if(!empty($_REQUEST['width'])){
				$where .= " AND stock_ledger_width_inches='".$_REQUEST['width']."'";
			}
			
			if(!empty($_REQUEST['productname'])){
			$where .= " AND product_name LIKE '%".$_REQUEST['productname']."%'";
			}
			if(!empty($_REQUEST['category'])){
				$where .= "AND product_con_entry_child_product_detail_product_category_id='".$_REQUEST['category']."'";
			}
			if(!empty($_REQUEST['brandid'])){
			$where .= " AND product_con_entry_child_product_detail_product_brand_id='".$_REQUEST['brandid']."'";
		 }
		$query	= "SELECT 
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_length_feet  ELSE NULL END)  as pur_length_feet,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_length_meter  ELSE NULL END)  as pur_length_meter,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_weight_tone  ELSE NULL END)  as pur_weight_tone,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_weight_kg  ELSE NULL END)  	as pur_weight_kg,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_length_feet  ELSE NULL END)  as sal_length_feet,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_length_meter  ELSE NULL END)  as sal_length_meter,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_weight_tone  ELSE NULL END)  as sal_weight_tone,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_weight_kg  ELSE NULL END)  	as sal_weight_kg,
						sum(stock_ledger_product_quantity*stock_ledger_length_feet) as closing_length_feet,
						sum(stock_ledger_product_quantity*stock_ledger_length_meter) as closing_length_meter,
						sum(stock_ledger_product_quantity*stock_ledger_weight_tone) as closing_weight_tone,
						sum(stock_ledger_product_quantity*stock_ledger_weight_kg) as closing_weight_kg,
						product_uom_name,
						brand_name,
						product_con_entry_child_product_detail_code,
						product_con_entry_child_product_detail_name,
						stock_ledger_width_inches as product_con_entry_child_product_detail_width_inches,
						stock_ledger_width_mm as product_con_entry_child_product_detail_width_mm,
						stock_ledger_thick_ness as product_con_entry_child_product_detail_thick_ness,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						product_colour_name
					FROM 
						stock_ledger
					LEFT JOIN 
						product_con_entry_child_product_details 
					ON 
						product_con_entry_child_product_detail_id				= stock_ledger_product_id	
					LEFT JOIN 
						product_uoms 
					ON 
						product_uom_id 											= product_con_entry_child_product_detail_uom_id
					LEFT JOIN 
						product_colours 
					ON 
						product_colour_id 										= product_con_entry_child_product_detail_color_id
					LEFT JOIN 
						brands 
					ON 
						brand_id 												= product_con_entry_child_product_detail_product_brand_id
					WHERE
					  $where AND stock_ledger_prd_type = '2'
					GROUP BY 
						stock_ledger_prd_type,stock_ledger_product_id,stock_ledger_colour_id,stock_ledger_thick_ness";	
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		}
		else{
			if(!empty($_REQUEST['width'])){
				$where .= " AND stock_ledger_width_inches='".$_REQUEST['width']."'";
			}
			if(!empty($_REQUEST['thik'])){
				$where .= " AND stock_ledger_thick_ness='".$_REQUEST['thik']."'";
			}
			if(!empty($_REQUEST['productname'])){
				$where .= " AND product_con_entry_child_product_detail_name LIKE '%".$_REQUEST['productname']."%'";
			}
			if(!empty($_REQUEST['brandid'])){
				$where .= " AND product_con_entry_child_product_detail_product_brand_id = '".$_REQUEST['brandid']."'";
			}
			if(!empty($_REQUEST['category'])){
				$where .= "AND product_con_entry_child_product_detail_product_category_id='".$_REQUEST['category']."'";
			}
			if(!empty($_REQUEST['type'])){
				$where .= "AND product_con_entry_child_product_detail_type='".$_REQUEST['type']."'";
			}
		  $query	= "SELECT 
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_length_feet  ELSE NULL END)  as pur_length_feet,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_length_meter  ELSE NULL END)  as pur_length_meter,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_weight_tone  ELSE NULL END)  as pur_weight_tone,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity*stock_ledger_weight_kg  ELSE NULL END)  	as pur_weight_kg,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_length_feet  ELSE NULL END)  as sal_length_feet,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_length_meter  ELSE NULL END)  as sal_length_meter,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_weight_tone  ELSE NULL END)  as sal_weight_tone,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity*stock_ledger_weight_kg  ELSE NULL END)  	as sal_weight_kg,
						sum(stock_ledger_product_quantity*stock_ledger_length_feet) as closing_length_feet,
						sum(stock_ledger_product_quantity*stock_ledger_length_meter) as closing_length_meter,
						sum(stock_ledger_product_quantity*stock_ledger_weight_tone) as closing_weight_tone,
						sum(stock_ledger_product_quantity*stock_ledger_weight_kg) as closing_weight_kg,
						product_uom_name,
						brand_name,
						product_con_entry_child_product_detail_code,
						product_con_entry_child_product_detail_name,
						product_con_entry_child_product_detail_width_inches,
						product_con_entry_child_product_detail_width_mm,
						product_con_entry_child_product_detail_thick_ness,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						product_colour_name
					FROM 
						stock_ledger
					LEFT JOIN 
						product_con_entry_child_product_details 
					ON 
						product_con_entry_child_product_detail_id				= stock_ledger_product_id	
					LEFT JOIN 
						product_uoms 
					ON 
						product_uom_id 											= product_con_entry_child_product_detail_uom_id
					LEFT JOIN 
						product_colours 
					ON 
						product_colour_id 										= product_con_entry_child_product_detail_color_id
					LEFT JOIN 
						brands 
					ON 
						brand_id 												= product_con_entry_child_product_detail_product_brand_id
					WHERE
					  $where AND stock_ledger_prd_type = '2'
					GROUP BY 
						stock_ledger_prd_type,stock_ledger_product_id";	
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		}
	  }
	 elseif($_REQUEST['product_status']==3){
			if(!empty($_REQUEST['productname'])){
				$where .= " AND product_name LIKE '%".$_REQUEST['productname']."%'";
			}
			if(!empty($_REQUEST['brandid'])){
				$where .= " AND product_brand_id = '".$_REQUEST['brandid']."'";
			}
			if(!empty($_REQUEST['category'])){
				$where .= "AND product_product_category_id	='".$_REQUEST['category']."'";
			}
		$query	= "SELECT 
						stock_ledger_length_feet,
						stock_ledger_length_meter,
						stock_ledger_weight_tone,
						stock_ledger_weight_kg,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity  ELSE NULL END)  as pur_qty,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity  ELSE NULL END)  	as sal_qty,
						sum(stock_ledger_product_quantity) as closing_qty,
						product_uom_name,
						brand_name,
						product_code,
						product_name,
						stock_ledger_width_inches,
						stock_ledger_width_mm,
						stock_ledger_thick_ness,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						product_colour_name
					FROM 
						stock_ledger
					LEFT JOIN 
						products 
					ON 
						product_id												= stock_ledger_product_id	
					LEFT JOIN 
						product_uoms 
					ON 
						product_uom_id 											= product_product_uom_id
					LEFT JOIN 
						product_colours 
					ON 
						product_colour_id 										= stock_ledger_colour_id
					LEFT JOIN 
						brands 
					ON 
						product_brand_id 										= brand_id
					WHERE
					  $where AND stock_ledger_prd_type = '3'
					GROUP BY 
						stock_ledger_prd_type,stock_ledger_product_id,stock_ledger_colour_id,stock_ledger_thick_ness";	
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		  }
	  else{
		 $query	= "SELECT 
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity  ELSE NULL END)  as pur_qty,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity  ELSE NULL END)  	as sal_qty,
						sum(stock_ledger_product_quantity) as closing_qty,
						product_uom_name,
						brand_name,
						product_code,
						product_name,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						product_uom_name
					FROM 
						stock_ledger
					LEFT JOIN 
						products 
					ON 
						product_id												= stock_ledger_product_id	
					LEFT JOIN 
						product_uoms 
					ON 
						product_uom_id 											= product_product_uom_id
					LEFT JOIN 
						brands 
					ON 
						product_brand_id 										= brand_id
					WHERE
					  $where AND stock_ledger_prd_type = '1'
					GROUP BY 
						stock_ledger_prd_type,stock_ledger_product_id";	
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
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
