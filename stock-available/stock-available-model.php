<?php 


	function stockDetailsList(){
				  
		$where = " stock_ledger_status =0 AND stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND stock_ledger_company_id = '".$_SESSION[SESS.'_session_company_id']."' AND stock_ledger_date BETWEEN '".NdateDatabaseFormat($_REQUEST['from_date'])."' AND '".NdateDatabaseFormat($_REQUEST['to_date'])."' ";
		
		$child='';
		$mother='';
		
		if(!empty($_REQUEST['colorid'])){
			$where .= "AND stock_ledger_colour_id='".$_REQUEST['colorid']."'";
		}
		if(!empty($_REQUEST['thik'])){
			$where .= " AND stock_ledger_thick_ness='".$_REQUEST['thik']."'";
		}
		if(!empty($_REQUEST['branchid'])){
			$where .= " AND stock_ledger_branch_id='".$_REQUEST['branchid']."'";
		}
		$table		= "stock_ledger";
		if(isset($_REQUEST['warehouseid'])){
		if(is_array($_REQUEST['warehouseid'])!='array'){
		$wh = $_REQUEST['warehouseid'];
		}else{
		$wh = implode(',', $_REQUEST['warehouseid']);	
		}
			$where .= " AND stock_ledger_godown_id IN (".$wh.") ";
		}
		//print_r($_REQUEST);exit;
		$response =array();
		if($_REQUEST['product_status']==2){ 
		$arrwher=$_REQUEST['warehouseid'];
		//if(in_array('2',$_REQUEST['warehouseid'])==1){//echo 'asdf';exit;	
			
			if(!empty($_REQUEST['width'])){
				$where .= " AND stock_ledger_width_inches='".$_REQUEST['width']."'";
			}
			
			if(!empty($_REQUEST['productname'])){
				$mother .= " AND product_name LIKE '%".$_REQUEST['productname']."%'";
                $child .= " AND product_con_entry_child_product_detail_name LIKE '%".$_REQUEST['productname']."%'";
			}
			if(!empty($_REQUEST['productcode'])){
				$mother .= " AND product_code LIKE '%".$_REQUEST['productcode']."%'";
                $child .= " AND product_con_entry_child_product_detail_code LIKE '%".$_REQUEST['productcode']."%'";
			}
			if(!empty($_REQUEST['category'])){
				$mother .= "AND product_product_category_id='".$_REQUEST['category']."'";
				$child .= "AND product_con_entry_child_product_detail_product_category_id='".$_REQUEST['category']."'";
			}
			if(!empty($_REQUEST['brandid'])){
				$where .= " AND brand_id='".$_REQUEST['brandid']."'";
		 	}
			
			$group_by = "GROUP BY stock_ledger_prd_type,stock_ledger_product_id,stock_ledger_colour_id,stock_ledger_thick_ness";
			if(isset($_REQUEST['warehouseid'])){
				$wh = implode(',', $_REQUEST['warehouseid']);	
				if($wh == 2) {
					$group_by = "GROUP BY stock_ledger_prd_type,stock_ledger_colour_id,stock_ledger_thick_ness, brand_id, stock_ledger_width_inches";
				}
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
						brand_name, brand_id, stock_ledger_colour_id,
						product_code,stock_ledger_entry_type,
						product_name,
						stock_ledger_width_inches as product_con_entry_child_product_detail_width_inches,
						stock_ledger_width_mm as product_con_entry_child_product_detail_width_mm,
						stock_ledger_thick_ness,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						product_colour_name,product_product_category_id
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
					$group_by";
		//echo $query;exit;
		 
		 $result = mysql_query($query);
		 
		 
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
						brand_name, brand_id, stock_ledger_colour_id,
						product_con_entry_child_product_detail_code as product_code,stock_ledger_entry_type,
						 product_con_entry_child_product_detail_name as product_name,
						stock_ledger_width_inches as product_con_entry_child_product_detail_width_inches,
						stock_ledger_width_mm as product_con_entry_child_product_detail_width_mm,
						stock_ledger_thick_ness,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						product_colour_name,product_con_entry_child_product_detail_product_category_id
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
					  $where $child AND stock_ledger_prd_type = '2' AND stock_ledger_mother_child_type=2
					$group_by";
	//	echo $query1;exit;
		 
		 $result1 = mysql_query($query1);
		 
		 
		 while($resultData1 = mysql_fetch_array($result1)){		 
			$response[]= $resultData1;
		 }
		 
		  $query2	= "SELECT 
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
						brand_name, brand_id, stock_ledger_colour_id,
						product_code,stock_ledger_entry_type,
						product_name,
						stock_ledger_width_inches as product_con_entry_child_product_detail_width_inches,
						stock_ledger_width_mm as product_con_entry_child_product_detail_width_mm,
						stock_ledger_thick_ness,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						product_colour_name
					FROM 
						stock_ledger
					LEFT JOIN 
						product_details 
					ON 
						product_detail_id												= stock_ledger_product_id
						
					LEFT JOIN 
						products 
					ON 
						product_id												= product_detail_raw_product_id		
				
					LEFT JOIN 
						product_uoms 
					ON 
						product_uom_id 											= product_product_uom_id
					LEFT JOIN 
						brands 
					ON 
						brand_id 												= product_brand_id
					LEFT JOIN 
						product_colours 
					ON 
						product_colour_id 										= product_product_colour_id
					WHERE
					  $where $mother AND stock_ledger_prd_type = '2' AND stock_ledger_mother_child_type=3
					$group_by";
		//echo $query2;exit;
		 
		 $result2 = mysql_query($query2);
		 
		 
		 while($resultData2 = mysql_fetch_array($result2)){		 
			$response[]= $resultData2;
		 }
		 
		//}
		/*else{
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
			if(!empty($_REQUEST['productname'])){
				$where .= " AND product_con_entry_child_product_detail_name LIKE '%".$_REQUEST['productname']."%'";
			}
			if(!empty($_REQUEST['productcode'])){
				$where .= " AND product_con_entry_child_product_detail_code LIKE '%".$_REQUEST['productcode']."%'";
			}
			if(!empty($_REQUEST['category'])){
				$where .= "AND product_con_entry_child_product_detail_product_category_id='".$_REQUEST['category']."'";
			}
			if(!empty($_REQUEST['type'])){
				$where .= "AND product_con_entry_child_product_detail_type='".$_REQUEST['type']."'";
			}
		 /* $query	= "SELECT 
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
						stock_ledger_prd_type,stock_ledger_product_id";	*/
					/*	$query="SELECT 
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
						product_uom_name,stock_ledger_entry_type,
						brand_name,
						product_code,
						product_name,
						stock_ledger_width_inches as product_con_entry_child_product_detail_width_inches,
						stock_ledger_width_mm as product_con_entry_child_product_detail_width_mm,
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
		 
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		}*/
		
	  }
	 elseif($_REQUEST['product_status']==3){
			if(!empty($_REQUEST['productname'])){
				$where .= " AND product_name LIKE '%".$_REQUEST['productname']."%'";
			}
			if(!empty($_REQUEST['productcode'])){
				$where .= " AND product_code LIKE '%".$_REQUEST['productcode']."%'";
			}
			
			if(!empty($_REQUEST['brandid'])){
				$where .= " AND product_brand_id = '".$_REQUEST['brandid']."'";
			}
			if(!empty($_REQUEST['category'])){
				$where .= "AND product_product_category_id	='".$_REQUEST['category']."'";
			}
			
			$group_by = "GROUP BY stock_ledger_prd_type,stock_ledger_product_id,stock_ledger_colour_id,stock_ledger_thick_ness,stock_ledger_length_feet";
			
			if(isset($_REQUEST['warehouseid'])){
				$wh = implode(',', $_REQUEST['warehouseid']);	
				if($wh == 2) {
					$group_by = "GROUP BY stock_ledger_prd_type,stock_ledger_colour_id,stock_ledger_thick_ness, brand_id, stock_ledger_width_inches,stock_ledger_length_feet";
				}
			} 
			
		$query	= "SELECT 
						stock_ledger_length_feet,
						stock_ledger_length_meter,
						stock_ledger_weight_tone,
						stock_ledger_weight_kg,
						sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity  ELSE NULL END)  as pur_qty,
						sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity  ELSE NULL END)  	as sal_qty,
						sum(stock_ledger_product_quantity) as closing_qty,
						product_uom_name,stock_ledger_entry_type,
						brand_name, brand_id, stock_ledger_colour_id,
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
					$group_by";
						/* stock_ledger_prd_type,stock_ledger_product_id,stock_ledger_colour_id,stock_ledger_thick_ness,stock_ledger_length_feet ORDER BY brand_id, stock_ledger_colour_id, stock_ledger_thick_ness, stock_ledger_width_inches";	 */
				//echo $query;exit;
		 $result = mysql_query($query) or die(mysql_error());
	
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
						brand_name, brand_id,
						product_code,
						product_name,
						stock_ledger_prd_type,
						stock_ledger_product_id,
						stock_ledger_product_feet_per_quantity,
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
		//echo $query;exit;
		 $result = mysql_query($query);
		
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
