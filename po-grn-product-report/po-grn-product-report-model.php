<?php  

	
	
	

	function quotationtypeone()
	{
		$where = " WHERE grn_child_product_detail_deleted_status =0 AND pI_deleted_status = 0 AND pI_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
			$where .= " AND pI_invoice_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."'";	
		}
		if(isset($_REQUEST['search_entry_no']) && (!empty($_REQUEST['search_entry_no']))) {
			$where .= " AND invoiceNo = '".dataValidation($_REQUEST['search_entry_no'])."'";
		}
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND pI_branchid = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		if(isset($_REQUEST['search_supplier_id']) && (!empty($_REQUEST['search_supplier_id']))) {
			$where .= " AND pR_supplier_id = '".dataValidation($_REQUEST['search_supplier_id'])."'";
		}
		if(isset($_REQUEST['search_color_id']) && (!empty($_REQUEST['search_color_id']))) {
			$where .= " AND product_con_entry_child_product_detail_color_id = '".dataValidation($_REQUEST['search_color_id'])."'";
		}
		if(isset($_REQUEST['search_thick_id']) && (!empty($_REQUEST['search_thick_id']))) {
			$where .= " AND product_con_entry_child_product_detail_thick_ness = '".dataValidation($_REQUEST['search_thick_id'])."'";
		}
		if(isset($_REQUEST['search_prodcut_id']) && (!empty($_REQUEST['search_prodcut_id']))) {
			$where .= " AND grn_child_product_detail_product_id = '".dataValidation($_REQUEST['search_prodcut_id'])."'";
		}
		         $select_invoice_entry = "SELECT 
				 								grnId,
												grn_date,
												supplier_name,
												brand_name,
												product_colour_name,
												product_con_entry_child_product_detail_thick_ness,
												grn_child_product_detail_width_inches,
												grn_child_product_detail_width_mm,
												grn_child_product_detail_length_feet,
												grn_child_product_detail_length_mm,
												grn_child_product_detail_ton_qty,
												grn_child_product_detail_kg_qty,
												product_con_entry_child_product_detail_code,
												product_con_entry_child_product_detail_name
								  FROM  grn_child_product_details
								  LEFT JOIN grn_details ON grnId = grn_child_product_detail_grn_id
								  LEFT JOIN purchase_invoice ON invoiceId = grn_purchaseId
								  LEFT JOIN purchase_order ON purchaseId = pI_purchaseId
								  LEFT JOIN 
								  		product_con_entry_child_product_details 
								  ON 
								  		product_con_entry_child_product_detail_id = grn_child_product_detail_product_id
								  LEFT JOIN brands ON brand_id = product_con_entry_child_product_detail_product_brand_id
								  LEFT JOIN product_uoms ON product_uom_id = product_con_entry_child_product_detail_uom_id
								  LEFT JOIN product_colours ON product_colour_id =  product_con_entry_child_product_detail_color_id
								  LEFT JOIN suppliers ON supplier_id = pR_supplier_id
								  $where
								  ORDER BY invoiceNo ASC";
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
