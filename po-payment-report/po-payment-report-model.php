<?php  
	function quotationtypeone()
	{
		$where = " WHERE p_deleted_status =0 AND  p_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";
		
		if(isset($_REQUEST['search_from_date']) && (!empty($_REQUEST['search_from_date'])) && isset($_REQUEST['search_to_date']) && 
		(!empty($_REQUEST['search_to_date']))) {
		
			$where .= " AND p_paymentdate BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."'";	
			
		}
		
		if(isset($_REQUEST['search_entry_no']) && (!empty($_REQUEST['search_entry_no']))) {
			$where .= " AND paymentId = '".dataValidation($_REQUEST['search_entry_no'])."'";
		}
		
		if(isset($_REQUEST['search_branch_id']) && (!empty($_REQUEST['search_branch_id']))) {
			$where .= " AND p_branchid = '".dataValidation($_REQUEST['search_branch_id'])."'";
		}
		if(isset($_REQUEST['search_supplier_id']) && (!empty($_REQUEST['search_supplier_id']))) {
			$where .= " AND p_supplier_name = '".dataValidation($_REQUEST['search_supplier_id'])."'";
		}
		
		
		
		     /* $select_invoice_entry = "SELECT 
				 							payment_no,
											DATE_FORMAT(p_paymentdate ,'%d/%m/%Y') AS p_paymentdate,
											 pi_amount,
											supplier_name,
											 pi_descount_amt,
											invoiceNo,
											DATE_FORMAT(pI_invoice_date ,'%d/%m/%Y') AS pI_invoice_date
								  FROM  purchase_payment
								  LEFT JOIN purchase_payment_details ON pi_paymentId = paymentId
								  LEFT JOIN purchase_invoice ON invoiceId = pi_invoiceId
								  LEFT JOIN suppliers ON supplier_id = p_supplier_name
								  $where
								  ORDER BY paymentId,pi_invoiceId ASC"; */
								  
		//Edited by AuthorsMM To show Payment term and Bank Name;
		$select_invoice_entry = "SELECT 
				 							payment_no,
											DATE_FORMAT(p_paymentdate ,'%d/%m/%Y') AS p_paymentdate,
											 pi_amount,
											supplier_name,
											 pi_descount_amt,
											invoiceNo,
											DATE_FORMAT(pI_invoice_date ,'%d/%m/%Y') AS pI_invoice_date,
											account_sub_name, p_paymentterm, p_bankname
								  FROM  purchase_payment
								  LEFT JOIN purchase_payment_details ON pi_paymentId = paymentId
								  LEFT JOIN account_sub ON account_sub_id = p_bankname
								  LEFT JOIN purchase_invoice ON invoiceId = pi_invoiceId
								  LEFT JOIN suppliers ON supplier_id = p_supplier_name
								  $where
								  ORDER BY paymentId,pi_invoiceId ASC";
								  
								 // echo  $select_invoice_entry;exit;
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
