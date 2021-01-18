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
		$where = " stock_ledger_status =0 AND stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND stock_ledger_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
			$where .= " AND stock_ledger_date BETWEEN '".dateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".dateDatabaseFormat($_REQUEST['search_to_date'])."'";	
		}
		if(isset($_REQUEST['search_product_name']) && (!empty($_REQUEST['search_product_name']))) {
			$where .= " AND product_name = '".dataValidation($_REQUEST['search_product_name'])."'";
		}
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND stock_ledger_branch_id = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		if(isset($_REQUEST['search_godown_id']) && (!empty($_REQUEST['search_godown_id']))) {
			$where .= " AND stock_ledger_godown_id = '".dataValidation($_REQUEST['search_godown_id'])."'";
		}
		 $select_dc_entry	= "SELECT 
									product_id ,
									product_code, 
									product_name,
									product_cost_price,
									brand_name,
									sum(CASE  WHEN stock_ledger_type = 'in' THEN stock_ledger_product_quantity  ELSE NULL END)  as pur_qty,
									sum(CASE  WHEN stock_ledger_type = 'out' THEN stock_ledger_product_quantity  ELSE NULL END)  as sal_qty,
									stock_ledger_prd_type
								FROM 
									stock_ledger
								JOIN 
									products 
								ON 
									product_id = stock_ledger_product_id
								LEFT JOIN 
									brands 
								ON 
									product_brand_id = brand_id
								WHERE
								  $where
								GROUP BY stock_ledger_prd_type,product_id";			  
		$result_dc_entry = mysql_query($select_dc_entry);
		$count_dc_entry  = mysql_num_rows($result_dc_entry);
		$arr_dc_entry 	 = array();
			while($record_dc_entry = mysql_fetch_array($result_dc_entry)) {
				$arr_dc_entry[] = $record_dc_entry;
			}
		return 	$arr_dc_entry;	
	}
	function stock_opening($product_stock_from_date,$product_id,$stock_ledger_prd_type){
		$select_opening	= " SELECT 
								stock_ledger_product_id, 
								SUM(stock_ledger_product_quantity) AS open_qty 
							 FROM 
								stock_ledger
							WHERE 
								stock_ledger_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' 					AND  	
								stock_ledger_status 		= 0																	AND
								stock_ledger_company_id 	= '".$_SESSION[SESS.'_session_company_id']."' 						AND
								stock_ledger_date			<	'".dateDatabaseFormat($product_stock_from_date)."'				AND
								stock_ledger_product_id		= '".$product_id."'
								stock_ledger_prd_type		= '".$stock_ledger_prd_type."'
							GROUP BY 
								stock_ledger_product_id";
			$result_dc_entry = mysql_query($select_opening);
			$count_dc_entry  = mysql_num_rows($result_dc_entry);
			$record_dc_entry = mysql_fetch_array($result_dc_entry);
			return $record_dc_entry['open_qty'];
	}
   

?>
