<?php  
	function quotationtypeone()
	{
		$where = " ";
		
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
		
		if(isset($_REQUEST['search_prodcut_id']) && (!empty($_REQUEST['search_prodcut_id']))) {
			$where .= " AND pRp_product_id = '".dataValidation($_REQUEST['search_prodcut_id'])."'";
		}
		if(isset($_REQUEST['search_prodcut_id']) && (!empty($_REQUEST['search_prodcut_id']))) {
			$where .= " AND pRp_product_id = '".dataValidation($_REQUEST['search_prodcut_id'])."'";
		}
		if(isset($_REQUEST['search_brand_id']) && (!empty($_REQUEST['search_brand_id']))) {
			$where .= " AND product_brand_id = '".dataValidation($_REQUEST['search_brand_id'])."'";
		}
		
		
		
 		   $select_invoice_entry	= "	SELECT 
											invoiceNo,
											pI_invoice_date,
											supplier_name,
											pI_net_total_amt,
											pI_net_total,
											pR_advanceAmnt,
											pR_advance_amount,
											rcv_amount,
											rcv_amount_cur,
											dn_rcv_amount,
											dn_rcv_amount_cur,
											pR_supplier_id,
											dnp_rcv_amount,pR_currency_id, 
											dnp_rcv_amount_cur,
											pI_invoicetotal,
											pI_cashdiscount_amt,
											pI_cashdiscount
										FROM 
											purchase_invoice  a
										LEFT JOIN 
											(SELECT 
												pi_invoiceId, 
												SUM(pi_amount+pi_descount_amt) AS rcv_amount,
												SUM(pi_amount_cur) AS rcv_amount_cur
											FROM 
												purchase_payment_details  	
											WHERE 
												pi_deleted_status 				= 0  					
											GROUP BY 
												pi_invoiceId) rcv_table 
										ON 
											pi_invoiceId 							= invoiceId
										LEFT JOIN 
											(SELECT 
												dn_entry_invoice_id, 
												SUM(dne_child_detail_amount) AS dn_rcv_amount,
												SUM(dne_child_detail_amount_cur) AS dn_rcv_amount_cur
											FROM 
												dn_entry_child_details
											LEFT JOIN
												 dn_entry
											ON
												 dn_entry_id									= dne_child_detail_dn_entry_id 	
											WHERE 
												dne_child_detail_deleted_status 				= 0  					
											GROUP BY 
												dn_entry_invoice_id) dn_table 
										ON 
											dn_entry_invoice_id 								= invoiceId	
										LEFT JOIN 
											(SELECT 
												dn_entry_product_detail_invoice_id, 
												SUM(dn_entry_product_detail_tot_amount) AS dnp_rcv_amount,
												SUM(dn_entry_product_detail_tot_amount_cur) AS dnp_rcv_amount_cur
											FROM 
												dn_entry_product_details
											LEFT JOIN
												 dn_entry
											ON
												 dn_entry_id									= dn_entry_product_detail_invoice_id 	
											WHERE 
												dn_entry_product_detail_deleted_status			= 0  					
											GROUP BY 
												dn_entry_product_detail_invoice_id) dnp_table 
										ON 
											dn_entry_product_detail_invoice_id 					= invoiceId		
										LEFT JOIN
											purchase_order
										ON
											purchaseId											= pI_purchaseId 
										LEFT JOIN
											suppliers
										ON
											supplier_id											= pI_supplier_id 							 
										WHERE 
											pI_deleted_status 						= 0 			AND
											(IFNULL(rcv_table.rcv_amount+dn_table.dn_rcv_amount+dnp_table.dnp_rcv_amount+pR_advanceAmnt,0) 		< pI_invoicetotal OR 
											 IFNULL(rcv_table.rcv_amount_cur+dn_table.dn_rcv_amount_cur+dnp_table.dnp_rcv_amount_cur+pR_advanceAmnt,0) 	< pI_invoice_total_amt) $where";
										//echo $select_invoice_entry; exit;
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
