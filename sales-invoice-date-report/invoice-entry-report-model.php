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
	

	function quotationReport()
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
		if(isset($_REQUEST['search_sales_man_id']) && (!empty($_REQUEST['search_sales_man_id']))) {
			$where .= " AND invoice_entry_salesman_id = '".dataValidation($_REQUEST['search_sales_man_id'])."'";
		}
		
		 $select_invoice_entry = "SELECT invoice_entry_id, invoice_entry_uniq_id, invoice_entry_no, 
								  invoice_entry_date, invoice_entry_total_amount,
								  salesman_name,customer_name, customer_code,
								  customer_code
								  FROM invoice_entry
								  LEFT JOIN customers ON customer_id = invoice_entry_customer_id
								  LEFT JOIN salesmans ON salesman_id = invoice_entry_salesman_id
								  LEFT JOIN cities ON city_id = customer_city_id
								  $where
								  ORDER BY invoice_entry_date ASC, invoice_entry_no ASC";
		$result_invoice_entry = mysql_query($select_invoice_entry);
		$count_invoice_entry  = mysql_num_rows($result_invoice_entry);
		$arr_invoice_entry    = array();
		while($record_invoice_entry = mysql_fetch_array($result_invoice_entry)) {
			
			$arr_invoice_entry[] = $record_invoice_entry;
		}
		
		return $arr_invoice_entry;
			
		
	}
	
   

?>
