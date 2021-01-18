<?php  

	
	
	

	function quotationtypeone()
	{
		$where = " WHERE prn_entry_product_detail_deleted_status =0 AND prn_entry_deleted_status = 0 AND prn_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
			$where .= " AND prn_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."'";	
		}
		if(isset($_REQUEST['search_entry_no']) && (!empty($_REQUEST['search_entry_no']))) {
			$where .= " AND prn_entry_no = '".dataValidation($_REQUEST['search_entry_no'])."'";
		}
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND prn_entry_branch_id = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		if(isset($_REQUEST['search_supplier_id']) && (!empty($_REQUEST['search_supplier_id']))) {
			$where .= " AND prn_entry_production_section_id = '".dataValidation($_REQUEST['search_supplier_id'])."'";
		}
		if(isset($_REQUEST['search_color_id']) && (!empty($_REQUEST['search_color_id']))) {
			$where .= " AND prn_entry_product_detail_product_colour_id = '".dataValidation($_REQUEST['search_color_id'])."'";
		}
		if(isset($_REQUEST['search_thick_id']) && (!empty($_REQUEST['search_thick_id']))) {
			$where .= " AND prn_entry_product_detail_product_thick = '".dataValidation($_REQUEST['search_thick_id'])."'";
		}
		if(isset($_REQUEST['search_prodcut_id']) && (!empty($_REQUEST['search_prodcut_id']))) {
			$where .= " AND prn_entry_product_detail_product_id = '".dataValidation($_REQUEST['search_prodcut_id'])."'";
		}
		if(isset($_REQUEST['search_product_type']) && (!empty($_REQUEST['search_product_type']))) {
			$where .= " AND prn_entry_type_id = '".dataValidation($_REQUEST['search_product_type'])."'";
		}        
		 $select_invoice_entry = "SELECT 
										prn_entry_no,
										prn_entry_date,
										brand_name,
										product_colour_name,
										prn_entry_product_detail_product_thick,
										prn_entry_product_detail_s_width_inches,
										prn_entry_product_detail_s_width_mm,
										prn_entry_product_detail_sl_feet,
										prn_entry_product_detail_sl_feet_mm,
										prn_entry_product_detail_s_weight_inches,
										prn_entry_product_detail_s_weight_mm,
										prn_entry_product_detail_qty,
										product_code,
										product_name,prn_entry_type_id,
										production_entry_no,
										production_entry_date
								  FROM  prn_entry_product_details
								  LEFT JOIN prn_entry ON prn_entry_id = prn_entry_product_detail_prn_entry_id
								  LEFT JOIN production_entry ON production_entry_id = prn_entry_product_detail_prn_entry_id
								  LEFT JOIN 
								  		products 
								  ON 
								  		product_id 				= prn_entry_product_detail_product_id
								  LEFT JOIN brands ON brand_id = product_brand_id
								  LEFT JOIN product_uoms ON product_uom_id = product_purchase_uom_id
								  LEFT JOIN product_colours ON product_colour_id =  prn_entry_product_detail_product_colour_id
								  $where
								  ORDER BY prn_entry_no ASC";
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
?>