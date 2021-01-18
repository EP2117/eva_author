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
		$where = " ";
		
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
		
  $select_invoice		=	"SELECT 

										invoice_entry_id,

										invoice_entry_uniq_id,

										invoice_entry_no,

										invoice_entry_date,

										customer_name,

										customer_code,invoice_entry_advance_amount,
										invoice_entry_net_amount,credit_note_entry_type,

										invoice_entry_total_amount,credit_note_entry_product_detail_invoice_entry_id, 
										SUM(credit_note_entry_product_detail_total) AS detail_total ,
										invoice_entry_customer_id,SUM(rcv_table.rcv_amount)AS amount,SUM(rcv_table.disc_amount)AS disc_amount

									 FROM 

										invoice_entry

									 LEFT JOIN

										customers

									 ON

										customer_id												= invoice_entry_customer_id
										
										LEFT JOIN 
										
											credit_note_entry_product_details  	
										ON
										credit_note_entry_product_detail_invoice_entry_id 				= invoice_entry_id		
										
										LEFT JOIN credit_note_entry ON credit_note_entry_product_detail_credit_note_entry_id = credit_note_entry_id 

									LEFT JOIN 

										(SELECT 
											collection_entry_detail_invoice_entry_id, 
											SUM(collection_entry_detail_amount) AS rcv_amount ,sum(collection_entry_detail_disc_amount) as disc_amount

										FROM 
											collection_entry_details  	
										WHERE 
											collection_entry_detail_deleted_status 				= 0  					
										GROUP BY 
											collection_entry_detail_invoice_entry_id) rcv_table 
									ON 
										collection_entry_detail_invoice_entry_id 				= invoice_entry_id								 
									 WHERE 
										invoice_entry_deleted_status 							= 	0 															AND
										IFNULL(rcv_table.rcv_amount,0) 							< invoice_entry_net_amount										AND
										invoice_entry_financial_year 							= '".$_SESSION[SESS.'_session_financial_year']."'				AND
										invoice_entry_company_id 								= '".$_SESSION[SESS.'_session_company_id']."' $where	
																		
									GROUP BY
										invoice_entry_id
								 ORDER BY 
										invoice_entry_no ASC";//exit;
        //echo $select_invoice;exit;
		$result_invoice_entry = mysql_query($select_invoice);
		$count_invoice_entry  = mysql_num_rows($result_invoice_entry);
		$arr_invoice_entry    = array();
		while($record_invoice_entry = mysql_fetch_array($result_invoice_entry)) {
			
			$arr_invoice_entry[] = $record_invoice_entry;
		}
		
		return $arr_invoice_entry;
			
		
	}
	
   

?>
