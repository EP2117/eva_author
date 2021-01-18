<?php  

	
	
	

	function quotationtypeone()
	{
		$where = " WHERE invoice_entry_deleted_status =0 AND invoice_entry_direct_type =2  AND invoice_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND invoice_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
		
			$where .= " AND invoice_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."'";	
			
		}
		
		if(isset($_REQUEST['search_entry_no']) && (!empty($_REQUEST['search_entry_no']))) {
			$where .= " AND invoice_entry_no = '".dataValidation($_REQUEST['search_entry_no'])."'";
		}
		
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND invoice_entry_branch_id = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		if(isset($_REQUEST['search_customer_id']) && (!empty($_REQUEST['search_customer_id']))) {
			$where .= " AND invoice_entry_customer_id = '".dataValidation($_REQUEST['search_customer_id'])."'";
		}
		if(isset($_REQUEST['search_color_id']) && (!empty($_REQUEST['search_color_id']))) {
			$where .= " AND invoice_entry_product_detail_color_id = '".dataValidation($_REQUEST['search_color_id'])."'";
		}
		
		if(isset($_REQUEST['search_thick_id']) && (!empty($_REQUEST['search_thick_id']))) {
			$where .= " AND invoice_entry_product_detail_product_thick = '".dataValidation($_REQUEST['search_thick_id'])."'";
		}
		
		if(isset($_REQUEST['search_state_id']) && (!empty($_REQUEST['search_state_id']))) {
			$where .= " AND customer_state_id = '".dataValidation($_REQUEST['search_state_id'])."'";
		}
		
		
		if(isset($_REQUEST['search_township_id']) && (!empty($_REQUEST['search_township_id']))) {
			$where .= " AND customer_city_id = '".dataValidation($_REQUEST['search_township_id'])."'";
		}
		if(isset($_REQUEST['search_township_id']) && (!empty($_REQUEST['search_township_id']))) {
			$where .= " AND customer_city_id = '".dataValidation($_REQUEST['search_township_id'])."'";
		}
		if(isset($_REQUEST['search_prodcut_id']) && (!empty($_REQUEST['search_prodcut_id']))) {
			$where .= " AND invoice_entry_product_detail_product_id = '".dataValidation($_REQUEST['search_prodcut_id'])."'";
		}
		if(isset($_REQUEST['search_raw']) && (!empty($_REQUEST['search_raw']))) {
			$arr_search_raw =implode(',',$_REQUEST['search_raw']);
			$where .= " AND product_type IN( ".$arr_search_raw.")";
			
		}
		
		
		
		
		       $select_invoice_entry = "SELECT invoice_entry_id,product_type, invoice_entry_uniq_id, invoice_entry_no, 
								  invoice_entry_date, invoice_entry_net_amount,
								  salesman_name,customer_name, customer_code,product_name,
								  customer_code,brand_name,	product_colour_name,invoice_entry_product_detail_product_thick,
								  invoice_entry_product_detail_width_inches,invoice_entry_product_detail_width_mm,
								  invoice_entry_product_detail_s_width_inches,invoice_entry_product_detail_s_width_mm,
								  invoice_entry_product_detail_sl_feet,invoice_entry_product_detail_sl_feet_mm,
								  invoice_entry_product_detail_sl_feet_in,invoice_entry_product_detail_sl_feet_met,
								  invoice_entry_product_detail_rate,invoice_entry_product_detail_total,
								  invoice_entry_product_detail_tot_length,invoice_entry_product_detail_qty,
								  invoice_entry_product_detail_product_id,invoice_entry_product_detail_s_weight_mm,
								  invoice_entry_product_detail_s_weight_inches, invoice_entry_product_detail_s_weight_met, product_uom_name
								  FROM invoice_entry_product_details 
								  LEFT JOIN invoice_entry ON invoice_entry_product_detail_invoice_entry_id = invoice_entry_id
								  LEFT JOIN products ON product_id = invoice_entry_product_detail_product_id
								  LEFT JOIN brands ON brand_id = product_brand_id
								  LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id
								  LEFT JOIN product_colours ON product_colour_id =  invoice_entry_product_detail_color_id
								  LEFT JOIN customers ON customer_id = invoice_entry_customer_id
								  LEFT JOIN salesmans ON salesman_id = invoice_entry_salesman_id
								  LEFT JOIN cities ON city_id = customer_city_id
								  $where
								  ORDER BY invoice_entry_product_detail_product_id ASC";
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
