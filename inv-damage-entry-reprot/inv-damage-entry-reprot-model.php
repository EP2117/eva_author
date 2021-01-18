<?php  

	
	
	

	function quotationtypeone()
	{
		$where = " WHERE damage_entry_deleted_status =0 AND damage_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND damage_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
		
			$where .= " AND damage_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."'";	
			
		}
		
		if(isset($_REQUEST['search_entry_no']) && (!empty($_REQUEST['search_entry_no']))) {
			$where .= " AND damage_entry_no = '".dataValidation($_REQUEST['search_entry_no'])."'";
		}
		
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND damage_entry_branch_id = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		
		if(isset($_REQUEST['search_color_id']) && (!empty($_REQUEST['search_color_id']))) {
			$where .= " AND damage_entry_product_detail_product_color_id = '".dataValidation($_REQUEST['search_color_id'])."'";
		}
		
		if(isset($_REQUEST['search_thick_id']) && (!empty($_REQUEST['search_thick_id']))) {
			$where .= " AND damage_entry_product_detail_product_thick = '".dataValidation($_REQUEST['search_thick_id'])."'";
		}
		if(isset($_REQUEST['search_product_id']) && (!empty($_REQUEST['search_product_id']))) {
			$where .= " AND damage_entry_product_detail_product_id = '".dataValidation($_REQUEST['search_product_id'])."'";
		}
		
		if(isset($_REQUEST['search_width']) && (!empty($_REQUEST['search_width']))) {
			$where .= " AND damage_entry_product_detail_width_inches = '".dataValidation($_REQUEST['search_width'])."'";
		}
		
		
		if(isset($_REQUEST['search_godown_id']) && (!empty($_REQUEST['search_godown_id']))) {
			$where .= " AND damage_entry_godown_id = '".dataValidation($_REQUEST['search_godown_id'])."'";
		}
		
		                $select_invoice_entry = "SELECT 
														damage_entry_product_detail_id,
														damage_entry_product_detail_product_id,
														damage_entry_product_detail_width_inches,damage_entry_product_detail_width_mm,
														
														damage_entry_product_detail_length_mm,
														
														damage_entry_product_detail_po_detail_id,damage_entry_product_detail_qty,
														damage_entry_product_detail_product_thick,
														product_name,damage_entry_no,damage_entry_date,
														product_code,damage_entry_type_id,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														product_con_entry_osf_uom_ton,
														p_uom.product_uom_name as p_uom_name,
														child_uom.product_uom_name as c_uom_name,
														p_clr.product_colour_name as p_colour_name,
														c_clr.product_colour_name as c_colour_name,
														damage_entry_product_detail_product_type,
														damage_entry_product_detail_length_feet,
														damage_entry_product_detail_weight_tone,
														damage_entry_product_detail_weight_kg,
														c_bnd.brand_name as  c_brand_name,
														p_bnd.brand_name as  p_brand_name
													FROM 
														damage_entry_product_details 
													LEFT JOIN 
														damage_entry 
													ON 
														damage_entry_id 		= damage_entry_product_detail_damage_entry_id
													LEFT JOIN 
														products 
													ON 
														product_id 				= damage_entry_product_detail_product_id
													LEFT JOIN 
														brands AS p_bnd 
													ON 
														p_bnd.brand_id 			= product_brand_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id		= damage_entry_product_detail_product_id
													LEFT JOIN 
															brands AS c_bnd
													 ON 
															c_bnd.brand_id 											= product_con_entry_child_product_detail_product_brand_id		
													LEFT JOIN 
														product_uoms as p_uom
													ON 
														p_uom.product_uom_id 									= product_product_uom_id
													LEFT JOIN 
														product_uoms as  child_uom
													ON 
														child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
													LEFT JOIN 
														product_colours as p_clr 
													ON 
														p_clr.product_colour_id 								= product_con_entry_child_product_detail_color_id
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= product_con_entry_child_product_detail_color_id
														
												
								  $where
								  ORDER BY damage_entry_product_detail_product_id,damage_entry_date ASC";
							//echo $select_invoice_entry;exit;	  
		$result_invoice_entry = mysql_query($select_invoice_entry);
		$count_invoice_entry  = mysql_num_rows($result_invoice_entry);
		$arr_invoice_entry    = array();
		while($record_invoice_entry = mysql_fetch_array($result_invoice_entry)) {
			
			$arr_invoice_entry[] = $record_invoice_entry;
		}
		
		return $arr_invoice_entry;
			
		
	}
	
	
	function listBranch()
{
	$select_branch = "SELECT branch_id, branch_name FROM branches WHERE branch_active_status ='active'  AND branch_deleted_status =0 ORDER BY branch_name ASC";
	$result_branch = mysql_query($select_branch);
	$arr_branch    = array();
	
	while($record_branch = mysql_fetch_array($result_branch)) {
		$arr_branch[] = $record_branch;
	}
	
	return $arr_branch;
}
function listsalesman()
{
	$select_salesman = "SELECT salesman_id, salesman_name,salesman_contact_number FROM salesmans WHERE salesman_active_status ='active'  AND salesman_deleted_status =0
						AND salesman_company_id = '".$_SESSION[SESS.'_session_company_id']."' ORDER BY salesman_name ASC";
	$result_salesman = mysql_query($select_salesman);
	$arr_salesman    = array();
	while($record_salesman = mysql_fetch_array($result_salesman)) {
		$arr_salesman[] = $record_salesman;
	}
	return $arr_salesman;
}

	function listCustomer()
	{
		$select_customer = "SELECT customer_id, customer_code, customer_name, city_name
							FROM customers 
							LEFT JOIN cities ON city_id = customer_city_id
							WHERE customer_active_status = 'active' 
							AND  customer_deleted_status =0 
							AND customer_company_id = '".$_SESSION[SESS.'_session_company_id']."'  ORDER BY customer_name ASC";
		$result_customer = mysql_query($select_customer);
		$arr_customer    = array();
		
		while($record_customer = mysql_fetch_array($result_customer)) {
			$arr_customer[] = $record_customer;
		}
		
		return $arr_customer;
	}
	
  
	 function listColor()
	{
		$select_color = "SELECT product_colour_id,product_colour_name
							FROM product_colours 
							
							WHERE product_colour_active_status = 'active' 
							AND  product_colour_deleted_status =0 
							ORDER BY product_colour_name ASC";
		$result_color = mysql_query($select_color);
		$arr_color    = array();
		
		while($record_color = mysql_fetch_array($result_color)) {
			$arr_color[] = $record_color;
		}
		
		return $arr_color;
	}
	
	 function listBrand()
	{
		$select_color = "SELECT brand_id,brand_name
							FROM  brands 
							
							WHERE brand_active_status = 'active' 
							AND  brand_deleted_status =0 
							ORDER BY brand_name ASC";
		$result_color = mysql_query($select_color);
		$arr_color    = array();
		
		while($record_color = mysql_fetch_array($result_color)) {
			$arr_color[] = $record_color;
		}
		
		return $arr_color;
	}
	
	 function listProduct()
	{
		$select_color = "SELECT product_id,product_name
							FROM  products 
							
							WHERE product_active_status = 'active' 
							AND  product_deleted_status =0 
							ORDER BY product_name ASC";
		$result_color = mysql_query($select_color);
		$arr_color    = array();
		
		while($record_color = mysql_fetch_array($result_color)) {
			$arr_color[] = $record_color;
		}
		
		return $arr_color;
	}
	function listState()
		{
			$select_color = "SELECT state_id,state_name
								FROM  states 
								
								WHERE state_active_status = 'active' 
								AND  state_deleted_status	 =0 
								ORDER BY state_name ASC";
			$result_color = mysql_query($select_color);
			$arr_color    = array();
			
			while($record_color = mysql_fetch_array($result_color)) {
				$arr_color[] = $record_color;
			}
			
			return $arr_color;
		}
	function listwarehouse()
		{
			$select_color = "SELECT godown_id,godown_name
								FROM  godowns 
								
								WHERE godown_active_status = 'active' 
								AND  godown_deleted_status	 =0 
								ORDER BY godown_name ASC";
			$result_color = mysql_query($select_color);
			$arr_color    = array();
			
			while($record_color = mysql_fetch_array($result_color)) {
				$arr_color[] = $record_color;
			}
			
			return $arr_color;
		}
?>
