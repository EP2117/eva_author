<?php 





	function stockDetailsList(){

				  

		$where = " stock_ledger_status =0 AND stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND stock_ledger_company_id = '".$_SESSION[SESS.'_session_company_id']."' AND stock_ledger_date BETWEEN '".NdateDatabaseFormat($_REQUEST['from_date'])."' AND '".NdateDatabaseFormat($_REQUEST['to_date'])."' ";

		$child='';
		$mother='';

		if(!empty($_REQUEST['colorid'])){

				$where .= " AND product_colour_id='".$_REQUEST['colorid']."'";

			}

			if(!empty($_REQUEST['thik'])){

				$where .= " AND stock_ledger_thick_ness='".$_REQUEST['thik']."'";

			}

			if(!empty($_REQUEST['productname'])){

				$mother .= " AND product_name LIKE '%".$_REQUEST['productname']."%'";
                $child .= " AND product_con_entry_child_product_detail_name LIKE '%".$_REQUEST['productname']."%'";
			}
			
			if(!empty($_REQUEST['warehouseid'])){

				$where .= " AND stock_ledger_godown_id LIKE '%".$_REQUEST['warehouseid']."%'";

			}

			if(!empty($_REQUEST['brandid'])){

				$where .= " AND brand_id = '".$_REQUEST['brandid']."'";

			}

		   if(!empty($_REQUEST['productcode'])){

				$mother .= " AND product_code LIKE '%".$_REQUEST['productcode']."%'";
				$child .= " AND product_con_entry_child_product_detail_code LIKE '%".$_REQUEST['productcode']."%'";
			}

			if(!empty($_REQUEST['category'])){

				$where .= "AND product_con_entry_child_product_detail_product_category_id='".$_REQUEST['category']."'";

			}

			if(!empty($_REQUEST['type'])){

				$where .= "AND stock_ledger_prd_type='".$_REQUEST['type']."'";

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
						brand_name,brand_id,
						product_code,stock_ledger_entry_type,
						product_name,
						stock_ledger_width_inches as product_con_entry_child_product_detail_width_inches,
						stock_ledger_width_mm as product_con_entry_child_product_detail_width_mm,
						stock_ledger_thick_ness,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						product_colour_name,stock_ledger_godown_id
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
					  $where $mother AND stock_ledger_prd_type = '2' AND stock_ledger_mother_child_type=1
					GROUP BY 
						stock_ledger_prd_type,stock_ledger_product_id,stock_ledger_colour_id,stock_ledger_thick_ness";

						

					//echo $query;exit;

		 $result = mysql_query($query);

		 $response = array();

		 while($resultData = mysql_fetch_array($result)){		 

			$response[]= $resultData;

		 }
		 
		
		 
		 		 $query1	= "SELECT 
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
						brand_name,brand_id,
						product_con_entry_child_product_detail_code as product_code,stock_ledger_entry_type,
						product_con_entry_child_product_detail_name as product_name,
						stock_ledger_width_inches as product_con_entry_child_product_detail_width_inches,
						stock_ledger_width_mm as product_con_entry_child_product_detail_width_mm,
						stock_ledger_thick_ness,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						product_colour_name,stock_ledger_godown_id
					FROM 
						stock_ledger
					LEFT JOIN 
						product_con_entry_child_product_details 
					ON 
						product_con_entry_child_product_detail_id												= stock_ledger_product_id	
				
					LEFT JOIN 
						product_uoms 
					ON 
						product_uom_id 									= product_con_entry_child_product_detail_uom_id
					LEFT JOIN 
						brands 
					ON 
						brand_id 										= product_con_entry_child_product_detail_product_brand_id
					LEFT JOIN 
						product_colours 
					ON 
						product_colour_id 								= stock_ledger_colour_id
					WHERE
					  $where $child AND stock_ledger_prd_type = '2' AND stock_ledger_mother_child_type='2'
					GROUP BY 
						stock_ledger_prd_type,stock_ledger_product_id,stock_ledger_colour_id,stock_ledger_thick_ness";

						

					//echo $query1;exit;

		 $result = mysql_query($query1);

		 while($resultData = mysql_fetch_array($result)){		 

			$response[]= $resultData;

		 }


		 

		 return $response;

		}

?>

