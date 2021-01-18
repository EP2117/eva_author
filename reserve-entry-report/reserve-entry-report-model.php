<?php  

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
function listcurrency()
{
	$select_currency = "SELECT currency_id, currency_name,currency_contact_number FROM currencys WHERE currency_active_status ='active'  AND currency_deleted_status =0
						AND currency_company_id = '".$_SESSION[SESS.'_session_company_id']."' ORDER BY currency_name ASC";
	$result_currency = mysql_query($select_currency);
	$arr_currency    = array();
	while($record_currency = mysql_fetch_array($result_currency)) {
		$arr_currency[] = $record_currency;
	}
	return $arr_currency;
}

	function listCustomer()
	{
		$select_supplier = "SELECT supplier_id, supplier_code, supplier_name, city_name
							FROM suppliers 
							LEFT JOIN cities ON city_id = supplier_city_id
							WHERE supplier_active_status = 'active' 
							AND  supplier_deleted_status =0 
							AND supplier_company_id = '".$_SESSION[SESS.'_session_company_id']."'  ORDER BY supplier_name ASC";
		$result_supplier = mysql_query($select_supplier);
		$arr_supplier    = array();
		
		while($record_supplier = mysql_fetch_array($result_supplier)) {
			$arr_supplier[] = $record_supplier;
		}
		
		return $arr_supplier;
	}
	

	function reserveReport()
	{
		
	
		$where = " WHERE reserve_entry_deleted_status  =0 AND reserve_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND reserve_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
		
			$where .= " AND reserve_entry_date BETWEEN '".dateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".dateDatabaseFormat($_REQUEST['search_to_date'])."'";	
			
		}
		
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND reserve_entry_product_detail_branch_id	 = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		if(isset($_REQUEST['search_warehouse_id']) && (!empty($_REQUEST['search_warehouse_id']))) {
			$where .= " AND reserve_entry_godown_id = '".dataValidation($_REQUEST['search_warehouse_id'])."'";
		}
		if(isset($_REQUEST['search_product_id']) && (!empty($_REQUEST['search_product_id']))) {
			$where .= " AND reserve_entry_product_detail_product_id = '".dataValidation($_REQUEST['search_product_id'])."'";
		}
		if(isset($_REQUEST['search_brand_id']) && (!empty($_REQUEST['search_brand_id']))) {
			$where .= " AND product_brand_id = '".dataValidation($_REQUEST['search_brand_id'])."'";
		}
								  
		$select_reserve	 		= "SELECT  	reserve_entry_id,
											reserve_entry_uniq_id,
											reserve_entry_no,
											reserve_entry_date,
											reserve_entry_from_date,
											reserve_entry_to_date,											
											godown_name,
											product_code, product_name,
											brand_name,
											product_uom_name,
											reserve_entry_product_detail_qty,
											customer_code, customer_name											
											
								  		FROM 
											reserve_entry
										LEFT JOIN reserve_entry_product_details ON reserve_entry_product_detail_reserve_entry_id = reserve_entry_id											
										LEFT JOIN godowns ON godown_id       		= reserve_entry_godown_id
										LEFT JOIN products ON product_id 		    = reserve_entry_product_detail_product_id
										LEFT JOIN brands ON brand_id 			    = product_brand_id									
										LEFT JOIN product_uoms ON  product_uom_id 	= product_uom_one_id
										LEFT JOIN salesmodes ON salesmode_id		= reserve_entry_product_detail_mode
										LEFT JOIN customers ON customer_id			= reserve_entry_product_detail_customer_id									
									
									 $where
									  
									 ORDER BY 
												reserve_entry_id, reserve_entry_no ASC";
																			  
		$result_reserve = mysql_query($select_reserve);
		$count_reserve  = mysql_num_rows($result_reserve);
		$arr_reserve    = array();
		while($record_reserve = mysql_fetch_array($result_reserve)) {
			
			$arr_reserve[] = $record_reserve;
		}
		
		return $arr_reserve;
			
		
	}
	
   

?>
