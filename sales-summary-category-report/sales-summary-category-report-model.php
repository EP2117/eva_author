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

	function listcat()
	{
		$select_customer = "SELECT product_category_name,product_category_id
							FROM product_categories 
							WHERE product_category_deleted_status =0 
							ORDER BY product_category_id ASC";
		$result_customer = mysql_query($select_customer);
		$arr_customer    = array();
		
		while($record_customer = mysql_fetch_array($result_customer)) {
			$arr_customer[] = $record_customer;
		}
		
		return $arr_customer;
	}
	

	function quotationReport()
	{
		$where = " WHERE invoice_entry_deleted_status =0 AND invoice_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND invoice_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		
		if(isset($_REQUEST['search_category_id'])){
		$wh = implode(',', $_REQUEST['search_category_id']);
		//echo $wh;exit;
			$where .= " AND product_category_id IN (".$wh.") ";
		}
		
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
		
			$where .= " AND invoice_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."'";	
			
		}
		
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND invoice_entry_branch_id = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		
		if(isset($_REQUEST['search_type_id']) && (!empty($_REQUEST['search_type_id']))) {
			
			$where .= " AND invoice_entry_direct_type = '".$_REQUEST['search_type_id']."'";
		}
		
		   $select_invoice_entry = "SELECT invoice_entry_id, invoice_entry_no, invoice_entry_date, 
								  SUM(invoice_entry_net_amount)as invoice_entry_net_amount,branch_name,invoice_entry_branch_id,
								  customer_name, customer_code,invoice_entry_direct_type,product_category_name,
								  customer_code
								  FROM invoice_entry_product_details
								  LEFT JOIN  invoice_entry ON 
									invoice_entry_id 	= invoice_entry_product_detail_invoice_entry_id	
								LEFT JOIN  products ON 
									product_id 		= invoice_entry_product_detail_product_id			
								  LEFT JOIN  product_categories ON 
									product_category_id 		= product_product_category_id
								  LEFT JOIN customers ON customer_id = invoice_entry_customer_id
								  LEFT JOIN cities ON city_id = customer_city_id
								  LEFT JOIN branches ON branch_id = invoice_entry_branch_id
								  $where
								  GROUP BY invoice_entry_direct_type,product_category_id ASC";
								// echo $select_invoice_entry;exit;
		$result_invoice_entry = mysql_query($select_invoice_entry);
		$count_invoice_entry  = mysql_num_rows($result_invoice_entry);
		$arr_invoice_entry    = array();
		while($record_invoice_entry = mysql_fetch_array($result_invoice_entry)) {
			
			$arr_invoice_entry[] = $record_invoice_entry;
		}
		
		return $arr_invoice_entry;
			
		
	}
	
   

?>
