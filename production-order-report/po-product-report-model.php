<?php  
	function quotationtypeone()
	{
		$where = " WHERE production_order_deleted_status =0 AND production_order_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";
		
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
		
			$where .= " AND production_order_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."'";	
			
		}
		
		if(isset($_REQUEST['search_entry_no']) && (!empty($_REQUEST['search_entry_no']))) {
			$where .= " AND production_order_no = '".dataValidation($_REQUEST['search_entry_no'])."'";
		}
		
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND production_order_branch_id = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		if(isset($_REQUEST['search_customer_id']) && (!empty($_REQUEST['search_customer_id']))) {
			$where .= " AND production_order_customer_id = '".dataValidation($_REQUEST['search_customer_id'])."'";
		}
		if(isset($_REQUEST['production_order_type']) && (!empty($_REQUEST['production_order_type']))) {
			$where .= " AND product_type = '".dataValidation($_REQUEST['production_order_type'])."'";
		}
		
		
		
		
		
		
		        $select_invoice_entry = "SELECT 
				 							production_order_id,branch_name,production_order_date,
											production_order_no,customer_name,product_name,product_type,production_entry_product_detail_grn_detail_id,
											production_order_product_detail_qty,IFNULL(production_entry_product_detail_qty,0) AS production_entry_product_detail_qty
											FROM production_order_product_details
											LEFT JOIN production_order ON production_order_id = production_order_product_detail_production_order_id
											LEFT JOIN gin_entry_product_details ON production_order_product_detail_id = gin_entry_product_detail_po_detail_id
											
											LEFT JOIN  grn_entry_product_details ON gin_entry_product_detail_id = grn_entry_product_detail_gin_detail_id
											LEFT JOIN  production_entry_product_details ON grn_entry_product_detail_id = production_entry_product_detail_grn_detail_id
											LEFT JOIN branches ON production_order_branch_id = branch_id
											LEFT JOIN products ON product_id = production_order_product_detail_product_id
										    LEFT JOIN customers ON production_order_customer_id = customer_id
											
								  $where
								  ORDER BY production_order_no ASC";
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
?>
