<?php 


	function stockDetailsList(){
				  
		$where = " stock_ledger_status =0 AND stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND stock_ledger_company_id = '".$_SESSION[SESS.'_session_company_id']."' AND stock_ledger_date BETWEEN '".NdateDatabaseFormat($_REQUEST['from_date'])."' AND '".NdateDatabaseFormat($_REQUEST['to_date'])."' ";
		
		if(!empty($_REQUEST['colorid'])){
				$where .= " AND product_colour_name='".$_REQUEST['width']."'";
			}
			if(!empty($_REQUEST['thik'])){
				$where .= " AND stock_ledger_thick_ness='".$_REQUEST['thik']."'";
			}
			if(!empty($_REQUEST['productname'])){
				$where .= " AND stock_ledger_product_id LIKE '%".$_REQUEST['productname']."%'";
			}
			if(!empty($_REQUEST['brandid'])){
				$where .= " AND brand_name = '".$_REQUEST['brandid']."'";
			}
				if(!empty($_REQUEST['productcode'])){
				$where .= " AND product_con_entry_child_product_detail_code LIKE '%".$_REQUEST['productcode']."%'";
			}
			if(!empty($_REQUEST['category'])){
				$where .= "AND product_con_entry_child_product_detail_product_category_id='".$_REQUEST['category']."'";
			}
			if(!empty($_REQUEST['type'])){
				$where .= "AND stock_ledger_prd_type='".$_REQUEST['type']."'";
			}
							$query="SELECT 
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
						product_code as product_con_entry_child_product_detail_code,
						product_name as product_con_entry_child_product_detail_name,
						stock_ledger_width_inches as product_con_entry_child_product_detail_width_inches,
						stock_ledger_width_mm as product_con_entry_child_product_detail_width_mm,
						stock_ledger_thick_ness as product_con_entry_child_product_detail_thick_ness,
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
						brands 
					ON 
						product_brand_id 										= brand_id
					LEFT JOIN 
						product_colours 
					ON 
						product_colour_id 										= stock_ledger_colour_id
					WHERE
					  $where AND stock_ledger_prd_type = '2'
					GROUP BY 
						stock_ledger_prd_type,stock_ledger_product_id";
						
						//echo $query;exit;
		 $result = mysql_query($query);
		 $response = array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		 
		 return $response;
		}
?>
