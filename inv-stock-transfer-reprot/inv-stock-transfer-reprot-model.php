<?php  

	
	
	

	function quotationtypeone()
	{
		$where = " WHERE stock_transfer_deleted_status =0 AND stock_transfer_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND stock_transfer_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
		
			$where .= " AND stock_transfer_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."'";	
			
		}
		
		if(isset($_REQUEST['search_entry_no']) && (!empty($_REQUEST['search_entry_no']))) {
			$where .= " AND stock_transfer_no = '".dataValidation($_REQUEST['search_entry_no'])."'";
		}
		
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND stock_transfer_branch_id = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		
		if(isset($_REQUEST['search_color_id']) && (!empty($_REQUEST['search_color_id']))) {
			$where .= " AND stock_transfer_product_detail_product_color_id = '".dataValidation($_REQUEST['search_color_id'])."'";
		}
		
		if(isset($_REQUEST['search_thick_id']) && (!empty($_REQUEST['search_thick_id']))) {
			$where .= " AND stock_transfer_product_detail_product_thick = '".dataValidation($_REQUEST['search_thick_id'])."'";
		}
		if(isset($_REQUEST['search_product_id']) && (!empty($_REQUEST['search_product_id']))) {
			$where .= " AND stock_transfer_product_detail_product_id = '".dataValidation($_REQUEST['search_product_id'])."'";
		}
		
		if(isset($_REQUEST['search_width']) && (!empty($_REQUEST['search_width']))) {
			$where .= " AND stock_transfer_product_detail_width_inches = '".dataValidation($_REQUEST['search_width'])."'";
		}
		
		
		if(isset($_REQUEST['search_to_godown_id']) && (!empty($_REQUEST['search_to_godown_id']))) {
			$where .= " AND stock_transfer_to_godown_id = '".dataValidation($_REQUEST['search_to_godown_id'])."'";
		}
		if(isset($_REQUEST['search_from_godown_id']) && (!empty($_REQUEST['search_from_godown_id']))) {
			$where .= " AND stock_transfer_from_godown_id = '".dataValidation($_REQUEST['search_from_godown_id'])."'";
		}
		
		if(isset($_REQUEST['search_production_no']) && (!empty($_REQUEST['search_production_no']))) {
			$where .= " AND production_order_no = '".dataValidation($_REQUEST['search_production_no'])."'";
		}
		if(isset($_REQUEST['search_production_type']) && (!empty($_REQUEST['search_production_type']))) {
			$where .= " AND production_order_type = '".dataValidation($_REQUEST['search_production_type'])."'";
		}
		              $select_invoice_entry = "SELECT stock_transfer_id,product_type,stock_transfer_uniq_id, stock_transfer_no, 
								  stock_transfer_date,	stock_transfer_from_godown_id,stock_transfer_to_godown_id ,
								  product_name,product_code,stock_transfer_branch_id,
								  brand_name,product_colour_name,product_uom_name,
								  stock_transfer_product_detail_product_thick,stock_transfer_product_detail_product_id,
								  stock_transfer_product_detail_width_inches,stock_transfer_product_detail_width_mm,
								  stock_transfer_product_detail_length_feet,stock_transfer_product_detail_length_meter,
								  stock_transfer_product_detail_weight_tone,stock_transfer_product_detail_weight_kg,
								  stock_transfer_product_detail_qty,production_order_no	,production_order_date
								  FROM  stock_transfer_product_details 
								  LEFT JOIN stock_transfer ON stock_transfer_id = stock_transfer_product_detail_stock_transfer_id
								  LEFT JOIN production_order ON production_order_id	 = stock_transfer_product_detail_po_entry_id
								  LEFT JOIN products ON product_id = stock_transfer_product_detail_product_id
								  LEFT JOIN brands ON brand_id = product_brand_id
								  LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id
								  LEFT JOIN product_colours ON product_colour_id =  stock_transfer_product_detail_product_color_id
								  $where
								  ORDER BY stock_transfer_product_detail_product_id,stock_transfer_date ASC";
								// echo $select_invoice_entry;exit; 
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
